<template>
    <div class="projects-wrapper">
        <h2 class="projects-title">Mes projets</h2>

        <p v-if="projects.length === 0" class="text-muted">Aucun projet trouvé.</p>

        <div class="projects-grid">
            <a
                v-for="(project, index) in projects"
                :key="project.id"
                :href="'/project/' + project.id"
                class="project-card"
                :class="`project-card--${index % 3}`"
            >
                <div class="project-card__thumb">
                    <img v-if="project.thumbnailUrl" :src="project.thumbnailUrl" :alt="project.title" />
                    <div v-else class="project-card__placeholder">{{ project.title.charAt(0) }}</div>
                </div>
                <div class="project-card__body">
                    <h3 class="project-card__title">{{ project.title }}</h3>
                    <p class="project-card__desc">{{ project.description }}</p>
                    <span class="project-card__link">Voir le projet →</span>
                </div>
            </a>
        </div>
    </div>
</template>

<script setup>
defineProps({
    projects: {
        type: Array,
        default: () => [],
    },
});
</script>

<style scoped>
.projects-wrapper {
    max-width: 1100px;
    margin: 0 auto;
    padding: 2rem 1.5rem;
}

.projects-title {
    font-size: 2rem;
    font-weight: 700;
    color: #f1f5f9;
    margin-bottom: 2rem;
}

/* ── Grille ────────────────────────────────────── */
.projects-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem;
}

@media (max-width: 900px) {
    .projects-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 580px) {
    .projects-grid { grid-template-columns: 1fr; }
}

/* ── Carte ─────────────────────────────────────── */
.project-card {
    display: flex;
    flex-direction: column;
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 1.25rem;
    overflow: hidden;
    text-decoration: none;
    transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
}

.project-card--0 { background: rgba(167, 139, 250, 0.07); border-color: rgba(167, 139, 250, 0.2); }
.project-card--1 { background: rgba(96, 165, 250, 0.07);  border-color: rgba(96, 165, 250, 0.2);  }
.project-card--2 { background: rgba(52, 211, 153, 0.07);  border-color: rgba(52, 211, 153, 0.2);  }

.project-card--0:hover { box-shadow: 0 12px 32px rgba(167, 139, 250, 0.2); border-color: rgba(167, 139, 250, 0.5); }
.project-card--1:hover { box-shadow: 0 12px 32px rgba(96, 165, 250, 0.2);  border-color: rgba(96, 165, 250, 0.5);  }
.project-card--2:hover { box-shadow: 0 12px 32px rgba(52, 211, 153, 0.2);  border-color: rgba(52, 211, 153, 0.5);  }

.project-card:hover {
    transform: translateY(-4px);
}

/* ── Thumbnail ─────────────────────────────────── */
.project-card__thumb {
    width: 100%;
    height: 180px;
    overflow: hidden;
    background: linear-gradient(135deg, #a78bfa22, #60a5fa22);
    display: flex;
    align-items: center;
    justify-content: center;
}

.project-card__thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.project-card:hover .project-card__thumb img {
    transform: scale(1.05);
}

.project-card__placeholder {
    font-size: 3rem;
    font-weight: 700;
    background: linear-gradient(135deg, #a78bfa, #60a5fa);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* ── Contenu ───────────────────────────────────── */
.project-card__body {
    padding: 1.25rem;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    flex: 1;
}

.project-card__title {
    font-size: 1.1rem;
    font-weight: 700;
    color: #f1f5f9;
    margin: 0;
}

.project-card__desc {
    font-size: 0.88rem;
    color: #94a3b8;
    line-height: 1.5;
    margin: 0;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.project-card__link {
    font-size: 0.85rem;
    font-weight: 600;
    color: #a78bfa;
    margin-top: auto;
}
</style>
