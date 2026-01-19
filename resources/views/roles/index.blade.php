@extends('layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
      
          <div class="col-md-6">
            <ol class="breadcrumb ">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item active">Roles</li>
            </ol>
          </div>

          <!-- <div class="col-md-6 text-right">
                <a href="{{route('admin.roles.create')}}" class="btn btn-primary">Add New Role</a>
                
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
            
        @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
       @if(count($records))
       <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th class="text-center">Edit</th>
                

              </tr>
            </thead>
          
            <tbody>  
                @foreach($records as $row)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$row->name}}</td>

                <td class="text-center" >
                        <a href="{{url(route('admin.roles.edit' , $row->id ))}}" title="Edit" class="btn btn-white btn-link btn-sm" data-original-title="Edit">
                                <i class="fas fa-edit"></i>
</a>
</td>


                   
              </tr>
  @endforeach
            </tbody>
          </table>
        
       @else
       <div class="col-md-4 col-md-offset-4 text-center alert alert-denger bg-blue">
no data
    </div>
       @endif
        </div>
      
      </div>
      <!-- /.card -->

    </section>
@endsection
