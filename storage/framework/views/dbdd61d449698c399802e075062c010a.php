

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card mb-4 mx-4">
            <div class="card-header pb-0 d-flex justify-content-between">
                <h5 class="mb-0"><?php echo e(__('messages.settings') ?? 'Settings'); ?></h5>
            </div>
<?php if(session('success')): ?>
                        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                    <?php endif; ?>
            <div class="card-body pt-4 p-3">
                <form action="<?php echo e(route('admin.settings.update')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="row">
                        <div class="col-md-4">
                            <label><?php echo e(__('messages.phone')); ?></label>
                            <input type="text" name="phone" class="form-control"
                                   value="<?php echo e(old('phone', $settings['phone'])); ?>">
                        </div>

                        <div class="col-md-4">
                            <label><?php echo e(__('messages.email')); ?></label>
                            <input type="email" name="email" class="form-control"
                                   value="<?php echo e(old('email', $settings['email'])); ?>">
                        </div>

                        <div class="col-md-4">
                            <label>WhatsApp</label>
                            <input type="text" name="whatsapp" class="form-control"
                                   value="<?php echo e(old('whatsapp', $settings['whatsapp'])); ?>">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label>Facebook</label>
                            <input type="text" name="facebook" class="form-control"
                                   value="<?php echo e(old('facebook', $settings['facebook'])); ?>">
                        </div>

                        <div class="col-md-4">
                            <label>Instagram</label>
                            <input type="text" name="instagram" class="form-control"
                                   value="<?php echo e(old('instagram', $settings['instagram'])); ?>">
                        </div>

                        <div class="col-md-4">
                            <label>Twitter</label>
                            <input type="text" name="twitter" class="form-control"
                                   value="<?php echo e(old('twitter', $settings['twitter'])); ?>">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn bg-gradient-dark">
                            <?php echo e(__('messages.save')); ?>

                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/settings/edit.blade.php ENDPATH**/ ?>