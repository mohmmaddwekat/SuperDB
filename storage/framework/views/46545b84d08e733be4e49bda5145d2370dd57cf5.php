    <?php if (isset($component)) { $__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Layout::class, ['title' => ''.e(__('Deleted Roles!')).'']); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>

    <div class="mb-4">
        <a href="<?php echo e(route('super-db.roles.index')); ?>" class="btn btn-sm btn-primary"><i
                data-feather="skip-back"></i>Back</a>
    </div>
    <?php if(session()->has('success')): ?>
        <div class="alert alert-success" role="alert">
            <?php echo e(session()->get('success')); ?>

        </div>
    <?php else: ?>

    <?php endif; ?>
    <table class="table table-hover">
        <span>
            <div class="pagination-block">
                <?php echo e($roles->links('components.paginationcountlink')); ?>

            </div>
        </span>
        <thead>
            <tr>
                <th>#
                </th>
                <th>Name</th>
                <th># abilities</th>
                <th>Deleted At
                </th>


                <th class="" scope="1">Options</th>



            </tr>
        </thead>
        <tbody>

            <?php $__empty_1 = true; $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($role['id']); ?>

                    <td>
                        <span class="font-weight-normal"> <?php echo e($role['name']); ?></span>
                    </td>
                    <td>
                        <span class="font-weight-normal"> </span>
                    </td>
                    <td><?php echo e($role['deleted_at']); ?>

                    </td>
                    <td>
                        <div class="btn-toolbar">
                            <div class="btn-group m-2">

                                <form action="<?php echo e(route('super-db.roles.restore', $role['id'])); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('put'); ?>
                                    <button type="submit" class="btn btn-sm btn-primary"><i data-feather="edit-3"></i>
                                        Restore</button>
                                </form>
                            </div>
                            <div class="btn-group m-2">

                                <form action="<?php echo e(route('super-db.roles.force-delete', $role['id'])); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('delete'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger"><i data-feather="x-octagon"></i>
                                        Delete</button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="4">
                        No Roles Found.
                    </td>
                </tr>
            <?php endif; ?>


        </tbody>
    </table>
    <div class="pagination-block">
        <?php echo e($roles->links('components.paginationlinks')); ?>

    </div>


     <?php if (isset($__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30)): ?>
<?php $component = $__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30; ?>
<?php unset($__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?><?php /**PATH C:\wamp64\www\SuperDB\resources\views/super-db/roles/trash.blade.php ENDPATH**/ ?>