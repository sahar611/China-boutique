

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
  <div class="card">
    <div class="card-header pb-0">
      <div class="d-flex flex-row justify-content-between">
        <h5 class="mb-0"><?php echo e(__('cms.news')); ?></h5>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('news.create')): ?>
          <a href="<?php echo e(route('admin.news.create')); ?>" class="btn bg-gradient-primary btn-sm mb-0">
            <?php echo e(__('cms.create')); ?>

          </a>
        <?php endif; ?>
      </div>
    </div>

    <div class="card-body pt-3">
      <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
          <thead>
            <tr>
              <th>#</th>
              <th><?php echo e(__('cms.title_ar')); ?></th>
              <th><?php echo e(__('cms.title_en')); ?></th>
              <th><?php echo e(__('cms.status')); ?></th>
              <th><?php echo e(__('cms.sort_order')); ?></th>
              <th class="text-center"><?php echo e(__('cms.actions')); ?></th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($item->id); ?></td>
                <td><?php echo e($item->title_ar); ?></td>
                <td><?php echo e($item->title_en); ?></td>
                <td>
                  <span class="badge bg-<?php echo e($item->is_published ? 'success' : 'secondary'); ?>">
                    <?php echo e($item->is_published ? __('cms.published') : __('cms.draft')); ?>

                  </span>
                </td>
                <td><?php echo e($item->sort_order); ?></td>
                <td class="text-center">
                  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('news.edit')): ?>
                    <a href="<?php echo e(route('admin.news.edit', $item->id)); ?>" class="btn btn-sm btn-warning">
                      <?php echo e(__('cms.edit')); ?>

                    </a>
                  <?php endif; ?>

                  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('news.delete')): ?>
                    <form action="<?php echo e(route('admin.news.destroy', $item->id)); ?>" method="POST" style="display:inline-block">
                      <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                      <button class="btn btn-sm btn-danger" onclick="return confirm('<?php echo e(__('cms.confirm_delete')); ?>')">
                        <?php echo e(__('cms.delete')); ?>

                      </button>
                    </form>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>

      <div class="mt-3">
        <?php echo e($items->links()); ?>

      </div>

    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/news/index.blade.php ENDPATH**/ ?>