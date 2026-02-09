@extends('layouts.app-layout')
@section('title')
    Настройки
@endsection

@section('content')
    <section class="w-full p-6 rounded-xl bg-white">
        <h1 class="font-medium mb-2">Изменение цели и активности</h1>
        {{-- Форма для УРОВНЯ АКТИВНОСТИ --}}
        <form action="{{ route('profile.setting.update') }}" method="POST" id="activity_level_form">
            @method('PATCH')
            @csrf
            <select name="activity_level_id" class="rounded-md border border-gray-200 px-4 py-2"
                onchange="document.querySelector('#activity_level_form').submit()">
                @foreach ($activityLevels as $level)
                    {{-- Сравниваем с activity_level_id --}}
                    <option value="{{ $level->id }}" @selected($level->id == $user->activity_level_id)>
                        {{ $level->level }}
                    </option>
                @endforeach
            </select>
        </form>

        {{-- Форма для ЦЕЛИ --}}
        <form action="{{ route('profile.setting.update') }}" method="POST" id="goal_type_form">
            @method('PATCH')
            @csrf
            <select name="goal_type_id" class="rounded-md border border-gray-200 px-4 py-2"
                onchange="document.querySelector('#goal_type_form').submit()">
                @foreach ($goals as $goal)
                    {{-- Сравниваем с goal_type_id --}}
                    <option value="{{ $goal->id }}" @selected($goal->id == $user->goal_type_id)>
                        {{ $goal->type }}
                    </option>
                @endforeach
            </select>
        </form>
    </section>
@endsection
