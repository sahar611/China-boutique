<?php
  $items = $cart?->items ?? collect();

  $subtotal = 0;
  foreach ($items as $it) {
    $basePrice = (float)($it->unit_price ?? ($it->product->price ?? 0));
    $baseSale  = (float)($it->unit_sale_price ?? ($it->product->sale_price ?? 0));
    $hasSale   = $baseSale > 0 && $baseSale < $basePrice;
    $finalBase = $hasSale ? $baseSale : $basePrice;

    $subtotal += $finalBase * (int)$it->qty;
  }

  $subtotalView = $subtotal * (float)$rate;

  $itemsCount = $items->sum('qty');
?>

<div class="widget-shopping-cart-content" data-items-count="<?php echo e($itemsCount); ?>">
                    <ul class="pesco-mini-cart-list">
                         <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $it): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <?php
        $p = $it->product;
        $name = app()->getLocale()==='ar' ? ($p->name_ar ?? $p->name_en) : ($p->name_en ?? $p->name_ar);

        $imgObj = $p->images->first();
        $img = null;
        if ($imgObj) {
          $imgPath = $imgObj->path ?? $imgObj->image ?? $imgObj->url ?? null;
          $img = $imgPath ? asset($imgPath) : null;
        }
        $img = $img ?: asset('frontend/'.App::getLocale().'/assets/images/products/cart-1.jpg');

        $basePrice = (float)($it->unit_price ?? ($p->price ?? 0));
        $baseSale  = (float)($it->unit_sale_price ?? ($p->sale_price ?? 0));
        $hasSale   = $baseSale > 0 && $baseSale < $basePrice;
        $finalBase = $hasSale ? $baseSale : $basePrice;

        $unit = $finalBase * (float)$rate;
      ?>
                        <li class="sidebar-cart-item">
                <a href="javascript:void(0)"
           class="remove-cart js-mini-remove"
           data-remove-url="<?php echo e(route('cart.mini.remove', $it->id)); ?>"
           title="<?php echo e(__('home.remove')); ?>">
           <i class="far fa-trash-alt"></i></a>
                            <a href="<?php echo e(route('product.show', $p->slug ?? $p->id)); ?>">
          <img src="<?php echo e($img); ?>" alt="cart image">
          <?php echo e($name); ?>

        </a>
                            <span class="quantity">  <?php echo e((int)$it->qty); ?> × <span><span class="currency"><?php echo e($symbol); ?></span>
            <?php echo e(number_format($unit, 2)); ?>

          </span></span>
                        </li>
                       
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <li class="sidebar-cart-item">
        <span class="text-muted"><?php echo e(__('home.cart_empty')); ?></span>
      </li>
    <?php endif; ?>
                    </ul>
                    <div class="cart-mini-total">
                        <div class="cart-total">
                            <span><strong><?php echo e(__('home.subtotal')); ?> :</strong></span> <span
                                        class="currency"><?php echo e($symbol); ?></span><?php echo e(number_format($subtotalView, 2)); ?></span>
                        </div>
                    </div>
                    <div class="cart-button-box">
                        <a href="<?php echo e(route('cart.index')); ?>" class="theme-btn style-one">
      <?php echo e(__('home.proceed_to_checkout')); ?>

    </a>
                    </div>
                </div>

<?php /**PATH C:\xampp\htdocs\china\resources\views/front/partials/mini-cart.blade.php ENDPATH**/ ?>