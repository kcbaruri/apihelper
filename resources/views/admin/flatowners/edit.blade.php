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
                                    <li class="breadcrumb-item active">{{ __('pages.update_citizen') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{ __('pages.update_citizen') }}</h4>
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

                                    <form action="{{ route('admin.citizens.update', $citizen->id) }}" enctype="multipart/form-data" method="post">
                                       
                                        {{ csrf_field() }}
                                        
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.tbl_name_column') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" value="<?php echo $citizen->name;?>" placeholder="Name" id="name" name="name" required="required">
                                            </div>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.gender') }}</label>
                                            <div class="col-md-10">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="sex" class="radio" value="Male" checked="checked" <?php echo ($citizen->sex == "Male") ? "checked = checked": ""; ?>> Male
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="sex" class="radio" value="Female" <?php echo ($citizen->sex == "Female") ? "checked = checked": ""; ?>> Female
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="sex" class="radio" value="Other" <?php echo ($citizen->sex == "Other") ? "checked = checked": ""; ?>> Other
                                                    </label>
                                                </div>                          
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.nid') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="NID" id="nid" name="nid" required="required" value="<?php echo $citizen->nid;?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.dob') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Date of Birth" id="dob" name="dob" required="required" value="<?php echo $citizen->dob;?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.blood_group') }}</label>
                                            <div class="col-md-10">
                                                <select name="blood_group" id="blood_group" class="form-control">
                                                    <option value="A+" <?php if($citizen->blood_group == "A+") echo "selected=selected";?>>A+</option>
                                                    <option value="A-" <?php if($citizen->blood_group == "A-") echo "selected=selected";?>>A-</option>
                                                    <option value="B+" <?php if($citizen->blood_group == "B+") echo "selected=selected";?>>B+</option>
                                                    <option value="B-" <?php if($citizen->blood_group == "B-") echo "selected=selected";?>>B-</option>
                                                    <option value="AB+" <?php if($citizen->blood_group == "AB+") echo "selected=selected";?>>AB+</option>
                                                    <option value="AB-" <?php if($citizen->blood_group == "AB-") echo "selected=selected";?>>AB-</option>
                                                    <option value="O+" <?php if($citizen->blood_group == "O+") echo "selected=selected";?>>O+</option>
                                                    <option value="O-" <?php if($citizen->blood_group == "O-") echo "selected=selected";?>>O-</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.religion') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Religion" maxlength="11" id="religion" name="religion" required="required" value="<?php echo $citizen->religion;?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.spouse_name') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Spouse Name" id="spouse_name" name="spouse_name" required="required" value="<?php echo $citizen->spouse_name;?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.is_alive') }}</label>
                                            <div class="col-md-10">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="is_spouse_alive" class="radio" value="1" <?php echo ($citizen->is_spouse_alive == 1) ? "checked = checked": ""; ?>> Yes
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="is_spouse_alive" class="radio" value="0" <?php echo ($citizen->is_spouse_alive == 0) ? "checked = checked": ""; ?>> No
                                                    </label>
                                                </div>                                  
                                        
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.photo') }}</label>
                                            <div class="col-md-10">
                                                <input type="file" class="form-control" placeholder="Name" id="image" name="image">
                                                <img src="<?php echo asset($citizen->image);?>" width="90px" height="60px">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.profession') }}</label>
                                            <div class="col-md-10">
                                            <fieldset>
                                            <select class="form-control dropdown" id="profession_id" name="profession_id">
                                                <option value="0" selected="selected" disabled="disabled">-- Select One --</option>
                                                <optgroup label="Healthcare Practitioners and Technical Occupations:">
                                                <option value="1" <?php if($citizen->profession_id == "1") echo "selected=selected";?>>-  Chiropractor</option>
                                                <option value="2"  <?php if($citizen->profession_id == "2") echo "selected=selected";?>>-  Dentist</option>
                                                <option value="3" <?php if($citizen->profession_id == "3") echo "selected=selected";?>>-  Dietitian or Nutritionist</option>
                                                <option value="4" <?php if($citizen->profession_id == "4") echo "selected=selected";?>>-  Optometrist</option>
                                                <option value="5" <?php if($citizen->profession_id == "5") echo "selected=selected";?>>-  Pharmacist</option>
                                                <option value="6" <?php if($citizen->profession_id == "6") echo "selected=selected";?>>-  Physician</option>
                                                <option value="7" <?php if($citizen->profession_id == "7") echo "selected=selected";?>>-  Physician Assistant</option>
                                                <option value="8" <?php if($citizen->profession_id == "8") echo "selected=selected";?>>-  Podiatrist</option>
                                                <option value="9" <?php if($citizen->profession_id == "9") echo "selected=selected";?>>-  Registered Nurse</option>
                                                <option value="10" <?php if($citizen->profession_id == "10") echo "selected=selected";?>>-  Therapist</option>
                                                <option value="11" <?php if($citizen->profession_id == "11") echo "selected=selected";?>>-  Veterinarian</option>
                                                <option value="12 <?php if($citizen->profession_id == "12") echo "selected=selected";?>">-  Health Technologist or Technician</option>
                                                <option value="13" <?php if($citizen->profession_id == "13") echo "selected=selected";?>>-  Other Healthcare Practitioners and Technical Occupation</option>
                                                </optgroup>
                                                <optgroup label="Healthcare Support Occupations:">
                                                <option value="14" <?php if($citizen->profession_id == "14") echo "selected=selected";?>>-  Nursing, Psychiatric, or Home Health Aide</option>
                                                <option value="15" <?php if($citizen->profession_id == "15") echo "selected=selected";?>>-  Occupational and Physical Therapist Assistant or Aide</option>
                                                <option value="16" <?php if($citizen->profession_id == "16") echo "selected=selected";?>>-  Other Healthcare Support Occupation</option>
                                                </optgroup>
                                                <optgroup label="Business, Executive, Management, and Financial Occupations:">
                                                <option value="17" <?php if($citizen->profession_id == "17") echo "selected=selected";?>>-  Chief Executive</option>
                                                <option value="18" <?php if($citizen->profession_id == "18") echo "selected=selected";?>>-  General and Operations Manager</option>
                                                <option value="19" <?php if($citizen->profession_id == "19") echo "selected=selected";?>>-  Advertising, Marketing, Promotions, Public Relations, and Sales Manager</option>
                                                <option value="20" <?php if($citizen->profession_id == "20") echo "selected=selected";?>>-  Operations Specialties Manager (e.g., IT or HR Manager)</option>
                                                <option value="21" <?php if($citizen->profession_id == "21") echo "selected=selected";?>>-  Construction Manager</option>
                                                <option value="22" <?php if($citizen->profession_id == "22") echo "selected=selected";?>>-  Engineering Manager</option>
                                                <option value="23" <?php if($citizen->profession_id == "23") echo "selected=selected";?>>-  Accountant, Auditor</option>
                                                <option value="24" <?php if($citizen->profession_id == "24") echo "selected=selected";?>->-  Business Operations or Financial Specialist</option>
                                                <option value="25" <?php if($citizen->profession_id == "25") echo "selected=selected";?>>-  Business Owner</option>
                                                <option value="26" <?php if($citizen->profession_id == "26") echo "selected=selected";?>>-  Other Business, Executive, Management, Financial Occupation</option>
                                                </optgroup>
                                                <optgroup label="Architecture and Engineering Occupations:">
                                                <option value="27" <?php if($citizen->profession_id == "27") echo "selected=selected";?>>-  Architect, Surveyor, or Cartographer</option>
                                                <option value="28" <?php if($citizen->profession_id == "28") echo "selected=selected";?>>-  Engineer</option>
                                                <option value="29" <?php if($citizen->profession_id == "29") echo "selected=selected";?>>-  Other Architecture and Engineering Occupation</option>
                                                </optgroup>
                                                <optgroup label="Education, Training, and Library Occupations:">
                                                <option value="30" <?php if($citizen->profession_id == "30") echo "selected=selected";?>>-  Postsecondary Teacher (e.g., College Professor)</option>
                                                <option value="31" <?php if($citizen->profession_id == "31") echo "selected=selected";?>>-  Primary, Secondary, or Special Education School Teacher</option>
                                                <option value="32" <?php if($citizen->profession_id == "32") echo "selected=selected";?>>-  Other Teacher or Instructor</option>
                                                <option value="33" <?php if($citizen->profession_id == "33") echo "selected=selected";?>>-  Other Education, Training, and Library Occupation</option>
                                                </optgroup>
                                                <optgroup label="Other Professional Occupations:">
                                                <option value="34" <?php if($citizen->profession_id == "34") echo "selected=selected";?>>-  Arts, Design, Entertainment, Sports, and Media Occupations</option>
                                                <option value="35" <?php if($citizen->profession_id == "35") echo "selected=selected";?>>-  Computer Specialist, Mathematical Science</option>
                                                <option value="36" <?php if($citizen->profession_id == "36") echo "selected=selected";?>>-  Counselor, Social Worker, or Other Community and Social Service Specialist</option>
                                                <option value="37" <?php if($citizen->profession_id == "37") echo "selected=selected";?>>-  Lawyer, Judge</option>
                                                <option value="38" <?php if($citizen->profession_id == "38") echo "selected=selected";?>>-  Life Scientist (e.g., Animal, Food, Soil, or Biological Scientist, Zoologist)</option>
                                                <option value="39" <?php if($citizen->profession_id == "39") echo "selected=selected";?>>-  Physical Scientist (e.g., Astronomer, Physicist, Chemist, Hydrologist)</option>
                                                <option value="40" <?php if($citizen->profession_id == "40") echo "selected=selected";?>>-  Religious Worker (e.g., Clergy, Director of Religious Activities or Education)</option>
                                                <option value="41" <?php if($citizen->profession_id == "41") echo "selected=selected";?>>-  Social Scientist and Related Worker</option>
                                                <option value="42" <?php if($citizen->profession_id == "42") echo "selected=selected";?>>-  Other Professional Occupation</option>
                                                </optgroup>
                                                <optgroup label="Office and Administrative Support Occupations:">
                                                <option value="43" <?php if($citizen->profession_id == "43") echo "selected=selected";?>>-  Supervisor of Administrative Support Workers</option>
                                                <option value="44" <?php if($citizen->profession_id == "44") echo "selected=selected";?>>-  Financial Clerk</option>
                                                <option value="45" <?php if($citizen->profession_id == "45") echo "selected=selected";?>>-  Secretary or Administrative Assistant</option>
                                                <option value="46" <?php if($citizen->profession_id == "46") echo "selected=selected";?>>-  Material Recording, Scheduling, and Dispatching Worker</option>
                                                <option value="47" <?php if($citizen->profession_id == "47") echo "selected=selected";?>>-  Other Office and Administrative Support Occupation</option>
                                                </optgroup>
                                                <optgroup label="Services Occupations:">
                                                <option value="48" <?php if($citizen->profession_id == "48") echo "selected=selected";?>>-  Protective Service (e.g., Fire Fighting, Police Officer, Correctional Officer)</option>
                                                <option value="49" <?php if($citizen->profession_id == "49") echo "selected=selected";?>>-  Chef or Head Cook</option>
                                                <option value="50" <?php if($citizen->profession_id == "50") echo "selected=selected";?>>-  Cook or Food Preparation Worker</option>
                                                <option value="51" <?php if($citizen->profession_id == "51") echo "selected=selected";?>>-  Food and Beverage Serving Worker (e.g., Bartender, Waiter, Waitress)</option>
                                                <option value="52" <?php if($citizen->profession_id == "52") echo "selected=selected";?>>-  Building and Grounds Cleaning and Maintenance</option>
                                                <option value="53" <?php if($citizen->profession_id == "53") echo "selected=selected";?>>-  Personal Care and Service (e.g., Hairdresser, Flight Attendant, Concierge)</option>
                                                <option value="54" <?php if($citizen->profession_id == "54") echo "selected=selected";?>>-  Sales Supervisor, Retail Sales</option>
                                                <option value="55" <?php if($citizen->profession_id == "55") echo "selected=selected";?>>-  Retail Sales Worker</option>
                                                <option value="56" <?php if($citizen->profession_id == "56") echo "selected=selected";?>>-  Insurance Sales Agent</option>
                                                <option value="57" <?php if($citizen->profession_id == "57") echo "selected=selected";?>>-  Sales Representative</option>
                                                <option value="58" <?php if($citizen->profession_id == "58") echo "selected=selected";?>>-  Real Estate Sales Agent</option>
                                                <option value="59" <?php if($citizen->profession_id == "59") echo "selected=selected";?>>-  Other Services Occupation</option>
                                                </optgroup>
                                                <optgroup label="Agriculture, Maintenance, Repair, and Skilled Crafts Occupations:">
                                                <option value="60" <?php if($citizen->profession_id == "60") echo "selected=selected";?>>-  Construction and Extraction (e.g., Construction Laborer, Electrician)</option>
                                                <option value="61" <?php if($citizen->profession_id == "61") echo "selected=selected";?>>-  Farming, Fishing, and Forestry</option>
                                                <option value="62" <?php if($citizen->profession_id == "62") echo "selected=selected";?>>-  Installation, Maintenance, and Repair</option>
                                                <option value="63" <?php if($citizen->profession_id == "63") echo "selected=selected";?>>-  Production Occupations</option>
                                                <option value="64" <?php if($citizen->profession_id == "64") echo "selected=selected";?>>-  Other Agriculture, Maintenance, Repair, and Skilled Crafts Occupation</option>
                                                </optgroup>
                                                <optgroup label="Transportation Occupations:">
                                                <option value="65" <?php if($citizen->profession_id == "65") echo "selected=selected";?>>-  Aircraft Pilot or Flight Engineer</option>
                                                <option value="66" <?php if($citizen->profession_id == "66") echo "selected=selected";?>>-  Motor Vehicle Operator (e.g., Ambulance, Bus, Taxi, or Truck Driver)</option>
                                                <option value="67" <?php if($citizen->profession_id == "67") echo "selected=selected";?>>-  Other Transportation Occupation</option>
                                                </optgroup>
                                                <optgroup label="Other Occupations:">
                                                <option value="68" <?php if($citizen->profession_id == "68") echo "selected=selected";?>>-  Military</option>
                                                <option value="69" <?php if($citizen->profession_id == "69") echo "selected=selected";?>>-  Homemaker</option>
                                                <option value="70" <?php if($citizen->profession_id == "70") echo "selected=selected";?>>-  Other Occupation</option>
                                                <option value="71" <?php if($citizen->profession_id == "71") echo "selected=selected";?>>-  Don't Know</option>
                                                <option value="72" <?php if($citizen->profession_id == "72") echo "selected=selected";?>>-  Not Applicable</option>
                                                </optgroup>
                                            </select>
                                            </fieldset>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.monthly_income') }}</label>
                                            <div class="col-md-10">
                                                <input type="number" class="form-control" placeholder="Monthly Income" id="monthly_income" name="monthly_income" required="required" value="<?php echo $citizen->monthly_income;?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.annual_income') }}</label>
                                            <div class="col-md-10">
                                                <input type="number" class="form-control" placeholder="Annual Income" id="annual_income" name="annual_income" required="required" value="<?php echo $citizen->annual_income;?>">
                                            </div>
                                        </div>
                                       
                                        @if(count($vata_types) > 0)
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('sidebar.vatatypes') }}</label>
                                            <div class="col-md-10">
                                                <select id="vata_type_id" name="vata_type_id" class="form-control" required="required">
                                                <option value="">Select</option>
                                                @foreach ($vata_types as $var)
                                                <option value="{{ $var->id }}" <?php if($var->id == $citizen->vata_type_id) echo "selected=selected"; else echo "";?>>{{ $var->name }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @endif

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.allocated_amount') }}</label>
                                            <div class="col-md-10">
                                                <input type="number" class="form-control" placeholder="Allocated Amount" id="receive_amount" name="receive_amount" required="required" value="<?php echo $citizen->receive_amount;?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.book_number') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Vata Book Number" id="vata_book_number" name="vata_book_number" required="required" value="<?php echo $citizen->vata_book_number;?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.bank_account_number') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Bank A/C Number" id="bank_account_number" name="bank_account_number" required="required" value="<?php echo $citizen->bank_account_number;?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.bank_name') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Bank" id="bank" name="bank" required="required" value="<?php echo $citizen->bank;?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.branch_name') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Bank Branch" id="bank_branch" name="bank_branch" required="required" value="<?php echo $citizen->bank_branch;?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.last_receiving_date') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Last VATA receiving Date" id="last_vata_receive_date" name="last_vata_receive_date" required="required" value="<?php echo $citizen->last_vata_receive_date;?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.father_name') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Father Name" id="father_name" name="father_name" required="required" value="<?php echo $citizen->father_name;?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.mother_name') }}</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Mother Name" id="mother_name" name="mother_name" required="required" value="<?php echo $citizen->mother_name;?>">
                                            </div>
                                        </div>
                                        
                                        @if(count($divisions) > 0)
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('sidebar.divisions') }}</label>
                                            <div class="col-md-10">
                                                <select id="division_id" name="division_id" class="form-control" required="required" onchange="getDistrict(this.value,'district_id',<?php echo $citizen->division_id;?>)">
                                                <option value="">Select</option>
                                                @foreach ($divisions as $var)
                                                <option value="{{ $var->id }}" <?php if($var->id == $citizen->division_id) echo "selected=selected"; else echo "";?>>{{ $var->name }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @endif
                                        @if(count($districts) > 0)
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('sidebar.districts') }}</label>
                                            <div class="col-md-10">
                                                <select id="district_id" name="district_id" class="form-control" required="required" onchange="getThana(this.value,'thana_id',<?php echo $citizen->district_id;?>)">
                                                <option value="">Select</option>
                                                @foreach ($districts as $var)
                                                <option value="{{ $var->id }}" <?php if($var->id == $citizen->district_id) echo "selected=selected"; else echo "";?>>{{ $var->name }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @endif
                                        @if(count($thanas) > 0)
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('sidebar.upazilas') }}</label>
                                            <div class="col-md-10">
                                                <select id="thana_id" name="thana_id" class="form-control" required="required" onchange="getUnion(this.value,'union_id',<?php echo $citizen->thana_id;?>)">
                                                <option value="">Select</option>
                                                @foreach ($thanas as $var)
                                                <option value="{{ $var->id }}" <?php if($var->id == $citizen->thana_id) echo "selected=selected"; else echo "";?>>{{ $var->name }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @endif
                                        @if(count($unions) > 0)
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('sidebar.unions') }}</label>
                                            <div class="col-md-10">
                                                <select id="union_id" name="union_id" class="form-control" required="required" onchange="getVillage(this.value,'village_id',<?php echo $citizen->union_id;?>)">
                                                <option value="">Select</option>
                                                @foreach ($unions as $var)
                                                <option value="{{ $var->id }}" <?php if($var->id == $citizen->union_id) echo "selected=selected"; else echo "";?>>{{ $var->name }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @endif

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('sidebar.wards') }}</label>
                                            <div class="col-md-10">
                                                <select name="ward" id="ward" class="form-control">
                                                <option value="">Select</option>
                                                @for($i=1;$i<31;$i++)
                                                <option value="{{ $i }}" <?php if($citizen->ward == $i) echo "selected=selected";else echo "";?>>Ward - {{ $i }}</option>
                                                @endfor
                                                </select>
                                            </div>
                                        </div>

                                        @if(count($villages) > 0)
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('sidebar.villages') }}</label>
                                            <div class="col-md-10">
                                                <select name="village_id" id="village_id" class="form-control" required="required">
                                                <option value="">Select</option>
                                                @foreach ($villages as $var)
                                                <option value="{{ $var->id }}" <?php if($var->id == $citizen->village_id) echo "selected=selected"; else echo "";?>>{{ $var->name }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @endif

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">{{ __('pages.show_in_list') }}</label>
                                            <div class="col-md-10">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="status" class="radio" value="1" @if($citizen->status == 1 || empty($citizen->status)) checked @endif> Yes
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="status" class="radio" value="0" @if($citizen->status == 0) checked @endif> No
                                                    </label>
                                                </div>                                  
                                        
                                            </div>
                                        </div>
                                        
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
            $('#district_id').trigger('change');
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