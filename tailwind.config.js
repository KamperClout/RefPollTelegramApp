module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
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
    plugins: [],
}
