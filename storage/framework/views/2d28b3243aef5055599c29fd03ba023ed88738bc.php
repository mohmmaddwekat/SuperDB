<?php if (isset($component)) { $__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Layout::class, ['title' => ''.e(__('Import')).'']); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
        <div class="d-grid gap-2 d-md-block">
        <a href="<?php echo e(route('super-db.jobs.index', $id)); ?>" class="btn btn-sm btn-primary"><i
                data-feather="skip-back"></i><?php echo e(__('Back')); ?></a>
    </div>
    <form action="<?php echo e(route('super-db.import.add', $id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
            <div class="col-5">
                <select class="form-select" name="type" aria-label="Default select example">
                    <option value="csv" selected>CSV <?php echo e(__('File')); ?></option>
                    <option value="text">Text <?php echo e(__('File')); ?></option>
                    <option value="sql">SQL <?php echo e(__('File')); ?></option>
                </select>
            </div>
        </div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end"> 
        <label for="formFile" class="form-label"><?php echo e(__('Browse your computer:')); ?></label>
        <input class="form-control" type="file" name="formFile" id="formFile">
        <button type="submit" class="btn btn-primary"><?php echo e(__('Save')); ?></button>
    </div>
</form>
 <?php if (isset($__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30)): ?>
<?php $component = $__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30; ?>
<?php unset($__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?><?php /**PATH C:\wamp64\www\SuperDB\resources\views/super-db/jobs/import.blade.php ENDPATH**/ ?>