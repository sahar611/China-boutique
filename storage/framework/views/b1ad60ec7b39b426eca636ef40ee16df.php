

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="card">

        <div class="card-header pb-0">
            <div class="d-flex flex-row justify-content-between">
                <h5 class="mb-0"><?php echo e(__('messages.edit_user')); ?></h5>
                <a href="<?php echo e(route('admin.users.index')); ?>" class="btn bg-gradient-primary btn-sm mb-0">
                    <?php echo e(__('messages.all_users')); ?>

                </a>
            </div>
        </div>

        <div class="card-body pt-4 p-3">

            <form action="<?php echo e(route('admin.users.update', $user->id)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                
                <div class="row">
                    <div class="col-md-4">
                        <label><?php echo e(__('messages.name')); ?>:</label>
                        <input type="text" name="name" class="form-control"
                               value="<?php echo e(old('name', $user->name)); ?>">
                    </div>

                    <div class="col-md-4">
                        <label><?php echo e(__('messages.email')); ?>:</label>
                        <input type="email" name="email" class="form-control"
                               value="<?php echo e(old('email', $user->email)); ?>">
                    </div>

                    <div class="col-md-4">
                        <label><?php echo e(__('messages.phone')); ?>:</label>
                        <input type="text" name="phone" class="form-control"
                               value="<?php echo e(old('phone', $user->phone)); ?>">
                    </div>
                </div>

                
                <div class="row mt-3">
                   
<div class="col-md-6">
    <label><?php echo e(__('messages.account_type')); ?></label>
    <select name="account_type" id="account_type" class="form-control" required>
        <option value="customer" <?php echo e($user->account_type === 'customer' ? 'selected' : ''); ?>>
            Customer
        </option>
        <option value="staff" <?php echo e($user->account_type === 'staff' ? 'selected' : ''); ?>>
            Staff
        </option>
    </select>
</div>


<?php
    $currentRole = $user->roles->first()?->name;
?>

<div class="col-md-6" id="role-wrapper">
    <label><?php echo e(__('messages.role')); ?></label>
    <select name="role" id="role" class="form-control">
        <option value="">Select Role</option>

        <option value="store-admin" <?php echo e($currentRole === 'store-admin' ? 'selected' : ''); ?>>Store Admin</option>
        <option value="order-manager" <?php echo e($currentRole === 'order-manager' ? 'selected' : ''); ?>>Order Manager</option>
        <option value="warehouse" <?php echo e($currentRole === 'warehouse' ? 'selected' : ''); ?>>Warehouse</option>
        <option value="content-manager" <?php echo e($currentRole === 'content-manager' ? 'selected' : ''); ?>>Content Manager</option>
        <option value="finance" <?php echo e($currentRole === 'finance' ? 'selected' : ''); ?>>Finance</option>
        <option value="support" <?php echo e($currentRole === 'support' ? 'selected' : ''); ?>>Support</option>
    </select>
</div>

                </div>

                
                <div class="row mt-3">
                    <div class="col-md-4">
                        <label><?php echo e(__('messages.password')); ?>:</label>
                        <input type="password" name="password" class="form-control">
                        <small class="text-muted"><?php echo e(__('messages.leave_empty')); ?></small>
                    </div>

                    <div class="col-md-4">
                        <label><?php echo e(__('messages.status')); ?>:</label>
                        <select name="status" class="form-control">
                            <option value="0" <?php echo e($user->status == 0 ? 'selected' : ''); ?>>
                                <?php echo e(__('messages.status_inactive')); ?>

                            </option>
                            <option value="1" <?php echo e($user->status == 1 ? 'selected' : ''); ?>>
                                <?php echo e(__('messages.status_active')); ?>

                            </option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label><?php echo e(__('messages.verified')); ?>:</label>
                        <select name="verified" class="form-control">
                            <option value="0" <?php echo e($user->verified == 0 ? 'selected' : ''); ?>>
                                <?php echo e(__('messages.verified_no')); ?>

                            </option>
                            <option value="1" <?php echo e($user->verified == 1 ? 'selected' : ''); ?>>
                                <?php echo e(__('messages.verified_yes')); ?>

                            </option>
                        </select>
                    </div>
                </div>

                
                <div class="form-group mt-3">
                    <label><?php echo e(__('messages.picture')); ?>:</label>
                    <input type="file" name="picture" class="form-control">

                    <?php if($user->picture): ?>
                        <div class="mt-3">
                          <img src="<?php echo e(asset($user->picture)); ?>" width="120" class="img-thumbnail">

                        </div>
                    <?php endif; ?>
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
        } else if (type === 'staff') {
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

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/users/edit.blade.php ENDPATH**/ ?>