

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-md-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="<?php echo e(route('admin.home')); ?>">Home</a>
              </li>
              <li class="breadcrumb-item active">Roles</li>
            </ol>
        </div>

        <div class="col-md-6 text-right">
            <a href="<?php echo e(route('admin.roles.index')); ?>" class="btn btn-primary">All roles</a>
        </div>
      </div>
    </div>
</section>

<section class="content">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Edit Role</h3>
    </div>

    <div class="card-body">
      <form action="<?php echo e(route('admin.roles.update', $model->id)); ?>" method="POST">
          <?php echo csrf_field(); ?>
          <?php echo method_field('PUT'); ?>

          
          <div class="form-group bmd-form-group">
              <label class="bmd-label-floating">Name</label>
              <input type="text" name="name" value="<?php echo e(old('name', $model->name)); ?>" required class="form-control">
          </div>

          
          <div class="form-group mt-4">
              <div class="d-flex align-items-center justify-content-between">
                  <label class="mb-0">Permissions</label>

                  <div>
                      <input id="select-all" type="checkbox">
                      <label for="select-all" class="mb-0">Check ALL</label>
                  </div>
              </div>

              <hr>

              <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module => $modulePermissions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php
                      $moduleId = 'module_' . preg_replace('/[^a-zA-Z0-9_]/', '_', $module);
                  ?>

                  <div class="mb-4">
                      <div class="d-flex align-items-center justify-content-between">
                          <h6 class="mb-2 text-uppercase"><?php echo e(ucfirst(str_replace('-', ' ', $module))); ?></h6>

                          <div>
                              <input type="checkbox"
                                     class="module-check"
                                     data-module="<?php echo e($moduleId); ?>"
                                     id="<?php echo e($moduleId); ?>_all">
                              <label for="<?php echo e($moduleId); ?>_all" class="mb-0">
                                  Check <?php echo e(ucfirst($module)); ?>

                              </label>
                          </div>
                      </div>

                      <div class="row">
                          <?php $__currentLoopData = $modulePermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <div class="col-sm-3 mb-2">
                                  <div class="form-check">
                                      <label class="form-check-label">
                                          <input
                                              type="checkbox"
                                              class="form-check-input permission-checkbox <?php echo e($moduleId); ?>"
                                              name="permissions[]"
                                              value="<?php echo e($permission->name); ?>"
                                              <?php echo e(in_array($permission->name, old('permissions', $rolePermissionNames)) ? 'checked' : ''); ?>

                                          >
                                          <?php echo e(str_replace($module.'.', '', $permission->name)); ?>

                                      </label>
                                  </div>
                              </div>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </div>
                  </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>

          <button type="submit" class="btn btn-primary pull-right">Update</button>
      </form>
    </div>
  </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const permissionBoxes = () => Array.from(document.querySelectorAll('.permission-checkbox'));
    const moduleChecks = Array.from(document.querySelectorAll('.module-check'));
    const selectAll = document.getElementById('select-all');

    function updateGlobalCheckAll() {
        const boxes = permissionBoxes();
        const total = boxes.length;
        const checked = boxes.filter(cb => cb.checked).length;
        if (selectAll) selectAll.checked = (total > 0 && total === checked);
    }

    function updateModuleCheckAll() {
        moduleChecks.forEach(moduleToggle => {
            const moduleClass = moduleToggle.dataset.module;
            const boxes = Array.from(document.querySelectorAll('.' + moduleClass));
            const total = boxes.length;
            const checked = boxes.filter(cb => cb.checked).length;
            moduleToggle.checked = (total > 0 && total === checked);
        });
    }

    // initial state
    updateGlobalCheckAll();
    updateModuleCheckAll();

    // global toggle
    if (selectAll) {
        selectAll.addEventListener('change', function () {
            const checked = this.checked;
            permissionBoxes().forEach(cb => cb.checked = checked);
            moduleChecks.forEach(cb => cb.checked = checked);
        });
    }

    // module toggles
    moduleChecks.forEach(moduleToggle => {
        moduleToggle.addEventListener('change', function () {
            const moduleClass = this.dataset.module;
            const checked = this.checked;
            document.querySelectorAll('.' + moduleClass).forEach(cb => cb.checked = checked);
            updateGlobalCheckAll();
        });
    });

    // single permission changes
    document.addEventListener('change', function (e) {
        if (!e.target.classList.contains('permission-checkbox')) return;
        updateGlobalCheckAll();
        updateModuleCheckAll();
    });

});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/roles/edit.blade.php ENDPATH**/ ?>