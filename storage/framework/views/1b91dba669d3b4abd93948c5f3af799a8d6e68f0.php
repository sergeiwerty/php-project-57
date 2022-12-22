<div>
    <?php echo e(Form::label('name', 'Имя')); ?>

</div>
<div class="mt-5">
    <?php echo e(Form::text('name', null, ['class' => 'rounded border-gray-300 w-1/3'])); ?>

</div>
<?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if($errors->any()): ?>
    <div class="text-rose-600">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo e($error); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?><?php /**PATH /home/user/development/php-project-lvl4/resources/views/taskStatus/form.blade.php ENDPATH**/ ?>