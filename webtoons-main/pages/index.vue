<template>
  <div class="bg-dark">
    <AppBanner />
    <AppTopPosts />
    <div class="flex flex-col lg:flex-row w-full">
      <AppLatestUpdates :items="latestUpdates"  :loading="loadingUpdates" class="w-full" @go-to="page => getLatestUpdates(page)"/>
      <AppTrending />
    </div>
  </div>
</template>

<script setup lang="ts">
const latestUpdates = ref()
const loadingUpdates = ref(true)

const filter = useState('filter')

const getLatestUpdates = async (page = 1, order = 'asc')  => {
  latestUpdates.value = await $fetch(`http://localhost:8000/post/?page=${page}order=${order}`);

}



watch(filter, (newVal, oldVal) => {
 getLatestUpdates(newVal, newVal == oldVal ? 'asc' : 'desc')
})

onMounted(() => {
  getLatestUpdates();
})


</script>

<style scoped></style>