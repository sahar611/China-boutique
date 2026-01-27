

<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-12">
    <div class="card mb-4 mx-4">
      <div class="card-header pb-0 d-flex justify-content-between">
        <h5 class="mb-0"><?php echo e(__('messages.categories')); ?></h5>
        <a href="<?php echo e(route('admin.categories.create')); ?>" class="btn bg-gradient-primary btn-sm">
          <?php echo e(__('messages.add_category')); ?>

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
                <th><?php echo e(__('messages.parent')); ?></th>
                <th><?php echo e(__('messages.image')); ?></th>
                <th><?php echo e(__('messages.status')); ?></th>
                <th class="text-center"><?php echo e(__('messages.actions')); ?></th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($loop->iteration); ?></td>
                <td><?php echo e(app()->isLocale('ar') ? $category->name_ar : $category->name_en); ?></td>
                <td><?php echo e($category->parent ? (app()->isLocale('ar') ? $category->parent->name_ar : $category->parent->name_en) : '-'); ?></td>
                <td>
                  <?php if($category->image): ?>
                   
                    <img src="<?php echo e(asset($category->image)); ?>"  width="60">

                  <?php else: ?> -
                  <?php endif; ?>
                </td>
                <td><?php echo e($category->is_active ? __('messages.status_active') : __('messages.status_inactive')); ?></td>

                <td class="text-center">
                  <a class="btn btn-primary btn-sm" href="<?php echo e(route('admin.categories.edit', $category->id)); ?>"><?php echo e(__('messages.edit')); ?></a>

                  <form action="<?php echo e(route('admin.categories.destroy', $category->id)); ?>"
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
            <?php echo e($categories->links()); ?>

          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/categories/index.blade.php ENDPATH**/ ?>