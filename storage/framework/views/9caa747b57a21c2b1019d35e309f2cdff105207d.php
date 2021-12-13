<?php if (isset($component)) { $__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Layout::class, ['title' => ''.e(__('Insert table')).'']); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    <div class="d-grid gap-2 d-md-block">
        <a href="<?php echo e(route('super-db.jobs.index',  $connection->id)); ?>" class="btn btn-sm btn-primary"><i data-feather="skip-back"></i><?php echo e(__('Back')); ?></a>
      </div>
            <div class="container">
                <div class="row ">
                    <div class="col"></div>
                    <div class="col-md-8">
                        <form action="<?php echo e(route('super-db.inserts.store',  $connection->id)); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <label for="name table" class="form-label dark"><span class="font-weight-normal"><?php echo e(__('Enter name of table')); ?></span></label>
                                <input type="text" name="nametable" class="form-control" id="nametable">
                              </div>

                            <fieldset>
                                <div id="dynamic_field3" >
                                    <div class="form-row">
                                        <div class="col m-3">
                                            <td><button type="button" name="add" id="add3" class="btn btn-success"><i class="fa fa-plus"></i><?php echo e(__('Add New Column')); ?></button></td>
                                        </div>
                                        
                                    </div>
                                </div>
                                <br>
                                <div class="form-row"><br>
                                    <div class="col">
                                        <button type="submit" id='submit' name="submit" class="btn btn-primary "
                                            value="Save"><?php echo e(__('Save')); ?></button>
                                    </div>
                                </div>
                                <br>
                        </form>
                        </fieldset>
                    </div>
                    <div class="col"></div>
                </div>
            </div>









            <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
            <script>
                $(document).ready(function() {
                    var i = 1;

                    $('#add3').click(function() {
                        i++;
                        $('#dynamic_field3').append('<div class="form-row m-3" id="row3' + i +
                            '"> <div class="form-row"><div class="form-group col-md-6"><label for="NameColumn">Name column</label><input type="text" class="form-control" name="colunm[]"></div><div class="form-group col-md-6"><label for="Type">Type</label><select class="form-control" name="type[]"><option selected>select Type</option><option value="int">int</option><option value="varchar">varchar</option></select></div><div class="form-group col-md-6"><label for="LengthValues">Length/Values</label><input type="number" name="length[]" min="1" max="255"  class="form-control" ></div></div> <div class="col"> <td><button type="button" name="add"  class="btn btn-danger btn_remove3" id="' +
                            i + '"><i class="fa fa fa-trash"></i>Remove</button></td> </div> </div>');
                    });
                    $(document).on('click', '.btn_remove3', function() {
                        var button_id = $(this).attr("id");

                        $('#row3' + button_id + '').remove();
                    });

                });
            </script>
            <!-- JavaScript Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
            </script>

 <?php if (isset($__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30)): ?>
<?php $component = $__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30; ?>
<?php unset($__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?><?php /**PATH C:\wamp64\www\SuperDB\resources\views/super-db/inserts/index.blade.php ENDPATH**/ ?>