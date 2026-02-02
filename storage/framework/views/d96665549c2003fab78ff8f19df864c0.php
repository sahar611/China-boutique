   
 

<?php $__env->startSection('content'); ?>
   <!--====== Main Bg  ======-->
    <main class="main-bg">
     <!--====== Start Page Banner Section ======-->
         <section class="page-banner dir-rtl">
                <div class="page-banner-wrapper p-r z-1">
                    <svg class="lineanm" viewBox="0 0 1920 347" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path class="line" d="M-39 345.187C70 308.353 397.628 293.477 436 145.186C490 -63.5 572 -57.8156 688 255.186C757.071 441.559 989.5 -121.315 1389 98.6856C1708.6 274.686 1940.33 156.519 1964.5 98.6856" stroke="white" stroke-width="3" stroke-dasharray="2 2"/>
                    </svg>
                    <div class="page-image"><img src="<?php echo e(asset('frontend/'.App::getLocale().'/assets/images/bg/page-img-1.png')); ?>" alt="image"></div>
                    <svg class="page-svg" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21.1742 33.0065C14.029 35.2507 7.5486 39.0636 0 40.7339V86H1937V64.9942C1933.1 60.1623 1912.65 65.1777 1904.51 62.6581C1894.22 59.4678 1884.93 55.0079 1873.77 52.7742C1861.2 50.2585 1823.41 36.3854 1811.99 39.9252C1805.05 42.0727 1796.94 37.6189 1789.36 36.6007C1769.18 33.8879 1747.19 31.1848 1726.71 29.7718C1703.81 28.1919 1678.28 27.0012 1657.53 34.4442C1636.45 42.005 1606.07 60.856 1579.5 55.9191C1561.6 52.5906 1543.41 47.0959 1528.45 56.9075C1510.85 68.4592 1485.74 74.2518 1460.44 76.136C1432.32 78.2297 1408.53 70.6879 1384.73 62.2987C1339.52 46.361 1298.19 27.1677 1255.08 9.28534C1242.58 4.10111 1214.68 15.4762 1200.55 16.6533C1189.77 17.5509 1181.74 15.4508 1172.12 12.8795C1152.74 7.70033 1133.23 2.88525 1111.79 2.63621C1088.85 2.36971 1073.94 7.88289 1056.53 15.8446C1040.01 23.3996 1027.48 26.1777 1007.8 26.1777C993.757 26.1777 975.854 25.6887 962.844 28.9632C941.935 34.2258 932.059 38.7874 914.839 28.6037C901.654 20.8061 866.261 -2.56499 844.356 7.12886C831.264 12.9222 820.932 21.5146 807.663 27.5255C798.74 31.5679 779.299 42.0561 766.33 39.1166C758.156 37.2637 751.815 31.6349 745.591 28.2443C730.967 20.2774 715.218 13.2948 695.846 10.723C676.168 8.11038 658.554 23.1787 641.606 27.4357C617.564 33.4742 602.283 27.7951 579.244 27.7951C568.142 27.7951 548.414 30.4002 541.681 23.6618C535.297 17.2722 530.162 9.74921 523.263 3.71444C517.855 -1.01577 505.798 -0.852017 498.318 2.09709C479.032 9.7007 453.07 10.0516 431.025 9.64475C407.556 9.21163 368.679 1.61612 346.618 10.3636C319.648 21.0575 291.717 53.8338 254.67 45.2266C236.134 40.9201 225.134 37.5813 204.78 40.7339C186.008 43.6415 171.665 50.7785 156.051 57.3567C146.567 61.3523 152.335 52.6281 151.12 47.9222C149.535 41.7853 139.994 34.5585 132.991 30.4008C120.206 22.8098 90.2848 24.3246 74.2546 24.6502C55.5552 25.0301 37.9201 27.747 21.1742 33.0065Z" fill="#FFFAF3"/>
                    </svg>
             
                    <div class="shape shape-three"><span><img src="<?php echo e(asset('frontend/'.App::getLocale().'/assets/images/shape/curved-arrow.png')); ?>" alt=""></span></div>
                    <div class="shape shape-four"><span><img src="<?php echo e(asset('frontend/'.App::getLocale().'/assets/images/shape/stars.png')); ?>" alt=""></span></div>                
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-banner-content">
                                    <h1>
                                      <?php echo e(app()->getLocale() === 'ar' ? $product->name_ar : $product->name_en); ?>


                               
                                </h1>
                                    <ul class="breadcrumb-link">
                                         <li><a href="<?php echo e(route('home')); ?>"> <?php echo e(__('home.home')); ?></a></li>
                                        <li><i class="far fa-long-arrow-right"></i></li>
                                        <li class="active"><?php echo e(__('home.product_details')); ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!--====== End Page Banner Section ======-->
            <section class="shop-details-section pt-5 pb-2 dir-rtl">
                <div class="container">
                    <div class="shop-details-wrapper">
                        <div class="row">
                            <div class="col-xl-5">
                                <!--=== Product Gallery ===-->
                                <div class="product-gallery-area mb-50 dir-ltr" data-aos="fade-up" data-aos-duration="1200">

    
    <div class="product-big-slider mb-2">
        <?php $__empty_1 = true; $__currentLoopData = $gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
                $src = $img->path ?? null;
                $src = $src ? asset($src) : asset('frontend/'.App::getLocale().'/assets/images/products/product-big-1.jpg');
            ?>

            <div class="product-img">
                <a href="<?php echo e($src); ?>" class="img-popup">
                    <img src="<?php echo e($src); ?>" alt="<?php echo e(app()->getLocale()==='ar' ? $product->name_ar : $product->name_en); ?>">
                </a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="product-img">
                <img src="<?php echo e(asset('frontend/'.App::getLocale().'/assets/images/products/product-big-1.jpg')); ?>" alt="Product">
            </div>
        <?php endif; ?>
    </div>

    
    <div class="product-thumb-slider">
        <?php $__currentLoopData = $gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $src = $img->path ?? null;
                $src = $src ? asset($src) : asset('frontend/'.App::getLocale().'/assets/images/products/product-thumb-1.jpg');
            ?>

            <div class="product-img">
                <img src="<?php echo e($src); ?>" alt="thumb">
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

