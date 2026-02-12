

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card mb-4 mx-4">

            <div class="card-header pb-0 d-flex justify-content-between">
                <h5 class="mb-0"><?php echo e(__('messages.banners')); ?></h5>
                <a href="<?php echo e(route('admin.banners.create')); ?>" class="btn bg-gradient-primary btn-sm">
                    <?php echo e(__('messages.add_banner')); ?>

                </a>
            </div>

            <div class="card-body px-0 pt-0 pb-2">

                <div class="table-responsive p-3">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo e(__('messages.title')); ?></th>
                                <!-- <th><?php echo e(__('messages.image')); ?></th> -->
                                <th><?php echo e(__('messages.status')); ?></th>
                                <th><?php echo e(__('messages.url')); ?></th>
                                <th class="text-center"><?php echo e(__('messages.actions')); ?></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td>
                                        <?php echo e(app()->isLocale('ar') ? ($banner->title_ar ?: $banner->title) : $banner->title); ?>

                                    </td>
                                    <!-- <td>
                                        <?php if($banner->image): ?>
                                            <img src="<?php echo e(asset('storage/'.$banner->image)); ?>" width="80">
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td> -->
                                    <td><?php echo e($banner->status ? __('messages.status_active') : __('messages.status_inactive')); ?></td>
                                    <td><?php echo e($banner->url ?? '-'); ?></td>
                                    <td class="text-center">
                                        <a class="btn btn-primary btn-sm" href="<?php echo e(route('admin.banners.edit', $banner->id)); ?>">
                                            <?php echo e(__('messages.edit')); ?>

                                        </a>

                                        <form action="<?php echo e(route('admin.banners.destroy', $banner->id)); ?>"
                                              method="POST"
                                              style="display:inline-block"
                                              onsubmit="return confirm('<?php echo e(__('messages.confirm_delete')); ?>')">

                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>

                                            <button class="btn btn-danger btn-sm"><?php echo e(__('messages.delete')); ?></button>
                                        </form>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/banners/index.blade.php ENDPATH**/ ?>