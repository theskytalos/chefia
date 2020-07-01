import Vue from 'vue'
import VueRouter from 'vue-router';
import App from './App.vue'
import vuetify from './plugins/vuetify';

import Main from './pages/Main.vue';
import Dashboard from './pages/Dashboard.vue';

Vue.use(VueRouter);

const router = new VueRouter({
  routes: [
    {
      path: '/',
      component: Main,
      meta: {
        title: "Pepê Gourmet - Chefia"
      }
    },
    {
      path: '/dashboard',
      component: Dashboard,
      meta: {
        title: "Dashboard - Chefia"
      }
    }
  ]
});

Vue.config.productionTip = false

new Vue({
  vuetify,
  router,
  render: h => h(App)
}).$mount('#app')
