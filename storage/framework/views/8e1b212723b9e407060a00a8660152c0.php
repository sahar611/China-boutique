

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
  <div class="card">

    <div class="card-header pb-0 d-flex justify-content-between">
      <h5><?php echo e(__('messages.add_product')); ?></h5>
      <a href="<?php echo e(route('admin.products.index')); ?>" class="btn bg-gradient-primary btn-sm">
        <?php echo e(__('messages.products')); ?>

      </a>
    </div>

    <div class="card-body">
      <form action="<?php echo e(route('admin.products.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <div class="row">
          <div class="col-md-6">
            <label><?php echo e(__('messages.name_en')); ?></label>
            <input type="text" name="name_en" class="form-control" value="<?php echo e(old('name_en')); ?>">
          </div>
          <div class="col-md-6">
            <label><?php echo e(__('messages.name_ar')); ?></label>
            <input type="text" name="name_ar" class="form-control" value="<?php echo e(old('name_ar')); ?>">
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-6">
            <label><?php echo e(__('messages.description_en')); ?></label>
            <textarea name="description_en" class="form-control"><?php echo e(old('description_en')); ?></textarea>
          </div>
          <div class="col-md-6">
            <label><?php echo e(__('messages.description_ar')); ?></label>
            <textarea name="description_ar" class="form-control"><?php echo e(old('description_ar')); ?></textarea>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-6">
            <label><?php echo e(__('messages.category')); ?></label>
            <select name="category_id" class="form-control">
              <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($cat->id); ?>"><?php echo e(app()->isLocale('ar') ? $cat->name_ar : $cat->name_en); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>

          <div class="col-md-6">
            <label><?php echo e(__('messages.brand')); ?></label>
            <select name="brand_id" class="form-control">
              <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($b->id); ?>"><?php echo e(app()->isLocale('ar') ? $b->name_ar : $b->name_en); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-3">
            <label><?php echo e(__('messages.price')); ?></label>
            <input type="number" step="0.01" name="price" class="form-control" value="<?php echo e(old('price')); ?>">
          </div>

          <div class="col-md-3">
            <label><?php echo e(__('messages.sale_price')); ?></label>
            <input type="number" step="0.01" name="sale_price" class="form-control" value="<?php echo e(old('sale_price')); ?>">
          </div>

          <div class="col-md-3">
            <label><?php echo e(__('messages.stock')); ?></label>
            <input type="number" name="stock" class="form-control" value="<?php echo e(old('stock', 0)); ?>">
          </div>

          <div class="col-md-3">
            <label><?php echo e(__('messages.track_stock')); ?></label>
            <select name="track_stock" class="form-control">
              <option value="1"><?php echo e(__('messages.yes')); ?></option>
              <option value="0"><?php echo e(__('messages.no')); ?></option>
            </select>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-4">
            <label><?php echo e(__('messages.sku')); ?></label>
            <input type="text" name="sku" class="form-control" value="<?php echo e(old('sku')); ?>">
          </div>

          <div class="col-md-4">
            <label><?php echo e(__('messages.status')); ?></label>
            <select name="is_active" class="form-control">
              <option value="1"><?php echo e(__('messages.status_active')); ?></option>
              <option value="0"><?php echo e(__('messages.status_inactive')); ?></option>
            </select>
          </div>
