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
                                    <form action="{{ url()->route('admin.tenants.store') }}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.tbl_name_column') }}</label>
                                            <div class="col-md-10">
                                            <input type="checkbox"
                                                       value="1"
                                                       onchange="isMasterOfTheApartment()"
                                                       name="is_master"
                                                       id="is_master">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">Is flat owner</label>
                                            <div class="col-md-10">
                                                <select name="blood_group" id="blood_group" class="form-control">
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                                    
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">Is flat owner</label>
                                            <div class="col-md-10">
                                                <select name="blood_group" id="blood_group" class="form-control">
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                                    
                                            </div>
                                        </div>
                                       
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.tbl_name_column') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Name" id="name" name="name" required="required" value="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.gender') }}</label>
                                            <div class="col-md-10">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="sex" class="radio" value="Male" checked="checked"> Male
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="sex" class="radio" value="Female"> Female
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="sex" class="radio" value="Other"> Other
                                                    </label>
                                                </div>                          
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.nid') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="NID" id="nid" name="nid" required="required" value="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.dob') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Date of Birth" id="dob" name="dob" required="required" value="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.blood_group') }}</label>
                                            <div class="col-md-10">
                                                <select name="blood_group" id="blood_group" class="form-control">
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
                                        
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.religion') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Religion" maxlength="11" id="religion" name="religion" required="required" value="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.spouse_name') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Spouse Name" id="spouse_name" name="spouse_name" required="required" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.is_alive') }}</label>
                                            <div class="col-md-10">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="is_spouse_alive" class="radio" value="1" checked="checked"> Yes
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="is_spouse_alive" class="radio" value="0"> No
                                                    </label>
                                                </div>                                  
                                        
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.photo') }}</label>
                                            <div class="col-md-10">
                                                <input type="file" class="form-control" placeholder="Name" id="image" name="image">
                                            </div>
                                        </div>

                                        <div class="form-group row">
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

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.monthly_income') }}</label>
                                            <div class="col-md-10">
                                                <input type="number" class="form-control" placeholder="Monthly Income" id="monthly_income" name="monthly_income" required="required" value="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.annual_income') }}</label>
                                            <div class="col-md-10">
                                                <input type="number" class="form-control" placeholder="Annual Income" id="annual_income" name="annual_income" required="required" value="">
                                            </div>
                                        </div>

                                      

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.allocated_amount') }}</label>
                                            <div class="col-md-10">
                                                <input type="number" class="form-control" placeholder="Allocated Amount" id="receive_amount" name="receive_amount" required="required" value="">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.book_number') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Vata Book Number" id="vata_book_number" name="vata_book_number" required="required" value="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.bank_account_number') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Bank A/C Number" id="bank_account_number" name="bank_account_number" required="required" value="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.bank_name') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Bank" id="bank" name="bank" required="required" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.branch_name') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Bank Branch" id="bank_branch" name="bank_branch" required="required" value="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.last_receiving_date') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Last VATA receiving Date" id="last_vata_receive_date" name="last_vata_receive_date" required="required" value="">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.father_name') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Father Name" id="father_name" name="father_name" required="required" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.mother_name') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Mother Name" id="mother_name" name="mother_name" required="required" value="">
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
$( "#last_vata_receive_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
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