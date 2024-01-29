import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
  server: {
    host: '127.0.0.1',
    hmr: {
      host: '127.0.0.1'
    },
    port: 3000,
    watch: {
      usePolling: true
    }
  },
  plugins: [
    laravel({
      input: 'resources/js/app.js',
      refresh: true
    }),
    vue({
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: false
        }
      }
    })
  ]
})
