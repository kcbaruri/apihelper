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
                                <h3 class="page-title"><span>{{ __('dashboard.title') }}</span></h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item active"><span>{{ __('sidebar.dashboard') }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->

                    <div class="row">
                    <?php if(Auth::guard('admin')->user()->user_type =="super-admin") {?>
                        <div class="col-xl-3 col-sm-6 col-12">
                        <a class="nav-link" href="{{url('admin/admin')}}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dash-widget-header">
                                        <span class="dash-widget-icon text-primary border-primary">
                                            <i class="fe fe-users"></i>
                                        </span>
                                        <div class="dash-count">
                                            <h3>{{ (empty($admins) == false) ? $admins->count() : '' }}</h3>
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        <h6 class="text-muted"><span>{{ __('sidebar.admins') }}</span></h6>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-primary w-50"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                        <?php }?>
                        <div class="col-xl-3 col-sm-6 col-12">
                        <a class="nav-link" href="{{url('admin/citizens')}}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dash-widget-header">
                                        <span class="dash-widget-icon text-success">
                                            <i class="fe fe-credit-card"></i>
                                        </span>
                                        <div class="dash-count">
                                            <h3>{{ (empty($citizens) == false) ? $citizens->count() : '' }}</h3>
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        
                                        <h6 class="text-muted"><span>{{ __('sidebar.floors') }}</span></h6>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-success w-50"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                        <!-- <div class="col-xl-3 col-sm-6 col-12">
                        <a class="nav-link" href="{{url('admin/vatatypes')}}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dash-widget-header">
                                        <span class="dash-widget-icon text-danger border-danger">
                                            <i class="fe fe-money"></i>
                                        </span>
                                        <div class="dash-count">
                                            <h3>{{ (empty($vatatypes) == false) ? $vatatypes->count() : '' }}</h3>
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        
                                        <h6 class="text-muted"><span>{{ __('sidebar.vatatypes') }}</span></h6>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-danger w-50"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div> -->
                        <div class="col-xl-3 col-sm-6 col-12">
                        <a class="nav-link" href="{{url('admin/vata-handovers')}}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dash-widget-header">
                                        <span class="dash-widget-icon text-warning border-warning">
                                            <i class="fe fe-folder"></i>
                                        </span>
                                        <div class="dash-count">
                                            <h3>{{ (empty($vatahandovers) == false) ? $vatahandovers->count() : '' }}</h3>
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        
                                        <h6 class="text-muted"><span>{{ __('sidebar.flats') }}</span</h6>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-warning w-50"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>

                        <div class="col-xl-3 col-sm-6 col-12">
                        <a class="nav-link" href="{{url('admin/unions')}}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dash-widget-header">
                                        <span class="dash-widget-icon text-warning border-warning">
                                            <i class="fe fe-union"></i>
                                        </span>
                                        <div class="dash-count">
                                            <h3>{{ (empty($unions) == false) ? $unions->count() : '' }}</h3>
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        
                                        <h6 class="text-muted"><span>{{ __('sidebar.tenants') }}</span</h6>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-warning w-50"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>

                    <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary custom-card-height">
                        <div class="float-left">

                            <div class="dash-widget-header">
                                        <span class="dash-widget-icon text-danger border-danger">
                                            <i class="fe fe-money"></i>
                                        </span>
                                        <div class="dash-count">
                                            <h3>{{ __('sidebar.billheads') }}</h3>
                                        </div>
                                    </div>

                        </div>
                        <div class="text-right">
                            <h4 class="card-title">{{ __('dashboard.total') }}</h4>
                            <div class="dash-count">
                                            <h3>{{ (empty($vatatypes) == false) ? $vatatypes->count() : '' }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead class="text-warning">
                            <th>SL #</th>
                            <th>Name</th>
                            </thead>
                            <tbody>
                            @forelse($vatatypes as $key=>$vatatype)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$vatatype->name}}</td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No vata type exists</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="custom-account-card card">
                    <div class="card-header card-header-warning custom-card-height">

                        <div class="float-left">
                            <a>
                               <h4>{{ __('dashboard.collection_summary') }}</h4></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- <div class="progress custom-progress mx-auto" data-value=''>
                            <span class="progress-left">
                                <span class="progress-bar account-progress-bar border-info bg-gray-white"></span>
                            </span>
                            <span class="progress-right">
                                <span class="progress-bar account-progress-bar border-info bg-gray-white"></span>
                            </span>
                            
                        </div> -->
                        <!-- Demo info -->
                        <div class="row text-center mt-4">
                            <div class="col-6 border-right">
                                <div class="p mb-0 bullet ">Current Month Due</div>
                                <span
                                    class="small text-gray">30000</span>
                            </div>
                            <div class="col-6">
                                <div class="p mb-0 bullet green">Current Month Paid</div>
                                <span class="small text-gray">1000000</span>
                            </div>
                        </div>
                        <!-- END -->
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