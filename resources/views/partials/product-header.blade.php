<header class="flex items-center h-15 gap-4 bg-white border-b-gray-200 px-12.5 absolute top-0 left-0 right-0">
    <span class="text-lg font-semibold">
        @if (request()->routeIs('product.*'))
            Продукты
        @elseif(request()->routeIs('profile.index'))
            Профиль
        @elseif(request()->routeIs('profile.setting.*'))
            Настройки
        @elseif (request()->routeIs('profile.about'))
            Дополнительная информация
        @elseif (request()->routeIs('admin.*'))
            <a href="{{ route('admin.index') }}" class="flex items-center gap-2 text-blue-600">
                <i class="fa-solid fa-book"></i>
                Админ-панель
            </a>
        @endif
    </span>
</header>
