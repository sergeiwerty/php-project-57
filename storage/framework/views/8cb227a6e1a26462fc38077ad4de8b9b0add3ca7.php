<div>
    <?php echo e(Form::label('name', __('label.Label name'))); ?>

</div>
<div class="mt-5">
    <?php echo e(Form::text('name', null, ['class' => 'rounded border-gray-300 w-1/3'])); ?>

</div>
<div class="mt-2">
    <?php echo e(Form::label('description', __('label.Description'))); ?>

</div>
<div >
    <?php echo e(Form::textarea('description', null, ['class' => 'rounded border-gray-300 w-1/3 h-32'])); ?>

</div>
<?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if($errors->any()): ?>
    <div class="text-rose-600">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo e($error); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?><?php /**PATH /var/www/html/resources/views/label/form.blade.php ENDPATH**/ ?>