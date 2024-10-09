<template>
    <router-view></router-view>
  </template>
  
  <script>
  import { createRouter, createWebHistory } from 'vue-router';
  import Home from './components/Home.vue';
  import Login from './components/Login.vue';
  
  const routes = [
    { path: '/', component: Home },
    { path: '/login', component: Login },
  ];
  
  const router = createRouter({
    history: createWebHistory(),
    routes,
  });
  
  export default {
    setup() {
      return { router };
    },
  };
  </script>
  