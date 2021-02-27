
<?php
    $latest_notifications = App\Models\Notifications::where('destination',auth('admin')->user()->id)->where('status','0')->where('destination_type','admin')->orderBy('id', 'DESC')->take(5)->get();
    //dd($latest_notification);
?>
            <div class="header">            
                <!-- Logo -->
                <div class="header-left d-flex">
                    <a href="{{url('/admin')}}" class="logo">

                    <div class='logo_row'>
                    <div class='logo_cell logo_cell_merged'><img src="{{ asset('samajikadmin/img/logo.png')}}" alt="Logo"></div>
                    <div class='logo_cell'>
                        <div class='logo_row'><span class="logo-text">নাজমহল ভবন</span></div>
                        <div class='logo_row'><span>উত্তরা, ঢাকা।</span></div>
                    </div>
                    </div>
                    </a>
                    <a href="{{url('/admin')}}" class="logo logo-small">
                        <img src="{{ asset('samajikadmin/img/logo.png')}}" alt="Logo" width="30" height="30">
                    </a>
                </div>
                <!-- /Logo -->
                
                <a href="javascript:void(0);" id="toggle_btn">
                    <i class="fe fe-text-align-left"></i>
                </a>
                
                <!-- Mobile Menu Toggle -->
                <a class="mobile_btn" id="mobile_btn">
                    <i class="fa fa-bars"></i>
                </a>
                <!-- /Mobile Menu Toggle -->
                
                <!-- Header Right Menu -->
                <ul class="nav user-menu">

                    <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                    <?php if(App::getlocale() == '' || App::getlocale() == 'en'){ ?>
                       <img class="rounded-circle" src="{{ asset('samajikadmin/img/language_image/english.png') }}" width="31" alt="Langage icon">
                    <?php } else{ ?>
                        <img class="rounded-circle" src="{{ asset('samajikadmin/img/language_image/bengali.png') }}" width="31" alt="Langage icon">
                   <?php } ?>
                            
                    </a>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="#"><i data-feather="globe" class="align-self-center icon-xs icon-dual mr-1"></i>

                    <?php 
                    if(App::getlocale() == '' || App::getlocale() == 'en'){
                    $language = "en";
                    } else
                    $language = "bn";
                    ?>
                    <form>
                    <div class="col-md-9">
                    <div class="my-2">
                    <input type="radio" id="english" name="language" value="en" <?php if($language == "en") echo "checked=checked";?> /> 
                    <label>English</label>
                    </div>
                    <div class="mb-0">
                    <input type="radio" id="bangla" name="language" <?php if($language == "bn") echo "checked=checked";?> value="bn" />
                    <label>বাংলা</label>
                    </div>
                    </div>
                    </form>
                    </a>

                    </div>
                    </li>
                    <!-- User Menu -->
                    <li class="nav-item dropdown has-arrow">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <span class="user-img"><img class="rounded-circle" src="{{ asset('samajikadmin/img/patients/patient1.jpg') }}" width="31" alt="Ryan Taylor"></span>
                        </a>
                        <div class="dropdown-menu">


                            <div class="user-header">
                                <div class="avatar avatar-sm">
                                    <img src="{{ asset('samajikadmin/img/patients/patient1.jpg') }}" alt="User Image" class="avatar-img rounded-circle">
                                </div>
                                <div class="user-text">
                                    <h6><?php echo Auth::guard('admin')->user()->name;?></h6>
                                    <p class="text-muted mb-0">Administrator</p>
                                </div>
                            </div>
                                <a class="dropdown-item" title="Change Password" href="{{ url()->route('admin.change-password') }}">Change Password</a>
                            
                                <a class="dropdown-item" title="Logout" href="{{ route('admin.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form-admin-panel').submit();">Logout</a>

                                <form id="logout-form-admin-panel" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                @csrf
                                </form>
                            
                        </div>

                    </li>
                   
 
                  
                    <!-- /User Menu -->
                    
                </ul>
                <!-- /Header Right Menu -->
                
            </div>
            <script src="{{ asset('samajikadmin/js/jquery-3.2.1.min.js') }}"></script>
            <script type="text/javascript">
            $("#english, #bangla").change(function () { 
            str = $(this).val();
            var base_url = window.location.origin;
            window.location = base_url+"/admin/locale/" + str;
            })
            </script>
            <!-- /Header --><!-- Header Right Menu
