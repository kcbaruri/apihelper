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
                                <h3 class="page-title">{{ __('sidebar.flatowners') }}</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{ __('sidebar.dashboard') }}</a></li>
                                    <li class="breadcrumb-item"><a href="javascript:(0);">{{ __('sidebar.flatowners') }}</a></li>
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
                                        <a class="btn btn-primary" data-toggle="" href="{{ route('admin.flatowners.create') }}">
                                            <i class="fa fa-plus"> </i> <span>{{ __('pages.add_new') }} </span>
                                        </a>
                                    </div> -->
                                    
                                        <form action="{{ route('admin.flatowners') }}" method="get">
                                        <div class="table-responsive">                                              
                                                <table width ="100%">
                                                    <tr>
                                                    <td>{{ __('sidebar.floors') }}</td>
                                                    <td>
                                                    <select name="floor_id" class="form-control" required="required">
                                                                    <option value="0">All</option>
                                                                    @foreach ($floors as $var)
                                                                    <option value="{{ $var->id }}">{{ $var->name }}</option>
                                                                    @endforeach
                                                                    </select>
                                                    </td>
                                                    <td>{{ __('sidebar.flats') }}</td>
                                                    <td><select name="flat_id" class="form-control" required="required">
                                                                    <option value="0">All</option>
                                                                    @foreach ($flats as $var)
                                                                    <option value="{{ $var->id }}">{{ $var->name }}</option>
                                                                    @endforeach
                                                                    </select>
                                                    </td>
                                                    <td><button class="btn btn-primary" type="submit">{{ __('pages.search') }}</button></td>
                                                    <td><button class="btn btn-primary" type="submit">{{ __('pages.download') }}</button></td>
                                                    </tr>
                                            </table>
                                        </div>
                                        </form>
                                   
                                    <div class="table-responsive">
                                        <table class="datatable table table-hover table-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('pages.tbl_sl_number_column') }}</th>
                                                    <th>{{ __('pages.tbl_photo_column') }}</th>
                                                    <th>{{ __('pages.tbl_name_column') }}</th>
                                                    <th>{{ __('pages.mobile_no') }}</th>
                                                    <th>{{ __('pages.nid') }}</th>
                                                    <th>{{ __('pages.tbl_action_column') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(count($flatowners) > 0) {
                                                    $conuter  = 0;
                                                    foreach($flatowners as $flatowner) {  $conuter++;?>
                                                <tr>
                                                     <td>
                                                        <?php echo $conuter;?>
                                                    </td>
                                                    <td>
                                                         <img style="border-radius: 50%;" src="<?php echo asset($flatowner->photo);?>" width="100px" height="100px">
                                                    </td>    
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="#"><?php echo $flatowner->name;?></a>
                                                        </h2>
                                                    </td>                                     
                                                     <td><?php echo $flatowner->mobile_number;?></td>              
                                                    <td><?php echo $flatowner->nid;?></td>
                                                    <td class="">
                                                        <div class="actions">
                                                            <a class="btn btn-sm btn-info" href="{{ route('admin.flatowners.view', $flatowner->id) }}">
                                                                <i class="fe fe-eye"></i> {{ __('pages.download_single') }}
                                                            </a>
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