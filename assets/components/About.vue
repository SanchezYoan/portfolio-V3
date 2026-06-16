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
        <p class="about-role">Développeur Fullstack · DevOps</p>
        <div class="about-badges">
          <span class="badge badge--purple">Symfony</span>
          <span class="badge badge--green">Vue.js</span>
          <span class="badge badge--red">React.js</span>
          <span class="badge badge--blue">Docker</span>
          <span class="badge badge--orange">Gitlab</span>
          <span class="badge badge--gray">Proxmox</span>
        </div>
      </div>

      <!-- Colonne droite : texte + bouton CV -->
      <div class="about-hero__right">
        <p class="about-text">
          Développeur fullstack avec une vraie culture DevOps, j'ai construit mon profil
          à travers des formations techniques et des projets concrets.
          <br />
          Capable de concevoir
          une application, de la déployer et d'administrer l'infrastructure qui la supporte
          — je cherche un poste où mettre cette polyvalence à l'épreuve.
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

  </div>
</template>

<script setup>
import SkillsShowcase from './SkillsShowcase.vue';
import {
  Download as DownloadIcon,
  Linkedin as LinkedinIcon,
  Github as GithubIcon,
} from 'lucide-vue-next';

const photoUrl = "/documents/about/profil.png";
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
</style>
