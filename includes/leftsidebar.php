<!-- START X-NAVIGATION -->
<?php
$menuname =  basename($_SERVER['PHP_SELF']);
?>
<ul class="x-navigation">
    <li class="xn-logo">
        <a href="#">Suraj Cineplex</a>
        <a href="#" class="x-navigation-control"></a>
    </li>
    <li class="xn-profile">
        <a href="#" class="profile-mini">
            <!-- <img src="<?php echo SITE;?>img/logo.png" alt="Suraj Cineplex"/> -->
        </a>
        <div class="profile">
            <div class="profile-image">
                <!-- <img src="<?php echo SITE;?>img/logo.png" alt="Suraj Cineplex"/> -->
            </div>
            <div class="profile-data">
                <!-- <div class="profile-data-name">
                    <?php echo $_SESSION['suraj_admin_name'];?>
                </div> -->
            </div>
        </div>                                                      
    </li>
    <?php if($_SESSION['suraj_admin_right']=='admin'){ ?>
        <li <?php if($menuname=='dashboard.php'){ echo 'class="active"'; }?> >
            <a href=<?php echo SITE_DASHBOARD.'dashboard.php';?>  title="Dashboard">
                <span class="fa fa-desktop"></span> 
                <span class="xn-text">Dashboard</span>
            </a>                        
        </li>
        <li <?php if($menuname=='memberlist.php' || $menuname=='addmember.php'){ echo 'class="active"'; }?> >
            <a href=<?php echo ADMIN_SITE.'memberlist.php';?> title="Member">
                <span class="fa fa-user"></span>
                <span class="xn-text">Member</span>
            </a>
        </li>
        <li <?php if($menuname=='movielist.php' || $menuname=='addmovie.php'){ echo 'class="active"'; }?> >
            <a href=<?php echo ADMIN_SITE.'movielist.php';?> title="Movie Manage">
                <span class="fa fa-video-camera"></span>
                <span class="xn-text">Movie Manage</span>
            </a>
        </li>
        <!-- <li <?php if($menuname=='moviescreenlist.php' || $menuname=='addmoviescreen.php' || $menuname=='screenchartlist.php' || $menuname=='addscreenchart.php' || $menuname=='viewscreenchart.php'){ echo 'class="active"'; }?>>
                <a href="javascript:void(0)"><span class="fa fa-laptop"></span>Screen</a>
                <ul>
                    <li <?php if($menuname=='moviescreenlist.php' || $menuname=='addmoviescreen.php'){ echo 'class="active"'; }?> ><a href=<?php echo ADMIN_SITE.'moviescreenlist.php';?> ><span class="glyphicon glyphicon-sound-dolby"></span>Screen Manage</a>
                    </li>
                    <li <?php if($menuname=='screenchartlist.php' || $menuname=='addscreenchart.php' ||  $menuname=='viewscreenchart.php'){ echo 'class="active"'; }?> ><a href=<?php echo ADMIN_SITE.'screenchartlist.php';?> ><span class="glyphicon glyphicon-sound-dolby"></span>Screen Chart</a>
                    </li>
                </ul> 
        </li>  -->
        <li <?php if($menuname=='movieshowlist.php' || $menuname=='addmovieshow.php'){ echo 'class="active"'; }?> >
            <a href=<?php echo ADMIN_SITE.'movieshowlist.php';?> title="Movie Show">
                <span class="glyphicon glyphicon-sound-dolby">
                </span>
                <span class="xn-text">Movie Show</span>
            </a>
        </li>
        <li <?php if($menuname=='assignshowlist.php' || $menuname=='assignshow.php' || $menuname=='editassignshow.php'){ echo 'class="active"'; }?> >
            <a href=<?php echo ADMIN_SITE.'assignshowlist.php';?> title="Assign Show" >
                <span class="fa fa-film"></span>
                <span class="xn-text">Assign Show</span>
            </a>
        </li>
        <li <?php if($menuname=='freezelist.php' || $menuname=='freezviewscreenchart.php' || $menuname=='freezeadd.php'  || $menuname=='releaseadd.php'){ echo 'class="active"'; }?> >
            <a href=<?php echo ADMIN_SITE.'freezelist.php';?> title="Freeze / Release" >
                <span class="fa fa-lock"></span>
                <span class="xn-text">Freeze / Release</span>
            </a>
        </li>
        <?php
            if($_SESSION['suraj_admin_id']=='16' || $_SESSION['suraj_admin_id']=='12'){
        ?>
        <li <?php if($menuname=='ticketbook.php' || $menuname=='screenchart.php'){ echo 'class="active"'; }?> >
            <a href=<?php echo TICKET_SITE.'ticketbook.php';?> title="Ticket Booking" >
                <span class="fa fa-ticket"></span>
                <span class="xn-text">Ticket Booking</span>
            </a>
        </li>
        <?php
            }
        ?>
        <!-- <li <?php if($menuname=='cancleshow.php' || $menuname=='addcancleshow.php'){ echo 'class="active"'; }?> >
            <a href=<?php echo ADMIN_SITE.'cancleshow.php';?> title="Cancle Show">
                <span class="fa fa-times"></span>
                <span class="xn-text">Cancle Show</span>
            </a>
        </li> --> 
        <li class="xn-openable<?php if($menuname=='dailysummeryreport.php' || $menuname=='viewdailysummery.php' || $menuname=='dailyreport.php' || $menuname=='viewdailyreport.php'){ echo 'active'; }?>">
            <a href="javascript:void(0)" title="Report">
                <span class="fa fa-list"></span>
                <span class="xn-text">Report</span>
            </a>
            <ul>
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
        
        <!-- <li <?php if($menuname=='daywisesaleticketlist.php'){ echo 'class="active"'; }?> >
            <a href=<?php echo TICKET_SITE.'daywisesaleticketlist.php';?> >
                <span class="fa fa-book"></span>
                <span class="xn-text">
                    Price Not Update Ticket List
                </span>
            </a>
        </li>  -->
        <!-- <li <?php if($menuname=='yearbackup.php'){ echo 'class="active"'; }?> ><a href=<?php echo SITE.'yearwise/yearbackup.php';?> ><span class="fa fa-upload"></span>Year Wise Show</a></li> -->
        <li <?php if($menuname=='backup-data.php'){ echo 'class="active"'; }?> >
            <a href=<?php echo ADMIN_SITE.'backup-data.php';?> title="Backup" >
                <span class="fa fa-download"></span>
                <span class="xn-text">Backup</span>
            </a>
        </li>
        <li>
            <a href="#" class="mb-control" data-box="#mb-signout">
                <span class="fa fa-sign-out"></span>
                <span class="xn-text">Log Out</span>
            </a>
        </li>        
    <?php } ?>
    <?php if($_SESSION['suraj_admin_right']=='ticketwindow'){ ?>
        <li <?php if($menuname=='ticketbook.php' || $menuname=='screenchart.php'){ echo 'class="active"'; }?> >
            <a href=<?php echo TICKET_SITE.'ticketbook.php';?> title="Ticket Booking"  >
                <span class="fa fa-ticket"></span>
                <!-- <span class="xn-text">Ticket Booking</span> -->
            </a>
        </li>
        <li <?php if($menuname=='assignshowlist.php' || $menuname=='assignshow.php' || $menuname=='editassignshow.php'){ echo 'class="active"'; }?> >
            <a href=<?php echo ADMIN_SITE.'assignshowlist.php';?> title="Assign Show" >
                <span class="fa fa-film"></span>
                <!-- <span class="xn-text">Assign Show</span> -->
            </a>
        </li>
        <li <?php if($menuname=='freezelist.php' || $menuname=='freezviewscreenchart.php' || $menuname=='freezeadd.php'  || $menuname=='releaseadd.php'){ echo 'class="active"'; }?> >
            <a href=<?php echo ADMIN_SITE.'freezelist.php';?> title="Freeze / Release" >
                <span class="fa fa-lock"></span>
                <!-- <span class="xn-text">Freeze / Release</span> -->
            </a>
        </li>
        <li>
            <a href="#" class="mb-control" data-box="#mb-signout">
                <span class="fa fa-sign-out"></span>
            </a>
        </li>
    <?php } ?>    
</ul>
<!-- END X-NAVIGATION -->
          