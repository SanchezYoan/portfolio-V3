<template>
  <section class="skills-section">

    <div
      v-motion
      :initial="{ opacity: 0, y: -20 }"
      :enter="{ opacity: 1, y: 0, transition: { duration: 600 } }"
      class="skills-title"
    >
      <h2>Ce que je fais</h2>
      <p class="skills-subtitle">Trois domaines, une vision</p>
    </div>

    <div class="skills-grid">
      <div
        v-for="(skill, index) in skills"
        :key="skill.id"
        class="skill-card"
        :class="[`skill-card--${skill.id}`, { 'skill-card--active': activeIndex >= index }]"
      >
        <!-- Icône -->
        <div class="skill-card__icon" :class="{ 'icon--visible': activeIndex >= index }">
          <component :is="skill.icon" :size="40" :stroke-width="1.5" />
        </div>

        <!-- Titre avec effet typing -->
        <h3 class="skill-card__title">
          <span v-if="activeIndex > index">{{ skill.title }}</span>
          <span v-else-if="activeIndex === index" class="typing-text">
            {{ typedText }}<span class="cursor" :class="{ 'cursor--blink': isTypingDone }">|</span>
          </span>
          <span v-else class="title-placeholder">&nbsp;</span>
        </h3>

        <!-- Contenu révélé après typing -->
        <transition name="reveal">
          <div v-if="activeIndex > index || (activeIndex === index && isTypingDone)">
            <p class="skill-card__desc">{{ skill.description }}</p>
            <ul class="skill-card__tags">
              <li
                v-for="(tag, ti) in skill.tags"
                :key="tag"
                class="skill-tag"
                :style="{ transitionDelay: `${ti * 80}ms` }"
              >
                {{ tag }}
              </li>
            </ul>
          </div>
        </transition>
      </div>
    </div>

  </section>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { Server, Code2, Container } from 'lucide-vue-next';

const skills = [
  {
    id: 'sysadmin',
    icon: Server,
    title: 'Admin Sys',
    description: 'Gestion et sécurisation des infrastructures, maintenance des serveurs Linux, supervision et automatisation des systèmes.',
    tags: ['Linux', 'Nginx', 'SSH', 'Monitoring'],
  },
  {
    id: 'fullstack',
    icon: Code2,
    title: 'Dev Fullstack',
    description: 'Conception et développement d\'applications web complètes, du back-end robuste aux interfaces modernes et réactives.',
    tags: ['Symfony', 'Vue.js', 'MySQL', 'REST API'],
  },
  {
    id: 'devops',
    icon: Container,
    title: 'DevOps',
    description: 'Mise en place de pipelines CI/CD, conteneurisation des applications et déploiement continu en environnement de production.',
    tags: ['Docker', 'GitLab CI', 'GitHub Actions', 'Git'],
  },
];

const activeIndex  = ref(-1);
const typedText    = ref('');
const isTypingDone = ref(false);

const TYPING_SPEED  = 80;   // ms par caractère
const PAUSE_AFTER   = 600;  // pause avant de passer à la carte suivante
const START_DELAY   = 500;  // délai initial

function typeCard(index) {
  if (index >= skills.length) return;

  activeIndex.value  = index;
  typedText.value    = '';
  isTypingDone.value = false;

  const title = skills[index].title;
  let charIndex = 0;

  const interval = setInterval(() => {
    typedText.value += title[charIndex];
    charIndex++;

    if (charIndex === title.length) {
      clearInterval(interval);
      isTypingDone.value = true;
      setTimeout(() => typeCard(index + 1), PAUSE_AFTER);
    }
  }, TYPING_SPEED);
}

onMounted(() => {
  setTimeout(() => typeCard(0), START_DELAY);
});
</script>

<style scoped>
.skills-section {
  padding: 4rem 1.5rem;
  max-width: 1100px;
  margin: 0 auto;
}

.skills-title {
  text-align: center;
  margin-bottom: 3rem;
}

.skills-title h2 {
  font-size: 2.2rem;
  font-weight: 700;
  background: linear-gradient(135deg, #a78bfa, #60a5fa);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  margin-bottom: 0.5rem;
}

.skills-subtitle {
  color: #94a3b8;
  font-size: 1rem;
  letter-spacing: 0.05em;
}

/* Grid */
.skills-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.5rem;
}

@media (max-width: 768px) {
  .skills-grid { grid-template-columns: 1fr; }
}

/* Glassmorphism card */
.skill-card {
  background: rgba(255, 255, 255, 0.03);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border: 1px solid rgba(255, 255, 255, 0.06);
  border-radius: 1.25rem;
  padding: 2rem 1.5rem;
  min-height: 280px;
  transition: background 0.5s ease, border-color 0.5s ease, box-shadow 0.5s ease;
}

.skill-card--active {
  background: rgba(255, 255, 255, 0.06);
  border-color: rgba(255, 255, 255, 0.12);
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
}

.skill-card--sysadmin.skill-card--active { box-shadow: 0 8px 32px rgba(167, 139, 250, 0.15); border-top: 3px solid #a78bfa; }
.skill-card--fullstack.skill-card--active { box-shadow: 0 8px 32px rgba(96, 165, 250, 0.15); border-top: 3px solid #60a5fa; }
.skill-card--devops.skill-card--active    { box-shadow: 0 8px 32px rgba(52, 211, 153, 0.15); border-top: 3px solid #34d399; }

.skill-card--sysadmin .skill-card__icon { color: #a78bfa; }
.skill-card--fullstack .skill-card__icon { color: #60a5fa; }
.skill-card--devops .skill-card__icon    { color: #34d399; }

/* Icône */
.skill-card__icon {
  font-size: 2.5rem;
  margin-bottom: 1rem;
  opacity: 0;
  transform: scale(0.5);
  transition: opacity 0.4s ease, transform 0.4s ease;
}

.icon--visible {
  opacity: 1;
  transform: scale(1);
}

/* Titre */
.skill-card__title {
  font-size: 1.3rem;
  font-weight: 700;
  color: #f1f5f9;
  margin-bottom: 0.75rem;
  min-height: 2rem;
}

.title-placeholder { opacity: 0; }

/* Curseur clignotant */
.cursor {
  display: inline-block;
  color: #a78bfa;
  font-weight: 300;
  animation: none;
}

.cursor--blink {
  animation: blink 0.7s step-end infinite;
}

@keyframes blink {
  0%, 100% { opacity: 1; }
  50%       { opacity: 0; }
}

/* Description et tags — transition reveal */
.reveal-enter-active {
  transition: opacity 0.5s ease, transform 0.5s ease;
}
.reveal-enter-from {
  opacity: 0;
  transform: translateY(10px);
}

.skill-card__desc {
  font-size: 0.9rem;
  color: #94a3b8;
  line-height: 1.6;
  margin-bottom: 1.25rem;
}

.skill-card__tags {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
}

.skill-tag {
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid rgba(255, 255, 255, 0.12);
  border-radius: 999px;
  padding: 0.2rem 0.75rem;
  font-size: 0.78rem;
  color: #cbd5e1;
  opacity: 0;
  transform: translateY(6px);
  transition: opacity 0.3s ease, transform 0.3s ease;
  animation: tagAppear 0.3s ease forwards;
}

@keyframes tagAppear {
  to { opacity: 1; transform: translateY(0); }
}
</style>
