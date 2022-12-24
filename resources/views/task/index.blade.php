@extends('layouts.app')

@section('content')
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h1 class="mb-5">Задачи</h1>
            @auth
                <div>
                    <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href={{ route('tasks.create') }}>Создать задачу</a>
                </div>
            @endauth
            <table>
                <thead class="border-b-2 border-solid border-black text-left">
                <tr>
                    <th>ID</th>
                    <th>Статус</th>
                    <th>Имя</th>
                    <th>Автор</th>
                    <th>Исполнитель</th>
                    <th>Дата создания</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($tasks as $task)
                    <tr class="border-b border-dashed text-left">
                        <th>{{ $task->id }}</th>
                        <td>{{ $task->status }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->creator }}</td>
                        <td>{{ $task->performer }}</td>
                        <td>{{ $task->created_at }}</td>
                        <td>
{{--                            <a href="{{ route('task_statuses.destroy', $taskStatus) }}"--}}
{{--                               class="text-red-600 hover:text-red-900"--}}
{{--                               data-confirm="Вы уверены?"--}}
{{--                               data-method="delete"--}}
{{--                               rel="nofollow">--}}
{{--                                Удалить--}}
{{--                            </a>--}}
{{--                            <a class="text-blue-600 hover:text-blue-900" href="{{ route('tasks.edit', $task) }}">--}}
{{--                                Изменить--}}
{{--                            </a>--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection('content')