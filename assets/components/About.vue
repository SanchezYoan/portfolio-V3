<template>
  <div class="about-wrapper">

    <!-- Header split layout -->
    <div class="about-hero">

      <!-- Colonne gauche : photo + nom + badges -->
      <div class="about-hero__left">
        <div class="about-avatar">
          <img
            v-if="photoUrl"
            :src="photoUrl"
            alt="Yoan SANCHEZ"
            class="about-avatar__img"
          />
          <span v-else class="about-avatar__initials">YS</span>
        </div>
        <h1 class="about-name">Yoan <span>SANCHEZ</span></h1>
        <p class="about-role">Administrateur d'Infrastructures Sécurisées · DevOps</p>
        <div class="about-badges">
          <span class="badge badge--gray">Linux</span>
          <span class="badge badge--purple">Proxmox</span>
          <span class="badge badge--green">Zabbix</span>
          <span class="badge badge--blue">Docker</span>
          <span class="badge badge--orange">Réseau</span>
          <span class="badge badge--red">Symfony</span>
        </div>
      </div>

      <!-- Colonne droite : texte + bouton CV -->
      <div class="about-hero__right">
        <p class="about-text">
          Spécialisé dans l'administration et la sécurisation des infrastructures, j'ai construit
          mon profil à travers des formations techniques et des projets concrets.
          <br />
          De la supervision d'un parc à l'automatisation des tâches, en passant par le développement
          fullstack — je cherche un poste où mettre cette polyvalence à l'épreuve.
        </p>
        <div class="about-actions">
          <a href="https://www.linkedin.com/in/yoan-san/" target="_blank" rel="noopener" class="btn-social btn-social--linkedin" aria-label="LinkedIn">
            <LinkedinIcon :size="20" />
          </a>
          <a href="https://github.com/SanchezYoan" target="_blank" rel="noopener" class="btn-social btn-social--github" aria-label="GitHub">
            <GithubIcon :size="20" />
          </a>
          <a href="/documents/about/cv_sanchez_yoan.pdf" download class="btn-cv">
            <DownloadIcon :size="18" />
            Télécharger mon CV
          </a>
        </div>
      </div>

    </div>

    <!-- Section compétences animée -->
    <SkillsShowcase />

    <!-- Certifications -->
    <div class="certs-section">
      <h2 class="certs-section__title">Certifications <span>&amp; Diplômes</span></h2>
      <div class="certs-grid">
        <div
          v-for="cert in certifications"
          :key="cert.code"
          class="cert-card"
          :class="{ 'cert-card--wip': cert.status === 'en cours' }"
        >
          <component :is="cert.icon" :size="22" class="cert-card__icon" />
          <div class="cert-card__body">
            <div class="cert-card__code">{{ cert.code }}</div>
            <div class="cert-card__title">{{ cert.title }}</div>
          </div>
          <span class="cert-card__status" :class="cert.status === 'en cours' ? 'is-wip' : 'is-done'">
            {{ cert.status === 'en cours' ? 'En cours' : 'Obtenue' }}
          </span>
        </div>
      </div>
    </div>

  </div>
</template>

<script setup>
import SkillsShowcase from './SkillsShowcase.vue';
import {
  Download as DownloadIcon,
  Linkedin as LinkedinIcon,
  Github as GithubIcon,
  Award as AwardIcon,
  Clock as ClockIcon,
  GraduationCap as GradIcon,
} from 'lucide-vue-next';

const photoUrl = "/documents/about/profil.png";

const certifications = [
  { code: 'BTS SIO SISR', title: 'Services Informatiques aux Organisations', status: 'obtenue', icon: GradIcon },
  { code: 'AZ-900', title: 'Azure Fundamentals', status: 'obtenue', icon: AwardIcon },
  { code: 'AZ-204', title: 'Azure Developer Associate', status: 'obtenue', icon: AwardIcon },
  { code: 'AZ-400', title: 'Azure DevOps Engineer Expert', status: 'en cours', icon: ClockIcon },
];
</script>

<style scoped>
.about-wrapper {
  max-width: 1100px;
  margin: 0 auto;
  padding: 2rem 1.5rem;
}

/* ── Hero ──────────────────────────────────────── */
.about-hero {
  display: grid;
  grid-template-columns: 280px 1fr;
  gap: 3rem;
  align-items: center;
  background: rgba(255, 255, 255, 0.04);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 1.5rem;
  padding: 2.5rem;
  margin-bottom: 3rem;
}

@media (max-width: 768px) {
  .about-hero {
    grid-template-columns: 1fr;
    text-align: center;
    padding: 1.75rem;
  }
  .about-hero__left {
    align-items: center;
  }
  .about-badges {
    justify-content: center;
  }
  .about-actions {
    justify-content: center;
  }
  .btn-cv {
    margin: 0 auto;
  }
}

/* ── Colonne gauche ────────────────────────────── */
.about-hero__left {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 1rem;
}

