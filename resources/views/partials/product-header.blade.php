<header class="flex items-center h-15 gap-4 bg-white border-b-gray-200 px-12.5 absolute top-0 left-0 right-0">
    <a href="{{ route('index') }}" class="text-gray-600 hover:text-blue-600">
        <i class="fas fa-arrow-left"></i>
    </a>
    <span class="text-lg font-semibold">
        @if (request()->routeIs('product.*'))
            Продукты
        @else
            Профиль
        @endif
    </span>
</header>
