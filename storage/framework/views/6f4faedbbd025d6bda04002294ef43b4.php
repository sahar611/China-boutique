<div class="table-responsive p-0">
    <table class="table align-items-center mb-0">
        <thead>
        <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><?php echo e(__('messages.id')); ?></th>

            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                <?php echo e(__('messages.user')); ?>

            </th>

            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                <?php echo e(__('messages.phone')); ?>

            </th>

            
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                <?php echo e(__('messages.status')); ?>

            </th>

            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                <?php echo e(__('messages.verified')); ?>

            </th>

            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                <?php echo e(__('messages.created_at')); ?>

            </th>

            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                <?php echo e(__('messages.action')); ?>

            </th>
        </tr>
        </thead>

        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
            
                <td class="ps-4 text-center"><?php echo e($user->id); ?></td>

                
                <td class="text-center">
                    <div class="d-flex flex-column align-items-center justify-content-center py-2">
                     

                    
                        <div class="fw-bold"><?php echo e($user->name); ?></div>
                        <div class="text-xs text-secondary"><?php echo e($user->email); ?></div>
                    </div>
                </td>

                
                <td class="text-center">
                    <?php echo e($user->phone ?? '-'); ?>

                </td>

               

                
                <td class="text-center">
                    <?php if((int)($user->status ?? 0) === 1): ?>
                        <span class="badge bg-gradient-success"><?php echo e(__('messages.status_active')); ?></span>
                    <?php else: ?>
                        <span class="badge bg-gradient-secondary"><?php echo e(__('messages.status_inactive')); ?></span>
                    <?php endif; ?>
                </td>

                
                <td class="text-center">
                    <?php if((int)($user->verified ?? 0) === 1): ?>
                        <span class="badge bg-gradient-success"><?php echo e(__('messages.verified_yes')); ?></span>
                    <?php else: ?>
                        <span class="badge bg-gradient-warning"><?php echo e(__('messages.verified_no')); ?></span>
                    <?php endif; ?>
                </td>

                
                <td class="text-center">
                    <?php echo e(optional($user->created_at)->format('Y-m-d')); ?>

                </td>

                
                <td class="text-center">
                    <a href="<?php echo e(route('admin.users.edit', $user->id)); ?>" class="btn btn-sm btn-warning">
                        <?php echo e(__('messages.edit')); ?>

                    </a>

                    <form action="<?php echo e(route('admin.users.destroy', $user->id)); ?>"
                          method="POST"
                          style="display:inline-block">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button class="btn btn-sm btn-danger"
                                onclick="return confirm('<?php echo e(__('users.confirm_delete')); ?>')">
                            <?php echo e(__('messages.delete')); ?>

                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="8" class="text-center py-4 text-secondary">
                    <?php echo e(__('messages.no_data')); ?>

                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<?php /**PATH C:\xampp\htdocs\china\resources\views/users/table.blade.php ENDPATH**/ ?>