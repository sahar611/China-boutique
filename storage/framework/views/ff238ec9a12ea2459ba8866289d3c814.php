

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">

  <div class="card">

    <div class="card-header pb-0 d-flex justify-content-between">
      <h5><?php echo e(__('messages.edit_category')); ?></h5>

      <a href="<?php echo e(route('admin.categories.index')); ?>" class="btn bg-gradient-primary btn-sm">
        <?php echo e(__('messages.categories')); ?>

      </a>
    </div>

    <div class="card-body">

      <form action="<?php echo e(route('admin.categories.update', $category->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="row">
          <div class="col-md-6">
            <label><?php echo e(__('messages.name_en')); ?></label>
            <input type="text" name="name_en" class="form-control"
                   value="<?php echo e(old('name_en', $category->name_en)); ?>">
            <?php $__errorArgs = ['name_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <div class="col-md-6">
            <label><?php echo e(__('messages.name_ar')); ?></label>
            <input type="text" name="name_ar" class="form-control"
                   value="<?php echo e(old('name_ar', $category->name_ar)); ?>">
            <?php $__errorArgs = ['name_ar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-6">
            <label><?php echo e(__('messages.parent')); ?></label>
            <select name="parent_id" class="form-control">
              <option value=""><?php echo e(__('messages.no_parent')); ?></option>
              <?php $__currentLoopData = $parents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($p->id); ?>" <?php if(old('parent_id', $category->parent_id) == $p->id): echo 'selected'; endif; ?>>
                  <?php echo e(app()->isLocale('ar') ? $p->name_ar : $p->name_en); ?>

                </option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['parent_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <div class="col-md-6">
            <label><?php echo e(__('messages.image')); ?></label>
            <input type="file" name="image" class="form-control">
            <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <?php if($category->image): ?>
              <div class="mt-2">
                <img src="<?php echo e(asset($category->image)); ?>" width="90" alt="category">
              </div>
            <?php endif; ?>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-6">
            <label><?php echo e(__('messages.sort_order')); ?></label>
            <input type="number" name="sort_order" class="form-control"
                   value="<?php echo e(old('sort_order', $category->sort_order ?? 0)); ?>">
            <?php $__errorArgs = ['sort_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <div class="col-md-6">
            <label><?php echo e(__('messages.status')); ?></label>
            <select name="is_active" class="form-control">
              <option value="1" <?php if(old('is_active', $category->is_active) == 1): echo 'selected'; endif; ?>>
                <?php echo e(__('messages.status_active')); ?>

              </option>
              <option value="0" <?php if(old('is_active', $category->is_active) == 0): echo 'selected'; endif; ?>>
                <?php echo e(__('messages.status_inactive')); ?>

              </option>
            </select>
            <?php $__errorArgs = ['is_active'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>
        </div>

        <p class="text-muted mt-3 mb-0">
          <?php echo e(__('messages.slug_auto_note')); ?>

        </p>

<div class="row mt-4">
 
  <div class="row mt-4">
  <div class="col-md-4">
    <label><?php echo e(__('messages.show_in_home')); ?></label>
    <select name="is_featured" class="form-control">
      <option value="0" <?php if(old('is_featured', $category->is_featured ?? 0) == 0): echo 'selected'; endif; ?>><?php echo e(__('messages.no')); ?></option>
      <option value="1" <?php if(old('is_featured', $category->is_featured ?? 0) == 1): echo 'selected'; endif; ?>><?php echo e(__('messages.yes')); ?></option>
    </select>
    <small class="text-muted d-block mt-1">
      <?php echo e(__('messages.featured_note')); ?>

    </small>
  </div>

  <div class="col-md-4">
    <label><?php echo e(__('messages.home_sort')); ?></label>
    <input type="number" name="home_sort" class="form-control"
           value="<?php echo e(old('home_sort', $category->home_sort ?? 0)); ?>">
    <small class="text-muted d-block mt-1">
      <?php echo e(__('messages.home_sort_note')); ?>

    </small>
  </div>
<div class="col-md-4">
  <?php
    $posOptions = [
      'none' => __('messages.position_none'),
      'home_sidebar' => __('messages.position_home_sidebar'),
      'header_dropdown' => __('messages.position_header_dropdown'),
      'home_top_categories' => __('messages.position_home_top_categories'),
      'home_tabs' => __('messages.position_home_tabs'),
    ];

    $selectedPositions = old('positions', $category->positions ?? ['none']);
    if (!is_array($selectedPositions)) $selectedPositions = ['none'];
  ?>

  <label class="form-label"><?php echo e(__('messages.display_positions')); ?></label>

  <div class="border rounded-3 p-3" style="background:#fff">
    <div class="row">
      <?php $__currentLoopData = $posOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-12 mb-2">
          <div class="form-check">
            <input
              class="form-check-input position-check"
              type="checkbox"
              name="positions[]"
              value="<?php echo e($key); ?>"
              id="pos_<?php echo e($key); ?>"
              <?php if(in_array($key, $selectedPositions)): echo 'checked'; endif; ?>
            >
            <label class="form-check-label" for="pos_<?php echo e($key); ?>">
              <?php echo e($label); ?>

            </label>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <small class="text-muted d-block mt-2"><?php echo e(__('messages.home_position_note')); ?></small>
  </div>

  <?php $__errorArgs = ['positions'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
  <?php $__errorArgs = ['positions.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>



  <div class="col-md-4">
    <label><?php echo e(__('messages.home_sort')); ?></label>
    <input type="number" name="home_sort" class="form-control"
           value="<?php echo e(old('home_sort', $category->home_sort ?? 0)); ?>">
    <?php $__errorArgs = ['home_sort'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
  </div>
</div>

        <div class="text-end mt-4">
          <button class="btn bg-gradient-dark"><?php echo e(__('messages.save')); ?></button>
        </div>

      </form>

    
      <div class="mt-3">
        <small class="text-muted">
          <?php echo e(__('messages.slug')); ?>: <strong><?php echo e($category->slug); ?></strong>
        </small>
      </div>
<div class="alert alert-info mt-3">
  <strong><?php echo e(__('messages.note')); ?>:</strong>
  <ul class="mb-0">
    <li><?php echo e(__('messages.sort_order_explain')); ?></li>
    <li><?php echo e(__('messages.home_sort_explain')); ?></li>
  </ul>
</div>
    </div>

  </div>

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {

  const isFeatured = document.getElementById('is_featured');
  const homeSort = document.getElementById('home_sort');

  const none = document.getElementById('pos_none');
  const checks = document.querySelectorAll('.position-check');

  function syncNone(){
    if(!none) return;
    if(none.checked){
      checks.forEach(c => { if(c !== none) c.checked = false; });
    }
  }

  checks.forEach(c => {
    c.addEventListener('change', function(){
      if(this === none) syncNone();
      else if(none && none.checked) none.checked = false;
    });
  });

  function toggleHomeSort(){
    if(!isFeatured || !homeSort) return;
    const enabled = (String(isFeatured.value) === '1');
    homeSort.disabled = !enabled;
    if(!enabled){
      homeSort.value = 0;
    }
  }

  if(isFeatured){
    isFeatured.addEventListener('change', toggleHomeSort);
  }

  syncNone();
  toggleHomeSort();
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/categories/edit.blade.php ENDPATH**/ ?>