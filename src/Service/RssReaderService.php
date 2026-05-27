<?php

namespace App\Service;

use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class RssReaderService
{
    private const FEEDS = [
        'Le Monde Informatique' => 'https://www.lemondeinformatique.fr/flux-rss/thematique/actualites/rss.xml',
    ];

    private const CACHE_TTL = 1800; // 30 minutes

    public function __construct(
        private HttpClientInterface $httpClient,
        private CacheInterface $cache,
    ) {}

    /**
     * Retourne les articles agrégés de toutes les sources RSS.
     *
     * @return array<int, array{title: string, link: string, description: string, pubDate: string, source: string}>
     */
    public function getArticles(int $limit = 20): array
    {
        return $this->cache->get('rss_articles', function (ItemInterface $item) use ($limit) {
            $item->expiresAfter(self::CACHE_TTL);

            $articles = [];

            foreach (self::FEEDS as $sourceName => $url) {
                try {
                    $response = $this->httpClient->request('GET', $url, [
                        'timeout' => 5,
                        'headers' => ['Accept' => 'application/rss+xml, application/xml, text/xml'],
                    ]);

                    $content = $response->getContent();

                    // Conversion encodage si nécessaire
                    if (preg_match('/encoding=["\']([^"\']+)["\']/', $content, $m)) {
                        $encoding = strtoupper($m[1]);
                        if ($encoding !== 'UTF-8') {
                            $content = mb_convert_encoding($content, 'UTF-8', $encoding);
                            $content = preg_replace('/encoding=["\'][^"\']+["\']/', 'encoding="UTF-8"', $content);
                        }
                    }

                    $xml = new \SimpleXMLElement($content);
                    $xml->registerXPathNamespace('rss', 'http://purl.org/rss/1.0/');
                    $xml->registerXPathNamespace('dc', 'http://purl.org/dc/elements/1.1/');

                    // RSS 2.0 : items dans channel
                    // RSS 1.0 / RDF : items à la racine
                    $items = $xml->channel->item ?? null;
                    if (!$items || count($items) === 0) {
                        $items = $xml->xpath('//rss:item') ?: [];
                    }

                    foreach ($items as $entry) {
                        $dcChildren = $entry->children('http://purl.org/dc/elements/1.1/');
                        $pubDate = (string) ($entry->pubDate ?? $dcChildren->date ?? '');

                        $articles[] = [
                            'title'       => (string) $entry->title,
                            'link'        => (string) $entry->link,
                            'description' => strip_tags((string) $entry->description),
                            'pubDate'     => $pubDate,
                            'source'      => $sourceName,
                        ];
                    }
                } catch (\Throwable $e) {
                    // Source inaccessible — on continue avec les autres
                    continue;
                }
            }

            // Tri par date décroissante
            usort($articles, fn($a, $b) => strtotime($b['pubDate']) - strtotime($a['pubDate']));

            return array_slice($articles, 0, $limit);
        });
    }
}
