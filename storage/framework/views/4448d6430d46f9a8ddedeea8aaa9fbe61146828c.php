<?php $__env->startSection('content'); ?>
    <h1 class="mt-5 mb-3">Сайты</h1>
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h1 class="mb-5">Статусы</h1>
            <?php if(auth()->guard()->check()): ?>
                <div>
                    <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href=<?php echo e(route('task_statuses.create')); ?>>Создать статус</a>
                </div>
            <?php endif; ?>
            <table>
                <thead class="border-b-2 border-solid border-black text-left">
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Дата создания</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $taskStatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taskStatus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-b border-dashed text-left">
                        <th><?php echo e($taskStatus->id); ?></th>
                        <td><?php echo e($taskStatus->name); ?></td>
                        <td><?php echo e($taskStatus->created_at); ?></td>
                        <td>
                            <a href="<?php echo e(route('task_statuses.destroy', $taskStatus)); ?>"
                               class="text-red-600 hover:text-red-900"
                               data-confirm="Вы уверены?"
                               data-method="delete"
                               rel="nofollow">
                                Удалить
                            </a>
                            <a class="text-blue-600 hover:text-blue-900" href="<?php echo e(route('task_statuses.edit', $taskStatus)); ?>">
                                Изменить
                            </a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/taskStatus/index.blade.php ENDPATH**/ ?>