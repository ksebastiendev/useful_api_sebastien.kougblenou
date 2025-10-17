import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import RegisterComponent from '@/components/RegisterComponent.vue'
import LoginComponent from '@/components/LoginComponent.vue'
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/auth/register',
      name: 'register',
      component: RegisterComponent,
    },
    {
      path: '/auth/login',
      name: 'login',
      component: LoginComponent,
    },

  ],
})

export default router
