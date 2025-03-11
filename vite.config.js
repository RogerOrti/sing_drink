import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/app.scss",
                "resources/js/app.js",
                "resources/css/erfan.css",
                "resources/css/style.css",
                "resources/css/pablo.css",
                "resources/js/main.js",
            ],
            refresh: true,
        }),
    ],
});
