

<?php $__env->startSection('content'); ?>
<main class="main-bg">
    <!--====== Start Hero Section ======-->
    <section class="hero-section">
        <!--=== Hero Wrapper ===-->
        <div class="hero-wrapper-two">
            <!--=== Hero shape ===-->
            <div class="hero-shape bg_cover d-none d-xl-block"
                style="background-image: url(<?php echo e(asset('frontend/'.App::getLocale().'/assets/images/hero/hero-two-shape1.png')); ?>);">
            </div>
            <!--=== Hero Image ===-->
            <div class="hero-image d-none d-xl-block">
                <img src="<?php echo e(asset('frontend/'.App::getLocale().'/assets/images/PM.jpeg')); ?>" alt="Hero Image">
                <div class="hero-img-shape"><img
                        src="<?php echo e(asset('frontend/'.App::getLocale().'/assets/images/hero/hero-two-img-shape1.png')); ?>"
                        alt="Image Shape">
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-6">
                        <!--=== hero Post Slider ===-->
                        <div class="hero-post-slider mb-50">
                            <?php $__currentLoopData = $heroBanner; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $titlee = app()->getLocale() == 'ar'
                            ? $banner->title_ar
                            : $banner->title;

                            $words = explode(' ', trim($titlee));

                            $firstWords = implode(' ', array_slice($words, 0, 3));
                            $restWords = implode(' ', array_slice($words, 3));
                            ?>
                            <!--=== Single Post Slider ===-->
                            <div class="single-hero-post">
                                <div class="hero-content style-two">
                                    <span class="tag-line"><i class="flaticon-star-2"></i><b><?php echo e(__('home.Best_for_your_categories')); ?></b><i class="flaticon-star-2"></i></span>
                                    <h1><span><?php echo e($firstWords); ?></span><?php echo e($restWords); ?></h1>
                                    <p><?php echo e(app()->getLocale() == 'ar' ? $banner->description_ar : $banner->description); ?>

                                    </p>
                                    <a href="<?php echo e($banner->link ?? '#'); ?>" class="theme-btn style-one"><?php echo e(__('home.shop_now')); ?></a>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <!--=== Hero Dots ===-->
                        <div class="hero-dots text-center text-xl-start pb-5"></div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--====== End Hero Section ======-->
    <!--====== Start Animated-headline Section ======-->
    <section class="animated-headline-area primary-dark-bg pt-25 pb-25">
        <div class="headline-wrap style-one">
            <span class="marquee-wrap">
                <span class="marquee-inner left">
                    <?php $__currentLoopData = $homeTabsCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $homeTabsCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="marquee-item"> <a href="<?php echo e(route('category.products', $homeTabsCategory->slug)); ?>"
                            class="hover-c"><b><?php if(App::isLocale('en')): ?> <?php echo e($homeTabsCategory->name_en); ?><?php else: ?>
                                <?php echo e($homeTabsCategory->name_ar); ?><?php endif; ?></b></a><i class="fas fa-bahai"></i></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </span>
                <span class="marquee-inner left">
                    <?php $__currentLoopData = $homeTabsCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $homeTabsCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="marquee-item"> <a href="<?php echo e(route('category.products', $homeTabsCategory->slug)); ?>"
                            class="hover-c"><b><?php if(App::isLocale('en')): ?> <?php echo e($homeTabsCategory->name_en); ?><?php else: ?>
                                <?php echo e($homeTabsCategory->name_ar); ?><?php endif; ?></b></a><i class="fas fa-bahai"></i></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </span>
                <span class="marquee-inner left">
                    <?php $__currentLoopData = $homeTabsCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $homeTabsCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="marquee-item"> <a href="<?php echo e(route('category.products', $homeTabsCategory->slug)); ?>"
                            class="hover-c"><b><?php if(App::isLocale('en')): ?> <?php echo e($homeTabsCategory->name_en); ?><?php else: ?>
                                <?php echo e($homeTabsCategory->name_ar); ?><?php endif; ?></b></a><i class="fas fa-bahai"></i></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </span>

            </span>
        </div>
    </section><!--====== End Animated-headline Section ======-->
    <!--====== Start Category Section ======-->
    <section class="category-section pt-5 pb-2 overflow-hidden">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-8">
                    <!--=== Section Title ===-->
                    <div class="section-title mb-30" data-aos="fade-right" data-aos-delay="10" data-aos-duration="800">
                        <div class="sub-heading d-inline-flex align-items-center">
                            <i class="flaticon-sparkler"></i>
                            <span class="sub-title"><?php echo e(__('home.Categories')); ?></span>
                        </div>
                        <h2><?php echo e(__('home.Browse_Top_Category')); ?></h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-4">
                    <!--=== Arrows ===-->
                    <div class="category-arrows style-one mb-60" data-aos="fade-left" data-aos-delay="15"
                        data-aos-duration="1000"></div>
                </div>
            </div>
        </div>
        <!--=== Category Slider ===-->
        <div class="category-slider-one" data-aos="fade-up" data-aos-delay="20" data-aos-duration="1200">
            <?php $__currentLoopData = $topCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <!--=== Category Item ===-->
            <div class="category-item style-one text-center">
                <div class="category-img">
                    <img src="<?php echo e(asset($topCategory->image)); ?>"
                        alt="<?php if(App::isLocale('en')): ?> <?php echo e($topCategory->name_en); ?><?php else: ?> <?php echo e($topCategory->name_ar); ?><?php endif; ?>">
                </div>
                <div class="category-content">
                   <a href="<?php echo e(route('category.products', $topCategory->slug)); ?>" class="category-btn">
    <?php if(App::isLocale('en')): ?>
        <?php echo e($topCategory->name_en); ?>

    <?php else: ?>
        <?php echo e($topCategory->name_ar); ?>

    <?php endif; ?>
