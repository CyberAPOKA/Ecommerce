<script setup>
import App from "@/Pages/Site/App.vue";
import axios from "axios";
import { reactive } from "vue";
import PixComponent from "../Pages/Payments/PicPay/Pix.vue";
import { Head, Link } from "@inertiajs/vue3";

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  laravelVersion: String,
  phpVersion: String,
});
const state = reactive({
  products: [],
});

axios.get("/api/products").then((response) => {
  state.products = response.data;
});
</script>

<template>
  <App :canLogin="canLogin" :canRegister="canRegister">
    <div class="bg-white">
      <div class="mx-auto max-w-2xl py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
        <h2 class="text-2xl font-bold tracking-tight text-gray-900">
          Customers also purchased
        </h2>

        <div
          class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8"
        >
          <div v-for="product in state.products" :key="product.id" class="group relative">
            <div
              class="min-h-80 aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md bg-gray-200 group-hover:opacity-75 lg:aspect-none lg:h-80"
            >
              <img
                :src="product.image"
                class="h-full w-full object-cover object-center lg:h-full lg:w-full"
              />
            </div>
            <div class="mt-4 flex justify-between">
              <div>
                <h3 class="text-sm text-gray-700">
                  <a :href="route('product.show', { slug: product.name })">
                    <span aria-hidden="true" class="absolute inset-0" />
                    {{ product.name }}
                  </a>
                </h3>
                <!-- <p class="mt-1 text-sm text-gray-500">{{ product.color }}</p> -->
              </div>
              <p class="text-sm font-medium text-gray-900">
                <span>$</span>{{ product.price }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </App>
</template>
