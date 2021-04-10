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
                                <h3 class="page-title">{{ __('sidebar.flatowners') }}</h3>
                               
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
                    
                    <div class="row">
                    <form action="{{ route('admin.report.generateownerreport', $flatowner->id) }}" method="post" class="btn-group">
                    {{ csrf_field() }}
                    <button title="Delete" type="submit" class="btn btn-sm bg-danger-light" onclick="return confirm('Are you sure you want to delete?')"><i class="fe fe-trash"></i> {{ __('pages.delete') }}&nbsp;</button>
                    </form>

                        <div class="col-lg-12">
                            <div class="card">
                                
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
                                    <form action=" {{ route('admin.flatowners.update', $flatowner->id) }}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.tbl_name_column') }}</label>
                                            <div class="col-md-10">
                                                <input disabled type="text" class="form-control" value="<?php echo $flatowner->name;?>" placeholder="Name" id="name" name="name" required="required" value="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.gender') }}</label>
                                            <div class="col-md-10">
                                                <div class="radio">
                                                    <label>
                                                        <input disabled type="radio" name="gender" class="radio" value="Male" <?php if($flatowner->gender == "male") echo "checked= checked"; ?> > Male
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input disabled type="radio" name="gender" class="radio" value="Female" <?php if($flatowner->gender == "female") echo "checked=checked"; ?>> Female
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input disabled type="radio" name="gender" class="radio" value="Other" <?php if($flatowner->gender == "other") echo "checked=checked"; ?>> Other
                                                    </label>
                                                </div>                          
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.nid') }}</label>
                                            <div class="col-md-10">
                                                <input disabled type="text" class="form-control" value="<?php echo $flatowner->nid;?>" placeholder="National id number" id="nid" name="nid" value="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.dob') }}</label>
                                            <div class="col-md-10">
                                                <input disabled type="text" class="form-control" placeholder="Date of birth" id="dob" name="dob" required="required" value="<?php echo $flatowner->dob;?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.blood_group') }}</label>
                                            <div class="col-md-10">
                                                <select disabled name="blood_group" id="blood_group" class="form-control">
                                                    <option value="0">-- Select One --</option>
                                                    <option value="A+" <?php if($flatowner->blood_group == "A+") echo "selected=selected"; ?>>A+</option>
                                                    <option value="A-" <?php if($flatowner->blood_group =="A-") echo "selected=selected"; ?>>A-</option>
                                                    <option value="B+" <?php if($flatowner->blood_group == "B+") echo "selected=selected"; ?>>B+</option>
                                                    <option value="B-" <?php if($flatowner->blood_group == "B-") echo "selected=selected"; ?>>B-</option>
                                                    <option value="AB+" <?php if($flatowner->blood_group == "AB+") echo "selected=selected"; ?>>AB+</option>
                                                    <option value="AB-" <?php if($flatowner->blood_group == "AB-") echo "selected=selected"; ?>>AB-</option>
                                                    <option value="O+" <?php if($flatowner->blood_group == "O+") echo "selected=selected"; ?>>O+</option>
                                                    <option value="O-" <?php if($flatowner->blood_group == "O-") echo "selected=selected"; ?>>O-</option>
                                                </select>
                                                    
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row hiden_class">
                                            <label class="col-form-label col-md-2">{{ __('pages.religion') }}</label>
                                            <div class="col-md-10">
                                                <select disabled name="religion" id="religion" class="form-control">
                                                    <option value="0">-- Select One --</option>
                                                    <option value="1" <?php if($flatowner->religion == 1) echo "selected=selected"; ?>>Buddism</option>
                                                    <option value="2" <?php if($flatowner->religion == 2) echo "selected=selected"; ?>>Hinduism</option>
                                                    <option value="3" <?php if($flatowner->religion == 3) echo "selected=selected"; ?>>Christanity</option>
                                                    <option value="4" <?php if($flatowner->religion == 4) echo "selected=selected"; ?>>Islam</option>
                                                </select>
                                                    
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.photo') }}</label>
                                            <div class="col-md-10">
                                                <!-- <input type="file" class="form-control" placeholder="Name" id="photo" name="photo"> -->
                                                <img style="border-radius: 50%;" id="selected_photo" src="<?php echo asset($flatowner->photo);?>" alt="unavailable" width="100px" height="100px"/>
                                            </div>
                                        </div>

                                        <div class="form-group row hiden_class" style ="display: none;">
                                            <label class="col-form-label col-md-2">{{ __('pages.profession') }}</label>
                                            <div class="col-md-10">
                                            <fieldset>
                                            <select disabled class="form-control dropdown" id="profession_id" name="profession_id">
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
                                            <label class="col-form-label col-md-2">{{ __('pages.mobile_no') }}</label>
                                            <div class="col-md-10">
                                                <input disabled type="text" class="form-control" value="<?php echo $flatowner->mobile_number;?>" placeholder="Mobile number" id="mobile_number" name="mobile_number" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.email') }}</label>
                                            <div class="col-md-10">
                                                <input disabled type="text" class="form-control" placeholder="Email" id="email" name="email" value="<?php echo $flatowner->email;?>">
                                            </div>
                                        </div>

                                        <div class="form-group row hiden_class" >
                                            <label class="col-form-label col-md-2">{{ __('pages.permanent_address') }}</label>
                                            <div class="col-md-10">
                                                <input disabled type="text" class="form-control" placeholder="Permanent Address" id="permanent_address" name="permanent_address" value="<?php echo $flatowner->permanent_address;?>">
                                            </div>
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

function isMaster() {
        if ($('#is_master').is(':checked')) {
            $('.hiden_class').show();
            $('.show_parent_dropdown').hide();
        } else {
            $('.hiden_class').hide();
            $('.show_parent_dropdown').show();
        }
}

</script>
@endsection