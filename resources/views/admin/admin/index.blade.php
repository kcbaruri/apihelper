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
                            <div class="col-sm-12">
                                <h3 class="page-title"><span>{{ __('sidebar.listofadmin') }} </span></h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/admin')}}"><span>{{ __('sidebar.dashboard') }} </span></a></li>
                           
                                    <li class="breadcrumb-item"><a href="javascript:(0);"><span>{{ __('sidebar.admins') }} </span></a></li>
                                    <li class="breadcrumb-item active"><span>{{ __('sidebar.listofadmin') }} </span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">

                                <?php 
                                if(Auth::guard('admin')->user()->user_type =="super-admin"){
                                ?>

                                    @if(session()->has('message'))
                                    <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                    </div>
                                    @endif
                                    <div class="col-md-12 text-right p-0">
                                        <a class="btn btn-primary" data-toggle="" href="{{ route('admin.admin.create') }}">
                                            <i class="fa fa-plus"> </i> <span>{{ __('pages.add_new') }} </span>
                                        </a>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="datatable table table-hover table-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('pages.tbl_sl_number_column') }}</th>
                                                    <th>{{ __('pages.tbl_name_column') }}</th>
                                                    <th>{{ __('sidebar.departments') }}</th>
                                                    <th>{{ __('pages.tbl_email_column') }}</th>
                                                    <th>{{ __('pages.tbl_action_column') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(count($admins) > 0) {
                                                    $counter = 0;
                                                    foreach($admins as $admin) { $counter++; ?>
                                                <tr>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="#"><?php echo $counter;?></a>
                                                        </h2>
                                                    </td> 
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="#"><?php echo $admin->name;?></a>
                                                        </h2>
                                                    </td> 
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="#"><?php echo $admin->department->name;?></a>
                                                        </h2>
                                                    </td>                                                    
                                                    <td><?php echo $admin->email;?></td>                                                    
                                                    <td class="">
                                                        <div class="actions">
                                                            <a class="btn btn-sm bg-success-light" href="{{ route('admin.admin.edit', $admin->id) }}">
                                                                <i class="fe fe-pencil"></i> {{ __('pages.edit') }}
                                                            </a>
                                                            <form action="{{ route('admin.admin.destroy', $admin->id) }}" method="post" class="btn-group">
                                                            {{ csrf_field() }}
                                                            {{ method_field('delete') }}
                                                            <button title="Delete" type="submit" class="btn btn-sm bg-danger-light" onclick="return confirm('Are you sure you want to delete?')"><i class="fe fe-trash"></i> {{ __('pages.delete') }}&nbsp;</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } }
                                                else 
                                                echo "<tr><td colspan=5>No Data Found</td></tr>";?>
                                               
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <?php } else echo $not_authorized;?>
                            </div>
                        </div>          
                    </div>
                    
                </div>          
            </div>
            <!-- /Page Wrapper -->
        
        </div>
        <!-- /Main Wrapper -->
@endsection