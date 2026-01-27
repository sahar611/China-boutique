

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
  <div class="card">
    <div class="card-header pb-0">
      <div class="d-flex flex-row justify-content-between">
        <h5 class="mb-0"><?php echo e(__('cms.work_steps')); ?></h5>
      
          <a href="<?php echo e(route('admin.work_steps.edit')); ?>" class="btn bg-gradient-primary btn-sm mb-0">
            <?php echo e(__('cms.edit')); ?>

          </a>
        
      </div>
    </div>

    <div class="card-body pt-3">
      <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
          <thead>
            <tr>
              <th><?php echo e(__('cms.step_no')); ?></th>
              <th><?php echo e(__('cms.icon')); ?></th>
              <th><?php echo e(__('cms.title_ar')); ?></th>
              <th><?php echo e(__('cms.title_en')); ?></th>
              <th><?php echo e(__('cms.status')); ?></th>
              <th><?php echo e(__('cms.sort_order')); ?></th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($item->step_no); ?></td>

                <td>
                  <?php if($item->icon_type === 'image' && $item->icon_image): ?>
                    <img src="<?php echo e(asset($item->icon_image)); ?>" style="width:45px;height:45px;object-fit:contain;">
                  <?php else: ?>
                    <span class="badge bg-secondary"><?php echo e($item->icon_class ?? '—'); ?></span>
                  <?php endif; ?>
                </td>

                <td><?php echo e($item->title_ar); ?></td>
                <td><?php echo e($item->title_en); ?></td>

                <td>
                  <span class="badge bg-<?php echo e($item->is_active ? 'success' : 'secondary'); ?>">
                    <?php echo e($item->is_active ? __('cms.active') : __('cms.inactive')); ?>

                  </span>
                </td>

                <td><?php echo e($item->sort_order); ?></td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>

      <hr class="horizontal dark my-4">

      
      <h6 class="mb-3"><?php echo e(__('cms.preview')); ?></h6>
      <div class="row">
        <?php $__currentLoopData = $items->where('is_active',1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col-md-3 mb-3">
            <div class="card h-100">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <div>
                    <?php if($s->icon_type === 'image' && $s->icon_image): ?>
                      <img src="<?php echo e(asset($s->icon_image)); ?>" style="width:44px;height:44px;object-fit:contain;">
                    <?php else: ?>
                      <i class="<?php echo e($s->icon_class); ?>"></i>
                    <?php endif; ?>
                  </div>
                  <span class="badge bg-warning text-dark"><?php echo e(str_pad($s->step_no,2,'0',STR_PAD_LEFT)); ?></span>
                </div>

                <h6 class="mt-3 mb-1">
                  <?php echo e(app()->getLocale()=='ar' ? $s->title_ar : $s->title_en); ?>

                </h6>
                <p class="text-sm text-muted mb-0">
                  <?php echo e(app()->getLocale()=='ar' ? $s->desc_ar : $s->desc_en); ?>

                </p>
              </div>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>

    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/work_steps/index.blade.php ENDPATH**/ ?>