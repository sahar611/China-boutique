<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
  <meta charset="UTF-8">
  <title><?php echo e(__('messages.order_details')); ?> #<?php echo e($order->code); ?></title>
  <style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
    h2,h3 { margin: 0 0 10px; }
    .box { border:1px solid #ddd; padding:10px; border-radius:6px; margin-bottom:12px; }
    table { width:100%; border-collapse: collapse; margin-top:10px; }
    th,td { border:1px solid #000; padding:6px; text-align:left; }
    th { background:#f2f2f2; }
    .right { text-align:right; }
    .muted { color:#666; }
  </style>
</head>
<body>

  <h2><?php echo e(__('messages.order_details')); ?> #<?php echo e($order->code); ?></h2>
  <p class="muted"><?php echo e(__('messages.date')); ?>: <?php echo e(optional($order->placed_at ?? $order->created_at)->format('Y-m-d H:i')); ?></p>

  <div class="box">
    <h3><?php echo e(__('messages.customer_information')); ?></h3>
    <p><strong><?php echo e(__('messages.customer')); ?>:</strong> <?php echo e($order->customer_name); ?></p>
    <p><strong><?php echo e(__('messages.email')); ?>:</strong> <?php echo e($order->customer_email); ?></p>
    <p><strong><?php echo e(__('messages.phone')); ?>:</strong> <?php echo e($order->customer_phone ?? '-'); ?></p>
    <p><strong><?php echo e(__('messages.address')); ?>:</strong> <?php echo e($order->shipping_address ?? '-'); ?></p>
  </div>

  <div class="box">
    <h3><?php echo e(__('messages.order_information')); ?></h3>
    <p><strong><?php echo e(__('messages.status')); ?>:</strong> <?php echo e(__('messages.order_status_'.$order->status)); ?></p>
    <p><strong><?php echo e(__('messages.payment_method')); ?>:</strong> <?php echo e(__('messages.payment_method_'.$order->payment_method)); ?></p>
    <p><strong><?php echo e(__('messages.payment_status')); ?>:</strong> <?php echo e(__('messages.payment_status_'.$order->payment_status)); ?></p>
  </div>

  <h3><?php echo e(__('messages.items')); ?></h3>

  <table>
    <thead>
      <tr>
        <th><?php echo e(__('messages.product')); ?></th>
        <th class="right"><?php echo e(__('messages.qty')); ?></th>
        <th class="right"><?php echo e(__('messages.unit_price')); ?></th>
        <th class="right"><?php echo e(__('messages.total')); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
          $unit = ($item->unit_sale_price && $item->unit_sale_price > 0) ? $item->unit_sale_price : $item->unit_price;
        ?>
        <tr>
          <td><?php echo e($item->product_name); ?></td>
          <td class="right"><?php echo e($item->qty); ?></td>
          <td class="right"><?php echo e(number_format($unit, 2)); ?></td>
          <td class="right"><?php echo e(number_format($item->line_total, 2)); ?></td>
        </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
  </table>

  <div class="box" style="margin-top:12px;">
    <p class="right"><strong><?php echo e(__('messages.subtotal')); ?>:</strong> <?php echo e(number_format($order->subtotal, 2)); ?> <?php echo e($order->currency_code); ?></p>
    <p class="right"><strong><?php echo e(__('messages.shipping')); ?>:</strong> <?php echo e(number_format($order->shipping, 2)); ?> <?php echo e($order->currency_code); ?></p>
    <p class="right"><strong><?php echo e(__('messages.discount')); ?>:</strong> <?php echo e(number_format($order->discount, 2)); ?> <?php echo e($order->currency_code); ?></p>
    <p class="right" style="font-size:13px;"><strong><?php echo e(__('messages.total')); ?>:</strong> <?php echo e(number_format($order->total, 2)); ?> <?php echo e($order->currency_code); ?></p>
  </div>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\china\resources\views/orders/single-pdf.blade.php ENDPATH**/ ?>