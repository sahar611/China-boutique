

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">

  <div class="card mb-4">
    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><?php echo e(__('messages.order_details')); ?> #<?php echo e($order->code); ?></h5>
      <a href="<?php echo e(route('admin.orders.index')); ?>" class="btn btn-sm bg-gradient-secondary">
        <?php echo e(__('messages.back')); ?>

      </a>
      <a href="<?php echo e(route('admin.orders.pdf', $order)); ?>" class="btn btn-sm bg-gradient-danger">
  <i class="fas fa-file-pdf"></i> <?php echo e(__('messages.export_pdf')); ?>

</a>

    </div>

    <div class="card-body pt-3">
      <div class="row">
        <div class="col-lg-6 mb-3">
          <h6 class="mb-2"><?php echo e(__('messages.customer_information')); ?></h6>
          <div class="border rounded p-3 bg-white">
            <p class="mb-1"><strong><?php echo e(__('messages.customer')); ?>:</strong> <?php echo e($order->customer_name); ?></p>
            <p class="mb-1"><strong><?php echo e(__('messages.email')); ?>:</strong> <?php echo e($order->customer_email); ?></p>
            <p class="mb-1"><strong><?php echo e(__('messages.phone')); ?>:</strong> <?php echo e($order->customer_phone ?? '-'); ?></p>
            <p class="mb-0"><strong><?php echo e(__('messages.address')); ?>:</strong> <?php echo e($order->shipping_address ?? '-'); ?></p>
          </div>
        </div>

        <div class="col-lg-6 mb-3">
          <h6 class="mb-2"><?php echo e(__('messages.order_information')); ?></h6>
          <div class="border rounded p-3 bg-white">
            <p class="mb-1"><strong><?php echo e(__('messages.status')); ?>:</strong> <?php echo e($order->status); ?></p>
            <p class="mb-1"><strong><?php echo e(__('messages.payment_method')); ?>:</strong> <?php echo e($order->payment_method); ?></p>
            <p class="mb-1"><strong><?php echo e(__('messages.payment_status')); ?>:</strong> <?php echo e($order->payment_status); ?></p>
            <p class="mb-0"><strong><?php echo e(__('messages.date')); ?>:</strong> <?php echo e(optional($order->placed_at)->format('Y-m-d H:i')); ?></p>
          </div>

          <?php if($order->payment_method === 'bank' && $order->bank_receipt): ?>
            <div class="mt-3">
              <h6 class="mb-2"><?php echo e(__('messages.bank_receipt')); ?></h6>
              <a href="<?php echo e(asset('storage/'.$order->bank_receipt)); ?>" target="_blank">
                <img src="<?php echo e(asset('storage/'.$order->bank_receipt)); ?>" class="img-fluid rounded border" style="max-height:240px;">
              </a>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <hr>

      <h6 class="mb-2"><?php echo e(__('messages.items')); ?></h6>
      <div class="table-responsive">
        <table class="table align-items-center">
          <thead>
            <tr>
              <th><?php echo e(__('messages.product')); ?></th>
              <th><?php echo e(__('messages.qty')); ?></th>
              <th><?php echo e(__('messages.unit_price')); ?></th>
              <th><?php echo e(__('messages.total')); ?></th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($item->product_name); ?></td>
                <td><?php echo e($item->qty); ?></td>
                <td><?php echo e(number_format($item->unit_sale_price && $item->unit_sale_price > 0 ? $item->unit_sale_price : $item->unit_price, 2)); ?></td>
                <td><?php echo e(number_format($item->line_total, 2)); ?></td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>

      <div class="row mt-3">
        <div class="col-lg-4 ms-auto">
          <div class="border rounded p-3 bg-white">
            <p class="mb-1"><strong><?php echo e(__('messages.subtotal')); ?>:</strong> <?php echo e(number_format($order->subtotal,2)); ?> <?php echo e($order->currency_code); ?></p>
            <p class="mb-1"><strong><?php echo e(__('messages.shipping')); ?>:</strong> <?php echo e(number_format($order->shipping,2)); ?> <?php echo e($order->currency_code); ?></p>
            <p class="mb-1"><strong><?php echo e(__('messages.discount')); ?>:</strong> <?php echo e(number_format($order->discount,2)); ?> <?php echo e($order->currency_code); ?></p>
            <p class="mb-0"><strong><?php echo e(__('messages.total')); ?>:</strong> <?php echo e(number_format($order->total,2)); ?> <?php echo e($order->currency_code); ?></p>
          </div>
        </div>
      </div>

      <hr>

      <h6 class="mb-2"><?php echo e(__('messages.update_status')); ?></h6>
      <form action="<?php echo e(route('admin.orders.status', $order)); ?>" method="POST" class="row g-2">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PATCH'); ?>

        <div class="col-md-4">
          <label class="form-label"><?php echo e(__('messages.status')); ?></label>
          <select name="status" class="form-control">
            <?php $__currentLoopData = ['new','processing','shipped','completed','cancelled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($st); ?>" <?php if($order->status===$st): echo 'selected'; endif; ?>><?php echo e(__('messages.order_status_'.$st)); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>

        <div class="col-md-4">
          <label class="form-label"><?php echo e(__('messages.payment_status')); ?></label>
          <select name="payment_status" class="form-control">
            <?php $__currentLoopData = ['pending','paid','failed']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ps): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($ps); ?>" <?php if($order->payment_status===$ps): echo 'selected'; endif; ?>><?php echo e(__('messages.payment_status_'.$ps)); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>

        <div class="col-md-4 d-flex align-items-end">
          <button class="btn bg-gradient-primary w-100"><?php echo e(__('messages.save')); ?></button>
        </div>
      </form>

    </div>
  </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/orders/show.blade.php ENDPATH**/ ?>