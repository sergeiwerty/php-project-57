<?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div>
    <?php echo e(Form::label('name', __('task.Name'))); ?>

</div>
<div class="mt-2">
    <?php echo e(Form::text('name', null, ['class' => 'rounded border-gray-300 w-1/3'])); ?>

</div>
<?php $__currentLoopData = $errors->get('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="text-rose-600">
        <?php echo e($message); ?>

    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<div class="mt-2">
    <?php echo e(Form::label('description', __('task.Description'))); ?>

</div>
<div >
    <?php echo e(Form::textarea('description', null, ['class' => 'rounded border-gray-300 w-1/3 h-32'])); ?>

</div>
<div class="mt-2">
    <?php echo e(Form::label('status_id', __('task.Status'))); ?>

</div>
<div >
    <?php echo e(Form::select('status_id', $statuses, null, [
        'class' => 'rounded border-gray-300 w-1/3',
        'placeholder' => '----------',
    ])); ?>

</div>
<?php $__currentLoopData = $errors->get('status_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="text-rose-600">
        <?php echo e($message); ?>

    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<div class="mt-2">
    <?php echo e(Form::label('assigned_to_id', __('task.Performer'))); ?>

</div>
<div >
    <?php echo e(Form::select('assigned_to_id', $performers, null, [
        'class' => 'rounded border-gray-300 w-1/3',
        'placeholder' => '----------',
    ])); ?>

</div>
<div class="mt-2">
    <?php echo e(Form::label('labels', __('task.Labels'))); ?>

</div>
<div >
    <?php echo e(Form::select('labels[]', $labels, is_null($task->labels) ? null : $task->labels, [
        'class' => 'form-control rounded border-gray-300 w-1/3',
        'multiple' => 'multiple',
        'placeholder' => ''
    ])); ?>

</div>
<?php /**PATH /var/www/html/resources/views/task/form.blade.php ENDPATH**/ ?>