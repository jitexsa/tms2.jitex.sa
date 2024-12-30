<!-- Page Sidebar Start-->
<div class="sidebar-wrapper" data-sidebar-layout="stroke-svg">
    <div>
        <div class="logo-wrapper"><a href="{{baseURL()}}"><img class="img-fluid for-light" src="{{setImage('logo/logo.png')}}" alt=""><img class="img-fluid for-dark" src="{{setImage('logo/logo.png')}}" alt=""></a>
            <div class="back-btn"><i class="fa-solid fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
        </div>
        <div class="logo-icon-wrapper"><a href="{{baseURL()}}"><img class="img-fluid" src="{{setImage('logo/logo.png')}}" alt=""></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                    <span class="lan-7">Customer Management</span>
                    <div class="according-menu"><i class="fa-solid fa-angle-right"></i></div>
                    </a>
                    <ul class="sidebar-submenu" style="display: none;">
                      <li><a href="{{baseUrl('customer')}}">Customer</a></li>
                    </ul>
                  </li>

                  <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                    <span class="lan-7">Vendor Management</span>
                    <div class="according-menu"><i class="fa-solid fa-angle-right"></i></div>
                    </a>
                    <ul class="sidebar-submenu" style="display: none;">
                      <li>
                        <a href="{{baseUrl('vendor')}}">
                            Manage Vendors
                        </a>
                    </li>
                    <li>
                        <a href="{{baseUrl('vendor/vendor-type')}}">
                            Vendor Type
                        </a>
                    </li>
                    </ul>
                  </li>

                  <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                    <span class="lan-7">Employee Management</span>
                    <div class="according-menu"><i class="fa-solid fa-angle-right"></i></div>
                    </a>
                    <ul class="sidebar-submenu" style="display: none;">
                    <li>
                        <a href="{{baseUrl('employee')}}">
                            Manage Employee
                        </a>
                    </li>
                    <li>
                        <a href="{{baseUrl('employee/driver')}}">
                            Manage Driver
                        </a>
                    </li>
                  <li>
                        <a href="{{baseUrl('employee/position')}}">
                            Position
                        </a>
                    </li>
                    <li>
                        <a href="{{baseUrl('employee/department')}}">
                            Department
                        </a>
                    </li>
                    <li>
                        <a href="{{baseUrl('employee/license')}}">
                            Manage License
                        </a>
                    </li>
                    <li>
                        <a href="{{baseUrl('employee/location')}}">
                            Location
                        </a>
                    </li>
                    </ul>
                  </li>



                  <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                    <span class="lan-7">Vehicle Management</span>
                    <div class="according-menu"><i class="fa-solid fa-angle-right"></i></div>
                    </a>
                    <ul class="sidebar-submenu" style="display: none;">
                    <li>
                        <a href="{{baseUrl('vehicle')}}">
                            Manage Vehicles
                        </a>
                    </li>
                  <li>
                  <li>
                        <a href="{{baseUrl('vehicle/leasing')}}">
                            Vehicle Leasing
                        </a>
                    </li>
                  <li>
                        <a href="{{baseUrl('vehicle/maker')}}">
                            Vehicle Maker
                        </a>
                    </li>
                    <li>
                        <a href="{{baseUrl('vehicle/model')}}">
                            Vehicle Model
                        </a>
                    </li>
                    <li>
                        <a href="{{baseUrl('vehicle/type')}}">
                            Vehicle Type
                        </a>
                    </li>
                    <li>
                        <a href="{{baseUrl('vehicle/inspection')}}">
                            Vehicle Inspection
                        </a>
                    </li>
                    <li>
                        <a href="{{baseUrl('vehicle/route')}}">
                            Vehicle Route Details
                        </a>
                    </li>

                    <li>
                        <a href="{{baseUrl('vehicle/insurance')}}">
                            Insurance Details
                        </a>
                    </li>

                    <li>
                        <a href="{{baseUrl('vehicle/legal-document')}}">
                            Manage Legal Document
                        </a>
                    </li>
                    </ul>
                  </li>
                 

                  <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                    <span class="lan-7">Trip Management</span>
                    <div class="according-menu"><i class="fa-solid fa-angle-right"></i></div>
                    </a>
                    <ul class="sidebar-submenu" style="display: none;">
                    <li>
                        <a href="{{baseUrl('trip')}}">
                            Trip Management List
                        </a>
                    </li>
                    <li>
                        <a href="{{baseUrl('trip/archive')}}">
                            Archive Trip
                        </a>
                    </li>
                    <li>
                        <a href="{{baseUrl('trip/untracked')}}">
                            Untracked  Trip
                        </a>
                    </li>
                    <li>
                        <a href="{{baseUrl('trip/status')}}">
                            Trip Status
                        </a>
                    </li>
                    <li>
                        <a href="{{baseUrl('trip/sow')}}">
                            Scope of Work
                        </a>
                    </li>
                    <li>
                     <a href="{{baseUrl('trip/additional-requirements')}}">
                            Additional Requirements
                        </a>
                    </li>

                    <li>
                        <a href="{{baseUrl('trip/requested-by')}}">
                            Requested By
                        </a>
                    </li>
                    </ul>
                  </li>
                  

                  <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                    <span class="lan-7">Subcontractor</span>
                    <div class="according-menu"><i class="fa-solid fa-angle-right"></i></div>
                    </a>
                    <ul class="sidebar-submenu" style="display: none;">
                    <li>
                        <a href="{{baseUrl('subcontractor')}}">
                            Subcontractor List
                        </a>
                    </li>
                    <li>
                        <a href="{{baseUrl('subcontractor/contractor-status')}}">
                            Contractor Status
                        </a>
                    </li>

                    <li>
                        <a href="{{baseUrl('subcontractor/contractor-report')}}">
                            Contractor Report
                        </a>
                    </li>
                    </ul>
                  </li>


                  <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                    <span class="lan-7">Cost Management</span>
                    <div class="according-menu"><i class="fa-solid fa-angle-right"></i></div>
                    </a>
                    <ul class="sidebar-submenu" style="display: none;">
                    <li>
                        <a href="{{baseUrl('cost/purchase')}}">
                            Add Purchase Order
                        </a>
                    </li>
                    <li>
                        <a href="{{baseUrl('cost/item')}}">
                            Manage Items
                        </a>
                    </li>
                    <li>
                        <a href="{{baseUrl('cost/category')}}">
                            Category
                        </a>
                    </li>
                    </ul>
                  </li>


                  <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                    <span class="lan-7">Fuel</span>
                    <div class="according-menu"><i class="fa-solid fa-angle-right"></i></div>
                    </a>
                    <ul class="sidebar-submenu" style="display: none;">
                    <li>
                        <a href="{{baseUrl('fuel')}}">
                            Fuel
                        </a>
                    </li>
                    <li>
                        <a href="{{baseUrl('fuel/fuel-type')}}">
                            Fuel Type
                        </a>
                    </li>
                    </ul>
                  </li>

                  <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                    <span class="lan-7">System Settings</span>
                    <div class="according-menu"><i class="fa-solid fa-angle-right"></i></div>
                    </a>
                    <ul class="sidebar-submenu" style="display: none;">
                    <li>
                        <a href="{{baseUrl('setting/company')}}">
                            Company
                        </a>
                    </li>
                    <li>
                        <a href="{{baseUrl('setting/service-types')}}">
                            Service Types
                        </a>
                    </li>
                    <li>
                        <a href="{{baseUrl('setting/vehicle-sync')}}">
                            Vehicle Sync
                        </a>
                    </li>

                    <li>
                        <a href="{{baseUrl('setting/sms-template')}}">
                            SMS Template
                        </a>
                    </li>

                    <li>
                        <a href="{{baseUrl('setting/document-type')}}">
                            Document Type
                        </a>
                    </li>

                    <li>
                        <a href="{{baseUrl('setting/email-setting')}}">
                            Email Setting
                        </a>
                    </li>
                    <li>
                        <a href="{{baseUrl('setting/division')}}">
                            Division
                        </a>
                    </li>
                    <li>
                        <a href="{{baseUrl('setting/logs')}}">
                            System Logs
                        </a>
                    </li>
                    <li>
                        <a href="{{baseUrl('setting/api-setting')}}">
                            API Settings
                        </a>
                    </li>
                    </ul>
                  </li>

                  <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                    <span class="lan-7">Admin Settings</span>
                    <div class="according-menu"><i class="fa-solid fa-angle-right"></i></div>
                    </a>
                    <ul class="sidebar-submenu" style="display: none;">
                    <li>
                        <a href="{{baseUrl('workspace')}}">
                            Workspace
                        </a>
                    </li>
                    </ul>
                  </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
<!-- Page Sidebar Ends-->
