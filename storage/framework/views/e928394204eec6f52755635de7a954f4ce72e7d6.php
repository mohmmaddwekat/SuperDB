<?php if (isset($component)) { $__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Layout::class, ['title' => ''.e(__('Dashboard')).'']); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    <div class="row stat-cards">
        <div class="col-md-6 col-xl-4">
            <article class="stat-cards-item">
                <div class="stat-cards-icon primary">
                    <i data-feather="database" aria-hidden="true"></i>
                </div>
                <div class="stat-cards-info text-center">
                    <p class="stat-cards-info__num">The number of database created</p>
                    <p class="stat-cards-info__title"><?php echo e($number_database); ?></p>
                </div>
            </article>
        </div>


        <div class="col-md-6 col-xl-4">
            <article class="stat-cards-item">
                <div class="stat-cards-icon primary">
                    <i data-feather="users" aria-hidden="true"></i>
                </div>
                <div class="stat-cards-info text-center">
                    <p class="stat-cards-info__num">The number of Users created</p>
                    <p class="stat-cards-info__title">0</p>
                </div>
            </article>
        </div>
    </div>

     <?php if (isset($__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30)): ?>
<?php $component = $__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30; ?>
<?php unset($__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php /**PATH C:\wamp64\www\SuperDB\resources\views/dashboard.blade.php ENDPATH**/ ?>