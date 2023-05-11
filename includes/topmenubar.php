<!-- Topbar Start -->
<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-right mb-0">

            <li class="dropdown notification-list">
                <!-- Mobile menu toggle-->
                <a class="navbar-toggle nav-link">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>                                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="<?php echo SITE;?>assets/images/users/avatar-1.jpg" alt="user-image" class="rounded-circle">
                    <span class="pro-user-name d-none d-xl-inline-block ml-2">  <?php echo $_SESSION['user_session_name'];?>
                       <i class="mdi mdi-chevron-down"></i>
                    </span>                                
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>
                    <a href=<?php echo ADMIN_SITE.'userlist.php';?> title="User Manage" class="dropdown-item notify-item">
                        <i class="mdi mdi-user"></i>
                        User Manage
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="mdi mdi-account-outline"></i>
                        <span>Profile</span>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="mdi mdi-lock-outline"></i>
                        <span>Lock Screen</span>
                    </a>
                    <a href=<?php echo ADMIN_SITE.'backup-data.php';?> title="Backup" class="dropdown-item notify-item">
                        <i class="mdi mdi-download"></i>
                        <span>Backup</span>
                    </a>
               
                    <div class="dropdown-divider"></div>
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="mdi mdi-logout-variant"></i>
                        <span>Logout</span>
                    </a>                             
                </div>
            </li>
        </ul>

        <!-- LOGO -->
        <div class="logo-box">
            <a href="<?php echo SITE;?>" class="logo text-center">
                <span class="logo-lg">
                    <img src="<?php echo SITE;?>assets/images/logo-light.png" alt="" height="26">
                </span>
                <span class="logo-sm">
                    <img src="<?php echo SITE;?>assets/images/logo-sm.png" alt="" height="22">                                
                </span>
            </a>
        </div>

        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu">
                <li class="has-submenu">
                    <a href="<?php echo ADMIN_SITE;?>dashboard.php">
                        <i class="ti-home"></i>Dashboard                                    
                    </a>                                
                </li>
                              
                <li class="has-submenu <?php if($menuname=='movie_list.php' || $menuname=='movie_addedit.php'){ echo 'active'; }?>">
                    <a href=<?php echo ADMIN_SITE.'movie_list.php';?> title="Movie Manage" >
                        <i class="ti-video-camera"></i>
                        Movie Manage
                    </a>
                </li>
               
                <li class="has-submenu">
                    <a href="#"> <i class="mdi mdi-flip-horizontal"></i>Screen Manage</a>
                    <ul class="submenu">
                        <li><a href="<?php echo ADMIN_SITE.'screenlist.php';?>">Screen Manage</a></li>
                        <li><a href="<?php echo ADMIN_SITE.'screenchartlist.php';?>">Screen Chart</a></li>
                        <li><a href="<?php echo ADMIN_SITE.'screentypelist.php';?>">Screen Type</a></li>
                    </ul>
                </li>
                <li class="has-submenu">
                    <a href="#"> <i class="ti-spray"></i>Show Manage </a>
                    <ul class="submenu">
                        <li><a href="<?php echo ADMIN_SITE.'movieshowlist.php';?>">Movie Show Name</a></li>
                        <li><a href="<?php echo ADMIN_SITE.'assignshowlist.php';?>">Assign Show </a></li>
                        <li><a href="<?php echo ADMIN_SITE.'cancleshow.php';?>">Cancle Show </a></li>
                        <li><a href="<?php echo ADMIN_SITE.'freezelist.php';?>"> Freeze / Release </a></li>
                    </ul>
                </li>               
               <li <?php if($menuname=='ticketbook.php' || $menuname=='screenchart.php'){ echo 'class="active"'; }?> class="has-submenu" >
                    <a href=<?php echo BOXOFFICE_SITE.'ticketbook.php';?> title="Ticket Booking" >
                        <!-- <i class="ti-ticket"></i> -->
                        <span class="xn-text">Ticket Booking</span>
                    </a>
                </li> 
                
               
                <li class="has-submenu">
                    <a href="javascript:void(0)" title="Report">
                        <span class="fa fa-list"></span>
                        <span class="xn-text">Report</span>
                    </a>
                    <ul class="submenu">
                        <li <?php if($menuname=='dailysummeryreport.php' || $menuname=='viewdailysummery.php'){ echo 'class="active"'; }?> >
                            <a href=<?php  echo SITE.'report/dailysummeryreport.php';?> title="Daily Collection  Report">
                                <span class="fa fa-table"></span>
                                Daily Collection  Report
                            </a>
                        </li>
                        <li <?php if($menuname=='dailyreport.php' || $menuname=='viewdailyreport.php'){ echo 'class="active"'; }?> >
                            <a href=<?php echo SITE.'report/dailyreport.php';?> title="Booking History Report">
                                <span class="fa fa-table"></span>
                                Booking History Report
                            </a>
                        </li>

                    </ul> 
                </li>
            </ul>
            <!-- End navigation menu -->

            <div class="clearfix"></div>
        </div>
        <!-- end #navigation -->

        <div class="clearfix"></div>
    </div>
</div>
<!-- end Topbar -->
