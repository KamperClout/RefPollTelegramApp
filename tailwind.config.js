//     screens: {
//         'Android': '360px',
//     },

module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        screens:{
            'Android': '360px',
        },
        extend: {
            colors: {
                'blue-variant': {
                    'main-font': '#E7EAF2',
                    'font': '#B1B4BE',
                    'button': '#EFEFEF',
                    'gray-text': '#A0A0A0',
                    'blue-button': '#0047FF',
                }
            },
        },
    },
    plugins: [],
}
