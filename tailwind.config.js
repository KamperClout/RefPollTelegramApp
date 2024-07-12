// module.exports = {
//   theme: {
//     screens: {
//         'Android': '360px',
//     },
//       colors: {
//         'blue-variant': {
//             'main-font': '#E7EAF2',
//             'font': '#B1B4BE',
//             'button': '#EFEFEF',
//             'gray-text': '#0047FF',
//         }
//     }
//   },
// }
//
module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                'blue-variant-main-font': '#E7EAF2',
                'blue-variant-font': '#B1B4BE',
                'blue-variant-button': '#EFEFEF',
                'blue-variant-gray-text': '#0047FF',
            },
        },
    },
    plugins: [],
}
