<!DOCTYPE html>
<html lang="en">
    <head> 
        <title><?php echo $title;?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?php echo $description;?>"/>
        <meta name="author" content="<?php echo $author;?>"  />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="<?php echo SITE;?>assets/images/favicon.ico">
        <link href="<?php echo SITE;?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
        <link href="<?php echo SITE;?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo SITE;?>assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />
        
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
    <body data-layout="horizontal">
        <div id="wrapper">
            <!-- Navigation Bar-->
            <header id="topnav">
                <?php include('topmenubar.php');?>
            </header>
            <!-- End Navigation Bar-->
            
           