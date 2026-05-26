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

        <div class="account-card">

            <!-- Avatar + nom -->
            <div class="account-card__header">
                <div class="account-avatar">{{ username.charAt(0).toUpperCase() }}</div>
                <div>
                    <h1 class="account-title">{{ username }}</h1>
                    <p class="account-email">{{ email }}</p>
                </div>
            </div>

            <hr class="account-divider" />

            <!-- Rôles -->
            <div class="account-section">
                <h5 class="account-section__label">Rôles</h5>
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
/* ── Card ──────────────────────────────────────── */
.account-card {
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 1.25rem;
    padding: 2rem;
}

/* ── Header ────────────────────────────────────── */
.account-card__header {
    display: flex;
    align-items: center;
    gap: 1.25rem;
}

.account-avatar {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    background: linear-gradient(135deg, #a78bfa22, #60a5fa22);
    border: 2px solid rgba(167, 139, 250, 0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.6rem;
    font-weight: 700;
    background: linear-gradient(135deg, #a78bfa, #60a5fa);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    flex-shrink: 0;
}

.account-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #f1f5f9;
    margin: 0;
}

.account-email {
    font-size: 0.9rem;
    color: #94a3b8;
    margin: 0;
}

/* ── Divider ───────────────────────────────────── */
.account-divider {
    border-color: rgba(255, 255, 255, 0.08);
    margin: 1.5rem 0;
}

/* ── Section ───────────────────────────────────── */
.account-section { margin-bottom: 1rem; }

.account-section__label {
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: #64748b;
    margin-bottom: 0.6rem;
}

/* ── Badges rôles ──────────────────────────────── */
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
