

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="card">

        <div class="card-header pb-0">
            <h5 class="mb-0">
                <?php echo e($faq->exists
                    ? __('messages.edit_faq')
                    : __('messages.create_faq')); ?>

            </h5>
        </div>

        <div class="card-body pt-3">

            <form method="POST"
                  action="<?php echo e($faq->exists
                        ? route('admin.faqs.update', $faq)
                        : route('admin.faqs.store')); ?>">

                <?php echo csrf_field(); ?>
                <?php if($faq->exists): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label"><?php echo e(__('messages.question_en')); ?></label>
                        <input type="text"
                               name="question_en"
                               class="form-control"
                               value="<?php echo e(old('question_en', $faq->question_en)); ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label"><?php echo e(__('messages.question_ar')); ?></label>
                        <input type="text"
                               name="question_ar"
                               class="form-control"
                               value="<?php echo e(old('question_ar', $faq->question_ar)); ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label"><?php echo e(__('messages.answer_en')); ?></label>
                        <textarea name="answer_en"
                                  rows="5"
                                  class="form-control wysiwyg"><?php echo e(old('answer_en', $faq->answer_en)); ?></textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label"><?php echo e(__('messages.answer_ar')); ?></label>
                        <textarea name="answer_ar"
                                  rows="5"
                                  class="form-control wysiwyg"><?php echo e(old('answer_ar', $faq->answer_ar)); ?></textarea>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label"><?php echo e(__('messages.sort_order')); ?></label>
                        <input type="number"
                               name="sort_order"
                               class="form-control"
                               value="<?php echo e(old('sort_order', $faq->sort_order ?? 0)); ?>">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label"><?php echo e(__('messages.status')); ?></label>
                        <select name="is_active" class="form-select">
                            <option value="1" <?php if(old('is_active', $faq->is_active) == 1): echo 'selected'; endif; ?>>
                                <?php echo e(__('messages.active')); ?>

                            </option>
                            <option value="0" <?php if(old('is_active', $faq->is_active) == 0): echo 'selected'; endif; ?>>
                                <?php echo e(__('messages.inactive')); ?>

                            </option>
                        </select>
                    </div>

                </div>

                <div class="d-flex gap-2">
                    <button class="btn bg-gradient-primary">
                        <?php echo e($faq->exists ? __('messages.update') : __('messages.save')); ?>

                    </button>

                    <a href="<?php echo e(route('admin.faqs.index')); ?>"
                       class="btn btn-secondary">
                        <?php echo e(__('messages.back')); ?>

                    </a>
                </div>

            </form>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/faqs/form.blade.php ENDPATH**/ ?>