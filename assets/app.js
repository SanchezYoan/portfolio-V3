import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import './styles/app.css';
import { createApp } from 'vue';

const componentMap = {
    Home: () => import('./components/Home.vue'),
    About: () => import('./components/About.vue'),
    ProjectList: () => import('./components/ProjectList.vue'),
    ProjectShow: () => import('./components/ProjectShow.vue'),
    Contact: () => import('./components/Contact.vue'),
    Login: () => import('./components/Login.vue'),
    Profil: () => import('./components/Profil.vue'),
    Register: () => import('./components/Register.vue'),
    AdminProjectList: () => import('./components/admin/AdminProjectList.vue'),
    AdminProjectShow: () => import('./components/admin/AdminProjectShow.vue'),
    AdminProjectEdit: () => import('./components/admin/AdminProjectEdit.vue'),
};

document.addEventListener('DOMContentLoaded', async () => {
    const el = document.getElementById('vue-page');
    if (!el) return;

    const componentName = el.dataset.component;
    const loader = componentMap[componentName];
    if (!loader) return;

    const props = el.dataset.props ? JSON.parse(el.dataset.props) : {};
    const { default: Component } = await loader();
    createApp(Component, props).mount(el);
});
