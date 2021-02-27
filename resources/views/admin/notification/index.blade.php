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
                                <h3 class="page-title">List of Notification</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="javascript:(0);">Notification</a></li>
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
                                    
                                    <div class="table-responsive">
                                        <table class="datatable table table-hover table-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Sender</th>
                                                    <th>Notification Title</th>                                                   
                                                    <th>Action</th>                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @if(count($notifications) > 0)
                                                @foreach($notifications as $notification)
                                                <tr>
                                                    <td>{{ $notification->user->name }}</td> 
                                                    <td>{{ $notification->notification_title ?? '' }}</td>      
                                                    <td>
                                                         <div class="actions">                                                            
                                                            <form action="{{ route('admin.notification_destroy', $notification->id) }}" method="post" class="btn-group">
                                                            {{ csrf_field() }}
                                                            {{ method_field('delete') }}
                                                            <button title="Delete" type="submit" class="btn btn-sm bg-danger-light" onclick="return confirm('Are you sure you want to delete?')"><i class="fe fe-trash"></i> Delete&nbsp;</button>
                                                            </form>
                                                        </div>
                                                    </td>                                               
                                                </tr>
                                                @endforeach
                                                @else 
                                                <tr><td colspan=5>No Data Found</td></tr>
                                                @endif                                               
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