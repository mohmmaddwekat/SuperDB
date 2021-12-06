<?php if (isset($component)) { $__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Layout::class, ['title' => ''.e(__('Rename column')).'']); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>

        <div class="container">
                <div class="row ">
                    <div class="col-md-8">
                        <form action="<?php echo e(route('inserts.update-column',  [$connection->id,$table,$namecolumn])); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <label for="name column" class="form-label"><?php echo e(__('Enter name of column')); ?></label>
                                <input type="text" name="namecolumn" class="form-control" id="namecolumn" value="<?php echo e($namecolumn); ?>">
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
<?php endif; ?><?php /**PATH C:\wamp64\www\SuperDB\resources\views/inserts/renameColumn.blade.php ENDPATH**/ ?>