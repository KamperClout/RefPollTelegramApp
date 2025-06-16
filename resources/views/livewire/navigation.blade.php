<nav class="bg-white inset-x-0 fixed bottom-0 left-0 w-full z-50 flex justify-around text-sc-gray-text py-2">
    <ul class="flex flex-col items-center active:bg-white rounded-2xl active:text-sc-almost-black" wire:navigate
        href="{{ route('my-profile') }}">
        <li
                class=" cursor-pointer {{request()->routeIs('my-profile') ? 'text-sc-almost-black font-bold' : 'text-sc-gray-text' }}">
            <svg class="w-5 h-5" width="24" height="24" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15.1166 18.0166C14.3833 18.2333 13.5166 18.3333 12.5 18.3333H7.49997C6.4833 18.3333 5.61663 18.2333 4.8833 18.0166C5.06663 15.85 7.29163 14.1416 9.99997 14.1416C12.7083 14.1416 14.9333 15.85 15.1166 18.0166Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M12.4998 1.6665H7.49984C3.33317 1.6665 1.6665 3.33317 1.6665 7.49984V12.4998C1.6665 15.6498 2.6165 17.3748 4.88317 18.0165C5.0665 15.8498 7.2915 14.1415 9.99984 14.1415C12.7082 14.1415 14.9332 15.8498 15.1165 18.0165C17.3832 17.3748 18.3332 15.6498 18.3332 12.4998V7.49984C18.3332 3.33317 16.6665 1.6665 12.4998 1.6665ZM9.99984 11.8082C8.34984 11.8082 7.0165 10.4665 7.0165 8.81652C7.0165 7.16652 8.34984 5.83317 9.99984 5.83317C11.6498 5.83317 12.9832 7.16652 12.9832 8.81652C12.9832 10.4665 11.6498 11.8082 9.99984 11.8082Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M12.9833 8.81684C12.9833 10.4668 11.6499 11.8085 9.99994 11.8085C8.34994 11.8085 7.0166 10.4668 7.0166 8.81684C7.0166 7.16684 8.34994 5.8335 9.99994 5.8335C11.6499 5.8335 12.9833 7.16684 12.9833 8.81684Z" stroke="#currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>

        </li>
        <p class="text-[12px] font-semibold mt-2">Профиль</p>
    </ul>
    <ul class="flex flex-col items-center" wire:navigate
        href="{{ route('my-clients') }}">
        <li class=" cursor-pointer {{request()->routeIs('my-clients') ? 'text-sc-almost-black font-bold' : 'text-sc-gray-text' }}" >
            <svg class="w-5 h-5" width="24" height="24" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6.99463 1.6665V4.1665" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M13.6616 1.6665V4.1665" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M17.8281 7.08317V11.3582C17.0865 10.7665 16.1448 10.4165 15.1198 10.4165C14.0948 10.4165 13.1365 10.7748 12.3865 11.3831C11.3781 12.1748 10.7448 13.4165 10.7448 14.7915C10.7448 15.6082 10.9781 16.3915 11.3781 17.0415C11.6865 17.5498 12.0865 17.9915 12.5615 18.3332H6.99479C4.07812 18.3332 2.82812 16.6665 2.82812 14.1665V7.08317C2.82812 4.58317 4.07812 2.9165 6.99479 2.9165H13.6615C16.5781 2.9165 17.8281 4.58317 17.8281 7.08317Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M6.16162 9.1665H11.1616" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M6.16162 13.3335H8.34495" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M19.4946 14.7915C19.4946 15.6082 19.2613 16.3915 18.8613 17.0415C18.628 17.4415 18.3363 17.7915 17.9946 18.0748C17.228 18.7582 16.228 19.1665 15.1196 19.1665C14.1613 19.1665 13.278 18.8582 12.5613 18.3332C12.0863 17.9915 11.6863 17.5498 11.378 17.0415C10.978 16.3915 10.7446 15.6082 10.7446 14.7915C10.7446 13.4165 11.378 12.1748 12.3863 11.3831C13.1363 10.7748 14.0946 10.4165 15.1196 10.4165C16.1446 10.4165 17.0863 10.7665 17.828 11.3582C18.8446 12.1582 19.4946 13.3998 19.4946 14.7915Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M15.12 16.8752C15.12 15.7252 16.0533 14.7918 17.2033 14.7918C16.0533 14.7918 15.12 13.8585 15.12 12.7085C15.12 13.8585 14.1866 14.7918 13.0366 14.7918C14.1866 14.7918 15.12 15.7252 15.12 16.8752Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>

        </li>
        <div class="text-[12px] font-semibold mt-2">Анкеты</div>
    </ul>
    <ul class="flex flex-col items-center"  wire:navigate
        href="{{ route('my-payments') }}">
        <li
                class=" cursor-pointer {{request()->routeIs('my-payments') ? 'text-sc-almost-black font-bold' : 'text-sc-gray-text' }}">
            <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16.1131 11.2918C15.7456 11.6335 15.5356 12.1252 15.5881 12.6502C15.6669 13.5502 16.5331 14.2085 17.4781 14.2085H19.1406V15.2002C19.1406 16.9252 17.6619 18.3335 15.8506 18.3335H5.80563C3.99438 18.3335 2.51562 16.9252 2.51562 15.2002V9.59184C2.51562 7.86684 3.99438 6.4585 5.80563 6.4585H15.8506C17.6619 6.4585 19.1406 7.86684 19.1406 9.59184V10.7918H17.3731C16.8831 10.7918 16.4369 10.9752 16.1131 11.2918Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M2.51562 10.3416V6.5333C2.51562 5.54163 3.15438 4.65826 4.12563 4.30826L11.0731 1.80826C12.1581 1.41659 13.3219 2.18329 13.3219 3.29162V6.45828" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M20.0671 11.642V13.3587C20.0671 13.817 19.6821 14.192 19.1921 14.2086H17.4771C16.5321 14.2086 15.6658 13.5503 15.5871 12.6503C15.5346 12.1253 15.7446 11.6336 16.1121 11.292C16.4358 10.9753 16.8821 10.792 17.3721 10.792H19.1921C19.6821 10.8087 20.0671 11.1836 20.0671 11.642Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M6.45312 10H12.5781" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>

        </li>
        <p class="text-[12px] font-semibold mt-2">Выплаты</p>
    </ul>
    <ul class="flex flex-col items-center" wire:navigate
        href="{{ route('my-earnings') }}">
        <li
                class=" cursor-pointer {{request()->routeIs('my-earnings') ? 'text-sc-almost-black font-bold' : 'text-sc-gray-text' }}">
            <svg class="w-5 h-5" width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.55469 11.9417C7.55469 13.0167 8.37969 13.8834 9.40469 13.8834H11.4964C12.388 13.8834 13.113 13.125 13.113 12.1917C13.113 11.175 12.6714 10.8167 12.013 10.5834L8.65469 9.4167C7.99635 9.18337 7.55469 8.82503 7.55469 7.80837C7.55469 6.87503 8.27969 6.1167 9.17135 6.1167H11.263C12.288 6.1167 13.113 6.98337 13.113 8.05837" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M10.3281 5V15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M12.828 18.3332H7.82796C3.6613 18.3332 1.99463 16.6665 1.99463 12.4998V7.49984C1.99463 3.33317 3.6613 1.6665 7.82796 1.6665H12.828C16.9946 1.6665 18.6613 3.33317 18.6613 7.49984V12.4998C18.6613 16.6665 16.9946 18.3332 12.828 18.3332Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </li>
        <div class="text-[12px] font-semibold mt-2">Заработок</div>
    </ul>
    <ul class="flex flex-col items-center" wire:navigate
        href="{{route('my-friends')}}">
        <li
            class="cursor-pointer {{request()->routeIs('my-friends') ? 'text-sc-almost-black font-bold' : 'text-sc-gray-text' }}">
            <svg class="w-5 h-5" width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.96126 9.05817C7.87793 9.04984 7.77793 9.04984 7.68626 9.05817C5.70293 8.9915 4.12793 7.3665 4.12793 5.3665C4.12793 3.32484 5.77793 1.6665 7.82793 1.6665C9.8696 1.6665 11.5279 3.32484 11.5279 5.3665C11.5196 7.3665 9.9446 8.9915 7.96126 9.05817Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M14.0034 3.3335C15.62 3.3335 16.92 4.64183 16.92 6.25016C16.92 7.82516 15.67 9.1085 14.1117 9.16683C14.045 9.1585 13.97 9.1585 13.895 9.16683" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M3.79473 12.1335C1.77806 13.4835 1.77806 15.6835 3.79473 17.0252C6.08639 18.5585 9.84473 18.5585 12.1364 17.0252C14.1531 15.6752 14.1531 13.4752 12.1364 12.1335C9.85306 10.6085 6.09473 10.6085 3.79473 12.1335Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M15.6113 16.6665C16.2113 16.5415 16.778 16.2998 17.2447 15.9415C18.5447 14.9665 18.5447 13.3582 17.2447 12.3832C16.7863 12.0332 16.228 11.7998 15.6363 11.6665" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>

        </li>
        <div class="text-[12px] font-semibold mt-2">Друзья</div>
    </ul>
</nav>
