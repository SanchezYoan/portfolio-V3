<template>
    <div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="/admin/project" class="btn btn-outline-secondary">← Retour</a>
            <a :href="'/admin/project/' + project.id + '/edit'" class="btn btn-success">Modifier</a>
        </div>
        <div class="card">
            <img v-if="project.thumbnailUrl" :src="project.thumbnailUrl" :alt="project.title" style="width: 100%; max-height: 300px; object-fit: cover; border-radius: 8px 8px 0 0;" />
            <div class="card-body">
                <h1 class="card-title">{{ project.title }}</h1>
                <p class="card-text">{{ project.description }}</p>
                <div v-if="project.results" class="mt-3">
                    <h5>Résultats</h5>
                    <p>{{ project.results }}</p>
                </div>
                <div v-if="project.learnings" class="mt-3">
                    <h5>Compétences acquises</h5>
                    <p>{{ project.learnings }}</p>
                </div>
                <!-- Galerie -->
                <div v-if="project.images && project.images.length > 0" class="mt-4">
                    <h5>Galerie</h5>
                    <div class="d-flex flex-wrap gap-2">
                        <img
                            v-for="img in project.images"
                            :key="img.id"
                            :src="img.url"
                            alt="Image galerie"
                            style="height: 120px; width: 120px; object-fit: cover; border-radius: 6px; border: 1px solid #dee2e6; cursor: pointer;"
                            @click="lightbox = img.url"
                        />
                    </div>
                </div>

                <div class="mt-3 d-flex gap-2">
                    <a v-if="project.githubUrl" :href="project.githubUrl" target="_blank" class="btn btn-dark btn-sm">GitHub</a>
                    <a v-if="project.demoUrl" :href="project.demoUrl" target="_blank" class="btn btn-success btn-sm">Demo</a>
                </div>
            </div>
        </div>

        <!-- Lightbox -->
        <div
            v-if="lightbox"
            class="position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
            style="background: rgba(0,0,0,0.8); z-index: 9999; cursor: pointer;"
            @click="lightbox = null"
        >
            <img :src="lightbox" style="max-width: 90%; max-height: 90%; border-radius: 8px;" />
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

defineProps({
    project: { type: Object, required: true },
});

const lightbox = ref(null);
</script>
