import Vue from 'vue'
import VueRouter from 'vue-router'

// import Home from "../views/Home";
import SignIn from '../views/sign/sign-in.vue'
import SignUp from '../views/sign/sign-up'
import Logout from '../views/sign/logout'

import Jobs from '../views/jobs/index'
import ViewJob from '../views/jobs/view'
import CreateJob from '../views/jobs/create'
import EditJob from '../views/jobs/edit'

import Profile from '../views/profile/index'
import profileEdit from '../views/profile/edit'
import UserJobs from '../views/profile/jobs'

import NotFound from '../views/notFound'

Vue.use(VueRouter)

const routes = [
  // {
  //   path: "/",
  //   name: "Home",
  //   component: Home
  // },
  {
    path: '/sign-in',
    name: 'signIn',
    component: SignIn,
    meta: { forvisitors: true }
  },
  {
    path: '/sign-up',
    name: 'signUp',
    component: SignUp,
    meta: { forvisitors: true }
  },
  {
    path: '/logout',
    name: 'logout',
    component: Logout,
    meta: { forAuth: true }
  },
  {
    path: '/',
    name: 'Home',
    component: Jobs
  },
  {
    path: '/job/view/:id?',
    name: 'job/view',
    component: ViewJob
  },
  {
    path: '/job/create',
    name: 'job/create',
    component: CreateJob,
    meta: { forAuth: true }
  },
  {
    path: '/job/:id/edit',
    name: 'job/edit',
    component: EditJob,
    meta: { forAuth: true }
  },
  {
    path: '/profile/view/:id?',
    name: 'profile/view',
    component: Profile
  },
  {
    path: '/profile/edit',
    name: 'profile/edit',
    component: profileEdit,
    meta: { forAuth: true }
  },
  {
    path: '/profile/jobs',
    name: 'profile/jobs',
    component: UserJobs,
    meta: { forAuth: true }
  },
  {
    path: '*',
    name: 'notFound',
    component: NotFound
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {
  var loggedIn = localStorage.getItem('token')
  // if user authianticated
  if (to.matched.some(record => record.meta.forAuth) && !loggedIn) {
    next('/sign-in')
  } else {
    next()
  }
  // if user dosen't authianticated
  if (to.matched.some(record => record.meta.forvisitors) && loggedIn) {
    next('/')
  } else {
    next()
  }
})

export default router
