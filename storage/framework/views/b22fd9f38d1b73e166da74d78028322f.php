

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card mb-4 mx-4">
            <div class="card-header pb-0">
                <div class="d-flex flex-row justify-content-between">
                    <div>
                        <h5 class="mb-0"><?php echo e(__('messages.all_users')); ?></h5>
                    </div>
                    <a href="<?php echo e(route('admin.users.create')); ?>" class="btn bg-gradient-primary btn-sm mb-0">
                        <?php echo e(__('messages.add_user')); ?>

                    </a>
                </div>
            </div>

            <div class="card-body px-0 pt-0 pb-2">
               <div class="nav-wrapper position-relative end-0 mt-3">
    <ul class="nav nav-pills nav-fill p-1 bg-transparent" id="userTabs" role="tablist">

        <li class="nav-item">
            <a class="nav-link mb-0 px-0 py-1 active" id="all-tab" data-bs-toggle="tab"
               href="#all" role="tab"><?php echo e(__('messages.all_users')); ?></a>
        </li>

        <li class="nav-item">
            <a class="nav-link mb-0 px-0 py-1" id="clients-tab" data-bs-toggle="tab"
               href="#clients" role="tab"><?php echo e(__('messages.clients')); ?></a>
        </li>

      
       
<li class="nav-item">
    <a class="nav-link mb-0 px-0 py-1" id="staff-tab" data-bs-toggle="tab"
       href="#staff" role="tab"><?php echo e(__('messages.staff')); ?></a>
</li>

    </ul>
</div>
<div class="tab-content">

    
    <div class="tab-pane fade show active" id="all" role="tabpanel">
        <?php echo $__env->make('users.table', ['list' => $users], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    
    <div class="tab-pane fade" id="clients" role="tabpanel">
        <?php echo $__env->make('users.table', ['list' => $customers], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

   
  

   

<div class="tab-pane fade" id="staff" role="tabpanel">
    <?php echo $__env->make('users.table', ['list' => $staff], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>

</div>

              
            </div>

        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/users/index.blade.php ENDPATH**/ ?>