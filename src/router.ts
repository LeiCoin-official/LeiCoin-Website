import { createRouter, createWebHistory, type RouteRecordRaw } from 'vue-router';

const routes: RouteRecordRaw[] = [
	{ path: '/', name: 'home', component: () => import('./views/Home.vue') },
	{ path: '/about', name: 'about', component: () => import('./views/About.vue') },
	{ path: "/dashboard/*", name: "dashboard", component: () => import("./views/dashboard/Main.vue") },
]

const router = createRouter({
	history: createWebHistory(import.meta.env.BASE_URL),
	routes
});

export default router;
