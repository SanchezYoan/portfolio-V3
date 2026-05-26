<template>
    <div>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a :href="'/admin/account/' + user.id" class="btn btn-outline-secondary">← Retour</a>
        </div>

        <div class="project-body">
            <h1 class="project-title">Modifier le compte</h1>
            <hr class="project-divider" />

            <form method="post" :action="actionUrl">
                <input type="hidden" name="user[_token]" :value="csrfToken" />

                <div class="mb-3">
                    <label class="form-label">Nom d'utilisateur</label>
                    <input
                        type="text"
                        name="user[username]"
                        class="form-control"
                        :class="{ 'is-invalid': errors.username?.length }"
                        :value="user.username"
                        required
                    />
                    <div v-if="errors.username?.length" class="invalid-feedback">{{ errors.username[0] }}</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input
                        type="email"
                        name="user[email]"
                        class="form-control"
                        :class="{ 'is-invalid': errors.email?.length }"
                        :value="user.email"
                        required
                    />
                    <div v-if="errors.email?.length" class="invalid-feedback">{{ errors.email[0] }}</div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Nouveau mot de passe</label>
                    <input
                        type="password"
                        name="user[plainPassword]"
                        class="form-control"
                        :class="{ 'is-invalid': errors.password?.length }"
                        placeholder="Laisser vide pour ne pas modifier"
                        autocomplete="new-password"
                    />
                    <div v-if="errors.password?.length" class="invalid-feedback">{{ errors.password[0] }}</div>
                </div>

                <button type="submit" class="btn btn-success">Enregistrer</button>
            </form>
        </div>
    </div>
</template>

<script setup>
defineProps({
    user:      { type: Object, required: true },
    csrfToken: { type: String, required: true },
    actionUrl: { type: String, required: true },
    errors:    { type: Object, default: () => ({}) },
});
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
</style>
