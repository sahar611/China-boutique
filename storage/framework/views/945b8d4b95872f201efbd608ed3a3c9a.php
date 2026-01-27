

<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-12">
    <div class="card mb-4 mx-4">

      <div class="card-header pb-0 d-flex justify-content-between">
        <h5 class="mb-0"><?php echo e(__('messages.brands')); ?></h5>
        <a href="<?php echo e(route('admin.brands.create')); ?>" class="btn bg-gradient-primary btn-sm">
          <?php echo e(__('messages.add_brand')); ?>

        </a>
      </div>
<?php if(session('success')): ?>
                        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                    <?php endif; ?>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-3">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th>#</th>
                <th><?php echo e(__('messages.name')); ?></th>
                <th><?php echo e(__('messages.logo')); ?></th>
                <th><?php echo e(__('messages.status')); ?></th>
                <th class="text-center"><?php echo e(__('messages.actions')); ?></th>
              </tr>
            </thead>

            <tbody>
              <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($loop->iteration); ?></td>
                  <td><?php echo e(app()->isLocale('ar') ? $brand->name_ar : $brand->name_en); ?></td>
                  <td>
                    <?php if($brand->logo): ?>
                    <img src="<?php echo e(asset($brand->logo)); ?>"  width="70">
                    
                    <?php else: ?>
                      -
                    <?php endif; ?>
                  </td>
                  <td><?php echo e($brand->is_active ? __('messages.status_active') : __('messages.status_inactive')); ?></td>

                  <td class="text-center">
                    <a class="btn btn-primary btn-sm" href="<?php echo e(route('admin.brands.edit', $brand->id)); ?>">
                      <?php echo e(__('messages.edit')); ?>

                    </a>

                    <form action="<?php echo e(route('admin.brands.destroy', $brand->id)); ?>"
                          method="POST"
                          style="display:inline-block"
                          onsubmit="return confirm('<?php echo e(__('messages.confirm_delete')); ?>')">
                      <?php echo csrf_field(); ?>
                      <?php echo method_field('DELETE'); ?>
                      <button class="btn btn-danger btn-sm"><?php echo e(__('messages.delete')); ?></button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>

          </table>

          <div class="mt-3">
            <?php echo e($brands->links()); ?>

          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/brands/index.blade.php ENDPATH**/ ?>