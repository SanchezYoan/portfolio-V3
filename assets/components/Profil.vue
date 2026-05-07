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
                    <li class="list-group-item d-flex align-items-center gap-2">
                        <strong>Mot de passe :</strong>
                        <input type="password" value="********" class="form-control w-auto" readonly />
                        <button type="button" class="btn btn-primary btn-sm">Modifier</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    user: {
        type: Object,
        required: true,
    },
});
</script>
