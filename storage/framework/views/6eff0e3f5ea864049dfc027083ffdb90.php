

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="card">

        <div class="card-header pb-0">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><?php echo e(__('messages.faqs')); ?></h5>

                <a href="<?php echo e(route('admin.faqs.create')); ?>"
                   class="btn bg-gradient-primary btn-sm">
                    <?php echo e(__('messages.create')); ?>

                </a>
            </div>
        </div>
<?php if(session('success')): ?>
                        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                    <?php endif; ?>
        <div class="card-body pt-3">

            
            <form method="GET" class="row mb-3">
                <div class="col-md-4">
                    <input type="text"
                           name="q"
                           value="<?php echo e(request('q')); ?>"
                           class="form-control"
                           placeholder="<?php echo e(__('messages.search')); ?>">
                </div>
            </form>

            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo e(__('messages.faq')); ?></th>
                            <th><?php echo e(__('messages.status')); ?></th>
                            <th><?php echo e(__('messages.sort_order')); ?></th>
                            <th class="text-end"><?php echo e(__('messages.actions')); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($faq->id); ?></td>

                                <td>
                                    <div class="fw-bold">
                                        <?php echo e(app()->getLocale() == 'en'
                                            ? $faq->question_en
                                            : $faq->question_ar); ?>

                                    </div>
                                </td>

                                <td>
                                    <span class="badge <?php echo e($faq->is_active ? 'bg-success' : 'bg-secondary'); ?>">
                                        <?php echo e($faq->is_active
                                            ? __('messages.active')
                                            : __('messages.inactive')); ?>

                                    </span>
                                </td>

                                <td><?php echo e($faq->sort_order); ?></td>

                                <td class="text-end">
                                    <a href="<?php echo e(route('admin.faqs.edit', $faq)); ?>"
                                       class="btn btn-sm bg-gradient-primary">
                                        <?php echo e(__('messages.edit')); ?>

                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>

                </table>
            </div>

            <div class="mt-3">
                <?php echo e($faqs->links()); ?>

            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/faqs/index.blade.php ENDPATH**/ ?>