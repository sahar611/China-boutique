

<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-12">
    <div class="card mb-4 mx-4">

      <div class="card-header pb-0">
        <div class="d-flex flex-row justify-content-between">
          <div><h5 class="mb-0">Currencies</h5></div>
          <a href="<?php echo e(route('admin.currencies.create')); ?>" class="btn bg-gradient-primary btn-sm mb-0">
            Add Currency
          </a>
        </div>
      </div>
<?php if(session('success')): ?>
                        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                    <?php endif; ?>
                    
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Code</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Symbol</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Decimals</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Default</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td class="ps-4"><?php echo e($loop->iteration); ?></td>
                <td><?php echo e($currency->code); ?></td>
                <td><?php echo e($currency->name); ?></td>
                <td><?php echo e($currency->symbol); ?></td>
                <td><?php echo e($currency->decimal_places); ?></td>
                <td>
                  <?php echo $currency->is_default ? '<span class="badge bg-gradient-success">Yes</span>' : '<span class="badge bg-gradient-secondary">No</span>'; ?>

                </td>
                <td>
                  <?php echo $currency->is_active ? '<span class="badge bg-gradient-info">Active</span>' : '<span class="badge bg-gradient-danger">Inactive</span>'; ?>

                </td>
                <td class="text-center">
                  <a href="<?php echo e(route('admin.currencies.edit', $currency->id)); ?>" class="btn btn-sm btn-warning">Edit</a>

                  <form action="<?php echo e(route('admin.currencies.destroy', $currency->id)); ?>" method="POST" style="display:inline-block">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this currency?')">Delete</button>
                  </form>
                </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/currencies/index.blade.php ENDPATH**/ ?>