<template>
    <div class="example-wrapper">
        <a href="/project" class="btn btn-outline-secondary mb-3">← Retour aux projets</a>
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">{{ project.title }}</h1>
                <p class="card-text">{{ project.description }}</p>
                <div v-if="project.results" class="mt-3">
                    <h5>Résultats</h5>
                    <p>{{ project.results }}</p>
                </div>
                <div v-if="project.githubUrl || project.demoUrl" class="mt-3">
                    <h5>Liens</h5>
                    <div class="d-flex gap-2">
                        <a v-if="project.githubUrl" :href="project.githubUrl" target="_blank" class="btn btn-dark">GitHub</a>
                        <a v-if="project.demoUrl" :href="project.demoUrl" target="_blank" class="btn btn-success">Demo</a>
                    </div>
                </div>
                <div v-if="project.thumbnail" class="mt-3">
                    <h5>Image</h5>
                    <img :src="project.thumbnail" class="img-fluid" alt="Image du projet">
                </div>
                <div v-if="project.learnings" class="mt-3">
                    <h5>Apprentissages</h5>
                    <p>{{ project.learnings }}</p>
                </div>
                <div class="mt-3 d-flex gap-2">
                    <a v-if="project.githubUrl" :href="project.githubUrl" target="_blank" class="btn btn-dark">GitHub</a>
                    <a v-if="project.demoUrl" :href="project.demoUrl" target="_blank" class="btn btn-success">Demo</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    project: {
        type: Object,
        required: true,
    },
});
</script>
