// vite.config.js
import { defineConfig } from 'vite';
import { resolve } from 'path';
import { glob } from 'glob';

export default defineConfig(({ mode }) => {
  const isDev = mode === 'development';

  return {
    base: './',

    build: {
      outDir: 'build',
      emptyOutDir: true,
      manifest: true,
      rollupOptions: {
        input: {
          main: resolve(__dirname, 'src/js/front.js'),
          back: resolve(__dirname, 'src/js/back.js'),
		  editor: resolve(__dirname, 'src/js/editor.js'),
          style: resolve(__dirname, 'src/sass/style.scss'),
        },
        output: {
          entryFileNames: 'js/[name].js',
          chunkFileNames: 'js/[name]-[hash].js',
          assetFileNames: (assetInfo) => {
            if (assetInfo.name.endsWith('.css')) {
              return 'css/[name].css';
            }
            if (/\.(png|jpe?g|svg|gif|webp)$/.test(assetInfo.name)) {
              return 'images/[name].[ext]';
            }
            if (/\.(woff2?|eot|ttf|otf)$/.test(assetInfo.name)) {
              return 'fonts/[name].[ext]';
            }
            return 'assets/[name].[ext]';
          }
        }
      },
      cssCodeSplit: false,
      sourcemap: isDev,
      minify: !isDev,
    },

    css: {
      devSourcemap: true,
      preprocessorOptions: {
        scss: {
          additionalData: `@import "${resolve(__dirname, 'dev/sass/_0-settings.scss')}";`
        }
      }
    },

    server: {
      host: 'localhost',
      port: 3000,
      strictPort: true,
      open: false,
      cors: true,
      hmr: {
        host: 'nicolas-lebrun.local',
        protocol: 'ws',
      },
    },

    plugins: [
      {
        name: 'watch-php',
        handleHotUpdate({ file, server }) {
          if (file.endsWith('.php')) {
            server.ws.send({
              type: 'full-reload',
              path: '*'
            });
          }
        }
      }
    ]
  };
});
