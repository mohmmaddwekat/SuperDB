
<?php if (isset($component)) { $__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Layout::class, ['title' => ''.e(__('Add Query')).'']); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    <div class="d-grid gap-2 d-md-block">
        <a href="<?php echo e(route('jobs.index',  $connection->id)); ?>" class="btn btn-sm btn-primary"><i data-feather="skip-back"></i><?php echo e(__('Back')); ?></a>
      </div>
            <div class="row d-flex justify-content-center align-items-center h-100 mt-5">
                <div class="col col-md-12 col-lg-8 col-xl-6">
                    <form action="<?php echo e(route('sqls.store', $connection->id)); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label"><?php echo e(__('Enter Query')); ?></label>
                            <textarea class="form-control" name="query" id="exampleFormControlTextarea1"
                                rows="3"></textarea>
                        </div>
                        <div class="col-sm-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary me-1 mb-1"><?php echo e(__('Send')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
   
     <?php if (isset($__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30)): ?>
<?php $component = $__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30; ?>
<?php unset($__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php /**PATH C:\wamp64\www\SuperDB\resources\views/sqls/index.blade.php ENDPATH**/ ?>