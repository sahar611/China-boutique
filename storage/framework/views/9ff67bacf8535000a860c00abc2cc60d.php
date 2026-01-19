

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">

  <div class="card">

    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
      <div>
        <h5 class="mb-0"><?php echo e(__('messages.product_details')); ?></h5>
        <small class="text-muted">
          <?php echo e(app()->isLocale('ar') ? $product->name_ar : $product->name_en); ?>

        </small>
      </div>

      <div class="d-flex gap-2">

        <a href="<?php echo e(route('admin.products.index')); ?>" class="btn btn-outline-secondary btn-sm">
          <?php echo e(__('messages.back')); ?>

        </a>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('products.edit')): ?>
          <a href="<?php echo e(route('admin.products.edit', $product->id)); ?>" class="btn btn-primary btn-sm">
            <?php echo e(__('messages.edit')); ?>

          </a>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('products.create')): ?>
          <form method="POST" action="<?php echo e(route('admin.products.duplicate', $product->id)); ?>" style="display:inline-block"
                onsubmit="return confirm('<?php echo e(__('messages.confirm_duplicate')); ?>')">
            <?php echo csrf_field(); ?>
            <button class="btn btn-dark btn-sm">
              <?php echo e(__('messages.duplicate')); ?>

            </button>
          </form>
        <?php endif; ?>

      </div>
    </div>

    <div class="card-body">

      <div class="row g-3">

        <div class="col-md-6">
          <div class="border rounded p-3">
            <h6 class="mb-3"><?php echo e(__('messages.basic_info')); ?></h6>

            <div class="mb-2">
              <strong><?php echo e(__('messages.name_en')); ?>:</strong>
              <div><?php echo e($product->name_en ?: '-'); ?></div>
            </div>

            <div class="mb-2">
              <strong><?php echo e(__('messages.name_ar')); ?>:</strong>
              <div><?php echo e($product->name_ar ?: '-'); ?></div>
            </div>

            <div class="mb-2">
              <strong><?php echo e(__('messages.slug')); ?>:</strong>
              <div><?php echo e($product->slug ?: '-'); ?></div>
            </div>

            <div class="mb-2">
              <strong><?php echo e(__('messages.sku')); ?>:</strong>
              <div><?php echo e($product->sku ?: '-'); ?></div>
            </div>

            <div class="mb-2">
              <strong><?php echo e(__('messages.category')); ?>:</strong>
              <div>
                <?php echo e($product->category ? (app()->isLocale('ar') ? $product->category->name_ar : $product->category->name_en) : '-'); ?>

              </div>
            </div>

            <div class="mb-2">
              <strong><?php echo e(__('messages.brand')); ?>:</strong>
              <div>
                <?php echo e($product->brand ? (app()->isLocale('ar') ? $product->brand->name_ar : $product->brand->name_en) : '-'); ?>

              </div>
            </div>

            <div class="mb-2">
              <strong><?php echo e(__('messages.status')); ?>:</strong>
              <div>
                <?php if($product->is_active): ?>
                  <span class="badge bg-success"><?php echo e(__('messages.status_active')); ?></span>
                <?php else: ?>
                  <span class="badge bg-secondary"><?php echo e(__('messages.status_inactive')); ?></span>
                <?php endif; ?>
              </div>
            </div>

          </div>
        </div>

        <div class="col-md-6">
          <div class="border rounded p-3">
            <h6 class="mb-3"><?php echo e(__('messages.pricing_stock')); ?></h6>

            <div class="mb-2">
              <strong><?php echo e(__('messages.price')); ?>:</strong>
              <div><?php echo e(number_format($product->price ?? 0, 2)); ?></div>
            </div>

            <div class="mb-2">
              <strong><?php echo e(__('messages.sale_price')); ?>:</strong>
              <div><?php echo e($product->sale_price ? number_format($product->sale_price, 2) : '-'); ?></div>
            </div>

            <div class="mb-2">
              <strong><?php echo e(__('messages.stock')); ?>:</strong>
              <div><?php echo e($product->stock ?? 0); ?></div>
            </div>

            <div class="mb-2">
              <strong><?php echo e(__('messages.track_stock')); ?>:</strong>
              <div><?php echo e(($product->track_stock ?? 1) ? __('messages.yes') : __('messages.no')); ?></div>
            </div>

          </div>
        </div>

        <div class="col-12">
          <div class="border rounded p-3">
            <h6 class="mb-3"><?php echo e(__('messages.images')); ?></h6>

            <?php
              $images = $product->images ?? collect();
              $main = $images->firstWhere('is_main', 1) ?? $images->first();
            ?>

            <div class="row g-3">
              <div class="col-md-4">
                <div class="border rounded p-2 text-center">
                  <div class="mb-2 text-muted"><?php echo e(__('messages.main_image')); ?></div>
                  <?php if($main && $main->path): ?>
                    <img src="<?php echo e(asset($main->path)); ?>" style="max-width:100%; height:auto; border-radius:8px;">
                  <?php else: ?>
                    <div class="text-muted">-</div>
                  <?php endif; ?>
                </div>
              </div>

              <div class="col-md-8">
                <div class="row g-2">
                  <?php $__empty_1 = true; $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col-6 col-md-3">
                      <div class="border rounded p-1 text-center">
                        <img src="<?php echo e(asset($img->path)); ?>" style="max-width:100%; height:auto; border-radius:6px;">
                        <?php if($img->is_main): ?>
                          <div class="mt-1">
                            <span class="badge bg-info"><?php echo e(__('messages.main')); ?></span>
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="text-muted"><?php echo e(__('messages.no_images')); ?></div>
                  <?php endif; ?>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>

    </div>
  </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/products/show.blade.php ENDPATH**/ ?>