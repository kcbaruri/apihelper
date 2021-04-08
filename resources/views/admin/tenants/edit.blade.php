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
                                <h3 class="page-title">{{ __('sidebar.tenants') }}</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{ __('sidebar.tenants') }}</a></li>
                                    <li class="breadcrumb-item active">{{ __('pages.add_tenant') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{ __('pages.new_tenant') }}</h4>
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
                                    <form action="{{ url()->route('admin.tenants.update', $tenant->id) }}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.tbl_name_column') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Name" id="name" name="name" required="required" value="{{$tenant->name}}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.is_master') }}</label>
                                            <div class="col-md-10">
                                                <label class="switch">
                                                <input type="checkbox" name="is_master" id="is_master" <?php if($tenant->is_master == 1) echo "checked=checked"; ?> on-change="showHideControls()">
                                                <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group row hiden_class show_parent_dropdown">
                                            <label class="col-form-label col-md-2">{{ __('pages.family_head') }}</label>
                                            <div class="col-md-10">
                                            <select name="family_head_id" id="family_head_id" class="form-control btn btn-secondary dropdown-toggle">
                                            <option value="" selected>-- Select One --</option>
                                            @foreach($familyheads as $id=>$familyhead)
                                                <option value="{{$id}}" <?php if($tenant->family_head_id == $id) echo "selected=selected"; ?>>{{$familyhead}}</option>
                                            @endforeach
                                            </select>

                                            </div>
                                        </div>

                                        <div class="form-group row hiden_class" style ="display: none;">
                                            <label class="col-form-label col-md-2">{{ __('pages.is_flat_owner') }}</label>
                                            <div class="col-md-10">
                                                <select name="is_flat_owner" id="is_flat_owner" class="form-control">
                                                    <option value="1" <?php if($tenant->is_flat_owner == 1) echo "selected=selected"; ?>>Yes</option>
                                                    <option value="0" <?php if($tenant->is_flat_owner == 0) echo "selected=selected"; ?>>No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row hiden_class" style ="display: none;">
                                            <label class="col-form-label col-md-2">{{ __('pages.floor') }}</label>
                                            <div class="col-md-10">
                                            <select name="floor_id" id="floor_id" class="form-control btn btn-secondary dropdown-toggle">
                                            <option value="" selected>-- Select One --</option>
                                            @foreach($floors as $id=>$floor)
                                                <option value="{{$id}}">{{$floor}}</option>
                                            @endforeach
                                            </select>

                                            </div>
                                        </div>

                                        <div class="form-group row hiden_class" style ="display: none;">
                                            <label class="col-form-label col-md-2">{{ __('pages.flat') }}</label>
                                            <div class="col-md-10">
                                            <select name="flat_id" id="flat_id" class="form-control btn btn-secondary dropdown-toggle">
                                            <option value="" selected>-- Select One --</option>
                                            @foreach($flats as $id=>$flat)
                                                <option value="{{$flat->id}}">{{$flat->name}}</option>
                                            @endforeach
                                            </select>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.gender') }}</label>
                                            <div class="col-md-10">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="gender" class="radio" value="Male" checked="checked"> Male
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="gender" class="radio" value="Female"> Female
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="gender" class="radio" value="Other"> Other
                                                    </label>
                                                </div>                          
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.nid') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="National id number" id="nid" name="nid"  value="{{$tenant->nid}}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.dob') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Date of birth" id="dob" name="dob" required="required" value="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.blood_group') }}</label>
                                            <div class="col-md-10">
                                                <select name="blood_group" id="blood_group" class="form-control">
                                                    <option value="0">-- Select One --</option>
                                                    <option value="A+">A+</option>
                                                    <option value="A-">A-</option>
                                                    <option value="B+">B+</option>
                                                    <option value="B-">B-</option>
                                                    <option value="AB+">AB+</option>
                                                    <option value="AB-">AB-</option>
                                                    <option value="O+">O+</option>
                                                    <option value="O-">O-</option>
                                                </select>
                                                    
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row hiden_class" style ="display: none;">
                                            <label class="col-form-label col-md-2">{{ __('pages.religion') }}</label>
                                            <div class="col-md-10">
                                                <select name="religion" id="religion" class="form-control">
                                                    <option value="0">-- Select One --</option>
                                                    <option value="1">Buddism</option>
                                                    <option value="2">Hinduism</option>
                                                    <option value="3">Christanity</option>
                                                    <option value="4">Islam</option>
                                                </select>
                                                    
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.photo') }}</label>
                                            <div class="col-md-10">
                                                <input type="file" class="form-control" placeholder="Name" id="photo" name="photo">
                                            </div>
                                        </div>

                                        <div class="form-group row hiden_class" style ="display: none;">
                                            <label class="col-form-label col-md-2">{{ __('pages.profession') }}</label>
                                            <div class="col-md-10">
                                            <fieldset>
                                            <select class="form-control dropdown" id="profession_id" name="profession_id">
                                                <option value="0" selected="selected" disabled="disabled">-- Select One --</option>
                                                <optgroup label="Healthcare Practitioners and Technical Occupations:">
                                                <option value="1">-  Chiropractor</option>
                                                <option value="2">-  Dentist</option>
                                                <option value="3">-  Dietitian or Nutritionist</option>
                                                <option value="4">-  Optometrist</option>
                                                <option value="5">-  Pharmacist</option>
                                                <option value="6">-  Physician</option>
                                                <option value="7">-  Physician Assistant</option>
                                                <option value="8">-  Podiatrist</option>
                                                <option value="9">-  Registered Nurse</option>
                                                <option value="10">-  Therapist</option>
                                                <option value="11">-  Veterinarian</option>
                                                <option value="12">-  Health Technologist or Technician</option>
                                                <option value="13">-  Other Healthcare Practitioners and Technical Occupation</option>
                                                </optgroup>
                                                <optgroup label="Healthcare Support Occupations:">
                                                <option value="14">-  Nursing, Psychiatric, or Home Health Aide</option>
                                                <option value="15">-  Occupational and Physical Therapist Assistant or Aide</option>
                                                <option value="16">-  Other Healthcare Support Occupation</option>
                                                </optgroup>
                                                <optgroup label="Business, Executive, Management, and Financial Occupations:">
                                                <option value="17">-  Chief Executive</option>
                                                <option value="18">-  General and Operations Manager</option>
                                                <option value="19">-  Advertising, Marketing, Promotions, Public Relations, and Sales Manager</option>
                                                <option value="20">-  Operations Specialties Manager (e.g., IT or HR Manager)</option>
                                                <option value="21">-  Construction Manager</option>
                                                <option value="22">-  Engineering Manager</option>
                                                <option value="23">-  Accountant, Auditor</option>
                                                <option value="24">-  Business Operations or Financial Specialist</option>
                                                <option value="25">-  Business Owner</option>
                                                <option value="26">-  Other Business, Executive, Management, Financial Occupation</option>
                                                </optgroup>
                                                <optgroup label="Architecture and Engineering Occupations:">
                                                <option value="27">-  Architect, Surveyor, or Cartographer</option>
                                                <option value="28">-  Engineer</option>
                                                <option value="29">-  Other Architecture and Engineering Occupation</option>
                                                </optgroup>
                                                <optgroup label="Education, Training, and Library Occupations:">
                                                <option value="30">-  Postsecondary Teacher (e.g., College Professor)</option>
                                                <option value="31">-  Primary, Secondary, or Special Education School Teacher</option>
                                                <option value="32">-  Other Teacher or Instructor</option>
                                                <option value="33">-  Other Education, Training, and Library Occupation</option>
                                                </optgroup>
                                                <optgroup label="Other Professional Occupations:">
                                                <option value="34">-  Arts, Design, Entertainment, Sports, and Media Occupations</option>
                                                <option value="35">-  Computer Specialist, Mathematical Science</option>
                                                <option value="36">-  Counselor, Social Worker, or Other Community and Social Service Specialist</option>
                                                <option value="37">-  Lawyer, Judge</option>
                                                <option value="38">-  Life Scientist (e.g., Animal, Food, Soil, or Biological Scientist, Zoologist)</option>
                                                <option value="39">-  Physical Scientist (e.g., Astronomer, Physicist, Chemist, Hydrologist)</option>
                                                <option value="40">-  Religious Worker (e.g., Clergy, Director of Religious Activities or Education)</option>
                                                <option value="41">-  Social Scientist and Related Worker</option>
                                                <option value="42">-  Other Professional Occupation</option>
                                                </optgroup>
                                                <optgroup label="Office and Administrative Support Occupations:">
                                                <option value="43">-  Supervisor of Administrative Support Workers</option>
                                                <option value="44">-  Financial Clerk</option>
                                                <option value="45">-  Secretary or Administrative Assistant</option>
                                                <option value="46">-  Material Recording, Scheduling, and Dispatching Worker</option>
                                                <option value="47">-  Other Office and Administrative Support Occupation</option>
                                                </optgroup>
                                                <optgroup label="Services Occupations:">
                                                <option value="48">-  Protective Service (e.g., Fire Fighting, Police Officer, Correctional Officer)</option>
                                                <option value="49">-  Chef or Head Cook</option>
                                                <option value="50">-  Cook or Food Preparation Worker</option>
                                                <option value="51">-  Food and Beverage Serving Worker (e.g., Bartender, Waiter, Waitress)</option>
                                                <option value="52">-  Building and Grounds Cleaning and Maintenance</option>
                                                <option value="53">-  Personal Care and Service (e.g., Hairdresser, Flight Attendant, Concierge)</option>
                                                <option value="54">-  Sales Supervisor, Retail Sales</option>
                                                <option value="55">-  Retail Sales Worker</option>
                                                <option value="56">-  Insurance Sales Agent</option>
                                                <option value="57">-  Sales Representative</option>
                                                <option value="58">-  Real Estate Sales Agent</option>
                                                <option value="59">-  Other Services Occupation</option>
                                                </optgroup>
                                                <optgroup label="Agriculture, Maintenance, Repair, and Skilled Crafts Occupations:">
                                                <option value="60">-  Construction and Extraction (e.g., Construction Laborer, Electrician)</option>
                                                <option value="61">-  Farming, Fishing, and Forestry</option>
                                                <option value="62">-  Installation, Maintenance, and Repair</option>
                                                <option value="63">-  Production Occupations</option>
                                                <option value="64">-  Other Agriculture, Maintenance, Repair, and Skilled Crafts Occupation</option>
                                                </optgroup>
                                                <optgroup label="Transportation Occupations:">
                                                <option value="65">-  Aircraft Pilot or Flight Engineer</option>
                                                <option value="66">-  Motor Vehicle Operator (e.g., Ambulance, Bus, Taxi, or Truck Driver)</option>
                                                <option value="67">-  Other Transportation Occupation</option>
                                                </optgroup>
                                                <optgroup label="Other Occupations:">
                                                <option value="68">-  Military</option>
                                                <option value="69">-  Homemaker</option>
                                                <option value="70">-  Other Occupation</option>
                                                <option value="71">-  Don't Know</option>
                                                <option value="72">-  Not Applicable</option>
                                                </optgroup>
                                            </select>
                                            </fieldset>
                                            </div>
                                        </div>

                                       
                                        <div class="form-group row hiden_class" style ="display: none;">
                                            <label class="col-form-label col-md-2">{{ __('pages.notice_period_in_month') }}</label>
                                            <div class="col-md-10">
                                                <select name="notice_period_in_month" id="notice_period_in_month" class="form-control">
                                                    <option value="0">-- Select One --</option>
                                                    <option value="1">One Month</option>
                                                    <option value="2">Two Month</option>
                                                    <option value="3">Three Month</option>
                                                    <option value="4">Four Month</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.mobile_no') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Mobile number" id="mobile_number" name="mobile_number" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.email') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Email" id="email" name="email" value="">
                                            </div>
                                        </div>

                                        <div class="form-group row hiden_class" style ="display: none;">
                                            <label class="col-form-label col-md-2">{{ __('pages.permanent_address') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Permanent Address" id="permanent_address" name="permanent_address" value="">
                                            </div>
                                        </div>

                                        <div class="form-group row hiden_class" style ="display: none;">
                                            <label class="col-form-label col-md-2">{{ __('pages.advance_amount') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Advance amount" id="advance_amount" name="advance_amount"  value="">
                                            </div>
                                        </div>

                                        <div class="form-group row hiden_class" style ="display: none;">
                                            <label class="col-form-label col-md-2">{{ __('pages.payment_due_date') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Payment due date" id="payment_due_date" name="payment_due_date" value="">
                                            </div>
                                        </div>

                                        <div class="form-group row hiden_class" style ="display: none;">
                                            <label class="col-form-label col-md-2">{{ __('pages.in_date') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="In Date" id="in_date" name="in_date" value="">
                                            </div>
                                        </div>

                                        <div class="form-group row hiden_class" style ="display: none;">
                                            <label class="col-form-label col-md-2">{{ __('pages.out_date') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Out Date" id="out_date" name="out_date" value="">
                                            </div>
                                        </div>

                                        <div class="form-group row hiden_class" style ="display: none;">
                                            <label class="col-form-label col-md-2">{{ __('pages.number_of_family_members') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Number of family member(s)" id="number_of_family_member" name="number_of_family_member" value="">
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( function() {
$( "#dob" ).datepicker({ dateFormat: 'yy-mm-dd' });
$( "#in_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
$( "#out_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
$( "#last_vata_receive_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
} );
</script>

<script type="text/javascript">

function showHideControls() {
    alert('d');
        if ($('#is_master').is(':checked')) {
            $('.hiden_class').show();
            $('.show_parent_dropdown').hide();
        } else {
            $('.hiden_class').hide();
            $('.show_parent_dropdown').show();
        }
}

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