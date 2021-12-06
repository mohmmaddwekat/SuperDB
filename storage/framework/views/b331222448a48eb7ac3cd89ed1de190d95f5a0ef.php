<?php if (isset($component)) { $__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Layout::class, ['title' => ''.e(__('Rename table')).'']); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    <div class="d-grid gap-2 d-md-block">
        <a href="<?php echo e(route('jobs.index',  $connection->id)); ?>" class="btn btn-sm btn-primary"><i data-feather="skip-back"></i><?php echo e(__('Back')); ?></a>
    </div>
        <div class="container">
                <div class="row ">
                    <div class="col-md-8">
                        <form action="<?php echo e(route('inserts.updateTable',  [$connection->id,$table])); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <label for="name table" class="form-label"><?php echo e(__('Enter name of table')); ?></label>
                                <input type="text" name="nametable" class="form-control" id="nametable" value="<?php echo e($table); ?>">
                              </div>
                              <button type="submit" class="btn btn-primary "><?php echo e(__('Rename')); ?></button>
                        </form>
                    </div>
                </div>
        </div>

 <?php if (isset($__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30)): ?>
<?php $component = $__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30; ?>
<?php unset($__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?><?php /**PATH C:\wamp64\www\SuperDB\resources\views/inserts/renameTable.blade.php ENDPATH**/ ?>