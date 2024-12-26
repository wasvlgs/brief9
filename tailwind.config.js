/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./index.php","./pages/**/*.php","./login/**/*.php","./admin/**/*.php","./js/**/*.js"],
  theme: {
    extend: {
      colors:{
        "textSpecial": "#EB3223",
      }
    },
  },
  plugins: [],
}
