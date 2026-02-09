@extends('layouts.app-layout')
@section('title')
    Профиль
@endsection

@section('content')
    <section class="flex items-center justify-center bg-white rounded-xl py-10 border border-gray-200">
        <div class="flex flex-col gap-1">
            <div class="size-25 rounded-full bg-black"></div>
            <span class="text-center font-medium text-[20px]">{{ $user->login }}</span>
        </div>
    </section>
    <nav class="my-4">
        <ul class="flex justify-center gap-4">
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
        </ul>
    </nav>
    <section class="w-full bg-white p-6 rounded-xl border border-gray-200 shadow-sm mb-4">
        <h2 class="font-medium mb-4">Личная информация</h2>
        <div class="flex flex-col gap-2">
            <div class="flex flex-col">
                <label class="block text-sm font-medium text-gray-700 mb-1">Логин</label>
                <input type="text" disabled class="w-full px-3 py-2 border rounded bg-gray-50 border-gray-300"
                    value="{{ $user->login }}">
            </div>
            <div class="flex flex-col">
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="text" disabled class="w-full px-3 py-2 border rounded bg-gray-50 border-gray-300"
                    value="{{ $user->email }}">
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div class="flex flex-col">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Вес</label>
                    <input type="text" disabled class="w-full px-3 py-2 border rounded bg-gray-50 border-gray-300"
                        value="{{ $user->weight }} кг">
                </div>
                <div class="flex flex-col">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Рост</label>
                    <input type="text" disabled class="w-full px-3 py-2 border rounded bg-gray-50 border-gray-300"
                        value="{{ $user->height }} см">
                </div>
            </div>
            <div class="flex flex-col">
                <label class="block text-sm font-medium text-gray-700 mb-1">Пол</label>
                <input type="text" disabled class="w-full px-3 py-2 border rounded bg-gray-50 border-gray-300"
                    value="{{ $user->gender->gender }}">
            </div>
        </div>
    </section>
    <section class="grid grid-cols-2 gap-5">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="font-medium mb-4">Цель и активность</h2>
            <div class="flex flex-col mb-2">
                <div class="flex items-center p-3 bg-blue-50 rounded-lg border border-blue-200">
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                        <i class="fas fa-running text-blue-600"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-medium">{{ $user->activityLevel->level }}</span>
                        <p class="text-sm text-gray-600">{{ $user->activityLevel->description }}</p>
                    </div>
                </div>
            </div>
            <div class="flex flex-col mt-4">
                <div class="flex items-center p-3 bg-green-50 rounded-lg border border-green-200">
                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center mr-3">
                        <i class="fas fa-weight text-green-600"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-medium">{{ $user->goalType->type }}</span>
                        <p class="text-sm text-gray-600">{{ $user->goalType->description }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="font-medium mb-4">Действия</h2>
            <a href="{{ route('admin.index') }}"
                class="flex items-center justify-between p-3 border rounded-lg hover:bg-gray-50 group mb-4 border-gray-200">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center">
                        <i class="fas fa-cog text-purple-600"></i>
                    </div>
                    <span class="font-medium">Админ-панель</span>
                </div>
            </a>
            <form action="{{ route('login.destroy') }}" method="POST">
                @method('DELETE')
                @csrf
                <button type="submit"
                    class="w-full flex items-center justify-between p-3 border border-red-200 rounded-lg hover:bg-red-50 group h-17.5">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center mr-3">
                            <i class="fas fa-sign-out-alt text-red-600"></i>
                        </div>
                        <div class="text-red-600 font-medium">Выход</div>
                    </div>
                </button>
            </form>
        </div>
    </section>
@endsection
