@extends('layouts.app')

@section('content')
        <div class="grid col-span-full">
            <h1 class="mb-5">Задачи</h1>
            @auth
                <div>
                    <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href={{ route('tasks.create') }}>Создать задачу</a>
                </div>
            @endauth
            @include('flash::message')
            <table class="mt-4">
                <thead class="border-b-2 border-solid border-black text-left">
                <tr>
                    <th>ID</th>
                    <th>Статус</th>
                    <th>Имя</th>
                    <th>Автор</th>
                    <th>Исполнитель</th>
                    <th>Дата создания</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($tasks as $task)
                    <tr class="border-b border-dashed text-left">
                        <th>{{ $task->id }}</th>
                        <td>{{ $task->status->name }}</td>
                        <td><a href="{{ route('tasks.show', [$task]) }}" class="text-blue-600 hover:text-blue-900">{{ $task->name }}</a></td>
                        <td>{{ $task->creator->name }}</td>
                        <td>{{ is_null($task->performer) ? '' : $task->performer->name }}</td>
                        <td>{{ $task->created_at }}</td>
                        <td>
{{--                            <a href="{{ route('task_statuses.destroy', $taskStatus) }}"--}}
{{--                               class="text-red-600 hover:text-red-900"--}}
{{--                               data-confirm="Вы уверены?"--}}
{{--                               data-method="delete"--}}
{{--                               rel="nofollow">--}}
{{--                                Удалить--}}
{{--                            </a>--}}
                            <a href="{{ route('tasks.destroy', $task) }}"
                               class="text-red-600 hover:text-red-900"
                               data-confirm="Вы уверены?"
                               data-method="delete"
                               rel="nofollow">
                                Удалить
                            </a>
                            <a class="text-blue-600 hover:text-blue-900" href="{{ route('tasks.edit', $task) }}">
                                Изменить
                            </a>
                            {{ $task->creator->id }}
                            {{ Auth::id() }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
@endsection('content')