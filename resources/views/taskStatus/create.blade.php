@extends('layouts.app')

@section('content')
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
            <div class="grid col-span-full">
                <h1 class="mb-5">Создать статус</h1>

{{--                <form method="POST" action={{ route('task_statuses.store') }} accept-charset="UTF-8" class="w-50"><input name="_token" type="hidden" value="MdIk8ide4faA7xCnUnHvujMBanOY8F6tFGu07xPa">--}}
{{--                    <div class="flex flex-col">--}}
{{--                        <div>--}}
{{--                            <label for="name">Имя</label>--}}
{{--                        </div>--}}
{{--                        <div class="mt-2">--}}
{{--                            <input class="rounded border-gray-300 w-1/3" name="name" type="text" id="name">--}}
{{--                        </div>--}}
{{--                        <div class="mt-2">--}}
{{--                            <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit" value="Создать">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}

                {{ Form::model($taskStatus, ['url' => route('task_statuses.store'), 'class' => 'w-50']) }}
                    @csrf
                    <div class="flex flex-col">
                        <div>
                            {{ Form::label('name', 'Имя') }}
                        </div>
                        <div class="mt-5">
                            {{ Form::text('name', '', array_merge(['class' => 'rounded border-gray-300 w-1/3'])) }}
                        </div>
                        @include('flash::message')
                        @if($errors->any())
                            <div class="text-rose-600">
                                @foreach($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif
                        <div class="mt-5">
                            {{ Form::submit('Создать', ['class' => "bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"])}}
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </section>
@endsection('content')