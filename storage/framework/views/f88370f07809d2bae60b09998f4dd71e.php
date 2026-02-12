

<?php $__env->startSection('content'); ?>
<main class="main-bg">
    <!--====== Start Page Banner Section ======-->
    <section class="page-banner dir-rtl">
        <div class="page-banner-wrapper p-r z-1">
            <svg class="lineanm" viewBox="0 0 1920 347" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="line"
                    d="M-39 345.187C70 308.353 397.628 293.477 436 145.186C490 -63.5 572 -57.8156 688 255.186C757.071 441.559 989.5 -121.315 1389 98.6856C1708.6 274.686 1940.33 156.519 1964.5 98.6856"
                    stroke="white" stroke-width="3" stroke-dasharray="2 2" />
            </svg>
            <div class="page-image"><img
                    src="<?php echo e(asset('frontend/'.App::getLocale().'/assets/images/bg/page-img-1.png')); ?>" alt="image"></div>
            <svg class="page-svg" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M21.1742 33.0065C14.029 35.2507 7.5486 39.0636 0 40.7339V86H1937V64.9942C1933.1 60.1623 1912.65 65.1777 1904.51 62.6581C1894.22 59.4678 1884.93 55.0079 1873.77 52.7742C1861.2 50.2585 1823.41 36.3854 1811.99 39.9252C1805.05 42.0727 1796.94 37.6189 1789.36 36.6007C1769.18 33.8879 1747.19 31.1848 1726.71 29.7718C1703.81 28.1919 1678.28 27.0012 1657.53 34.4442C1636.45 42.005 1606.07 60.856 1579.5 55.9191C1561.6 52.5906 1543.41 47.0959 1528.45 56.9075C1510.85 68.4592 1485.74 74.2518 1460.44 76.136C1432.32 78.2297 1408.53 70.6879 1384.73 62.2987C1339.52 46.361 1298.19 27.1677 1255.08 9.28534C1242.58 4.10111 1214.68 15.4762 1200.55 16.6533C1189.77 17.5509 1181.74 15.4508 1172.12 12.8795C1152.74 7.70033 1133.23 2.88525 1111.79 2.63621C1088.85 2.36971 1073.94 7.88289 1056.53 15.8446C1040.01 23.3996 1027.48 26.1777 1007.8 26.1777C993.757 26.1777 975.854 25.6887 962.844 28.9632C941.935 34.2258 932.059 38.7874 914.839 28.6037C901.654 20.8061 866.261 -2.56499 844.356 7.12886C831.264 12.9222 820.932 21.5146 807.663 27.5255C798.74 31.5679 779.299 42.0561 766.33 39.1166C758.156 37.2637 751.815 31.6349 745.591 28.2443C730.967 20.2774 715.218 13.2948 695.846 10.723C676.168 8.11038 658.554 23.1787 641.606 27.4357C617.564 33.4742 602.283 27.7951 579.244 27.7951C568.142 27.7951 548.414 30.4002 541.681 23.6618C535.297 17.2722 530.162 9.74921 523.263 3.71444C517.855 -1.01577 505.798 -0.852017 498.318 2.09709C479.032 9.7007 453.07 10.0516 431.025 9.64475C407.556 9.21163 368.679 1.61612 346.618 10.3636C319.648 21.0575 291.717 53.8338 254.67 45.2266C236.134 40.9201 225.134 37.5813 204.78 40.7339C186.008 43.6415 171.665 50.7785 156.051 57.3567C146.567 61.3523 152.335 52.6281 151.12 47.9222C149.535 41.7853 139.994 34.5585 132.991 30.4008C120.206 22.8098 90.2848 24.3246 74.2546 24.6502C55.5552 25.0301 37.9201 27.747 21.1742 33.0065Z"
                    fill="#FFFAF3" />
            </svg>

            <div class="shape shape-three"><span><img
                        src="<?php echo e(asset('frontend/'.App::getLocale().'/assets/images/shape/curved-arrow.png')); ?>"
                        alt=""></span></div>
            <div class="shape shape-four"><span><img
                        src="<?php echo e(asset('frontend/'.App::getLocale().'/assets/images/shape/stars.png')); ?>" alt=""></span>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-banner-content">
                            <h1><?php if($model): ?>
                                <?php echo e(app()->getLocale() === 'ar' ? $model->name_ar : $model->name_en); ?>

                                <?php else: ?>
                                <?php echo e(__('home.all_products')); ?>

                                <?php endif; ?>
                            </h1>
                            <ul class="breadcrumb-link">
                                <li><a href="<?php echo e(route('home')); ?>"> <?php echo e(__('home.home')); ?></a></li>
                                <li><i class="far fa-long-arrow-right"></i></li>
                                <li class="active"><?php echo e(__('home.all_products')); ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--====== End Page Banner Section ======-->
    <!--====== Start Shop page Section ======-->
    <section class="shop-page-section pt-5 pb-5 dir-rtl">
        <div class="container">
            <div class="row">
                <div class="col-xl-3">
                    <!--=== Sidebar Area ===-->
                    <div class="shop-sidebar-area" id="filterSidebar">
                        <div class="sidebar-close d-xl-none">
                            <button class="close-btn" id="filterCloseBtn">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <!--=== Product Widget ===-->
                        <div class="product-widget product-categories-widget mb-3" data-aos="fade-up"
                            data-aos-delay="20" data-aos-duration="1000">
                            <div class="widget-content">
                                <?php

                                $selectedCategoryIds = (array) request()->get('category_ids', (isset($categoryId) &&
                                $categoryId ? [$categoryId] : []));
                                $selectedBrandIds = (array) request()->get('brand_ids', []);
                                ?>

                                <form id="filtersForm" method="GET" action="<?php echo e(route('products')); ?>">
                                    <input type="hidden" name="q" value="<?php echo e($q ?? ''); ?>">
                                    <input type="hidden" name="sort" value="<?php echo e($sort ?? 'new'); ?>">

                                    <input type="hidden" name="from" id="fromHidden" value="<?php echo e($priceFrom ?? ''); ?>">
                                    <input type="hidden" name="to" id="toHidden" value="<?php echo e($priceTo ?? ''); ?>">
                                </form>
                                <h4 class="widget-title"><?php echo e(__('home.product_categories')); ?></h4>
                                <div class="custom-select-dropdown">
                                    <button type="button" class="select-dropdown-btn" id="categoriesDropdownBtn">
                                        <span class="selected-text"><?php echo e(__('home.select_categories')); ?></span>
                                        <i class="fas fa-chevron-down dropdown-icon"></i>
                                    </button>
                                    <div class="dropdown-menu-custom" id="categoriesDropdownMenu">
                                        <ul class="categories-list">
                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input category-checkbox" type="checkbox"
                                                        name="category_ids[]" value="<?php echo e($cat->id); ?>"
                                                        id="cat_<?php echo e($cat->id); ?>" form="filtersForm"
                                                        <?php if(in_array($cat->id, $selectedCategoryIds)): echo 'checked'; endif; ?>
                                                    >

                                                    <label class="form-check-label" for="cat_<?php echo e($cat->id); ?>">
                                                        <?php echo e(app()->getLocale()==='ar' ? $cat->name_ar : $cat->name_en); ?><span><?php echo e($cat->products_count ?? ''); ?></span>
                                                    </label>
                                                </div>
                                            </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--=== Sidebar Widget ===-->
                        <div class="product-widget price-filter-widget mb-3 wow fadeInUp" data-aos="fade-up"
                            data-aos-delay="20" data-aos-duration="400">
                            <div class="widget-content">
                                <h4 class="widget-title"><?php echo e(__('home.price_filter')); ?></h4>
                                <div class="price-inputs-wrapper">
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <label for="priceFrom" class="form-label"><?php echo e(__('home.from')); ?></label>
                                            <input type="number" class="form-control" id="priceFrom" placeholder="0"
                                                min="0" value="<?php echo e($priceFrom ?? ''); ?>">
                                        </div>
                                        <div class="col-6">
                                            <label for="priceTo" class="form-label"><?php echo e(__('home.to')); ?></label>
                                            <input type="number" class="form-control" id="priceTo" placeholder="1000"
                                                min="0" value="<?php echo e($priceTo ?? ''); ?>">
                                        </div>
                                    </div>
                                    <button type="button" class="btn-submit-price mt-3"
                                        id="priceSubmitBtn"><?php echo e(__('home.submit')); ?></button>
                                </div>
                            </div>
                        </div>
                        <!--=== Sidebar Widget ===-->
                        <div class="product-widget product-categories-widget mb-3" data-aos="fade-up"
                            data-aos-delay="30" data-aos-duration="600">
                            <div class="widget-content">
                                <h4 class="widget-title"><?php echo e(__('home.brands')); ?></h4>
                                <div class="custom-select-dropdown">
                                    <button type="button" class="select-dropdown-btn" id="brandsDropdownBtn">
                                        <span class="selected-text"><?php echo e(__('home.select_brands')); ?></span>
                                        <i class="fas fa-chevron-down dropdown-icon"></i>
                                    </button>
                                    <div class="dropdown-menu-custom" id="brandsDropdownMenu">
                                        <ul class="categories-list">
                                            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $br): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input brand-checkbox" type="checkbox"
                                                        name="brand_ids[]" value="<?php echo e($br->id); ?>" id="br_<?php echo e($br->id); ?>"
                                                        form="filtersForm" <?php if(in_array($br->id,
                                                    $selectedBrandIds)): echo 'checked'; endif; ?> >
                                                    <label class="form-check-label" for="br_<?php echo e($br->id); ?>">
                                                        <?php echo e(app()->getLocale()==='ar' ? $br->name_ar : $br->name_en); ?>

                                                        <span><?php echo e($br->products_count ?? ''); ?></span>
                                                    </label>
                                                </div>
                                            </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!--=== Sidebar Widget ===-->

                    </div>
                </div>
                <div class="col-xl-9">
                    <!--=== Shop Page Wrapper ===-->
                    <div class="shop-page-wrapper">
                        <!--=== Mobile Filter Button ===-->
                        <div class="mobile-filter-btn mb-3 d-xl-none">
                            <button class="btn-filter" id="filterToggleBtn">
                                <i class="fas fa-filter"></i>   <?php echo e(__('home.filter_search')); ?>

                            </button>
                        </div>
                        <!--=== Shop Filter ===-->
                        <div class="shop-filter mb-3" data-aos="fade-upؤ" data-aos-delay="20" data-aos-duration="1000">
                            <div class="row align-items-center">
                                <div class="col-sm-6 col-4">
                                    <div class="show-text">
                                        <p><?php echo e(__('home.all_products')); ?></p>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-8">
                                    <div class="filter-product-category d-flex align-items-center">

                                        <select class="wide" id="sortSelect">
                                            <option value=""><?php echo e(__('home.sort_by')); ?></option>
                                            <option value="new" <?php if(($sort ?? 'new' )==='new' ): echo 'selected'; endif; ?>><?php echo e(__('home.sort_newness')); ?>

                                            </option>
                                            <option value="price_desc" <?php if(($sort ?? '' )==='price_desc' ): echo 'selected'; endif; ?>><?php echo e(__('home.price_high_to_low')); ?></option>
                                            <option value="price_asc" <?php if(($sort ?? '' )==='price_asc' ): echo 'selected'; endif; ?>><?php echo e(__('home.price_low_to_high')); ?></option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="col-xl-4 col-lg-4 col-sm-6">
                                <!--=== Product Item  ===-->
                                <div class="product-item style-one mb-40 back-p">
                                    <div class="product-thumbnail">
                                        <?php $img = optional($product->images->first())->path ?? null; ?>

                                        <img src="<?php echo e($img ? asset($img) : asset('assets/images/placeholder.png')); ?>"
                                            alt="<?php echo e($product->name_en ?? 'Product'); ?>">

                                        <div class="discount">10% Off</div>
                                        <div class="hover-content">
                                            <?php
                                            $wishIds = session('wishlist', []);
                                            $isWished = auth()->check()
                                            ? auth()->user()->wishlistProducts()->where('products.id',
                                            $product->id)->exists()
                                            : in_array($product->id, $wishIds);
                                            ?>
                                            <a href="#"
                                                class="icon-btn js-wishlist-toggle <?php echo e($isWished ? 'is-active' : ''); ?>"
                                                data-url="<?php echo e(route('wishlist.toggle', $product->slug)); ?>"
                                                aria-label="wishlist"> <i
                                                    class="<?php echo e($isWished ? 'fa fa-heart' : 'far fa-heart'); ?>"></i>
                                            </a>
                                            <a href="assets/images/82a3bb099f970cf1d643724cb0788263.jpg"
                                                class="img-popup icon-btn"><i class="fa fa-eye"></i></a>
                                        </div>
                                        <div class="cart-button">
                                              <?php if(($product->size_type ?? 'standard') === 'standard'): ?>
    
    <a href="<?php echo e(route('product.show', $product->slug ?? $product->id)); ?>" class="cart-btn">
        <i class="far fa-shopping-basket"></i>
        <span class="text"><?php echo e(__('home.Add_To_Cart')); ?></span>
    </a>
