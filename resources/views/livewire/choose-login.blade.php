<div class="flex-col rounded-lg {{--bg-white--}} border-r-yellow-400 flex flex-col items-center justify-center min-h-screen">
    <script src="https://telegram.org/js/telegram-web-app.js?56"></script>
    <script>

        if (window.Telegram.WebApp.platform == "weba") {
            var body = document.createElement('body')
            var content = document.createElement('div')
            body.appendChild(content)
            content.style = 'margin: 15px'
            content.innerText = 'Ошибка: вход возможен только из десктоп/мобильного приложения'
            document.querySelector('body').replaceWith(content);
        } else {
            async function checkConsentGiven() {
                try {
                    const response = await fetch('{{ route('check-consent') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            tg_id: window.Telegram.WebApp.initDataUnsafe.user.id
                        })
                    });
                    const data = await response.json();
                    return data.consent_given;
                } catch (error) {
                    console.error('Ошибка при проверке согласия:', error);
                    return false;
                }
            }
            function requestPhoneNumber() {
                return new Promise((resolve) => {
                    Telegram.WebApp.showPopup({
                        title: 'Требуется номер телефона',
                        message: 'Для продолжения работы приложения необходим ваш номер телефона.',
                        buttons: [
                            {id: 'share', type: 'default', text: 'Поделиться номером'},
                            {id: 'cancel', type: 'destructive', text: 'Отмена'}
                        ]
                    }, function(buttonId) {
                        if (buttonId === 'share') {
                            Telegram.WebApp.requestContact((contact, result) => {
                                try {
                                    const decodedString = decodeURIComponent(result.response)
                                    const params = new URLSearchParams(decodedString);
                                    const contactJSON = params.get('contact');
                                    const contactData = JSON.parse(contactJSON);
                                    if (contact && contactData.phone_number) {
                                        const normalizedPhone = "+" + contactData.phone_number.replace(/[^\d+]/g, '');
                                        resolve(normalizedPhone);
                                    } else {
                                        console.error('Неверный формат контакта:', contact);
                                        Telegram.WebApp.showAlert('Не удалось получить номер телефона. Пожалуйста, попробуйте еще раз.');
                                        resolve(null);
                                    }
                                } catch (e) {
                                    console.error('Ошибка обработки контакта:', e);
                                    Telegram.WebApp.showAlert('Произошла ошибка при обработке номера телефона.');
                                    resolve(null);
                                }
                            });
                        } else {
                            Telegram.WebApp.close();
                            resolve(null);
                        }
                    });
                });
            }

            function requestConsent() {
                return new Promise((resolve) => {
                    Telegram.WebApp.showPopup({
                        title: 'Согласие на обработку данных',
                        message: 'Для продолжения работы приложения необходимо ваше согласие на обработку персональных данных.',
                        buttons: [
                            {id: 'accept', type: 'default', text: 'Принимаю'},
                            {id: 'decline', type: 'destructive', text: 'Отказываюсь'}
                        ]
                    }, function(buttonId) {
                        if (buttonId === 'accept') {

                            fetch('{{ route('save-consent') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    tg_id: window.Telegram.WebApp.initDataUnsafe.user.id,
                                    phone: window.Telegram.WebApp.initDataUnsafe.user.phone_number
                                })
                            }).then(() => resolve(true));
                        } else {
                            Telegram.WebApp.close();
                            resolve(false);
                        }
                    });
                });
            }

            async function main() {
            if (window.Telegram.WebApp.initDataUnsafe.start_param) {
                const params = Object.fromEntries(
                    window.Telegram.WebApp.initDataUnsafe.start_param.split("_").map(p => p.split("="))
                );
                if (params?.inv) {
                    const consentGiven = await checkConsentGiven();
                    let phoneNumber;
                    if (!consentGiven) {
                        phoneNumber = await requestPhoneNumber();
                        if (!phoneNumber) return;
                        const userConsent = await requestConsent();
                        if (!userConsent) return;
                    }
                    let dataToSend = window.Telegram.WebApp.initDataUnsafe.user.id;
                    let username = window.Telegram.WebApp.initDataUnsafe.user.username;
                    fetch('{{ route('get-tg-username') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({data: dataToSend, inv: params.inv, phone: phoneNumber, username:username})
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                console.log('Данные успешно сохранены в сессии.');
                                window.location.replace("{{route('main-page')}}")
                            }
                        })
                        .catch((error) => {
                            console.error('Ошибка:', error);
                        })
                } else if (params?.ank && params?.ref) {
                    if (params?.ank && params?.ref) {
                        window.location.replace("{{ route('survey') }}?ank=" + params.ank + "&ref=" + params.ref);
                    }
                }
            } else
            {
                const consentGiven = await checkConsentGiven();
                let phoneNumber;
                if (!consentGiven) {
                    phoneNumber = await requestPhoneNumber();
                    if (!phoneNumber) return;
                    const userConsent = await requestConsent();
                    if (!userConsent) return;
                }
                let dataToSend = window.Telegram.WebApp.initDataUnsafe.user.id;
                let username = window.Telegram.WebApp.initDataUnsafe.user.username;
                fetch('{{ route('get-tg-username') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({data: dataToSend, phone: phoneNumber, username:username})
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('Данные успешно сохранены в сессии.');
                            window.location.replace("{{route('main-page')}}")
                        }
                    })
                    .catch((error) => {
                        console.error('Ошибка:', error);
                    })
            }}
            main();
        }


    </script>


    <div class="flex flex-col items-center justify-center gap-4 bg-white rounded-2xl" style="width: 80vw">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 110 115">
            <defs>
                <linearGradient id="strokeGradient" x1="100%" y1="100%">
                    <stop offset="0%" stop-color="#f15a31">
                        <animate id="animate-stroke" attributeName="stop-color" dur="6000ms" repeatCount="indefinite"
                                 calcMode="spline" keyTimes="0; .20; .33; .40; .45; .55; .60; .67; .80; 1"
                                 keySplines="0,0,1,1; 0,0,1,1; 0,0,1,1; 0,0,1,1; 0,0,1,1; 0,0,1,1; 0,0,1,1; 0,0,1,1; 0,0,1,1"
                                 values="#f15a31; #ffd31b; #a6ce42; #007ac1; #007ac1; #007ac1; #007ac1; #a6ce42; #ffd31b; #f15a31;"/>
                    </stop>
                </linearGradient>

                <animate id="animate-dashoffset" xlink:href="#el" attributeName="stroke-dashoffset" from="372" to="0"
                         dur="3000ms" repeatCount="indefinite" calcMode="linear"/>
            </defs>

            <path fill="none" stroke="rgba(0, 0, 0, 0.05)" stroke-width="3"
                  d="M 85 85 C -5 16 -39 127 78 30 C 126 -9 57 -16 85 85 C 94 123 124 111 85 85 Z"/>
            <path id="el" fill="none" stroke="url(#strokeGradient)" stroke-dasharray="60 310" stroke-dashoffset="372"
                  stroke-linecap="round" stroke-width="3"
                  d="M 85 85 C -5 16 -39 127 78 30 C 126 -9 57 -16 85 85 C 94 123 124 111 85 85 Z"/>
        </svg>
        <div class="justify-center text-center align-content-center">
             Пожалуйста, подождите...
        </div>
    </div>
</div>

