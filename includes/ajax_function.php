<?php
include("config.php");
if(isset($_REQUEST['datewisepanelshow'])){
  global $db;    
    $movieid = isset($_POST['movieid'])?trim($_POST['movieid']):'';
    $movie_qry = "select * from suraj_movie where suraj_movie_id_pk ='".$movieid."'";
    $movieinfomation = $db->selectOne($movie_qry);
    $suraj_movie_name = $movieinfomation['suraj_movie_name'];
    $suraj_movie_duration = $movieinfomation['suraj_movie_duration'];
    $suraj_movie_release_date = $movieinfomation['suraj_movie_release_date'];
    $suraj_movie_runing_time = $movieinfomation['suraj_movie_runing_time'];
    $srtBox = '';
    $d=0;
    $current_date =date('Y-m-d');
    $realse_date=$suraj_movie_release_date;
    $suraj_movie_runing_time =$suraj_movie_runing_time; 
    $str_to_convert_date = strtotime($realse_date);
    $srtBox .='<div class="panel panel-default">';
      $srtBox .='<div class="panel-body">';
          $srtBox .='<table class="table table-bordered">';
          $srtBox .='<tr>';
              $srtBox .='<th>DATE</th>';
              $srtBox .='<th>START TIME</th>';
              $srtBox .='<th>END TIME</th>';
              $srtBox .='<th>SILVER TICKET RATE</th>';
              $srtBox .='<th>GOLD TICKET RATE</th>';
              $srtBox .='<th>Apply</th>';
          $srtBox .='</tr>';
          if($suraj_movie_runing_time==2){
              $realse_date_twoweek=$suraj_movie_release_date;
              $realse_date_twoweek = strtotime($realse_date_twoweek);
              $nextwee = date('Y-m-d',strtotime("+7 day",$realse_date_twoweek));
              $realse_date_nextweek = strtotime($nextwee);
              $sevendayago = strtotime("+7 day", $realse_date_nextweek);
              $d=7;
              for($i=0;$i<=7;$i++){
                $dat = date('d-m-Y',strtotime('+'.$i.' day', $realse_date_nextweek));

                $onlydaymon = date('dm',strtotime('+'.$i.' day', $realse_date_nextweek));
                echo '<input type="hidden" name="movie_date_select[]" value="'.$onlydaymon.'">';
                $srtBox .='<tr>';
                    $srtBox .='<td>';
                        $srtBox .='<div class="form-group">';
                            $srtBox .='<label class="col-md-3 col-xs-12 control-label">Date<span>*</span></label>';
                            $srtBox .='<div class="col-md-9 col-xs-12"> ';
                               $srtBox .='<div class="input-group">';
                                    $srtBox .='<span class="input-group-addon"><span class="fa fa-calendar"></span></span>';
                                     $srtBox .='<input type="hidden" name="movie_date'.$onlydaymon.'[]" value="'.date('Y-m-d',strtotime($dat)).'">';
                                    $srtBox .='<input type="text" class="form-control" value="'.$dat.'" readonly>';
                                $srtBox .='</div>';
                            $srtBox .='</div>';
                        $srtBox .='</div>';
                    $srtBox .='</td>';
                    $srtBox .='<td>';
                        $srtBox .='<div class="form-group">';
                            $srtBox .='<label class="col-md-3 col-xs-12 control-label">Start Time </label>';
                            $srtBox .='<div class="col-md-9 col-xs-12"> ';
                               $srtBox .='<div class="input-group bootstrap-timepicker">';
                                    $srtBox .='<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>';
                                     $srtBox .='<input type="text" class="form-control timepicker thisstartfill" name="moviestarttime'.$onlydaymon.'[]" id="thisstartfill" onblur="allstartimefill()" placeholder="Select Start Time">';
                                $srtBox .='</div>';
                            $srtBox .='</div>';
                        $srtBox .='</div>';
                    $srtBox .='</td>';
                    $srtBox .='<td>';
                        $srtBox .='<div class="form-group">';
                            $srtBox .='<label class="col-md-3 col-xs-12 control-label">End Time </label>';
                            $srtBox .='<div class="col-md-9 col-xs-12"> ';
                               $srtBox .='<div class="input-group bootstrap-timepicker ">';
                                    $srtBox .='<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>';
                                     $srtBox .='<input type="text" class="form-control timepicker thisendtfill" name="movieendtime'.$onlydaymon.'[]" id="thisendtfill" onblur="allendtimefill()" placeholder="Select End Time">';
                                $srtBox .='</div>';
                            $srtBox .='</div>';
                        $srtBox .='</div>';
                    $srtBox .='</td>';
                    
                    $srtBox .='<td>';
                        $srtBox .='<div class="form-group">';
                            $srtBox .='<label class="col-md-3 col-xs-12 control-label">SEAT RATE</label>';
                            $srtBox .='<div class="col-md-9 col-xs-12"> ';
                               $srtBox .='<div class="input-group">';
                                    $srtBox .='<span class="input-group-addon">Rs</span></span>';
                                     $srtBox .='<input type="text" id="seatautofilled" class="form-control seatautofilled" name="movieticketrate'.$onlydaymon.'[]" placeholder="Enter Silver Ticket Rate" onblur="seatautofilledfunction()">';
                                $srtBox .='</div>';
                            $srtBox .='</div>';
                        $srtBox .='</div>';
                    $srtBox .='</td>';
                    $srtBox .='<td>';
                        $srtBox .='<div class="form-group">';
                            $srtBox .='<label class="col-md-3 col-xs-12 control-label">SOFA RATE</label>';
                            $srtBox .='<div class="col-md-9 col-xs-12"> ';
                               $srtBox .='<div class="input-group">';
                                    $srtBox .='<span class="input-group-addon">Rs</span></span>';
                                     $srtBox .='<input type="text" id="allsofapricefill" class="form-control allsofapricefill" name="moviesofarate'.$onlydaymon.'[]" placeholder="Enter Gold Ticket Rate" onblur="sofaautofilledfunction()">';
                                $srtBox .='</div>';
                            $srtBox .='</div>';
                        $srtBox .='</div>';
                    $srtBox .='</td>';
                $srtBox .='</tr>';
              }
          }else{
              $sevendayago = strtotime("+7 day", $str_to_convert_date);
              $d=6;
              for($i=0;$i<=6;$i++){
                $dat = date('d-m-Y',strtotime('+'.$i.' day', $str_to_convert_date));
                $onlydaymon = date('dm',strtotime('+'.$i.' day', $str_to_convert_date));
                echo '<input type="hidden" name="movie_date_select[]" value="'.$onlydaymon.'">';
                $srtBox .='<tr>';
                    $srtBox .='<td>';
                        $srtBox .='<div class="form-group">';
                        $srtBox .='<div class="col-md-9 col-xs-12"> ';
                        $srtBox .='<div class="input-group">';
                        $srtBox .='<span class="input-group-addon"><span class="fa fa-calendar"></span></span>';
                        $srtBox .='<input type="hidden" name="movie_date'.$onlydaymon.'[]" value="'.date('Y-m-d',strtotime($dat)).'">';
                        $srtBox .='<input type="text" class="form-control" value="'.$dat.'" readonly>';
                        $srtBox .='</div>';
                        $srtBox .='</div>';
                        $srtBox .='</div>';
                    $srtBox .='</td>';
                    $srtBox .='<td>';
                        $srtBox .='<div class="form-group">';
                            $srtBox .='<div class="col-md-9 col-xs-12"> ';
                               $srtBox .='<div class="input-group bootstrap-timepicker">';
                                    $srtBox .='<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>';
                                     $srtBox .='<input type="text" class="form-control timepicker starttimefill" name="moviestarttime'.$onlydaymon.'[]" id="starttimefill'.$onlydaymon.'" placeholder="Select Start Time">';
                                $srtBox .='</div>';
                            $srtBox .='</div>';
                        $srtBox .='</div>';
                    $srtBox .='</td>';
                    $srtBox .='<td>';
                        $srtBox .='<div class="form-group">';
                            
                            $srtBox .='<div class="col-md-9 col-xs-12"> ';
                               $srtBox .='<div class="input-group bootstrap-timepicker ">';
                                    $srtBox .='<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>';
                                     $srtBox .='<input type="text" class="form-control timepicker endtimefill" name="movieendtime'.$onlydaymon.'[]" id="endtimefill'.$onlydaymon.'" placeholder="Select End Time" >';
                                $srtBox .='</div>';
                            $srtBox .='</div>';
                        $srtBox .='</div>';
                    $srtBox .='</td>';
                    $srtBox .='<td>';
                        $srtBox .='<div class="form-group">';
                            $srtBox .='<div class="col-md-12 col-xs-12"> ';
                               $srtBox .='<div class="input-group">';
                                    $srtBox .='<span class="input-group-addon">Rs</span></span>';
                                     $srtBox .='<input type="text" id="seatautofilled'.$onlydaymon.'" class="form-control seatautofilled" name="movieticketrate'.$onlydaymon.'[]" placeholder="Enter Silver Ticket Rate" maxlength="3">';
                                $srtBox .='</div>';
                            $srtBox .='</div>';
                        $srtBox .='</div>';
                    $srtBox .='</td>';
                    $srtBox .='<td>';
                        $srtBox .='<div class="form-group">';
                            
                            $srtBox .='<div class="col-md-12 col-xs-12"> ';
                               $srtBox .='<div class="input-group">';
                                    $srtBox .='<span class="input-group-addon">Rs</span></span>';
                                     $srtBox .='<input type="text" id="sofapricefill'.$onlydaymon.'" class="form-control sofapricefill" name="moviesofarate'.$onlydaymon.'[]" placeholder="Enter Gold Ticket Rate" maxlength="3">';
                                $srtBox .='</div>';
                            $srtBox .='</div>';
                        $srtBox .='</div>';
                    $srtBox .='</td>';
                    $srtBox .='<td>';
                        $srtBox .='<div class="form-group">';
                        $srtBox .='<div class="col-md-5 col-xs-12"> ';
                          $srtBox .='<span class="btn btn-info btn-sm" onclick="return applyassignshowdat(';
                          $srtBox .="'$onlydaymon'";
                          $srtBox .=');">';
                          $srtBox .='<span class="fa fa-eye"></span>
                                </span>';
                        $srtBox .='</div>';
                        $srtBox .='</div>';
                    $srtBox .='</td>';
                $srtBox .='</tr>';
              }
          }
         $srtBox .='</table>';
      $srtBox .='</div>';
    $srtBox .='</div>';
        $srtBox .='<script type="text/javascript" src="'.SITE.'js/plugins/jquery/jquery.min.js"></script>';       
        $srtBox .='<script type="text/javascript" src="'.SITE.'js/plugins/bootstrap/bootstrap.min.js"></script>';
        $srtBox .='<script type="text/javascript" src="'.SITE.'js/plugins/bootstrap/bootstrap-timepicker.min.js"></script>';
        $srtBox .='<script type="text/javascript" src="'.SITE.'js/plugins.js"></script>'; 
        $srtBox .='<script type="text/javascript" src="'.SITE.'js/genral.js"></script>';
    echo $srtBox;exit;
}
if(isset($_REQUEST['shwotodaymovietime'])){
    global $db;
    $strBox = '';
    $movieid = isset($_POST['movieid'])?trim($_POST['movieid']):'';
    $screenid = isset($_POST['screenid'])?trim($_POST['screenid']):'';
    $sql_state = 'SELECT movie_assign_start_time,movie_assign_end_time FROM movie_assign WHERE is_delete="0" and movie_assign_status="Active" and movie_assign_name="'.$movieid.'" and  movie_assign_screen="'.$screenid.'" and movie_assign_date="'.date('d-m-Y').'"';
    $sql_state .=' ORDER BY movie_assign_pk ASC';
    $res2 = $db->selectAll($sql_state);
    $strBox .='<div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span><select class="form-control" name="movie_show_time" id="movie_show_time" onchange="viewmovieprice('.$movieid.','.$screenid.',this.value)" required>';
    $strBox .='<option value="">--Select Show Time--</option>';
    $time = date('g:i A');
    if ($res2 != false) {
      foreach ($res2 as $res_state) {
          //if(strtotime($res_state['movie_assign_start_time'])>=strtotime($time)){
            $strBox .='<option value="'.$res_state['movie_assign_start_time'].'-'.$res_state['movie_assign_end_time'].'">' . $res_state['movie_assign_start_time'].' - '.$res_state['movie_assign_end_time'].'</option>';
          //}
      }
    }
    $strBox .='</select></div>';
    echo $strBox;
    exit;
    
}
if(isset($_REQUEST['shwotodaymovietimewiseprice'])){
    global $db;
    $strBox = '';
    $movieid = isset($_POST['movieid'])?trim($_POST['movieid']):'';
    $screenid = isset($_POST['screenid'])?trim($_POST['screenid']):'';
    $movietime = isset($_POST['movietime'])?trim($_POST['movietime']):'';
    $timeexplode = explode('-',$movietime);
    $statime=$timeexplode[0];
    $endtime=$timeexplode[1];
    $sql_state = 'SELECT movie_sofa_ticket_rate,movie_sheet_ticket_rate,movie_assign_show FROM movie_assign WHERE is_delete="0" and movie_assign_status="Active" and movie_assign_name="'.$movieid.'" and  movie_assign_screen="'.$screenid.'" and movie_assign_start_time="'.$statime.'" and movie_assign_end_time ="'.$endtime.'" and  movie_assign_date="'.date('d-m-Y').'"';
    $res2 = $db->selectOne($sql_state);
      $strBox .='<input type="hidden" name="movie_sheet_ticket_rate" id="movie_sheet_ticket_rate" value="'.$res2['movie_sheet_ticket_rate'].'">';
      $strBox .='<input type="hidden" name="movie_sofa_ticket_rate" id="movie_sofa_ticket_rate" value="'.$res2['movie_sofa_ticket_rate'].'">';
      $strBox .='<input type="hidden" name="movie_assign_show" id="movie_assign_show" value="'.$res2['movie_assign_show'].'">';
    echo $strBox;
    exit;
    
}
if(isset($_REQUEST['getnotupdateprice'])){
    global $db;
    $strBox = '';
    $movieid = isset($_POST['movieid'])?trim($_POST['movieid']):'';
    $screen = isset($_POST['screen'])?trim($_POST['screen']):'';
    $date = isset($_POST['date'])?trim($_POST['date']):'';
    $showtime = isset($_POST['showtime'])?trim($_POST['showtime']):'';
    $sofakeseat = isset($_POST['sofakeseat'])?trim($_POST['sofakeseat']):'';
    $bookid = isset($_POST['bookid'])?trim($_POST['bookid']):'';
    $timeexplode = explode('-',$showtime);
    $statime=$timeexplode[0];
    $endtime=$timeexplode[1];
    if($sofakeseat=="SEAT"){
      $sql_state = 'SELECT movie_sheet_ticket_rate,movie_assign_show FROM movie_assign WHERE is_delete="0" and  movie_assign_status="Active" and movie_assign_name="'.$movieid.'" and  movie_assign_screen="'.$screen.'" and movie_assign_start_time="'.$statime.'" and movie_assign_end_time ="'.$endtime.'" and  movie_assign_date="'.date('d-m-Y',strtotime($date)).'"';
      $res2 = $db->selectOne($sql_state);
      $strBox .='<input type="hidden" name="moviesheetticketrate'.$bookid.'" id="moviesheetticketrate'.$bookid.'" value="'.$res2['movie_sheet_ticket_rate'].'">';
      $strBox .='<input type="hidden" name="movieassignshow'.$bookid.'" id="movieassignshow'.$bookid.'" value="'.$res2['movie_assign_show'].'">';
      echo "Ticket :".$res2['movie_sheet_ticket_rate']." RS and ".strtoupper(getshowname($res2['movie_assign_show'])).$strBox;
    }
    if($sofakeseat=="SOFA"){
      $sql_state = 'SELECT movie_sofa_ticket_rate,movie_sheet_ticket_rate,movie_assign_show FROM movie_assign WHERE is_delete="0" and  movie_assign_status="Active" and movie_assign_name="'.$movieid.'" and  movie_assign_screen="'.$screen.'" and movie_assign_start_time="'.$statime.'" and movie_assign_end_time ="'.$endtime.'" and  movie_assign_date="'.date('d-m-Y',strtotime($date)).'"';
      $res2 = $db->selectOne($sql_state);
      $strBox .='<input type="hidden" name="moviesheetticketrate'.$bookid.'" id="moviesheetticketrate'.$bookid.'" value="'.$res2['movie_sheet_ticket_rate'].'">';
      $strBox .='<input type="hidden" name="movieassignshow'.$bookid.'" id="movieassignshow'.$bookid.'"  value="'.$res2['movie_assign_show'].'">';
      echo $strBox;
    }
    
    
    exit;
    
}

