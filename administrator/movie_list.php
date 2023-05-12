<?php include("../includes/config.php");
isLoggedIn();
if($_SESSION['user_session_right']!='administrator'){
  header('location:' . SITE . 'index.php');
}
include("../includes/header.php");
?>
<?php 
    if($_SESSION['user_session_right']=='administrator'){
      if (isset($_REQUEST['btnaction']) == "Delete") {
          $error = '';
          $movieid = $_GET['id'];
          
          // booking avaiblable or not
          $select_booking = "SELECT book_id FROM ticket_book WHERE  is_delete='0' and book_movieid='".$movieid."' Group by book_movieid"; 
          $select_booking = $db->selectOne($select_booking);
          if(empty($select_booking)){
            $chk_sql=$db->query("delete from movie where id='".$movieid."' and isdelete='0'");

            $chk_sql=$db->query("delete from movie_show_assign where movieid='".$utid."' and isdelete='0'");  
            echo "<script>window.location.href = 'movie_list.php?recordmsg=successdelete';</script>";
          }else{
            echo "<script>window.location.href = 'movie_list.php';</script>";
          }
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
                <h5 class="font-14">List of Movie</h5>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mt-5">
                <p style="float:right"> 
                  <a href="<?php echo ADMIN_SITE.'movie_add.php';?>" class="btn btn-danger btn-rounded">
                    Add New Movie
                  </a>
                </p>
              </div>
            </div>
          </div>
          <div class="row d-flex justify-content-center">
            <div class="col-lg-12">
              <table id="responsive-datatable" class="table table-bordered table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Duration</th>
                    <th>Release Date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $selectallmovie = "SELECT * FROM movie WHERE  isdelete='0' Order by release_date DESC"; 
                    $row = $db->selectAll($selectallmovie);
                    foreach ($row as $key => $moviedetails) {
                  ?>
                  <tr>
                    <td>
                      <?php echo $moviedetails['name'];?>
                    </td>
                    <td>
                      <?php echo $moviedetails['duration'];?>
                    </td>                                        
                    <td>
                      <?php echo $moviedetails['release_date'];?>
                    </td>
                    <?php
                        if($moviedetails['status']=='1'){
                    ?>
                        <td>
                          <span class="badge badge-success badge-pill">Active</span>
                        </td>
                    <?php
                        }else{
                    ?>
                        <td>
                          <span class="badge badge-danger badge-pill">In Active</span>
                        </td>
                    <?php
                        }
                    ?>
                    <td>
                        <?php if($_SESSION['user_session_right']=='administrator'){ ?>
                        <a href="movie_edit.php?btnaction=Edit&id=<?php echo $moviedetails['id'];?>">
                            <span class="btn btn-primary btn-sm  mr-1">
                                Edit
                            </span>
                        </a>

                        <a href="movie_list.php?btnaction=Delete&id=<?php echo $moviedetails['id'];?>">
                            <span class="btn btn-danger btn-sm  mr-1">
                                Delete
                            </span>
                        </a>
                        <?php
                            }
                        ?>
                    </td>
                  </tr>
                  <?php     
                      }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    
<?php } ?>                                
    
<?php include('../includes/footer.php');?>
