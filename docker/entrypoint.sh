#!/bin/sh
set -e

echo ""
echo "========================================"
echo "  Portfolio — Démarrage automatique"
echo "========================================"

# ── 1. Assets webpack ─────────────────────────────────────────
echo ""
echo "[1/4] Restauration des assets webpack..."
cp -rf /tmp/build_backup/. /var/www/symfony/public/build/
echo "      Assets copiés dans public/build/"

# ── 2. Attente de la base de données ──────────────────────────
echo ""
echo "[2/4] Attente de la base de données..."
until php -r "
  \$url = parse_url(getenv('DATABASE_URL'));
  \$host = \$url['host'] ?? 'database';
  \$port = \$url['port'] ?? 3306;
  \$user = \$url['user'] ?? 'root';
  \$pass = \$url['pass'] ?? '';
  \$db   = ltrim(\$url['path'] ?? '/portfolio_db', '/');
  new PDO(\"mysql:host=\$host;port=\$port;dbname=\$db\", \$user, \$pass);
" 2>/dev/null; do
  echo "      Base de données pas encore prête, nouvelle tentative dans 2s..."
  sleep 2
done
echo "      Base de données disponible."

# ── 3. Migrations ─────────────────────────────────────────────
echo ""
echo "[3/4] Exécution des migrations Doctrine..."
php bin/console doctrine:migrations:migrate --no-interaction
echo "      Migrations terminées."

# ── 4. Cache ──────────────────────────────────────────────────
echo ""
echo "[4/4] Nettoyage du cache Symfony..."
php bin/console cache:clear --no-interaction
echo "      Cache effacé."

echo ""
echo "========================================"
echo "  Prêt — démarrage de PHP-FPM"
echo "========================================"
echo ""

exec php-fpm -F
