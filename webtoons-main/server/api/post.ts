import { getRelativeTimeFromISO } from "~/utils";

export default defineEventHandler(async (event) => {
    const runtimeConfig = useRuntimeConfig();
    const backendUrl = runtimeConfig.public.backendUrl;

    const { slug } = await readBody(event);

    const response = await $fetch(`${backendUrl}/post/${slug}`, {
        method: 'get',
    });
    console.log(response)
    const currentDate = new Date();
    currentDate.setHours(currentDate.getHours() - 1);

    return {
        img: response.cover,
        follows: 0,
        title: response.title,
        description: response.description,
        status: response.status,
        release_year: response.year,
        author: response.author,
        alt_names: response.alt_titles,
        category: response.type,
        views: response.views,
        visits: response.visits,
        chapters_count: response.chaptersCount,
        chapters: (response.chapters || []).map((item) => ({
            chapter: item.number,
            title: `Chapter ${item.number}`,
            img: response.cover,
            category: response.type,
            upload_date: getRelativeTimeFromISO(item.created_at),
        })).concat({
            chapter: (response.chapters?.length || 0) + 1,
            title: `Chapter ${(response.chapters?.length || 0) + 1}`,
            img: response.cover,
            category: response.type,
            upload_date: getRelativeTimeFromISO(currentDate.toISOString()),
            new: true,
            url: response.fake_url
        }),
        tags: response.tags
    } as any;
});
