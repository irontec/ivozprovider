import react from "@vitejs/plugin-react";
import { defineConfig, loadEnv } from "vite";
import { createHtmlPlugin } from 'vite-plugin-html'
const path = require('path')

export default ({ mode }) => {

    const basePath = path.resolve(__dirname, './src');
    const env = loadEnv(mode, process.cwd());
    const base = '/user/';

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
    })
}