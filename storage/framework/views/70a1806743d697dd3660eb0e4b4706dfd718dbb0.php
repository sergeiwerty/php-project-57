<?php $__env->startSection('content'); ?>
<section class="bg-white dark:bg-gray-900">
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h2 class="mb-5">
                Просмотр задачи: <?php echo e($task->name); ?> <a href="https://php-task-manager-ru.hexlet.app/tasks/1/edit">⚙</a>
            </h2>
            <p><span class="font-black">Имя: </span><?php echo e($task->description); ?></p>
            <p><span class="font-black">Статус: </span><?php echo e($task->status->name); ?></p>
            <p><span class="font-black">Описание: </span><?php echo e($task->description); ?></p>
            <p><span class="font-black">Метки: </span></p>
            <div>








            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/task/show.blade.php ENDPATH**/ ?>