

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

          <form action="<?php echo e(route('admin.banners.update', $banner->id)); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>


                <div class="row">

                    <div class="col-md-6">
                        <label><?php echo e(__('messages.title_en')); ?></label>
                        <input type="text" name="title" class="form-control" value="<?php echo e(old('title', $banner->title)); ?>">
                    </div>

                    <div class="col-md-6">
                        <label><?php echo e(__('messages.title_ar')); ?></label>
                        <input type="text" name="title_ar" class="form-control" value="<?php echo e(old('title', $banner->title_ar)); ?>">
                    </div>

                </div>

                <div class="row mt-3">

                    <div class="col-md-6">
                        <label><?php echo e(__('messages.description_en')); ?></label>
                        <textarea name="description" class="form-control"><?php echo e(old('title', $banner->description)); ?></textarea>
                    </div>

                    <div class="col-md-6">
                        <label><?php echo e(__('messages.description_ar')); ?></label>
                        <textarea name="description_ar" class="form-control"><?php echo e(old('title', $banner->description_ar)); ?></textarea>
                    </div>

                </div>
 <div class="row mt-3">
       <div class="col-md-6">
                        <label><?php echo e(__('messages.url')); ?></label>
                        <input type="text" name="url" class="form-control"value="<?php echo e(old('title', $banner->url)); ?>">
                    </div>
                    <div class="col-md-6">
                        <label><?php echo e(__('messages.status')); ?></label>
                    <select name="status" class="form-control">
    <option value="1" <?php echo e(old('status', $banner->status ?? 1) == 1 ? 'selected' : ''); ?>>
        <?php echo e(__('messages.status_active')); ?>

    </option>

    <option value="0" <?php echo e(old('status', $banner->status ?? 1) == 0 ? 'selected' : ''); ?>>
        <?php echo e(__('messages.status_inactive')); ?>

    </option>
</select>

                    </div>
                </div>
                <div class="row mt-3">

                 

                    <div class="col-md-6">
                        <label><?php echo e(__('messages.image')); ?></label>
                        <input type="file" name="image" class="form-control">
                        <?php if($banner->image): ?>
    <img src="<?php echo e(asset('storage/'.$banner->image)); ?>" width="120" class="img-thumbnail mt-2">
<?php endif; ?>

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

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/banners/edit.blade.php ENDPATH**/ ?>