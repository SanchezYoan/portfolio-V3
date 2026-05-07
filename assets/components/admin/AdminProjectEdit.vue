<template>
    <div>
        <div class="mb-3">
            <a href="/admin/project" class="btn btn-outline-secondary">← Retour</a>
        </div>
        <h2 class="mb-4">{{ project.id ? 'Modifier le projet' : 'Nouveau projet' }}</h2>
        <form method="post" :action="actionUrl" enctype="multipart/form-data">
            <input type="hidden" name="project[_token]" :value="csrfToken" />
            <div class="mb-3">
                <label for="proj-title" class="form-label">Titre</label>
                <input id="proj-title" type="text" name="project[title]" class="form-control" :value="project.title" required />
            </div>
            <div class="mb-3">
                <label for="proj-slug" class="form-label">Slug</label>
                <input id="proj-slug" type="text" name="project[slug]" class="form-control" :value="project.slug" />
            </div>
            <div class="mb-3">
                <label for="proj-description" class="form-label">Description</label>
                <input id="proj-description" type="text" name="project[description]" class="form-control" :value="project.description" />
            </div>
            <div class="mb-3">
                <label for="proj-results" class="form-label">Résultats</label>
                <input id="proj-results" type="text" name="project[results]" class="form-control" :value="project.results" />
            </div>
            <div class="mb-3">
                <label for="proj-learnings" class="form-label">Compétences acquises</label>
                <input id="proj-learnings" type="text" name="project[learnings]" class="form-control" :value="project.learnings" />
            </div>
            <div class="mb-3">
                <label for="proj-image" class="form-label">Image</label>
                <input id="proj-image" type="file" name="project[thumbnailFile]" class="form-control" accept="image/*" />
            </div>
            <div class="mb-3">
                <label for="proj-github" class="form-label">GitHub URL</label>
                <input id="proj-github" type="url" name="project[github_url]" class="form-control" :value="project.githubUrl" />
            </div>
            <div class="mb-3">
                <label for="proj-demo" class="form-label">Demo URL</label>
                <input id="proj-demo" type="url" name="project[demo_url]" class="form-control" :value="project.demoUrl" />
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
</template>

<script setup>
defineProps({
    project: { type: Object, default: () => ({}) },
    csrfToken: { type: String, required: true },
    actionUrl: { type: String, required: true },
});
</script>
