

<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-12">
    <div class="card mb-4 mx-4">

      <div class="card-header pb-0 d-flex justify-content-between">
        <h5 class="mb-0"><?php echo e(__('messages.products')); ?></h5>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('products.create')): ?>
        <a href="<?php echo e(route('admin.products.create')); ?>" class="btn bg-gradient-primary btn-sm">
          <?php echo e(__('messages.add_product')); ?>

        </a>
        <?php endif; ?>
      </div>

      <div class="card-body">

       
<div class="p-3">
  
  <form method="GET" class="row g-3 align-items-end">

    <div class="col-12 col-md-4 col-lg-3">
      <label class="form-label mb-1"><?php echo e(__('messages.search')); ?></label>
      <input type="text" name="q" class="form-control" value="<?php echo e(request('q')); ?>"
             placeholder="<?php echo e(__('messages.search_placeholder')); ?>">
    </div>

    <div class="col-12 col-md-4 col-lg-3">
      <label class="form-label mb-1"><?php echo e(__('messages.category')); ?></label>
      <select name="category_id" class="form-control">
        <option value=""><?php echo e(__('messages.all')); ?></option>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($cat->id); ?>" <?php if(request('category_id') == $cat->id): echo 'selected'; endif; ?>>
            <?php echo e(app()->isLocale('ar') ? $cat->name_ar : $cat->name_en); ?>

          </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
    </div>

    <div class="col-12 col-md-4 col-lg-3">
      <label class="form-label mb-1"><?php echo e(__('messages.brand')); ?></label>
      <select name="brand_id" class="form-control">
        <option value=""><?php echo e(__('messages.all')); ?></option>
        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($b->id); ?>" <?php if(request('brand_id') == $b->id): echo 'selected'; endif; ?>>
            <?php echo e(app()->isLocale('ar') ? $b->name_ar : $b->name_en); ?>

          </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
    </div>

    <div class="col-12 col-md-4 col-lg-2">
      <label class="form-label mb-1"><?php echo e(__('messages.status')); ?></label>
      <select name="status" class="form-control">
        <option value=""><?php echo e(__('messages.all')); ?></option>
        <option value="1" <?php if(request('status') === '1'): echo 'selected'; endif; ?>><?php echo e(__('messages.status_active')); ?></option>
        <option value="0" <?php if(request('status') === '0'): echo 'selected'; endif; ?>><?php echo e(__('messages.status_inactive')); ?></option>
      </select>
    </div>

    <div class="col-12 col-md-4 col-lg-2">
      <label class="form-label mb-1"><?php echo e(__('messages.stock_filter')); ?></label>
      <select name="stock_filter" class="form-control">
        <option value=""><?php echo e(__('messages.all')); ?></option>
        <option value="out" <?php if(request('stock_filter') === 'out'): echo 'selected'; endif; ?>><?php echo e(__('messages.out_of_stock')); ?></option>
        <option value="low" <?php if(request('stock_filter') === 'low'): echo 'selected'; endif; ?>><?php echo e(__('messages.low_stock')); ?></option>
      </select>
    </div>

    <div class="col-12 col-md-4 col-lg-2 d-flex gap-2">
      <button class="btn bg-gradient-dark w-100"><?php echo e(__('messages.filter')); ?></button>
      <a class="btn btn-outline-secondary w-100" href="<?php echo e(route('admin.products.index')); ?>">
        <?php echo e(__('messages.reset')); ?>

      </a>
    </div>

  </form>

  
  <hr class="my-4">

  
 <?php
  $canBulk = auth()->user()?->can('products.publish')
         || auth()->user()?->can('products.unpublish')
         || auth()->user()?->can('products.delete');
?>

<?php if($canBulk): ?>
<div class="px-3 mt-2">
  <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between border rounded p-3 bg-light">

    <div class="d-flex flex-wrap gap-2 align-items-center">
      <span class="text-muted">
        <?php echo e(__('messages.selected')); ?>:
        <strong id="selectedCount">0</strong>
      </span>

      <button type="button" class="btn btn-outline-secondary btn-sm" id="toggleSelectAll">
        <?php echo e(__('messages.select_all')); ?>

      </button>
    </div>

    <form method="POST" action="<?php echo e(route('admin.products.bulk')); ?>" id="bulkForm" class="d-flex gap-2 align-items-center">
      <?php echo csrf_field(); ?>

      <select name="action" class="form-control form-control-sm" style="min-width: 210px;">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('products.publish')): ?>
          <option value="publish"><?php echo e(__('messages.publish_selected')); ?></option>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('products.unpublish')): ?>
          <option value="unpublish"><?php echo e(__('messages.unpublish_selected')); ?></option>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('products.delete')): ?>
          <option value="delete"><?php echo e(__('messages.delete_selected')); ?></option>
        <?php endif; ?>
      </select>

      <button type="submit" class="btn bg-gradient-dark btn-sm" id="bulkApplyBtn" disabled>
        <?php echo e(__('messages.apply')); ?>

      </button>
    </form>

  </div>

  <small class="text-muted d-block mt-2">
    <?php echo e(__('messages.bulk_hint')); ?>

  </small>
