<template>
    <div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="/admin/project" class="btn btn-outline-secondary">← Retour</a>
            <a :href="'/admin/project/' + project.id + '/edit'" class="btn btn-success">Modifier</a>
        </div>
        <div class="card">
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
                <div class="mt-3 d-flex gap-2">
                    <a v-if="project.githubUrl" :href="project.githubUrl" target="_blank" class="btn btn-dark btn-sm">GitHub</a>
                    <a v-if="project.demoUrl" :href="project.demoUrl" target="_blank" class="btn btn-success btn-sm">Demo</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    project: { type: Object, required: true },
});
</script>
