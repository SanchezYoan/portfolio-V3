import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import './styles/app.css';
import { createApp } from 'vue';
import { MotionPlugin } from '@vueuse/motion';
import { initParticles } from './particles.js';

initParticles();

const componentMap = {
    // User
    Home: () => import('./components/Home.vue'),
    About: () => import('./components/About.vue'),
    ProjectList: () => import('./components/ProjectList.vue'),
    ProjectShow: () => import('./components/ProjectShow.vue'),
    Contact: () => import('./components/Contact.vue'),
    Login: () => import('./components/Login.vue'),
    Profil: () => import('./components/Profil.vue'),
    Register: () => import('./components/Register.vue'),
    NewsFeed: () => import('./components/NewsFeed.vue'),
    // Admin
    AdminProjectList: () => import('./components/admin/projet/AdminProjectList.vue'),
    AdminProjectShow: () => import('./components/admin/projet/AdminProjectShow.vue'),
    AdminProjectEdit: () => import('./components/admin/projet/AdminProjectEdit.vue'),
    AdminAccountList: () => import('./components/admin/account/AdminAccountList.vue'),
    AdminAccountShow: () => import('./components/admin/account/AdminAccountShow.vue'),
    AdminAccountEdit: () => import('./components/admin/account/AdminAccountEdit.vue'),
};

document.addEventListener('DOMContentLoaded', async () => {
    const el = document.getElementById('vue-page');
    if (!el) return;

    const componentName = el.dataset.component;
    const loader = componentMap[componentName];
    if (!loader) return;

    const props = el.dataset.props ? JSON.parse(el.dataset.props) : {};
    const { default: Component } = await loader();
    createApp(Component, props).use(MotionPlugin).mount(el);
});
