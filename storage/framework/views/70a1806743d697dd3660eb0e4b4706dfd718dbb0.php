<?php $__env->startSection('content'); ?>
         <div class="grid col-span-full">
             <h2 class="mb-5">
                 <?php echo e(__('task.View a task')); ?>: <?php echo e($task->name); ?>

                 <a href="https://php-task-manager-ru.hexlet.app/tasks/1/edit">⚙</a>
             </h2>
             <p><span class="font-black"><?php echo e(__('task.Name')); ?>: </span><?php echo e($task->description); ?></p>
             <p><span class="font-black"><?php echo e(__('task.Status')); ?>: </span><?php echo e($task->status->name); ?></p>
             <p><span class="font-black"><?php echo e(__('task.Description')); ?>: </span><?php echo e($task->description); ?></p>
             <p><span class="font-black"><?php echo e(__('task.Labels')); ?>: </span></p>
             <div>








            </div>
        </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/task/show.blade.php ENDPATH**/ ?>