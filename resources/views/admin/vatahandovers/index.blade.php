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
                                <h3 class="page-title">{{ __('sidebar.vatahandovers') }}</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{ __('sidebar.dashboard') }}</a></li>
                                    <li class="breadcrumb-item"><a href="javascript:(0);">{{ __('sidebar.vatahandovers') }}</a></li>
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
                                    <!-- <div class="col-md-12 text-right p-0">
                                        <a class="btn btn-primary" data-toggle="" href="{{ route('admin.vatatypes.create') }}">
                                            <i class="fa fa-plus"> </i> Add New
                                        </a>
                                    </div> -->
                                    <div class="table-responsive">
                                        <table class="datatable table table-hover table-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('pages.tbl_sl_number_column') }}</th>
                                                    <th>{{ __('pages.tbl_vata_holder_name_column') }}</th>
                                                    <th>{{ __('pages.tbl_year_column') }}</th>
                                                    <th>{{ __('pages.tbl_month_column') }}</th>
                                                    <th>{{ __('pages.tbl_amount_column') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(count($vatahandovers) > 0) {
                                                    $counter = 0;
                                                    foreach($vatahandovers as $vatahandover) {  $counter++; ?>
                                                <tr>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="#"><?php echo  $counter;?></a>
                                                        </h2>
                                                    </td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="#"><?php echo $vatahandover->citizen->name;?></a>
                                                        </h2>
                                                    </td>
                                                    <td><?php echo $vatahandover->year;?></td> 
                                                    <td><?php echo $vatahandover->month;?></td>
                                                    <td><?php echo $vatahandover->amount;?></td>
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