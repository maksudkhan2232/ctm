<!-- START X-NAVIGATION -->
<?php
$menuname =  basename($_SERVER['PHP_SELF']);
?>
<ul class="x-navigation">
    <li class="xn-profile" style="background-color:#18778b;">
        <a href="#" class="profile-mini">
            <img src="<?php echo SITE;?>img/logo.png" alt="Suraj Cineplex"/>
        </a>
        <div class="profile">
            <div class="profile-image" >
                <img src="<?php echo SITE;?>img/suracineplexlogo.png" height="135px" style="width:205px;background-color: #ffffff;" />
            </div>
            <div class="profile-data">
                <div class="profile-data-name"><?php echo $_SESSION['suraj_admin_name'];?></div>
               <!--  <div class="profile-data-title">Adminstrator</div> -->
            </div>
        </div>                                                                        
    </li>
    <?php if($_SESSION['suraj_admin_right']=='admin'){ ?>
        <li <?php if($menuname=='dashboard.php'){ echo 'class="active"'; }?> >
            <a href=<?php echo SITE_DASHBOARD.'dashboard.php';?> >
                <span class="fa fa-desktop"></span> 
                <span class="xn-text">Dashboard</span>
            </a>                        
        </li>
        <li <?php if($menuname=='memberlist.php' || $menuname=='addmember.php'){ echo 'class="active"'; }?> >
            <a href=<?php echo ADMIN_SITE.'memberlist.php';?> >
                <span class="fa fa-user"></span>Member
            </a>
        </li>
        <li <?php if($menuname=='movielist.php' || $menuname=='addmovie.php'){ echo 'class="active"'; }?> ><a href=<?php echo ADMIN_SITE.'movielist.php';?> ><span class="fa fa-video-camera"></span>Movie Manage</a></li>
        <li <?php if($menuname=='moviescreenlist.php' || $menuname=='addmoviescreen.php' || $menuname=='screenchartlist.php' || $menuname=='addscreenchart.php' || $menuname=='viewscreenchart.php'){ echo 'class="active"'; }?>>
                <a href="javascript:void(0)"><span class="fa fa-laptop"></span>Screen</a>
                <ul>
                    <li <?php if($menuname=='moviescreenlist.php' || $menuname=='addmoviescreen.php'){ echo 'class="active"'; }?> ><a href=<?php echo ADMIN_SITE.'moviescreenlist.php';?> ><span class="glyphicon glyphicon-sound-dolby"></span>Screen Manage</a>
                    </li>
                    <li <?php if($menuname=='screenchartlist.php' || $menuname=='addscreenchart.php' ||  $menuname=='viewscreenchart.php'){ echo 'class="active"'; }?> ><a href=<?php echo ADMIN_SITE.'screenchartlist.php';?> ><span class="glyphicon glyphicon-sound-dolby"></span>Screen Chart</a>
                    </li>
                </ul> 
        </li> 
        
        <li <?php if($menuname=='movieshowlist.php' || $menuname=='addmovieshow.php'){ echo 'class="active"'; }?> ><a href=<?php echo ADMIN_SITE.'movieshowlist.php';?> ><span class="glyphicon glyphicon-sound-dolby"></span>Movie Show</a>
        <li <?php if($menuname=='assignshowlist.php' || $menuname=='assignshow.php' || $menuname=='editassignshow.php'){ echo 'class="active"'; }?> >
            <a href=<?php echo ADMIN_SITE.'assignshowlist.php';?> >
                <span class="fa fa-film"></span>Assign Show
            </a>
        </li>
        <li <?php if($menuname=='freezelist.php' || $menuname=='freezviewscreenchart.php' || $menuname=='freezeadd.php'  || $menuname=='releaseadd.php'){ echo 'class="active"'; }?> ><a href=<?php echo ADMIN_SITE.'freezelist.php';?> ><span class="fa fa-building-o"></span>Freeze / Release</a>
        </li>
        <li <?php if($menuname=='ticketbook.php' || $menuname=='screenchart.php'){ echo 'class="active"'; }?> >
            <a href=<?php echo TICKET_SITE.'ticketbook.php';?> >
                <span class="fa fa-ticket"></span>Ticket Booking
            </a>
        </li>
        <li <?php if($menuname=='dailysummeryreport.php' || $menuname=='viewdailysummery.php' || $menuname=='dailyreport.php' || $menuname=='viewdailyreport.php'){ echo 'class="active"'; }?>>
                <a href="javascript:void(0)"><span class="fa fa-laptop"></span>Report</a>
                <ul>
                    <li <?php if($menuname=='dailysummeryreport.php' || $menuname=='viewdailysummery.php'){ echo 'class="active"'; }?> >
                        <a href=<?php  echo SITE.'report/dailysummeryreport.php';?> >
                            <span class="fa fa-table"></span>
                            Daily Collection  Report
                            
                        </a>
                    </li>
                    <li <?php if($menuname=='dailyreport.php' || $menuname=='viewdailyreport.php'){ echo 'class="active"'; }?> >
                        <a href=<?php echo SITE.'report/dailyreport.php';?> ><span class="fa fa-table"></span>Daily Summery Report
                        </a>
                    </li>

                </ul> 
        </li>
        <li <?php if($menuname=='cancleshow.php' || $menuname=='addcancleshow.php'){ echo 'class="active"'; }?> >
            <a href=<?php echo ADMIN_SITE.'cancleshow.php';?> >
                <span class="fa fa-book"></span>Cancle Show
            </a>
        </li>
        <li <?php if($menuname=='daywisesaleticketlist.php'){ echo 'class="active"'; }?> ><a href=<?php echo TICKET_SITE.'daywisesaleticketlist.php';?> ><span class="fa fa-book"></span>Price Not Update Ticket List</a></li>

        <!-- <li <?php if($menuname=='sendsms.php' || $menuname=='sendsms.php'){ echo 'class="active"'; }?> ><a href=<?php echo ADMIN_SITE.'sendsms.php';?> ><span class="fa fa-envelope"></span>SMS</a></li> -->
        
        <!-- <li <?php if($menuname=='yearbackup.php'){ echo 'class="active"'; }?> ><a href=<?php echo SITE.'yearwise/yearbackup.php';?> ><span class="fa fa-upload"></span>Year Wise Show</a></li> -->
        <li <?php if($menuname=='backup-data.php'){ echo 'class="active"'; }?> >
            <a href=<?php echo ADMIN_SITE.'backup-data.php';?>>
                <span class="fa fa-download"></span>Backup
            </a>
        </li>
        <li>
            <a href="#" class="mb-control" data-box="#mb-signout">
                <span class="fa fa-sign-out"></span>Log Out
            </a>
        </li>
    <?php } ?>
    <?php if($_SESSION['suraj_admin_right']=='ticketwindow'){ ?>
        <li <?php if($menuname=='ticketbook.php' || $menuname=='screenchart.php'){ echo 'class="active"'; }?> ><a href=<?php echo TICKET_SITE.'ticketbook.php';?> ><span class="fa fa-ticket"></span>Ticket Booking</a></li>
        
        <li <?php if($menuname=='assignshowlist.php' || $menuname=='assignshow.php' || $menuname=='editassignshow.php'){ echo 'class="active"'; }?> >
            <a href=<?php echo ADMIN_SITE.'assignshowlist.php';?> >
                <span class="fa fa-film"></span>Assign Show
            </a>
        </li>
        <li <?php if($menuname=='freezelist.php' || $menuname=='freezviewscreenchart.php' || $menuname=='freezeadd.php'  || $menuname=='releaseadd.php'){ echo 'class="active"'; }?> >
            <a href=<?php echo ADMIN_SITE.'freezelist.php';?> >
                <span class="fa fa-building-o"></span>Freeze / Release
            </a>
        </li>
        <li <?php if($menuname=='cancleshow.php' || $menuname=='addcancleshow.php'){ echo 'class="active"'; }?> >
            <a href=<?php echo ADMIN_SITE.'cancleshow.php';?> >
                <span class="fa fa-book"></span>Cancle Show
            </a>
        </li>
        <li <?php if($menuname=='daywisesaleticketlist.php'){ echo 'class="active"'; }?> ><a href=<?php echo TICKET_SITE.'daywisesaleticketlist.php';?> ><span class="fa fa-book"></span>Price Not Update Ticket List</a></li>
        <li>
            <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></span>Log Out</a>
        </li>
        <!-- <li><br /><h3 style="margin-left:10px;color:#FFFFFF;line-height:28px;color:#FFFF66;"><center>Today's Collection <br /> 
        
            <?php
                $select_all_twelstream = $db->query_first('SELECT SUM(ticket_book_total_rs) as total FROM  suraj_movie_ticket_book WHERE is_delete="0" and ticket_book_entrydate="'.date('Y-m-d').'"');
                echo $select_all_twelstream['total'];
                ?>
        </center> 
        </h3></li> -->
    <?php } ?>
</ul>          