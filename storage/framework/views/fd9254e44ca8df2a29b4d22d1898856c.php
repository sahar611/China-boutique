

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="card">
        
        <div class="card-header pb-0">
            <div class="d-flex flex-row justify-content-between">
                <h5 class="mb-0"><?php echo e(__('messages.create_user')); ?></h5>
                <a href="<?php echo e(route('admin.users.index')); ?>" class="btn bg-gradient-primary btn-sm mb-0">
                    <?php echo e(__('messages.all_users')); ?>

                </a>
            </div>
        </div>

        <div class="card-body pt-4 p-3">

            <form action="<?php echo e(route('admin.users.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <div class="row">
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo e(__('messages.name')); ?>:</label>
                            <input type="text" name="name" class="form-control"
                                   value="<?php echo e(old('name')); ?>" required>
                        </div>
                    </div>
                
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo e(__('messages.email')); ?>:</label>
                            <input type="email" name="email" class="form-control"
                                   value="<?php echo e(old('email')); ?>" required>
                        </div>
                    </div>
                      <div class="col-md-4">
                        <label><?php echo e(__('messages.phone')); ?>:</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo e(old('phone')); ?>">
                    </div>
                </div>

               
                    
                   <div class="row">
    
    <div class="col-md-6">
        <div class="form-group">
            <label><?php echo e(__('messages.account_type')); ?>:</label>
          <select name="account_type" id="account_type" class="form-control" required>
    <option value="">Select</option>
    <option value="customer">Customer</option>
    <option value="staff">Staff</option>
</select>
        </div>
    </div>

    
    <div class="col-md-6">
      <div class="form-group">
    <label>Role</label>
    <select name="role" id="role" class="form-control">
        <option value="">Select Role</option>
        <option value="store-admin">Store Admin</option>
        <option value="order-manager">Order Manager</option>
        <option value="warehouse">Warehouse</option>
        <option value="content-manager">Content Manager</option>
        <option value="finance">Finance</option>
        <option value="support">Support</option>
    </select>
</div>
    </div>
</div>

                
                <div class="row">
                   
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo e(__('messages.password')); ?>:</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                    </div>
              <div class="col-md-4">
                        <label><?php echo e(__('messages.status')); ?>:</label>
                        <select name="status" class="form-control">
                            <option value="0"><?php echo e(__('messages.status_inactive')); ?></option>
                            <option value="1"><?php echo e(__('messages.status_active')); ?></option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label><?php echo e(__('messages.verified')); ?>:</label>
                        <select name="verified" class="form-control">
                            <option value="0"><?php echo e(__('messages.verified_no')); ?></option>
                            <option value="1"><?php echo e(__('messages.verified_yes')); ?></option>
                        </select>
                    </div>
                </div>

              
              
                
                <div class="form-group mt-3">
                    <label><?php echo e(__('messages.picture')); ?>:</label>
                    <input type="file" name="picture" class="form-control">
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">
                        <?php echo e(__('messages.save')); ?>

                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const accountTypeSelect = document.getElementById('account_type');
    const roleSelect = document.getElementById('role');

    if (!accountTypeSelect || !roleSelect) return;

  
    const roleWrapper = roleSelect.closest('.form-group') || roleSelect.parentElement;

    function toggleRoleField() {
        const type = accountTypeSelect.value;

        if (type === 'customer') {
            roleWrapper.style.display = 'none';
            roleSelect.value = '';
            roleSelect.removeAttribute('required');
        } else if (type === 'staff' || type === 'admin') {
            roleWrapper.style.display = 'block';
            roleSelect.setAttribute('required', 'required');
        } else {
            roleWrapper.style.display = 'none';
            roleSelect.removeAttribute('required');
        }
    }

 
    toggleRoleField();

   
    accountTypeSelect.addEventListener('change', toggleRoleField);
});
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/users/create.blade.php ENDPATH**/ ?>