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
            <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #1e293b; color: #f1f5f9;">
                <h5 class="mb-0">{{ project.title }}</h5>
                <div class="d-flex gap-2">
                    <a :href="'/admin/project/' + project.id" class="icon-btn icon-btn--blue" title="Voir">
                        <Eye :size="17" />
                    </a>
                    <a :href="'/admin/project/' + project.id + '/edit'" class="icon-btn icon-btn--green" title="Modifier">
                        <Pencil :size="17" />
                    </a>
                    <form :action="'/admin/project/' + project.id + '/delete'" method="post" @submit.prevent="confirmDelete($event)">
                        <input type="hidden" name="_method" value="DELETE" />
                        <input type="hidden" name="_token" :value="csrfToken" />
                        <button class="icon-btn icon-btn--red" type="submit" title="Supprimer">
                            <Trash2 :size="17" />
                        </button>
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
import { Eye, Pencil, Trash2 } from 'lucide-vue-next';

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

<style scoped>
.icon-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    transition: opacity 0.15s ease, transform 0.15s ease;
    background: transparent;
}

.icon-btn:hover {
    opacity: 0.8;
    transform: scale(1.1);
}

.icon-btn--blue  { color: #60a5fa; background: rgba(96, 165, 250, 0.15); }
.icon-btn--green { color: #34d399; background: rgba(52, 211, 153, 0.15); }
.icon-btn--red   { color: #f87171; background: rgba(248, 113, 113, 0.15); }
</style>
