#!/usr/bin/env python3
"""
Dev helper — portfolio-V3
Usage:
  python3 dev.py          → watch mode (rebuild auto à chaque sauvegarde)
  python3 dev.py build    → build production one-shot
  python3 dev.py up       → démarre les containers + watch mode
  python3 dev.py down     → arrête les containers
  python3 dev.py restart  → rebuild le container app + watch mode
  python3 dev.py logs     → affiche les logs nginx + app en live
"""

import subprocess
import sys
import time

# Préfixe commun pour toutes les commandes docker compose
COMPOSE = ["docker", "compose"]


def run(cmd, **kwargs):
    """Lance une commande sans capturer sa sortie (affichage direct)."""
    return subprocess.run(cmd, **kwargs)


def stream(cmd):
    """Lance une commande et affiche sa sortie ligne par ligne en temps réel.
    Retourne le code de retour du processus."""
    with subprocess.Popen(cmd, stdout=subprocess.PIPE, stderr=subprocess.STDOUT, text=True) as p:
        for line in p.stdout:
            print(line, end="", flush=True)
        p.wait()
        return p.returncode


def containers_running():
    """Vérifie qu'au moins un container du projet est en état 'running'."""
    result = subprocess.run(
        COMPOSE + ["ps", "--status", "running", "-q"],
        capture_output=True, text=True
    )
    return bool(result.stdout.strip())


def wait_healthy(service, timeout=120):
    """Attend qu'un service passe à l'état 'healthy' (healthcheck Docker).
    Interroge toutes les secondes jusqu'au timeout."""
    print(f"⏳ Attente que '{service}' soit healthy...", flush=True)
    for _ in range(timeout):
        result = subprocess.run(
            ["docker", "compose", "ps", "--status", "healthy", "-q", service],
            capture_output=True, text=True
        )
        if result.stdout.strip():
            print(f"✅ '{service}' est prêt.", flush=True)
            return True
        time.sleep(1)
    print(f"❌ Timeout: '{service}' n'est pas healthy après {timeout}s.", flush=True)
    return False


def wait_app_ready(timeout=90):
    """Attend que le container app soit running et que PHP-FPM soit démarré
    (en cherchant 'ready to handle connections' dans les logs)."""
    print("⏳ Attente que 'app' soit prêt (migrations + PHP-FPM)...", flush=True)
    for _ in range(timeout):
        result = subprocess.run(
            COMPOSE + ["logs", "--tail=20", "app"],
            capture_output=True, text=True
        )
        if "ready to handle connections" in result.stdout:
            print("✅ 'app' est prêt.", flush=True)
            return True
        time.sleep(1)
    print(f"❌ Timeout: 'app' n'est pas prêt après {timeout}s.", flush=True)
    return False


def cmd_up():
    """Démarre tous les containers en arrière-plan, attend que database et app
    soient prêts, puis lance le watch mode webpack."""
    print("🚀 Démarrage des containers...", flush=True)
    run(COMPOSE + ["up", "-d"])
    # Docker Compose gère déjà le wait DB via depends_on/service_healthy
    # On attend juste que l'entrypoint (migrations + cache) soit terminé
    wait_app_ready()
    print("🌐 Site disponible sur http://localhost:8080", flush=True)
    cmd_watch()


def cmd_down():
    """Arrête et supprime tous les containers du projet."""
    print("🛑 Arrêt des containers...", flush=True)
    run(COMPOSE + ["down"])


def cmd_build():
    """Lance un build webpack production one-shot en local.
    Utile quand on ne veut pas rester en watch mode."""
    print("🔨 Build production...", flush=True)
    code = stream(["npm", "run", "build"])
    if code == 0:
        print("✅ Build terminé — recharge http://localhost:8080", flush=True)
    else:
        print("❌ Build échoué.", flush=True)
        sys.exit(code)


def cmd_watch():
    """Lance webpack en mode watch en local.
    Chaque modification dans assets/ déclenche un rebuild automatique."""
    if not containers_running():
        print("⚠️  Les containers ne tournent pas. Lance 'python3 dev.py up' d'abord.")
        sys.exit(1)
    print("👀 Watch mode actif — rebuild automatique à chaque sauvegarde dans assets/", flush=True)
    print("   (Ctrl+C pour arrêter)\n", flush=True)
    stream(["npm", "run", "watch"])


def cmd_restart():
    """Reconstruit l'image du container app (utile après un changement de Dockerfile
    ou de dépendances PHP) puis relance le watch mode."""
    print("🔄 Rebuild du container app...", flush=True)
    run(COMPOSE + ["up", "-d", "--build", "app"])
    wait_app_ready()
    cmd_watch()


def cmd_logs():
    """Affiche en temps réel les logs des containers app et nginx
    (50 dernières lignes + flux continu)."""
    print("📋 Logs en live (Ctrl+C pour arrêter)...\n", flush=True)
    stream(COMPOSE + ["logs", "-f", "--tail=50", "app", "nginx"])


# Mapping nom de commande → fonction
COMMANDS = {
    "watch":   cmd_watch,
    "build":   cmd_build,
    "up":      cmd_up,
    "down":    cmd_down,
    "restart": cmd_restart,
    "logs":    cmd_logs,
}

if __name__ == "__main__":
    # Par défaut (sans argument) → watch mode
    arg = sys.argv[1] if len(sys.argv) > 1 else "watch"
    if arg not in COMMANDS:
        print(f"Commande inconnue: '{arg}'\nDisponibles: {', '.join(COMMANDS)}")
        sys.exit(1)
    try:
        COMMANDS[arg]()
    except KeyboardInterrupt:
        print("\n👋 Arrêté.")
