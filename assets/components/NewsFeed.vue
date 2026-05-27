<template>
    <div class="news-wrapper">
        <h1 class="news-title">Actualités Tech</h1>
        <p class="news-subtitle">Les dernières nouvelles du monde informatique</p>

        <!-- Barre de recherche -->
        <div class="news-search">
            <input
                v-model="search"
                type="text"
                placeholder="Rechercher un article..."
                class="news-search__input"
            />
            <span v-if="search" class="news-search__count">
                {{ filteredArticles.length }} résultat{{ filteredArticles.length !== 1 ? 's' : '' }}
            </span>
            <button v-if="search" class="news-search__clear" @click="search = ''" title="Effacer">✕</button>
        </div>

        <div v-if="loading" class="news-loading">
            <div class="spinner"></div>
            <span>Chargement des actualités...</span>
        </div>

        <div v-else-if="error" class="news-error">
            Impossible de charger les actualités.
        </div>

        <template v-else>
            <div v-if="filteredArticles.length === 0" class="news-empty">
                Aucun article ne correspond à « {{ search }} ».
            </div>

            <template v-else>
                <div class="news-grid">
                    <a
                        v-for="(article, index) in paginatedArticles"
                        :key="article.link"
                        :href="article.link"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="news-card"
                        :class="`news-card--${((currentPage - 1) * 6 + index) % 3}`"
                    >
                        <div class="news-card__source">{{ article.source }}</div>
                        <h2 class="news-card__title" v-html="highlight(article.title)"></h2>
                        <p class="news-card__description" v-html="highlight(article.description)"></p>
                        <div class="news-card__date">{{ formatDate(article.pubDate) }}</div>
                    </a>
                </div>

                <!-- Pagination -->
                <div v-if="totalPages > 1" class="pagination">
                    <button class="pagination__btn" :disabled="currentPage === 1" @click="goTo(currentPage - 1)">←</button>

                    <button
                        v-for="page in totalPages"
                        :key="page"
                        class="pagination__btn"
                        :class="{ 'pagination__btn--active': page === currentPage }"
                        @click="goTo(page)"
                    >{{ page }}</button>

                    <button class="pagination__btn" :disabled="currentPage === totalPages" @click="goTo(currentPage + 1)">→</button>
                </div>
            </template>
        </template>
    </div>
</template>

<script setup>
import { ref, computed, watch, onMounted } from 'vue';

const props = defineProps({
    apiUrl: { type: String, required: true },
});

const PER_PAGE = 6;

const articles    = ref([]);
const loading     = ref(true);
const error       = ref(false);
const search      = ref('');
const currentPage = ref(1);

// Remet à la page 1 quand la recherche change
watch(search, () => { currentPage.value = 1; });

const filteredArticles = computed(() => {
    const q = search.value.trim().toLowerCase();
    if (!q) return articles.value;
    return articles.value.filter(a =>
        a.title.toLowerCase().includes(q) ||
        a.description.toLowerCase().includes(q)
    );
});

const totalPages = computed(() => Math.ceil(filteredArticles.value.length / PER_PAGE));

const paginatedArticles = computed(() => {
    const start = (currentPage.value - 1) * PER_PAGE;
    return filteredArticles.value.slice(start, start + PER_PAGE);
});

