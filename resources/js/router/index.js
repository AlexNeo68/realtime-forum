import Vue from 'vue';
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import Login from '../components/login/Login.vue'
import Signup from '../components/login/Signup.vue'

const routes = [
    {
        path: '/login',
        component: Login
    },
    {
        path: '/signup',
        component: Signup
    }
]

const router = new VueRouter({
    routes,
    mode: 'history'
})

export default router;
