<div>
    {{ Form::label('name', 'Имя') }}
</div>
<div class="mt-2">
    {{ Form::text('name', null, ['class' => 'rounded border-gray-300 w-1/3']) }}
</div>
<div class="mt-2">
    {{ Form::label('description', 'Описание') }}
</div>
<div >
    {{ Form::textarea('description', null, ['class' => 'rounded border-gray-300 w-1/3 h-32']) }}
</div>
<div class="mt-2">
    {{ Form::label('status_id', 'Статус') }}
</div>
{{--<div>--}}
{{--    {{ Form::text('created_by_id', null, ['style' => 'display:none;', 'value' ]) }}--}}
{{--</div>--}}
<div >
    {{ Form::select('status_id', $statuses, null, [
        'class' => 'rounded border-gray-300 w-1/3',
        'placeholder' => '----------',
    ]) }}
</div>
<div class="mt-2">
    {{ Form::label('assigned_to_id', 'Исполнитель') }}
</div>
<div >
    {{ Form::select('assigned_to_id', $performers, null, [
        'class' => 'rounded border-gray-300 w-1/3',
        'placeholder' => '----------',
    ]) }}
</div>
<div class="mt-2">
    {{ Form::label('labels', 'Метки') }}
</div>
<div >
    {{ Form::select('labels', $labels, null, [
        'class' => 'rounded border-gray-300 w-1/3',
        'placeholder' => '----------',
    ]) }}
</div>
@include('flash::message')
@if($errors->any())
    <div class="text-rose-600">
        @foreach($errors->all() as $error)
            {{ $error }}
        @endforeach
    </div>
@endif