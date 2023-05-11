<!DOCTYPE html>
<html lang="en">
    <head> 
        <title>Suraj Cinpelex</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="shortcut icon" href="<?php echo SITE;?>favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo SITE;?>favicon.ico" type="image/x-icon"> 
        <link rel="stylesheet" type="text/css" id="theme" href="<?php echo SITE;?>css/theme-night-head-light.css"/>
        <script type="text/javascript">
            var webpath ="<?php echo SITE;?>";
        </script> 
        <script type="text/javascript">
        var warning="Alert";
        var warning="Alert";
        var a_error="";
        var ok="OK";
        var cancel="Cancel";
        </script>                                 
    </head>
    <head>        
    <!-- oncontextmenu="return false;" -->
    <body>
        <?php
            $menuname =  basename($_SERVER['PHP_SELF']);
            $menuheadname =  basename($_SERVER['PHP_SELF']);
        ?>
        <?php if($_SESSION['suraj_admin_right']=='ticketwindow' || $menuname=='ticketbook.php' || $menuname=='screenchart.php'){ ?>
            <div class="page-container page-navigation-toggled page-container-wide">
        <?php }else{ ?> 
            <div class="page-container">   
        <?php } ?>    
            <?php
                $menuname =  basename($_SERVER['PHP_SELF']);
                $menuheadname =  basename($_SERVER['PHP_SELF']);
            ?>
            <!-- START PAGE SIDEBAR -->
                <div class="page-sidebar">
                    <?php include('leftsidebar.php');?>
                </div>
            <!-- END PAGE SIDEBAR -->
            
            <!-- PAGE CONTENT -->
            <div class="page-content">
                
                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <!-- <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a> -->
                    </li>
                    <!-- END TOGGLE NAVIGATION -->
                    
                    <!-- SIGN OUT -->
                    <li class="xn-icon-button pull-right">
                        <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>                        
                    </li> 
                    <!-- END SIGN OUT -->
                   
                    
                    
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->
        
           
       