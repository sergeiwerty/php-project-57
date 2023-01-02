<?php $__env->startSection('content'); ?>
    <div class="grid col-span-full">
        <h1 class="mb-5">Изменение задачи</h1>
        <?php echo e(Form::model($task, ['url' => route('tasks.update', $task), 'method' => 'PATCH', 'class' => 'w-50'])); ?>

        <?php echo csrf_field(); ?>
        <div class="flex flex-col">
            <?php echo $__env->make('task.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="mt-5">
                <?php echo e(Form::submit('Обновить', ['class' => "bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"])); ?>

            </div>
        </div>
        <?php echo e(Form::close()); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/task/edit.blade.php ENDPATH**/ ?>