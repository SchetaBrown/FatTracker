@extends('layouts.app-layout')

@section('title')
    Dashboard
@endsection

@section('content')
    <main class="max-w-4xl mx-auto px-4 py-6">
        <div class="grid grid-cols-2 gap-4 mb-8">
            <div class="bg-white p-4 rounded border border-gray-200">
                <div class="text-2xl font-bold text-gray-900">{{ $product_count }}</div>
                <div class="text-gray-600 text-sm">Продуктов</div>
            </div>
            <div class="bg-white p-4 rounded border border-gray-200">
                <div class="text-2xl font-bold text-gray-900">{{ $user_count }}</div>
                <div class="text-gray-600 text-sm">Пользователей</div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded border p-5 border-gray-200">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                        <i class="fas fa-utensils text-blue-600"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-lg">Управление продуктами</h2>
                        <p class="text-gray-600 text-sm">Добавление и редактирование продуктов</p>
                    </div>
                </div>

                <div class="space-y-3">
                    <a href="{{ route('admin.product.create') }}"
                        class="block p-3 border rounded hover:bg-gray-50 border-gray-300">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <i class="fas fa-plus text-green-600 mr-3"></i>
                                <span>Добавить новый продукт</span>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400"></i>
                        </div>
                    </a>

                    <a href="{{ route('admin.product.index') }}"
                        class="block p-3 border rounded hover:bg-gray-50 border-gray-300">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <i class="fas fa-list text-gray-600 mr-3"></i>
                                <span>Список продуктов</span>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400"></i>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Управление пользователями -->
            <div class="bg-white rounded border p-5 border-gray-200">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                        <i class="fas fa-users text-purple-600"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-lg">Управление пользователями</h2>
                        <p class="text-gray-600 text-sm">Просмотр и управление пользователями</p>
                    </div>
                </div>

                <div class="space-y-3">
                    <a href="{{ route('admin.user.index') }}"
                        class="block p-3 border rounded hover:bg-gray-50 border-gray-300">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <i class="fas fa-list text-gray-600 mr-3"></i>
                                <span>Список пользователей</span>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection
