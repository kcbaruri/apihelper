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
                                <h3 class="page-title">{{ __('sidebar.admins') }}</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{ __('sidebar.admins') }}</a></li>
                                    <li class="breadcrumb-item active">{{ __('pages.updateutype') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{ __('pages.updateutype') }}</h4>
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

                                    <form action="{{ route('admin.admin.update', ['admin' => $admin->id]) }}" method="post">
                                       
                                        {{ csrf_field() }}
                                        {{ method_field('put') }}
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.tbl_name_column') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" value="<?php echo $admin->name;?>" placeholder="Name" id="name" name="name" required="required">
                                            </div>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>                                       
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.email') }}</label>
                                            <div class="col-md-10">
                                                <input type="email" class="form-control" placeholder="Email" id="email" name="email" required="required" value="<?php echo $admin->email;?>">
                                            </div>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.mobile_no') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" value="<?php echo $admin->mobile;?>" placeholder="Mobile" id="mobile" name="mobile">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('sidebar.departments') }}</label>
                                            <div class="col-md-10">
                                                <select name="department_id" class="form-control" required="required">
                                                <option value="">Select</option>
                                                @foreach ($departments as $var)
                                                <option value="{{ $var->id }}" <?php if($var->id == $admin->department_id) echo "selected=selected"; else echo "";?>>{{ $var->name }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        @if($admin->id == auth('admin')->user()->id)
                                        <div class="form-group row">
                                            <label for="password" class="col-form-label col-md-2">{{ __('pages.password') }}</label>
                                            <div class="col-md-10">
                                               <input id="password" type="password" class="form-control @error('password') is-invalid has-erro @enderror" name="password" autocomplete="new-password">

                                                @error('password')
                                                  <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                  </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password-confirm" class="col-form-label col-md-2">{{ __('pages.cpassword') }}</label>

                                            <div class="col-md-10">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                            </div>
                                        </div>
                                        @endif

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.usertype') }}</label>
                                            <div class="col-md-10">
                                                <select class="form-control" id="user_type" name="user_type">
                                                <option value="admin" <?php if($admin->user_type=="admin") echo "selected=selected";?>>Admin</option>
                                                <option value="super-admin" <?php if($admin->user_type=="super-admin") echo "selected=selected";?>>Super Admin</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group mb-0" >
                                        <button class="btn btn-primary" type="submit" style ="text-a">{{ __('pages.update_button') }}</button>
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