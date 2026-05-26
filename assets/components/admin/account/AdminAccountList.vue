<template>
    <div>
        <h2 class="mb-4">Comptes utilisateurs</h2>
        <p v-if="accounts.length === 0" class="text-muted">Aucun compte trouvé.</p>
        <div v-for="account in accounts" :key="account.id" class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #1e293b; color: #f1f5f9;">
                <h5 class="mb-0">{{ account.username }}</h5>
                <div class="d-flex gap-2">
                    <a :href="'/admin/account/' + account.id" class="icon-btn icon-btn--blue" title="Voir">
                        <Eye :size="17" />
                    </a>
                </div>
            </div>
            <div class="card-body">
                <p class="card-text mb-1">{{ account.email }}</p>
                <p class="card-text">
                    <span v-for="role in account.roles" :key="role" class="badge bg-secondary me-1">{{ role }}</span>
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Eye } from 'lucide-vue-next';

defineProps({
    accounts: { type: Array, default: () => [] },
});
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

.icon-btn--blue { color: #60a5fa; background: rgba(96, 165, 250, 0.15); }
</style>
