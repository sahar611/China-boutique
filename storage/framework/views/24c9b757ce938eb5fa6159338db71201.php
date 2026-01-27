

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
  <div class="card">
    <div class="card-header pb-0">
      <div class="d-flex flex-row justify-content-between">
        <h5 class="mb-0"><?php echo e(__('cms.edit_work_steps')); ?></h5>
        <a href="<?php echo e(route('admin.work_steps.index')); ?>" class="btn bg-gradient-primary btn-sm mb-0">
          <?php echo e(__('cms.back')); ?>

        </a>
      </div>
    </div>

    <div class="card-body pt-4 p-3">

      <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
      <?php endif; ?>

      <?php if($errors->any()): ?>
        <div class="alert alert-danger">
          <ul class="mb-0">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
      <?php endif; ?>

      <form action="<?php echo e(route('admin.work_steps.update')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php echo $__env->make('work_steps._form', ['model' => $model, 'i' => $i], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php if(!$loop->last): ?>
            <hr class="horizontal dark my-4">
          <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/work_steps/edit.blade.php ENDPATH**/ ?>