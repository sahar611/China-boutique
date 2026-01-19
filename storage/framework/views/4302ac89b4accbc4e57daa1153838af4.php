

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">

        <div class="card mb-4 mx-4">
            <div class="card-header pb-0 d-flex justify-content-between">
                <h5 class="mb-0"><?php echo e(__('messages.pages') ?? 'Pages'); ?></h5>
                <a href="<?php echo e(route('admin.pages.create')); ?>"
                   class="btn bg-gradient-primary btn-sm">
                    <?php echo e(__('messages.add_page') ?? 'Add Page'); ?>

                </a>
            </div>
<?php if(session('success')): ?>
                        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                    <?php endif; ?>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-3">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Slug</th>
                                <th><?php echo e(__('messages.title')); ?></th>
                                <th><?php echo e(__('messages.status')); ?></th>
                                <th><?php echo e(__('messages.created_at')); ?></th>
                                <th class="text-center"><?php echo e(__('messages.actions')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($page->id); ?></td>
                                <td><?php echo e($page->slug); ?></td>
                                <td>
                                    <?php echo e(app()->isLocale('ar') ? $page->title_ar : $page->title_en); ?>

                                </td>
                                <td>
                                    <?php echo e($page->status ? __('messages.status_active') : __('messages.status_inactive')); ?>

                                </td>
                                <td><?php echo e($page->created_at->format('Y-m-d')); ?></td>
                                <td class="text-center">
                                    <a href="<?php echo e(route('admin.pages.edit', $page->id)); ?>"
                                       class="btn btn-sm btn-primary">
                                        <?php echo e(__('messages.edit')); ?>

                                    </a>

                                    <form action="<?php echo e(route('admin.pages.destroy', $page->id)); ?>"
                                          method="POST"
                                          style="display:inline-block"
                                          onsubmit="return confirm('<?php echo e(__('messages.confirm_delete')); ?>')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit"
                                                class="btn btn-sm btn-danger">
                                            <?php echo e(__('messages.delete')); ?>

                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    <?php echo e(__('messages.no_data')); ?>

                                </td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>

                    <div class="mt-3">
                        <?php echo e($pages->links()); ?>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/pages/index.blade.php ENDPATH**/ ?>