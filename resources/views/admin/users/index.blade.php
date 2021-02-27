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
                                <h3 class="page-title">List of Consumer</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="javascript:(0);">Users</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    @if(session()->has('message'))
                                    <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                    </div>
                                    @endif
                                    <div class="col-md-12 text-right p-0">
                                       {{-- <a class="btn btn-primary" data-toggle="" href="{{ route('admin.users.create') }}">
                                            <i class="fa fa-plus"> </i> <span>{{ __('pages.add_new') }} </span>
                                        </a>--}}
                                    </div>
                                    <div class="search-area">
                                        <h2>Search</h2>
                                        <form action="{{ route('admin.users') }}" method="get">
                                                                                       
                                            <div class="row">
                                                <div class="col-md-3 p-0">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <input type="text" value="{{ Request::get('name')}}" name="name" class="form-control" placeholder="Name">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-3 p-0">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <input type="text" value="{{ Request::get('mobile_number')}}" name="mobile_number" class="form-control" placeholder="Mobile Number">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 p-0">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <button class="btn btn-primary" type="submit">Search</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="datatable table table-hover table-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Mobile</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(count($users) > 0) {
                                                    foreach($users as $user) {?>
                                                <tr>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="#"><?php echo $user->name;?></a>
                                                        </h2>
                                                    </td>
                                                    
                                                    <td><?php echo $user->mobile_number;?></td>
                                                    
                                                    
                                                    <td class="">
                                                        <div class="actions">
                                                            {{--<a class="btn btn-sm bg-success-light" href="{{ route('admin.users.edit', $user->id) }}">
                                                                <i class="fe fe-pencil"></i> {{ __('pages.edit') }}
                                                            </a>--}}
                                                            <form action="{{ route('admin.users.delete', $user->id) }}" method="post" class="btn-group">
                                                            {{ csrf_field() }}
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
                            </div>
                        </div>          
                    </div>
                    
                </div>          
            </div>
            <!-- /Page Wrapper -->
        
        </div>
        <!-- /Main Wrapper -->
@endsection