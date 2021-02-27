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
                                <h3 class="page-title">{{ __('sidebar.vhandrpt') }}</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{ __('sidebar.dashboard') }}</a></li>
                                    <li class="breadcrumb-item"><a href="javascript:(0);">{{ __('sidebar.vhandrpt') }}</a></li>
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
                                        <form action="{{ route('admin.vata-handover-report') }}" method="get">
                                                                                       
                                            <div class="row">
                                                
                                                <div class="col-md-2 p-0">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control" placeholder="Citizen Name" id="name" name="name" value="<?php echo Request::get('name');?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 p-0">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <select name="year" id="year" class="form-control">
                                                            <option value="">Select Year</option>
                                                            <?php 
                                                            for($i = 2020;$i<2050;$i++){
                                                            ?><option value="<?php echo $i;?>"<?php if($i == Request::get('year')) echo "selected=selected"; else echo "";?>><?php echo $i;?></option><?php
                                                            }
                                                            ?>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 p-0">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <select name="month" id="month" class="form-control">
                                                            <option value="">Select Month</option>
                                                            <option value="January" <?php if(Request::get('month') == "January") echo "selected=selected"; else echo "";?>>January</option>
                                                            <option value="February" <?php if(Request::get('month') == "February") echo "selected=selected"; else echo "";?>>February</option>
                                                            <option value="March" <?php if(Request::get('month') == "March") echo "selected=selected"; else echo "";?>>March</option>
                                                            <option value="April" <?php if(Request::get('month') == "April") echo "selected=selected"; else echo "";?>>April</option>
                                                            <option value="May" <?php if(Request::get('month') == "May") echo "selected=selected"; else echo "";?>>May</option>
                                                            <option value="June" <?php if(Request::get('month') == "June") echo "selected=selected"; else echo "";?>>June</option>
                                                            <option value="July" <?php if(Request::get('month') == "July") echo "selected=selected"; else echo "";?>>July</option>
                                                            <option value="August" <?php if(Request::get('month') == "August") echo "selected=selected"; else echo "";?>>August</option>
                                                            <option value="September" <?php if(Request::get('month') == "September") echo "selected=selected"; else echo "";?>>September</option>
                                                            <option value="October" <?php if(Request::get('month') == "October") echo "selected=selected"; else echo "";?>>October</option>
                                                            <option value="November" <?php if(Request::get('month') == "November") echo "selected=selected"; else echo "";?>>November</option>
                                                            <option value="December" <?php if(Request::get('month') == "December") echo "selected=selected"; else echo "";?>>December</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 p-0">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <select id="division_id" name="division_id" class="form-control" onchange="getDistrict(this.value,'district_id','')">
                                                            <option value="">Select Division</option>
                                                            @foreach ($divisions as $var)
                                                            <option value="{{ $var->id }}" <?php if($var->id == Request::get('division_id')) echo "selected=selected"; else echo "";?>>{{ $var->name }}</option>
                                                            @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>    
                                                <div class="col-md-2 p-0">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <select id="district_id" name="district_id" class="form-control" onchange="getThana(this.value,'thana_id','')">
                                                            <option value="">Select District</option>
                                                            @foreach ($districts as $var)
                                                            <option value="{{ $var->id }}" <?php if($var->id == Request::get('district_id')) echo "selected=selected"; else echo "";?>>{{ $var->name }}</option>
                                                            @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 p-0">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <select id="thana_id" name="thana_id" class="form-control" onchange="getUnion(this.value,'union_id','')">
                                                            <option value="">Select Thana</option>
                                                            @foreach ($thanas as $var)
                                                            <option value="{{ $var->id }}" <?php if($var->id == Request::get('thana_id')) echo "selected=selected"; else echo "";?>>{{ $var->name }}</option>
                                                            @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 p-0">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <select id="union_id" name="union_id" class="form-control">
                                                            <option value="">Select Union</option>
                                                            @foreach ($unions as $var)
                                                            <option value="{{ $var->id }}" <?php if($var->id == Request::get('union_id')) echo "selected=selected"; else echo "";?>>{{ $var->name }}</option>
                                                            @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 p-0">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control" placeholder="From" id="from_date" name="from_date" value="<?php echo Request::get('from_date');?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 p-0">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control" placeholder="To" id="to_date" name="to_date" value="<?php echo Request::get('to_date');?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 p-0">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <button class="btn btn-primary" type="submit" name="search" value="search">{{ __('pages.search') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 p-0">
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
                                                    <th>{{ __('pages.tbl_name_column') }}</th>
                                                    <th>{{ __('sidebar.unions') }}</th>
                                                    <th>{{ __('sidebar.upazilas') }}</th>
                                                    <th>{{ __('sidebar.districts') }}</th>
                                                    <th>{{ __('sidebar.divisions') }}</th>
                                                    <th>{{ __('pages.tbl_year_column') }}</th>
                                                    <th>{{ __('pages.tbl_month_column') }}</th>
                                                    <th>{{ __('pages.tbl_amount_column') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(count($handovers) > 0) {
                                                    foreach($handovers as $var) {?>
                                                <tr>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="#"><?php echo $var->name;?></a>
                                                        </h2>
                                                    </td>
                                                    <td><?php echo $var->union_name;?></td>
                                                    <td><?php echo $var->thana_name;?></td>
                                                    <td><?php echo $var->district_name;?></td>
                                                    <td><?php echo $var->division_name;?></td>
                                                    <td><?php echo $var->year;?></td>
                                                    <td><?php echo $var->month;?></td>
                                                    <td><?php echo $var->amount;?></td>
                                                </tr>
                                            <?php } }
                                                else 
                                                echo "<tr><td colspan=8>No Data Found</td></tr>";?>
                                               
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
<script>
$( function() {
$( "#from_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
$( "#to_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
} );
</script>
<script type="text/javascript">
function getDistrict(division_id, id, selected = '') {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: "{{url('admin/get-district')}}",
        type: "post",
        data: {
            _token: CSRF_TOKEN,
            division_id: division_id
        },
        success: function (json_data) {
            var data = $.parseJSON(json_data);
            var element = '<option value="">Select District</option>';

            $.each(data, function (index, value) {
              var s = (selected == index) ? "selected" : "";
              element += '<option value="' + index + '" ' + s + '>' + value + '</option>';
            });
            $("#" + id).html(element);
        },
        error: function (data) {
            console.log("Error: ", data);
        }
    });
}

function getThana(district_id, id, selected = '') {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: "{{url('admin/get-thana')}}",
        type: "post",
        data: {
            _token: CSRF_TOKEN,
            district_id: district_id
        },
        success: function (json_data) {
            var data = $.parseJSON(json_data);
            var element = '<option value="">Select Thana</option>';

            $.each(data, function (index, value) {
              var s = (selected == index) ? "selected" : "";
              element += '<option value="' + index + '" ' + s + '>' + value + '</option>';
            });
            $("#" + id).html(element);
            $('#thana_id').trigger('change');
        },
        error: function (data) {
            console.log("Error: ", data);
        }
    });
}

function getUnion(thana_id, id, selected = '') {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: "{{url('admin/get-union')}}",
        type: "post",
        data: {
            _token: CSRF_TOKEN,
            thana_id: thana_id
        },
        success: function (json_data) {
            var data = $.parseJSON(json_data);
            var element = '<option value="">Select Union</option>';

            $.each(data, function (index, value) {
              var s = (selected == index) ? "selected" : "";
              element += '<option value="' + index + '" ' + s + '>' + value + '</option>';
            });
            $("#" + id).html(element);
            $('#union_id').trigger('change');
        },
        error: function (data) {
            console.log("Error: ", data);
        }
    });
}

function getVillage(union_id, id, selected = '') {
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$.ajax({
url: "{{url('admin/get-village')}}",
type: "post",
data: {
    _token: CSRF_TOKEN,
    union_id: union_id
},
success: function (json_data) {
    var data = $.parseJSON(json_data);
    var element = '<option value="">Select Union</option>';

    $.each(data, function (index, value) {
      var s = (selected == index) ? "selected" : "";
      element += '<option value="' + index + '" ' + s + '>' + value + '</option>';
    });
    $("#" + id).html(element);
},
error: function (data) {
    console.log("Error: ", data);
}
});
}
</script>
@endsection