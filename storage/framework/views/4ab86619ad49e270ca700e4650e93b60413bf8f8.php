<?php if (isset($component)) { $__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Layout::class, ['title' => __('Tables')]); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>

    <div class="d-grid gap-2 d-md-block">
        <a href="<?php echo e(route('super-db.connection.index')); ?>" class="btn btn-sm btn-primary"><i
                data-feather="skip-back"></i><?php echo e(__('Back')); ?></a>
        <a href="<?php echo e(route('super-db.sqls.index', $connection->id)); ?>"><button class="btn btn-primary"
                type="button">Sql</button></a>
        <a href="<?php echo e(route('super-db.inserts.index', $connection->id)); ?>"><button class="btn btn-primary"
                type="button"><?php echo e(__('Insert')); ?></button></a>
    </div>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="<?php echo e(route('super-db.import.index', $connection->id)); ?>" class="mr-2"><button class="btn btn-primary" type="button"><?php echo e(__('Import')); ?></button></a>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <?php echo e(__('Export')); ?>

        </button>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><?php echo e(__('Select method you want to export data')); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-center">
                    <a href="<?php echo e(route('super-db.db.export', [$connection->id, 'sql'])); ?>" class="mx-2"><button
                            class="btn btn-primary" type="button">Sql <?php echo e(__('File')); ?></button></a>
                    <a href="<?php echo e(route('super-db.db.export', [$connection->id, 'csv'])); ?>"><button class="btn btn-primary"
                            type="button">Csv <?php echo e(__('File')); ?></button></a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                </div>
            </div>
        </div>
    </div>


    <div>
        <table class="table table-hover">

            <thead>
                <tr>

                    <th>#</th>
                    <th><?php echo e(__('Name')); ?></th>
                    <th><?php echo e(__('Options')); ?></th>
                    <th></th>
                    <th scope="3"></th>

                </tr>
            </thead>
            <tbody>
                <!-- Item -->
                <?php $__empty_1 = true; $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>

                        <td><span class="font-weight-normal"><?php echo e($key); ?></span></td>
                        <td><span class="font-weight-normal"><?php echo e($table); ?></span></td>
                        <td>
                            <div class="d-grid gap-2 d-md-flex ">
                                <a href="<?php echo e(route('super-db.jobs.view-column', [$table, $connection->id])); ?>"><button
                                        class="btn btn-primary" type="button"><?php echo e(__('Show')); ?></button></a>
                                <form action="<?php echo e(route('super-db.jobs.delete-table', [$connection->id, $table])); ?>" method="post"
                                    class="mx-2">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('delete'); ?>
                                    <button type="submit" class="btn btn-danger"><?php echo e(__('Delete')); ?></button>
                                </form>
                                <a href="<?php echo e(route('super-db.inserts.rename-table', [$connection->id, $table])); ?>"><button
                                        class="btn btn-warning" type="button"><?php echo e(__('Rename')); ?></button></a>
                            </div>

                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="10">
                            <?php echo e(__('No Tables Found.')); ?>

                        </td>
                    </tr>
                <?php endif; ?>


            </tbody>
        </table>
    </div>


 <?php if (isset($__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30)): ?>
<?php $component = $__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30; ?>
<?php unset($__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php /**PATH C:\wamp64\www\SuperDB\resources\views/super-db/jobs/index.blade.php ENDPATH**/ ?>