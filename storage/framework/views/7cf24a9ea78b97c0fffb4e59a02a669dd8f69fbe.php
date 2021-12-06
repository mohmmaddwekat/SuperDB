



<?php if (isset($component)) { $__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Layout::class, ['title' => ''.e(__('Databases')).'']); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>



    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <div class="row g-3">
  <div class="col-sm-7">
    <input type="text" class="form-control name" placeholder="<?php echo e(__('Add database')); ?>">
  </div>
  <div class="col-sm">
    <button type="button" class="btn btn-primary connection"><?php echo e(__('Create')); ?></button>
  </div>
</div>
      </div>
    <div>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col"><?php echo e(__('Database')); ?></th>
      <th scope="col"><?php echo e(__('Action')); ?></th>
    </tr>
  </thead>
  <tbody class="body">
   
  <?php if(sizeof($connections) > 0): ?> 
   <?php $__currentLoopData = $connections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $connection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><a href=""><?php echo e($connection->name); ?></a></td>
        <td><a type="button" href="<?php echo e(route('super-db.connection.delete', $connection->id )); ?>" class="btn btn-danger"><?php echo e(__('Delete')); ?></a>
        <a type="button" href="<?php echo e(route('super-db.jobs.index', $connection->id )); ?>" class="btn btn-primary"><?php echo e(__('Show')); ?></a></td>

      </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?> 
      <tr class="notfound">
        <td colspan="2">
        <h5 style="text-align: center;"><?php echo e(__('There are no databases, add a new one')); ?></h5>
        </td>
      </tr>
      <?php endif; ?>
    <tr>

    </tr>
    
  </tbody>
</table>
    </div>
<script src="/assets/js/connectoin.js"></script>
 <?php if (isset($__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30)): ?>
<?php $component = $__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30; ?>
<?php unset($__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php /**PATH C:\wamp64\www\SuperDB\resources\views/super-db/connections/connection.blade.php ENDPATH**/ ?>