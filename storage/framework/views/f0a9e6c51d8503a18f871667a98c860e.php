<div class="row">
  <input type="hidden" name="items[<?php echo e($i); ?>][id]" value="<?php echo e($model->id); ?>">

  <div class="col-md-2">
    <div class="form-group">
      <label><?php echo e(__('cms.step_no')); ?></label>
      <input type="number" name="items[<?php echo e($i); ?>][step_no]" class="form-control"
             value="<?php echo e(old("items.$i.step_no", $model->step_no)); ?>" min="1" max="4" required>
    </div>
  </div>

  <div class="col-md-2">
    <div class="form-group">
      <label><?php echo e(__('cms.sort_order')); ?></label>
      <input type="number" name="items[<?php echo e($i); ?>][sort_order]" class="form-control"
             value="<?php echo e(old("items.$i.sort_order", $model->sort_order)); ?>" min="1" max="99" required>
    </div>
  </div>

  <div class="col-md-2">
    <div class="form-group">
      <label><?php echo e(__('cms.status')); ?></label>
      <select name="items[<?php echo e($i); ?>][is_active]" class="form-control">
        <option value="1" <?php if(old("items.$i.is_active", $model->is_active) == 1): echo 'selected'; endif; ?>><?php echo e(__('cms.active')); ?></option>
        <option value="0" <?php if(old("items.$i.is_active", $model->is_active) == 0): echo 'selected'; endif; ?>><?php echo e(__('cms.inactive')); ?></option>
      </select>
    </div>
  </div>

  <div class="col-md-3">
    <div class="form-group">
      <label><?php echo e(__('cms.icon_type')); ?></label>
      <select name="items[<?php echo e($i); ?>][icon_type]" class="form-control">
        <option value="class" <?php if(old("items.$i.icon_type", $model->icon_type) == 'class'): echo 'selected'; endif; ?>><?php echo e(__('cms.icon_class')); ?></option>
        <option value="image" <?php if(old("items.$i.icon_type", $model->icon_type) == 'image'): echo 'selected'; endif; ?>><?php echo e(__('cms.icon_image')); ?></option>
      </select>
      <small class="text-muted"><?php echo e(__('cms.icon_hint')); ?></small>
    </div>
  </div>

  <div class="col-md-3">
    <div class="form-group">
      <label><?php echo e(__('cms.icon')); ?></label>

      
      <input type="text" class="form-control mb-2"
             name="items[<?php echo e($i); ?>][icon_class]"
             value="<?php echo e(old("items.$i.icon_class", $model->icon_class)); ?>"
             placeholder="flaticon-search / fa fa-star">

      
      <input type="file" name="items[<?php echo e($i); ?>][icon_image]" class="form-control">

      <?php if($model->icon_type === 'image' && $model->icon_image): ?>
        <div class="mt-2">
          <img src="<?php echo e(asset($model->icon_image)); ?>" style="width:52px;height:52px;object-fit:contain;">
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<div class="row mt-3">
  <div class="col-md-6">
    <label><?php echo e(__('cms.title_en')); ?></label>
    <input type="text" name="items[<?php echo e($i); ?>][title_en]" class="form-control"
           value="<?php echo e(old("items.$i.title_en", $model->title_en)); ?>" required>
  </div>

  <div class="col-md-6">
    <label><?php echo e(__('cms.title_ar')); ?></label>
    <input type="text" name="items[<?php echo e($i); ?>][title_ar]" class="form-control"
           value="<?php echo e(old("items.$i.title_ar", $model->title_ar)); ?>" required>
  </div>
</div>

<div class="row mt-3">
  <div class="col-md-6">
    <label><?php echo e(__('cms.desc_en')); ?></label>
    <textarea name="items[<?php echo e($i); ?>][desc_en]" rows="3" class="form-control"><?php echo e(old("items.$i.desc_en", $model->desc_en)); ?></textarea>
  </div>

  <div class="col-md-6">
    <label><?php echo e(__('cms.desc_ar')); ?></label>
    <textarea name="items[<?php echo e($i); ?>][desc_ar]" rows="3" class="form-control"><?php echo e(old("items.$i.desc_ar", $model->desc_ar)); ?></textarea>
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\china\resources\views/work_steps/_form.blade.php ENDPATH**/ ?>