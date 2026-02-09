@extends('layouts.auth-layout')

@section('title')
    Регистрация в системе - {{ config('app.name') }}
@endsection

@section('content')
    <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Регистрация</h1>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        @endif

        <form method="POST" action="{{ route('register.store') }}" class="space-y-4">
            @csrf

            <!-- Логин и Email -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Логин</label>
                    <input type="text" name="login" value="{{ old('login') }}" required placeholder="Придумайте логин"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 @error('login') border-red-500 @enderror">
                    @error('login')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="example@mail.com"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Возраст --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Возраст</label>
                <input type="number" name="age" required placeholder="18-120"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 @error('age') border-red-500 @enderror">
                @error('age')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Пароль -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Пароль</label>
                <input type="password" name="password" required placeholder="Не менее 6 символов"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Подтверждение пароля -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Подтвердите пароль</label>
                <input type="password" name="password_confirmation" required placeholder="Повторите пароль"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>

            <!-- Вес и рост -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Вес, кг</label>
                    <input type="number" name="weight" value="{{ old('weight') }}" min="30" max="200"
                        placeholder="70"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 @error('weight') border-red-500 @enderror">
                    @error('weight')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Рост, см</label>
                    <input type="number" name="height" value="{{ old('height') }}" min="100" max="250"
                        placeholder="175"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 @error('height') border-red-500 @enderror">
                    @error('height')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Пол -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Пол</label>
                <div class="radio-group grid grid-cols-2 gap-2">
                    @foreach ($genders as $gender)
                        <label
                            class="text-center py-2 border border-gray-300 rounded-lg hover:bg-gray-50 {{ old('gender') == $gender->gender ? 'active' : '' }}">
                            <input type="radio" name="gender_id" value="{{ $gender->id }}"
                                {{ old('gender') == $gender->gender ? 'checked' : '' }} required>
                            <span>{{ $gender->gender }}</span>
                        </label>
                    @endforeach
                </div>
                @error('gender')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Активность -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Уровень активности</label>
                <div class="radio-group grid grid-cols-2 gap-2">
                    @foreach ($activityLevels as $activity)
                        <label
                            class="text-center py-2 border border-gray-300 rounded-lg hover:bg-gray-50 {{ old('activity_level_id') == $activity->id ? 'active' : '' }}">
                            <input type="radio" name="activity_level_id" value="{{ $activity->id }}"
                                {{ old('activity_level_id') == $activity->id ? 'checked' : '' }} required>
                            <div>
                                <div class="font-medium">{{ $activity->level }}</div>
                                <div class="text-xs text-gray-500 mt-1">{{ $activity->description }}</div>
                            </div>
                        </label>
                    @endforeach
                </div>
                @error('activity_level_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Цель -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Цель</label>
                <div class="radio-group grid grid-cols-3 gap-2">
                    @foreach ($goals as $goal)
                        <label
                            class="text-center py-2 border border-gray-300 rounded-lg hover:bg-gray-50 {{ old('goal_type_id') == $goal->id ? 'active' : '' }}">
                            <input type="radio" name="goal_type_id" value="{{ $goal->id }}"
                                {{ old('goal_type_id') == $goal->id ? 'checked' : '' }} required>
                            <div>
                                <div class="font-medium">{{ $goal->type }}</div>
                                <div class="text-xs text-gray-500 mt-1">{{ $goal->description }}</div>
                            </div>
                        </label>
                    @endforeach
                </div>
                @error('goal_type_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Кнопка -->
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-lg transition mt-4">
                Зарегистрироваться
            </button>
        </form>

        <div class="mt-6 text-center text-sm text-gray-600">
            Уже есть аккаунт? <a href="{{ route('login.create') }}" class="text-blue-600 hover:text-blue-800">Войти</a>
        </div>
    </div>

    <script>
        document.querySelectorAll('.radio-group input').forEach(input => {
            input.addEventListener('change', function() {
                const groupName = this.name;
                document.querySelectorAll(`[name="${groupName}"]`).forEach(radio => {
                    radio.parentElement.classList.remove('active');
                });

                this.parentElement.classList.add('active');
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.radio-group input:checked').forEach(input => {
                input.parentElement.classList.add('active');
            });
        });
    </script>
@endsection
