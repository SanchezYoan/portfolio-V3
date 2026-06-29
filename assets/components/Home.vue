<template>
    <div class="home">

        <!-- Hero -->
        <section class="hero">
            <div class="hero__label">✦ Disponible</div>
            <h1 class="hero__title">
                Yoan Sanchez<span class="hero__dot">.</span>
            </h1>
            <p class="hero__role">Administrateur d'Infrastructures Sécurisées<br>&amp; Devops</p>
            <p class="hero__desc">
                En formation d'Administrateur d'Infrastructures Sécurisées, je conçois, déploie et
                supervise des infrastructures fiables — administration systèmes &amp; réseau, monitoring
                et automatisation — avec une solide expérience du développement fullstack.
            </p>
            <div class="hero__cta">
                <a href="/project" class="btn-primary">Voir mes projets</a>
                <a href="/contact" class="btn-ghost">Me contacter</a>
            </div>
        </section>

        <!-- Stack -->
        <section class="stack">
            <p class="stack__label">Stack &amp; outils</p>
            <div class="stack__grid">
                <span v-for="tech in stack" :key="tech" class="stack__badge">{{ tech }}</span>
            </div>
        </section>

        <!-- About teaser (glass card) -->
        <section class="about-teaser">
            <div class="about-teaser__text">
                <h2 class="about-teaser__title">Rigueur technique,<br>vision infrastructure.</h2>
                <p>
                    Je me spécialise dans l'administration des systèmes, les réseaux et
                    le développement fullstack. Mon approche combine code propre et
                    déploiement robuste.
                </p>
                <a href="/about" class="link-arrow">En savoir plus →</a>
            </div>
            <div class="about-teaser__stats">
                <div class="stat">
                    <span class="stat__value">3</span>
                    <span class="stat__label">ans de développement</span>
                </div>
                <div class="stat">
                    <span class="stat__value">RNCP 6</span>
                    <span class="stat__label">Infrastructures Sécurisées</span>
                </div>
                <div class="stat">
                    <span class="stat__value">{{ counter }}%</span>
                    <span class="stat__label">Fullstack</span>
                </div>
            </div>
        </section>

    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const counter = ref(0);

onMounted(() => {
    const duration = 1500;
    const start = performance.now();

    function animate(now) {
        const progress = Math.min((now - start) / duration, 1);
        const eased = 1 - Math.pow(1 - progress, 3);
        counter.value = Math.round(eased * 100);
        if (progress < 1) requestAnimationFrame(animate);
    }

    requestAnimationFrame(animate);
});

const stack = [
    'Linux', 'Proxmox', 'Zabbix', 'Docker', 'Nginx', 'Bash', 'Symfony', 'GitLab CI/CD',
];
</script>

<style scoped>
.home {
    display: flex;
    flex-direction: column;
    gap: 4rem;
    position: relative;
}

.hero, .stack, .about-teaser {
    position: relative;
    z-index: 1;
}


/* ── Hero ───────────────────────────────────────── */
.hero {
    padding-top: 3rem;
}

.hero__label {
    display: inline-block;
    font-family: var(--font-body);
    font-size: 0.8rem;
    font-weight: 600;
    letter-spacing: 0.05em;
    color: var(--color-accent);
    background: rgba(167, 139, 250, 0.1);
    border: 1px solid rgba(167, 139, 250, 0.3);
    padding: 0.25rem 0.85rem;
    border-radius: 999px;
    margin-bottom: 1.5rem;
}

.hero__title {
    font-family: var(--font-heading);
    font-size: clamp(2.5rem, 6vw, 4rem);
    font-weight: 800;
    letter-spacing: -0.04em;
    color: #fff;
    margin: 0 0 0.25rem;
    line-height: 1.05;
}

