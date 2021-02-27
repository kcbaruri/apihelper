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
                            <div class="col">
                                <h3 class="page-title">{{ __('sidebar.citizens') }}</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{ __('sidebar.citizens') }}</a></li>
                                    <li class="breadcrumb-item active">{{ __('pages.vata_handover') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{ __('pages.vata_handover') }}</h4>
                                </div>
                                @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                <div class="alert alert-card alert-danger" role="alert">
                                    <strong>{{$error}} </strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endforeach
                                @endif
                                <div class="card-body">
                                    <form action="{{ url()->route('admin.citizens.store-handover') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="citizen_id" value="<?php echo $citizen->id;?>">
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.tbl_name_column') }}</label>
                                            <div class="col-md-10">
                                                <?php echo $citizen->name;?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('sidebar.vatatypes') }}</label>
                                            <div class="col-md-10">
                                                <?php echo $citizen->vatatype->name;?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.select_year') }}</label>
                                            <div class="col-md-10">
                                                <select name="year" id="year" class="form-control" required="required">
                                                    <?php 
                                                    for($i = 2020;$i<2050;$i++){
                                                        ?><option value="<?php echo $i;?>"><?php echo $i;?></option><?php
                                                    }
                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.select_month') }}</label>
                                            <div class="col-md-10">
                                                <select name="month" id="month" class="form-control" required="required">
                                                    <option value="January">January</option>
                                                    <option value="February">February</option>
                                                    <option value="March">March</option>
                                                    <option value="April">April</option>
                                                    <option value="May">May</option>
                                                    <option value="June">June</option>
                                                    <option value="July">July</option>
                                                    <option value="August">August</option>
                                                    <option value="September">September</option>
                                                    <option value="October">October</option>
                                                    <option value="November">November</option>
                                                    <option value="December">December</option>
                                                </select>
                                            </div>
                                        </div>
                                       
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.handover_amount') }}</label>
                                            <div class="col-md-10">
                                                <input type="number" class="form-control" placeholder="Handover Amount" id="amount" name="amount" required="required" value="">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group mb-0">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                
                </div>          
            </div>
            <!-- /Main Wrapper -->
        
        </div>
        <!-- /Main Wrapper -->
@endsection
@section('pagescript')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( function() {
$( "#dob" ).datepicker({ dateFormat: 'yy-mm-dd' });
$( "#last_vata_receive_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
} );
</script>

<script type="text/javascript">

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