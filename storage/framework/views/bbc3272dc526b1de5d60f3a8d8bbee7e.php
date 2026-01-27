

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
  <div class="card">
    <div class="card-header pb-0">
      <div class="d-flex flex-row justify-content-between">
        <h5 class="mb-0">Create Currency</h5>
        <a href="<?php echo e(route('admin.currencies.index')); ?>" class="btn bg-gradient-primary btn-sm mb-0">All Currencies</a>
      </div>
    </div>

    <div class="card-body pt-4 p-3">
      <form action="<?php echo e(route('admin.currencies.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo $__env->make('currencies._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <div class="d-flex justify-content-end">
          <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-0">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/currencies/create.blade.php ENDPATH**/ ?>