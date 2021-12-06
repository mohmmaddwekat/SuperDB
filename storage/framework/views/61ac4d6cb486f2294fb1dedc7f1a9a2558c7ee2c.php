<?php if (isset($component)) { $__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Layout::class, ['title' => ''.e(__('Create Users')).'']); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>

    <header class="register " id="Main">
        <div class="row justify-content-center  ">
            <div class="col-md-6 col-12 ">
                <div class="card shadow-lg p-3 mb-5 bg-body rounded">
                    <div class="card-content text-start">
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.auth-validation-errors','data' => ['class' => 'mb-4 ','errors' => $errors]]); ?>
<?php $component->withName('auth-validation-errors'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'mb-4 ','errors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors)]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>

                        <div class="card-body  text-dark">
                            <form action="<?php echo e(route('users.store')); ?>" method="post" >
                                <?php echo csrf_field(); ?>
                                <h1 class="  text-center"><?php echo e(__('Sign Up')); ?></h1>
                                <div class="form-group">
                                    <label for="Username" class="form-label "><?php echo e(__('Username')); ?></label>
                                    <input type="text" value="<?php echo e(old('username')); ?>" name="username" class="form-control  <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                  </div>

                                  <div class="row g-3 mt-2">
                                    <div class="col-6">
                                      <label for="firstname" class="form-label"><?php echo e(__('First Name')); ?></label>
                                      <input type="text" value="<?php echo e(old('firstname')); ?>"  class="form-control  <?php $__errorArgs = ['firstname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="firstname">
                                    </div>
                                    <div class="col-6">
                                      <label for="lastname" class="form-label"><?php echo e(__('Last Name')); ?></label>
                                      <input type="text" value="<?php echo e(old('lastname')); ?>" class="form-control  <?php $__errorArgs = ['lastname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="lastname">
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label for="Email" class="form-label "><?php echo e(__('Email')); ?></label>
                                    <input type="email" value="<?php echo e(old('email')); ?>" name="email" class="form-control  <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" >
                                  </div>

                                  <div class="form-group">
                                    <label for="Password" class="form-label "><?php echo e(__('Password')); ?></label>
                                    <input type="password"  name="password" class="form-control  <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> " >
                                  </div>

                                <div class="form-group">
                                    <label  class="form-label "><?php echo e(__('Types')); ?></label>
                                    <select name="type" class="form-select  <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" >
                                        <option  value="">Choose Types of admins</option>
                                        <option <?php if(old('type') == "admin"): ?> selected <?php endif; ?> value="admin"><?php echo e(__('Admin')); ?></option>
                                        <option <?php if(old('type') == "staff"): ?> selected <?php endif; ?> value="staff"><?php echo e(__('Staff')); ?></option>
                                        <option <?php if(old('type') == "reader"): ?> selected <?php endif; ?> value="reader"><?php echo e(__('Reader')); ?></option>
                                    </select>
                                </div>
                                <!-- Type of roles -->
                                <div class="mt-4">
                                  <label for="Type of roles"><?php echo e(__('Type of roles')); ?></label>
                                  <select name="role_id" class="form-select col-md-8 col-lg-12 <?php $__errorArgs = ['role_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="">
                                      <option value="">No role</option>
                                      <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <option value="<?php echo e($role['id']); ?>" <?php if($role->id == old('role_id')): ?> selected <?php endif; ?>><?php echo e($role['name']); ?></option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </select>
                                </div>
                                <div class="form-group mt-4  ">
                                    <button class="btn btn-primary  "><?php echo e(__('Sign Up')); ?></button>
                                </div>
                              </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </header>

 <?php if (isset($__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30)): ?>
<?php $component = $__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30; ?>
<?php unset($__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?><?php /**PATH C:\wamp64\www\SuperDB\resources\views/users/register.blade.php ENDPATH**/ ?>