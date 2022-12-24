<div>
    <?php echo e(Form::label('name', 'Имя')); ?>

</div>
<div class="mt-2">
    <?php echo e(Form::text('name', null, ['class' => 'rounded border-gray-300 w-1/3'])); ?>

</div>
<div class="mt-2">
    <?php echo e(Form::label('description', 'Описание')); ?>

</div>
<div >
    <?php echo e(Form::textarea('description', null, ['class' => 'rounded border-gray-300 w-1/3 h-32'])); ?>

</div>
<div class="mt-2">
    <?php echo e(Form::label('status_id', 'Статус')); ?>

</div>
<div >
    <?php echo e(Form::select('status_id', $statuses, null, [
        'class' => 'rounded border-gray-300 w-1/3',
        'placeholder' => '----------',
    ])); ?>

</div>
<div class="mt-2">
    <?php echo e(Form::label('assigned_to_id', 'Исполнитель')); ?>

</div>
<div >
    <?php echo e(Form::select('assigned_to_id', $performers, null, [
        'class' => 'rounded border-gray-300 w-1/3',
        'placeholder' => '----------',
    ])); ?>

</div>
<?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if($errors->any()): ?>
    <div class="text-rose-600">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo e($error); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?><?php /**PATH /var/www/html/resources/views/task/form.blade.php ENDPATH**/ ?>