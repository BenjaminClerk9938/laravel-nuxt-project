// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devServer: {
    host: '127.0.0.1',
    port: 3000
  },
  runtimeConfig: {
    public: {
      backendUrl: process.env.BACKEND_URL || 'http://localhost:8000/api'
    }
  },
  compatibilityDate: '2024-04-03',
  devtools: { enabled: true },
  modules: [
    '@nuxtjs/tailwindcss',
    '@nuxtjs/google-fonts',
    '@nuxt/image',
    'nuxt-viewport'
  ],
  googleFonts: {
    download: true,
    families: {
      Anta: true,
      Inter: [100, 200,300,400,500,600,700,800,900]
    }
  }
})