<?php else: ?>
   
    <a href="javascript:void(0)" class="cart-btn js-add-to-cart"
       data-url="<?php echo e(route('cart.add', $product->slug)); ?>"
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
                                            <h4 class="title">
                                                <a href="<?php echo e(route('product.show', $product->slug ?? $product->id)); ?>">
                                                    <?php echo e(app()->getLocale()==='ar' ? $product->name_ar : $product->name_en); ?>

                                                </a>
                                            </h4>

                                        </div>
                                        <?php
                                        $basePrice = (float)($product->price ?? 0);
                                        $baseSale = (float)($product->sale_price ?? 0);

                                        $finalBase = ($baseSale > 0) ? $baseSale : $basePrice;

                                        $symbol = is_object($currency) ? ($currency->symbol ?? $currency->code ?? '') :
                                        ($currency['symbol'] ?? $currency['code'] ?? '');
                                        $priceDisplay = $finalBase * (float)$rate;

                                        $hasSale = $baseSale > 0 && $baseSale < $basePrice; $oldDisplay=$basePrice *
                                            (float)$rate; ?> <div class="product-price">
                                            <?php if($hasSale): ?>
                                            <span class="price prev-price"><span class="currency"> <?php if($currentCurrency->code =='SAR'): ?>  <img src="<?php echo e(asset('frontend/saudi-riyal.svg')); ?>" width="25px"/> <?php else: ?><?php echo e($symbol); ?><?php endif; ?></span><?php echo e(number_format($oldDisplay, 2)); ?></span>
                                            <span class="price new-price"><span class="currency"><?php if($currentCurrency->code =='SAR'): ?>  <img src="<?php echo e(asset('frontend/saudi-riyal.svg')); ?>" width="25px"/> <?php else: ?><?php echo e($symbol); ?><?php endif; ?></span><?php echo e(number_format($priceDisplay, 2)); ?></span>
                                            <?php else: ?>
                                            <span class="price new-price"><span class="currency"><?php if($currentCurrency->code =='SAR'): ?>  <img src="<?php echo e(asset('frontend/saudi-riyal.svg')); ?>" width="25px"/> <?php else: ?><?php echo e($symbol); ?><?php endif; ?></span><?php echo e(number_format($priceDisplay, 2)); ?></span>
                                            <?php endif; ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-12">
                            <div class="alert alert-warning">
                                لا توجد منتجات في هذا التصنيف
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php echo e($products->onEachSide(1)->links('front.layouts.pagination')); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section><!--====== End Shop page Section ======-->