</a>

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        </div>
    </section><!--====== End Category Section ======-->
    <!--===== Start brand Section  ======-->
    <section class="category-section pt-5 pb-2 overflow-hidden">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!--=== Section Title  ===-->
                    <div class="section-title  text-center text-md-start mb-50" data-aos="fade-right"
                        data-aos-delay="10" data-aos-duration="1000">
                        <div class="sub-heading d-inline-flex align-items-center">
                            <i class="flaticon-sparkler"></i>
                            <span class="sub-title"><?php echo e(__('home.brands')); ?></span>
                        </div>
                        <h2><?php echo e(__('home.Browse_Top_Brands')); ?></h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <!--=== Category Button  ===-->
                    <div class="category-button text-center float-md-end mb-60" data-aos="fade-left" data-aos-delay="15"
                        data-aos-duration="1200">
                        <a href="<?php echo e(route('brands')); ?>" class="theme-btn style-one"><?php echo e(__('home.View_All')); ?> <i
                                class="far fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <!--====== Start Category Wrapper ======-->
            <div class="category-wrapper pt-80">
                <div class="row justify-content-center">
                    <?php $__currentLoopData = $topBrands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topBrand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                        <!--=== Category Item  ===-->
                        <div class="category-item style-two mb-2 back-red-h" data-aos="fade-up" data-aos-delay="10"
                            data-aos-duration="800">
                            <div class="category-img">
                                <img src="<?php echo e(asset($topBrand->logo)); ?>"
                                    alt="<?php if(App::isLocale('en')): ?> <?php echo e($topBrand->name_en); ?><?php else: ?> <?php echo e($topBrand->name_ar); ?><?php endif; ?>">
                            </div>
                            <div class="category-content">
                                <a href="<?php echo e(route('brand.products', $topBrand->slug)); ?>" class="category-btn"> 
                                    <?php if(App::isLocale('en')): ?>
                                     <?php echo e($topBrand->name_en); ?>

                                    <?php else: ?>
                                     <?php echo e($topBrand->name_ar); ?>

                                    <?php endif; ?></a>
                                <span><?php echo e($topBrand->products_count); ?> <?php echo e(__('home.items')); ?></span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </section><!--===== End brand Section  ======-->
    <!--====== Start Features Section ======-->
    <section class="features-products pt-5 pb-2 overflow-hidden">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <!--=== Section Title ===-->
                    <div class="section-title mb-30 text-center text-lg-start" data-aos="fade-right" data-aos-delay="10"
                        data-aos-duration="1000">
                        <div class="sub-heading d-inline-flex align-items-center">
                            <i class="flaticon-sparkler"></i>
                            <span class="sub-title"><?php echo e(__('home.Feature_Products')); ?></span>
                        </div>
                        <h2><?php echo e(__('home.Our_Features_Collection')); ?></h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!--=== Pesco Tabs ===-->
                    <div class="pesco-tabs style-one mb-50" data-aos="fade-left" data-aos-delay="15"
                        data-aos-duration="1200">
                        <ul class="nav nav-tabs" role="tablist">
                            <li>
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#cat1"
                                    role="tab"><?php echo e(__('home.Best_Sellers')); ?></button>
                            </li>
                            <li>
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#cat2" role="tab"><?php echo e(__('home.New_Products')); ?></button>
                            </li>
                            <li>
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#cat3" role="tab"><?php echo e(__('home.Sale_Products')); ?></button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!--=== Tab Content ===-->
                    <div class="tab-content" data-aos="fade-up" data-aos-duration="1200">
                        <!--=== Tab Pane  ===-->
                        <div class="tab-pane fade show active" id="cat1">
                            <div class="row justify-content-center">
                                <?php $__currentLoopData = $bestSellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bestSeller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-xl-3 col-lg-4 col-sm-6">
                                    <!--=== Product Item  ===-->
                                    <div class="product-item style-one mb-40 back-p">
                                        <div class="product-thumbnail">
                                            <img src="<?php echo e($bestSeller->mainImageProduct
        ? asset($bestSeller->mainImageProduct->path)
        : asset('assets/images/products/default.png')); ?>" alt="Products">
                                            <?php if($bestSeller->sale_price): ?>
                                            <div class="discount">10% Off</div>
                                            <?php endif; ?>
                                            <div class="hover-content">
                                                <?php
                                                $wishIds = session('wishlist', []);
                                                $isWished = auth()->check()
                                                ? auth()->user()->wishlistProducts()->where('products.id',
                                                $bestSeller->id)->exists()
                                                : in_array($bestSeller->id, $wishIds);
                                                ?>
                                                <a href="#"
                                                    class="icon-btn js-wishlist-toggle <?php echo e($isWished ? 'is-active' : ''); ?>"
                                                    data-url="<?php echo e(route('wishlist.toggle', $bestSeller->slug)); ?>"
                                                    aria-label="wishlist"> <i
                                                        class="<?php echo e($isWished ? 'fa fa-heart' : 'far fa-heart'); ?>"></i>
                                                </a>
                                                <a href="<?php echo e($bestSeller->mainImageProduct
        ? asset($bestSeller->mainImageProduct->path)
        : asset('assets/images/products/default.png')); ?>" class="img-popup icon-btn"><i class="fa fa-eye"></i></a>
                                            </div>
                                            <div class="cart-button">
                                                
  <?php if(($bestSeller->size_type ?? 'standard') === 'standard'): ?>
    
    <a href="<?php echo e(route('product.show', $bestSeller->slug ?? $product->id)); ?>" class="cart-btn">
        <i class="far fa-shopping-basket"></i>
        <span class="text"><?php echo e(__('home.Add_To_Cart')); ?></span>
    </a>
