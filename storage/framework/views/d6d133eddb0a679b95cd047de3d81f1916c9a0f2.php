<?php if (isset($component)) { $__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Layout::class, ['title' => 'Database']); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
        <div class="d-grid gap-2 d-md-block">
        <a href="<?php echo e(route('jobs.index', $id)); ?>" class="btn btn-sm btn-primary"><i
                data-feather="skip-back"></i>Back</a>
    </div>
    <form action="<?php echo e(route('import.add', $id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end"> 
        <label for="formFile" class="form-label">Browse your computer:</label>
        <input class="form-control" type="file" name="formFile" id="formFile">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
 <?php if (isset($__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30)): ?>
<?php $component = $__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30; ?>
<?php unset($__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?><?php /**PATH C:\wamp64\www\SuperDB\resources\views/jobs/import.blade.php ENDPATH**/ ?>