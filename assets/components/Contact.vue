<template>
    <div class="example-wrapper">
        <h1 class="mb-4">Contactez moi</h1>
        <form method="post" action="/contact" @submit.prevent="submit">
            <input type="hidden" name="contact[_token]" :value="csrfToken" />
            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <label for="contact-name" class="form-label">Nom</label>
                    <input
                        id="contact-name"
                        v-model="form.name"
                        type="text"
                        name="contact[name]"
                        class="form-control"
                        required
                    />
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="contact-email" class="form-label">Email</label>
                    <input
                        id="contact-email"
                        v-model="form.email"
                        type="email"
                        name="contact[email]"
                        class="form-control"
                        required
                    />
                </div>
            </div>
            <div class="mb-3">
                <label for="contact-message" class="form-label">Message</label>
                <textarea
                    id="contact-message"
                    v-model="form.message"
                    name="contact[message]"
                    class="form-control"
                    rows="5"
                    required
                ></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
</template>

<script setup>
import { reactive } from 'vue';

const props = defineProps({
    csrfToken: {
        type: String,
        required: true,
    },
});

const form = reactive({ name: '', email: '', message: '' });

function submit(event) {
    event.target.submit();
}
</script>
