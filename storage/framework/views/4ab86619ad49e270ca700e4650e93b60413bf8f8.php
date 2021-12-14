<?php if (isset($component)) { $__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Layout::class, ['title' => __('Tables')]); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    <?php
    $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
         
  ?>

    <div class="d-grid gap-2 d-md-block">
        <?php if(in_array('super-db.connection.index',$roles_permissions)): ?>
        <a href="<?php echo e(route('super-db.connection.index')); ?>" class="btn btn-sm btn-primary"><i
                data-feather="skip-back"></i><?php echo e(__('Back')); ?></a>
        <?php endif; ?>
        <?php if(in_array('super-db.sqls.index',$roles_permissions)): ?>
        <a href="<?php echo e(route('super-db.sqls.index', $connection->id)); ?>"><button class="btn btn-primary"
                type="button">Sql</button></a>
        <?php endif; ?>
        <?php if(in_array('super-db.inserts.index',$roles_permissions)): ?>
        <a href="<?php echo e(route('super-db.inserts.index', $connection->id)); ?>"><button class="btn btn-primary"
                type="button"><?php echo e(__('Insert')); ?></button></a>
        <?php endif; ?>        
    </div>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <?php if(in_array('super-db.import.index',$roles_permissions)): ?>
        <a href="<?php echo e(route('super-db.import.index', $connection->id)); ?>" class="mr-2"><button class="btn btn-primary" type="button"><?php echo e(__('Import')); ?></button></a>
        <?php endif; ?>
        <?php if(in_array('super-db.versionControl.index',$roles_permissions)): ?>
        <a href="<?php echo e(route('super-db.versionControl.index', $connection->id)); ?>" class="mr-2"><button class="btn btn-primary" type="button"><?php echo e(__('Take Snapshot')); ?></button></a>
        <?php endif; ?> 

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <?php echo e(__('Export')); ?>

        </button>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content main-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><span class="font-weight-normal"><?php echo e(__('Select method you want to export data')); ?></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-center">
                    <?php if(in_array('super-db.db.export',$roles_permissions)): ?>
                    <a href="<?php echo e(route('super-db.db.export', [$connection->id, 'sql'])); ?>" class="mx-2"><button
                            class="btn btn-primary" type="button">Sql <?php echo e(__('File')); ?></button></a>
                            <?php endif; ?>     
                    <?php if(in_array('super-db.db.export',$roles_permissions)): ?>        
                    <a href="<?php echo e(route('super-db.db.export', [$connection->id, 'csv'])); ?>"><button class="btn btn-primary"
                            type="button">Csv <?php echo e(__('File')); ?></button></a>
                            <?php endif; ?> 
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
                                <?php if(in_array('super-db.jobs.view-column',$roles_permissions)): ?>
                                <a href="<?php echo e(route('super-db.jobs.view-column', [$table, $connection->id])); ?>"><button
                                        class="btn btn-primary" type="button"><?php echo e(__('Show')); ?></button></a>
                                <?php endif; ?>
                                <?php if(in_array('super-db.jobs.delete-table',$roles_permissions)): ?>            
                                <form action="<?php echo e(route('super-db.jobs.delete-table', [$connection->id, $table])); ?>" method="post"
                                    class="mx-2">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('delete'); ?>
                                    <button type="submit" class="btn btn-danger"><?php echo e(__('Delete')); ?></button>
                                </form>
                                <?php endif; ?>
                                <?php if(in_array('super-db.inserts.rename-table',$roles_permissions)): ?>     
                                <a href="<?php echo e(route('super-db.inserts.rename-table', [$connection->id, $table])); ?>"><button
                                        class="btn btn-warning" type="button"><?php echo e(__('Rename')); ?></button></a>
                                        <?php endif; ?>
                            </div>

                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="10">
                            <span class="font-weight-normal"><?php echo e(__('No Tables Found.')); ?></span>
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