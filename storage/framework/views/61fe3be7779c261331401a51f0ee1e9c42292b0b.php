<div class="form-group">
    <label for="" class="text-capitalize">Add admin permissions</label>
    <div>
        <?php $__currentLoopData = $abilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $abilitiy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="abilitiy[]" value="<?php echo e($abilitiy->id); ?>" <?php if(in_array($abilitiy['id'], $roles_Abilitiles)): ?> checked <?php endif; ?> >
                <label class="form-check-label text-capitalize">
                    <?php echo e($abilitiy->explain); ?>

                </label>
            </div>
            <?php if($abilitiy->id % 8 === 0): ?>
                <hr class="pt-1">
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>


<div class="flex items-center justify-end mt-4 " style="font-family: Arial, Helvetica, sans-serif;">

    <button class="ml-4">
        <?php echo e($savelabel); ?>


    </button>
</div>
<?php /**PATH C:\wamp64\www\SuperDB\resources\views/super-db/abilities/_form.blade.php ENDPATH**/ ?>