</div>
<?php endif; ?>

</div>

<?php if(session('success')): ?>
                        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                    <?php endif; ?>
        <div class="table-responsive p-3 mt-3">
        <table class="table align-items-center mb-0 table-hover">

            <thead>
              <tr>
                <th style="width:40px;">
                  <input type="checkbox" id="selectAll">
                </th>
                <th>#</th>
                <th><?php echo e(__('messages.name')); ?></th>
                <th><?php echo e(__('messages.category')); ?></th>
                <th><?php echo e(__('messages.brand')); ?></th>
                <th><?php echo e(__('messages.price')); ?></th>
                <!-- <th><?php echo e(__('messages.stock')); ?></th> -->
                <th><?php echo e(__('messages.status')); ?></th>
                   <th><?php echo e(__('messages.reviews')); ?></th>
                <th class="text-center"><?php echo e(__('messages.actions')); ?></th>
              </tr>
            </thead>

            <tbody>
              <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                  <td>
                    <input type="checkbox" value="<?php echo e($p->id); ?>" class="row-checkbox">
                  </td>

                  <td><?php echo e($loop->iteration); ?></td>

                  <td>
                    <?php echo e(app()->isLocale('ar') ? $p->name_ar : $p->name_en); ?>

                    <?php if($p->sku): ?>
                      <br><small class="text-muted">SKU: <?php echo e($p->sku); ?></small>
                    <?php endif; ?>
                  </td>

                  <td><?php echo e($p->category ? (app()->isLocale('ar') ? $p->category->name_ar : $p->category->name_en) : '-'); ?></td>
                  <td><?php echo e($p->brand ? (app()->isLocale('ar') ? $p->brand->name_ar : $p->brand->name_en) : '-'); ?></td>

                  <td>
                    <?php echo e(number_format($p->price, 2)); ?>

                    <?php if($p->sale_price): ?>
                      <br><small class="text-muted"><?php echo e(__('messages.sale_price')); ?>: <?php echo e(number_format($p->sale_price, 2)); ?></small>
                    <?php endif; ?>
                  </td>

                  <!-- <td>
                    <?php echo e($p->stock); ?>

                    <?php if($p->stock == 0): ?>
                      <span class="badge bg-danger ms-1"><?php echo e(__('messages.out_of_stock')); ?></span>
                    <?php elseif($p->stock > 0 && $p->stock <= 5): ?>
                      <span class="badge bg-warning ms-1"><?php echo e(__('messages.low_stock')); ?></span>
                    <?php endif; ?>
                  </td> -->

                 <td>
  <?php if($p->is_active): ?>
    <span class="badge bg-success"><?php echo e(__('messages.status_active')); ?></span>
  <?php else: ?>
    <span class="badge bg-secondary"><?php echo e(__('messages.status_inactive')); ?></span>
  <?php endif; ?>
</td>
              <td class="text-center">
  <a href="<?php echo e(route('admin.products.reviews', $p->id)); ?>" class="btn btn-sm btn-outline-primary">
    <i class="fa fa-comments"></i>
    <span class="badge bg-dark ms-1"><?php echo e($p->reviews_total_count); ?></span>
  </a>

  <?php if($p->reviews_pending_count > 0): ?>
    <span class="badge bg-warning text-dark ms-1">
      <?php echo e($p->reviews_pending_count); ?> pending
    </span>
  <?php endif; ?>

  <?php if($p->reviews_hidden_count > 0): ?>
    <span class="badge bg-secondary ms-1">
      <?php echo e($p->reviews_hidden_count); ?> hidden
    </span>
  <?php endif; ?>
