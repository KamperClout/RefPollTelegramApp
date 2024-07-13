//     screens: {
//         'Android': '360px',
//     },

module.exports = {
    content: [
        './resources//*.blade.php',
        './resources//*.js',
        './resources/**/*.vue',
    ],
    theme: {
        screens:{
            'Android': '360px',
        },
        extend: {
            colors: {
                'sc': {
                    'main-font': '#E7EAF2',
                    'font': '#B1B4BE',
                    'button': '#EFEFEF',
                    'gray-text': '#A0A0A0',
                    'blue-button': '#0047FF',
                    'form': '#ECECEC',
                    'form-back': '#F3F3F3',
                    'yellow': '#FEE55A',
                    'border': '#ECECEC',
                    'check': '#71B670',
                }
            },
            spacing: {
                '1': '1px',
                '3': '3.26px',
                '8': '8px',
                '15': '15px',
                '16': '16px',
                '20': '20px',
                '24': '24px',
                '40':'40px',
                '66': '66px',
                '82':'82px',
                '86': '86.14px',
                '117': '117px',
                '178': '178.26px',
                '200':'200px',
                '606': '606px',
            },
            borderRadius: {
                '12':'12px',
                '20':'20px',
                '28': '28px',
                '36': '36px',
                '44': '44px',
            },
            fontFamily: {
                Manrope: ['"Manrope"', "sans-serif"],
                // Montserrat: [' "Montserrat"', "sans-serif"]
            },
        },
    },
    plugins: [],
}
