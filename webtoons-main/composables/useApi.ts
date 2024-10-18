export const useApi = async (endpoint: string, config = {}) => {
    console.log("useApi is called", endpoint)
    return await $fetch(`/api${endpoint}`, {
        ...config,
    });  // Apunta a la carpeta server/api
}
