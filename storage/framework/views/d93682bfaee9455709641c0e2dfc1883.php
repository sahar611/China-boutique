

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
  <div class="card">
    <div class="card-header pb-0">
      <div class="d-flex flex-row justify-content-between">
        <h5 class="mb-0"><?php echo e(__('cms.edit_home_banner')); ?></h5>

        <a href="<?php echo e(route('admin.home-banners.index')); ?>" class="btn bg-gradient-primary btn-sm mb-0">
          <?php echo e(__('cms.back')); ?>

        </a>
      </div>
    </div>

    <div class="card-body pt-4 p-3">
      <form action="<?php echo e(route('admin.home-banners.update', $model->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <?php echo $__env->make('home_banners._form', ['model' => $model], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="d-flex justify-content-end">
          <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-0">
            <?php echo e(__('cms.save')); ?>

          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/home_banners/edit.blade.php ENDPATH**/ ?>