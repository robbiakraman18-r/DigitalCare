module.exports = {
  content: [
    "./resources//**/*.blade.php",
    "./resources//**/*.js",
    "./resources//**/*.vue",
    "./node_modules/flowbite//**/*.js"
  ],
  theme: {
    extends: {},
  },
  plugins: [
    require('flowbite/plugin')
  ],
  content: [
    "./resources/**/*.blade.php",
    "./node_modules/flowbite/**/*.js"
],
plugins: [
    require('flowbite')
]
}
