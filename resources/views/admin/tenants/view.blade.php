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
                                    <li class="breadcrumb-item active">{{ __('pages.tenant_detail') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{ __('pages.tenant_detail') }}</h4>
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
                                                <input disabled type="checkbox" name="is_master" id="is_master" <?php if($tenant->is_master == 1) echo "checked=checked"; ?> onchange="showHideControls()">
                                                <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group row hiden_class show_parent_dropdown">
                                            <label class="col-form-label col-md-2">{{ __('pages.family_head') }}</label>
                                            <div class="col-md-10">
                                            <select disabled name="family_head_id" id="family_head_id" class="form-control btn btn-secondary dropdown-toggle">
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
                                                <select disabled name="is_flat_owner" id="is_flat_owner" class="form-control">
                                                    <option value="1" <?php if($tenant->is_flat_owner == 1) echo "selected=selected"; ?>>Yes</option>
                                                    <option value="0" <?php if($tenant->is_flat_owner == 0) echo "selected=selected"; ?>>No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row hiden_class" style ="display: none;">
                                            <label class="col-form-label col-md-2">{{ __('pages.floor') }}</label>
                                            <div class="col-md-10">
                                            <select disabled name="floor_id" id="floor_id" class="form-control btn btn-secondary dropdown-toggle">
                                            <option value="" selected>-- Select One --</option>
                                            @foreach($floors as $floor)
                                                <option value="{{$floor->id}}" <?php if($floor->id == $tenant->floor_id) echo "selected=selected"; ?>>{{$floor->name}}</option>
                                            @endforeach
                                            </select>

                                            </div>
                                        </div>

                                        <div class="form-group row hiden_class" style ="display: none;">
                                            <label class="col-form-label col-md-2">{{ __('pages.flat') }}</label>
                                            <div class="col-md-10">
                                            <select disabled name="flat_id" id="flat_id" class="form-control btn btn-secondary dropdown-toggle">
                                            <option value="" selected>-- Select One --</option>
                                            @foreach($flats as $flat)
                                                <option value="{{$flat->id}}" <?php if($flat->id == $tenant->flat_id) echo "selected=selected"; ?>>{{$flat->name}}</option>
                                            @endforeach
                                            </select>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.gender') }}</label>
                                            <div class="col-md-10">
                                                <div class="radio">
                                                    <label>
                                                        <input disabled type="radio" name="gender" class="radio" value="Male" <?php if($tenant->gender == 'male') echo "checked=checked"; ?>> Male
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input disabled type="radio" name="gender" class="radio" value="Female" <?php if($tenant->gender == 'female') echo "checked=checked"; ?>> Female
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input disabled type="radio" name="gender" class="radio" value="Other" <?php if($tenant->gender == 'other') echo "checked=checked"; ?>> Other
                                                    </label>
                                                </div>                          
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.nid') }}</label>
                                            <div class="col-md-10">
                                                <input disabled type="text" class="form-control" placeholder="National id number" id="nid" name="nid"  value="{{$tenant->nid}}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.dob') }}</label>
                                            <div class="col-md-10">
                                                <input disabled type="text" class="form-control" placeholder="Date of birth" id="dob" name="dob" required="required" value="<?php echo $tenant->dob ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.blood_group') }}</label>
                                            <div class="col-md-10">
                                                <select disabled name="blood_group" id="blood_group" class="form-control">
                                                    <option value="0">-- Select One --</option>
                                                    <option value="A+" <?php if($tenant->blood_group == "A+") echo "selected=selected"; ?>>A+</option>
                                                    <option value="A-" <?php if($tenant->blood_group == "A-") echo "selected=selected"; ?>>A-</option>
                                                    <option value="B+" <?php if($tenant->blood_group == "B+") echo "selected=selected"; ?>>B+</option>
                                                    <option value="B-" <?php if($tenant->blood_group == "B-") echo "selected=selected"; ?>>B-</option>
                                                    <option value="AB+" <?php if($tenant->blood_group == "AB+") echo "selected=selected"; ?>>AB+</option>
                                                    <option value="AB-" <?php if($tenant->blood_group == "AB-") echo "selected=selected"; ?>>AB-</option>
                                                    <option value="O+" <?php if($tenant->blood_group == "O+") echo "selected=selected"; ?>>O+</option>
                                                    <option value="O-" <?php if($tenant->blood_group == "O-") echo "selected=selected"; ?>>O-</option>
                                                </select>
                                                    
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row hiden_class" style ="display: none;">
                                            <label class="col-form-label col-md-2">{{ __('pages.religion') }}</label>
                                            <div class="col-md-10">
                                                <select disabled name="religion" id="religion" class="form-control">
                                                    <option value="0">-- Select One --</option>
                                                    <option value="1" <?php if($tenant->religion == 1) echo "selected=selected"; ?>>Buddism</option>
                                                    <option value="2" <?php if($tenant->religion == 2) echo "selected=selected"; ?>>Hinduism</option>
                                                    <option value="3" <?php if($tenant->religion == 3) echo "selected=selected"; ?>>Christanity</option>
                                                    <option value="4" <?php if($tenant->religion == 4) echo "selected=selected"; ?>>Islam</option>
                                                </select>
                                                    
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.photo') }}</label>
                                            <div class="col-md-10">
                                                <img style="border-radius: 50%;" id="selected_photo" src="<?php echo asset($tenant->photo);?>" alt="unavailable" width ="100px" height ="100px"/>
                                            </div>
                                        </div>

                                        <div class="form-group row hiden_class" style ="display: none;">
                                            <label class="col-form-label col-md-2">{{ __('pages.profession') }}</label>
                                            <div class="col-md-10">
                                            <fieldset>
                                            <select disabled class="form-control dropdown" id="profession_id" name="profession_id">
                                                <option value="0" selected="selected" disabled="disabled">-- Select One --</option>
                                                <optgroup label="Healthcare Practitioners and Technical Occupations:">
                                                <option value="1" <?php if($tenant->profession_id == 1) echo "selected=selected"; ?>>-  Chiropractor</option>
                                                <option value="2" <?php if($tenant->profession_id == 2) echo "selected=selected"; ?>>-  Dentist</option>
                                                <option value="3" <?php if($tenant->profession_id == 3) echo "selected=selected"; ?>>-  Dietitian or Nutritionist</option>
                                                <option value="4" <?php if($tenant->profession_id == 4) echo "selected=selected"; ?>>-  Optometrist</option>
                                                <option value="5" <?php if($tenant->profession_id == 5) echo "selected=selected"; ?>>-  Pharmacist</option>
                                                <option value="6" <?php if($tenant->profession_id == 6) echo "selected=selected"; ?>>-  Physician</option>
                                                <option value="7" <?php if($tenant->profession_id == 7) echo "selected=selected"; ?>>-  Physician Assistant</option>
                                                <option value="8" <?php if($tenant->profession_id == 8) echo "selected=selected"; ?>>-  Podiatrist</option>
                                                <option value="9" <?php if($tenant->profession_id == 9) echo "selected=selected"; ?>>-  Registered Nurse</option>
                                                <option value="10" <?php if($tenant->profession_id == 10) echo "selected=selected"; ?>>-  Therapist</option>
                                                <option value="11" <?php if($tenant->profession_id == 11) echo "selected=selected"; ?>>-  Veterinarian</option>
                                                <option value="12" <?php if($tenant->profession_id == 12) echo "selected=selected"; ?>>-  Health Technologist or Technician</option>
                                                <option value="13" <?php if($tenant->profession_id == 13) echo "selected=selected"; ?>>-  Other Healthcare Practitioners and Technical Occupation</option>
                                                </optgroup>
                                                <optgroup label="Healthcare Support Occupations:">
                                                <option value="14" <?php if($tenant->profession_id == 14) echo "selected=selected"; ?>>-  Nursing, Psychiatric, or Home Health Aide</option>
                                                <option value="15" <?php if($tenant->profession_id == 15) echo "selected=selected"; ?>>-  Occupational and Physical Therapist Assistant or Aide</option>
                                                <option value="16" <?php if($tenant->profession_id == 16) echo "selected=selected"; ?>>-  Other Healthcare Support Occupation</option>
                                                </optgroup>
                                                <optgroup label="Business, Executive, Management, and Financial Occupations:">
                                                <option value="17" <?php if($tenant->profession_id == 17) echo "selected=selected"; ?>>-  Chief Executive</option>
                                                <option value="18" <?php if($tenant->profession_id == 18) echo "selected=selected"; ?>> -  General and Operations Manager</option>
                                                <option value="19" <?php if($tenant->profession_id == 19) echo "selected=selected"; ?>>-  Advertising, Marketing, Promotions, Public Relations, and Sales Manager</option>
                                                <option value="20" <?php if($tenant->profession_id == 20) echo "selected=selected"; ?>>-  Operations Specialties Manager (e.g., IT or HR Manager)</option>
                                                <option value="21" <?php if($tenant->profession_id == 21) echo "selected=selected"; ?>>-  Construction Manager</option>
                                                <option value="22" <?php if($tenant->profession_id == 22) echo "selected=selected"; ?>>-  Engineering Manager</option>
                                                <option value="23" <?php if($tenant->profession_id == 23) echo "selected=selected"; ?>>-  Accountant, Auditor</option>
                                                <option value="24" <?php if($tenant->profession_id == 24) echo "selected=selected"; ?>>-  Business Operations or Financial Specialist</option>
                                                <option value="25" <?php if($tenant->profession_id == 25) echo "selected=selected"; ?>>-  Business Owner</option>
                                                <option value="26" <?php if($tenant->profession_id == 26) echo "selected=selected"; ?>>-  Other Business, Executive, Management, Financial Occupation</option>
                                                </optgroup>
                                                <optgroup label="Architecture and Engineering Occupations:">
                                                <option value="27" <?php if($tenant->profession_id == 27) echo "selected=selected"; ?>> -  Architect, Surveyor, or Cartographer</option>
                                                <option value="28" <?php if($tenant->profession_id == 28) echo "selected=selected"; ?>>-  Engineer</option>
                                                <option value="29" <?php if($tenant->profession_id == 29) echo "selected=selected"; ?>>-  Other Architecture and Engineering Occupation</option>
                                                </optgroup>
                                                <optgroup label="Education, Training, and Library Occupations:">
                                                <option value="30" <?php if($tenant->profession_id == 30) echo "selected=selected"; ?>>-  Postsecondary Teacher (e.g., College Professor)</option>
                                                <option value="31" <?php if($tenant->profession_id == 31) echo "selected=selected"; ?>>-  Primary, Secondary, or Special Education School Teacher</option>
                                                <option value="32" <?php if($tenant->profession_id == 32) echo "selected=selected"; ?>>-  Other Teacher or Instructor</option>
                                                <option value="33" <?php if($tenant->profession_id == 33) echo "selected=selected"; ?>>-  Other Education, Training, and Library Occupation</option>
                                                </optgroup>
                                                <optgroup label="Other Professional Occupations:">
                                                <option value="34" <?php if($tenant->profession_id == 34) echo "selected=selected"; ?>>-  Arts, Design, Entertainment, Sports, and Media Occupations</option>
                                                <option value="35" <?php if($tenant->profession_id == 35) echo "selected=selected"; ?>>-  Computer Specialist, Mathematical Science</option>
                                                <option value="36" <?php if($tenant->profession_id == 36) echo "selected=selected"; ?>>-  Counselor, Social Worker, or Other Community and Social Service Specialist</option>
                                                <option value="37" <?php if($tenant->profession_id == 37) echo "selected=selected"; ?>>-  Lawyer, Judge</option>
                                                <option value="38" <?php if($tenant->profession_id == 38) echo "selected=selected"; ?>>-  Life Scientist (e.g., Animal, Food, Soil, or Biological Scientist, Zoologist)</option>
                                                <option value="39" <?php if($tenant->profession_id == 39) echo "selected=selected"; ?>>-  Physical Scientist (e.g., Astronomer, Physicist, Chemist, Hydrologist)</option>
                                                <option value="40" <?php if($tenant->profession_id == 40) echo "selected=selected"; ?>>-  Religious Worker (e.g., Clergy, Director of Religious Activities or Education)</option>
                                                <option value="41" <?php if($tenant->profession_id == 41) echo "selected=selected"; ?>>-  Social Scientist and Related Worker</option>
                                                <option value="42" <?php if($tenant->profession_id == 42) echo "selected=selected"; ?>>-  Other Professional Occupation</option>
                                                </optgroup>
                                                <optgroup label="Office and Administrative Support Occupations:">
                                                <option value="43" <?php if($tenant->profession_id == 43) echo "selected=selected"; ?>>-  Supervisor of Administrative Support Workers</option>
                                                <option value="44" <?php if($tenant->profession_id == 44) echo "selected=selected"; ?>>-  Financial Clerk</option>
                                                <option value="45" <?php if($tenant->profession_id == 45) echo "selected=selected"; ?>>-  Secretary or Administrative Assistant</option>
                                                <option value="46" <?php if($tenant->profession_id == 46) echo "selected=selected"; ?>>-  Material Recording, Scheduling, and Dispatching Worker</option>
                                                <option value="47" <?php if($tenant->profession_id == 47) echo "selected=selected"; ?>>-  Other Office and Administrative Support Occupation</option>
                                                </optgroup>
                                                <optgroup label="Services Occupations:">
                                                <option value="48" <?php if($tenant->profession_id == 48) echo "selected=selected"; ?>>-  Protective Service (e.g., Fire Fighting, Police Officer, Correctional Officer)</option>
                                                <option value="49" <?php if($tenant->profession_id == 49) echo "selected=selected"; ?>>-  Chef or Head Cook</option>
                                                <option value="50" <?php if($tenant->profession_id == 50) echo "selected=selected"; ?>>-  Cook or Food Preparation Worker</option>
                                                <option value="51" <?php if($tenant->profession_id == 51) echo "selected=selected"; ?>>-  Food and Beverage Serving Worker (e.g., Bartender, Waiter, Waitress)</option>
                                                <option value="52" <?php if($tenant->profession_id == 52) echo "selected=selected"; ?>>-  Building and Grounds Cleaning and Maintenance</option>
                                                <option value="53" <?php if($tenant->profession_id == 53) echo "selected=selected"; ?>>-  Personal Care and Service (e.g., Hairdresser, Flight Attendant, Concierge)</option>
                                                <option value="54" <?php if($tenant->profession_id == 54) echo "selected=selected"; ?>>-  Sales Supervisor, Retail Sales</option>
                                                <option value="55" <?php if($tenant->profession_id == 55) echo "selected=selected"; ?>>-  Retail Sales Worker</option>
                                                <option value="56" <?php if($tenant->profession_id == 56) echo "selected=selected"; ?>>-  Insurance Sales Agent</option>
                                                <option value="57" <?php if($tenant->profession_id == 57) echo "selected=selected"; ?>>-  Sales Representative</option>
                                                <option value="58" <?php if($tenant->profession_id == 58) echo "selected=selected"; ?>>-  Real Estate Sales Agent</option>
                                                <option value="59" <?php if($tenant->profession_id == 59) echo "selected=selected"; ?>>-  Other Services Occupation</option>
                                                </optgroup>
                                                <optgroup label="Agriculture, Maintenance, Repair, and Skilled Crafts Occupations:">
                                                <option value="60" <?php if($tenant->profession_id == 60) echo "selected=selected"; ?>>-  Construction and Extraction (e.g., Construction Laborer, Electrician)</option>
                                                <option value="61" <?php if($tenant->profession_id == 61) echo "selected=selected"; ?>>-  Farming, Fishing, and Forestry</option>
                                                <option value="62" <?php if($tenant->profession_id == 62) echo "selected=selected"; ?>>-  Installation, Maintenance, and Repair</option>
                                                <option value="63" <?php if($tenant->profession_id == 63) echo "selected=selected"; ?>>-  Production Occupations</option>
                                                <option value="64" <?php if($tenant->profession_id == 64) echo "selected=selected"; ?>>-  Other Agriculture, Maintenance, Repair, and Skilled Crafts Occupation</option>
                                                </optgroup>
                                                <optgroup label="Transportation Occupations:">
                                                <option value="65" <?php if($tenant->profession_id == 65) echo "selected=selected"; ?>>-  Aircraft Pilot or Flight Engineer</option>
                                                <option value="66" <?php if($tenant->profession_id == 66) echo "selected=selected"; ?>>-  Motor Vehicle Operator (e.g., Ambulance, Bus, Taxi, or Truck Driver)</option>
                                                <option value="67" <?php if($tenant->profession_id == 67) echo "selected=selected"; ?>>-  Other Transportation Occupation</option>
                                                </optgroup>
                                                <optgroup label="Other Occupations:">
                                                <option value="68" <?php if($tenant->profession_id == 68) echo "selected=selected"; ?>>-  Military</option>
                                                <option value="69" <?php if($tenant->profession_id == 69) echo "selected=selected"; ?>>-  Homemaker</option>
                                                <option value="70" <?php if($tenant->profession_id == 70) echo "selected=selected"; ?>>-  Other Occupation</option>
                                                <option value="71" <?php if($tenant->profession_id == 71) echo "selected=selected"; ?>>-  Don't Know</option>
                                                <option value="72" <?php if($tenant->profession_id == 72) echo "selected=selected"; ?>>-  Not Applicable</option>
                                                </optgroup>
                                            </select>
                                            </fieldset>
                                            </div>
                                        </div>

                                       
                                        <div class="form-group row hiden_class" style ="display: none;">
                                            <label class="col-form-label col-md-2">{{ __('pages.notice_period_in_month') }}</label>
                                            <div class="col-md-10">
                                                <select disabled name="notice_period_in_month" id="notice_period_in_month" class="form-control">
                                                    <option value="0">-- Select One --</option>
                                                    <option value="1" <?php if($tenant->notice_period_in_month == 1) echo "selected=selected"; ?>>One Month</option>
                                                    <option value="2" <?php if($tenant->notice_period_in_month == 2) echo "selected=selected"; ?>>Two Month</option>
                                                    <option value="3" <?php if($tenant->notice_period_in_month == 3) echo "selected=selected"; ?>>Three Month</option>
                                                    <option value="4" <?php if($tenant->notice_period_in_month == 4) echo "selected=selected"; ?>>Four Month</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.mobile_no') }}</label>
                                            <div class="col-md-10">
                                                <input disabled type="text" class="form-control" placeholder="Mobile number" id="mobile_number" name="mobile_number" value="<?php echo $tenant->mobile_number; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.email') }}</label>
                                            <div class="col-md-10">
                                                <input disabled type="text" class="form-control" placeholder="Email" id="email" name="email" value="<?php echo $tenant->email; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row hiden_class" style ="display: none;">
                                            <label class="col-form-label col-md-2">{{ __('pages.permanent_address') }}</label>
                                            <div class="col-md-10">
                                                <input disabled type="text" class="form-control" placeholder="Permanent Address" id="permanent_address" name="permanent_address" value="<?php echo $tenant->permanent_address; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row hiden_class" style ="display: none;">
                                            <label class="col-form-label col-md-2">{{ __('pages.advance_amount') }}</label>
                                            <div class="col-md-10">
                                                <input disabled type="text" class="form-control" placeholder="Advance amount" id="advance_amount" name="advance_amount"  value="<?php echo $tenant->advance_amount; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row hiden_class" style ="display: none;">
                                            <label class="col-form-label col-md-2">{{ __('pages.payment_due_date') }}</label>
                                            <div class="col-md-10">
                                                <input disabled type="text" class="form-control" placeholder="Payment due date" id="payment_due_date" name="payment_due_date" value="<?php echo $tenant->payment_due_date; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row hiden_class" style ="display: none;">
                                            <label class="col-form-label col-md-2">{{ __('pages.in_date') }}</label>
                                            <div class="col-md-10">
                                                <input disabled type="text" class="form-control" placeholder="In Date" id="in_date" name="in_date" value="<?php echo $tenant->in_date ;?>">
                                            </div>
                                        </div>

                                        <div class="form-group row hiden_class" style ="display: none;">
                                            <label class="col-form-label col-md-2">{{ __('pages.out_date') }}</label>
                                            <div class="col-md-10">
                                                <input disabled type="text" class="form-control" placeholder="Out Date" id="out_date" name="out_date" value="<?php echo $tenant->out_date ;?>">
                                            </div>
                                        </div>

                                        <div class="form-group row hiden_class" style ="display: none;">
                                            <label class="col-form-label col-md-2">{{ __('pages.number_of_family_members') }}</label>
                                            <div class="col-md-10">
                                                <input disabled type="text" class="form-control" placeholder="Number of family member(s)" id="no_of_family_members" name="no_of_family_members" value="<?php echo $tenant->no_of_family_members; ?>">
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
$( "#in_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
$( "#out_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
$( "#last_vata_receive_date" ).datepicker({ dateFormat: 'yy-mm-dd' });

var checkbox = document.querySelector('[type="checkbox"]');
var event = document.createEvent("HTMLEvents");
event.initEvent('change', false, true);
checkbox.dispatchEvent(event);

} );
</script>

<script type="text/javascript">

function showHideControls() {
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