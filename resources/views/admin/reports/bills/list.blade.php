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
                                    
                                        <form action="{{ route('admin.bills.filteredlist') }}" method="get">
                                        <div class="table-responsive">                                              
                                                <table width ="100%">
                                                    <tr>
                                                    <td width ="20%" style = "text-align:center;">{{ __('sidebar.floors') }}
                                                    <select name="floor_id" class="form-control" required="required">
                                                                    <option value="0">All</option>
                                                                    @foreach ($floors as $var)
                                                                    <option value="{{ $var->id }}">{{ $var->name }}</option>
                                                                    @endforeach
                                                                    </select>
                                                    </td>
                                                    <td width ="20%" style = "text-align:center;">{{ __('sidebar.flats') }}<select name="flat_id" class="form-control" required="required">
                                                                    <option value="0">All</option>
                                                                    @foreach ($flats as $var)
                                                                    <option value="{{ $var->id }}">{{ $var->name }}</option>
                                                                    @endforeach
                                                                    </select>
                                                    </td>
                                                    <td width ="15%" style = "text-align:center;">{{ __('pages.from_date') }}<input type="text" class="form-control" placeholder="From Date" id="from_date" name="from_date" value=""></td>
                                                    <td width ="15%" style = "text-align:center;">{{ __('pages.to_date') }}<input type="text" class="form-control" placeholder="To date" id="to_date" name="to_date"  value=""></td>
                                                    <td width ="15%" style = "text-align:center;"><button class="btn btn-primary" name ="operation_type" value ="search" type="submit">{{ __('pages.search') }}</button></td>
                                                    <td width ="15%" style = "text-align:center;"><button class="btn btn-primary" name ="operation_type", value = "download" type="submit">{{ __('pages.download') }}</button></td>
                                                    </tr>
                                            </table>
                                        </div>
                                        </form>
                                   
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
                                                <?php if(count($generatedbill) > 0) {
                                                    $counter = 0;
                                                    foreach($generatedbill as $generatedbill) { $counter++; ?>
                                                <tr>
                                                    <td style="max-width:20px; white-space: normal;">
                                                        <h2 class="table-avatar">
                                                            <a href="#"><?php echo $counter;?></a>
                                                        </h2>
                                                    </td> 
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="#"><?php if(($generatedbill->flat != NULL) && ($generatedbill->flat->floor != NULL)) echo $generatedbill->flat->floor->name;?></a>
                                                        </h2>
                                                    </td>                                                    
                                                    <td style="max-width:220px; white-space: normal;"> <span><?php if($generatedbill->flat != NULL) echo $generatedbill->flat->name; ?></span></td>                                                    
                                                    <td class="">
                                                        <div class="actions">
                                                            <a class="btn btn-sm btn-info" href="{{ route('admin.bills.show', $generatedbill->id) }}">
                                                                <i class="fe fe-eye"></i> {{ __('pages.view') }}
                                                            </a>
                                                            <a class="btn btn-sm bg-success-light" href="{{ route('admin.bills.download', $generatedbill->id) }}">
                                                                <i class="fe fe-pencil"></i> {{ __('pages.download_bill') }}
                                                            </a>
                                                            <a class="btn btn-sm bg-success-light" href="{{ route('admin.bills.edit', $generatedbill->id) }}">
                                                                <i class="fe fe-pencil"></i> {{ __('pages.edit') }}
                                                            </a>
                                                            <form action="{{ route('admin.bills.delete', $generatedbill->id) }}" method="post" class="btn-group">
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
@section('pagescript')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
$( function() {
$( "#from_date").datepicker({ dateFormat: 'yy-mm-dd' });
$( "#to_date").datepicker({ dateFormat: 'yy-mm-dd' });
} );

</script>
@endsection