.hero__dot {
    background: linear-gradient(135deg, var(--color-accent), var(--color-accent-2));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.hero__role {
    font-family: var(--font-heading);
    font-size: clamp(1.1rem, 2.5vw, 1.4rem);
    font-weight: 400;
    color: rgba(255, 255, 255, 0.45);
    margin: 0 0 1.5rem;
    line-height: 1.4;
}

.hero__desc {
    font-size: 1rem;
    color: rgba(255, 255, 255, 0.4);
    max-width: 560px;
    line-height: 1.75;
    margin: 0 0 2rem;
}

.hero__cta {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.btn-primary {
    font-family: var(--font-body);
    font-size: 0.9rem;
    font-weight: 600;
    background: linear-gradient(135deg, #7c3aed, #2563EB);
    color: #fff;
    padding: 0.7rem 1.5rem;
    border-radius: 10px;
    cursor: pointer;
    transition: opacity 0.2s ease, transform 0.15s ease;
}

.btn-primary:hover {
    opacity: 0.88;
    transform: translateY(-1px);
}

.btn-ghost {
    font-family: var(--font-body);
    font-size: 0.9rem;
    font-weight: 500;
    background: var(--glass-bg);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    color: rgba(255, 255, 255, 0.65);
    padding: 0.7rem 1.5rem;
    border-radius: 10px;
    border: 1px solid var(--glass-border);
    cursor: pointer;
    transition: background 0.2s ease, color 0.2s ease;
}

.btn-ghost:hover {
    background: var(--glass-bg-hover);
    color: #fff;
}

/* ── Stack ──────────────────────────────────────── */
.stack__label {
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    color: rgba(255, 255, 255, 0.25);
    margin: 0 0 1rem;
}

.stack__grid {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.stack__badge {
    font-family: var(--font-body);
    font-size: 0.85rem;
    font-weight: 500;
    color: rgba(255, 255, 255, 0.65);
    background: var(--glass-bg);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    border: 1px solid var(--glass-border);
    padding: 0.3rem 0.85rem;
    border-radius: 8px;
    transition: background 0.2s ease, color 0.2s ease, border-color 0.2s ease;
}

.stack__badge:hover {
    background: var(--glass-bg-hover);
    color: #fff;
    border-color: rgba(167, 139, 250, 0.3);
}

/* ── About teaser (glass card) ──────────────────── */
.about-teaser {
    background: var(--glass-bg);
    backdrop-filter: var(--glass-blur);
    -webkit-backdrop-filter: var(--glass-blur);
    border: 1px solid var(--glass-border);
    border-radius: 16px;
    padding: 2.5rem;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    align-items: center;
}

.about-teaser__title {
    font-size: clamp(1.4rem, 3vw, 1.9rem);
    font-weight: 700;
    letter-spacing: -0.02em;
    color: #fff;
    margin: 0 0 1rem;
}

.about-teaser__text p {
    color: rgba(255, 255, 255, 0.45);
    line-height: 1.75;
    margin: 0 0 1.25rem;
}

.link-arrow {
    font-weight: 600;
    font-size: 0.9rem;
    color: var(--color-accent);
    transition: color 0.2s ease;
}

.link-arrow:hover {
    color: var(--color-accent-hover);
    text-decoration: underline;
}

.about-teaser__stats {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    padding-left: 2rem;
    border-left: 1px solid var(--glass-border);
}

.stat__value {
    display: block;
    font-family: var(--font-heading);
    font-size: 2rem;
    font-weight: 800;
    background: linear-gradient(135deg, var(--color-accent), var(--color-accent-2));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    letter-spacing: -0.04em;
}

.stat__label {
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.3);
}

/* ── Responsive ─────────────────────────────────── */
@media (max-width: 640px) {
    .about-teaser {
        grid-template-columns: 1fr;
        padding: 1.75rem;
    }
    .about-teaser__stats {
        padding-left: 0;
        border-left: none;
        border-top: 1px solid var(--glass-border);
        padding-top: 1.5rem;
        flex-direction: row;
        flex-wrap: wrap;
        gap: 1.5rem 2rem;
    }
}
</style>
