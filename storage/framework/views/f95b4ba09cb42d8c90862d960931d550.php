

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">

  <div class="card">

    <div class="card-header pb-0 d-flex justify-content-between">
      <h5><?php echo e(__('messages.edit_product_stock')); ?></h5>

      <a href="<?php echo e(route('admin.products.index')); ?>" class="btn bg-gradient-primary btn-sm">
        <?php echo e(__('messages.products')); ?>

      </a>
    </div>

    <div class="card-body">

      <form action="<?php echo e(route('admin.products.stock.update', $product->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PATCH'); ?>

        <div class="row">

          <div class="col-md-6">
            <label><?php echo e(__('messages.product_name')); ?></label>
            <input type="text" class="form-control" disabled
                   value="<?php echo e(app()->isLocale('ar') ? $product->name_ar : $product->name_en); ?>">
          </div>

          <div class="col-md-3">
            <label><?php echo e(__('messages.stock')); ?></label>
            <input type="number" name="stock" class="form-control"
                   value="<?php echo e(old('stock', $product->stock)); ?>" min="0">
            <?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <div class="col-md-3">
            <label><?php echo e(__('messages.track_stock')); ?></label>
            <select name="track_stock" class="form-control">
              <option value="1" <?php if(old('track_stock', $product->track_stock) == 1): echo 'selected'; endif; ?>><?php echo e(__('messages.yes')); ?></option>
              <option value="0" <?php if(old('track_stock', $product->track_stock) == 0): echo 'selected'; endif; ?>><?php echo e(__('messages.no')); ?></option>
            </select>
            <?php $__errorArgs = ['track_stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

        </div>

        <p class="text-muted mt-3 mb-0">
          <?php echo e(__('messages.stock_note')); ?>

        </p>

        <div class="text-end mt-4">
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('products.stock_edit')): ?>
            <button class="btn bg-gradient-dark"><?php echo e(__('messages.save')); ?></button>
          <?php endif; ?>
        </div>

      </form>

    </div>

  </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/products/stock.blade.php ENDPATH**/ ?>