</div>

                            </div>
                            <div class="col-xl-7">
                                <div class="product-info mb-40" data-aos="fade-up" data-aos-duration="1400">
                                   <?php if($hasSale && $discountPercent): ?>
                                    <span class="sale"><i class="fas fa-tags"></i><?php echo e($discountPercent); ?>% OFF</span>
                                  <?php endif; ?>
                                    <h4 class="title"> <?php echo e(app()->getLocale() === 'ar' ? $product->name_ar : $product->name_en); ?> </h4>
                                   <?php
  $avg = (float)($avgRating ?? 0);
  $avgRounded = (int) round($avg);
?>
                                    <ul class="ratings rating<?php echo e($avgRounded); ?>">
                                          <?php for($i=1;$i<=5;$i++): ?>
    <li><i class="fas fa-star"></i></li>
  <?php endfor; ?>
                                       
                                        <li><a href="#"> (<?php echo e($reviewsCount ?? 0); ?>) <?php echo e(__('home.total_reviews')); ?></a></li>
                                    </ul>
                                    <?php if(!empty($product->description_ar) || !empty($product->description_en)): ?>
                                    <p>   <?php echo nl2br(e(app()->getLocale()==='ar' ? ($product->description_ar ?? '') : ($product->description_en ?? ''))); ?></p>
                                   <?php endif; ?>
                                    <div class="product-price">
                                         <?php if($oldPrice): ?>
        <span class="price prev-price">
            <span class="currency"><?php echo e($symbol); ?></span><?php echo e(number_format($oldPrice, 2)); ?>

        </span>
    <?php endif; ?>
                                        <span class="price new-price"><span class="currency"><?php echo e($symbol); ?></span><?php echo e(number_format($price, 2)); ?></span>
                                    </div>
                                  
                                    <div class="product-size">
                                        <h4 class="mb-15">Size</h4>
                                        <ul class="size-list mb-2">
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="radio" value="Slim Fit" id="size2">
                                                    <label class="form-check-label" for="size2">
                                                        S
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="radio" value="Slim Fit" id="size3">
                                                    <label class="form-check-label" for="size3">
                                                        M
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="radio" value="Slim Fit" id="size4">
                                                    <label class="form-check-label" for="size4">
                                                        L
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="radio" value="Slim Fit" id="size5">
                                                    <label class="form-check-label" for="size5">
                                                        XL
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="radio" value="Slim Fit" id="size6">
                                                    <label class="form-check-label" for="size6">
                                                        2XL
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product-cart-variation">
                                        <ul>
                                            <!-- <li>
                                                <div class="quantity-input">
                                                    <button class="quantity-down"><i class="far fa-minus"></i></button>
                                                    <input class="quantity" type="text" value="1" name="quantity">
                                                    <button class="quantity-up"><i class="far fa-plus"></i></button>
                                                </div>
                                            </li> 
                                            <li>
                                                <a href="#" class="theme-btn style-one">Add To cart</a>
                                            </li> -->
                                           <form method="POST" action="<?php echo e(route('cart.add', $product->slug)); ?>">
  <?php echo csrf_field(); ?>

  <div class="product-cart-variation">
    <ul>
      <li>
        <div class="quantity-input">
          <button type="button" class="quantity-down"><i class="far fa-minus"></i></button>
          <input class="quantity" type="text" value="1" name="qty">
          <button type="button" class="quantity-up"><i class="far fa-plus"></i></button>
        </div>
      </li>

      <li>
        <button type="submit" class="theme-btn style-one">
          <?php echo e(__('messages.add_to_cart')); ?>

        </button>
      </li>
    </ul>
  </div>
