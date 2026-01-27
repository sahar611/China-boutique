<?php
  $isEdit = isset($model) && $model->exists;
?>


<?php if($errors->any()): ?>
  <div class="alert alert-danger">
    <ul class="mb-0">
      <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><?php echo e($error); ?></li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
  </div>
<?php endif; ?>

<div class="row">

  
  <div class="col-md-4">
    <div class="form-group">
      <label><?php echo e(__('cms.status')); ?></label>
      <select name="is_active" class="form-control">
        <option value="1" <?php if(old('is_active', $model->is_active ?? 1) == 1): echo 'selected'; endif; ?>><?php echo e(__('cms.active')); ?></option>
        <option value="0" <?php if(old('is_active', $model->is_active ?? 1) == 0): echo 'selected'; endif; ?>><?php echo e(__('cms.inactive')); ?></option>
      </select>
    </div>
  </div>

  
  <div class="col-md-4">
    <div class="form-group">
      <label><?php echo e(__('cms.sort_order')); ?></label>
      <input type="number" name="sort_order" class="form-control"
             value="<?php echo e(old('sort_order', $model->sort_order ?? 1)); ?>" min="1" required>
    </div>
  </div>

  
  <div class="col-md-4">
    <div class="form-group">
      <label><?php echo e(__('cms.discount_percent')); ?></label>
      <input type="number" name="discount_percent" class="form-control"
             value="<?php echo e(old('discount_percent', $model->discount_percent)); ?>" min="0" max="100"
             placeholder="50">
    </div>
  </div>

 
  

</div>

<div class="row mt-3">
  <div class="col-md-6">
    <div class="form-group">
      <label><?php echo e(__('cms.title_en')); ?></label>
      <input type="text" name="title_en" class="form-control"
             value="<?php echo e(old('title_en', $model->title_en)); ?>"
             placeholder="Exclusive Kids & Adults">
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label><?php echo e(__('cms.title_ar')); ?></label>
      <input type="text" name="title_ar" class="form-control"
             value="<?php echo e(old('title_ar', $model->title_ar)); ?>"
             placeholder="ملابس صيفية للأطفال والكبار">
    </div>
  </div>
</div>

<div class="row mt-3">
  <div class="col-md-6">
    <div class="form-group">
      <label><?php echo e(__('cms.subtitle_en')); ?></label>
      <input type="text" name="subtitle_en" class="form-control"
             value="<?php echo e(old('subtitle_en', $model->subtitle_en)); ?>"
             placeholder="Summer Outfits">
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label><?php echo e(__('cms.subtitle_ar')); ?></label>
      <input type="text" name="subtitle_ar" class="form-control"
             value="<?php echo e(old('subtitle_ar', $model->subtitle_ar)); ?>"
             placeholder="أزياء صيفية">
    </div>
  </div>
</div>



<div class="row mt-3">
    <div class="col-md-6">
    <div class="form-group">
      <label><?php echo e(__('cms.link')); ?></label>
      <input type="text" name="link" class="form-control"
             value="<?php echo e(old('link', $model->link)); ?>" placeholder="https://... أو /products">
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label><?php echo e(__('cms.image')); ?></label>
      <input type="file" name="image" class="form-control">
      <small class="text-muted"><?php echo e(__('cms.image_hint')); ?></small>

      <?php if($isEdit && $model->image): ?>
        <div class="mt-3">
          <img src="<?php echo e(asset($model->image)); ?>" alt="banner"
               style="width:220px;height:130px;object-fit:cover;border-radius:14px;">
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\china\resources\views/home_banners/_form.blade.php ENDPATH**/ ?>