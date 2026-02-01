

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">

  <div class="card">
    <div class="card-header pb-0">
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
        <div>
          <h5 class="mb-1">
            <?php echo e(__('messages.reviews')); ?>:
            <span class="text-dark">
              <?php echo e(app()->getLocale()==='ar' ? ($product->name_ar ?? $product->name_en) : ($product->name_en ?? $product->name_ar)); ?>

            </span>
          </h5>

          <div class="d-flex flex-wrap gap-2">
            <span class="badge bg-gradient-dark"><?php echo e(__('messages.total')); ?>: <?php echo e($counts['total'] ?? 0); ?></span>
            <span class="badge bg-gradient-warning text-dark"><?php echo e(__('messages.pending')); ?>: <?php echo e($counts['pending'] ?? 0); ?></span>
            <span class="badge bg-gradient-secondary"><?php echo e(__('messages.hidden')); ?>: <?php echo e($counts['hidden'] ?? 0); ?></span>
          </div>
        </div>

        <div class="d-flex gap-2">
          <a href="<?php echo e(route('admin.products.index')); ?>" class="btn btn-outline-secondary btn-sm mb-0">
            <i class="fa fa-arrow-left me-1"></i> <?php echo e(__('messages.back_to_products')); ?>

          </a>
        </div>
      </div>
    </div>

    <div class="card-body pt-3">

      
      <?php if(session('success')): ?>
        <div class="alert alert-success py-2"><?php echo e(session('success')); ?></div>
      <?php endif; ?>

      
      <form method="GET" action="<?php echo e(route('admin.products.reviews', $product->id)); ?>" class="row g-2 mb-3">
        <div class="col-12 col-md-4">
          <input
            type="text"
            name="q"
            value="<?php echo e($q ?? ''); ?>"
            class="form-control"
            placeholder="<?php echo e(__('messages.search_in_comments')); ?>"
          >
        </div>

        <div class="col-12 col-md-3">
          <select name="status" class="form-select">
            <option value="all"      <?php if(($status ?? 'all')==='all'): echo 'selected'; endif; ?>><?php echo e(__('messages.all')); ?></option>
            <option value="pending"  <?php if(($status ?? 'all')==='pending'): echo 'selected'; endif; ?>><?php echo e(__('messages.pending')); ?></option>
            <option value="approved" <?php if(($status ?? 'all')==='approved'): echo 'selected'; endif; ?>><?php echo e(__('messages.approved_visible')); ?></option>
            <option value="hidden"   <?php if(($status ?? 'all')==='hidden'): echo 'selected'; endif; ?>><?php echo e(__('messages.hidden')); ?></option>
          </select>
        </div>

        <div class="col-12 col-md-5 d-flex gap-2">
          <button class="btn bg-gradient-primary btn-sm mb-0" type="submit">
            <i class="fa fa-search me-1"></i> <?php echo e(__('messages.filter')); ?>

          </button>

          <a href="<?php echo e(route('admin.products.reviews', $product->id)); ?>" class="btn btn-outline-secondary btn-sm mb-0">
            <?php echo e(__('messages.reset')); ?>

          </a>
        </div>
      </form>

      
      <div class="d-flex flex-wrap gap-2 mb-3">
        <?php $active = $status ?? 'all'; ?>

        <a class="btn btn-sm <?php echo e($active==='all' ? 'bg-gradient-dark text-white' : 'btn-outline-dark'); ?>"
           href="<?php echo e(request()->fullUrlWithQuery(['status' => 'all'])); ?>">
          <?php echo e(__('messages.all')); ?>

          <span class="badge bg-light text-dark ms-1"><?php echo e($counts['total'] ?? 0); ?></span>
        </a>

        <a class="btn btn-sm <?php echo e($active==='pending' ? 'bg-gradient-warning text-dark' : 'btn-outline-warning'); ?>"
           href="<?php echo e(request()->fullUrlWithQuery(['status' => 'pending'])); ?>">
          <?php echo e(__('messages.pending')); ?>

          <span class="badge bg-light text-dark ms-1"><?php echo e($counts['pending'] ?? 0); ?></span>
        </a>

        <a class="btn btn-sm <?php echo e($active==='approved' ? 'bg-gradient-success text-white' : 'btn-outline-success'); ?>"
           href="<?php echo e(request()->fullUrlWithQuery(['status' => 'approved'])); ?>">
          <?php echo e(__('messages.approved')); ?>

        </a>

        <a class="btn btn-sm <?php echo e($active==='hidden' ? 'bg-gradient-secondary text-white' : 'btn-outline-secondary'); ?>"
           href="<?php echo e(request()->fullUrlWithQuery(['status' => 'hidden'])); ?>">
          <?php echo e(__('messages.hidden')); ?>

          <span class="badge bg-light text-dark ms-1"><?php echo e($counts['hidden'] ?? 0); ?></span>
        </a>
      </div>

      
      <div class="table-responsive">
        <table class="table align-items-center mb-0">
          <thead>
            <tr>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><?php echo e(__('messages.user')); ?></th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><?php echo e(__('messages.rating')); ?></th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><?php echo e(__('messages.comment')); ?></th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><?php echo e(__('messages.created')); ?></th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center"><?php echo e(__('messages.approved')); ?></th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center"><?php echo e(__('messages.visible')); ?></th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center"><?php echo e(__('messages.actions')); ?></th>
            </tr>
          </thead>

          <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <tr>
                <td>
                  <div class="d-flex flex-column">
                    <span class="text-sm font-weight-bold">
                      <?php echo e($r->user->name ?? __('messages.user')); ?>

                    </span>
                    <span class="text-xs text-secondary">
                      <?php echo e($r->user->email ?? ''); ?>

                    </span>
                  </div>
                </td>

                <td>
                  <div class="d-flex align-items-center gap-1">
                    <span class="text-sm font-weight-bold"><?php echo e((int)$r->rating); ?>/5</span>
                    <span class="text-xs text-secondary">
                      <?php for($i=1; $i<=5; $i++): ?>
                        <i class="fas fa-star <?php echo e($i <= (int)$r->rating ? 'text-warning' : 'text-muted'); ?>"></i>
                      <?php endfor; ?>
                    </span>
                  </div>
                </td>

                <td style="max-width: 520px;">
                  <div class="text-sm" style="white-space: normal;">
                    <?php echo e($r->comment); ?>

                  </div>
                </td>

                <td>
                  <span class="text-xs text-secondary">
                    <?php echo e(optional($r->created_at)->format('Y-m-d H:i')); ?>

                  </span>
                </td>

                
                <td class="text-center">
                  <form method="POST" action="<?php echo e(route('admin.reviews.toggleApprove', $r->id)); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <button type="submit"
                      class="btn btn-sm mb-0 <?php echo e($r->is_approved ? 'bg-gradient-success' : 'btn-outline-warning'); ?>">
                      <?php echo e($r->is_approved ? __('messages.approved') : __('messages.pending')); ?>

                    </button>
                  </form>
                </td>

                
                <td class="text-center">
                  <form method="POST" action="<?php echo e(route('admin.reviews.toggleVisible', $r->id)); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <button type="submit"
                      class="btn btn-sm mb-0 <?php echo e($r->is_visible ? 'bg-gradient-info' : 'btn-outline-secondary'); ?>">
                      <?php echo e($r->is_visible ? __('messages.visible') : __('messages.hidden')); ?>

                    </button>
                  </form>

                  <?php if(!$r->is_approved): ?>
                    <div class="text-xs text-secondary mt-1">
                      (<?php echo e(__('messages.not_approved')); ?>)
                    </div>
                  <?php endif; ?>
                </td>

                
                <td class="text-center">
                  <form method="POST" action="<?php echo e(route('admin.reviews.destroy', $r->id)); ?>"
                        onsubmit="return confirm('<?php echo e(__('messages.delete_review_confirm')); ?>');">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button class="btn btn-sm btn-outline-danger mb-0">
                      <i class="fa fa-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <tr>
                <td colspan="7" class="text-center py-4 text-secondary">
                  <?php echo e(__('messages.no_reviews_found')); ?>

                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      
      <div class="mt-3">
        <?php echo e($reviews->links()); ?>

      </div>

    </div>
  </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/products/reviews.blade.php ENDPATH**/ ?>