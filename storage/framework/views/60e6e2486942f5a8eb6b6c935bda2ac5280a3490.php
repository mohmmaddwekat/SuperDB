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
                    <p class="stat-cards-info__num"><?php echo e(__('The number of database created')); ?></p>
                    <p class="stat-cards-info__title"><?php echo e($numberOfdatabase); ?></p>
                </div>
            </article>
        </div>


        <div class="col-md-6 col-xl-4">
            <article class="stat-cards-item">
                <div class="stat-cards-icon primary">
                    <i data-feather="users" aria-hidden="true"></i>
                </div>
                <div class="stat-cards-info text-center">
                    <p class="stat-cards-info__num"><?php echo e(__('The number of Users created')); ?></p>
                    <p class="stat-cards-info__title"><?php echo e($numberOfUsers); ?></p>
                </div>
            </article>
        </div>
    </div>

    <div class="chart-container row">
        <div class="pie-chart-container col-5">
          <canvas id="pie-chart"></canvas>
        </div>
      </div>
    </div>

      <!-- javascript -->

      <script>
        $(function(){
            //get the pie chart canvas
            var cData = JSON.parse(`<?php echo $chart_data; ?>`);
            var ctx = $("#pie-chart");
       
            //pie chart data
            var data = {
              labels: cData.label,
              datasets: [
                {
                  label: "Database Count",
                  data: cData.data,
                  backgroundColor: [
                    "#DEB887",
                    "#A9A9A9",
                    "#DC143C",
                    "#F4A460",
                    "#2E8B57",
                    "#1D7A46",
                    "#CDA776",
                  ],
                  borderColor: [
                    "#CDA776",
                    "#989898",
                    "#CB252B",
                    "#E39371",
                    "#1D7A46",
                    "#F4A460",
                    "#CDA776",
                  ],
                  borderWidth: [1, 1, 1, 1, 1,1,1]
                }
              ]
            };
       
            //options
            var options = {
              responsive: true,
              title: {
                display: true,
                position: "top",
                text: "Last Week Registered Users -  Day Wise Count",
                fontSize: 18,
                fontColor: "#111"
              },
              legend: {
                display: true,
                position: "bottom",
                labels: {
                  fontColor: "#333",
                  fontSize: 16
                }
              }
            };
       
            //create Pie Chart class object
            var chart1 = new Chart(ctx, {
              type: "bar",
              data: data,
              options: options
            });
       
        });
      </script>


     <?php if (isset($__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30)): ?>
<?php $component = $__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30; ?>
<?php unset($__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php /**PATH C:\wamp64\www\SuperDB\resources\views/super-db/dashboard.blade.php ENDPATH**/ ?>