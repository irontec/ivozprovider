import react from "@vitejs/plugin-react";
import { defineConfig, loadEnv } from "vite";
import { createHtmlPlugin } from 'vite-plugin-html'
const path = require('path')

export default ({ mode }) => {

    const basePath = path.resolve(__dirname, './src');
    const env = loadEnv(mode, process.cwd());
    const base = '/brand/';

    return defineConfig({
        base,
        plugins: [
            react({
                exclude: /.*\.tmp$/,
            }),
            createHtmlPlugin({
                inject: {
                    data: {
                      baseUrl: base,
                      buildVersion: env.VITE_BUILD_VERSION,
                    }
                  }
            }),
        ],
        server: {
            host: true,
            port: 3000,
            proxy: {
                '/api': {
                     target: 'https://127.0.0.1/',
                     changeOrigin: true,
                     secure: false,
                     ws: true,
                 }
            },
            watch: {
                ignored: /.*\.tmp$/
            }
        },
        resolve: {
            alias: {
                'store': `${basePath}/store`,
                'entities': `${basePath}/entities`,
                'translations': `${basePath}/translations`,
                'components': `${basePath}/components`,
            },
        },
        define: {
            "process.env.BASE_URL": `"${base}"`
        },
        build: {
            minify: true,
            rollupOptions: {
                output: {
                    manualChunks: (id, { getModuleInfo, getModuleIds }) => {

                        if (id.startsWith('vite/') || id.startsWith('\0vite/')) {
                            // Put the Vite modules and virtual modules (beginning with \0) into a vite chunk.
                            return 'vite';
                        }

                        if (id.includes('/node_modules/')) {
                            return 'vendor';
                        }

                        if (
                            id.includes('ForeignKeyResolver.ts')
                            || id.includes('ForeignKeyGetter.ts')
                            || id.includes('Form.ts')
                            || id.includes('SelectOptions.ts')
                            || id.includes('/SelectOptions/')
                        ) {
                            return 'app-async';
                        }

                        return;
                    },
                }
            }
        },
    })
}