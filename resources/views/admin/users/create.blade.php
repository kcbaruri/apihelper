@extends('admin.layouts.admin')

@section('content')

            <!-- Main Wrapper -->
        <div class="main-wrapper">
        
            
                @include('admin.layouts.topbar')
                @include('admin.layouts.sidebar')
            
            <!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
                
                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="row">
                            <div class="col">
                                <h3 class="page-title">User</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Add User</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">New User</h4>
                                </div>
                                @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                <div class="alert alert-card alert-danger" role="alert">
                                    <strong>{{$error}} </strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endforeach
                                @endif
                                <div class="card-body">
                                    <form enctype="multipart/form-data" action="{{ url()->route('admin.users.store') }}" method="post">
                                        {{ csrf_field() }}
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">Name</label>
                                            <div class="col-md-10">
                                                {{ Form::text('name', old('name'), ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Name', 'required' => 'required']) }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">Username</label>
                                            <div class="col-md-10">
                                                {{ Form::text('user_name', old('user_name'), ['class' => 'form-control', 'id' => 'user_name', 'placeholder' => 'User Name', 'required' => 'required']) }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">Email</label>
                                            <div class="col-md-10">
                                                {{ Form::text('email', old('email'), ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email']) }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">Mobile Number</label>
                                            <div class="col-md-10">
                                                {{ Form::text('mobile_number', old('mobile_number'), ['class' => 'form-control', 'id' => 'mobile_number', 'placeholder' => 'Mobile', 'required' => 'required']) }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">Password</label>
                                            <div class="col-md-10">
                                                {{ Form::password('password', array('id' => 'password', "class" => "form-control", 'required' => 'required')) }}
                                            </div>
                                        </div>

                                        <div class="form-group mb-0">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                
                </div>          
            </div>
            <!-- /Main Wrapper -->
        
        </div>
        <!-- /Main Wrapper -->
@endsection