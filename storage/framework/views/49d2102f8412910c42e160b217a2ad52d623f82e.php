    <?php if (isset($component)) { $__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Layout::class, ['title' => ''.e(__('List Roles')).'']); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>

        <?php
            $roles_permissions = Auth::user()
                ->role->permissions()
                ->pluck('code')
                ->toArray();
            
        ?>




        <div class="card card-body border-light shadow-sm table-wrapper table-responsive pt-0">
            <div class="row my-2">
                <div class="btn-toolbar">

                    <div class="col col-md-6 col-lg-3 col-xl-4 ">
                        <div class="btn-group m-2">
                            <?php if(in_array('super-db.roles.create', $roles_permissions)): ?>
                                <a href="<?php echo e(route('super-db.roles.create')); ?>"><button class="btn btn-primary btn-sm  "
                                        aria-haspopup="true" aria-expanded="false"> <span class="fas fa-plus mr-2"><i
                                                data-feather="plus-circle"></i><?php echo e(__('Create new Roles')); ?></span></button></a>

                            <?php endif; ?>
                        </div>
                    </div>


                </div>



            </div>
            <table class="table table-hover">

                <thead>
                    <tr>
                        <th class="dataTable-sorter">#</th>
                        <th><?php echo e(__('Name')); ?></th>
                        <th><?php echo e(__('# permissions')); ?></th>
                        <th></th>
                        <th class="" scope="2"><?php echo e(__('Options')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Item -->
                    <?php $__empty_1 = true; $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <a class="font-weight-bold">
                                    <?php echo e($role['id']); ?>

                                </a>
                            </td>
                            <td>
                                <span class="font-weight-normal"> <?php echo e($role['name']); ?></span>
                            </td>
                            <td>
                                <?php $__currentLoopData = $role->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class=""><?php echo e($permission->pivot->permission_id); ?></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                            <td>


                            </td>
                            <td>
                                <div class="btn-group mb-1 text-dark">

                                    <?php if(in_array('super-db.roles.edit', $roles_permissions)): ?>
                                        <a class="dropdown-item icon icon-left"
                                            href="<?php echo e(route('super-db.roles.edit', [$role['id']])); ?>"><span
                                                class="fas fa-edit mr-2"><i
                                                    data-feather="edit"></i><?php echo e(__('Edit')); ?></span></a>

                                        <?php endif; ?>
                                    <?php if(count($role->permissions) == 0): ?>
                                        <?php if(in_array('super-db.permissions.create', $roles_permissions)): ?>
                                            <a class="dropdown-item icon icon-left"
                                                href="<?php echo e(route('super-db.permissions.create', $role['id'])); ?>"><span
                                                    class="fas fa-edit mr-2"><i
                                                        data-feather="edit"></i><?php echo e(__('Create permissions')); ?></span></a>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php if(in_array('super-db.permissions.edit', $roles_permissions)): ?>
                                            <a class="dropdown-item icon icon-left"
                                                href="<?php echo e(route('super-db.permissions.edit', $role['id'])); ?>"><span
                                                    class="fas fa-edit mr-2"><i
                                                        data-feather="edit"></i><?php echo e(__('Edit permissions')); ?></span></a>

                                        <?php endif; ?>
                                        <?php if(in_array('super-db.roles.destroy', $roles_permissions)): ?>
                                            <form action="<?php echo e(route('super-db.roles.destroy', $role['id'])); ?>"
                                                method="post">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('delete'); ?>
                                                <button type="submit" class="dropdown-item text-danger"><span
                                                        class="fas fa-trash-alt mr-2"><i
                                                            data-feather="trash"></i><?php echo e(__('Delete')); ?></span></button>
                                            </form>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                </div>


                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="10">
                            No Roles Found.
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
<?php /**PATH C:\wamp64\www\SuperDB\resources\views/super-db/roles/index.blade.php ENDPATH**/ ?>