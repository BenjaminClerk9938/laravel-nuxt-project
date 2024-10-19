import { getRelativeTimeFromISO } from "~/utils";

export default defineEventHandler(async (event) => {
    const runtimeConfig = useRuntimeConfig();
    const backendUrl = runtimeConfig.public.backendUrl;

    const { search } = await readBody(event);

    const response = await $fetch(`${backendUrl}/post/search`, {
        method: 'POST',
        body: JSON.stringify({ search: search || '' })
    });

    return response.map(item => ({
        title: item.title,
        url: item.fake_url,
        description: item.description,
        uploadedDate: getRelativeTimeFromISO(item.created_at),
        slug: item.slug,
        cover: item.cover
    }));
});
