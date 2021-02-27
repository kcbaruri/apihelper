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
                                    <li class="breadcrumb-item active">{{ __('pages.addadmin') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{ __('pages.newadmin') }}</h4>
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
                                    <form enctype="multipart/form-data" action="{{ url()->route('admin.admin.store') }}" method="post">
                                        {{ csrf_field() }}
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.tbl_name_column') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Name" id="name" name="name" required="required" value="">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.email') }}</label>
                                            <div class="col-md-10">
                                                <input type="email" class="form-control" placeholder="Email" id="email" name="email" required="required" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.mobile_no') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" value="" placeholder="Mobile" id="mobile" name="mobile">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password" class="col-form-label col-md-2">{{ __('pages.password') }}</label>

                                            <div class="col-md-10">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid has-erro @enderror" name="password" required autocomplete="new-password">
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
                                              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.usertype') }}</label>
                                            <div class="col-md-10">
                                                <select class="form-control" id="user_type" name="user_type">
                                                <option value="admin">Admin</option>
                                                <option value="super-admin">Super Admin</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group mb-0">
                                        <button class="btn btn-primary" type="submit">{{ __('pages.save_button') }}</button>
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