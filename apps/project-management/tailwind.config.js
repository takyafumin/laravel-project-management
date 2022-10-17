const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./app/Types/**/*.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: [
                    "ヒラギノ丸ゴ ProN W4",
                    "Hiragino Maru Gothic ProN",
                    ...defaultTheme.fontFamily.sans,
                ],
            },
        },
    },

    plugins: [require("@tailwindcss/forms")],
};