<?php else: ?>
   
    <a href="javascript:void(0)" class="cart-btn js-add-to-cart"
       data-url="<?php echo e(route('cart.add', $bestSeller->slug)); ?>"
       data-qty-input=".quantity">
        <i class="far fa-shopping-basket"></i>
        <span class="text"><?php echo e(__('home.Add_To_Cart')); ?></span>
    </a>
<?php endif; ?>

                                            </div>
                                        </div>
                                        <div class="product-info-wrap">
                                            <div class="product-info">
                                                <ul class="ratings rating5">
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><a href="#">(80)</a></li>
                                                </ul>
                                                <h4 class="title"><a
                                                        href="<?php echo e(route('product.show', $bestSeller->slug ?? $product->id)); ?>">
                                                        <?php echo e($bestSeller->name); ?></a></h4>
                                            </div>
                                            <?php if($bestSeller->sale_price): ?>
                                            <div class="product-price">
                                                <span class="price prev-price"><span class="currency"> <?php if($currentCurrency->code =='SAR'): ?>  <img src="<?php echo e(asset('frontend/saudi-riyal.svg')); ?>" width="25px"/> <?php else: ?><?php echo e($currentCurrency->symbol); ?><?php endif; ?></span><?php echo e(number_format($bestSeller->price * $currentCurrency->rate, 2)); ?></span>
                                                <span class="price new-price"><span class="currency"> <?php if($currentCurrency->code =='SAR'): ?>  <img src="<?php echo e(asset('frontend/saudi-riyal.svg')); ?>" width="25px"/> <?php else: ?><?php echo e($currentCurrency->symbol); ?><?php endif; ?></span><?php echo e(number_format($bestSeller->sale_price * $currentCurrency->rate, 2)); ?></span>
                                            </div>
                                            <?php else: ?>
                                            <div class="product-price">

                                                <span class="price new-price"><span class="currency"> <?php if($currentCurrency->code =='SAR'): ?>  <img src="<?php echo e(asset('frontend/saudi-riyal.svg')); ?>" width="25px"/> <?php else: ?><?php echo e($currentCurrency->symbol); ?><?php endif; ?>
                                                    </span><?php echo e(number_format($bestSeller->price * $currentCurrency->rate,
                                                    2)); ?></span>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="cat2">
                            <div class="row justify-content-center">

                                <?php $__currentLoopData = $newProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $newProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-xl-3 col-lg-4 col-sm-6">
                                    <!--=== Product Item  ===-->
                                    <div class="product-item style-one mb-40 back-p">
                                        <div class="product-thumbnail">
                                            <img src="<?php echo e($newProduct->mainImageProduct? asset($newProduct->mainImageProduct->path) : asset('assets/images/products/default.png')); ?>"
                                                alt="Products">
                                            <?php if($newProduct->sale_price): ?>
                                            <div class="discount">10% Off</div>
                                            <?php endif; ?>
                                            <div class="hover-content">
                                                <?php
                                                $wishIds = session('wishlist', []);
                                                $isWished = auth()->check()
                                                ? auth()->user()->wishlistProducts()->where('products.id',
                                                $newProduct->id)->exists()
                                                : in_array($newProduct->id, $wishIds);
                                                ?>
                                                <a href="#"
                                                    class="icon-btn js-wishlist-toggle <?php echo e($isWished ? 'is-active' : ''); ?>"
                                                    data-url="<?php echo e(route('wishlist.toggle', $newProduct->slug)); ?>"
                                                    aria-label="wishlist"> <i
                                                        class="<?php echo e($isWished ? 'fa fa-heart' : 'far fa-heart'); ?>"></i>
                                                </a>
                                                <a href="<?php echo e($newProduct->mainImageProduct? asset($newProduct->mainImageProduct->path): asset('assets/images/products/default.png')); ?>"
                                                    class="img-popup icon-btn"><i class="fa fa-eye"></i></a>
                                            </div>
                                            <div class="cart-button">
                                                  <?php if(($newProduct->size_type ?? 'standard') === 'standard'): ?>
    
    <a href="<?php echo e(route('product.show', $newProduct->slug ?? $newProduct->id)); ?>" class="cart-btn">
        <i class="far fa-shopping-basket"></i>
        <span class="text"><?php echo e(__('home.Add_To_Cart')); ?></span>
    </a>
