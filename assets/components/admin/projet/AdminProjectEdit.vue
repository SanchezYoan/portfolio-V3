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
                <textarea id="proj-description" name="project[description]" class="form-control textarea-tall" >{{ project.description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="proj-results" class="form-label">Résultats</label>
                <textarea id="proj-results" name="project[results]" class="form-control textarea-short" >{{ project.results }}</textarea>
            </div>
            <div class="mb-3">
                <label for="proj-learnings" class="form-label">Compétences acquises</label>
                <textarea id="proj-learnings" name="project[learnings]" class="form-control textarea-short" >{{ project.learnings }}</textarea>
            </div>

            <!-- Catégorie -->
            <div class="mb-3">
                <label class="form-label">Catégorie</label>
                <select name="project[category]" class="form-select">
                    <option v-for="cat in categories" :key="cat.value" :value="cat.value" :selected="project.category === cat.value">
                        {{ cat.label }}
                    </option>
                </select>
            </div>

            <!-- Image principale (thumbnail) -->
            <div class="mb-3">
                <label for="proj-image" class="form-label">Image principale (couverture)</label>
                <div v-if="project.thumbnailUrl" class="mb-2">
                    <img :src="project.thumbnailUrl" alt="Image actuelle" style="max-height: 150px; border-radius: 6px; border: 1px solid #dee2e6;" />
                    <p class="text-muted small mt-1">Image actuelle — laissez vide pour la conserver</p>
                </div>
                <input id="proj-image" type="file" name="project[thumbnailFile]" class="form-control" accept="image/*" />
            </div>

            <!-- Galerie d'images -->
            <div class="mb-3">
                <label class="form-label">Galerie d'images</label>

                <!-- Images existantes -->
                <div v-if="galleryImages.length > 0" class="d-flex flex-wrap gap-2 mb-3">
                    <div
                        v-for="img in galleryImages"
                        :key="img.id"
                        class="position-relative"
                        style="display: inline-block;"
                    >
                        <img :src="img.url" alt="Image galerie" style="height: 100px; width: 100px; object-fit: cover; border-radius: 6px; border: 1px solid #dee2e6;" />
                        <button
                            type="button"
                            class="btn btn-danger btn-sm position-absolute top-0 end-0"
                            style="padding: 2px 6px; font-size: 0.7rem; line-height: 1;"
                            @click="deleteImage(img)"
                        >✕</button>
                    </div>
                </div>
                <p v-else class="text-muted small">Aucune image dans la galerie.</p>

                <!-- Upload de nouvelles images -->
                <input
                    type="file"
                    name="new_images[]"
                    class="form-control"
                    accept="image/*"
                    multiple
                />
                <div class="form-text">Vous pouvez sélectionner plusieurs images à la fois.</div>
            </div>

            <!-- Documents -->
            <div class="mb-3">
                <label class="form-label">Documents</label>

                <!-- Documents existants -->
                <div v-if="projectDocuments.length > 0" class="d-flex flex-column gap-2 mb-3">
                    <div
                        v-for="doc in projectDocuments"
                        :key="doc.id"
                        class="d-flex align-items-center justify-content-between p-2"
                        style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 6px;"
                    >
                        <span style="color: #f1f5f9; font-size: 0.9rem;">📄 {{ doc.originalName }}</span>
                        <button
                            type="button"
                            class="btn btn-danger btn-sm"
                            @click="deleteDocument(doc)"
                        >✕</button>
                    </div>
                </div>
                <p v-else class="text-muted small">Aucun document.</p>

                <!-- Upload de nouveaux documents -->
                <input
                    type="file"
                    name="new_documents[]"
                    class="form-control"
                    accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt"
                    multiple
                />
                <div class="form-text">PDF, Word, Excel, PowerPoint... Plusieurs fichiers acceptés.</div>
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

        <!-- Message de feedback suppression -->
        <div v-if="deleteError" class="alert alert-danger mt-3">{{ deleteError }}</div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const categories = [
    { value: 'professionnel', label: 'Professionnel' },
    { value: 'personnel',     label: 'Personnel' },
    { value: 'academique',    label: 'Académique' },
];

const props = defineProps({
    project:    { type: Object, default: () => ({}) },
    csrfToken:  { type: String, required: true },
    actionUrl:  { type: String, required: true },
    images:     { type: Array, default: () => [] },
    documents:  { type: Array, default: () => [] },
});

const galleryImages    = ref([...props.images]);
const projectDocuments = ref([...props.documents]);
const deleteError      = ref('');

async function deleteImage(img) {
    if (!confirm('Supprimer cette image ?')) return;

    try {
        const res = await fetch(`/admin/project/${props.project.id}/image/${img.id}/delete`, { method: 'POST' });
        if (res.ok) {
            galleryImages.value = galleryImages.value.filter(i => i.id !== img.id);
        } else {
            deleteError.value = 'Erreur lors de la suppression.';
        }
    } catch {
        deleteError.value = 'Erreur réseau.';
    }
}

async function deleteDocument(doc) {
    if (!confirm('Supprimer ce document ?')) return;

    try {
        const res = await fetch(`/admin/project/${props.project.id}/document/${doc.id}/delete`, { method: 'POST' });
        if (res.ok) {
            projectDocuments.value = projectDocuments.value.filter(d => d.id !== doc.id);
        } else {
            deleteError.value = 'Erreur lors de la suppression.';
        }
    } catch {
        deleteError.value = 'Erreur réseau.';
    }
}
</script>

<style scoped>
.textarea-tall  { min-height: 260px; resize: vertical; font-size: 0.9rem; line-height: 1.6; }
.textarea-short { min-height: 80px;  resize: vertical; font-size: 0.9rem; line-height: 1.6; }
</style>
