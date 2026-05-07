<template>
    <div class="example-wrapper">
        <h2 class="mb-4">Mes projets</h2>
        <div v-if="projects.length === 0">
            <p class="text-muted">Aucun projet trouvé.</p>
        </div>
        <div v-for="project in projects" :key="project.id" class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ project.title }}</h5>
                <p class="card-text">{{ project.description }}</p>
                <a :href="'/project/' + project.id" class="btn btn-primary">Voir le projet</a>
            </div>
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
