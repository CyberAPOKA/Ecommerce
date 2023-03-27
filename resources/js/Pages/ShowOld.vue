<template>
  <App>
    <div class="bg-white">
      <div class="pt-6">
        <nav aria-label="Breadcrumb">
          <ol
            role="list"
            class="mx-auto flex max-w-2xl items-center space-x-2 px-4 sm:px-6 lg:max-w-7xl lg:px-8"
          >
            <li>
              <div class="flex items-center">
                <a href="#" class="mr-2 text-sm font-medium text-gray-900">Men</a>
                <svg
                  width="16"
                  height="20"
                  viewBox="0 0 16 20"
                  fill="currentColor"
                  aria-hidden="true"
                  class="h-5 w-4 text-gray-300"
                >
                  <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                </svg>
              </div>
            </li>

            <li>
              <div class="flex items-center">
                <a href="#" class="mr-2 text-sm font-medium text-gray-900">Clothing</a>
                <svg
                  width="16"
                  height="20"
                  viewBox="0 0 16 20"
                  fill="currentColor"
                  aria-hidden="true"
                  class="h-5 w-4 text-gray-300"
                >
                  <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                </svg>
              </div>
            </li>

            <li class="text-sm">
              <a
                href="#"
                aria-current="page"
                class="font-medium text-gray-500 hover:text-gray-600"
                >{{ product.name }}</a
              >
            </li>
          </ol>
        </nav>

        <!-- Image gallery -->
        <div
          class="mx-auto mt-6 max-w-2xl sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:gap-x-8 lg:px-8"
        >
          <div class="aspect-w-3 aspect-h-4 hidden overflow-hidden rounded-lg lg:block">
            <img
              :src="product.image"
              alt="Model wearing plain white basic tee."
              class="h-full w-full object-cover object-center flip-image"
            />
          </div>
          <div class="hidden lg:grid lg:grid-cols-1 lg:gap-y-8">
            <div class="aspect-w-3 aspect-h-2 overflow-hidden rounded-lg">
              <img
                src="https://tailwindui.com/img/ecommerce-images/product-page-02-tertiary-product-shot-01.jpg"
                alt="Model wearing plain black basic tee."
                class="h-full w-full object-cover object-center"
              />
            </div>
            <div class="aspect-w-3 aspect-h-2 overflow-hidden rounded-lg">
              <img
                src="https://tailwindui.com/img/ecommerce-images/product-page-02-tertiary-product-shot-02.jpg"
                alt="Model wearing plain gray basic tee."
                class="h-full w-full object-cover object-center"
              />
            </div>
          </div>
          <div
            class="aspect-w-4 aspect-h-5 sm:overflow-hidden sm:rounded-lg lg:aspect-w-3 lg:aspect-h-4"
          >
            <img
              :src="product.image"
              alt="Model wearing plain white basic tee."
              class="h-full w-full object-cover object-center"
            />
          </div>
        </div>

        <!-- Product info -->
        <div
          class="mx-auto max-w-2xl px-4 pt-10 pb-16 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8 lg:px-8 lg:pt-16 lg:pb-24"
        >
          <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
            <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
              {{ product.name }}
            </h1>
          </div>

          <!-- Options -->
          <div class="mt-4 lg:row-span-3 lg:mt-0">
            <h2 class="sr-only">Product information</h2>
            <p class="text-3xl tracking-tight text-gray-900">${{ product.price }}</p>
            <!-- Reviews -->
            <div class="mt-6">
              <h3 class="sr-only">Reviews</h3>
              <div class="flex items-center">
                <div class="flex items-center">
                  <template v-for="i in 5" :key="i">
                    <svg
                      class="h-5 w-5 flex-shrink-0"
                      viewBox="0 0 20 20"
                      :class="{ 'text-gray-900': i <= stars, 'text-gray-200': i > stars }"
                      fill="currentColor"
                      aria-hidden="true"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                        clip-rule="evenodd"
                      />
                    </svg>
                  </template>
                </div>
                <p class="sr-only">4 out of 5 stars</p>
                <p class="ml-3 text-sm font-medium text-indigo-600 hover:text-indigo-500">
                  {{ numEvaluations }} Avaliações
                </p>
                <p class="ml-3 text-sm font-medium text-slate-900">
                  {{ product.brand }}
                </p>
              </div>
              <p>Este produto foi visualizado {{ product.views }} vezes.</p>
            </div>

            <form class="mt-10" @submit="buyNow">
              <input type="hidden" name="product_id" :value="product.id" />
              <input type="hidden" name="product_slug" :value="product.slug" />
              <!-- Colors -->
              <div>
                <h3 class="text-sm font-medium text-gray-900">Cores</h3>

                <fieldset class="mt-4">
                  <legend class="sr-only">Choose a color</legend>
                  <div class="grid grid-cols-8 gap-2">
                    <template
                      v-for="(color, index) in product.color.split(',')"
                      :key="'color-choice-' + index"
                    >
                      <label
                        class="-m-0.5 relative p-0.5 rounded-full flex items-center justify-center cursor-pointer focus:outline-none ring-gray-400"
                      >
                        <input
                          type="radio"
                          :name="'color-choice-' + index"
                          :value="color"
                          v-model="product.color"
                          class="sr-only"
                          :aria-labelledby="'color-choice-' + index + '-label'"
                        />
                        <span :id="'color-choice-' + index + '-label'" class="sr-only">{{
                          color
                        }}</span>
                        <span
                          aria-hidden="true"
                          :style="{ backgroundColor: color }"
                          class="h-8 w-8 bg-white border border-black border-opacity-10 rounded-full"
                        ></span>
                      </label>
                    </template>
                  </div>
                </fieldset>
              </div>

              <!-- Sizes -->
              <div class="mt-10">
                <div class="flex items-center justify-between">
                  <h3 class="text-sm font-medium text-gray-900">Tamanhos</h3>
                </div>

                <fieldset class="mt-4">
                  <legend class="sr-only">Choose a size</legend>
                  <div class="grid grid-cols-4 gap-4 sm:grid-cols-8 lg:grid-cols-4">
                    <template v-for="size in tamanhosExistentes" :key="size">
                      <label
                        class="group relative border rounded-md py-3 px-4 flex items-center justify-center text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 sm:py-6 bg-white shadow-sm text-gray-900 cursor-pointer"
                      >
                        <input
                          type="radio"
                          :name="'size-choice-' + size"
                          :value="size"
                          class="sr-only"
                          :aria-labelledby="'size-choice-' + size + '-label'"
                        />
                        <span :id="'size-choice-' + size + '-label'">{{ size }}</span>

                        <span
                          class="pointer-events-none absolute -inset-px rounded-md"
                          aria-hidden="true"
                        ></span>
                      </label>
                    </template>

                    <template
                      v-for="size in ['PP', 'P', 'M', 'G', 'GG', 'XGG'].filter(
                        (size) => !tamanhosExistentes.includes(size)
                      )"
                      :key="size"
                    >
                      <label
                        class="group relative border rounded-md py-3 px-4 flex items-center justify-center text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 sm:py-6 bg-gray-50 text-gray-200 cursor-not-allowed"
                      >
                        <input
                          type="radio"
                          :name="'size-choice-' + size"
                          :value="size"
                          disabled
                          class="sr-only"
                          :aria-labelledby="'size-choice-' + size + '-label'"
                        />
                        <span :id="'size-choice-' + size + '-label'">{{ size }}</span>

                        <span
                          aria-hidden="true"
                          class="pointer-events-none absolute -inset-px rounded-md border-2 border-gray-200"
                        >
                          <svg
                            class="absolute inset-0 h-full w-full stroke-2 text-gray-200"
                            viewBox="0 0 100 100"
                            preserveAspectRatio="none"
                            stroke="currentColor"
                          >
                            <line
                              x1="0"
                              y1="100"
                              x2="100"
                              y2="0"
                              vector-effect="non-scaling-stroke"
                            />
                          </svg>
                        </span>
                      </label>
                    </template>
                  </div>
                </fieldset>
              </div>
              <button
                type="submit"
                class="mt-10 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 py-3 px-8 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
              >
                Comprar agora
              </button>
            </form>
          </div>

          <div
            class="py-10 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pt-6 lg:pb-16 lg:pr-8"
          >
            <!-- Description and details -->
            <div>
              <h3 class="sr-only">Description</h3>

              <div class="space-y-6">
                <p class="text-base text-gray-900">
                  {{ product.description }}
                </p>
              </div>
            </div>

            <div class="mt-10">
              <h3 class="text-sm font-medium text-gray-900">Highlights</h3>

              <div class="mt-4">
                <ul role="list" class="list-disc space-y-2 pl-4 text-sm">
                  <li
                    v-for="highlight in product.highlights"
                    :key="highlight.id"
                    class="text-gray-400"
                  >
                    <span class="text-gray-600">{{ highlight.name }}</span>
                  </li>
                </ul>
              </div>
            </div>

            <div class="mt-10">
              <h2 class="text-sm font-medium text-gray-900">Details</h2>

              <div class="mt-4 space-y-6">
                <p class="text-sm text-gray-600">
                  {{ product.details }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </App>
</template>
<script>
import App from "@/Pages/Site/App.vue";
import axios from "axios";

export default {
  props: {
    product: {
      type: Object,
      required: true,
    },
  },
  methods: {
    buyNow() {
      axios
        .post(`/product/${this.product.slug}/payment`, {
          product_id: this.product.id,
          product_slug: this.product.slug,
        })
        .then((response) => {
          console.log(response);
          // fazer algo após o pagamento ser processado
        })
        .catch((error) => {
          console.log(error);
          // tratar erros de pagamento
        });
    },
  },
  computed: {
    tamanhos() {
      return this.product.size.split(",");
    },
    tamanhosExistentes() {
      const sizes = ["PP", "P", "M", "G", "GG", "XGG"];
      return sizes.filter((size) => this.tamanhos.includes(size));
    },
    stars() {
      const evaluations = this.product.evaluations;
      const average =
        evaluations.reduce((total, evaluation) => total + parseInt(evaluation.stars), 0) /
        evaluations.length;
      return Math.round(average);
    },
    numEvaluations() {
      return this.product.evaluations.length;
    },
  },
};
</script>

<style>
.flip-image {
  transform: scaleX(-1);
}
</style>
