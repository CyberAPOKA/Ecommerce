<script setup>
import Header from "@/Pages/Site/Layouts/Header.vue";
import Footer from "@/Pages/Site/Layouts/Footer.vue";
defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  laravelVersion: String,
  phpVersion: String,
});
</script>
<template>
  <Header :canLogin="canLogin" :canRegister="canRegister"></Header>
  <div class="main-content">
    <slot></slot>
  </div>
  <Footer></Footer>
</template>
