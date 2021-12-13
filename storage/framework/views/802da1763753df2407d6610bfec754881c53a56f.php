<?php if (isset($component)) { $__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Layout::class, ['title' => ''.e(__('Connection')).'']); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>

  <?php
  $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
       
?>

  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
  <div class="row g-3">
<div class="col-sm-7">
   <?php if(in_array('super-db.connection.add',$roles_permissions)): ?>
  <input type="text" class="form-control name" placeholder="<?php echo e(__('Add database')); ?>">
  <?php endif; ?>
</div>
<div class="col-sm">
  <?php if(in_array('super-db.connection.add',$roles_permissions)): ?>
  <button type="button" class="btn btn-primary connection"><?php echo e(__('Create')); ?></button>
  <?php endif; ?>
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
        <td><span class="font-weight-normal"><?php echo e($connection->name); ?></span></td>
       
        <td>
          <?php if(in_array('super-db.connection.delete',$roles_permissions)): ?>
          <a type="button" href="<?php echo e(route('super-db.connection.delete', $connection->id )); ?>" class="btn btn-danger"><?php echo e(__('Delete')); ?></a>
          <?php endif; ?>
          <?php if(in_array('super-db.jobs.index',$roles_permissions)): ?>

          <a type="button" href="<?php echo e(route('super-db.jobs.index', $connection->id )); ?>" class="btn btn-primary"><?php echo app('translator')->get('Show'); ?> </a></td>
          <?php endif; ?>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?> 
      <tr class="notfound">
        <td colspan="2">
        <h5 style="text-align: center;"><span class="font-weight-normal"><?php echo e(__('There are no databases, add a new one')); ?></span></h5>
        </td>
      </tr>
      <?php endif; ?>
    <tr>
    </tr>
</tbody>
</table>
  </div>

  <script>
$(document).ready(function () {
  $(".connection").click(function () {
      $.ajax({
          headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
          url: "connection/add/" + $(".name").val(),
          // contentType: "application/json; charset=utf-8",
          type: "POST",
          dataType: "json",
          success: function (result) {
            if (result.length != 0) {
              $("tbody").append(
                  `<tr><td>${result[0].name}</td><td><a type="button" href="connection/delete/${result[0].id}" class="btn btn-danger"><?php echo e(__('Delete')); ?></a>
                  <a type="button" href="jobs/${result[0].id}" class="btn btn-primary"><?php echo app('translator')->get('Show'); ?></a></td></tr>`
              );
              $(".notfound").remove();
              $(".name").val("");
            }
            if (result.length === 0) {
              alert("Connection is Already Exists");
            }
            
           
          },
      });
  });
});

  </script>
 <?php if (isset($__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30)): ?>
<?php $component = $__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30; ?>
<?php unset($__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php /**PATH C:\wamp64\www\SuperDB\resources\views/super-db/connections/index.blade.php ENDPATH**/ ?>