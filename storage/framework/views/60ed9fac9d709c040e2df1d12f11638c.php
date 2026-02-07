


<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">

        <div class="card mb-4 mx-4">
            <div class="card-header pb-0 d-flex justify-content-between">
                <h5 class="mb-0"> <h5><?php echo e(__('messages.orders')); ?></h5></h5>
               <div class="d-flex gap-2 mb-3">
  <a class="btn btn-sm bg-gradient-success" href="<?php echo e(route('admin.orders.export')); ?>">
    <?php echo e(__('messages.export_excel')); ?>

  </a>
</div>

            </div>
<?php if(session('success')): ?>
                        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                    <?php endif; ?>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="p-3">
  
 <form class="row g-2 mb-3" method="GET">
  <div class="col-md-2">
    <input class="form-control" name="search" value="<?php echo e(request('search')); ?>" placeholder="<?php echo e(__('messages.search')); ?>">
  </div>

  <div class="col-md-2">
    <select class="form-control" name="status">
      <option value=""><?php echo e(__('messages.all_status')); ?></option>
      <?php $__currentLoopData = ['new','processing','shipped','completed','cancelled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($st); ?>" <?php if(request('status')===$st): echo 'selected'; endif; ?>><?php echo e(__('messages.order_status_'.$st)); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
  </div>

  <div class="col-md-2">
    <select class="form-control" name="payment_method">
      <option value=""><?php echo e(__('messages.all_payment_methods')); ?></option>
      <option value="bank" <?php if(request('payment_method')==='bank'): echo 'selected'; endif; ?>><?php echo e(__('messages.payment_method_bank')); ?></option>
      <option value="online" <?php if(request('payment_method')==='online'): echo 'selected'; endif; ?>><?php echo e(__('messages.payment_method_online')); ?></option>
    </select>
  </div>

  <div class="col-md-2">
    <select class="form-control" name="payment_status">
      <option value=""><?php echo e(__('messages.all_payment_status')); ?></option>
      <option value="pending" <?php if(request('payment_status')==='pending'): echo 'selected'; endif; ?>><?php echo e(__('messages.payment_status_pending')); ?></option>
      <option value="paid" <?php if(request('payment_status')==='paid'): echo 'selected'; endif; ?>><?php echo e(__('messages.payment_status_paid')); ?></option>
      <option value="failed" <?php if(request('payment_status')==='failed'): echo 'selected'; endif; ?>><?php echo e(__('messages.payment_status_failed')); ?></option>
    </select>
  </div>

  <div class="col-md-2">
    <input type="date" class="form-control" name="from" value="<?php echo e(request('from')); ?>">
  </div>

  <div class="col-md-2">
    <input type="date" class="form-control" name="to" value="<?php echo e(request('to')); ?>">
  </div>

  <div class="col-md-12 d-flex gap-2 mt-2">
    <button class="btn bg-gradient-primary"><?php echo e(__('messages.filter')); ?></button>
    <a href="<?php echo e(route('admin.orders.index')); ?>" class="btn bg-gradient-secondary"><?php echo e(__('messages.reset')); ?></a>
  </div>
</form>


  
  <hr class="my-4">



</div>
                <div class="table-responsive p-3">
              
    <table class="table align-items-center">
      <thead>
        <tr>
          <th>#</th>
          <th><?php echo e(__('messages.order_code')); ?></th>
          <th><?php echo e(__('messages.customer')); ?></th>
          <th><?php echo e(__('messages.total')); ?></th>
          <th><?php echo e(__('messages.payment')); ?></th>
          <th><?php echo e(__('messages.status')); ?></th>
          <th><?php echo e(__('messages.date')); ?></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td><?php echo e($order->id); ?></td>
          <td><?php echo e($order->code); ?></td>
          <td><?php echo e($order->customer_name); ?></td>
          <td><?php echo e($order->total); ?> <?php echo e($order->currency_code); ?></td>
          <td><?php echo e(ucfirst($order->payment_method)); ?></td>
          <td>
            <span class="badge bg-info"><?php echo e($order->status); ?></span>
          </td>
          <td><?php echo e(optional($order->placed_at)->format('Y-m-d')); ?></td>
          <td>
            <a href="<?php echo e(route('admin.orders.show',$order)); ?>" class="btn btn-sm btn-primary">
              <?php echo e(__('messages.view')); ?>

            </a>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
    </table>
  

                    <div class="mt-3">
                          <?php echo e($orders->links()); ?>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/orders/index.blade.php ENDPATH**/ ?>