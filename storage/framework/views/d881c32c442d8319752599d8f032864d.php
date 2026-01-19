
<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
      
          <div class="col-md-6">
            <ol class="breadcrumb ">
              <li class="breadcrumb-item"><a href="<?php echo e(route('admin.home')); ?>">Home</a></li>
              <li class="breadcrumb-item active">Roles</li>
            </ol>
          </div>

          <!-- <div class="col-md-6 text-right">
                <a href="<?php echo e(route('admin.roles.create')); ?>" class="btn btn-primary">Add New Role</a>
                
                </div>
        </div> -->
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">List of Roles</h3>

        </div>
        <div class="card-body">
            
        <?php if(session('success')): ?>
                        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                    <?php endif; ?>
       <?php if(count($records)): ?>
       <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th class="text-center">Edit</th>
                

              </tr>
            </thead>
          
            <tbody>  
                <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($loop->iteration); ?></td>
                <td><?php echo e($row->name); ?></td>

                <td class="text-center" >
                        <a href="<?php echo e(url(route('admin.roles.edit' , $row->id ))); ?>" title="Edit" class="btn btn-white btn-link btn-sm" data-original-title="Edit">
                                <i class="fas fa-edit"></i>
</a>
</td>


                   
              </tr>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        
       <?php else: ?>
       <div class="col-md-4 col-md-offset-4 text-center alert alert-denger bg-blue">
no data
    </div>
       <?php endif; ?>
        </div>
      
      </div>
      <!-- /.card -->

    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\china\resources\views/roles/index.blade.php ENDPATH**/ ?>