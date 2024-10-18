import {Update} from "~/components/AppLatestUpdates.vue";

export default defineEventHandler(async (event) => {
    const runtimeConfig = useRuntimeConfig();
    const backendUrl = runtimeConfig.public.backendUrl;

    const { page, order, filter } = await readBody(event)

    let queryFilter = `&filter=${filter}&order=${order}` ?? '';
    console.log('posts is called')
    const response = await $fetch(`${backendUrl}/post/?page=${page}${queryFilter}`, {
        method: 'get',
    });

    return {
        ...response,
        data: response.data.map((item: any) => ({
            id: item.slug,
            title: item.title,
            category: item.category,
            img: `${item.cover}`,
            cta_text1: "Click here!",
            cta_url1: `details/?slug=${item.slug}`,
            cta_text2: "Click here 2!",
            cta_url2: `details/?slug=${item.slug}`
        })) as Update[]
    };
});
