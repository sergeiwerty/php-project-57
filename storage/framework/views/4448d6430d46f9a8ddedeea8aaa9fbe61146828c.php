<?php $__env->startSection('content'); ?>
    <div class="grid col-span-full">
        <h1 class="mb-5"><?php echo e(__('taskStatus.Statuses')); ?></h1>
        <?php if(auth()->guard()->check()): ?>
            <div>
                <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                   href=<?php echo e(route('task_statuses.create')); ?>>
                    <?php echo e(__('taskStatus.Create status')); ?>

                </a>
            </div>
        <?php endif; ?>
        <?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <table class="mt-4">
            <thead class="border-b-2 border-solid border-black text-left">
            <tr>
                <th></th>
                <th><?php echo e(__('taskStatus.Status name')); ?></th>
                <th><?php echo e(__('taskStatus.Date of creation')); ?></th>
                <th><?php echo e(__('taskStatus.Actions')); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $taskStatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taskStatus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-b border-dashed text-left">
                    <th><?php echo e($taskStatus->id); ?></th>
                    <td><?php echo e($taskStatus->name); ?></td>
                    <td><?php echo e($taskStatus->created_at->format('d.m.Y')); ?></td>
                    <td>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['update', 'delete'], $taskStatus)): ?>
                            <a href="<?php echo e(route('task_statuses.destroy', $taskStatus)); ?>"
                               class="text-red-600 hover:text-red-900"
                               data-confirm="Вы уверены?"
                               data-method="delete"
                               rel="nofollow">
                                <?php echo e(__('taskStatus.Delete')); ?>

                            </a>
                            <a class="text-blue-600 hover:text-blue-900" href="<?php echo e(route('task_statuses.edit', $taskStatus)); ?>">
                                <?php echo e(__('taskStatus.Edit')); ?>

                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/taskStatus/index.blade.php ENDPATH**/ ?>