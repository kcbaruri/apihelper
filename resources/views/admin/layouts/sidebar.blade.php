 <!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
                    <div id="sidebar-menu" class="sidebar-menu">
                        <ul>

                            <li class="{{ (request()->segment(2) == '') ? 'active' : '' }}" > 
                                <a href="{{url('/admin')}}"><i class="fe fe-home"></i> <span>{{ __('sidebar.dashboard') }}</span></a>
                            </li>

                            <?php if(Auth::guard('admin')->user()->user_type =="super-admin") {?>
                            <li class="{{ (request()->segment(2) == 'admin') ? 'active' : '' }}">
                                <a href="{{url('/admin/admin')}}"><i class="fe fe-document"></i> <span>{{ __('sidebar.admins') }}</span></a>
                            </li>
                            <?php }?>

                            <li class="{{ (request()->segment(2) == 'floors') ? 'active' : '' }}">
                                <a href="{{url('/admin/floors')}}"><i class="fe fe-document"></i> <span>{{ __('sidebar.floors') }}</span></a>
                            </li>

                            <li class="{{ (request()->segment(2) == 'flatowners') ? 'active' : '' }}">
                                <a href="{{url('/admin/flatowners')}}"><i class="fe fe-document"></i> <span>{{ __('sidebar.flatowners') }}</span></a>
                            </li>

                            <li class="{{ (request()->segment(2) == 'flats') ? 'active' : '' }}">
                                <a href="{{url('/admin/flats')}}"><i class="fe fe-document"></i> <span>{{ __('sidebar.flats') }}</span></a>
                            </li>
                            <li class="{{ (request()->segment(2) == 'billheads') ? 'active' : '' }}">
                                <a href="{{url('/admin/billheads')}}"><i class="fe fe-document"></i> <span>{{ __('sidebar.billheads') }}</span></a>
                            </li>
                            <li class="{{ (request()->segment(2) == 'tenants') ? 'active' : '' }}">
                                <a href="{{url('/admin/tenants')}}"><i class="fe fe-document"></i> <span>{{ __('sidebar.tenants') }}</span></a>
                            </li>
                            <li class="{{ (request()->segment(2) == 'bills') ? 'active' : '' }}">
                                <a href="{{url('/admin/bills')}}"><i class="fe fe-document"></i> <span>{{ __('sidebar.bills') }}</span></a>
                            </li>

                            <li class="submenu {{ (request()->segment(2) == 'claimType') ? 'active' : '' }}"> 
                                <a href=""><i class="fe fe-layout"></i> <span>{{ __('sidebar.reports') }}</span><span class="menu-arrow"></span></a>
                                <ul style="display: none;">
                                    <li><a href="{{url('/admin/rptflatowner')}}"> <span>{{ __('reports.owner_of_flat') }}</a></li>
                                    <li><a href="{{url('/admin/rptflat')}}"> <span>{{ __('reports.flat_flat_report') }}</a></li>
                                    <li><a href="{{url('/admin/rpttenant')}}"> <span>{{ __('reports.tenant_report') }}</a></li>
                                    <li><a href="{{url('/admin/rptbill')}}"> <span>{{ __('reports.bill_report') }}</a></li>
                                    <li><a href="{{url('/admin/rptinout')}}"> <span>{{ __('reports.inoutreport') }}</a></li>
                                </ul>
                            </li>
                           
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Sidebar -->
            