/* Avatar */
.about-avatar {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  overflow: hidden;
  border: 3px solid rgba(167, 139, 250, 0.5);
  box-shadow: 0 0 30px rgba(167, 139, 250, 0.2);
  background: linear-gradient(135deg, #a78bfa22, #60a5fa22);
  display: flex;
  align-items: center;
  justify-content: center;
}

.about-avatar__img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.about-avatar__initials {
  font-size: 2.2rem;
  font-weight: 700;
  background: linear-gradient(135deg, #a78bfa, #60a5fa);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

/* Nom */
.about-name {
  font-size: 1.7rem;
  font-weight: 700;
  color: #f1f5f9;
  margin: 0;
  line-height: 1.2;
}

.about-name span {
  background: linear-gradient(135deg, #a78bfa, #60a5fa);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

/* Rôle */
.about-role {
  color: #64748b;
  font-size: 0.9rem;
  letter-spacing: 0.05em;
  margin: 0;
}

/* Badges */
.about-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
}

.badge {
  padding: 0.25rem 0.75rem;
  border-radius: 999px;
  font-size: 0.78rem;
  font-weight: 500;
  border: 1px solid;
}

.badge--purple { color: #a78bfa; border-color: #a78bfa44; background: #a78bfa11; }
.badge--blue   { color: #60a5fa; border-color: #60a5fa44; background: #60a5fa11; }
.badge--green  { color: #34d399; border-color: #34d39944; background: #34d39911; }
.badge--gray   { color: #94a3b8; border-color: #94a3b844; background: #94a3b811; }
.badge--red    { color: #f87171; border-color: #f8717144; background: #f8717111; }
.badge--orange { color: #fb923c; border-color: #fb923c44; background: #fb923c11; }

/* ── Colonne droite ────────────────────────────── */
.about-hero__right {
  display: flex;
  flex-direction: column;
  gap: 2rem;
}

.about-text {
  color: #94a3b8;
  font-size: 1rem;
  line-height: 1.8;
  margin: 0;
}

/* Bouton CV */
.btn-cv {
  display: inline-flex;
  align-items: center;
  gap: 0.6rem;
  padding: 0.75rem 1.5rem;
  border-radius: 0.75rem;
  background: linear-gradient(135deg, #a78bfa, #60a5fa);
  color: #fff;
  font-weight: 600;
  font-size: 0.9rem;
  text-decoration: none;
  width: fit-content;
  transition: opacity 0.2s ease, transform 0.2s ease;
}

.btn-cv:hover {
  opacity: 0.9;
  transform: translateY(-2px);
}

/* Actions row */
.about-actions {
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.btn-social {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 42px;
  height: 42px;
  border-radius: 0.75rem;
  border: 1px solid rgba(255, 255, 255, 0.12);
  background: rgba(255, 255, 255, 0.05);
  color: #94a3b8;
  text-decoration: none;
  transition: color 0.2s ease, border-color 0.2s ease, background 0.2s ease, transform 0.2s ease;
}

.btn-social:hover {
  transform: translateY(-2px);
}

.btn-social--linkedin:hover {
  color: #0a66c2;
  border-color: #0a66c2;
  background: rgba(10, 102, 194, 0.1);
}

.btn-social--github:hover {
  color: #f1f5f9;
  border-color: rgba(241, 245, 249, 0.4);
  background: rgba(241, 245, 249, 0.08);
}

/* ── Certifications ────────────────────────────── */
.certs-section {
  margin-top: 3rem;
}

.certs-section__title {
  font-size: 1.4rem;
  font-weight: 700;
  color: #f1f5f9;
  margin-bottom: 1.5rem;
}

.certs-section__title span {
  background: linear-gradient(135deg, #a78bfa, #60a5fa);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.certs-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1rem;
}

@media (max-width: 768px) {
  .certs-grid { grid-template-columns: 1fr; }
}

.cert-card {
  display: flex;
  align-items: center;
  gap: 0.85rem;
  background: rgba(255, 255, 255, 0.04);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 1rem;
  padding: 1.1rem 1.25rem;
  transition: border-color 0.2s ease, background 0.2s ease;
}

.cert-card:hover {
  border-color: rgba(52, 211, 153, 0.4);
  background: rgba(52, 211, 153, 0.05);
}

.cert-card--wip:hover {
  border-color: rgba(251, 191, 36, 0.4);
  background: rgba(251, 191, 36, 0.05);
}

.cert-card__icon {
  color: #34d399;
  flex-shrink: 0;
}

.cert-card--wip .cert-card__icon {
  color: #fbbf24;
}

.cert-card__body {
  flex: 1;
  min-width: 0;
}

.cert-card__code {
  font-size: 1rem;
  font-weight: 700;
  color: #f1f5f9;
}

.cert-card__title {
  font-size: 0.78rem;
  color: #94a3b8;
  line-height: 1.3;
}

.cert-card__status {
  font-size: 0.68rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.04em;
  padding: 0.2rem 0.55rem;
  border-radius: 999px;
  flex-shrink: 0;
}

.cert-card__status.is-done {
  color: #34d399;
  border: 1px solid rgba(52, 211, 153, 0.35);
  background: rgba(52, 211, 153, 0.1);
}

.cert-card__status.is-wip {
  color: #fbbf24;
  border: 1px solid rgba(251, 191, 36, 0.35);
  background: rgba(251, 191, 36, 0.1);
}
</style>
