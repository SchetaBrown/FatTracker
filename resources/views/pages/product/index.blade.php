@extends('layouts.app-layout')
@section('title')
@endsection

@section('content')
    <section class="mb-5 relative">
        <form action="{{ route('product.index') }}" method="GET" class="flex flex-col gap-2" id="search_category_form">
            <div class="flex gap-2 w-full max-sm:flex-wrap">
                <div class="flex w-full">
                    <input type="text" placeholder="Поиск продуктов..." name="title"
                        value="{{ old('title') ?? (request('title') ?? ($search ?? '')) }}"
                        class="w-full pl-5 pr-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                </div>
                <button type="submit" class="flex items-center justify-center grow w-20 rounded-md bg-blue-600 text-white max-sm:size-10">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <a href="{{ route('product.index') }}"
                    class="flex items-center justify-center grow w-20 rounded-md bg-gray-300 text-black max-sm:size-10">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            </div>
            <select name="category" class="bg-white px-6 py-2 rounded-md w-fit"
                onchange="document.getElementById('search_category_form').submit()">
                <option value="#">Все продукты</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected($category->id == request()->category)>{{ $category->category }}</option>
                @endforeach
            </select>
        </form>
    </section>
    <section class="grid grid-cols-2 gap-3 max-sm:grid-cols-1">
        @foreach ($products as $product)
            <div class="bg-white rounded-lg p-4 flex items-center justify-between border border-gray-200 max-md:flex-col">
                <div class="flex flex-col gap-1 max-md:justify-center">
                    <span class="font-medium">
                        {{ $product->title }}
                    </span>
                    <span class="text-sm text-gray-500">
                        {{ $product->calories }} ккал
                        Б:{{ $product->protein }}
                        Ж:{{ $product->fat }}
                        У:{{ $product->carbs }}
                    </span>
                </div>
                <form action="{{ route('product.store', ['product' => $product->id]) }}" method="POST" class="max-md:flex max-md:mt-2 max-md:flex-wrap max-md:gap-1 max-2xl:justify-end">
                    @csrf
                    @isset(request()->query()['meal_id'])
                        <input type="hidden" name="meal_id" value="{{ request()->query()['meal_id'] }}">
                    @endisset
                    <input type="text" name="quantity" class="border border-gray-100 w-25 rounded-md text-center"
                        value="100">
                    <select name="product_unit_id" id="" class="h-6.5 px-2 border border-gray-200 rounded-md">
                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->short_unit }}</option>
                        @endforeach
                    </select>
                    @if (!request()->has('meal_id'))
                        <select name="meal_id" id="" class="h-6.5 px-2 border border-gray-200 rounded-md">
                            @foreach ($meals as $meal)
                                <option value="{{ $meal->id }}">{{ $meal->title }}</option>
                            @endforeach
                        </select>
                    @endif
                    <button type="submit" class="px-3 py-1 bg-blue-50 text-blue-600 rounded text-sm hover:bg-blue-100"
                        onclick="">
                        <i class="fas fa-plus"></i>
                    </button>
                </form>
            </div>
        @endforeach
    </section>
    <section class="flex justify-center mt-10">
        {{ $products->links() }}
    </section>
@endsection
