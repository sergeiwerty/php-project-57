<?php $__env->startSection('content'); ?>
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h1 class="mb-5">Задачи</h1>
            <?php if(auth()->guard()->check()): ?>
                <div>
                    <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href=<?php echo e(route('tasks.create')); ?>>Создать задачу</a>
                </div>
            <?php endif; ?>
            <table>
                <thead class="border-b-2 border-solid border-black text-left">
                <tr>
                    <th>ID</th>
                    <th>Статус</th>
                    <th>Имя</th>
                    <th>Автор</th>
                    <th>Исполнитель</th>
                    <th>Дата создания</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-b border-dashed text-left">
                        <th><?php echo e($task->id); ?></th>
                        <td><?php echo e($task->status); ?></td>
                        <td><?php echo e($task->description); ?></td>
                        <td><?php echo e($task->creator); ?></td>
                        <td><?php echo e($task->performer); ?></td>
                        <td><?php echo e($task->created_at); ?></td>
                        <td>










                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/user/development/php-project-lvl4/resources/views/task/index.blade.php ENDPATH**/ ?>