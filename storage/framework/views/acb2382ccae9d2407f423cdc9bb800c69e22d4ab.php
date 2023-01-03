<?php $__env->startSection('content'); ?>
        <div class="grid col-span-full">
            <h1 class="mb-5"><?php echo e(__('task.Tasks')); ?></h1>
            <?php if(auth()->guard()->check()): ?>
                <div>
                    <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                       href=<?php echo e(route('tasks.create')); ?>>
                        <?php echo e(__('task.Create task')); ?>

                    </a>
                </div>
            <?php endif; ?>
            <?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <table class="mt-4">
                <thead class="border-b-2 border-solid border-black text-left">
                <tr>
                    <th>ID</th>
                    <th><?php echo e(__('task.Status')); ?></th>
                    <th><?php echo e(__('task.Name')); ?></th>
                    <th><?php echo e(__('task.Author')); ?></th>
                    <th><?php echo e(__('task.Performer')); ?></th>
                    <th><?php echo e(__('task.Date of creation')); ?></th>
                    <th><?php echo e(__('task.Actions')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-b border-dashed text-left">
                        <th><?php echo e($task->id); ?></th>
                        <td><?php echo e($task->status->name); ?></td>
                        <td>
                            <a href="<?php echo e(route('tasks.show', [$task])); ?>"
                               class="text-blue-600 hover:text-blue-900"><?php echo e($task->name); ?>

                            </a>
                        </td>
                        <td><?php echo e($task->creator->name); ?></td>
                        <td><?php echo e(is_null($task->performer) ? '' : $task->performer->name); ?></td>
                        <td><?php echo e($task->created_at); ?></td>
                        <td>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $task)): ?>
                                <a href="<?php echo e(route('tasks.destroy', $task)); ?>"
                                   class="text-red-600 hover:text-red-900"
                                   data-confirm="Вы уверены?"
                                   data-method="delete"
                                   rel="nofollow">
                                    <?php echo e(__('task.Delete')); ?>

                                </a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $task)): ?>
                                <a class="text-blue-600 hover:text-blue-900" href="<?php echo e(route('tasks.edit', $task)); ?>">
                                    <?php echo e(__('task.Edit')); ?>

                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/task/index.blade.php ENDPATH**/ ?>