</td>

                  <td class="text-center">

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('products.edit')): ?>
                      <a class="btn btn-primary btn-sm" href="<?php echo e(route('admin.products.edit', $p->id)); ?>">
                        <?php echo e(__('messages.edit')); ?>

                      </a>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('products.price_edit')): ?>
                      <a class="btn btn-info btn-sm" href="<?php echo e(route('admin.products.price.edit', $p->id)); ?>">
                        <?php echo e(__('messages.price')); ?>

                      </a>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('products.stock_edit')): ?>
                      <!-- <a class="btn btn-warning btn-sm" href="<?php echo e(route('admin.products.stock.edit', $p->id)); ?>">
                        <?php echo e(__('messages.stock')); ?>

                      </a> -->
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('products.publish')): ?>
                      <?php if(!$p->is_active): ?>
                        <form method="POST" action="<?php echo e(route('admin.products.publish', $p->id)); ?>" style="display:inline-block">
                          <?php echo csrf_field(); ?>
                          <?php echo method_field('PATCH'); ?>
                          <button class="btn btn-success btn-sm"><?php echo e(__('messages.publish')); ?></button>
                        </form>
                      <?php endif; ?>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('products.unpublish')): ?>
                      <?php if($p->is_active): ?>
                        <form method="POST" action="<?php echo e(route('admin.products.unpublish', $p->id)); ?>" style="display:inline-block">
                          <?php echo csrf_field(); ?>
                          <?php echo method_field('PATCH'); ?>
                          <button class="btn btn-secondary btn-sm"><?php echo e(__('messages.unpublish')); ?></button>
                        </form>
                      <?php endif; ?>
                    <?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('products.view')): ?>
  <a class="btn btn-outline-secondary btn-sm" href="<?php echo e(route('admin.products.show', $p->id)); ?>">
    <?php echo e(__('messages.view')); ?>

  </a>
<?php endif; ?>



                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('products.delete')): ?>
                      <form method="POST" action="<?php echo e(route('admin.products.destroy', $p->id)); ?>"
                            style="display:inline-block"
                            onsubmit="return confirm('<?php echo e(__('messages.confirm_delete')); ?>')">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button class="btn btn-danger btn-sm"><?php echo e(__('messages.delete')); ?></button>
                      </form>
                    <?php endif; ?>

                  </td>
    

                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                  <td colspan="9" class="text-center text-muted p-4">
                    <?php echo e(__('messages.no_data')); ?>

                  </td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>

          <div class="mt-3">
            <?php echo e($products->links()); ?>

          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {

  const selectAll = document.getElementById('selectAll');
  const toggleSelectAllBtn = document.getElementById('toggleSelectAll');

  const bulkForm = document.getElementById('bulkForm');
  const applyBtn = document.getElementById('bulkApplyBtn');
  const selectedCountEl = document.getElementById('selectedCount');

  function getRowCheckboxes(){
    return Array.from(document.querySelectorAll('.row-checkbox'));
  }

  function getChecked(){
    return getRowCheckboxes().filter(cb => cb.checked);
  }

  function updateUI(){
    const count = getChecked().length;
    if(selectedCountEl) selectedCountEl.textContent = count;

    if(applyBtn) applyBtn.disabled = (count === 0);

    // تحديث selectAll الحالة
    if(selectAll){
      const all = getRowCheckboxes().length;
      selectAll.checked = (count > 0 && count === all);
      selectAll.indeterminate = (count > 0 && count < all);
    }

    // زر toggle (تحديد الكل / إلغاء التحديد)
    if(toggleSelectAllBtn){
      toggleSelectAllBtn.textContent = (getChecked().length === getRowCheckboxes().length && getRowCheckboxes().length > 0)
        ? "<?php echo e(__('messages.unselect_all')); ?>"
        : "<?php echo e(__('messages.select_all')); ?>";
    }
  }

  // change individual checkboxes
  document.addEventListener('change', function(e){
    if(e.target.classList && e.target.classList.contains('row-checkbox')){
      updateUI();
    }
  });

  // select all checkbox
  if(selectAll){
    selectAll.addEventListener('change', function(){
      getRowCheckboxes().forEach(cb => cb.checked = selectAll.checked);
      updateUI();
    });
  }

  // toggle select all button
  if(toggleSelectAllBtn){
    toggleSelectAllBtn.addEventListener('click', function(){
      const rows = getRowCheckboxes();
      const allSelected = rows.length > 0 && getChecked().length === rows.length;
      rows.forEach(cb => cb.checked = !allSelected);
      updateUI();
    });
  }

  // bulk submit: append ids[]
  if(bulkForm){
    bulkForm.addEventListener('submit', function(e){

      // remove old hidden inputs
      bulkForm.querySelectorAll('input[name="ids[]"]').forEach(el => el.remove());

      const ids = getChecked().map(cb => cb.value);

      if(ids.length === 0){
        e.preventDefault();
        alert("<?php echo e(__('messages.select_at_least_one')); ?>");
        return;
      }

      if(!confirm("<?php echo e(__('messages.confirm_bulk')); ?>")){
        e.preventDefault();
        return;
      }

      ids.forEach(id => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'ids[]';
        input.value = id;
        bulkForm.appendChild(input);
      });
    });
  }

  // initial
  updateUI();
});
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/products/index.blade.php ENDPATH**/ ?>