if(isset($_REQUEST['savenotupdateprice'])){
    global $db;
    $strBox = '';
    $bookid = isset($_POST['bookid'])?trim($_POST['bookid']):'';
    $ticketshow = isset($_POST['ticketshow'])?trim($_POST['ticketshow']):'';
    $ticketrate = isset($_POST['ticketrate'])?trim($_POST['ticketrate']):'';
    $data_student = array();
    $data_student['ticket_book_rs']= $ticketrate;
    $data_student['ticket_book_show_name']= getshowname($ticketshow);
    $data_student['ticket_book_total_rs']= $ticketrate;
    $res=$db->query_update('suraj_movie_ticket_book',$data_student,'ticket_book_id_pk= '.$bookid);
    exit;
    
}
if(isset($_REQUEST['tickettotalcount'])){
  $book_moviename = isset($_POST['book_moviename'])?$_POST['book_moviename']:'';
  $book_screen_number = isset($_POST['book_screen_number'])?$_POST['book_screen_number']:'';
  $book_show_time = isset($_POST['book_show_time'])?$_POST['book_show_time']:'';
  $book_date = isset($_POST['book_date'])?$_POST['book_date']:'';
  $movie_assign_show = isset($_POST['movie_assign_show'])?$_POST['movie_assign_show']:'';
  $screen_seriase_number = isset($_POST['ticket_book_sheet_seriasewithnumber'])?$_POST['ticket_book_sheet_seriasewithnumber']:'';
  $id = isset($_POST['id'])?$_POST['id']:'';
  $finalprice='0';
  if(!empty($screen_seriase_number)){
      $finalprint_id=array();
      $finalprint_id['suraj_ticket_print']='';
      foreach ($screen_seriase_number as $key => $screen_seriase_numbervalue) {
         $seriasewithnumber = $screen_seriase_numbervalue;
         $seat_type_qry = 'SELECT screen_seat_type FROM suraj_seat_arrangement_detail WHERE is_delete="0" and  status="1" and screen_id="'.$id.'" and  seat_no="'.$seriasewithnumber.'"';

          $seat_type = $db->selectOne($seat_type_qry);
          if($seat_type['screen_seat_type']=='GOLD'){
              $ticket_rs=$_SESSION['sofa_ticket_rate'];
              $sofakesheet="GOLD";
          }elseif($seat_type['screen_seat_type']=='SILVER'){
              $ticket_rs=$_SESSION['sheet_ticket_rate'];
              $sofakesheet="SILVER";
          }
          else{
            $ticket_rs=$_SESSION['sheet_ticket_rate'];
            $sofakesheet="SILVER";
          }
          $finalprice = ($finalprice+$ticket_rs);
      }
      echo $finalprice;exit;
  }
}
if(isset($_REQUEST['seat_arrangement_screen_span'])){
    $formData =$_POST;
    $msg ='';
    if(!isset($formData['seat_gap_selection']))
    {
       $msg ='Please select seat seletion first.';
    }
    else if($formData['seat_gap_selection']=='1' && $formData['seat_gap_row_nm']=='')
    {
       $msg ='Please enter total row span number.';
       
    }
    else if($formData['seat_gap_selection']=='2' && $formData['seat_gap_col_nm']=='')
    {
       $msg ='Please enter total column span number.';

    }
    else
    {   
        global $db;                   
        if($formData['seat_gap_selection']=='1')
        {                                   
            if($formData['rowseats']!='')
            {
                $seat_seq=$formData['rowseats'];
                $screen_id=$formData['screen_id'];
                $row_gap=$formData['seat_gap_row_nm'];
                if($formData['pram1']!='' && $formData['pram1']=='rm')
                { 
                  $res=$db->query("update suraj_seat_arrangement_detail set row_span='0' where screen_id='".$screen_id."' and seat_seq='".$seat_seq."' and is_delete='0'");
                }
                else
                {
                    $res=$db->query("update suraj_seat_arrangement_detail set row_span='".$row_gap."' where screen_id='".$screen_id."' and seat_seq='".$seat_seq."' and is_delete='0'");
                } 
                $msg ='success';  
            }                   
        }
        else if($formData['seat_gap_selection']=='2')
        {                   
            if($formData['columnseats']!='')
            {
                $columnseats=$formData['columnseats'];
                $screen_id=$formData['screen_id'];
                $col_gap=$formData['seat_gap_col_nm'];
                if($formData['pram1']!='' && $formData['pram1']=='rm')
                {
                    $seat_arrangement->singleupdate('col_span','0','screen_id',$screen_id,'`column`',$columnseats);
                    $res=$db->query("update suraj_seat_arrangement_detail set col_span='0' where screen_id='".$screen_id."' and `column`'".$columnseats."' and is_delete='0'");
                } 
                else
                {
                    
                    $res=$db->query("update suraj_seat_arrangement_detail set col_span='".$col_gap."' where screen_id='".$screen_id."' and `column`='".$columnseats."' and is_delete='0'");  
                }                    
                $msg ='success';     
            }
        }       
    }
    echo json_encode($msg);exit;
}
if(isset($_REQUEST['seat_arrangement_screen_active_inactive'])){
    $formData =$_POST;
    $msg ='';
    if(isset($formData['seat_status']))
    {
       
        $screen_id=$formData['screen_id'];
        $seat_status=$formData['seat_status'];
        $seat_from = $formData['seat_from'];
        $seat_to = $formData['seat_to'];
        if($formData['seat_status']!='')
        {                   
            if($seat_from!='' && $seat_to!='')
            {
                global $db;
                
                $res=$db->query("update suraj_seat_arrangement_detail set status='".$seat_status."' where screen_id='".$screen_id."' and id between '".$seat_from."' and '".$seat_to."'  and is_delete='0'");
                 $msg ='success';  

                  
            }
        }    
    }
    else
    {
        $msg ='Please select seat seletion first.';
    }
    echo json_encode($msg);exit;
}
if(isset($_REQUEST['seat_arrangement_screen_block'])){
    $formData =$_POST;
    $msg ='';
    global $db;    
    if(isset($formData['seat_selection']))
    {
        
        $screen_id=$formData['screen_id'];
        $block_seat=$formData['block_seat'];
        if($formData['seat_selection']=='1')
        {                                  
            if($block_seat!='')
            {
                if($formData['pram1']!='' && $formData['pram1']=='rm')
                {
                    $res=$db->query("update suraj_seat_arrangement_detail set is_block='0' where screen_id='".$screen_id."' and id='".$block_seat."' and is_delete='0'");

                }
                else
                { 
                    $res=$db->query("update suraj_seat_arrangement_detail set is_block='1' where screen_id='".$screen_id."' and id='".$block_seat."' and is_delete='0'");
                }                    
                $msg ='success';     
            }                
        }
        else if($formData['seat_selection']=='2')
        {                   
            $seat_from = $formData['seat_from'];
            $seat_to = $formData['seat_to'];
            if($seat_from!='' && $seat_to!='')
            {
                if($formData['pram1']!='' && $formData['pram1']=='rm')
                {
                    
                    $res=$db->query("update suraj_seat_arrangement_detail set is_block='0' where screen_id='".$screen_id."' and id between '".$seat_from."' and '".$seat_to."'  and is_delete='0'");
                    
                }
                else
                {
                   
                    $res=$db->query("update suraj_seat_arrangement_detail set is_block='1' where screen_id='".$screen_id."' and id between '".$seat_from."' and '".$seat_to."'  and is_delete='0'");   
                }
                $msg ='success';   
            }
        }    
    }
    else
    {
       $msg ='Please select seat seletion first.';
    }
    echo json_encode($msg);exit;
}
if(isset($_REQUEST['seat_arrangement_screen_unblock'])){
    $formData =$_POST;
   
    $msg ='';
    global $db;    
    if(isset($formData['seat_selection']))
    {
        
        $screen_id=$formData['screen_id'];
        $block_seat=$formData['block_seat'];
        if($formData['seat_selection']=='1')
        {                                  
            if($block_seat!='')
            {
                if($formData['pram1']!='' && $formData['pram1']=='rm')
                {
                    $res=$db->query("update suraj_seat_arrangement_detail set is_block='0' where screen_id='".$screen_id."' and id='".$block_seat."' and is_delete='0'");

                }
                else
                { 
                    $res=$db->query("update suraj_seat_arrangement_detail set is_block='1' where screen_id='".$screen_id."' and id='".$block_seat."' and is_delete='0'");
                }                    
                $msg ='success';     
            }                
        }
        else if($formData['seat_selection']=='2')
        {                   
            $seat_from = $formData['seat_from'];
            $seat_to = $formData['seat_to'];
            if($seat_from!='' && $seat_to!='')
            {
                if($formData['pram1']!='' && $formData['pram1']=='rm')
                {
                    
                    $res=$db->query("update suraj_seat_arrangement_detail set is_block='0' where screen_id='".$screen_id."' and id between '".$seat_from."' and '".$seat_to."'  and is_delete='0'");
                    
                }
                else
                {
                   
                    $res=$db->query("update suraj_seat_arrangement_detail set is_block='1' where screen_id='".$screen_id."' and id between '".$seat_from."' and '".$seat_to."'  and is_delete='0'");   
                }
                $msg ='success';   
            }
        }    
    }
    else
    {
       $msg ='Please select seat seletion first.';
    }
    echo json_encode($msg);exit;
}
if(isset($_REQUEST['screenwisechart'])){
  $screen_id = isset($_POST['screen_id'])?$_POST['screen_id']:'';

  $show_date = isset($_POST['show_date'])?$_POST['show_date']:'';
  $show_time = isset($_POST['show_time'])?$_POST['show_time']:'';
  global $db;
  $table='<table><tbody>';
  $column_array=array();
  $rowSpan_array=array();
  //Total row and column
  $select_row=$db->selectOne("SELECT `row`,`column` FROM suraj_seat_arrangement_master where screen_id='".$screen_id."' and `status`='1' and `is_delete`='0'");
  $total_row=intval($select_row['row']);
  $total_column=intval($select_row['column']);
  //booking seat get 
  $seatarr=array();
  if($screen_id!='' and $show_date!='' and $show_time!=''){
    $book_qry = "SELECT `ticket_book_sheet_seriasewithnumber` FROM suraj_movie_ticket_book where `is_delete`='0' ";
    $book_qry .= " and ticket_book_date='".date('d-m-Y',strtotime($show_date))."' and ticket_book_show_time='".$show_time."' and ticket_book_screen_number='".$screen_id."'";
    
     $select_booking_seat=$db->selectAll($book_qry);
    $seatstr='';
    if(!empty($select_booking_seat)){
        foreach ($select_booking_seat as $booking_seatkey => $booking_seatvalue) {
            $seatarr[$booking_seatkey]=$booking_seatvalue['ticket_book_sheet_seriasewithnumber'];
        }
    }
    $seatstr='';  
  }
  // for block quote seat get 
  $seatblockarr=array();
  if($screen_id!='' and $show_date!='' and $show_time!=''){
    $block_qry = "SELECT `seat_number` FROM suraj_screen_freeze_release where `is_delete`='0' ";
    $block_qry .= " and show_date='".date('Y-m-d',strtotime($show_date))."' and show_time='".$show_time."' and screen_id='".$screen_id."'";
    
    $select_block_seat=$db->selectOne($block_qry);
   
   if(!empty($select_block_seat)){
        $select_block_seat = explode(',', $select_block_seat['seat_number']);
      
        foreach ($select_block_seat as $block_seatkey => $block_seatvalue) {
            $seatblockarr[$block_seatkey]=trim($block_seatvalue);
        }
    }
  }

  for($k=1;$k<=$total_row;$k++)
  {
      $select_column="SELECT `column`,`seat_no`,`status`,`is_block`,ifnull(`row_span`,0) as row_span,ifnull(`col_span`,0) as col_span,seat_seq FROM suraj_seat_arrangement_detail WHERE screen_id='".$screen_id."' AND `row`='".$k."' order by 1 asc";


      $result_column=$db->query($select_column);
      if(mysqli_num_rows($result_column)>0)
      {   
          $J=0; 
          while($row_column=$db->fetch_array($result_column))
          {
              if($row_column['status']=='1'&& $row_column['is_block']!='1')
              {
                  if(intval($row_column['col_span'])>0)
                  {
                      $column_array[$J]=$row_column['seat_no'].",".$row_column['col_span'];

                  }
                  else if(intval($row_column['row_span'])>0)
                  {
                      $column_array[$J]=$row_column['seat_no']."~".$row_column['row_span'];
                  }
                  else
                  {
                      $column_array[$J]=$row_column['seat_no'];
                  }
              }
              else if($row_column['is_block']=='1')
              {
                      if(intval($row_column['col_span'])>0)
                      {
                          $column_array[$J]=$row_column['seat_no'].",".$row_column['col_span'].","."blocked".",".$J;
                      }
                      else if(intval($row_column['row_span'])>0)
                      {
                          $column_array[$J]=$row_column['seat_no']."~".$row_column['row_span']."~"."blocked"."~".$J;
                      }
                      else
                      {
                          $column_array[$J]="blocked";
                      }
              }
              else
              {
                  $column_array[]="";
              }
              $J++;
          }
          $table.='<tr id="'.$k.'">';  
          $return_=true;
          $table.='<td class="seatseriase" >'.getABCD($k).'</td>'; 
          for($i=0;$i<$total_column;$i++)
          {
              
              if(isset($column_array[$i]) && $column_array[$i]!='' && $column_array[$i]!='blocked')
              {
                  try{$split_value=explode(",",$column_array[$i]);}
                  catch(Exception $e){ $split_value_=$column_array[$i]; }
                  try{$split_value_=explode("~",$column_array[$i]);}
                  catch(Exception $r){$split_value_=$column_array[$i];}
                  if(isset($split_value[1])&& intval($split_value[1]) > 0)
                  {
                      if(isset($split_value[2])&& $split_value[2]=="blocked" && $i==$split_value[3])
                      {
                          $table.='<td style="height:20px;width:20px;"></td>';
                      }
                      for($p=0;$p<$split_value[1];$p++)
                      {
                          $table.='<td class="blankseat"></td>';
                      }
                      if(!isset($split_value[2]))
                      {
                          if(!empty($seatarr)){
                              if(in_array($split_value[0], $seatarr)){
                                  $table.='<td class="ticketboooked"><img src="../img/seat.jpg" height="25px"></td>';
                              }else if(!empty($seatblockarr)){
                                if(in_array($split_value[0], $seatblockarr)){
                                   
                                   $table.='<td class="ticketbox img-check check" id="ticketbox'.$split_value[0].'" data-place="'.$split_value[0].'">'.$split_value[0].'<input type="checkbox" class="hidden ticketbox" id="ticket'.$split_value[0].'" name="ticket_book_sheet_seriasewithnumber[]" checked="checked" value="'.$split_value[0].'"></td>';
                                }else{
                                    $table.='<td class="ticketbox img-check" id="ticketbox'.$split_value[0].'" data-place="'.$split_value[0].'">'.$split_value[0].'<input type="checkbox" class="hidden ticketbox" id="ticket'.$split_value[0].'" name="ticket_book_sheet_seriasewithnumber[]" value="'.$split_value[0].'"></td>';  
                                }
                              }else{
                                 $table.='<td class="ticketbox img-check" id="ticketbox'.$split_value[0].'" data-place="'.$split_value[0].'">'.$split_value[0].'<input type="checkbox" class="hidden ticketbox" id="ticket'.$split_value[0].'" name="ticket_book_sheet_seriasewithnumber[]" value="'.$split_value[0].'"></td>';  
                              }
                          }else{
                            if(!empty($seatblockarr)){
                                if(in_array($split_value[0], $seatblockarr)){
                                   
                                   $table.='<td class="ticketbox img-check check" id="ticketbox'.$split_value[0].'" data-place="'.$split_value[0].'">'.$split_value[0].'<input type="checkbox" class="hidden ticketbox" id="ticket'.$split_value[0].'" name="ticket_book_sheet_seriasewithnumber[]" checked="checked" value="'.$split_value[0].'"></td>';
                                }else{
                                  $table.='<td class="ticketbox img-check" id="ticketbox'.$split_value[0].'" data-place="'.$split_value[0].'">'.$split_value[0].'<input type="checkbox" class="hidden ticketbox" id="ticket'.$split_value[0].'" name="ticket_book_sheet_seriasewithnumber[]" value="'.$split_value[0].'"></td>'; 
                                }
                            }else{
                                  $table.='<td class="ticketbox img-check" id="ticketbox'.$split_value[0].'" data-place="'.$split_value[0].'">'.$split_value[0].'<input type="checkbox" class="hidden ticketbox" id="ticket'.$split_value[0].'" name="ticket_book_sheet_seriasewithnumber[]" value="'.$split_value[0].'"></td>'; 
                            }  

                          }

                         
                         
                         
                      }
                  }
                  else if(isset($split_value_[0])&&$split_value_[0]!='')
                  {
                      if(isset($split_value_[1])&& intval($split_value_[1])>0 && $return_==true)

                      {

                          for($r=0;$r<$split_value_[1];$r++)

                          {

                              $table.="</tr><tr><td colspan='26' style='height: 20px;'></td></tr><tr>";

                          }

                          $return_=false;

                      }

                      if(isset($split_value_[2])&&$split_value_[2]=="blocked"&&$i==$split_value_[3])

                      {

                          $table.='<td style="height:20px;width:20px;"></td>';

                      }

                      else

                      {

                          if(!empty($seatarr)){

                              if(in_array($split_value_[0], $seatarr)){

                                  $table.='<td class="ticketboooked"><img src="../img/seat.jpg" height="25px"></td>';

                              }else if(!empty($seatblockarr)){
                                  if(in_array($split_value_[0], $seatblockarr)){
                                     
                                     $table.='<td class="ticketboxavailable img-check check" id="ticketbox'.$split_value_[0].'" data-place="'.$split_value_[0].'">'.$split_value_[0].'<input type="checkbox" class="hidden ticketbox" id="ticket'.$split_value_[0].'" name="ticket_book_sheet_seriasewithnumber[]" checked="checked" value="'.$split_value_[0].'"></td>';
                                  }else{
                                     $table.='<td class="ticketboxavailable img-check" id="ticketbox'.$split_value_[0].'" data-place="'.$split_value_[0].'">'.$split_value_[0].'<input type="checkbox" class="hidden ticketbox" id="ticket'.$split_value_[0].'" name="ticket_book_sheet_seriasewithnumber[]" value="'.$split_value_[0].'"></td>';    
                                  }
                                }else{

                                   $table.='<td class="ticketboxavailable img-check" id="ticketbox'.$split_value_[0].'" data-place="'.$split_value_[0].'">'.$split_value_[0].'<input type="checkbox" class="hidden ticketbox" id="ticket'.$split_value_[0].'" name="ticket_book_sheet_seriasewithnumber[]" value="'.$split_value_[0].'"></td>';     

                              }

                          }

                          else{
                            if(!empty($seatblockarr)){
                                if(in_array($split_value_[0], $seatblockarr)){
                                    $table.='<td class="ticketboxavailable img-check check" id="ticketbox'.$split_value_[0].'" data-place="'.$split_value_[0].'">'.$split_value_[0].'<input type="checkbox" class="hidden ticketbox" id="ticket'.$split_value_[0].'" name="ticket_book_sheet_seriasewithnumber[]" checked="checked" value="'.$split_value_[0].'"></td>';
                                }else{
                                    $table.='<td class="ticketboxavailable img-check" id="ticketbox'.$split_value_[0].'" data-place="'.$split_value_[0].'">'.$split_value_[0].'<input type="checkbox" class="hidden ticketbox" id="ticket'.$split_value_[0].'" name="ticket_book_sheet_seriasewithnumber[]" value="'.$split_value_[0].'"></td>'; 
                                }
                            }else{
                              $table.='<td class="ticketboxavailable img-check" id="ticketbox'.$split_value_[0].'" data-place="'.$split_value_[0].'">'.$split_value_[0].'<input type="checkbox" class="hidden ticketbox" id="ticket'.$split_value_[0].'" name="ticket_book_sheet_seriasewithnumber[]" value="'.$split_value_[0].'"></td>'; 
                            }    

                          }

                      }

                  }

                  else{

                      $table.='<td style="border: solid 1px;height:20px;width:35px;" id="'.$split_value_[0].'">'.$split_value_[0].'</td>';

                  }

              }

              else if($column_array[$i]=='blocked')

              {

                  $table.='<td class="blockseat" ></td>'; //border: solid 1px;background-color:red;

              }            

              else if($column_array[$i]!='blocked')

              {

                  //$table.='<td style="border: solid 1px;height:20px;width:35px;"></td>';

                  // $table.='<td style="height:20px;width:35px;" ></td>';

              }

              else if($column_array[$i]=='col_span')

              {

                  $table.='<td style="border: solid 1px;height:20px;width:35px;"></td>';

              }

          }
          
          $column_array=array();

      }
      $table.='</tr>';
  }
  $table .='</tbody></table>';  
  $table .="<script type='text/javascript'>
        $(document).ready(function(e){
            $('.img-check').click(function(){
                var ticket=$(this).attr('data-place').trim();
                $('#ticket'+ticket).trigger('click');
                var ckbox = $('#ticket'+ticket);
                if (ckbox.is(':checked')) {
                    $('#ticketbox'+ticket).addClass('check');
                } else {
                    $('#ticketbox'+ticket).removeClass('check');
                }
            });
        });
        </script>"; 
  echo json_encode($table);exit;
}
if(isset($_REQUEST['getshowtime_screenanddate_wise'])){
    global $db;
    $strBox = '';
    $screen_id = isset($_POST['screen_id'])?trim($_POST['screen_id']):'';
    $show_date = isset($_POST['show_date'])?$_POST['show_date']:date('Y-m-d');
    $sql_state = 'SELECT movie_assign_start_time,movie_assign_end_time FROM movie_assign WHERE is_delete="0" and movie_assign_status="Active" and movie_assign_screen="'.$screen_id.'" and movie_assign_date="'.$show_date.'"';
    $sql_state .=' ORDER BY movie_assign_pk ASC';
    
    $res2 = $db->selectAll($sql_state);
    $strBox .='<option value="all">All Show</option>';
    $time = date('g:i A');
    if ($res2 != false) {
      foreach ($res2 as $res_state) {
          //if(strtotime($res_state['movie_assign_start_time'])>=strtotime($time)){
            $strBox .='<option value="'.$res_state['movie_assign_start_time'].'">'.date('h:i A',strtotime($res_state['movie_assign_start_time'])).' - '.date('h:i A',strtotime($res_state['movie_assign_end_time'])).'</option>';
          //}
      }
    }
    echo json_encode($strBox);exit;    
}
if(isset($_REQUEST['cancleshow'])){
    $movieid = isset($_POST['movieid'])?trim($_POST['movieid']):'';
    $moviename = isset($_POST['moviename'])?trim($_POST['moviename']):'';
    $screen = isset($_POST['screen'])?trim($_POST['screen']):'';
    $book_date = isset($_POST['date'])?trim($_POST['date']):'';
    $showtime = isset($_POST['showtime'])?trim($_POST['showtime']):'';
    $showname = isset($_POST['showname'])?trim($_POST['showname']):'';
    $totalseat = isset($_POST['totalseat'])?trim($_POST['totalseat']):'';
    $totalcollection = isset($_POST['totalcollection'])?trim($_POST['totalcollection']):'';
    $reason = isset($_POST['reason'])?trim($_POST['reason']):'';
    if($movieid!='' and $showtime!='' and $book_date!='' and $screen!='' and $showname!=''){
      $movie_ticket_book_update=$db->query('update suraj_movie_ticket_book set is_delete="1" where book_movieid="'.$movieid.'" and book_showstarttime="'.$showtime.'" and book_date="'.$book_date.'"  and book_screen_number="'.$screen.'" and book_showname="'.$showname.'"  and  is_delete="0"');
      //Select Total Rs and Seat
        $sql_ticket_total = 'SELECT sum(book_ticket_total) as ticketrs,count(book_seat) as totalseat from suraj_movie_ticket_book where book_movieid="'.$movieid.'" and book_showstarttime="'.$showtime.'" and book_date="'.$book_date.'" and book_screen_number="'.$screen.'" and book_showname="'.$showname.'"';
        $ticketdata = $db->selectOne($sql_ticket_total);
      // Add cancle show
      $data_cancle = array();
      $data_cancle['movieid']= $movieid;
      $data_cancle['moviename']= $moviename;
      $data_cancle['screen']= $screen;
      $data_cancle['date']= $book_date;
      $data_cancle['showtime']= $showtime;
      $data_cancle['showname']=  $showname;
      $data_cancle['totalseat']=  $ticketdata['totalseat'];
      $data_cancle['totalrs']=  $ticketdata['ticketrs'];
      $data_cancle['reason']=  $reason;
      $data_cancle['status']=  '1';
      $data_cancle['created_datetime']=date('Y-m-d H:i:s'); 
      $data_cancle['is_delete'] ='0';
      $res=$db->query_insert('suraj_cancle_show',$data_cancle);
      // For MSG
      $msg = "\nThis is Cancle Show.\r";
      $msg .= "\nDate : ".$book_date."\r";
      $msg .= "\nMovie : ".$moviename."\r";
      $msg .= "\nScreen : ".$screen."\r";
      $msg .= "\nShow Time : ".$showtime."\r";
      $msg .= "\nTotal Seat : ".$ticketdata['totalseat']."\r";
      $msg .= "\nTotal Collection : ".$ticketdata['ticketrs']."\r";
      $msg .= "\nReason : \r".$reason;
      sendsmsallinone($msg);
      echo json_encode("Hellp");exit;
    }  
}
if(isset($_REQUEST['getassignshowdetails'])){
    global $db;
    $strBox = '';
    $assignid = isset($_POST['assignid'])?trim($_POST['assignid']):'';
    $screenid = isset($_POST['screenid'])?trim($_POST['screenid']):'';
    $sql_assign = 'SELECT 
      movieass.movie_assign_pk as assignid,
      movieass.movie_assign_start_time,
      movieass.movie_assign_end_time,
      movieass.movie_assign_show as showid,
      movieshow.movie_show_name as showname,
      movie.suraj_movie_name as moviename,
      movieass.movie_assign_name as movieid,
      movieass.movie_sheet_ticket_rate as silverrate,
      movieass.movie_sofa_ticket_rate as goldrate
      FROM movie_assign as movieass 
      LEFT JOIN suraj_movie_show as movieshow on movieshow.movie_show_id_pk=movieass.movie_assign_show
      LEFT JOIN suraj_movie as movie on movie.suraj_movie_id_pk=movieass.movie_assign_name
      WHERE movieass.movie_assign_status="Active" and movieass.movie_assign_pk="'.$assignid.'" and movieass.movie_assign_screen="'.$screenid.'"';

    $assign_show = $db->selectOne($sql_assign);
    $returnarray = array();
    $returnarray['ShowName'] =$assign_show['showname'];
    $returnarray['ShowTime'] =date('h:i A', strtotime($assign_show['movie_assign_start_time'])).' - '.date('h:i A', strtotime($assign_show['movie_assign_end_time']));
    $returnarray['MovieName']=$assign_show['moviename'];
    $returnarray['MovieId']  =$assign_show['movieid'];
    $returnarray['SilverRate'] =$assign_show['silverrate'];
    $returnarray['GoldRate'] =$assign_show['goldrate'];
    $returnarray['AssignId'] =$assign_show['assignid'];
    echo json_encode($returnarray);exit;
    
}
if(isset($_REQUEST['applyticketbookdate'])){
  global $db;
  $selecteddate = isset($_POST['selecteddate'])?trim($_POST['selecteddate']):'';
  $tbhtml ='';
  if($selecteddate!=''){
    $todaydate =$selecteddate;
    $m_screen = "select id,name from suraj_screen_master where status='1' and is_delete='0' order by name ";
    $m_screen = $db->selectAll($m_screen);
    
    foreach ($m_screen as $key => $m_screenvalue) 
    {
      $sc_id = $m_screenvalue['id'];
      $Details = GetMovieShwoAssignDetails($sc_id,$todaydate,"");
      $ShowList = $Details['ShowList'];
      $ShowName = $Details['ShowName'];
      $ShowTime = $Details['ShowTime'];
      $MovieName = $Details['MovieName'];
      $MovieId = $Details['MovieId'];
      $SilverRate = $Details['SilverRate'];
      $GoldRate = $Details['GoldRate'];
      $AssignId = $Details['AssignId'];

      $tbhtml .='<div class="col-sm-12 screenwiseview">';
          $tbhtml .='<div class="col-sm-2">';
              $tbhtml .='<span class="tile tile-warning tile-valign screenametag">';
                  $tbhtml .='<i class="fa fa-laptop" style="font-size: 23px;line-height: 0px;"></i>';
                  $tbhtml .=$m_screenvalue['name'];
              $tbhtml .='</span>';
          $tbhtml .='</div>';
          $tbhtml .='<div class="col-sm-6">';
              $tbhtml .='<div class="col-sm-12">';
                  $tbhtml .='<div class="col-sm-8" id="MovieShowTime'.$sc_id.'">';
                    $tbhtml .='<div class="input-group">';
                      $tbhtml .='<span class="input-group-addon">
                              <span class="glyphicon glyphicon-time">
                              </span>
                          </span>';
                      $tbhtml .='<select class="form-control" name="movie_show_time" id="movie_show_time'.$sc_id.'" onchange="return showdetailschange(this.value,'.$sc_id.');" style="background-color: #fff;    border: 1px solid #fb505a;font-size: 15px;">';
                        $tbhtml .=$ShowList;
                      $tbhtml .='</select>';
                    $tbhtml .='</div>';
                  $tbhtml .='</div>';
                  $tbhtml .='<div class="col-sm-4">';
                      $tbhtml .='<span class="btn btn-success" style="cursor:none;background-color: #fff;border-color: #fe505a;width: 100%;font-size: 12px;">';
                          $tbhtml .='<i class="glyphicon glyphicon-sound-dolby"></i>';
                          $tbhtml .='<span id="MovieShowName'.$sc_id.'">';
                          $tbhtml .=$ShowName;
                          $tbhtml .='</span>';
                      $tbhtml .='</span>';
                  $tbhtml .='</div>';
              $tbhtml .='</div>';
              $tbhtml .='<div class="col-sm-12">';
                  $tbhtml .='<div class="col-sm-12" style="margin-top: 6px;">';
                      $tbhtml .='<span class="btn btn-success" style="cursor:none;background-color: #fed563ad;border-color: #fe505a;width: 100%;min-height: 33px;text-align: left;font-size: 12px;font-weight: bold;">
                          <i class="fa fa-film"></i>';
                        $tbhtml .='<span id="MovieNameTime'.$sc_id.'">';
                          $tbhtml .=$MovieName;
                          $tbhtml .="(".$ShowTime.")";
                        $tbhtml .='</span>';
                      $tbhtml .='</span>';
                  $tbhtml .='</div>';
              $tbhtml .='</div>';
          $tbhtml .='</div>';
          $tbhtml .='<div class="col-sm-4" id="ShowPriceBtn'.$sc_id.'">';
            $tbhtml .='<span class="btn btn-primary btn-lg silverticketprice" onclick="set_booking_details(';
            $tbhtml .="'".$sc_id."',";
            $tbhtml .="'SILVER',";
            $tbhtml .="'".$SilverRate."'";
            $tbhtml .=')">';
            $tbhtml .='Silver<br>'.number_format($SilverRate,2).'</span>';
            $tbhtml .='<span class="btn btn-primary btn-lg goldticketprice" onclick="set_booking_details(';
            $tbhtml .="'".$sc_id."',";
            $tbhtml .="'GOLD',";
            $tbhtml .="'".$GoldRate."'";
            $tbhtml .=')">';
            $tbhtml .='Gold<br>'.number_format($GoldRate,2).'</span>';
          $tbhtml .='</div>';
          $tbhtml .='<input type="hidden" name="b_screenid" id="b_screenid'.$sc_id.'" value="'.$sc_id.'">
          <input type="hidden" name="b_showtime" id="b_showtime'.$sc_id.'" value="'.$ShowTime.'">
          <input type="hidden" name="b_showname" id="b_showname'.$sc_id.'" value="'.$ShowName.'">
          <input type="hidden" name="b_showname" id="b_moviename'.$sc_id.'" value="'.$MovieName.'">
          <input type="hidden" name="b_showname" id="b_movieid'.$sc_id.'" value="'.$MovieId.'">
          <input type="hidden" name="b_assignid" id="b_assignid'.$sc_id.'" value="'.$AssignId.'">';
      $tbhtml .='</div>';
    }
  }
  echo json_encode($tbhtml);exit;
}
if(isset($_REQUEST['direct_print'])){
  $assignid=$_SESSION['assignid'];
  $seatclass=$_SESSION['seatclass']; 
  $bookdate=$_SESSION['bookdate']; 
  $bookscreenno=$_SESSION['bookscreenno'];
  $iscurrent=$_SESSION['iscurrent']; 
  global $db;
  $sql_assign = 'SELECT 
    movieass.movie_assign_pk as assignid,
    movieass.movie_assign_start_time,
    movieass.movie_assign_end_time,
    movieass.movie_assign_show as showid,
    movieshow.movie_show_name as showname,
    movie.suraj_movie_name as moviename,
    movieass.movie_assign_name as movieid,
    movieass.movie_sheet_ticket_rate as silverrate,
    movieass.movie_sofa_ticket_rate as goldrate,
    movieass.movie_assign_screen as screenno
    FROM movie_assign as movieass 
    LEFT JOIN suraj_movie_show as movieshow on movieshow.movie_show_id_pk=movieass.movie_assign_show
    LEFT JOIN suraj_movie as movie on movie.suraj_movie_id_pk=movieass.movie_assign_name
    WHERE movieass.movie_assign_status="Active" and movieass.movie_assign_pk="'.$assignid.'" and movieass.movie_assign_date="'.$bookdate.'"';
    
    $assignshow = $db->selectOne($sql_assign);

    $moviename =$assignshow['moviename'];
    $movieid   =$assignshow['movieid'];
    $show_starttime  =$assignshow['movie_assign_start_time'];
    $showname  =$assignshow['showname'];
    $screenno  =$assignshow['screenno'];
    $seat_selection = $_POST['ticket_book_sheet_seriasewithnumber'];
    // print_r($_POST['ticket_book_sheet_seriasewithnumber']);
    // echo $seat_selection;exit;
    if(!empty($seat_selection)){
        $finalprint_id=array();
        $finalprint_id['ticket_book_id']='';
        foreach ($seat_selection as $key => $seatselection) {
          if($seatselection!=''){
            $bookseat = $seatselection;
            $book_seat_series =substr($bookseat, 0, 1);
            $book_seat_no = substr($bookseat,1);
            $book_seat = $seatselection;
            if($seatclass=='SILVER'){
                $ticketprice = $assignshow['silverrate'];
            }
            if($seatclass=='GOLD'){
                $ticketprice = $assignshow['goldrate'];
            }
            $book_ticket_price = $ticketprice;            
            $book_ticket_total = $ticketprice;
            $data_book = array();
            $data_book['book_date']=$bookdate;
            $data_book['book_movieid']=$movieid;
            $data_book['book_moviename']=$moviename;
            $data_book['book_screen_number']=$screenno;
            $data_book['book_seat_series']=$book_seat_series;
            $data_book['book_seat_no']=$book_seat_no;
            $data_book['book_seat']=$book_seat;
            $data_book['book_seatclass']=$seatclass;
            $data_book['book_showstarttime']=$show_starttime;
            $data_book['book_showname']=$showname;
            $data_book['book_ticket_price']=$book_ticket_price;
            $data_book['book_ticket_total']=$book_ticket_total;
            $data_book['book_entrydate']=date('Y-m-d');
            $data_book['book_entrytime']=date('H:i:s');
            $data_book['book_entrydatetime']=date('Y-m-d H:i:s');
            $data_book['book_entryby']=$_SESSION['suraj_admin_name'];
            $data_book['is_delete']='0';
            if($_SESSION['suraj_admin_id']=='16'){
                $data_book['book_tickettype']='TEST';
            }else{
                $data_book['book_tickettype']='';
            }
            $book_id=$db->query_insert('suraj_movie_ticket_book',$data_book);
            $finalprint_id['ticket_book_id'] .= "-".$book_id;
          }
        }
        $returnarray = array();
        if($finalprint_id['ticket_book_id']!=''){ 
          $getfileurl =TICKET_SITE.'get_ticket_print?suraj_ticket_print='.$finalprint_id['ticket_book_id'];
          //$getticktprint = file_get_contents($getfileurl);
          //echo $getticktprint;
          //$getticktprint = getticketprint($finalprint_id['ticket_book_id']); 
          //echo $getticktprint;
            $url = $getfileurl;
            $ch = curl_init();
            curl_setopt ($ch, CURLOPT_URL, $url);
            curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
            $contents = curl_exec($ch);
            if (curl_errno($ch)) {
              echo curl_error($ch);
              echo "\n<br />";
              $contents = '';
            } else {
              curl_close($ch);
            }
            
            if (!is_string($contents) || !strlen($contents)) {
                $contents = '';
            }
            $getticktprint =$contents;
            //$returnarray['tickethtmlurl']=$getfileurl;
            $returnarray['tickethtml']=$getticktprint;
        }else{
          $returnarray['tickethtml']='';
        }
        $returnarray['iscurrent']=$iscurrent;
        echo json_encode($returnarray);exit;  
    }
}
?>