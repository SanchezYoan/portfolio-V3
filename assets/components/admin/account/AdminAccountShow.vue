<template>
    <div>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="/admin/account" class="btn btn-outline-secondary">← Retour</a>
            <div class="d-flex gap-2">
                <a :href="'/admin/account/' + id + '/edit'" class="btn btn-success btn-sm">Modifier</a>
                <form :action="'/admin/account/' + id + '/delete'" method="post" @submit.prevent="confirmDelete($event)">
                    <button class="btn btn-danger btn-sm" type="submit">Supprimer</button>
                </form>
            </div>
        </div>

        <div class="project-body">
            <h1 class="project-title">{{ username }}</h1>

            <hr class="project-divider" />

            <div class="project-section">
                <h5 class="project-section__label">Email</h5>
                <p class="project-section__text">{{ email }}</p>
            </div>

            <div class="project-section">
                <h5 class="project-section__label">Rôles</h5>
                <div class="d-flex gap-2 flex-wrap">
                    <span v-for="role in roles" :key="role" class="role-badge">{{ role }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    id:       { type: Number, required: true },
    username: { type: String, required: true },
    email:    { type: String, required: true },
    roles:    { type: Array,  required: true },
});

function confirmDelete(event) {
    if (confirm('Supprimer ce compte ?')) {
        event.target.submit();
    }
}
</script>

<style scoped>
.project-body { padding: 0 0.5rem; }

.project-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: #f1f5f9;
    margin-bottom: 0.5rem;
}

.project-divider {
    border-color: rgba(255, 255, 255, 0.1);
    margin: 1.5rem 0;
}

.project-section { margin-bottom: 1.5rem; }

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

.role-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 999px;
    font-size: 0.78rem;
    font-weight: 500;
    color: #a78bfa;
    border: 1px solid rgba(167, 139, 250, 0.4);
    background: rgba(167, 139, 250, 0.1);
}
</style>
