<?php $__env->startSection('content'); ?>
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
            <div class="grid col-span-full">
                    <h1 class="mb-5">Создать статус</h1>















                <?php echo e(Form::model($taskStatus, ['url' => route('task_statuses.store'), 'class' => 'w-50'])); ?>

                    <?php echo csrf_field(); ?>
                    <div class="flex flex-col">














                        <?php echo $__env->make('taskStatus.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="mt-5">
                            <?php echo e(Form::submit('Создать', ['class' => "bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"])); ?>

                        </div>
                    </div>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/taskStatus/create.blade.php ENDPATH**/ ?>