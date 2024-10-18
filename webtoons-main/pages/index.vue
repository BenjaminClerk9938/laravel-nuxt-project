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
  latestUpdates.value = await useApi("/posts" , {
    method: "post",
    body: {
      page: page,
      filter: filter.value,
      order
    }
  }).finally(() => {
    loadingUpdates.value = false;
  })
}



watch(filter, (newVal, oldVal) => {
 getLatestUpdates(newVal, newVal == oldVal ? 'asc' : 'desc')
})

onMounted(() => {
  getLatestUpdates();
})


</script>

<style scoped></style>