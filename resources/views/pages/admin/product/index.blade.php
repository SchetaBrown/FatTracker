@extends('layouts.app-layout')

@section('title')
@endsection

@section('content')
    <main class="max-w-6xl mx-auto px-4 py-6">
        <form action="{{ route('admin.product.index') }}" method="GET" class="flex flex-col gap-2 mb-6" id="search_user_form">
            <div class="flex gap-2 w-full">
                <div class="flex w-full">
                    <input type="text" placeholder="Введите название продукта..." name="title"
                        value="{{ old('login') ?? (request('title') ?? ($search ?? '')) }}"
                        class="w-full pl-5 pr-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                </div>
                <button type="submit" class="flex items-center justify-center grow w-20 rounded-md bg-blue-600 text-white">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <a href="{{ route('admin.product.index') }}"
                    class="flex items-center justify-center grow w-20 rounded-md bg-gray-300 text-black">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            </div>
        </form>
        <div class="bg-white rounded border overflow-hidden border-gray-200">
            <div class="overflow-x-auto">
                <table class="w-full min-w-200">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-700 whitespace-nowrap">Название
                            </th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-700 whitespace-nowrap">Калории</th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-700 whitespace-nowrap">Белки (гр.)
                            </th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-700 whitespace-nowrap">Жиры (гр.)
                            </th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-700 whitespace-nowrap">Углеводы
                                (гр.)</th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-700 whitespace-nowrap">Категория
                            </th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-700 whitespace-nowrap">Действия
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr class="border-b hover:bg-gray-50 border-gray-200">
                                <td class="py-3 px-4 whitespace-nowrap">
                                    <div class="font-medium">{{ $product->title }}</div>
                                </td>
                                <td class="py-3 px-4 whitespace-nowrap">
                                    <div class="font-medium">{{ $product->calories }}</div>
                                </td>
                                <td class="py-3 px-4 whitespace-nowrap">
                                    <div class="font-medium">{{ $product->protein }}</div>
                                </td>
                                <td class="py-3 px-4 whitespace-nowrap">
                                    <div class="font-medium">{{ $product->fat }}</div>
                                </td>
                                <td class="py-3 px-4 whitespace-nowrap">
                                    <div class="font-medium">{{ $product->carbs }}</div>
                                </td>
                                <td class="py-3 px-4 whitespace-nowrap">
                                    <div class="font-medium">{{ $product->productCategory->category }}</div>
                                </td>
                                <td class="py-3 px-4 whitespace-nowrap">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.product.edit', ['product' => $product]) }}"
                                            class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.product.destroy', ['product' => $product]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex items-center justify-center gap-3 mt-6">
            {{ $products->links() }}
        </div>
    </main>
@endsection
