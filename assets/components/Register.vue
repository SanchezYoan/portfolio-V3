<template>
    <div class="container">
        <h2 class="text-center mb-4">Formulaire d'inscription</h2>

        <div v-if="flashErrors.length" class="mb-3">
            <div v-for="(err, i) in flashErrors" :key="i" class="alert alert-danger">{{ err }}</div>
        </div>

        <form method="post" :action="actionUrl">
            <input type="hidden" name="registration_form[_token]" :value="csrfToken" />

            <div class="mb-3">
                <label for="reg-email" class="form-label">Email</label>
                <input
                    id="reg-email"
                    type="email"
                    name="registration_form[email]"
                    class="form-control"
                    :class="{ 'is-invalid': errors.email?.length }"
                    :value="values.email"
                    required
                />
                <div v-if="errors.email?.length" class="invalid-feedback">
                    {{ errors.email[0] }}
                </div>
            </div>

            <div class="mb-3">
                <label for="reg-username" class="form-label">Nom d'utilisateur</label>
                <input
                    id="reg-username"
                    type="text"
                    name="registration_form[username]"
                    class="form-control"
                    :class="{ 'is-invalid': errors.username?.length }"
                    :value="values.username"
                    required
                />
                <div v-if="errors.username?.length" class="invalid-feedback">
                    {{ errors.username[0] }}
                </div>
            </div>

            <div class="mb-3">
                <label for="reg-password" class="form-label">Mot de passe</label>
                <input
                    id="reg-password"
                    type="password"
                    name="registration_form[plainPassword]"
                    class="form-control"
                    :class="{ 'is-invalid': errors.plainPassword?.length }"
                    autocomplete="new-password"
                    required
                    minlength="6"
                />
                <div v-if="errors.plainPassword?.length" class="invalid-feedback">
                    {{ errors.plainPassword[0] }}
                </div>
            </div>

            <div class="mb-3 form-check">
                <input
                    id="reg-terms"
                    type="checkbox"
                    name="registration_form[agreeTerms]"
                    class="form-check-input"
                    :class="{ 'is-invalid': errors.agreeTerms?.length }"
                    value="1"
                    required
                />
                <label for="reg-terms" class="form-check-label">
                    J'accepte les <a href="/cgu" target="_blank" class="text-decoration-underline">CGU</a>
                </label>
                <div v-if="errors.agreeTerms?.length" class="invalid-feedback">
                    {{ errors.agreeTerms[0] }}
                </div>
            </div>

            <button type="submit" class="btn btn-primary d-block w-100 py-2">S'inscrire</button>
        </form>
    </div>
</template>

<script setup>
defineProps({
    csrfToken:   { type: String, required: true },
    actionUrl:   { type: String, default: '/register' },
    flashErrors: { type: Array, default: () => [] },
    errors:      { type: Object, default: () => ({}) },
    values:      { type: Object, default: () => ({}) },
});
</script>
