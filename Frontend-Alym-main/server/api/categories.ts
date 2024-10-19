export default defineEventHandler(async (event) => {
    const { public: { backendUrl } } = useRuntimeConfig();

    const response = await $fetch(`${backendUrl}/post/tags`, {
        method: 'GET',
    });

    return response.map(item => ({
        slug: item.slug,
        name: item.name,
        id: item.uuid,
    }));
});
