# Portfolio V3

Portfolio personnel fullstack administrable, déployable via Docker.

## Stack

Backend: PHP 8.4, Symfony 7, Doctrine ORM, MariaDB 10.11 |
Frontend: Vue.js 3, Bootstrap 5, Webpack Encore |
DevOps: Docker, Nginx, PHP-FPM, GitLab CI |
Outils: VichUploader, Mailpit, Python 3 (script dev) |

## Installation

**Prérequis :** Docker, Node.js, Python 3

```bash
git clone https://github.com/SanchezYoan/portfolio-V3.git
cd portfolio-V3
cp .env.example .env
npm install && npm run build
docker compose up --build
```

L'application est disponible sur **http://localhost:8080**.  
Au démarrage, les migrations et le cache sont appliqués automatiquement.

## Développement

Le script `dev.py` automatise les tâches courantes :

```bash
python3 dev.py
```

## Administration

Accès sur `/admin` — réservé au rôle `ROLE_ADMIN`.  
Attribué automatiquement à `admin@example.com` (configurable dans `src/Entity/User.php`).
