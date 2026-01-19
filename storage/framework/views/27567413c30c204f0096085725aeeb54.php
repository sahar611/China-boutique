

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">

    <div class="card">

        <div class="card-header pb-0 d-flex justify-content-between">
            <h5><?php echo e(__('messages.add_banner')); ?></h5>
            <a href="<?php echo e(route('admin.banners.index')); ?>" class="btn bg-gradient-primary btn-sm">
                <?php echo e(__('messages.banners')); ?>

            </a>
        </div>

        <div class="card-body">

            <form action="<?php echo e(route('admin.banners.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <div class="row">

                    <div class="col-md-6">
                        <label><?php echo e(__('messages.title_en')); ?></label>
                        <input type="text" name="title" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label><?php echo e(__('messages.title_ar')); ?></label>
                        <input type="text" name="title_ar" class="form-control">
                    </div>

                </div>

                <div class="row mt-3">

                    <div class="col-md-6">
                        <label><?php echo e(__('messages.description_en')); ?></label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>

                    <div class="col-md-6">
                        <label><?php echo e(__('messages.description_ar')); ?></label>
                        <textarea name="description_ar" class="form-control"></textarea>
                    </div>

                </div>
 <div class="row mt-3">
                      <div class="col-md-6">
                        <label><?php echo e(__('messages.url')); ?></label>
                        <input type="text" name="url" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label><?php echo e(__('messages.status')); ?></label>
                        <select name="status" class="form-control">
                            <option value="1"><?php echo e(__('messages.status_active')); ?></option>
                            <option value="0"><?php echo e(__('messages.status_inactive')); ?></option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">

                  

                    <div class="col-md-6">
                        <label><?php echo e(__('messages.image')); ?></label>
                        <input type="file" name="image" class="form-control">
                    </div>

                </div>

               

                <div class="text-end mt-4">
                    <button class="btn bg-gradient-dark"><?php echo e(__('messages.save')); ?></button>
                </div>

            </form>

        </div>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/banners/create.blade.php ENDPATH**/ ?>