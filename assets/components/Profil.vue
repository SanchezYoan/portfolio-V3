<template>
    <div class="example-wrapper">
        <h1 class="mb-3">Bonjour {{ user.username }}</h1>
        <div class="card">
            <div class="card-header">Vos informations personnelles</div>
            <div class="card-body">
                <ul class="list-group list-group-flush">

                    <li class="list-group-item">
                        <strong>Email :</strong> {{ user.email }}
                    </li>

                    <li class="list-group-item">
                        <strong>Nom d'utilisateur :</strong> {{ user.username }}
                    </li>

                    <li class="list-group-item">
                        <strong>Mot de passe</strong>
                        <div class="password-form mt-2">

                            <!-- Étape 1 : vérification mot de passe actuel -->
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <input
                                    type="password"
                                    v-model="currentPassword"
                                    class="form-control"
                                    placeholder="Mot de passe actuel"
                                    :disabled="step === 2"
                                />
                                <button
                                    type="button"
                                    class="btn btn-outline-primary btn-sm"
                                    @click="checkPassword"
                                    :disabled="!currentPassword || step === 2 || loading"
                                >
                                    {{ loading && step === 1 ? 'Vérification...' : 'Vérifier' }}
                                </button>
                            </div>

                            <!-- Étape 2 : saisie du nouveau mot de passe -->
                            <div v-if="step === 2" class="d-flex align-items-center gap-2 mb-2">
                                <input
                                    type="password"
                                    v-model="newPassword"
                                    class="form-control"
                                    placeholder="Nouveau mot de passe (8 car. min.)"
                                />
                                <button
                                    type="button"
                                    class="btn btn-primary btn-sm"
                                    @click="updatePassword"
                                    :disabled="!newPassword || loading"
                                >
                                    {{ loading ? 'Modification...' : 'Modifier' }}
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-outline-secondary btn-sm"
                                    @click="reset"
                                >
                                    Annuler
                                </button>
                            </div>

                            <!-- Feedback -->
                            <div v-if="errorMessage" class="alert alert-danger py-1 px-2 mb-0 mt-1">
                                {{ errorMessage }}
                            </div>
                            <div v-if="successMessage" class="alert alert-success py-1 px-2 mb-0 mt-1">
                                {{ successMessage }}
                            </div>

                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

defineProps({
    user: {
        type: Object,
        required: true,
    },
});

const step            = ref(1);
const currentPassword = ref('');
const newPassword     = ref('');
const loading         = ref(false);
const errorMessage    = ref('');
const successMessage  = ref('');

function reset() {
    step.value            = 1;
    currentPassword.value = '';
    newPassword.value     = '';
    errorMessage.value    = '';
    successMessage.value  = '';
}

async function checkPassword() {
    errorMessage.value   = '';
    successMessage.value = '';
    loading.value        = true;

    try {
        // On envoie une valeur sentinelle trop courte pour tester uniquement le mdp actuel
        const res  = await fetch('/api/password', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                currentPassword: currentPassword.value,
                newPassword: '__check__',
            }),
        });
        const data = await res.json();

        // Si l'erreur porte sur la longueur → le mdp actuel est correct
        if (res.ok || data.error?.includes('8 caractères')) {
            step.value = 2;
        } else {
            errorMessage.value = data.error;
        }
    } catch {
        errorMessage.value = 'Erreur réseau, réessaie.';
    } finally {
        loading.value = false;
    }
}

async function updatePassword() {
    errorMessage.value   = '';
    successMessage.value = '';
    loading.value        = true;

    try {
        const res  = await fetch('/api/password', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                currentPassword: currentPassword.value,
                newPassword: newPassword.value,
            }),
        });
        const data = await res.json();

        if (res.ok) {
            successMessage.value = data.message;
            reset();
        } else {
            errorMessage.value = data.error;
        }
    } catch {
        errorMessage.value = 'Erreur réseau, réessaie.';
    } finally {
        loading.value = false;
    }
}
</script>
