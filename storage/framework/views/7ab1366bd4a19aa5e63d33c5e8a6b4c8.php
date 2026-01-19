

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
  <div class="card">

    <div class="card-header pb-0 d-flex justify-content-between">
      <h5><?php echo e(__('messages.add_brand')); ?></h5>
      <a href="<?php echo e(route('admin.brands.index')); ?>" class="btn bg-gradient-primary btn-sm">
        <?php echo e(__('messages.brands')); ?>

      </a>
    </div>

    <div class="card-body">
      <form action="<?php echo e(route('admin.brands.store')); ?>" method="POST" enctype="multipart/form-data">
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
            <label><?php echo e(__('messages.logo')); ?></label>
            <input type="file" name="logo" class="form-control">
          </div>

          <div class="col-md-3">
            <label><?php echo e(__('messages.sort_order')); ?></label>
            <input type="number" name="sort_order" class="form-control" value="<?php echo e(old('sort_order', 0)); ?>">
          </div>

          <div class="col-md-3">
            <label><?php echo e(__('messages.status')); ?></label>
            <select name="is_active" class="form-control">
              <option value="1"><?php echo e(__('messages.status_active')); ?></option>
              <option value="0"><?php echo e(__('messages.status_inactive')); ?></option>
            </select>
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

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/brands/create.blade.php ENDPATH**/ ?>