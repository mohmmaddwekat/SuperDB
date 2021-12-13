<!-- Name -->
<div>
    <label for="name"><?php echo e(__('Name')); ?></label>
    <input type="text" name="name" id="name" value="<?php echo e(old('name', $role['name'])); ?>">

</div>

<div class="flex items-center justify-end mt-4 " style="font-family: Arial, Helvetica, sans-serif;">
    <button class="ml-4">
        <?php echo e(__($savelabel)); ?>


    </button>

</div>
<?php /**PATH C:\wamp64\www\SuperDB\resources\views/super-db/roles/_form.blade.php ENDPATH**/ ?>