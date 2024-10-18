<script setup lang="ts">
const route = useRoute()

const detail = ref();
const loading = ref<boolean>(true);

const getPostDetails = async () => {
  detail.value = await $fetch(`/api/post`, {
    method: 'POST',
    body: {
      slug: route.params.slug,
    }
  }).finally(() => loading.value = false);
}

onMounted(() => {
  getPostDetails()
})

</script>
<template>
  <div class="w-full">
    <AppDetails :loading="loading" :detail="detail" />
    <AppChapters :loading="loading" :items="detail?.chapters" />
  </div>
</template>


<style scoped>

</style>