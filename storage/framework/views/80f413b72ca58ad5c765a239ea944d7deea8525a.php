<?php if (isset($component)) { $__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Layout::class, ['title' => __('Table')]); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    <?php
    $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
         
  ?>
    <div class="d-grid gap-2 d-md-block">
        <a href="<?php echo e(route('super-db.jobs.index', $connection->id)); ?>" class="btn btn-sm btn-primary"><i
                data-feather="skip-back"></i><?php echo e(__('Back')); ?></a>

    </div>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
         <?php if(in_array('super-db.jobs.versionControl',$roles_permissions)): ?>
            <a href="<?php echo e(route('super-db.jobs.versionControl', [$table,$connection->id])); ?>" class="mr-2"><button class="btn btn-primary"><?php echo e(__('Version Control')); ?></button></a>
        <?php endif; ?>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <?php echo e(__('Export')); ?>

        </button>
        <div class="d-grid gap-2 d-md-block">
            <?php if(in_array('super-db.inserts.add-row',$roles_permissions)): ?>
            <a href="<?php echo e(route('super-db.inserts.add-row',[$table,$connection->id])); ?>"class="mr-2"><button  class="btn btn-primary"><?php echo e(__('Add Row')); ?></button></a>
            <?php endif; ?>
        </div>
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
                    <?php if(in_array('super-db.db.export',$roles_permissions)): ?>
                    <a href="<?php echo e(route('super-db.db.export', [$connection->id, 'sql',$table])); ?>" class="mx-2"><button
                            class="btn btn-primary" type="button">Sql <?php echo e(__('File')); ?></button></a>
                            <?php endif; ?>     
                    <?php if(in_array('super-db.db.export',$roles_permissions)): ?>        
                    <a href="<?php echo e(route('super-db.db.export', [$connection->id, 'csv',$table])); ?>"><button class="btn btn-primary"
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
                    <?php $__currentLoopData = $colunms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $colunm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th>
                            <div class="d-grid gap-2 d-md-flex ">

                            
                            <span class="font-weight-normal"><?php echo e($colunm[0]); ?></span>
                            <?php if(in_array('super-db.jobs.delete-column',$roles_permissions)): ?>
                            <form action="<?php echo e(route('super-db.jobs.delete-column', [$connection->id,$table,$colunm[0]])); ?>" method="post" class="mx-2">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('delete'); ?>
                                <button type="submit" class="text-danger p-0 m-0 border-0 bg-white " ><?php echo e(__('Delete')); ?>/</button>
                            </form>
                            <?php endif; ?>
                            <?php if(in_array('super-db.inserts.rename-column',$roles_permissions)): ?>
                            <a href="<?php echo e(route('super-db.inserts.rename-column', [$connection->id,$table,$colunm[0]])); ?>" ><?php echo e(__('Rename')); ?></a>
                            <?php endif; ?>
                        </div>
                        </th>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                </tr>
            </thead>
            <tbody>
                <!-- Item -->
                <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tr>
                        <th><span class="font-weight-normal"><?php echo e($key); ?></span></th>

                        <?php $__currentLoopData = $colunms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $colunm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th><span class="font-weight-normal"><?php echo e($row[$colunm[0]]); ?></span></th>
                            
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            </tbody>
        </table>
    </div>


 <?php if (isset($__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30)): ?>
<?php $component = $__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30; ?>
<?php unset($__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php /**PATH C:\wamp64\www\SuperDB\resources\views/super-db/jobs/viewcolumn.blade.php ENDPATH**/ ?>