<?php else: ?>
   
    <a href="javascript:void(0)" class="cart-btn js-add-to-cart"
       data-url="<?php echo e(route('cart.add', $newProduct->slug)); ?>"
       data-qty-input=".quantity">
        <i class="far fa-shopping-basket"></i>
        <span class="text"><?php echo e(__('home.Add_To_Cart')); ?></span>
    </a>
<?php endif; ?>
                                                </div>
                                        </div>
                                        <div class="product-info-wrap">
                                            <div class="product-info">
                                                <ul class="ratings rating5">
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><a href="#">(80)</a></li>
                                                </ul>
                                                <h4 class="title"><a
                                                        href="<?php echo e(route('product.show', $newProduct->slug ?? $product->id)); ?>">
                                                        <?php echo e($newProduct->name); ?></a></h4>
                                            </div>
                                            <?php if($newProduct->sale_price): ?>
                                            <div class="product-price">
                                                <span class="price prev-price"><span class="currency"> <?php if($currentCurrency->code =='SAR'): ?>  <img src="<?php echo e(asset('frontend/saudi-riyal.svg')); ?>" width="25px"/> <?php else: ?><?php echo e($currentCurrency->symbol); ?><?php endif; ?></span><?php echo e(number_format($newProduct->price * $currentCurrency->rate, 2)); ?></span>
                                                <span class="price new-price"><span class="currency"> <?php if($currentCurrency->code =='SAR'): ?>  <img src="<?php echo e(asset('frontend/saudi-riyal.svg')); ?>" width="25px"/> <?php else: ?><?php echo e($currentCurrency->symbol); ?><?php endif; ?></span><?php echo e(number_format($newProduct->sale_price * $currentCurrency->rate, 2)); ?></span>
                                            </div>
                                            <?php else: ?>
                                            <div class="product-price">

                                                <span class="price new-price"><span class="currency"> <?php if($currentCurrency->code =='SAR'): ?>  <img src="<?php echo e(asset('frontend/saudi-riyal.svg')); ?>" width="25px"/> <?php else: ?><?php echo e($currentCurrency->symbol); ?><?php endif; ?></span><?php echo e(number_format($newProduct->price * $currentCurrency->rate, 2)); ?></span>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="cat3">
                            <div class="row justify-content-center">

                                <?php $__currentLoopData = $saleProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $saleProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-xl-3 col-lg-4 col-sm-6">
                                    <!--=== Product Item  ===-->
                                    <div class="product-item style-one mb-40 back-p">
                                        <div class="product-thumbnail">
                                            <img src="<?php echo e($saleProduct->mainImageProduct? asset($saleProduct->mainImageProduct->path) : asset('assets/images/products/default.png')); ?>"
                                                alt="Products">
                                            <?php if($saleProduct->sale_price): ?>
                                            <div class="discount">10% Off</div>
                                            <?php endif; ?>
                                            <div class="hover-content">
                                                <?php
                                                $wishIds = session('wishlist', []);
                                                $isWished = auth()->check()
                                                ? auth()->user()->wishlistProducts()->where('products.id',
                                                $saleProduct->id)->exists()
                                                : in_array($saleProduct->id, $wishIds);
                                                ?>
                                                <a href="#"
                                                    class="icon-btn js-wishlist-toggle <?php echo e($isWished ? 'is-active' : ''); ?>"
                                                    data-url="<?php echo e(route('wishlist.toggle', $saleProduct->slug)); ?>"
                                                    aria-label="wishlist"> <i
                                                        class="<?php echo e($isWished ? 'fa fa-heart' : 'far fa-heart'); ?>"></i>
                                                </a>
                                                <a href="<?php echo e($saleProduct->mainImageProduct? asset($saleProduct->mainImageProduct->path): asset('assets/images/products/default.png')); ?>"
                                                    class="img-popup icon-btn"><i class="fa fa-eye"></i></a>
                                            </div>
                                            <div class="cart-button">
                                                <!-- <a href="javascript:void(0)" class="cart-btn js-add-to-cart"
                                                    data-url="<?php echo e(route('cart.add', $saleProduct->slug)); ?>"
                                                    data-qty-input=".quantity"><i class="far fa-shopping-basket"></i>
                                                    <span class="text"><?php echo e(__('home.Add_To_Cart')); ?></span></a> -->
                                            <?php if(($saleProduct->size_type ?? 'standard') === 'standard'): ?>
    
    <a href="<?php echo e(route('product.show', $saleProduct->slug ?? $saleProduct->id)); ?>" class="cart-btn">
        <i class="far fa-shopping-basket"></i>
        <span class="text"><?php echo e(__('home.Add_To_Cart')); ?></span>
    </a>
