import { defineConfig } from 'vite';
import { resolve } from 'path';

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
          'front-js': resolve(__dirname, 'src/js/front.js'),
          'front-css': resolve(__dirname, 'src/sass/style.scss'),

          'back-js': resolve(__dirname, 'src/js/back.js'),
		      'back-css': resolve(__dirname, 'src/sass/back.scss'),

					'editor-js': resolve(__dirname, 'src/js/editor.js'),
		      'editor-css': resolve(__dirname, 'src/sass/editor.scss'),
        },
        output: {
          entryFileNames: 'js/[name]-[hash].js',
          chunkFileNames: 'js/[name]-[hash].js',
          assetFileNames: (assetInfo) => {
            if (assetInfo.name.endsWith('.css')) {
              return 'css/[name]-[hash].css';
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
      cssCodeSplit: true,
      sourcemap: isDev,
      minify: !isDev,
    },

    css: {
      devSourcemap: true,
      preprocessorOptions: {
        scss: {
          api: 'modern',
          /* additionalData: `
            @use "${resolve(__dirname, 'src/sass/variables.scss')}" as *;
            ` */
        },
        sass: {
          api: 'modern',
        }
      }

    },


    server: {
      host: 'localhost',
      port: 5173,
      strictPort: true,
      open: false,
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
