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
            spacing: {
                '8': '8px',
                '16': '16px',
                '70': '70px',
                '82':'82px',
                '163':'163px',
                '585': '585px'
            },
            borderRadius: {
                'xl': '24px',
                '2xl': '36px',
                '3xl': '44px',

            },
            fontFamily: {
                'Manrope': ['Manrope']
            }
        },
    },
    plugins: [],
}
