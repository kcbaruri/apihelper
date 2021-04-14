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
                                <h3 class="page-title">{{ __('sidebar.flats') }}</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{ __('sidebar.dashboard') }}</a></li>
                                    <li class="breadcrumb-item"><a href="javascript:(0);">{{ __('sidebar.flats') }}</a></li>
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
                                    
                                    <div class="search-area">
                                        <h2>{{ __('pages.search') }}</h2>
                                        <form action="{{ route('admin.reports.flats.list') }}" method="get">
                                                                                       
                                            <div class="row">
                                                <div class="col-md-4 p-0">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <select id="floor_id" name="floor_id" class="form-control">
                                                            <option value="">Select Floor</option>
                                                            @foreach ($floors as $var)
                                                            <option value="{{ $var->id }}" <?php if($var->id == Request::get('floor_id')) echo "selected=selected"; else echo "";?>>{{ $var->name }}</option>
                                                            @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 p-0">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <button class="btn btn-primary" type="submit">{{ __('pages.search') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 p-0 float-left">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <button class="btn btn-primary" type="submit" name="search" value="download">{{ __('pages.download') }}</button>
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
                                                    <th>{{ __('pages.tbl_sl_number_column') }}</th>
                                                    <th>{{ __('pages.tbl_name_column') }}</th>
                                                    <th>{{ __('sidebar.floors') }}</th>
                                                    <th>{{ __('pages.flatowner_name') }}</th>
                                                    <th>{{ __('sidebar.tenants') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(count($flats) > 0) {
                                                    $counter = 0;
                                                    foreach($flats as $flat) { $counter++; ?>
                                                <tr>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="#"><?php echo $counter;?></a>
                                                        </h2>
                                                    </td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="#"><?php echo $flat->name;?></a>
                                                        </h2>
                                                    </td>
                                                    <td><?php echo $flat->floor_name;?></td>
                                                    <td style="max-width:220px; white-space: normal;"><?php  echo $flat->owner_name; ?></td>                                                    
                                                    <td class="">
                                                    <h2 class="table-avatar">
                                                            <a href="#"><?php   echo  $flat->tenant_name;?></a>
                                                        </h2>
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