<div class="row mt-4">
  <div class="col-md-4">
    <label><?php echo e(__('messages.show_in_home')); ?></label>
    <select name="is_featured" class="form-control">
      <option value="0" <?php if(old('is_featured','0')=='0'): echo 'selected'; endif; ?>><?php echo e(__('messages.no')); ?></option>
      <option value="1" <?php if(old('is_featured')=='1'): echo 'selected'; endif; ?>><?php echo e(__('messages.yes')); ?></option>
    </select>
  </div>

  <div class="col-md-4">
    <label><?php echo e(__('messages.home_sort')); ?></label>
    <input type="number" name="home_sort" class="form-control" value="<?php echo e(old('home_sort',0)); ?>">
  </div>

  <div class="col-md-4">
    <label><?php echo e(__('messages.display_positions')); ?></label>

    <?php
      $selectedPositions = old('positions', ['none']);
      if (!is_array($selectedPositions)) $selectedPositions = ['none'];
    ?>

    <div class="border rounded p-3" style="max-height:220px; overflow:auto;">
      <div class="form-check mb-2">
        <input class="form-check-input" type="checkbox" name="positions[]" value="none" id="p_none"
               <?php if(in_array('none',$selectedPositions)): echo 'checked'; endif; ?>>
        <label class="form-check-label" for="p_none"><?php echo e(__('messages.pos_none')); ?></label>
      </div>

      <!-- <div class="form-check mb-2">
        <input class="form-check-input pos-item" type="checkbox" name="positions[]" value="home_top" id="p_home_top"
               <?php if(in_array('home_top',$selectedPositions)): echo 'checked'; endif; ?>>
        <label class="form-check-label" for="p_home_top"><?php echo e(__('messages.pos_home_top_products')); ?></label>
      </div> -->

      <!-- <div class="form-check mb-2">
        <input class="form-check-input pos-item" type="checkbox" name="positions[]" value="features_collection" id="p_feat"
               <?php if(in_array('features_collection',$selectedPositions)): echo 'checked'; endif; ?>>
        <label class="form-check-label" for="p_feat"><?php echo e(__('messages.pos_features_collection')); ?></label>
      </div> -->

      <div class="form-check mb-2">
        <input class="form-check-input pos-item" type="checkbox" name="positions[]" value="trending" id="p_trending"
               <?php if(in_array('trending',$selectedPositions)): echo 'checked'; endif; ?>>
        <label class="form-check-label" for="p_trending"><?php echo e(__('messages.pos_trending')); ?></label>
      </div>

      <div class="form-check mb-2">
        <input class="form-check-input pos-item" type="checkbox" name="positions[]" value="home_products" id="p_home_products"
               <?php if(in_array('home_products',$selectedPositions)): echo 'checked'; endif; ?>>
        <label class="form-check-label" for="p_home_products"><?php echo e(__('messages.pos_home_products')); ?></label>
      </div>
<div class="form-check mb-2">
  <input class="form-check-input pos-item" type="checkbox" name="positions[]" value="best_sellers" id="p_best_sellers"
         <?php if(in_array('best_sellers',$selectedPositions)): echo 'checked'; endif; ?>>
  <label class="form-check-label" for="p_best_sellers"><?php echo e(__('messages.pos_best_sellers')); ?></label>
</div>

<div class="form-check mb-2">
  <input class="form-check-input pos-item" type="checkbox" name="positions[]" value="new_products" id="p_new_products"
         <?php if(in_array('new_products',$selectedPositions)): echo 'checked'; endif; ?>>
  <label class="form-check-label" for="p_new_products"><?php echo e(__('messages.pos_new_products')); ?></label>
</div>

<div class="form-check mb-2">
  <input class="form-check-input pos-item" type="checkbox" name="positions[]" value="sale_products" id="p_sale_products"
         <?php if(in_array('sale_products',$selectedPositions)): echo 'checked'; endif; ?>>
  <label class="form-check-label" for="p_sale_products"><?php echo e(__('messages.pos_sale_products')); ?></label>
</div>

    </div>

    <small class="text-muted d-block mt-2">
      <?php echo e(__('messages.positions_note')); ?>

    </small>
  </div>
</div>



          <div class="col-md-4">
            <label><?php echo e(__('messages.images')); ?></label>
            <input type="file" name="images[]" class="form-control" multiple>
          </div>
        </div>

        <p class="text-muted mt-3 mb-0"><?php echo e(__('messages.slug_auto_note')); ?></p>

        <div class="text-end mt-4">
          <button class="btn bg-gradient-dark"><?php echo e(__('messages.save')); ?></button>
        </div>

      </form>
    </div>

  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const none = document.getElementById('p_none');
    const items = document.querySelectorAll('.pos-item');

    function sync(){
      if(none.checked){
        items.forEach(i => i.checked = false);
      }
    }

    none?.addEventListener('change', sync);
    items.forEach(i => i.addEventListener('change', function(){
      if(this.checked) none.checked = false;
    }));

    sync();
  });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/products/create.blade.php ENDPATH**/ ?>