export const useApi = async (endpoint: string, config = {}) => {
  try {
    console.log("useApi is called", endpoint);
    const res = await $fetch(`/api${endpoint}`, {
      ...config,
    });
    console.log("res:", res);
    return res; 
  } catch (error) {
    console.error("API Error:", error); // Log the error for debugging
    // Handle the error appropriately (e.g., display an error message, retry the request)
    throw error; // Re-throw to let the calling component handle it if needed
  }
};
