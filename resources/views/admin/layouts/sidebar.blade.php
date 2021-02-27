 <!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
                    <div id="sidebar-menu" class="sidebar-menu">
                        <ul>

                            <li class="{{ (request()->segment(2) == '') ? 'active' : '' }}" > 
                                <a href="{{url('/admin')}}"><i class="fe fe-home"></i> <span>{{ __('sidebar.dashboard') }}</span></a>
                            </li>

                            <li class="{{ (request()->segment(2) == 'departments') ? 'active' : '' }}">
                                <a href="{{url('/admin/departments')}}"><i class="fe fe-document"></i> <span>{{ __('sidebar.departments') }}</span></a>
                            </li>

                            <?php if(Auth::guard('admin')->user()->user_type =="super-admin") {?>
                            <li class="{{ (request()->segment(2) == 'admin') ? 'active' : '' }}">
                                <a href="{{url('/admin/admin')}}"><i class="fe fe-document"></i> <span>{{ __('sidebar.admins') }}</span></a>
                            </li>
                            <?php }?>

                            <li class="{{ (request()->segment(2) == 'vatatypes') ? 'active' : '' }}">
                                <a href="{{url('/admin/vatatypes')}}"><i class="fe fe-document"></i> <span>{{ __('sidebar.vatatypes') }}</span></a>
                            </li>

                            <li class="{{ (request()->segment(2) == 'divisions') ? 'active' : '' }}">
                                <a href="{{url('/admin/divisions')}}"><i class="fe fe-document"></i> <span>{{ __('sidebar.divisions') }}</span></a>
                            </li>
                            <li class="{{ (request()->segment(2) == 'districts') ? 'active' : '' }}">
                                <a href="{{url('/admin/districts')}}"><i class="fe fe-document"></i> <span>{{ __('sidebar.districts') }}</span></a>
                            </li>
                            <li class="{{ (request()->segment(2) == 'thanas') ? 'active' : '' }}">
                                <a href="{{url('/admin/thanas')}}"><i class="fe fe-document"></i> <span>{{ __('sidebar.upazilas') }}</span></a>
                            </li>
                            <li class="{{ (request()->segment(2) == 'unions') ? 'active' : '' }}">
                                <a href="{{url('/admin/unions')}}"><i class="fe fe-document"></i> <span>{{ __('sidebar.unions') }}</span></a>
                            </li>
                            <li class="{{ (request()->segment(2) == 'villages') ? 'active' : '' }}">
                                <a href="{{url('/admin/villages')}}"><i class="fe fe-document"></i> <span>{{ __('sidebar.villages') }}</span></a>
                            </li>
                            
                            <li class="{{ (request()->segment(2) == 'citizens') ? 'active' : '' }}">
                                <a href="{{url('/admin/citizens')}}"><i class="fe fe-document"></i> <span>{{ __('sidebar.citizens') }}</span></a>
                            </li>
                            <li class="{{ (request()->segment(2) == 'vata-handovers') ? 'active' : '' }}">
                                <a href="{{url('/admin/vata-handovers')}}"><i class="fe fe-document"></i> <span>{{ __('sidebar.vatahandovers') }}</span></a>
                            </li>

                            <li class="submenu {{ (request()->segment(2) == 'claimType') ? 'active' : '' }}"> 
                                <a href=""><i class="fe fe-layout"></i> <span>{{ __('sidebar.report') }}</span><span class="menu-arrow"></span></a>
                                <ul style="display: none;">
                                    <li><a href="{{url('/admin/citizen-report')}}"> <span>{{ __('sidebar.ctzenrpt') }}</a></li>
                                    <li><a href="{{url('/admin/vata-handover-report')}}"> <span>{{ __('sidebar.vhandrpt') }}</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Sidebar -->
            