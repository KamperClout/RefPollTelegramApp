@extends('layouts.app')

@section('content')
    <div class="bg-blue-variant-main-font pt-66 pr-8 pb-66 pl-8 max-w-screen-Android rounded-36 font-Manrope">
        <div class="bg-blue-variant-font rounded-28 ">
            <div class="flex flex-col">
                <div class="pt-24 pl-24 pr-200">
                    <span class="text-black"> Регистрация </span>
                    <span class="text-black"> аккаунта </span>
                </div>
                <form class="rounded-20 bg-white ml-8 mr-8 mt-24">
                    <div class=" flex flex-col mt-16 ml-8 mr-8">
                        <span class="text-blue-variant-gray-text"> Ваше ФИО </span>
                        <input type="text" name="name" placeholder="Фамилия Имя Отчество*"
                               class="bg-blue-variant-form-back text-blue-variant-gray-text rounded-12 h-40 pl-15"/>
                    </div>
                    <div class="">
                        <input type="text" name="name" placeholder="+7(Номер телефона)" required />
                    </div>
                    <div class="">
                        <input type="email" name="email" placeholder="Россия, (Регион)" required />
                    </div>
                    <div class="">
                        <input type="password" name="password" placeholder="Пароль" required />
                    </div>
                    <div class="">
                        <input type="password" name="password" placeholder="Пароль" required />
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
