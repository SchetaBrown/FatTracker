@extends('layouts.app-layout')

@section('title')
@endsection


@section('content')
    <main class="max-w-2xl mx-auto px-4 py-6">
        <form class="bg-white rounded border p-6 space-y-6 border-gray-200"
            action="{{ route('admin.product.update', ['product' => $product]) }}" method="POST">
            @method('PATCH')
            @if ($errors->any())
                <div class="p-6 rounded-md bg-red-200 border border-red-500">
                    <h1 class="text-red-600 text-xl">Возникли ошибки при создании продукта</h1>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="font-medium text-red-500 text-[14px]">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Название продукта *
                </label>
                <input type="text" required placeholder="Введите название" name="title" value="{{ $product->title }}"
                    class="w-full px-3 py-2 border rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500 border-gray-200">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Описание
                </label>
                <textarea rows="3" placeholder="Описание продукта (необязательно)" name="description"
                    class="w-full px-3 py-2 border rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500 border-gray-200">{{ $product->description }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Калории *
                    </label>
                    <input type="number" required min="0" placeholder="0" name="calories"
                        value="{{ $product->calories }}"
                        class="w-full px-3 py-2 border rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500 border-gray-200">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Белки (г)
                    </label>
                    <input type="number" min="0" step="0.1" placeholder="0" name="protein"
                        value="{{ $product->protein }}"
                        class="w-full px-3 py-2 border rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500 border-gray-200">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Жиры (г)
                    </label>
                    <input type="number" min="0" step="0.1" placeholder="0" name="fat"
                        value="{{ $product->fat }}"
                        class="w-full px-3 py-2 border rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500 border-gray-200">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Углеводы (г)
                    </label>
                    <input type="number" min="0" step="0.1" placeholder="0" name="carbs"
                        value="{{ $product->carbs }}"
                        class="w-full px-3 py-2 border rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500 border-gray-200">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Категория *
                </label>
                <select required name="product_category_id"
                    class="w-full px-3 py-2 border rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500 border-gray-200">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected($category->id === $product->product_category_id)>{{ $category->category }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex space-x-3 pt-4">
                <a href="{{ route('admin.product.index') }}"
                    class="px-4 py-2 border rounded text-gray-700 hover:bg-gray-50 border-gray-200">
                    Отмена
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Обновить
                </button>
            </div>
        </form>
        <div class="mt-6 p-4 bg-blue-50 rounded border border-blue-200">
            <div class="text-sm text-gray-700">
                <p class="font-medium mb-1">Подсказка:</p>
                <p>Все значения указываются на 100 грамм продукта.</p>
            </div>
        </div>
    </main>
@endsection
