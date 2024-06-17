/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./assets/**/*.js", "./templates/**/*.html.twig"],
  theme: {
    extend: {
      width: {
        "640": "640px",
      },
      height: {
        "360": "360px",
      },
    },
  },
  plugins: [],
};
