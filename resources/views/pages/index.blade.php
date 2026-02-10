@extends('layouts.app-layout')
@section('title')
    Главная страница
@endsection

@php
    $userCalories = $user->normal_calories - $userRecords['nutrients']['calories']['value'] > 0;
@endphp

@section('content')
    <section class="flex items-center gap-4 mb-4 max-sm:flex-col">
        <div class="flex flex-col gap-0.5">
            <h1 class="font-semibold text-xl">Дневник питания</h1>
            <span class="block text-sm font-medium text-gray-700 mb-1">Дата: {{ $userRecords['current_day'] }}</span>
        </div>
        <form method="GET" class="flex items-center gap-2">
            <input type="date" name="day" id="day" value="{{ $userRecords['current_day'] }}"
                onchange="this.form.submit()" class="px-2 py-1 border rounded bg-white border-gray-200">
        </form>
    </section>
    <section class="flex items-center justify-between w-full bg-white rounded-md py-5 px-6 mb-6">
        @if ($userCalories)
            <h2 class="font-medium">Осталось калорий</h2>
            <span
                class="text-lg font-bold text-green-600">+{{ $user->normal_calories - $userRecords['nutrients']['calories']['value'] }}</span>
        @else
            <h2 class="font-medium">Превышение калорий на:</h2>
            <span
                class="text-lg font-bold text-red-600">+{{ $userRecords['nutrients']['calories']['value'] - $user->normal_calories }}</span>
        @endif
    </section>

    <section class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
        @foreach ($userRecords['nutrients'] as $key => $value)
            <div class="bg-white p-3 rounded border border-gray-200">
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600">
                        {{ $value['title'] }}
                    </span>
                    <span class="text-sm font-medium">{{ $value['value'] }}</span>
                </div>
            </div>
        @endforeach
    </section>
    <section class="grid grid-cols-2 gap-5 max-lg:grid-cols-1">
        @foreach ($userRecords['records'] as $meal => $records)
            <div class="w-full rounded-xl bg-white border border-gray-200">
                <div class="flex items-center justify-between h-12.5 border-b border-b-gray-200 px-4">
                    <span class="font-bold">{{ $meal }}</span>

                    <a href="{{ route('product.index', ['meal_id' => $meal]) }}"
                        class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded text-sm hover:bg-blue-100">
                        <i class="fas fa-plus mr-1"></i>
                        Добавить
                    </a>
                </div>
                <div class="flex flex-col gap-2 p-4">
                    @if (count($records) > 0)
                        @foreach ($records as $record)
                            <div class="flex justify-between items-center p-3 border border-gray-200 rounded-md">
                                <div class="flex flex-col gap-2">
                                    <span class="font-medium">{{ $record->product->title }}</span>
                                    <span class="text-sm text-gray-500">{{ $record->quantity }}
                                        {{ $record->productUnit->short_unit }}</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <div class="flex flex-col gap-1 justify-start">
                                        @if ($record->productUnit->short_unit == 'г' || $record->productUnit->short_unit == 'мл')
                                            <span
                                                class="font-medium">{{ $record->product->calories * ((float) $record->quantity / 100) }}
                                                ккал</span>
                                        @else
                                            <span
                                                class="font-medium">{{ $record->product->calories * (float) $record->quantity }}
                                                ккал</span>
                                        @endif
                                        <div class="flex gap-1">
                                            <span
                                                class="text-xs text-gray-500">{{ $record->product->protein * ($record->productUnit->short_unit === 'шт' ? $record->quantity : $record->quantity / 100) }}Б</span>
                                            <span
                                                class="text-xs text-gray-500">{{ $record->product->fat * ($record->productUnit->short_unit === 'шт' ? $record->quantity : $record->quantity / 100) }}Ж</span>
                                            <span
                                                class="text-xs text-gray-500">{{ $record->product->carbs * ($record->productUnit->short_unit === 'шт' ? $record->quantity : $record->quantity / 100) }}У</span>
                                        </div>
                                    </div>
                                    <form action="{{ route('product.destroy', ['record' => $record->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="ml-3 text-gray-400 hover:text-red-500">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4 text-gray-400s">
                            <i class="fas fa-utensils text-3xl mb-2 text-gray-300"></i>
                            <p class="font-medium text-gray-500">Продукты не добавлены</p>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </section>
@endsection
