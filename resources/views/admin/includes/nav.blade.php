<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul id="side-menu">

                <!-- <li class="{{ $nav == 'dashboard' ? 'menuitem-active' : '' }}">
                    <a href="{{ route('admin-dashboard') }}" class="{{ $nav == 'dashboard' ? 'active' : '' }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> Dashboard </span>
                    </a>
                </li> -->

                <li class="menu-title mt-2">Customers</li>
                <li class="{{ $nav == 'customers' ? 'menuitem-active' : '' }}"> 
                    <a href="{{ route('admin-customers') }}" class="{{ $nav == 'customers' ? 'active' : '' }}"> 
                        <i class="mdi mdi-account-group"></i> <span> Customers </span> 
                    </a>
                </li>

                <li class="menu-title mt-2">Inventory</li>
               
                <li class="{{ $nav == 'inventories' ? 'menuitem-active' : '' }}">
                    <a href="{{ route('admin-inventories') }}" class="{{ $nav == 'inventories' ? 'active' : '' }}">
                        <i class="mdi mdi-layers-triple"></i>
                        <span> Vehicle Inventories </span>
                    </a>
                </li>

                <li class="menu-title mt-2">Repair Jobs</li>
               
                <li class="{{ $nav == 'repairorders' ? 'menuitem-active' : '' }}">
                    <a href="{{ route('admin-repairorders') }}" class="{{ $nav == 'repairorders' ? 'active' : '' }}">
                        <i class="mdi mdi-hammer-wrench"></i>
                        <span> Repair Orders </span>
                    </a>
                </li>

                <li class="menu-title mt-2">Vehicle Configuration</li>

                <li class="{{ $nav == 'make' ? 'menuitem-active' : '' }}">
                    <a href="{{ route('admin-make') }}" class="{{ $nav == 'make' ? 'active' : '' }}">
                        <i class="mdi mdi-alpha-m-circle"></i>
                        <span> Makes </span>
                    </a>
                </li>

                <li class="{{ $nav == 'model' ? 'menuitem-active' : '' }}">
                    <a href="{{ route('admin-model') }}" class="{{ $nav == 'model' ? 'active' : '' }}">
                        <i class="mdi mdi-alpha-m-circle"></i>
                        <span> Models </span>
                    </a>
                </li>
                <li class="{{ $nav == 'vehicletypes' ? 'menuitem-active' : '' }}">
                    <a href="{{ route('admin-vehicletypes') }}" class="{{ $nav == 'vehicletypes' ? 'active' : '' }}">
                        <i class="mdi mdi-alpha-v-circle"></i>
                        <span> Vehicle Types </span>
                    </a>
                </li>

                <li class="menu-title mt-2">Services / Parts Configuration</li>
                <li class="{{ $nav == 'services' ? 'menuitem-active' : '' }}">
                    <a href="{{ route('admin-services') }}" class="{{ $nav == 'services' ? 'active' : '' }}">
                        <i class="mdi mdi-cog"></i>
                        <span> Services </span>
                    </a>
                </li>
                <li class="{{ $nav == 'servicetypes' ? 'menuitem-active' : '' }}">
                    <a href="{{ route('admin-servicetypes') }}" class="{{ $nav == 'servicetypes' ? 'active' : '' }}">
                        <i class="mdi mdi-cogs"></i>
                        <span> Service Types </span>
                    </a>
                </li>

                <li class="{{ $nav == 'parttypes' ? 'menuitem-active' : '' }}">
                    <a href="{{ route('admin-parttypes') }}" class="{{ $nav == 'parttypes' ? 'active' : '' }}">
                        <i class="mdi mdi-apps"></i>
                        <span> Part Types </span>
                    </a>
                </li>
                
                <li class="menu-title mt-2">General Configuration</li>
                
                <li class="{{ $nav == 'suppliers' ? 'menuitem-active' : '' }}"> 
                    <a href="{{ route('admin-suppliers') }}" class="{{ $nav == 'suppliers' ? 'active' : '' }}"> 
                        <i class="mdi mdi-account-multiple-plus"></i> <span> Suppliers </span> </a>
                </li>

                <li class="{{ $nav == 'finances' ? 'menuitem-active' : '' }}"> 
                    <a href="{{ route('admin-finances') }}" class="{{ $nav == 'finances' ? 'active' : '' }}"> 
                        <i class="mdi mdi-bank"></i> <span> Finances </span> </a>
                </li>

                <li class="{{ $nav == 'staffs' ? 'menuitem-active' : '' }}"> 
                    <a href="{{ route('admin-staffs') }}" class="{{ $nav == 'staffs' ? 'active' : '' }}"> 
                        <i class="mdi mdi-account-supervisor-circle"></i> <span> Staffs </span> </a>
                </li>
                <li class="{{ $nav == 'status' ? 'menuitem-active' : '' }}"> 
                    <a href="{{ route('admin-status') }}" class="{{ $nav == 'status' ? 'active' : '' }}"> 
                        <i class="mdi mdi-label-multiple"></i> <span> Statuses </span> </a>
                </li>

                <li class="{{ $nav == 'appsettings' ? 'menuitem-active' : '' }}"> 
                    <a href="{{ route('admin-appsettings') }}" class="{{ $nav == 'appsettings' ? 'active' : '' }}"> 
                        <i class="mdi mdi-cog"></i> <span> App Settings </span> </a>
                </li>

            </ul>
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->

</div>