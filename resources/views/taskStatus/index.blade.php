@extends('layouts.app')

@section('content')
    <h1 class="mt-5 mb-3">Сайты</h1>
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h1 class="mb-5">Статусы</h1>
            @auth
                <div>
                    <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href={{ route('task_statuses.create') }}>Создать статус</a>
                </div>
            @endauth
            <table>
                <thead class="border-b-2 border-solid border-black text-left">
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Дата создания</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($taskStatuses as $taskStatus)
                    <tr class="border-b border-dashed text-left">
                        <th>{{ $taskStatus->id }}</th>
                        <td>{{ $taskStatus->name }}</td>
                        <td>{{ $taskStatus->created_at }}</td>
                        <td>
                            <a data-confirm="Вы уверены?" data-method="delete" class="text-red-600 hover:text-red-900" href="">
                                Удалить
                            </a>
                            <a class="text-blue-600 hover:text-blue-900" href="{{ route('task_statuses.edit', $taskStatus) }}">
                                Изменить
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection('content')