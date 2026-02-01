<?php if($paginator->hasPages()): ?>
    <div class="pesco-pagination mb-40" data-aos="fade-up" data-aos-duration="2000">
        <ul>

            
            <?php if($paginator->onFirstPage()): ?>
                <li class="disabled">
                    <span><i class="far fa-angle-left"></i></span>
                </li>
            <?php else: ?>
                <li>
                    <a href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev">
                        <i class="far fa-angle-left"></i>
                    </a>
                </li>
            <?php endif; ?>

            
            <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                
                <?php if(is_string($element)): ?>
                    <li class="disabled"><span><?php echo e($element); ?></span></li>
                <?php endif; ?>

                
                <?php if(is_array($element)): ?>
                    <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($page == $paginator->currentPage()): ?>
                            <li>
                                <a href="javascript:void(0)" class="active" aria-current="page">
                                    <?php echo e(str_pad($page, 2, '0', STR_PAD_LEFT)); ?>

                                </a>
                            </li>
                        <?php else: ?>
                            <li>
                                <a href="<?php echo e($url); ?>">
                                    <?php echo e(str_pad($page, 2, '0', STR_PAD_LEFT)); ?>

                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            
            <?php if($paginator->hasMorePages()): ?>
                <li>
                    <a href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next">
                        <i class="far fa-angle-right"></i>
                    </a>
                </li>
            <?php else: ?>
                <li class="disabled">
                    <span><i class="far fa-angle-right"></i></span>
                </li>
            <?php endif; ?>

        </ul>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\china\resources\views/front/layouts/pagination.blade.php ENDPATH**/ ?>