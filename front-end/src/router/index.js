import Vue from 'vue'
import Router from 'vue-router'
import Welcome from '@/components/Welcome'
import Cities from '@/components/content/cities'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Welcome',
      component: Welcome
    },
    {
        path: '/city/:id',
        name: 'Cities',
        component: Cities,
        props: true
    }
  ]
})