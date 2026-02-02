

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">

        <div class="card mb-4 mx-4">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><?php echo e(__('messages.edit_page')); ?></h5>

                <a href="<?php echo e(route('admin.pages.index')); ?>" class="btn bg-gradient-primary btn-sm">
                    <?php echo e(__('messages.pages')); ?>

                </a>
            </div>

            <div class="card-body pt-4 p-3">
                <form action="<?php echo e(route('admin.pages.update', $page->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="row">
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><?php echo e(__('messages.slug')); ?></label>
                                <input type="text" name="slug" class="form-control"
                                       value="<?php echo e(old('slug', $page->slug)); ?>" required>
                                <small class="text-muted">
                                    <?php echo e(__('messages.slug_hint')); ?>

                                </small>
                            </div>
                        </div>

                        
                        <!-- <div class="col-md-4">
                            <div class="form-group">
                                <label><?php echo e(__('messages.status')); ?></label>
                                <select name="status" class="form-control">
                                    <option value="1" <?php echo e(old('status', $page->status) == 1 ? 'selected' : ''); ?>>
                                        <?php echo e(__('messages.status_active')); ?>

                                    </option>
                                    <option value="0" <?php echo e(old('status', $page->status) == 0 ? 'selected' : ''); ?>>
                                        <?php echo e(__('messages.status_inactive')); ?>

                                    </option>
                                </select>
                            </div>
                        </div>
                    </div> -->

                    
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label><?php echo e(__('messages.title_en')); ?></label>
                            <input type="text" name="title_en" class="form-control"
                                   value="<?php echo e(old('title_en', $page->title_en)); ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label><?php echo e(__('messages.title_ar')); ?></label>
                            <input type="text" name="title_ar" class="form-control"
                                   value="<?php echo e(old('title_ar', $page->title_ar)); ?>" required>
                        </div>
                    </div>

                    
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label><?php echo e(__('messages.content_en')); ?></label>
                            <textarea name="content_en" rows="8" class="form-control"><?php echo e(old('content_en', $page->content_en)); ?></textarea>
                        </div>

                        <div class="col-md-6">
                            <label><?php echo e(__('messages.content_ar')); ?></label>
                            <textarea name="content_ar" rows="8" class="form-control"><?php echo e(old('content_ar', $page->content_ar)); ?></textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn bg-gradient-dark">
                            <?php echo e(__('messages.update')); ?>

                        </button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/pages/edit.blade.php ENDPATH**/ ?>