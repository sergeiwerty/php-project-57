<?php $__env->startSection('content'); ?>
    <div class="grid col-span-full">
        <h1 class="mb-5"><?php echo e(__('label.Labels')); ?></h1>
        <?php if(auth()->guard()->check()): ?>
            <div>
                <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                   href=<?php echo e(route('labels.create')); ?>>
                    <?php echo e(__('label.Create label')); ?>

                </a>
            </div>
        <?php endif; ?>
        <?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <table class="mt-4">
            <thead class="border-b-2 border-solid border-black text-left">
            <tr>
                <th>ID</th>
                <th><?php echo e(__('label.Label name')); ?></th>
                <th><?php echo e(__('label.Description')); ?></th>
                <th><?php echo e(__('label.Date of creation')); ?></th>
                <?php if(auth()->guard()->check()): ?>
                    <th><?php echo e(__('label.Actions')); ?></th>
                <?php endif; ?>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-b border-dashed text-left">
                    <th><?php echo e($label->id); ?></th>
                    <td><?php echo e($label->name); ?></td>
                    <td><?php echo e($label->description); ?></td>
                    <td><?php echo e($label->created_at->format('d.m.Y')); ?></td>
                    <td>
                        <?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(route('labels.destroy', $label)); ?>"
                               class="text-red-600 hover:text-red-900"
                               data-confirm="Вы уверены?"
                               data-method="delete"
                               rel="nofollow">
                                <?php echo e(__('label.Delete')); ?>

                            </a>
                            <a class="text-blue-600 hover:text-blue-900" href="<?php echo e(route('labels.edit', $label)); ?>">
                                <?php echo e(__('label.Edit')); ?>

                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/user/development/php-project-lvl4/resources/views/label/index.blade.php ENDPATH**/ ?>