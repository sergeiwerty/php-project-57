@extends('layouts.app')

@section('content')
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
            <div class="grid col-span-full">
                <h1 class="mb-5">Создать статус</h1>
                {{ Form::model($task, ['url' => route('task_statuses.store'), 'class' => 'w-50']) }}
                @csrf
                <div class="flex flex-col">
                    @include('task.form')
                    <div class="mt-5">
                        {{ Form::submit('Создать', ['class' => "bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"])}}
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </section>
@endsection('content')