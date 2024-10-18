<script setup lang="ts">
export interface Trending {
  chapter: number;
  title: string;
  category: string;
  img: string;
}

const props = defineProps({
  items: {
    type: Array as () => Trending[],
    default: () => {
      return [
        {
          title: "Childhood friends complex",
          category: "Manhwa",
          img: "/trending/1.png"
        },
        {
          title: "Cacio e pasta",
          category: "Manhwa",
          img: "/trending/2.png"
        },
        {
          title: "Cacio e pasta",
          category: "Manhwa",
          img: "/trending/3.png"
        },
        {
          title: "Cacio e pasta",
          category: "Manhwa",
          img: "/trending/4.png"
        },
        {
          title: "Cacio e pasta",
          category: "Manhwa",
          img: "/trending/5.png"
        },
        {
          title: "Cacio e pasta",
          category: "Manhwa",
          img: "/trending/6.png"
        },
        {
          title: "Cacio e pasta",
          category: "Manhwa +18",
          img: "/trending/7.png"
        },
        {
          title: "Cacio e pasta",
          category: "Manhwa +18",
          img: "/trending/8.png"
        },
      ]
    }
  },
  categories: {
    type: Array as () => string[],
    default: () => {
      return ["today", "week", "monthly"]
    }
  },
  showItems: {
    type: Number,
    default: () => 6
  },
  activeCategory: {
    type: String,
    default: "today"
  }
})


defineEmits(["changeCategory"])

const itemsLimit = ref(props.showItems)

</script>


<template>
  <div class="flex flex-col gap-5 text-white px-4 lg:pr-12">
  <div class="pt-[40px] lg:pt-[140px] text-white flex flex-col gap-9">
    <p class="custom-font-1 text-[37px]">Trending</p>
    <div class="flex gap-[11px]">
      <button
          v-for="category in categories"
          @click="$emit('changeCategory', category)"
          :class="['bg-red-1 hover:bg-opacity-40 rounded-[5px] px-[27px] py-[7px]] capitalize custom-font-2', category != activeCategory ? 'bg-red-1 bg-opacity-20 border-red-1 border' : '']"
      >{{ category }}</button>
    </div>
  </div>
  <div :class="['flex flex-col gap-6 border rounded-lg p-4 bg-gray-2', itemsLimit == items.length ? 'mb-4' : '']">
      <template v-for="(item, key) in items">
        <div v-if="key == 0" class="border rounded-md flex-col">
          <NuxtImg :src="item.img" />
          <div class="flex items-center gap-2.5 bg-white-1 text-black px-[25px] py-3.5 custom-font-1">
            <div class="border border-gray-1 rounded-md w-[39px] h-8 flex items-center justify-center">
              {{key + 1}}
            </div>
            <span class="custom-font-1">{{item.title}}</span>
          </div>
        </div>
        <div v-else-if="key < itemsLimit" class="flex gap-5 border border-gray-1 p-2 rounded-md">
          <div class="flex w-full items-center justify-center">
            <NuxtImg :src="item.img" class="h-full" />
            <div class="flex-1 flex flex-col gap-1.5 items-center justify-center">
              <span class="custom-font-2">{{item.title}}</span>

              <button class="bg-red-1 text-white rounded-[5px] px-7 py-1 custom-font-1">
                {{item.category}}
              </button>
            </div>
            <div class="border border-gray-1 rounded-md w-[39px] h-8 flex items-center justify-center">
              {{key + 1}}
            </div>
          </div>
        </div>
      </template>
    </div>


    <button v-if="itemsLimit != items.length" @click="itemsLimit = items.length" class="rounded-lg bg-gray-2 py-[17px] text-white mb-4 custom-font-2 hover:bg-white/80 hover:text-gray-2 transition-all duration-500">
      View All
    </button>
  </div>
</template>



<style scoped>

</style>