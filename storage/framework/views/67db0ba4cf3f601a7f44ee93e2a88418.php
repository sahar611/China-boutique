<?php if($errors->any()): ?>
  <div class="alert alert-danger">
    <ul class="mb-0">
      <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><?php echo e($e); ?></li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
  </div>
<?php endif; ?>

<div class="row">
  <div class="col-md-6">
    <label><?php echo e(__('cms.title_ar')); ?></label>
    <input name="title_ar" class="form-control" value="<?php echo e(old('title_ar', $model->title_ar ?? '')); ?>" required>
  </div>
  <div class="col-md-6">
    <label><?php echo e(__('cms.title_en')); ?></label>
    <input name="title_en" class="form-control" value="<?php echo e(old('title_en', $model->title_en ?? '')); ?>" required>
  </div>
</div>

<div class="row mt-3">
  <div class="col-md-12">
    <label><?php echo e(__('cms.slug')); ?></label>
    <input name="slug" class="form-control" value="<?php echo e(old('slug', $model->slug ?? '')); ?>" required>
  </div>
</div>

<div class="row mt-3">
  <div class="col-md-6">
    <label><?php echo e(__('cms.content_ar')); ?></label>
    <textarea name="content_ar" class="form-control" rows="6"><?php echo e(old('content_ar', $model->content_ar ?? '')); ?></textarea>
  </div>
  <div class="col-md-6">
    <label><?php echo e(__('cms.content_en')); ?></label>
    <textarea name="content_en" class="form-control" rows="6"><?php echo e(old('content_en', $model->content_en ?? '')); ?></textarea>
  </div>
</div>

<div class="row mt-3">
  <div class="col-md-4">
    <label><?php echo e(__('cms.cover')); ?></label>
    <input type="file" name="cover" class="form-control">
    <?php if(!empty($model?->cover)): ?>
      <div class="mt-2">
        <img src="<?php echo e(asset($model->cover)); ?>" width="120" class="img-thumbnail">
      </div>
    <?php endif; ?>
  </div>

  <div class="col-md-4">
    <label><?php echo e(__('cms.status')); ?></label>
    <select name="is_published" class="form-control">
      <option value="0" <?php if(old('is_published', $model->is_published ?? 0) == 0): echo 'selected'; endif; ?>><?php echo e(__('cms.draft')); ?></option>
      <option value="1" <?php if(old('is_published', $model->is_published ?? 0) == 1): echo 'selected'; endif; ?>><?php echo e(__('cms.published')); ?></option>
    </select>
  </div>

  <div class="col-md-4">
    <label><?php echo e(__('cms.sort_order')); ?></label>
    <input type="number" name="sort_order" class="form-control" value="<?php echo e(old('sort_order', $model->sort_order ?? 0)); ?>">
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\china\resources\views/news/_form.blade.php ENDPATH**/ ?>