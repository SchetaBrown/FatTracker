<nav>
    <ul class="flex justify-center gap-4 max-md:flex-col">
        <li class="flex justify-center">
            <a href="{{ route('profile.index') }}"
                class=" py-3 text-center font-medium text-gray-600 hover:text-blue-600">
                Общая информация
            </a>
        </li>
        <li class="flex justify-center">
            <a href="{{ route('profile.setting.index') }}"
                class="flex-1 py-3 text-center font-medium text-gray-600 hover:text-blue-600">
                Настройки
            </a>
        </li>
        <li class="flex justify-center">
            <a href="{{ route('profile.about') }}"
                class="flex-1 py-3 text-center font-medium text-gray-600 hover:text-blue-600">
                Дополнительная информация
            </a>
        </li>
    </ul>
</nav>