</form>

                                            <li>
                                                <?php
  $wishIds = session('wishlist', []);
  $isWished = auth()->check()
      ? auth()->user()->wishlistProducts()->where('products.id', $product->id)->exists()
      : in_array($product->id, $wishIds);
?>
<a href="#" class="icon-btn js-wishlist-toggle <?php echo e($isWished ? 'is-active' : ''); ?>" data-url="<?php echo e(route('wishlist.toggle', $product->slug)); ?>" aria-label="wishlist"> <i class="<?php echo e($isWished ? 'fa fa-heart' : 'far fa-heart'); ?>"></i>
</a>
                                            </li>
                                          
                                        </ul>
                                    </div>
                                    <div class="product-meta">
                                        <ul>
                                            <?php if(!empty($product->sku)): ?>
            <li><span>SKU :</span> <?php echo e($product->sku); ?></li>
        <?php endif; ?>
                                            <?php if($product->category): ?>
            <li>
                <span><?php echo e(__('home.category')); ?> :</span>
                <a href="<?php echo e(route('category.products', $product->category->slug)); ?>">
                    <?php echo e(app()->getLocale()==='ar' ? $product->category->name_ar : $product->category->name_en); ?>

                </a>
            </li>
        <?php endif; ?>
                                              <?php if($product->brand): ?>
            <li>
                <span><?php echo e(__('home.brand')); ?> :</span>
                <a href="<?php echo e(route('brand.products', $product->brand->slug)); ?>">
                    <?php echo e(app()->getLocale()==='ar' ? $product->brand->name_ar : $product->brand->name_en); ?>

                </a>
            </li>
        <?php endif; ?>
      </ul>
                                    </div>
                                    <!-- <div class="special-features">
                                        <span><i class="far fa-shipping-fast"></i>Free Shipping</span>
                                   
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="additional-information-wrapper" data-aos="fade-up" data-aos-delay="30" data-aos-duration="1000">
                            <div class="row">
                           
                                <div class="col-lg-12">
                                    <div class="description-wrapper additional-info-box mb-40">
                                        <div class="pesco-tabs style-two mb-2">
                                            <ul class="nav nav-tabs">
                                                <li>
                                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#description"><?php echo e(__('home.description')); ?></button>
                                                </li>
                                                <li>
                                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#reviews"><?php echo e(__('home.Reviews')); ?></button>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane fade active show" id="description">
                                                <h4><?php echo e(__('home.description')); ?></h4>
                                                <p> <?php echo nl2br(e(app()->getLocale()==='ar' ? ($product->description_ar ?? '') : ($product->description_en ?? ''))); ?>

                                                </p>
                                                    <!-- <h4>Features</h4>
                                                <ul class="list">
                                                    <li>Function First</li>
                                                    <li>Summer Breeze </li>
                                                    <li>Casual and Rugged</li>
                                                    <li>Possible Interpretations</li>
                                                </ul> -->
                                            </div>
                                            <div class="tab-pane fade" id="reviews">
                                                <div class="pesco-comment-area mb-0">
                                                    <h4><?php echo e(__('home.total_reviews')); ?> (<?php echo e($reviewsCount ?? 0); ?>)</h4>
                                                    <ul>
                                                         <?php $__empty_1 = true; $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                        <li class="comment">
                                                            <div class="pesco-reviews-item">
                                                                <div class="author-thumb-info">
                                                                    <div class="author-thumb">
                                                                        <img src="<?php echo e(asset('frontend/'.App::getLocale().'/assets/images/Sample_User_Icon.png')); ?>" alt="Auhthor">
                                                                    </div>
                                                                    <div class="author-info">
                                                                        <h5><?php echo e($r->user->name ?? $r->name ?? __('home.guest')); ?></h5>
                                                                        <div class="author-meta">
                                                                            <ul class="ratings rating<?php echo e((int)$r->rating); ?>">
                                                                                 <?php for($i=1;$i<=5;$i++): ?>
                  <li><i class="fas fa-star"></i></li>
                <?php endfor; ?>
                                                                               
                                                                          </ul>
                                                                            <span><?php echo e($r->created_at->format('d M Y')); ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="author-review-content">
                                                                    <p><?php echo e($r->comment); ?></p>
                                                                </div>
                                                                <a href="#" class="reply"><i class="fas fa-reply-all"></i>Reply</a>
                                                            </div>
                                                        </li>
                                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <li><?php echo e(__('home.no_reviews_yet')); ?></li>
  <?php endif; ?>
                                                    </ul>
                                                </div>
                                                <div class="reviews-contact-area">
                                                    <h4><?php echo e(__('home.Write_Comment')); ?></h4>
                                                    <!-- <ul class="ratings rating5 mb-40">
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><a href="#">(10)</a></li>
                                                    </ul> -->
                                              <?php if(auth()->check()): ?>
  <form method="POST" action="<?php echo e(route('product.reviews.store', $product->slug)); ?>" class="pesco-contact-form">
    <?php echo csrf_field(); ?>

    <div class="row">
      <div class="col-lg-12">
        <div class="form-group">
          <label><?php echo e(__('home.rating')); ?></label>
          <select class="form_control" name="rating" required>
            <?php for($i=5;$i>=1;$i--): ?>
              <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
            <?php endfor; ?>
          </select>
        </div>
      </div>

      <div class="col-lg-12">
        <div class="form-group">
          <textarea class="form_control" name="comment" rows="6" required
            placeholder="<?php echo e(__('home.write_review')); ?>"></textarea>
        </div>
      </div>

      <div class="col-lg-12">
        <button class="theme-btn style-one"><?php echo e(__('home.submit_review')); ?></button>
      </div>
    </div>
  </form>
