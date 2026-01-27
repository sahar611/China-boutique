

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
  <div class="card">
    <div class="card-header pb-0">
      <div class="d-flex flex-row justify-content-between">
        <h5 class="mb-0"><?php echo e(__('cms.home_banners')); ?></h5>

      
          <a href="<?php echo e(route('admin.home-banners.create')); ?>" class="btn bg-gradient-primary btn-sm mb-0">
            <?php echo e(__('cms.create')); ?>

          </a>
      
      </div>
    </div>

    <div class="card-body pt-3">
      <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
          <thead>
            <tr>
              <th>#</th>
              <th><?php echo e(__('cms.image')); ?></th>
              <th><?php echo e(__('cms.title_ar')); ?></th>
              <th><?php echo e(__('cms.title_en')); ?></th>
              <th><?php echo e(__('cms.discount_percent')); ?></th>
              <th><?php echo e(__('cms.status')); ?></th>
              <th><?php echo e(__('cms.sort_order')); ?></th>
              <th class="text-center"><?php echo e(__('cms.actions')); ?></th>
            </tr>
          </thead>

          <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <tr>
                <td><?php echo e($item->id); ?></td>

                <td>
                  <?php if($item->image): ?>
                    <img src="<?php echo e(asset($item->image)); ?>" alt="banner" style="width:90px;height:55px;object-fit:cover;border-radius:10px;">
                  <?php else: ?>
                    <span class="text-muted">—</span>
                  <?php endif; ?>
                </td>

                <td><?php echo e($item->title_ar); ?></td>
                <td><?php echo e($item->title_en); ?></td>

                <td>
                  <?php if(!is_null($item->discount_percent)): ?>
                    <?php echo e($item->discount_percent); ?>%
                  <?php else: ?>
                    <span class="text-muted">—</span>
                  <?php endif; ?>
                </td>

                <td>
                  <span class="badge bg-<?php echo e($item->is_active ? 'success' : 'secondary'); ?>">
                    <?php echo e($item->is_active ? __('cms.active') : __('cms.inactive')); ?>

                  </span>
                </td>

                <td><?php echo e($item->sort_order); ?></td>

                <td class="text-center">
                
                    <a href="<?php echo e(route('admin.home-banners.edit', $item->id)); ?>" class="btn btn-sm btn-warning">
                      <?php echo e(__('cms.edit')); ?>

                    </a>
                

                 
                    <form action="<?php echo e(route('admin.home-banners.destroy', $item->id)); ?>" method="POST" style="display:inline-block">
                      <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                      <button class="btn btn-sm btn-danger"
                              onclick="return confirm('<?php echo e(__('cms.confirm_delete')); ?>')">
                        <?php echo e(__('cms.delete')); ?>

                      </button>
                    </form>
                 
                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <tr>
                <td colspan="8" class="text-center text-muted py-4">
                  <?php echo e(__('cms.no_data')); ?>

                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      <div class="mt-3">
      
        <?php if(method_exists($items,'links')): ?>
          <?php echo e($items->links()); ?>

        <?php endif; ?>
      </div>

    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/home_banners/index.blade.php ENDPATH**/ ?>