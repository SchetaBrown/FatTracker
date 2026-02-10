@extends('layouts.app-layout')
@section('title')
    Настройки
@endsection

@section('content')
    @include('partials.profile-nav')
    <section class="grid grid-cols-2 gap-6 max-md:grid-cols-1">
        <div class="w-full p-6 rounded-xl bg-white shadow-sm border border-gray-100">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Настройки питания</h2>

            <div class="space-y-6">
                <div class="space-y-2">
                    <div class="flex items-center justify-between max-md:flex-col">
                        <label for="activity_level" class="text-sm font-medium text-gray-700">
                            Уровень активности
                        </label>
                        <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">
                            Текущий: {{ $user->activityLevel->level ?? 'Не указан' }}. Коэффициент:
                            {{ $user->activityLevel->multiplier }}
                        </span>
                    </div>

                    <form action="{{ route('profile.setting.update') }}" method="POST" id="activity_level_form"
                        class="relative">
                        @method('PATCH')
                        @csrf
                        <div class="relative">
                            <select name="activity_level_id" id="activity_level"
                                onchange="document.querySelector('#activity_level_form').submit()"
                                class="w-full px-4 py-3 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white cursor-pointer transition-colors hover:border-gray-400">
                                @foreach ($activityLevels as $level)
                                    <option value="{{ $level->id }}" @selected($level->id == $user->activity_level_id) class="py-2">
                                        {{ $level->level }}
                                    </option>
                                @endforeach
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">
                            {{ $user->activityLevel->description ?? '' }}
                        </p>
                    </form>
                </div>

                <div class="space-y-2">
                    <div class="flex items-center justify-between max-md:flex-col">
                        <label for="goal_type" class="text-sm font-medium text-gray-700">
                            Цель
                        </label>
                        <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">
                            Текущая: {{ $user->goalType->type ?? 'Не указана' }} {{ $user->goalType->calorie_modifier }}
                        </span>
                    </div>

                    <form action="{{ route('profile.setting.update') }}" method="POST" id="goal_type_form"
                        class="relative">
                        @method('PATCH')
                        @csrf
                        <div class="relative">
                            <select name="goal_type_id" id="goal_type"
                                onchange="document.querySelector('#goal_type_form').submit()"
                                class="w-full px-4 py-3 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white cursor-pointer transition-colors hover:border-gray-400">
                                @foreach ($goals as $goal)
                                    <option value="{{ $goal->id }}" @selected($goal->id == $user->goal_type_id) class="py-2">
                                        {{ $goal->type }}
                                    </option>
                                @endforeach
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">
                            {{ $user->goalType->description ?? '' }}
                        </p>
                    </form>
                </div>
            </div>
        </div>
        <div class="w-full p-6 rounded-xl bg-white shadow-sm border border-gray-100">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Изменение целевых параметров</h2>
            <div class="space-y-6">
                <form class="space-y-2" action="{{ route('profile.setting.update') }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="flex flex-col gap-2">
                        <label for="{{ $user->age }}" class="text-sm font-medium text-gray-700">Возраст</label>
                        <input type="number" name="age" value="{{ $user->age }}"
                            class="w-full px-4 py-3 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white transition-colors hover:border-gray-400">
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="{{ $user->weight }}" class="text-sm font-medium text-gray-700">Вес (в кг)</label>
                        <input type="number" name="weight" value="{{ $user->weight }}" step="any" min="30"
                            max="200"
                            class="w-full px-4 py-3 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white transition-colors hover:border-gray-400">
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="{{ $user->height }}" class="text-sm font-medium text-gray-700">Рост</label>
                        <input type="" name="height" value="{{ $user->height }}"
                            class="w-full px-4 py-3 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white transition-colors hover:border-gray-400">
                    </div>
                    <div class="flex justify-end space-y-2">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Обновить данные
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
