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
                                <h3 class="page-title">{{ __('pages.vata_receiver_details') }}</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{ __('pages.vata_receiver_info') }}</a></li>
                                    <li class="breadcrumb-item active">{{ __('pages.vata_receiver_details') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{ __('pages.vata_receiver_info') }}</h4>
                                </div>
                                
                                <div class="card-body">
      
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.tbl_name_column') }}</label>
                                            <div class="col-md-10">
                                                <?php echo $citizen->name;?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.gender') }}</label>
                                            <div class="col-md-10">
                                                <?php echo $citizen->sex;?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.nid') }}</label>
                                            <div class="col-md-10">
                                                <?php echo $citizen->nid;?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.dob') }}</label>
                                            <div class="col-md-10">
                                                <?php echo date('d-m-Y',strtotime($citizen->dob));?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.blood_group') }}</label>
                                            <div class="col-md-10">
                                                <?php echo $citizen->blood_group;?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.religion') }}</label>
                                            <div class="col-md-10">
                                                <?php echo $citizen->religion;?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.spouse_name') }}</label>
                                            <div class="col-md-10">
                                                <?php echo $citizen->spouse_name;?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.is_alive') }}</label>
                                            <div class="col-md-10">
                                                <?php echo ($citizen->is_spouse_alive == 1) ? "Yes" : "No";?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.photo') }}</label>
                                            <div class="col-md-10">
                                                <img style="border-radius: 50%;" src="<?php echo asset($citizen->image);?>" width="100px" height="100px">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.profession') }}</label>
                                            <div class="col-md-10">
                                                <?php echo $professionArray[$citizen->profession_id];?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.monthly_income') }}</label>
                                            <div class="col-md-10">
                                                <?php echo $citizen->monthly_income;?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.annual_income') }}</label>
                                            <div class="col-md-10">
                                                <?php echo $citizen->annual_income;?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('sidebar.vatatypes') }}</label>
                                            <div class="col-md-10">
                                                <?php echo $citizen->vatatype->name;?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.allocated_amount') }}</label>
                                            <div class="col-md-10">
                                                <?php echo $citizen->receive_amount;?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.book_number') }}</label>
                                            <div class="col-md-10">
                                                <?php echo $citizen->vata_book_number;?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.bank_account_number') }}</label>
                                            <div class="col-md-10">
                                                <?php echo $citizen->bank_account_number;?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.bank_name') }}</label>
                                            <div class="col-md-10">
                                                <?php echo $citizen->bank;?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.branch_name') }}</label>
                                            <div class="col-md-10">
                                                <?php echo $citizen->bank_branch;?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.last_receiving_date') }}</label>
                                            <div class="col-md-10">
                                                <?php echo date('d-m-Y',strtotime($citizen->last_vata_receive_date));?>
                                            </div>
                                        </div>
                                       
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.father_name') }}</label>
                                            <div class="col-md-10">
                                                <?php echo $citizen->father_name;?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.mother_name') }}</label>
                                            <div class="col-md-10">
                                                <?php echo $citizen->mother_name;?>
                                            </div>
                                        </div>
                                       
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('sidebar.divisions') }}</label>
                                            <div class="col-md-10">
                                                <?php echo $citizen->division->name;?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('sidebar.districts') }}</label>
                                            <div class="col-md-10">
                                                <?php echo $citizen->district->name;?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('sidebar.upazilas') }}</label>
                                            <div class="col-md-10">
                                                <?php echo $citizen->thana->name;?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('sidebar.unions') }}</label>
                                            <div class="col-md-10">
                                                <?php echo $citizen->union->name;?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('sidebar.wards') }}</label>
                                            <div class="col-md-10">
                                                <?php echo "Ward - ".$citizen->ward;?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('sidebar.villages') }}</label>
                                            <div class="col-md-10">
                                                <?php echo $citizen->village->name;?>
                                            </div>
                                        </div>

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