export default defineEventHandler(async (event) => {
    const { slug, chapter } = await readBody(event);

    const runtimeConfig = useRuntimeConfig();
    const backendUrl = runtimeConfig.public.backendUrl;

    const response = await $fetch(`${backendUrl}/post/${slug}/${chapter}/`, {
        method: 'GET',
    });

    const mediaArray = Object.values(response.media)
        .reduce((accumulator, mediaItem) => {
            const { uuid, original_url, order } = mediaItem;
            accumulator.push({ uuid, original_url, order });
            return accumulator;
        }, [])
        .sort((a, b) => a.order - b.order);

    return {
        title: response.info.title,
        next_chapter: response.next_chapter?.number ?? null,
        urls: [response.info.cover, ...mediaArray]
    };
});
