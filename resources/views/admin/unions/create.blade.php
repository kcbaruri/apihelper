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
                                <h3 class="page-title">{{ __('sidebar.unions') }}</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{ __('sidebar.unions') }}</a></li>
                                    <li class="breadcrumb-item active">{{ __('pages.add_union') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{ __('pages.new_union') }}</h4>
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
                                    <form action="{{ url()->route('admin.unions.store') }}" method="post">
                                        {{ csrf_field() }}
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.tbl_name_column') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Name" id="name" name="name" required="required" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('sidebar.divisions') }}</label>
                                            <div class="col-md-10">
                                                <select name="division_id" id="division_id" class="form-control" required="required" onchange="getDistrict(this.value,'district_id','')">
                                                <option value="">Select</option>
                                                @foreach ($divisions as $var)
                                                <option value="{{ $var->id }}">{{ $var->name }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('sidebar.districts') }}</label>
                                            <div class="col-md-10">
                                                <select name="district_id" id="district_id" class="form-control" required="required" onchange="getThana(this.value,'thana_id','')">
                                                <option value="">Select Division First</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('sidebar.upazilas') }}</label>
                                            <div class="col-md-10">
                                                <select name="thana_id" id="thana_id" class="form-control" required="required">
                                                <option value="">Select District First</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.tbl_description_column') }}</label>
                                            <div class="col-md-10">
                                            <textarea class="form-control" rows ="6" placeholder="Description" id="description" name="description"></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.show_in_list') }}</label>
                                            <div class="col-md-10">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="status" class="radio" value="1" checked="checked"> Yes
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="status" class="radio" value="0"> No
                                                    </label>
                                                </div>                                  
                                        
                                            </div>
                                        </div>
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
                    $('#district_id').trigger('change');
                },
                error: function (data) {
                    console.log("Error: ", data);
                }
            });
            }
            </script>
            <script type="text/javascript">
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
            </script>
           
@endsection