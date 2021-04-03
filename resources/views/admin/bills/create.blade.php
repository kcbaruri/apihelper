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
                                    <h4 class="card-title">{{ __('pages.new_billhead') }}</h4>
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
                                    <form enctype="multipart/form-data" action="{{ url()->route('admin.bills.store') }}" method="post">
                                        {{ csrf_field() }}
                                       
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.billing_year') }}</label>
                                            <div class="col-md-10">
                                            <select name="billing_year" id="billing_year" class="form-control">
                                                <option value="0" selected disabled>Please Select Year</option>
                                                <?php 
                                                for($i = (int)date("Y"); $i <= 2050; $i++){ 
                                                
                                                ?>
                                                <option value="<?=$i; ?>">
                                                <?php  echo$i; ?></option>
                                                <?php } ?>
                                            </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.billing_month') }}</label>
                                            <div class="col-md-10">
                                            <select name="billing_month" id="billing_month" class="form-control" onchange="getFlatsByFloor(this.value,'flat_id', '')">
                                                <option value="0" selected disabled>Please Select Month</option>
                                               
                                                <option value="1">January</option>
                                                <option value="2">February</option>
                                                <option value="3">March</option>
                                                <option value="4">April</option>
                                                <option value="5">May</option>
                                                <option value="6">June</option>
                                                <option value="7">July</option>
                                                <option value="8">August</option>
                                                <option value="9">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('sidebar.floors') }}</label>
                                            <div class="col-md-10">
                                            <select name="floor_id" id="floor_id" class="form-control" onchange="getFlatsByFloor(this.value,'flat_id', '')">
                                                <option value="0" selected disabled>Please Select Floor</option>
                                                <?php foreach ($floors as $floor): ?>
                                                <option value="{{$floor->id}}">
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
                                                <option value="{{$flat->id}}">
                                                <?php  echo $flat->name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            </div>
                                        </div>
                                            
                                        <?php foreach ($billheads as $billhead): ?>
                                        <div class="form-group row">
                                        <label class="col-form-label col-md-2"><?php echo $billhead->name; ?></label>
                                        <div class="col-md-10">
                                        <input name="col_{{$billhead->id}}" type="text" class="form-control" id="col_{{$billhead->id}}">
                                            </div>
                                            </div>
                                        <?php endforeach; ?>

                                        <div class="form-group mb-0">
                                        <button class="btn btn-primary" type="submit">{{ __('pages.save_button') }}</button>
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