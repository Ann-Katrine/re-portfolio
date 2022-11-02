import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'forside',
    component: function () {
      return import('../views/forside.vue')
    }
  },
  {
    path: '/projekt',
    name: 'projekt',
    component: function () {
      return import('../views/projekt.vue')
    }
  },
  {
    path: '/test',
    name: 'test',
    component: function () {
      return import('../views/testsite.vue')
    }
  },
  {
    path: '/test1',
    name: 'test1',
    component: function () {
      return import('../views/testtingting.vue')
    }
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