<?php else: ?>
  <div class="alert alert-info">
    <?php echo e(__('home.login_to_review')); ?>

    <a href="<?php echo e(route('login')); ?>" class="ms-2"><?php echo e(__('home.login')); ?></a>
  </div>
<?php endif; ?>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

<!-- releted products section can go here  -->
     <section class="features-products-section pt-2 pb-2 overflow-hidden">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <!--=== Section Title  ===-->
                        <div class="section-title mb-30" data-aos="fade-right" data-aos-delay="10"
                            data-aos-duration="1000">
                            <div class="sub-heading d-inline-flex align-items-center">
                                <i class="flaticon-sparkler"></i>
                                <span class="sub-title"><?php echo e(__('home.Releted_Products')); ?></span>
                            </div>
                            <h2><?php echo e(__('home.Customers_also_purchased')); ?> </h2>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <!--=== Arrows ===-->
                        <div class="feature-arrows style-one mb-60" data-aos="fade-left" data-aos-delay="15"
                            data-aos-duration="1200"></div>
                    </div>
                </div>
                <!--=== Feature Slider  ===-->
                <div class="feature-slider-one" data-aos="fade-up" data-aos-delay="20" data-aos-duration="1400">
                  <?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $pName = app()->getLocale()==='ar' ? $p->name_ar : $p->name_en;

            $pImgObj = $p->images->first();
            $pImg = null;
            if($pImgObj){
                $pImgPath = $pImgObj->path  ?? null;
              
                $pImg = $pImgPath ? asset($pImgPath) : null;
            }
            $pImg = $pImg ?: asset('frontend/'.App::getLocale().'/assets/images/products/feature-product-1.png');

            $pBasePrice = (float)($p->price ?? 0);
            $pBaseSale  = (float)($p->sale_price ?? 0);
            $pHasSale = $pBaseSale > 0 && $pBaseSale < $pBasePrice;

            $pFinalBase = $pHasSale ? $pBaseSale : $pBasePrice;
            $pPrice = $pFinalBase * $rate;
            $pOld = $pHasSale ? ($pBasePrice * $rate) : null;

            $pDiscount = null;
            if($pHasSale && $pBasePrice > 0){
                $pDiscount = (int) round((($pBasePrice - $pBaseSale)/$pBasePrice)*100);
            }
        ?>

                 <div class="product-item style-one mb-40 back-p">
    <div class="product-thumbnail">
        <img src="<?php echo e($pImg); ?>" alt="<?php echo e($pName); ?>">

        <?php if($pDiscount): ?>
            <div class="discount"><?php echo e($pDiscount); ?>% Off</div>
        <?php endif; ?>

        <div class="hover-content">
            <a href="#" class="icon-btn"><i class="fa fa-heart"></i></a>
            <a href="<?php echo e($pImg); ?>" class="img-popup icon-btn"><i class="fa fa-eye"></i></a>
        </div>

        <div class="cart-button">
            <a href="<?php echo e(route('product.show', $p->slug)); ?>" class="cart-btn">
                <i class="far fa-shopping-basket"></i>
                <span class="text"><?php echo e(__('home.view_details')); ?></span>
            </a>
        </div>
    </div>

    <div class="product-info-wrap">
        <div class="product-info">
            <h4 class="title">
                <a href="<?php echo e(route('product.show', $p->slug)); ?>"><?php echo e($pName); ?></a>
            </h4>
        </div>

        <div class="product-price">
            <?php if($pOld): ?>
                <span class="price prev-price"><span class="currency"><?php echo e($symbol); ?></span><?php echo e(number_format($pOld,2)); ?></span>
            <?php endif; ?>
            <span class="price new-price"><span class="currency"><?php echo e($symbol); ?></span><?php echo e(number_format($pPrice,2)); ?></span>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                  
                </div>
            </div>
        </section>
 <!-- end  -->
        
   
    </main>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.main_layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/front/product-show.blade.php ENDPATH**/ ?>