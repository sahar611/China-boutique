

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
            <?php $__errorArgs = ['name_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <div class="col-md-6">
            <label><?php echo e(__('messages.name_ar')); ?></label>
            <input type="text" name="name_ar" class="form-control" value="<?php echo e(old('name_ar')); ?>">
            <?php $__errorArgs = ['name_ar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-6">
            <label><?php echo e(__('messages.logo')); ?></label>
            <input type="file" name="logo" class="form-control">
            <?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <div class="col-md-3">
            <label><?php echo e(__('messages.sort_order')); ?></label>
            <input type="number" name="sort_order" class="form-control" value="<?php echo e(old('sort_order', 0)); ?>">
            <?php $__errorArgs = ['sort_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <div class="col-md-3">
            <label><?php echo e(__('messages.status')); ?></label>
            <select name="is_active" class="form-control">
              <option value="1" <?php if(old('is_active','1')=='1'): echo 'selected'; endif; ?>><?php echo e(__('messages.status_active')); ?></option>
              <option value="0" <?php if(old('is_active')=='0'): echo 'selected'; endif; ?>><?php echo e(__('messages.status_inactive')); ?></option>
            </select>
            <?php $__errorArgs = ['is_active'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>
        </div>

        
        <div class="row mt-4">
          <div class="col-md-6">
            <label><?php echo e(__('messages.show_in_home')); ?></label>
            <select name="is_featured" class="form-control">
              <option value="0" <?php if(old('is_featured','0')=='0'): echo 'selected'; endif; ?>><?php echo e(__('messages.no')); ?></option>
              <option value="1" <?php if(old('is_featured')=='1'): echo 'selected'; endif; ?>><?php echo e(__('messages.yes')); ?></option>
            </select>
            <?php $__errorArgs = ['is_featured'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <div class="col-md-6">
            <label><?php echo e(__('messages.home_sort')); ?></label>
            <input type="number" name="home_sort" class="form-control" value="<?php echo e(old('home_sort', 0)); ?>">
            <?php $__errorArgs = ['home_sort'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>
        </div>

        <p class="text-muted mt-3 mb-0"><?php echo e(__('messages.slug_auto_note')); ?></p>
<div class="alert alert-info mt-3">
  <strong><?php echo e(__('messages.note')); ?>:</strong>
  <ul class="mb-0">
    <li><?php echo e(__('messages.sort_order_explain')); ?></li>
    <li><?php echo e(__('messages.home_sort_explain')); ?></li>
  </ul>
</div>
        <div class="text-end mt-4">
          <button class="btn bg-gradient-dark"><?php echo e(__('messages.save')); ?></button>
        </div>

      </form>
    </div>

  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/brands/create.blade.php ENDPATH**/ ?>