<div class="row">
  <div class="col-md-3">
    <div class="form-group">
      <label>Code (3 letters)</label>
      <input type="text" name="code" class="form-control" value="<?php echo e(old('code', $currency->code ?? '')); ?>" required>
    </div>
  </div>

  <div class="col-md-5">
    <div class="form-group">
      <label>Name</label>
      <input type="text" name="name" class="form-control" value="<?php echo e(old('name', $currency->name ?? '')); ?>" required>
    </div>
  </div>

  <div class="col-md-2">
    <div class="form-group">
      <label>Symbol</label>
      <input type="text" name="symbol" class="form-control" value="<?php echo e(old('symbol', $currency->symbol ?? '')); ?>">
    </div>
  </div>

  <div class="col-md-2">
    <div class="form-group">
      <label>Decimals</label>
      <input type="number" name="decimal_places" class="form-control" min="0" max="6"
             value="<?php echo e(old('decimal_places', $currency->decimal_places ?? 2)); ?>" required>
    </div>
  </div>
</div>

<div class="row mt-2">
  <div class="col-md-4">
    <div class="form-group">
      <label>Sort Order</label>
      <input type="number" name="sort_order" class="form-control" min="0" max="9999"
             value="<?php echo e(old('sort_order', $currency->sort_order ?? 0)); ?>">
    </div>
  </div>

  <div class="col-md-4">
    <div class="form-group">
      <label>Status</label>
      <select name="is_active" class="form-control">
        <option value="1" <?php echo e(old('is_active', $currency->is_active ?? 1) == 1 ? 'selected' : ''); ?>>Active</option>
        <option value="0" <?php echo e(old('is_active', $currency->is_active ?? 1) == 0 ? 'selected' : ''); ?>>Inactive</option>
      </select>
    </div>
  </div>

  <!-- <div class="col-md-4">
    <div class="form-group">
      <label>Default</label>
      <select name="is_default" class="form-control">
        <option value="0" <?php echo e(old('is_default', $currency->is_default ?? 0) == 0 ? 'selected' : ''); ?>>No</option>
        <option value="1" <?php echo e(old('is_default', $currency->is_default ?? 0) == 1 ? 'selected' : ''); ?>>Yes</option>
      </select>
      <small class="text-muted">Only one default currency is allowed.</small>
    </div>
  </div> -->
</div>
<?php /**PATH C:\xampp\htdocs\china\resources\views/currencies/_form.blade.php ENDPATH**/ ?>