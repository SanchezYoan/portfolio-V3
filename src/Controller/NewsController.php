<?php

namespace App\Controller;

use App\Service\RssReaderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class NewsController extends AbstractController
{
    #[Route('/news', name: 'app_news')]
    public function index(): Response
    {
        return $this->render('news/index.html.twig');
    }

    #[Route('/api/news', name: 'api_news', methods: ['GET'])]
    public function api(RssReaderService $rssReader): JsonResponse
    {
        $articles = $rssReader->getArticles(limit: 20);

        return $this->json($articles);
    }
}
