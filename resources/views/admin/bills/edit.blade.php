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
                                <h3 class="page-title">{{ __('pages.process_mon_bill') }}</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{ __('sidebar.bills') }}</a></li>
                                    <li class="breadcrumb-item active">{{ __('pages.process_mon_bill') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{ __('pages.individual_bill_detail') }}</h4>
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
                                <form enctype="multipart/form-data"  action="{{ route('admin.bills.update', $bills->id) }}" method="post">
                                        {{ csrf_field() }}
                                       
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.billing_year') }}</label>
                                            <div class="col-md-10">
                                            <select name="billing_year" id="billing_year" class="form-control">
                                                <option value="0" selected disabled>Please Select Year</option>
                                                <?php 
                                                for($i = (int)date("Y"); $i <= 2050; $i++){ 
                                                
                                                ?>
                                                <option value="<?=$i; ?>" <?php if($bills->billing_year == $i) echo "selected=selected"; else echo "";?>>
                                                <?php  echo$i; ?></option>
                                                <?php } ?>
                                            </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.billing_month') }}</label>
                                            <div class="col-md-10">
                                            <select name="billing_month" id="billing_month" class="form-control">
                                                <option value="0" selected disabled>Please Select Month</option>
                                               
                                                <option value="1" <?php if($bills->billing_month == 1) echo "selected=selected"; else echo "";?>>January</option>
                                                <option value="2" <?php if($bills->billing_month == 2) echo "selected=selected"; else echo "";?>>February</option>
                                                <option value="3" <?php if($bills->billing_month == 3) echo "selected=selected"; else echo "";?>>March</option>
                                                <option value="4" <?php if($bills->billing_month == 4) echo "selected=selected"; else echo "";?>>April</option>
                                                <option value="5" <?php if($bills->billing_month == 5) echo "selected=selected"; else echo "";?>>May</option>
                                                <option value="6" <?php if($bills->billing_month == 6) echo "selected=selected"; else echo "";?>>June</option>
                                                <option value="7" <?php if($bills->billing_month == 7) echo "selected=selected"; else echo "";?>>July</option>
                                                <option value="8" <?php if($bills->billing_month == 8) echo "selected=selected"; else echo "";?>>August</option>
                                                <option value="9" <?php if($bills->billing_month == 9) echo "selected=selected"; else echo "";?>>September</option>
                                                <option value="10" <?php if($bills->billing_month == 10) echo "selected=selected"; else echo "";?>>October</option>
                                                <option value="11" <?php if($bills->billing_month == 11) echo "selected=selected"; else echo "";?>>November</option>
                                                <option value="12" <?php if($bills->billing_month == 12) echo "selected=selected"; else echo "";?>>December</option>
                                            </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('sidebar.floors') }}</label>
                                            <div class="col-md-10">
                                            <select name="floor_id" id="floor_id" class="form-control" onchange="getFlatsByFloor(this.value,'flat_id', '')">
                                                <option value="0">Please Select Floor</option>
                                                <?php foreach ($floors as $floor): ?>
                                                <option value="{{$floor->id}}" <?php if($bills->floor_id == $floor->id) echo "selected=selected"; else echo "";?>>
                                                <?php  echo $floor->name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('sidebar.flats') }}</label>
                                            <div class="col-md-10">
                                            <select name="flat_id" id="flat_id" class="form-control">
                                                <option value="0">Please Select Flat</option>
                                                <?php foreach ($flats as $flat): ?>
                                                <option value="{{$flat->id}}" <?php if($bills->flat_id == $flat->id) echo "selected=selected"; else echo "";?>>
                                                <?php  echo $flat->name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            </div>
                                        </div>
                                            
                                        <?php foreach ($billheads as $billhead): 
                                            $value = 0.0;
                                            if($billhead->id == 1){
                                                $value = $bills->col_1;
                                            }
                                            else if($billhead->id == 2){
                                                $value = $bills->col_2;
                                            }
                                            else if($billhead->id == 3){
                                                $value = $bills->col_3;
                                            }
                                            else if($billhead->id == 4){
                                                $value = $bills->col_4;
                                            }
                                            else if($billhead->id == 5){
                                                $value = $bills->col_5;
                                            }
                                            else if($billhead->id == 6){
                                                $value = $bills->col_6;
                                            }
                                            else if($billhead->id == 7){
                                                $value = $bills->col_7;
                                            }
                                            else if($billhead->id == 8){
                                                $value = $bills->col_8;
                                            }
                                            else if($billhead->id == 9){
                                                $value = $bills->col_9;
                                            }
                                            else if($billhead->id == 10){
                                                $value = $bills->col_10;
                                            }
                                            else if($billhead->id == 11){
                                                $value = $bills->col_11;
                                            }
                                            else if($billhead->id == 12){
                                                $value = $bills->col_12;
                                            }
                                            else if($billhead->id == 13){
                                                $value = $bills->col_13;
                                            }
                                            else if($billhead->id == 14){
                                                $value = $bills->col_14;
                                            }
                                            else if($billhead->id == 15){
                                                $value = $bills->col_15;
                                            }
                                            else if($billhead->id == 16){
                                                $value = $bills->col_16;
                                            }
                                            else if($billhead->id == 17){
                                                $value = $bills->col_17;
                                            }
                                            else if($billhead->id == 18){
                                                $value = $bills->col_18;
                                            }
                                            else if($billhead->id == 19){
                                                $value = $bills->col_19;
                                            }
                                            else if($billhead->id == 20){
                                                $value = $bills->col_20;
                                            }
                                            else if($billhead->id == 21){
                                                $value = $bills->col_21;
                                            }
                                            else if($billhead->id == 22){
                                                $value = $bills->col_22;
                                            }
                                            else if($billhead->id == 23){
                                                $value = $bills->col_23;
                                            }
                                            else if($billhead->id == 24){
                                                $value = $bills->col_24;
                                            }
                                            else if($billhead->id == 25){
                                                $value = $bills->col_25;
                                            }
                                            else if($billhead->id == 26){
                                                $value = $bills->col_26;
                                            }
                                            else if($billhead->id == 27){
                                                $value = $bills->col_27;
                                            }
                                            else if($billhead->id == 28){
                                                $value = $bills->col_28;
                                            }

                                            else if($billhead->id == 29){
                                                $value = $bills->col_29;
                                            }
                                            else if($billhead->id == 30){
                                                $value = $bills->col_30;
                                            }
                                            
                                            ?>
                                        <div class="form-group row">
                                        <label class="col-form-label col-md-2"><?php echo $billhead->name; ?></label>
                                        <div class="col-md-10">
                                        <input name="col_{{$billhead->id}}" type="text" value = "{{$value}}" class="form-control" id="col_{{$billhead->id}}">
                                            </div>
                                            </div>
                                        <?php endforeach; ?>

                                        <div class="form-group mb-0">
                                        <button class="btn btn-primary" type="submit">{{ __('pages.update_button') }}</button>
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

<script type="text/javascript">
    function getFlatsByFloor(floor_id , id, selected = '') {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    
    $.ajax({
        url: "{{url('admin/get-flats')}}",
        type: "post",
        data: {
            _token: CSRF_TOKEN,
            floor_id: floor_id
        },
        success: function (json_data) {
            var data = $.parseJSON(json_data);
            var element = '<option value="">Please Select Flat</option>';

            $.each(data, function (index, value) {
              var s = (selected == index) ? "selected" : "";
              element += '<option value="' + index + '" ' + s + '>' + value + '</option>';
            });
            $("#" + id).html(element);
            $('#flat_id').trigger('change');
        },
        error: function (data) {
            console.log("Error: ", data);
        }
    });
}     
</script>