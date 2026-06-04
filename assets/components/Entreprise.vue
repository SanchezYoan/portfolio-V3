<template>
  <div class="entreprise-wrapper">

    <!-- Hero -->
    <div class="ent-hero">
      <div class="ent-hero__left">
        <span class="ent-badge">Alternance · BTS SIO SISR</span>
        <h1 class="ent-name">Ngine <span>Innovation</span></h1>
        <p class="ent-tagline">Start-up · Solutions cloud & logiciels</p>
        <div class="ent-meta">
          <span class="ent-meta__item">
            <UsersIcon :size="14" /> &lt; 10 collaborateurs
          </span>
          <span class="ent-meta__item">
            <MapPinIcon :size="14" /> Région Sud
          </span>
        </div>
      </div>
      <div class="ent-hero__right">
        <p class="ent-desc">
          Ngine Innovation conçoit et opère des solutions cloud et logicielles
          pour des acteurs privés et publics : cabinets médicaux <em>(Practicima)</em>,
          mairies de la région et fédérations sportives
          <em>(Fédération Française de Handball)</em>.
        </p>
      </div>
    </div>

    <!-- Missions -->
    <div class="ent-section">
      <h2 class="ent-section__title">Mes <span>missions</span></h2>
      <div class="ent-missions">
        <div v-for="domain in missions" :key="domain.title" class="ent-mission-card">
          <div class="ent-mission-card__header">
            <component :is="domain.icon" :size="18" class="ent-mission-card__icon" />
            <h3 class="ent-mission-card__title">{{ domain.title }}</h3>
          </div>
          <ul class="ent-mission-card__list">
            <li v-for="item in domain.items" :key="item">{{ item }}</li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Journée type -->
    <div class="ent-section">
      <h2 class="ent-section__title">Journée <span>type</span></h2>
      <div class="ent-timeline">
        <div v-for="(step, i) in timeline" :key="i" class="ent-step">
          <div class="ent-step__dot">
            <component :is="step.icon" :size="14" />
          </div>
          <div class="ent-step__content">
            <p class="ent-step__text">{{ step.text }}</p>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script setup>
import {
  Server, Code2, Users, MapPin, Eye, MessageSquare, ListChecks, TestTube2, CheckCircle2,
} from 'lucide-vue-next';

const UsersIcon  = Users;
const MapPinIcon = MapPin;

const missions = [
  {
    icon: Server,
    title: 'Infrastructure & Système',
    items: [
      'Administration de nouvelles machines',
      'Migration de serveurs',
      'Monitoring du parc informatique',
      'Tests en environnement virtuel',
    ],
  },
  {
    icon: Code2,
    title: 'Développement',
    items: [
      'Surveillance des logs en base de données',
      'Développement de nouvelles features (site entreprise)',
      'Mise à jour de sites mairie',
    ],
  },
];

const timeline = [
  { icon: Eye,          text: 'Surveillance des logs et des mails pour détecter toute alerte ou anomalie.' },
  { icon: MessageSquare, text: 'Point d\'équipe sur les avancées et priorisation des tâches.' },
  { icon: ListChecks,   text: 'Exécution des tâches par ordre de priorité.' },
  { icon: TestTube2,    text: 'Tests réalisés par au moins deux collaborateurs avant tout commit.' },
  { icon: CheckCircle2, text: 'Validation par le responsable avant de clôturer la tâche et passer à la suivante.' },
];
</script>

<style scoped>
.entreprise-wrapper {
  max-width: 1100px;
  margin: 0 auto;
  padding: 2rem 1.5rem;
  display: flex;
  flex-direction: column;
  gap: 3rem;
}

/* ── Hero ──────────────────────────────────────── */
.ent-hero {
  display: grid;
  grid-template-columns: 300px 1fr;
  gap: 3rem;
  align-items: center;
  background: rgba(255, 255, 255, 0.04);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 1.5rem;
  padding: 2.5rem;
}

@media (max-width: 768px) {
  .ent-hero { grid-template-columns: 1fr; }
}

.ent-badge {
  display: inline-block;
  font-size: 0.75rem;
  font-weight: 600;
  color: #34d399;
  border: 1px solid rgba(52, 211, 153, 0.3);
  background: rgba(52, 211, 153, 0.08);
  border-radius: 999px;
  padding: 0.25rem 0.75rem;
  margin-bottom: 0.75rem;
}

.ent-name {
  font-size: 1.8rem;
  font-weight: 700;
  color: #f1f5f9;
  margin: 0 0 0.25rem;
}

.ent-name span {
  background: linear-gradient(135deg, #a78bfa, #60a5fa);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.ent-tagline {
  color: #64748b;
  font-size: 0.9rem;
  margin: 0 0 1rem;
}

.ent-meta {
  display: flex;
  flex-wrap: wrap;
  gap: 0.75rem;
}

.ent-meta__item {
  display: flex;
  align-items: center;
  gap: 0.35rem;
  font-size: 0.82rem;
  color: #94a3b8;
}

.ent-desc {
  color: #94a3b8;
  font-size: 1rem;
  line-height: 1.8;
  margin: 0;
}

.ent-desc em {
  color: #cbd5e1;
  font-style: normal;
  font-weight: 500;
}

/* ── Sections ──────────────────────────────────── */
.ent-section__title {
  font-size: 1.4rem;
  font-weight: 700;
  color: #f1f5f9;
  margin: 0 0 1.25rem;
}

.ent-section__title span {
  background: linear-gradient(135deg, #a78bfa, #60a5fa);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

/* ── Missions ──────────────────────────────────── */
.ent-missions {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 1rem;
}

@media (max-width: 640px) {
  .ent-missions { grid-template-columns: 1fr; }
}

.ent-mission-card {
  background: rgba(255, 255, 255, 0.04);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 1rem;
  padding: 1.25rem;
  display: flex;
  flex-direction: column;
  gap: 0.85rem;
  transition: border-color 0.2s, background 0.2s;
}

.ent-mission-card:hover {
  border-color: rgba(52, 211, 153, 0.35);
  background: rgba(52, 211, 153, 0.04);
}

.ent-mission-card__header {
  display: flex;
  align-items: center;
  gap: 0.6rem;
}

.ent-mission-card__icon {
  color: #a78bfa;
  flex-shrink: 0;
}

.ent-mission-card__title {
  font-size: 0.95rem;
  font-weight: 600;
  color: #e2e8f0;
  margin: 0;
}

.ent-mission-card__list {
  margin: 0;
  padding-left: 1.1rem;
  display: flex;
  flex-direction: column;
  gap: 0.35rem;
}

.ent-mission-card__list li {
  font-size: 0.88rem;
  color: #94a3b8;
  line-height: 1.5;
}

/* ── Timeline ──────────────────────────────────── */
.ent-timeline {
  display: flex;
  flex-direction: column;
  gap: 0;
}

.ent-step {
  display: flex;
  gap: 1rem;
  position: relative;
}

.ent-step:not(:last-child)::before {
  content: '';
  position: absolute;
  left: 15px;
  top: 32px;
  bottom: 0;
  width: 1px;
  background: rgba(255, 255, 255, 0.08);
}

.ent-step__dot {
  flex-shrink: 0;
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background: rgba(167, 139, 250, 0.12);
  border: 1px solid rgba(167, 139, 250, 0.3);
  color: #a78bfa;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-top: 0.1rem;
}

.ent-step__content {
  padding-bottom: 1.5rem;
}

.ent-step__text {
  font-size: 0.92rem;
  color: #94a3b8;
  line-height: 1.6;
  margin: 0.35rem 0 0;
}
</style>