<?php else: ?>
   
    <a href="javascript:void(0)" class="cart-btn js-add-to-cart"
       data-url="<?php echo e(route('cart.add', $saleProduct->slug)); ?>"
       data-qty-input=".quantity">
        <i class="far fa-shopping-basket"></i>
        <span class="text"><?php echo e(__('home.Add_To_Cart')); ?></span>
    </a>
<?php endif; ?>
                                                </div>
                                        </div>
                                        <div class="product-info-wrap">
                                            <div class="product-info">
                                                <ul class="ratings rating5">
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><a href="#">(80)</a></li>
                                                </ul>
                                                <h4 class="title"><a
                                                        href="<?php echo e(route('product.show', $saleProduct->slug ?? $product->id)); ?>">
                                                        <?php echo e($saleProduct->name); ?></a></h4>
                                            </div>
                                            <?php if($saleProduct->sale_price): ?>
                                            <div class="product-price">
                                                <span class="price prev-price"><span class="currency"> <?php if($currentCurrency->code =='SAR'): ?>  <img src="<?php echo e(asset('frontend/saudi-riyal.svg')); ?>" width="25px"/> <?php else: ?><?php echo e($currentCurrency->symbol); ?><?php endif; ?></span><?php echo e(number_format($saleProduct->price * $currentCurrency->rate, 2)); ?></span>
                                                <span class="price new-price"><span class="currency"> <?php if($currentCurrency->code =='SAR'): ?>  <img src="<?php echo e(asset('frontend/saudi-riyal.svg')); ?>" width="25px"/> <?php else: ?><?php echo e($currentCurrency->symbol); ?><?php endif; ?></span><?php echo e(number_format($saleProduct->sale_price * $currentCurrency->rate, 2)); ?></span>
                                            </div>
                                            <?php else: ?>
                                            <div class="product-price">

                                                <span class="price new-price"><span class="currency"><?php echo e($currentCurrency->symbol); ?></span><?php echo e(number_format($saleProduct->price * $currentCurrency->rate, 2)); ?></span>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--====== End Features Section ======-->
    <!--====== Start Features Products Section  ======-->
    <section class="features-products-section pt-5 pb-2 overflow-hidden">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!--=== Section Title  ===-->
                    <div class="section-title mb-30" data-aos="fade-right" data-aos-delay="10" data-aos-duration="1000">
                        <div class="sub-heading d-inline-flex align-items-center">
                            <i class="flaticon-sparkler"></i>
                            <span class="sub-title"><?php echo e(__('home.Feature_Products')); ?></span>
                        </div>
                        <h2><?php echo e(__('home.Our_Products')); ?> </h2>
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
                <?php $__currentLoopData = $homeProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $homeProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <!--=== Project Item  ===-->
                <div class="product-item style-one mb-40 back-p">
                    <div class="product-thumbnail">
                        <img src="<?php echo e($homeProduct->mainImageProduct? asset($homeProduct->mainImageProduct->path) : asset('assets/images/products/default.png')); ?>"
                            alt="Products">
                        <?php if($homeProduct->sale_price): ?>
                        <div class="discount">10% Off</div>
                        <?php endif; ?>
                        <div class="hover-content">

                            <?php
                            $wishIds = session('wishlist', []);
                            $isWished = auth()->check()
                            ? auth()->user()->wishlistProducts()->where('products.id', $homeProduct->id)->exists()
                            : in_array($homeProduct->id, $wishIds);
                            ?>
                            <a href="#" class="icon-btn js-wishlist-toggle <?php echo e($isWished ? 'is-active' : ''); ?>"
                                data-url="<?php echo e(route('wishlist.toggle', $homeProduct->slug)); ?>" aria-label="wishlist"> <i
                                    class="<?php echo e($isWished ? 'fa fa-heart' : 'far fa-heart'); ?>"></i>
                            </a>


                            <a href="<?php echo e($homeProduct->mainImageProduct? asset($homeProduct->mainImageProduct->path) : asset('assets/images/products/default.png')); ?>"
                                class="img-popup icon-btn"><i class="fa fa-eye"></i></a>
                        </div>
                        <div class="cart-button">
                           
                                    <?php if(($homeProduct->size_type ?? 'standard') === 'standard'): ?>
    
    <a href="<?php echo e(route('product.show', $homeProduct->slug ?? $homeProduct->id)); ?>" class="cart-btn">
        <i class="far fa-shopping-basket"></i>
        <span class="text"><?php echo e(__('home.Add_To_Cart')); ?></span>
    </a>
