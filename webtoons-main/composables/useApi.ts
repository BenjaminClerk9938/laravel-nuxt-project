export const useApi = async (endpoint: string, config = {}) => {
    return await $fetch(`/api${endpoint}`, {
        ...config,
    });  // Apunta a la carpeta server/api
}
