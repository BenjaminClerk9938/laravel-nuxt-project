import { Update } from "~/components/AppLatestUpdates.vue";
// import { defineEventHandler, useRuntimeConfig, readBody } from "h3";

export default defineEventHandler(async (event) => {
  const runtimeConfig = useRuntimeConfig();
  const backendUrl = runtimeConfig.public.backendUrl;
  console.log("posts is called");
  // Check the HTTP method
  const method = event.node.req.method;

  if (method === "POST") {
    const { page, order, filter } = await readBody(event);

    let queryFilter = "";
    if (filter) queryFilter += `&filter=${filter}`;
    if (order) queryFilter += `&order=${order}`;

    try {
      const response = await $fetch(
        `${backendUrl}/post/?page=${page}${queryFilter}`,
        {
          method: "get",
        }
      );

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
          cta_url2: `details/?slug=${item.slug}`,
        })) as Update[],
      };
    } catch (error) {
      console.error("Error fetching posts:", error);
      throw createError({
        statusCode: 500,
        statusMessage: "Error fetching posts",
        message: error.message,
      });
    }
  } else {
    // Handle GET requests or return a method not allowed response
    return createError({
      statusCode: 405,
      statusMessage: "Method Not Allowed",
    });
  }
});
