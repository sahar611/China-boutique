

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">

  <div class="d-flex align-items-center justify-content-between mb-3">
    <div>
      <h4 class="mb-0"><?php echo e(__('messages.Dashboard')); ?></h4>
      <small class="text-muted"><?php echo e(__('messages.dashboard_subtitle')); ?></small>
    </div>
  </div>

  
  <div class="row g-3">

    <div class="col-12 col-md-6 col-lg-3">
      <div class="card h-100">
        <div class="card-body">
          <div class="text-muted mb-1"><?php echo e(__('messages.total_products')); ?></div>
          <h4 class="mb-0"><?php echo e($totalProducts); ?></h4>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
      <div class="card h-100">
        <div class="card-body">
          <div class="text-muted mb-1"><?php echo e(__('messages.active_products')); ?></div>
          <h4 class="mb-0"><?php echo e($activeProducts); ?></h4>
          <small class="text-muted"><?php echo e(__('messages.inactive_products')); ?>: <?php echo e($inactiveProducts); ?></small>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
      <div class="card h-100 border border-warning">
        <div class="card-body">
          <div class="text-muted mb-1"><?php echo e(__('messages.low_stock')); ?></div>
          <h4 class="mb-0"><?php echo e($lowStock); ?></h4>
          <small class="text-muted"><?php echo e(__('messages.threshold')); ?>: <?php echo e($lowStockThreshold); ?></small>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
      <div class="card h-100 border border-danger">
        <div class="card-body">
          <div class="text-muted mb-1"><?php echo e(__('messages.out_of_stock')); ?></div>
          <h4 class="mb-0"><?php echo e($outOfStock); ?></h4>
          <small class="text-muted"><?php echo e(__('messages.track_stock_only')); ?></small>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
      <div class="card h-100">
        <div class="card-body">
          <div class="text-muted mb-1"><?php echo e(__('messages.categories')); ?></div>
          <h4 class="mb-0"><?php echo e($totalCategories); ?></h4>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
      <div class="card h-100">
        <div class="card-body">
          <div class="text-muted mb-1"><?php echo e(__('messages.brands')); ?></div>
          <h4 class="mb-0"><?php echo e($totalBrands); ?></h4>
        </div>
      </div>
    </div>

  </div>

  
  <div class="row g-3 mt-1">

    
    <div class="col-12 col-lg-6">
      <div class="card h-100">
        <div class="card-header pb-0 d-flex align-items-center justify-content-between">
          <h6 class="mb-0"><?php echo e(__('messages.latest_products')); ?></h6>
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('products.view')): ?>
            <a href="<?php echo e(route('admin.products.index')); ?>" class="btn btn-outline-secondary btn-sm">
              <?php echo e(__('messages.view_all')); ?>

            </a>
          <?php endif; ?>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th><?php echo e(__('messages.name')); ?></th>
                  <th><?php echo e(__('messages.stock')); ?></th>
                  <th><?php echo e(__('messages.status')); ?></th>
                  <th class="text-end"><?php echo e(__('messages.actions')); ?></th>
                </tr>
              </thead>
              <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $latestProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                  <tr>
                    <td>
                      <strong><?php echo e(app()->isLocale('ar') ? $p->name_ar : $p->name_en); ?></strong>
                      <?php if($p->sku): ?>
                        <div class="text-muted small">SKU: <?php echo e($p->sku); ?></div>
                      <?php endif; ?>
                    </td>
                    <td><?php echo e($p->stock); ?></td>
                    <td>
                      <?php if($p->is_active): ?>
                        <span class="badge bg-success"><?php echo e(__('messages.status_active')); ?></span>
                      <?php else: ?>
                        <span class="badge bg-secondary"><?php echo e(__('messages.status_inactive')); ?></span>
                      <?php endif; ?>
                    </td>
                    <td class="text-end">
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('products.view')): ?>
                        <a class="btn btn-outline-secondary btn-sm" href="<?php echo e(route('admin.products.show', $p->id)); ?>">
                          <?php echo e(__('messages.view')); ?>

                        </a>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                  <tr><td colspan="4" class="text-center text-muted p-3"><?php echo e(__('messages.no_data')); ?></td></tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    
    <div class="col-12 col-lg-6">
      <div class="card h-100">
        <div class="card-header pb-0">
          <h6 class="mb-0"><?php echo e(__('messages.inventory_alerts')); ?></h6>
        </div>
        <div class="card-body">

          <div class="mb-3">
            <div class="d-flex align-items-center justify-content-between">
              <strong><?php echo e(__('messages.out_of_stock')); ?></strong>
              <span class="badge bg-danger"><?php echo e($outOfStock); ?></span>
            </div>
            <div class="table-responsive mt-2">
              <table class="table mb-0">
                <tbody>
                  <?php $__empty_1 = true; $__currentLoopData = $outOfStockProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                      <td><?php echo e(app()->isLocale('ar') ? $p->name_ar : $p->name_en); ?></td>
                      <td class="text-end">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('products.stock_edit')): ?>
                          <a class="btn btn-outline-warning btn-sm" href="<?php echo e(route('admin.products.stock.edit', $p->id)); ?>">
                            <?php echo e(__('messages.stock')); ?>

                          </a>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td class="text-muted"><?php echo e(__('messages.no_data')); ?></td></tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>

          <hr>

          <div>
            <div class="d-flex align-items-center justify-content-between">
              <strong><?php echo e(__('messages.low_stock')); ?></strong>
              <span class="badge bg-warning text-dark"><?php echo e($lowStock); ?></span>
            </div>
            <small class="text-muted"><?php echo e(__('messages.threshold')); ?>: <?php echo e($lowStockThreshold); ?></small>

            <div class="table-responsive mt-2">
              <table class="table mb-0">
                <tbody>
                  <?php $__empty_1 = true; $__currentLoopData = $lowStockProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                      <td>
                        <?php echo e(app()->isLocale('ar') ? $p->name_ar : $p->name_en); ?>

                        <span class="badge bg-light text-dark ms-2"><?php echo e($p->stock); ?></span>
                      </td>
                      <td class="text-end">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('products.stock_edit')): ?>
                          <a class="btn btn-outline-warning btn-sm" href="<?php echo e(route('admin.products.stock.edit', $p->id)); ?>">
                            <?php echo e(__('messages.stock')); ?>

                          </a>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td class="text-muted"><?php echo e(__('messages.no_data')); ?></td></tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>

          </div>

        </div>
      </div>
    </div>

  </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/dashboard/index.blade.php ENDPATH**/ ?>