</main>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>

<!-- Filter Overlay -->
<div class="filter-overlay" id="filterOverlay"></div>

<!-- Filter Toggle Script -->
<script>
    $(document).ready(function () {

        const $form = $('#filtersForm');

        // Toggle filter sidebar
        $('#filterToggleBtn').on('click', function () {
            $('#filterSidebar').addClass('active');
            $('#filterOverlay').addClass('active');
            $('body').css('overflow', 'hidden');
        });

        // Close filter sidebar
        $('#filterCloseBtn, #filterOverlay').on('click', function () {
            $('#filterSidebar').removeClass('active');
            $('#filterOverlay').removeClass('active');
            $('body').css('overflow', 'auto');
        });

        // Categories dropdown toggle
        $('#categoriesDropdownBtn').on('click', function (e) {
            e.stopPropagation();
            $(this).toggleClass('active');
            $('#categoriesDropdownMenu').toggleClass('active');
        });

        // Brands dropdown toggle
        $('#brandsDropdownBtn').on('click', function (e) {
            e.stopPropagation();
            $(this).toggleClass('active');
            $('#brandsDropdownMenu').toggleClass('active');
        });

        // Close dropdown when clicking outside
        $(document).on('click', function (e) {
            if (!$(e.target).closest('.custom-select-dropdown').length) {
                $('#categoriesDropdownBtn').removeClass('active');
                $('#categoriesDropdownMenu').removeClass('active');
                $('#brandsDropdownBtn').removeClass('active');
                $('#brandsDropdownMenu').removeClass('active');
            }
        });

        // Prevent dropdown from closing when clicking inside
        $('#categoriesDropdownMenu, #brandsDropdownMenu').on('click', function (e) {
            e.stopPropagation();
        });

        // ✅ Update selected text + SUBMIT when category checkboxes change
        $(document).on('change', '.category-checkbox', function () {
            var selectedCategories = [];

            $('.category-checkbox:checked').each(function () {
                // خد اسم الكاتيجوري بدون رقم count
                var labelText = $(this).closest('.form-check').find('label').clone().children().remove().end().text().trim();
                selectedCategories.push(labelText);
            });

            if (selectedCategories.length > 0) {
                if (selectedCategories.length === 1) {
                    $('#categoriesDropdownBtn .selected-text').text(selectedCategories[0]);
                } else {
                    $('#categoriesDropdownBtn .selected-text').text(selectedCategories.length + ' Categories Selected');
                }
            } else {
                $('#categoriesDropdownBtn .selected-text').text('Select Categories');
            }

            // ✅ submit filters
            $form.trigger('submit');
        });

        // ✅ Update selected text + SUBMIT when brand checkboxes change
        $(document).on('change', '.brand-checkbox', function () {
            var selectedBrands = [];

            $('.brand-checkbox:checked').each(function () {
                var labelText = $(this).closest('.form-check').find('label').clone().children().remove().end().text().trim();
                selectedBrands.push(labelText);
            });

            if (selectedBrands.length > 0) {
                if (selectedBrands.length === 1) {
                    $('#brandsDropdownBtn .selected-text').text(selectedBrands[0]);
                } else {
                    $('#brandsDropdownBtn .selected-text').text(selectedBrands.length + ' Brands Selected');
                }
            } else {
                $('#brandsDropdownBtn .selected-text').text('Select Brands');
            }

            // ✅ submit filters
            $form.trigger('submit');
        });

        // ✅ Sort submit (بدون تغيير التصميم)
        $('#sortSelect').on('change', function () {
            $('#sortHidden').val($(this).val() || 'new');
            $form.trigger('submit');
        });

        // ✅ Price filter submit (بدل alerts)
        $('.btn-submit-price').on('click', function () {
            var priceFrom = $('#priceFrom').val();
            var priceTo = $('#priceTo').val();

            if (priceFrom === '' && priceTo === '') {
                // لو مش عايز alert شيله
                alert('Please enter at least one price value');
                return;
            }

            if (priceFrom !== '' && priceTo !== '' && parseFloat(priceFrom) > parseFloat(priceTo)) {
                alert('From price cannot be greater than To price');
                return;
            }

            $('#fromHidden').val(priceFrom);
            $('#toHidden').val(priceTo);

            // ✅ submit filters
            $form.trigger('submit');
        });

    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('front.layouts.main_layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/front/products.blade.php ENDPATH**/ ?>