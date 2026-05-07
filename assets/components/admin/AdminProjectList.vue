<template>
    <div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Projets</h2>
            <a href="/admin/project/new" class="btn btn-primary">Ajouter un projet</a>
        </div>
        <div v-if="projects.length === 0">
            <p class="text-muted">Aucun projet trouvé.</p>
        </div>
        <div v-for="project in projects" :key="project.id" class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ project.title }}</h5>
                <div class="d-flex gap-2">
                    <a :href="'/admin/project/' + project.id" class="btn btn-primary btn-sm">Voir</a>
                    <a :href="'/admin/project/' + project.id + '/edit'" class="btn btn-success btn-sm">Modifier</a>
                    <form :action="'/admin/project/' + project.id + '/delete'" method="post" @submit.prevent="confirmDelete($event)">
                        <input type="hidden" name="_method" value="DELETE" />
                        <input type="hidden" name="_token" :value="csrfToken" />
                        <button class="btn btn-danger btn-sm" type="submit">Supprimer</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <p class="card-text">{{ project.description }}</p>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    projects: { type: Array, default: () => [] },
    csrfToken: { type: String, required: true },
});

function confirmDelete(event) {
    if (confirm('Supprimer ce projet ?')) {
        event.target.submit();
    }
}
</script>
