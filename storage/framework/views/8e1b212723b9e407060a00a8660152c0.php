

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
  <div class="card">

    <div class="card-header pb-0 d-flex justify-content-between">
      <h5><?php echo e(__('messages.add_product')); ?></h5>
      <a href="<?php echo e(route('admin.products.index')); ?>" class="btn bg-gradient-primary btn-sm">
        <?php echo e(__('messages.products')); ?>

      </a>
    </div>

    <div class="card-body">
      <form action="<?php echo e(route('admin.products.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <div class="row">
          <div class="col-md-6">
            <label><?php echo e(__('messages.name_en')); ?></label>
            <input type="text" name="name_en" class="form-control" value="<?php echo e(old('name_en')); ?>">
          </div>
          <div class="col-md-6">
            <label><?php echo e(__('messages.name_ar')); ?></label>
            <input type="text" name="name_ar" class="form-control" value="<?php echo e(old('name_ar')); ?>">
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-6">
            <label><?php echo e(__('messages.description_en')); ?></label>
            <textarea name="description_en" class="form-control"><?php echo e(old('description_en')); ?></textarea>
          </div>
          <div class="col-md-6">
            <label><?php echo e(__('messages.description_ar')); ?></label>
            <textarea name="description_ar" class="form-control"><?php echo e(old('description_ar')); ?></textarea>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-6">
            <label><?php echo e(__('messages.category')); ?></label>
            <select name="category_id" class="form-control">
              <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($cat->id); ?>"><?php echo e(app()->isLocale('ar') ? $cat->name_ar : $cat->name_en); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>

          <div class="col-md-6">
            <label><?php echo e(__('messages.brand')); ?></label>
            <select name="brand_id" class="form-control">
              <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($b->id); ?>"><?php echo e(app()->isLocale('ar') ? $b->name_ar : $b->name_en); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-3">
            <label><?php echo e(__('messages.price')); ?></label>
            <input type="number" step="0.01" name="price" class="form-control" value="<?php echo e(old('price')); ?>">
          </div>

          <div class="col-md-3">
            <label><?php echo e(__('messages.sale_price')); ?></label>
            <input type="number" step="0.01" name="sale_price" class="form-control" value="<?php echo e(old('sale_price')); ?>">
          </div>

          <div class="col-md-3">
            <label><?php echo e(__('messages.stock')); ?></label>
            <input type="number" name="stock" class="form-control" value="<?php echo e(old('stock', 0)); ?>">
          </div>

          <div class="col-md-3">
            <label><?php echo e(__('messages.track_stock')); ?></label>
            <select name="track_stock" class="form-control">
              <option value="1"><?php echo e(__('messages.yes')); ?></option>
              <option value="0"><?php echo e(__('messages.no')); ?></option>
            </select>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-4">
            <label><?php echo e(__('messages.sku')); ?></label>
            <input type="text" name="sku" class="form-control" value="<?php echo e(old('sku')); ?>">
          </div>

          <div class="col-md-4">
            <label><?php echo e(__('messages.status')); ?></label>
            <select name="is_active" class="form-control">
              <option value="1"><?php echo e(__('messages.status_active')); ?></option>
              <option value="0"><?php echo e(__('messages.status_inactive')); ?></option>
            </select>
          </div>

          <div class="col-md-4">
            <label><?php echo e(__('messages.images')); ?></label>
            <input type="file" name="images[]" class="form-control" multiple>
          </div>
        </div>

        <p class="text-muted mt-3 mb-0"><?php echo e(__('messages.slug_auto_note')); ?></p>

        <div class="text-end mt-4">
          <button class="btn bg-gradient-dark"><?php echo e(__('messages.save')); ?></button>
        </div>

      </form>
    </div>

  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/products/create.blade.php ENDPATH**/ ?>