<template>
    <div class="example-wrapper">
        <h1 class="h3 mb-3">Se connecter</h1>
        <div v-if="error" class="alert alert-danger">{{ error }}</div>
        <form method="post" action="/login">
            <div class="mb-3">
                <label for="inputUsername" class="form-label">Nom d'utilisateur</label>
                <input
                    id="inputUsername"
                    type="text"
                    :value="lastUsername"
                    name="username"
                    class="form-control"
                    autocomplete="username"
                    required
                    autofocus
                />
            </div>
            <div class="mb-3">
                <label for="inputPassword" class="form-label">Mot de passe</label>
                <input
                    id="inputPassword"
                    type="password"
                    name="password"
                    class="form-control"
                    autocomplete="current-password"
                    required
                />
            </div>
            <input type="hidden" name="_csrf_token" :value="csrfToken" />
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="_remember_me" id="rememberMe" />
                <label class="form-check-label" for="rememberMe">Se souvenir de moi</label>
            </div>
            <button class="btn btn-primary" type="submit">Se connecter</button>
        </form>
    </div>
</template>

<script setup>
defineProps({
    lastUsername: {
        type: String,
        default: '',
    },
    error: {
        type: String,
        default: null,
    },
    csrfToken: {
        type: String,
        required: true,
    },
});
</script>
