

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">

  <div class="card">

    <div class="card-header pb-0 d-flex justify-content-between">
      <h5><?php echo e(__('messages.edit_product_price')); ?></h5>

      <a href="<?php echo e(route('admin.products.index')); ?>" class="btn bg-gradient-primary btn-sm">
        <?php echo e(__('messages.products')); ?>

      </a>
    </div>

    <div class="card-body">

      <form action="<?php echo e(route('admin.products.price.update', $product->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PATCH'); ?>

        <div class="row">

          <div class="col-md-6">
            <label><?php echo e(__('messages.product_name')); ?></label>
            <input type="text" class="form-control" disabled
                   value="<?php echo e(app()->isLocale('ar') ? $product->name_ar : $product->name_en); ?>">
          </div>

          <div class="col-md-3">
            <label><?php echo e(__('messages.price')); ?></label>
            <input type="number" step="0.01" name="price"
                   class="form-control"
                   value="<?php echo e(old('price', $product->price)); ?>">
            <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <div class="col-md-3">
            <label><?php echo e(__('messages.sale_price')); ?></label>
            <input type="number" step="0.01" name="sale_price"
                   class="form-control"
                   value="<?php echo e(old('sale_price', $product->sale_price)); ?>">
            <?php $__errorArgs = ['sale_price'];
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
          <?php echo e(__('messages.price_note')); ?>

        </p>

        <div class="text-end mt-4">
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('products.price_edit')): ?>
            <button class="btn bg-gradient-dark">
              <?php echo e(__('messages.save')); ?>

            </button>
          <?php endif; ?>
        </div>

      </form>

    </div>

  </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/products/price.blade.php ENDPATH**/ ?>