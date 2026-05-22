<template>
    <div class="project-wrapper">
        <a href="/project" class="btn btn-outline-secondary mb-4">← Retour aux projets</a>

        <img v-if="project.thumbnailUrl" :src="project.thumbnailUrl" :alt="project.title" class="project-cover" />

        <div class="project-body">

            <h1 class="project-title">{{ project.title }}</h1>

            <p v-if="project.description" class="project-description">{{ project.description }}</p>

            <hr class="project-divider" />

            <div v-if="project.results" class="project-section">
                <h5 class="project-section__label">Résultats</h5>
                <p class="project-section__text">{{ project.results }}</p>
            </div>

            <div v-if="project.learnings" class="project-section">
                <h5 class="project-section__label">Compétences acquises</h5>
                <p class="project-section__text">{{ project.learnings }}</p>
            </div>

            <!-- Galerie -->
            <div v-if="project.images && project.images.length > 0" class="project-section">
                <h5 class="project-section__label">Galerie</h5>
                <div class="gallery">
                    <img
                        v-for="img in project.images"
                        :key="img.id"
                        :src="img.url"
                        alt="Image galerie"
                        class="gallery__thumb"
                        @click="openLightbox(img.url)"
                    />
                </div>
            </div>

            <div v-if="project.githubUrl || project.demoUrl" class="project-links">
                <a v-if="project.githubUrl" :href="project.githubUrl" target="_blank" class="btn btn-dark btn-sm">GitHub</a>
                <a v-if="project.demoUrl" :href="project.demoUrl" target="_blank" class="btn btn-success btn-sm">Demo</a>
            </div>

        </div>

        <!-- Lightbox -->
        <Transition name="lightbox">
            <div v-if="lightbox" class="lightbox" @click="lightbox = null">
                <Transition name="lightbox-img">
                    <img v-if="lightbox" :src="lightbox" class="lightbox__img" />
                </Transition>
                <button class="lightbox__close" @click.stop="lightbox = null">✕</button>
            </div>
        </Transition>
    </div>
</template>

<script setup>
import { ref } from 'vue';

defineProps({
    project: { type: Object, required: true },
});

const lightbox = ref(null);

function openLightbox(url) {
    lightbox.value = url;
}
</script>

<style scoped>
.project-wrapper {
    max-width: 860px;
    margin: 0 auto;
    padding: 2rem 1.5rem;
}

.project-cover {
    width: 100%;
    max-height: 320px;
    object-fit: cover;
    border-radius: 10px;
    margin-bottom: 1.5rem;
}

.project-body {
    padding: 0 0.5rem;
}

.project-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: #f1f5f9;
    margin-bottom: 0.5rem;
}

.project-description {
    font-size: 1rem;
    color: #94a3b8;
    line-height: 1.7;
    margin-bottom: 0;
}

.project-divider {
    border-color: rgba(255, 255, 255, 0.1);
    margin: 1.5rem 0;
}

.project-section {
    margin-bottom: 1.5rem;
}

.project-section__label {
    font-weight: 600;
    color: #e2e8f0;
    margin-bottom: 0.4rem;
}

.project-section__text {
    font-size: 0.95rem;
    color: #94a3b8;
    line-height: 1.6;
    margin: 0;
}

.project-links {
    display: flex;
    gap: 0.5rem;
}

/* ── Galerie ───────────────────────────────────── */
.gallery {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.gallery__thumb {
    height: 120px;
    width: 120px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    cursor: pointer;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.gallery__thumb:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.4);
}

/* ── Lightbox ──────────────────────────────────── */
.lightbox {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.85);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    cursor: pointer;
    backdrop-filter: blur(4px);
}

.lightbox__img {
    max-width: 90%;
    max-height: 90%;
    border-radius: 10px;
    box-shadow: 0 8px 40px rgba(0, 0, 0, 0.6);
    cursor: default;
}

.lightbox__close {
    position: absolute;
    top: 1.2rem;
    right: 1.5rem;
    background: rgba(255, 255, 255, 0.15);
    border: none;
    color: #fff;
    font-size: 1.2rem;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s ease;
}

.lightbox__close:hover {
    background: rgba(255, 255, 255, 0.3);
}

/* ── Transitions ───────────────────────────────── */
.lightbox-enter-active,
.lightbox-leave-active {
    transition: opacity 0.25s ease;
}
.lightbox-enter-from,
.lightbox-leave-to {
    opacity: 0;
}

.lightbox-img-enter-active {
    transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.25s ease;
}
.lightbox-img-enter-from {
    transform: scale(0.85);
    opacity: 0;
}
</style>