<?php else: ?>
   
    <a href="javascript:void(0)" class="cart-btn js-add-to-cart"
       data-url="<?php echo e(route('cart.add', $homeProduct->slug)); ?>"
       data-qty-input=".quantity">
        <i class="far fa-shopping-basket"></i>
        <span class="text"><?php echo e(__('home.Add_To_Cart')); ?></span>
    </a>
<?php endif; ?>
                        </div>
                    </div>
                    <div class="product-info-wrap">
                        <div class="product-info">
                            <ul class="ratings rating4">
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><a href="#">(50)</a></li>
                            </ul>
                            <h4 class="title"><a
                                    href="<?php echo e(route('product.show', $homeProduct->slug ?? $product->id)); ?>"><?php echo e($homeProduct->name); ?></a></h4>
                        </div>
                        <?php if($homeProduct->sale_price): ?>
                        <div class="product-price">
                            <span class="price prev-price"><span class="currency">
                                <?php if($currentCurrency->code =='SAR'): ?>  <img src="<?php echo e(asset('frontend/saudi-riyal.svg')); ?>" width="25px"/> <?php else: ?><?php echo e($currentCurrency->symbol); ?><?php endif; ?></span><?php echo e(number_format($homeProduct->price * $currentCurrency->rate, 2)); ?></span>
                            <span class="price new-price"><span class="currency"> <?php if($currentCurrency->code =='SAR'): ?>  <img src="<?php echo e(asset('frontend/saudi-riyal.svg')); ?>" width="25px"/> <?php else: ?><?php echo e($currentCurrency->symbol); ?><?php endif; ?></span><?php echo e(number_format($homeProduct->sale_price * $currentCurrency->rate, 2)); ?></span>
                        </div>
                        <?php else: ?>
                        <div class="product-price">

                            <span class="price new-price"><span class="currency">
                                <?php if($currentCurrency->code =='SAR'): ?>  <img src="<?php echo e(asset('frontend/saudi-riyal.svg')); ?>" width="25px"/> <?php else: ?><?php echo e($currentCurrency->symbol); ?><?php endif; ?></span><?php echo e(number_format($homeProduct->price * $currentCurrency->rate, 2)); ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section><!--====== End Features Products Section  ======-->
   

    <!--====== Start Banner Section ======-->
    <section class="banner-section pt-5 pb-2">
        <div class="container">
            <div class="row">
                <?php $__currentLoopData = $promoBanners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-6">
                    <!--=== Banner Item ===-->
                    <div class="banner-item style-one bg-one mb-40" data-aos="fade-up" data-aos-delay="10"
                        data-aos-duration="900">
                        <div class="shape shape-one"><span><img
                                    src="<?php echo e(asset('frontend/'.App::getLocale().'/assets/images/banner/discount.png')); ?>"
                                    alt="shape"></span></div>
                        <div class="shape shape-two"><span><img
                                    src="<?php echo e(asset('frontend/'.App::getLocale().'/assets/images/banner/line.png')); ?>"
                                    alt="shape"></span></div>
                        <div class="banner-img"><img
                                src="<?php echo e($banner->image ? asset($banner->image) : asset('assets/images/banner/banner-1.png')); ?>"
                                alt="banner image">
                        </div>
                        <div class="banner-content">
                            <span><?php echo e(__('home.up_to')); ?> <span class="off"><?php echo e($banner->discount_percent); ?>%</span></span>
                            <h4> <?php echo e($banner->title); ?></br><?php echo e($banner->subtitle); ?></h4>
                            <a href="<?php echo e($banner->link ?? '#'); ?>" class="theme-btn style-one"><?php echo e(__('home.shop_now')); ?></a>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section><!--====== End Banner Section ======-->

    <!--====== Start Trending Products Sections  ======-->
    <section class="trending-products-section pt-5 pb-2">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!--=== Section Title  ===-->
                    <div class="section-title mb-30" data-aos="fade-right" data-aos-duration="1000">
                        <div class="sub-heading d-inline-flex align-items-center">
                            <i class="flaticon-sparkler"></i>
                            <span class="sub-title"><?php echo e(__('home.Trending_Products')); ?></span>
                        </div>
                        <h2><?php echo e(__("home.What's_Trending_Now")); ?></h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <!--=== Arrows ===-->
                    <div class="trending-product-arrows style-one mb-60" data-aos="fade-left" data-aos-duration="1200">
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="trending-products-slider" data-aos="fade-up" data-aos-duration="1400">
                <?php $__currentLoopData = $trendingNow; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trending): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <!--=== Product Item ===-->
                <div class="product-item style-two">
                    <div class="product-thumbnail">
                        <img src="<?php echo e($trending->mainImageProduct? asset($trending->mainImageProduct->path) : asset('assets/images/products/default.png')); ?>"
                            alt="Products">
                    </div>
                    <div class="product-info-wrap">
                        <div class="product-info">
                            <ul class="ratings rating5">
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><a href="#">(80)</a></li>
                            </ul>
                            <h4 class="title"><a href="<?php echo e(route('product.show', $trending->slug ?? $product->id)); ?>"><?php echo e($trending->name); ?></a></h4>
                        </div>
                        <?php if($trending->sale_price): ?>
                        <div class="product-price">
                            <span class="price prev-price"><span class="currency">  <?php if($currentCurrency->code =='SAR'): ?>  <img src="<?php echo e(asset('frontend/saudi-riyal.svg')); ?>" width="25px"/> <?php else: ?><?php echo e($currentCurrency->symbol); ?><?php endif; ?></span><?php echo e(number_format($trending->price * $currentCurrency->rate, 2)); ?></span>
                            <span class="price new-price"><span class="currency">  <?php if($currentCurrency->code =='SAR'): ?>  <img src="<?php echo e(asset('frontend/saudi-riyal.svg')); ?>" width="25px"/> <?php else: ?><?php echo e($currentCurrency->symbol); ?><?php endif; ?></span><?php echo e(number_format($trending->sale_price * $currentCurrency->rate, 2)); ?></span>
                        </div>
                        <?php else: ?>
                        <div class="product-price">

                            <span class="price new-price"><span class="currency">  <?php if($currentCurrency->code =='SAR'): ?>  <img src="<?php echo e(asset('frontend/saudi-riyal.svg')); ?>" width="25px"/> <?php else: ?><?php echo e($currentCurrency->symbol); ?><?php endif; ?></span><?php echo e(number_format($trending->price * $currentCurrency->rate, 2)); ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>
    </section><!--====== End Trending Products Sections  ======-->

    <!--====== Start Working Section  ======-->
    <section id="workProcess" class="work-processing-section pt-5 pb-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--=== Section Title  ===-->
                    <div class="section-title text-center mb-60" data-aos="fade-up" data-aos-delay="10"
                        data-aos-duration="800">
                        <div class="sub-heading d-inline-flex align-items-center">
                            <i class="flaticon-sparkler"></i>
                            <span class="sub-title"><?php echo e(__('home.work_processing')); ?></span>
                            <i class="flaticon-sparkler"></i>
                        </div>
                        <h2><?php echo e(__('home.how_it_work')); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php $__currentLoopData = $workSteps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-xl-3 col-sm-6">
                    <!--=== Iconic Box Item  ===-->
                    <div class="iconic-box-item style-two mb-40" data-aos="fade-up" data-aos-duration="1000">
                        <div class="sn-number"><?php echo e(str_pad($s->step_no,2,'0',STR_PAD_LEFT)); ?></div>
                        <div class="icon">
                            <?php if($s->icon_type === 'image' && $s->icon_image): ?>
                            <img src="<?php echo e(asset($s->icon_image)); ?>" alt="icon">
                            <?php else: ?>
                            <i class="<?php echo e($s->icon_class); ?>"></i>
                            <?php endif; ?>
                        </div>
                        <div class="content">
                            <h6><?php echo e(app()->getLocale()=='ar' ? $s->title_ar : $s->title_en); ?></h6>
                            <p><?php echo e(app()->getLocale()=='ar' ? $s->desc_ar : $s->desc_en); ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section><!--====== End Working Section  ======-->
    <!--====== Start Newsletter Section ======-->
    <section class="newsletter-section">
        <div class="newsletter-wrapper-two p-r z-1 pt-80 pb-85">
            <div class="newsletter-image-two" data-aos="fade-left" data-aos-duration="1200"><img
                    src="<?php echo e(asset('frontend/'.App::getLocale().'/assets/images/hannah-morgan-ycVFts5Ma4s-unsplash.jpg')); ?>"
                    alt="newsletter image"></div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="section-content-box" data-aos="fade-up" data-aos-duration="1000">
                            <!--=== Section Title  ===-->
                           
                            <div class="section-title">
                                <div class="sub-heading d-inline-flex align-items-center">
                                    <i class="flaticon-sparkler"></i>
                                    <span class="sub-title"><?php echo e(__('home.newsletter_title_small')); ?></span>
                                </div>
                                <h2> <?php echo __('home.newsletter_title_main'); ?></h2>
                            </div>
                            <form action="<?php echo e(route('newsletter.subscribe')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="email" class="form_control" placeholder="<?php echo e(__('home.write_email')); ?>"
                                    name="email" required>
                                <button class="theme-btn style-one"><?php echo e(__('home.subscribe')); ?></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--====== End Newsletter Section ======-->
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.main_layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/front/home.blade.php ENDPATH**/ ?>