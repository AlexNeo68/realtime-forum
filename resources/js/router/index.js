import Vue from 'vue';
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import Login from '../components/login/Login.vue'
import Logout from '../components/login/Logout.vue'
import Signup from '../components/login/Signup.vue'
import Forum from '../components/forum/Forum.vue'
import QuestionDetail from '../components/forum/QuestionDetail.vue'
import QuestionAsk from '../components/forum/QuestionAsk.vue'
import CategoryCreate from '../components/categories/CategoryCreate.vue'

const routes = [
    {
        path: '/login',
        component: Login
    },
    {
        path: '/logout',
        component: Logout
    },
    {
        path: '/signup',
        component: Signup
    },
    {
        path: '/forum',
        component: Forum,
        name: 'forum',
    },
    {
        path: '/questions/:slug',
        component: QuestionDetail,
        name: 'question-detail',
    },
    {
        path: '/ask',
        component: QuestionAsk,
        name: 'question-ask',
    },
    {
        path: '/category',
        component: CategoryCreate,
        name: 'category-create',
    }
]

const router = new VueRouter({
    routes,
    mode: 'history'
})

export default router;