function goTo(page) {
    if (page < 1 || page > totalPages.value) return;
    currentPage.value = page;
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function highlight(text) {
    const q = search.value.trim();
    if (!q) return text;
    const escaped = q.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    return text.replace(new RegExp(`(${escaped})`, 'gi'), '<mark>$1</mark>');
}

onMounted(async () => {
    try {
        const res = await fetch(props.apiUrl);
        if (!res.ok) throw new Error('HTTP ' + res.status);
        articles.value = await res.json();
    } catch {
        error.value = true;
    } finally {
        loading.value = false;
    }
});

function formatDate(dateStr) {
    if (!dateStr) return '';
    const d = new Date(dateStr);
    return d.toLocaleDateString('fr-FR', { day: 'numeric', month: 'long', year: 'numeric' });
}
</script>

<style scoped>
.news-wrapper {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem 1rem;
}

.news-title {
    font-size: 2rem;
    font-weight: 700;
    color: #f1f5f9;
    margin-bottom: 0.5rem;
}

.news-subtitle {
    color: #64748b;
    margin-bottom: 2rem;
    font-size: 0.95rem;
}

/* ── Search ─────────────────────────────────────── */
.news-search {
    position: relative;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 2rem;
}

.news-search__input {
    width: 100%;
    max-width: 480px;
    padding: 0.65rem 1rem;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 0.75rem;
    color: #f1f5f9;
    font-size: 0.95rem;
    outline: none;
    transition: border-color 0.2s;
}

.news-search__input::placeholder { color: #475569; }

.news-search__input:focus {
    border-color: rgba(167, 139, 250, 0.5);
}

.news-search__count {
    font-size: 0.8rem;
    color: #64748b;
}

.news-search__clear {
    background: none;
    border: none;
    color: #64748b;
    cursor: pointer;
    font-size: 0.85rem;
    padding: 0.25rem 0.5rem;
    border-radius: 0.4rem;
    transition: color 0.2s;
}

.news-search__clear:hover { color: #f1f5f9; }

/* ── Empty ──────────────────────────────────────── */
.news-empty {
    color: #64748b;
    padding: 3rem 0;
    font-size: 0.95rem;
}

/* ── Loading ────────────────────────────────────── */
.news-loading {
    display: flex;
    align-items: center;
    gap: 1rem;
    color: #94a3b8;
    padding: 3rem 0;
}

.spinner {
    width: 24px;
    height: 24px;
    border: 3px solid rgba(167, 139, 250, 0.2);
    border-top-color: #a78bfa;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
}

@keyframes spin { to { transform: rotate(360deg); } }

/* ── Error ──────────────────────────────────────── */
.news-error {
    color: #f87171;
    padding: 2rem 0;
}

/* ── Grid ───────────────────────────────────────── */
.news-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 1.25rem;
}

/* ── Card ───────────────────────────────────────── */
.news-card {
    display: flex;
    flex-direction: column;
    gap: 0.6rem;
    padding: 1.5rem;
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 1rem;
    text-decoration: none;
    transition: border-color 0.2s, transform 0.2s, box-shadow 0.2s;
}

.news-card--0 { background: rgba(167, 139, 250, 0.07); border-color: rgba(167, 139, 250, 0.2); }
.news-card--1 { background: rgba(96, 165, 250, 0.07);  border-color: rgba(96, 165, 250, 0.2);  }
.news-card--2 { background: rgba(52, 211, 153, 0.07);  border-color: rgba(52, 211, 153, 0.2);  }

.news-card--0:hover { box-shadow: 0 12px 32px rgba(167, 139, 250, 0.2); border-color: rgba(167, 139, 250, 0.5); }
.news-card--1:hover { box-shadow: 0 12px 32px rgba(96, 165, 250, 0.2);  border-color: rgba(96, 165, 250, 0.5);  }
.news-card--2:hover { box-shadow: 0 12px 32px rgba(52, 211, 153, 0.2);  border-color: rgba(52, 211, 153, 0.5);  }

.news-card:hover {
    transform: translateY(-4px);
}

.news-card__source {
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: #a78bfa;
}

.news-card__title {
    font-size: 1rem;
    font-weight: 600;
    color: #f1f5f9;
    margin: 0;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.news-card__description {
    font-size: 0.85rem;
    color: #94a3b8;
    margin: 0;
    flex: 1;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    line-height: 1.5;
}

.news-card__date {
    font-size: 0.75rem;
    color: #475569;
    margin-top: auto;
}

/* ── Pagination ─────────────────────────────────── */
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 0.5rem;
    margin-top: 2.5rem;
}

.pagination__btn {
    min-width: 38px;
    height: 38px;
    padding: 0 0.75rem;
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 0.6rem;
    color: #94a3b8;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.2s;
}

.pagination__btn:hover:not(:disabled) {
    border-color: rgba(167, 139, 250, 0.4);
    color: #f1f5f9;
}

.pagination__btn--active {
    background: rgba(167, 139, 250, 0.2);
    border-color: rgba(167, 139, 250, 0.5);
    color: #f1f5f9;
    font-weight: 600;
}

.pagination__btn:disabled {
    opacity: 0.3;
    cursor: not-allowed;
}

/* ── Highlight ──────────────────────────────────── */
:deep(mark) {
    background: rgba(167, 139, 250, 0.3);
    color: #f1f5f9;
    border-radius: 0.2rem;
    padding: 0 0.1rem;
}
</style>
