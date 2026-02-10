@extends('layouts.app-layout')

@section('title')
    Управление пользователями
@endsection

@section('content')
    <main class="max-w-6xl mx-auto px-4 py-6">
        <form action="{{ route('admin.user.index') }}" method="GET" class="flex flex-col gap-2 mb-6" id="search_user_form">
            <div class="flex gap-2 w-full">
                <div class="flex w-full">
                    <input type="text" placeholder="Введите логин пользователя..." name="login"
                        value="{{ old('login') ?? (request('login') ?? ($search ?? '')) }}"
                        class="w-full pl-5 pr-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                </div>
                <button type="submit" class="flex items-center justify-center grow w-20 rounded-md bg-blue-600 text-white">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <a href="{{ route('admin.user.index') }}"
                    class="flex items-center justify-center grow w-20 rounded-md bg-gray-300 text-black">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            </div>
        </form>
        <div class="bg-white rounded border overflow-hidden border-gray-200">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="text-left py-3 px-4 text-sm font-medium text-gray-700">Логин</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-gray-700">Email</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-gray-700">Роль</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-gray-700">Пол</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="border-b hover:bg-gray-50 border-gray-200">
                            <td class="py-3 px-4">
                                <div class="font-medium">{{ $user->login }}</div>
                            </td>
                            <td class="py-3 px-4 text-sm text-gray-600">
                                {{ $user->email }}
                            </td>
                            <td class="py-3 px-4">
                                <form action="{{ route('admin.user.update', ['user' => $user]) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="role_id"
                                        class="text-sm border rounded px-2 py-1 bg-gray-50 border-gray-200"
                                        onchange="this.form.submit()">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" @selected($role->id === $user->role_id)>
                                                {{ $role->role === 'admin' ? 'Администратор' : 'Пользователь' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                            <td class="py-3 px-4 text-sm">
                                {{ $user->gender->gender }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="flex items-center justify-center gap-3">
                {{ $users->links() }}
            </div>
        </div>
    </main>
@endsection
