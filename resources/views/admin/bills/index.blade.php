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
                                <h3 class="page-title">{{ __('pages.bill_management') }}</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{ __('sidebar.dashboard') }}</a></li>
                                    <li class="breadcrumb-item"><a href="javascript:(0);">{{ __('pages.bill_management') }}</a></li>
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
                                        <a class="btn btn-primary" data-toggle="" href="{{ route('admin.bills.create') }}">
                                            <i class="fa fa-plus"> </i> <span>{{ __('pages.add_new') }} </span>
                                        </a>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="datatable table table-hover table-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('pages.tbl_sl_number_column') }}</th>
                                                    <th>{{ __('sidebar.floors') }}</th>
                                                    <th>{{ __('sidebar.flats') }}</th>
                                                    <th>{{ __('pages.tbl_action_column') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(count($generatedbills) > 0) {
                                                    $counter = 0;
                                                    foreach($generatedbills as $generatedbill) { $counter++; ?>
                                                <tr>
                                                    <td style="max-width:20px; white-space: normal;">
                                                        <h2 class="table-avatar">
                                                            <a href="#"><?php echo $counter;?></a>
                                                        </h2>
                                                    </td> 
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="#"><?php echo $generatedbill->flat->floor->name;?></a>
                                                        </h2>
                                                    </td>                                                    
                                                    <td style="max-width:220px; white-space: normal;"> <span><?php echo $generatedbill->flat->name; ?></span></td>                                                    
                                                    <td class="">
                                                        <div class="actions">
                                                            <a class="btn btn-sm btn-info" href="{{ route('admin.bills.show', $generatedbill->id) }}">
                                                                <i class="fe fe-eye"></i> {{ __('pages.view') }}
                                                            </a>
                                                            <a class="btn btn-sm bg-success-light" href="{{ route('admin.bills.download', $generatedbill->id) }}">
                                                                <i class="fe fe-pencil"></i> {{ __('pages.download_bill') }}
                                                            </a>
                                                            <a class="btn btn-sm bg-success-light" href="{{ route('admin.billheads.edit', $generatedbill->id) }}">
                                                                <i class="fe fe-pencil"></i> {{ __('pages.edit') }}
                                                            </a>
                                                            <form action="{{ route('admin.billheads.delete', $generatedbill->id) }}" method="post" class="btn-group">
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