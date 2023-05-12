<?php include("../includes/config.php");
isLoggedIn();
include("../includes/header.php");
?>
<?php 
    if($_SESSION['user_session_right']=='administrator'){
      $id=isset($_GET['id'])?$_GET['id']:NULL;
      if(!empty($id)) {
          $moviedetails = "SELECT * from movie where id='".$id."' and isdelete=0 and status=1";
          $moviedetails = $db->selectOne($moviedetails);   
          $moviename = stripslashes($moviedetails['name']);
          $release_date = stripslashes($moviedetails['release_date']);
          $hours = $moviedetails['hours'];
          $minute = $moviedetails['minute'];
          $runing_time = $moviedetails['runing_time'];
      }
      if(isset($_REQUEST['movie_edit'])){
        $moviename = isset($_POST['moviename'])?trim($_POST['moviename']):'';
        $hours = isset($_POST['hours'])?trim($_POST['hours']):'0';
        $minute = isset($_POST['minute'])?trim($_POST['minute']):'0';
        $duration = (($hours*60)+$minute);
        $release_date = isset($_POST['release_date'])?trim($_POST['release_date']):'';
        $runing_time = isset($_POST['runing_time'])?trim($_POST['runing_time']):'';
        $status = isset($_POST['status'])?trim($_POST['status']):''; 
        
        $data_movie = array();
        $data_movie['name'] = $moviename;
        $data_movie['duration'] = $duration;        
        $data_movie['release_date'] = $release_date;
        $data_movie['hours'] = $hours;        
        $data_movie['minute'] = $minute;
        $data_movie['runing_time'] = $runing_time;
        $data_movie['status'] = '1';
        $data_movie['isdelete'] = '0';
        $data_movie['created_datetime'] = date('Y-m-d H:i:s');
        $data_movie['created_ip'] = $_SERVER['REMOTE_ADDR'];;
        $data_movie['created_by'] = $_SESSION['user_session_id'];
        $res=$db->query_update('movie',$data_movie,'id = '.$id);
        echo "<script>window.location.href = 'movie_list.php?recordmsg=successedit';</script>";     
        
                   
    }
?>
    
    <div class="content-page">
      <div class="content">
        <!-- Start container-fluid -->
        <div class="container-fluid">
          <?php 
              $alertmsg= isset($_GET['recordmsg'])?trim($_GET['recordmsg']):'';
              if(isset($alertmsg)=='successadd' && $alertmsg !='successedit' &&  $alertmsg !='successdelete'  &&  $alertmsg !=''){
                  echo '<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" id=""><span aria-hidden="true">×</span><span class="sr-only" >Close</span></button>';
                  echo '<strong>Well done!</strong> Your record successfully inserted.';
                  echo '</div>';
              }
              if(isset($alertmsg)=='successedit' && $alertmsg !='successadd' &&  $alertmsg !='successdelete'  &&  $alertmsg !=''){
                  echo '<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" id=""><span aria-hidden="true">×</span><span class="sr-only" >Close</span></button>';
                  echo '<strong>Well done!</strong> Your record successfully edit.';
                  echo '</div>';
              }
              if(isset($alertmsg)=='successdelete' && $alertmsg !='successadd' &&  $alertmsg !='successedit'  &&  $alertmsg !=''){
                  echo '<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" id=""><span aria-hidden="true">×</span><span class="sr-only" >Close</span></button>';
                  echo '<strong>Well done!</strong> Your record successfully deleted.';
                  echo '</div>';
              }
          ?>
          <div class="row d-flex justify-content-center">
            <div class="col-lg-6">
              <div class="mt-5">
                <h5 class="font-14">Edit Movie</h5>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mt-5">
                <p style="float:right"> 
                  <a href="<?php echo ADMIN_SITE.'movie_list.php';?>" class="btn btn-danger btn-rounded">
                   <i class="fa fa-back"></i> Back
                  </a>
                </p>
              </div>
            </div>
          </div>
          <div class="row d-flex justify-content-center">
            <div class="col-lg-6">
              <form class="form-horizontal" method="post">
                <div class="form-group row">
                  <label class="col-md-3 col-form-label">
                    Movie Name 
                    <span class="text-danger">*</span>
                  </label>
                  <div class="col-md-9">
                    <div class="input-group">
                      <div class="input-group-prepend"> 
                        <span class="input-group-text">
                          <i class="fa fa-pen"></i>
                        </span> 
                      </div>
                      <input type="text" id="moviename" name="moviename" class="form-control" placeholder="Enter Movie Name" value="<?php echo $moviename;?>">
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 col-form-label" for="example-email">
                    Duration 
                    <span class="text-danger">*</span>
                  </label>
                  <div class="col-md-5">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-clock"></i> &nbsp; Hours
                        </span>
                      </div>
                      <select class="form-control" name="hours" id="hours">
                        <?php
                          for ($i=1; $i<=3; $i++) { 
                            $selected='';
                            if($hours==$i){
                              $selected=' selected';
                            }
                            echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-clock"></i> &nbsp; Minute
                        </span>
                      </div>
                      <select class="form-control" name="minute" id="minute">
                       <?php
                            for ($i=1; $i<=60; $i++) { 
                                $selected='';
                                if($minute==$i){
                                  $selected=' selected';
                                }
                                echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
                            }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 col-form-label" for="example-email">Release Date <span class="text-danger">*</span></label>
                  <div class="col-md-9">
                    <div class="input-group">
                      <div class="input-group-prepend"> 
                        <span class="input-group-text">
                          <i class="fa fa-calendar"></i>
                        </span> 
                      </div>
                      <input type="date" id="release_date" name="release_date" class="form-control" placeholder="Enter Release Date" value="<?php echo $release_date;?>">
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 col-form-label">
                    Movie Run Week
                    <span class="text-danger">*</span>
                  </label>
                  <div class="col-md-9">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-calendar-alt"></i>
                        </span>
                      </div>
                      <select class="form-control" name="runing_time">
                        <?php
                          for ($i=1; $i<=10; $i++) { 
                            $selected='';
                            if($runing_time==$i){
                              $selected=' selected';
                            }
                            echo '<option value="'.$i.'" '.$selected.'>'.$i.' Week</option>';
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>                                      
                <div class="row d-flex justify-content-center mt-5"> 
                  <a href="<?php echo ADMIN_SITE.'movie_list.php';?>" class="btn btn-danger btn-lg btn-bordered-danger mr-5">Back</a>
                  <button type="submit" class="btn btn-primary btn-lg btn-bordered-primary" name="movie_edit">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    
<?php } ?>                                
    
<?php include('../includes/footer.php');?>
