module.exports = {
    content: [
        './resources/views/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './node_modules/flowbite/**/*.js',
    ],
    theme: {
        fontSize: {
            sm: ['12px','14.63px'],
            base: ['16px', '14.4px'],
            lg: ['24px', '21.6px']
        },
        screens:{
            'Android': '360px',
        },
        extend: {
            colors: {
                'sc': {
                    'white-32': 'rgba(255, 255, 255, 0.40)',
                    'white-72': 'rgba(255, 255, 255, 0.72)',
                    'green-32': 'rgba(113, 182, 112, 0.40)',
                    'green-62': 'rgba(113, 182, 112, 0.70)',
                    'stroke-32': 'rgba(240, 240, 240, 70)',
                    'main-font': '#E7EAF2',
                    'font': '#B1B4BE',
                    'button': '#EFEFEF',
                    'gray-text': '#A0A0A0',
                    'form': '#ECECEC',
                    'form-back': '#F3F3F3',
                    'yellow': '#FEE55A',
                    'border': '#ECECEC',
                    'check': '#71B670',
                    'shadow': '#A5ADA9',
                    'almost-black': "#252838",
                    'scroll': '#F0F0F0'
                }
            },
            borderRadius: {
                '12':'12px',
                '20':'20px',
                '28': '28px',
                '36': '36px',
                '44': '44px',
            },
            fontFamily: {
                Montserrat: [' "Montserrat-Medium"'],
                MontserratBold: [' "Montserrat-SemiBold"'],
            },
        },
    },
    plugins: [
        require('flowbite/plugin')
    ],
}
