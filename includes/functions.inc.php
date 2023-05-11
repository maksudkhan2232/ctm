<?php
function isLoggedIn() {
    if(!isset($_SESSION['user_session_id']) && $_SESSION['user_session_right']=='') {
        header('location:' . SITE . 'index.php');
    }
}
function selectsecreen($selectValue, $extra_val='') {

    global $db;
    $strBox = '';

    $sql_state = "SELECT id,name FROM suraj_screen_master WHERE status='1' and is_delete='0'";
    $sql_state .=' ORDER BY name';

    $res2 = $db->selectAll($sql_state);
    if($extra_val==1){
        $extra_val='';
    }
    $strBox .='<div class="input-group"><span class="input-group-addon"><span class="fa fa-sitemap"></span></span><select class="form-control" name="movie_screen_id" id="movie_screen_id" ' . $extra_val . ' required>';
    $strBox .='<option value="">--Select Screen Name--</option>';
    if ($res2 != false) {
        foreach ($res2 as $res_state) {
            $sel = '';
            if ($selectValue == $res_state['id'])
                $sel = 'selected';
            $strBox .='<option value="' . $res_state['id'] . '" ' . $sel . '>' . $res_state['name'] . '</option>';
        }
    }
    $strBox .='</select></div>';
    return $strBox;
}
function getscreenname($id){
    global $db;
    $strClient = 'SELECT name  FROM suraj_screen_master WHERE id ='.$id;    
    $result = $db->query_first( $strClient );
    return  $result['name'];
}
function selectMovieName($selectValue,$extra_val) {
    global $db;
    $strBox = '';

    $sql_state = "SELECT suraj_movie_id_pk,suraj_movie_name,suraj_movie_release_date FROM suraj_movie WHERE suraj_movie_status='Active' and is_delete='0'";
    $sql_state .=' GROUP BY suraj_movie_release_date ORDER BY suraj_movie_release_date DESC';

    $res2 = $db->selectAll($sql_state);
    if($extra_val==1){
        $extra_val='';
    }
    $strBox .='<div class="input-group"><span class="input-group-addon"><span class="fa fa-video-camera"></span></span><select class="form-control" name="suraj_movie_id_pk" id="suraj_movie_id_pk" ' . $extra_val . ' required>';
    $strBox .='<option value="">--Select Movie Name--</option>';
    if ($res2 != false) {
        foreach ($res2 as $res_state) {
            $sqlassignmovie = "SELECT suraj_movie_id_pk,suraj_movie_name FROM suraj_movie WHERE suraj_movie_status='Active' and is_delete='0' and suraj_movie_release_date='".$res_state['suraj_movie_release_date']."'ORDER BY suraj_movie_name ASC";                                      
            $sqlassignmovierecord = $db->selectAll($sqlassignmovie);
            if ($sqlassignmovierecord != false) {
                $strBox .='<optgroup label="'.date('d-m-Y',strtotime($res_state['suraj_movie_release_date'])).'">';
                foreach ($sqlassignmovierecord as $assignmovielist) {
                    $sel = '';
                    if ($selectValue == $assignmovielist['suraj_movie_id_pk'])
                        $sel = 'selected';
                    $strBox .='<option value="' . $assignmovielist['suraj_movie_id_pk'] . '" ' . $sel . '>' . $assignmovielist['suraj_movie_name'] . '</option>';
                }
                $strBox .='</optgroup>';
            }
        }
    }
    // if ($res2 != false) {
    //     foreach ($res2 as $res_state) {
    //         $sel = '';
    //         if ($selectValue == $res_state['suraj_movie_id_pk'])
    //             $sel = 'selected';
    //         $strBox .='<option value="' . $res_state['suraj_movie_id_pk'] . '" ' . $sel . '>' . $res_state['suraj_movie_name'] . '</option>';
    //     }
    // }
    $strBox .='</select></div>';
    return $strBox;
}
function getmoviename($suraj_movie_id_pk){
    global $db;
    $strClient = 'SELECT suraj_movie_name  FROM suraj_movie WHERE suraj_movie_id_pk ="'.$suraj_movie_id_pk.'"';    
    $result = $db->query_first( $strClient );
    return  $result['suraj_movie_name'];
}
function selectshow($selectValue, $extra_val='') {
    global $db;
    $strBox = '';

    $sql_state = "SELECT movie_show_id_pk,movie_show_name FROM suraj_movie_show WHERE movie_show_status='Active' and is_delete='0'";
    $sql_state .=' ORDER BY movie_show_name';

    $res2 = $db->selectAll($sql_state);
    if($extra_val==1){
        $extra_val='';
    }
    $strBox .='<div class="input-group"><span class="input-group-addon"><span class="fa fa-sitemap"></span></span><select class="form-control" name="movie_show_id_pk" id="movie_show_id_pk" ' . $extra_val . ' required>';
    $strBox .='<option value="">--Select Screen Show--</option>';
    if ($res2 != false) {
        foreach ($res2 as $res_state) {
            $sel = '';
            if ($selectValue == $res_state['movie_show_id_pk'])
                $sel = 'selected';
            $strBox .='<option value="' . $res_state['movie_show_id_pk'] . '" ' . $sel . '>' . $res_state['movie_show_name'] . '</option>';
        }
    }
    $strBox .='</select></div>';
    return $strBox;
}
function getshowname($movie_show_id_pk){
    global $db;
    $strClient = 'SELECT movie_show_name  FROM suraj_movie_show WHERE movie_show_id_pk ="'.$movie_show_id_pk.'"';    
    $result = $db->query_first( $strClient );
    return  $result['movie_show_name'];
}
function GetMovieShwoAssignDetails($scid,$date,$selectValue) {
    global $db;
    $ShowList = '';
    $ShowName = '';
    $ShowTime = '';
    $MovieName = '';
    $MovieId ='';
    $SilverRate='';
    $GoldRate='';
    $AssignId ='';
    $sql_state = 'SELECT 
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
    WHERE movieass.movie_assign_status="Active" and movieass.movie_assign_screen="'.$scid.'" and movieass.movie_assign_date="'.$date.'"';
    $sql_state .=' ORDER BY movieass.movie_assign_start_time asc';
    $res2 = $db->selectAll($sql_state);
    if ($res2 != false) {
        $selectedfirst =0;
        foreach ($res2 as $res_state) {
            $time = $res_state['movie_assign_start_time'];
            $timestamp = strtotime($time);
            $timestamp_one_hour_later = $timestamp + 2700; // 3600
            $currenttime = date('H:i');
            $currenttimestamp =strtotime($currenttime);
            $selected='';
            if($currenttimestamp<=$timestamp_one_hour_later) {
                $selectedfirst =($selectedfirst+1);
            }
            if($selectedfirst==1){
                $selected='selected';
                $ShowName .=$res_state['showname'];
                $ShowTime .=date('h:i A', strtotime($res_state['movie_assign_start_time'])).' - '.date('h:i A', strtotime($res_state['movie_assign_end_time']));
                $MovieName .=$res_state['moviename'];
                $MovieId .=$res_state['movieid'];
                $SilverRate .=$res_state['silverrate'];
                $GoldRate .=$res_state['goldrate'];
                $AssignId .=$res_state['assignid'];
            }
            if(strtotime(date('Y-m-d')) < strtotime(date('Y-m-d',strtotime($date)))){
                $ShowList .='<option value="'.$res_state['assignid'].'" '.$selected.'>' . date('h:i A', strtotime($res_state['movie_assign_start_time'])).' - '.date('h:i A', strtotime($res_state['movie_assign_end_time'])).'</option>';
            
                
            }else{
                if($currenttimestamp<=$timestamp_one_hour_later) {
                    $ShowList .='<option value="'.$res_state['assignid'].'" '.$selected.'>' . date('h:i A', strtotime($res_state['movie_assign_start_time'])).' - '.date('h:i A', strtotime($res_state['movie_assign_end_time'])).'</option>';
                }
            }
        }
    }
    $returnarry =array();
    $returnarry['ShowList'] =$ShowList;
    $returnarry['ShowName'] =$ShowName;
    $returnarry['ShowTime'] =$ShowTime;
    $returnarry['MovieName'] =$MovieName;
    $returnarry['MovieId'] =$MovieId;
    $returnarry['SilverRate'] =$SilverRate;
    $returnarry['GoldRate'] =$GoldRate;
    $returnarry['AssignId'] =$AssignId;
    return $returnarry;
}

function shwotodaymovielist($selectValue, $extra_val='') {
    global $db;
    $strBox = '';
    $sql_state = 'SELECT movie_assign_name FROM movie_assign WHERE is_delete="0" and movie_assign_status="Active" and movie_assign_screen='.$selectValue.' and movie_assign_date="'.date('d-m-Y').'" ';
    $sql_state .='Group by movie_assign_name ORDER BY movie_assign_name';
    $res2 = $db->selectAll($sql_state);
    if($extra_val==1){
        $extra_val='';
    }
    $strBox .='<div class="input-group"><span class="input-group-addon"><span class="fa fa-film"></span></span><select class="form-control" name="ticket_movie_name" id="ticket_movie_name" ' . $extra_val . ' required>';
    $strBox .='<option value="">--Select Movie--</option>';
    if ($res2 != false) {
        foreach ($res2 as $res_state) {
            $sel = '';
            if ($selectValue == $res_state['movie_assign_name'])
                $sel = 'selected';
            $strBox .='<option value="' . $res_state['movie_assign_name'] . '" ' . $sel . '>' . getmoviename($res_state['movie_assign_name']) . '</option>';
        }
    }
    $strBox .='</select></div>';
    return $strBox;
}
function shwotodaymovietime($selectValue, $extra_val=''){
    global $db;$strBox = '';
    $sql_state = 'SELECT movie_assign_start_time,movie_assign_end_time FROM movie_assign WHERE movie_assign_status="Active" and movie_assign_screen="'.$selectValue.'" and movie_assign_date="'.date('d-m-Y').'"';
    $sql_state .=' ORDER BY movie_assign_pk ASC';
    $res2 = $db->selectAll($sql_state);
    $strBox .='<div class="input-group"><span class="input-group-addon"><span class="fa fa-sitemap"></span></span><select class="form-control" name="movie_show_time" id="movie_show_time" required>';
    $strBox .='<option value="">--Select Show Time--</option>';
    if ($res2 != false) {
    foreach ($res2 as $res_state) {
    $strBox .='<option value="'.$res_state['movie_assign_start_time'].'-'.$res_state['movie_assign_end_time'].'">' . $res_state['movie_assign_start_time'].'-'.$res_state['movie_assign_end_time'].'</option>';
    }
    }
    $strBox .='</select></div>';
    return $strBox;
}
function createSeatArrangement($arr_id,$row,$column,$start_from,$screen_id){
    global $db;
    for($i=1;$i<=$row;$i++){
            for($j=1;$j<=$column;$j++){
                $db->query("insert into suraj_seat_arrangement_detail set screen_id=".$screen_id.",`row`=".$i.",`column`=".$j.",seat_seq='".$start_from."',seat_no='".$start_from.$j."',created_time='".date('Y-m-d H:i:s')."',created_ip='".$_SERVER['REMOTE_ADDR']."',screen_seat_type='SEAT'");
            }
            $start_from++;
        }   
}
function viewSeatArrangement($screen_id){
    global $db;
    $table='<table><tbody>';
    $column_array=array();
    $rowSpan_array=array();
    //Total row and column
    $select_row=$db->selectOne("SELECT `row`,`column` FROM suraj_seat_arrangement_master where screen_id='".$screen_id."' and `status`='1' and `is_delete`='0';");
    $total_row=intval($select_row['row']);
    $total_column=intval($select_row['column']);

    for($k=1;$k<=$total_row;$k++){
            $select_column="SELECT `column`,`seat_no`,`status`,`is_block`,ifnull(`row_span`,0) as row_span,ifnull(`col_span`,0) as col_span FROM suraj_seat_arrangement_detail WHERE screen_id='".$screen_id."' AND `row`='".$k."' order by 1 asc;";

            $result_column=$db->query($select_column);

            if(mysqli_num_rows($result_column)>0){
              
                $table.='<tr id="'.$k.'">';

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

                    

                    $return_=true;

                  
                    

                    for($i=0;$i<$total_column;$i++)

                    {

                        if(isset($column_array[$i]) && $column_array[$i]!='' && $column_array[$i]!='blocked')

                        {

                            try{$split_value=explode(",",$column_array[$i]);}

                            catch(Exception $e){

                                $split_value_=$column_array[$i];

                            }

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

                                    $table.='<td style="width: 35px;"></td>';

                                }

                                if(!isset($split_value[2]))

                                {

                                    $table.='<td style="border: solid 1px;height:20px;width:35px;" id="'.$split_value[0].'">'.$split_value[0].'</td>';

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

                                    $table.='<td style="border: solid 1px;height:20px;width:35px;" id="'.$split_value_[0].'">'.$split_value_[0].'</td>';   

                                }

                            }

                            else

                            {

                                $table.='<td style="border: solid 1px;height:20px;width:35px;" id="'.$split_value_[0].'">'.$split_value_[0].'</td>';

                            }

                        }

                        else if($column_array[$i]=='blocked')

                        {

                            $table.='<td style="height:20px;width:35px;" ></td>'; //border: solid 1px;background-color:red;

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
    return $table.='</tbody></table>';   

}
function getSeats($screen_id,$selectValue=''){

    global $db;
    $strBox = '';

    $sql_state ="select * from suraj_seat_arrangement_detail where screen_id='".$screen_id."' and status='1' and is_delete='0'";
    $res2 = $db->selectAll($sql_state);
    if ($res2 != false) {
        foreach ($res2 as $res_state) {
            $sel = '';
            if ($selectValue == $res_state['id'])
                $sel = 'selected';
            $strBox .='<option value="' . $res_state['id'] . '" ' . $sel . '>' . $res_state['seat_no'] . '</option>';
        }
    }
    return $strBox; 
}
function getSeatsRow($screen_id,$selectValue='')
{   
    global $db;
    $strBox = '';
    $sql_state ="select seat_seq,id from suraj_seat_arrangement_detail where screen_id='".$screen_id."' and status='1' and is_delete='0'  group by seat_seq";
    $res2 = $db->selectAll($sql_state);
    if ($res2 != false) {
        foreach ($res2 as $res_state) {
            $sel = '';
            if ($selectValue == $res_state['seat_seq'])
                $sel = 'selected';
            $strBox .='<option value="' . $res_state['seat_seq'] . '" ' . $sel . '>' . $res_state['seat_seq'] . '</option>';
        }
    }
    echo $strBox;
    return $strBox;   
}
function getSeatsColumn($screen_id,$selectValue='')
{   
    global $db;
    $strBox = '';
    $sql_state="select DISTINCT(`column`),id from suraj_seat_arrangement_detail where screen_id='".$screen_id."' and status='1' and is_delete='0' group by `column`";
    $res2 = $db->selectAll($sql_state);
    if ($res2 != false) {
        foreach ($res2 as $res_state) {
            $sel = '';
            if ($selectValue == $res_state['column'])
                $sel = 'selected';
            $strBox .='<option value="' . $res_state['column'] . '" ' . $sel . '>' . $res_state['column'] . '</option>';
        }
    }
    return $strBox;   
}
function get_seatarrangementforbooking($screen_id,$bookingmovie,$bookingdate,$bookingtime,$seatclass)
{
    global $db;
    $table='<table><tbody>';
    $column_array=array();
    $rowSpan_array=array();
    //Total row and column
    $select_row=$db->selectOne("SELECT `row`,`column` FROM suraj_seat_arrangement_master where screen_id='".$screen_id."' and `status`='1' and `is_delete`='0'");
    $total_row=intval($select_row['row']);
    $total_column=intval($select_row['column']);
    //booking seat get 
    $select_booking_seat=$db->selectAll("SELECT `book_seat` FROM suraj_movie_ticket_book where book_movieid='".$bookingmovie."' and book_date='".$bookingdate."' and book_showstarttime='".$bookingtime."' and book_screen_number='".$screen_id."'  and book_seatclass='".$seatclass."'  and `is_delete`='0'");
    $seatstr='';
    $seatarr=array();
    if(!empty($select_booking_seat)){
        foreach ($select_booking_seat as $booking_seatkey => $booking_seatvalue) {
            $seatarr[$booking_seatkey]=$booking_seatvalue['book_seat'];
        }
    }
    $seatstr='';
    // for block quote seat get 
    $seatblockarr=array();
    if($screen_id!='' and $bookingdate!='' and $bookingtime!=''){
        $block_qry = "SELECT `seat_number` FROM suraj_screen_freeze_release where `is_delete`='0' ";
        $block_qry .= " and show_date='".date('Y-m-d',strtotime($bookingdate))."' and show_time='".$bookingtime."' and screen_id='".$screen_id."'";
        
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
        $select_column="SELECT `column`,`seat_no`,`status`,`is_block`,ifnull(`row_span`,0) as row_span,ifnull(`col_span`,0) as col_span,seat_seq FROM suraj_seat_arrangement_detail WHERE screen_id='".$screen_id."' AND `row`='".$k."'  and screen_seat_type='".$seatclass."' order by 1 asc";

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
                            // if(!empty($seatarr)){
                            //     if(in_array($split_value[0], $seatarr)){
                            //         $table.='<td class="ticketboooked"><img src="../img/seat.jpg" height="25px"></td>';
                            //     }else{
                            //        $table.='<td class="ticketbox img-check" id="ticketbox'.$split_value[0].'" data-place="'.$split_value[0].'">'.$split_value[0].'<input type="checkbox" class="hidden ticketbox" id="ticket'.$split_value[0].'" name="ticket_book_sheet_seriasewithnumber[]" value="'.$split_value[0].'"></td>';  
                            //     }
                            // }else{
                            //     $table.='<td class="ticketbox img-check" id="ticketbox'.$split_value[0].'" data-place="'.$split_value[0].'">'.$split_value[0].'<input type="checkbox" class="hidden ticketbox" id="ticket'.$split_value[0].'" name="ticket_book_sheet_seriasewithnumber[]" value="'.$split_value[0].'"></td>';   

                            // }
                            if(!empty($seatarr)){
                                if(in_array($split_value[0], $seatarr)){
                                    $table.='<td class="ticketboooked"><img src="../img/seat.jpg" height="25px"></td>';
                                }else if(!empty($seatblockarr)){
                                    if(in_array($split_value[0], $seatblockarr)){
                                       $table.='<td class="blockseat" ></td>';
                                    }else{
                                        $table.='<td class="ticketbox img-check" id="ticketbox'.$split_value[0].'" data-place="'.$split_value[0].'">'.$split_value[0].'<input type="checkbox" class="hidden ticketbox" id="ticket'.$split_value[0].'" name="ticket_book_sheet_seriasewithnumber[]" value="'.$split_value[0].'"></td>';  
                                    }
                                }else{
                                    $table.='<td class="ticketbox img-check" id="ticketbox'.$split_value[0].'" data-place="'.$split_value[0].'">'.$split_value[0].'<input type="checkbox" class="hidden ticketbox" id="ticket'.$split_value[0].'" name="ticket_book_sheet_seriasewithnumber[]" value="'.$split_value[0].'"></td>';  
                                }
                            }else{
                                if(!empty($seatblockarr)){
                                    if(in_array($split_value[0], $seatblockarr)){
                                       $table.='<td class="blockseat" ></td>';
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

                            // if(!empty($seatarr)){

                            //     if(in_array($split_value_[0], $seatarr)){

                            //         $table.='<td class="ticketboooked"><img src="../img/seat.jpg" height="25px"></td>';

                            //     }else{

                            //          $table.='<td class="ticketboxavailable img-check" id="ticketbox'.$split_value_[0].'" data-place="'.$split_value_[0].'">'.$split_value_[0].'<input type="checkbox" class="hidden ticketbox" id="ticket'.$split_value_[0].'" name="ticket_book_sheet_seriasewithnumber[]" value="'.$split_value_[0].'"></td>';     

                            //     }

                            // }

                            // else{

                                
                            //     $table.='<td class="ticketboxavailable img-check" id="ticketbox'.$split_value_[0].'" data-place="'.$split_value_[0].'">'.$split_value_[0].'<input type="checkbox" class="hidden ticketbox" id="ticket'.$split_value_[0].'" name="ticket_book_sheet_seriasewithnumber[]" value="'.$split_value_[0].'"></td>';     

                            // }
                            if(!empty($seatarr)){
                                if(in_array($split_value_[0], $seatarr)){
                                    $table.='<td class="ticketboooked"><img src="../img/seat.jpg" height="25px"></td>';
                                }else if(!empty($seatblockarr)){
                                    if(in_array($split_value_[0], $seatblockarr)){
                                        $table.='<td class="blockseat" ></td>';
                                    }else{
                                       $table.='<td class="ticketboxavailable img-check" id="ticketbox'.$split_value_[0].'" data-place="'.$split_value_[0].'">'.$split_value_[0].'<input type="checkbox" class="hidden ticketbox" id="ticket'.$split_value_[0].'" name="ticket_book_sheet_seriasewithnumber[]" value="'.$split_value_[0].'"></td>';    
                                    }
                                }else{
                                    $table.='<td class="ticketboxavailable img-check" id="ticketbox'.$split_value_[0].'" data-place="'.$split_value_[0].'">'.$split_value_[0].'<input type="checkbox" class="hidden ticketbox" id="ticket'.$split_value_[0].'" name="ticket_book_sheet_seriasewithnumber[]" value="'.$split_value_[0].'"></td>';     
                                }

                            }else{
                                if(!empty($seatblockarr)){
                                    if(in_array($split_value_[0], $seatblockarr)){
                                        $table.='<td class="blockseat" ></td>';
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
    return $table.='</tbody></table>';   

            // $table .='<aside class="sits__checked">';

            //     $table .=' <div class="checked-place">';

            //     $table .='</div>';

            // $table .='<div class="checked-result">';

            //     $table .='<i class="fa fa-inr" ></i> 0';

            // $table .='</div>';

            // $table .='</aside>';

            // $table .='<footer class="sits__number" style ="margin-left: 42px;">';

            // for($c=1;$c<=$total_column;$c++)

            // {

            //     $table .='<span class="sits__indecator">'.$c.'</span>';

            // }

            // $table .='</footer>';



            

}
function screenwisechart($screen_id,$show_date,$show_time) {
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
    $book_qry = "SELECT `book_seat` FROM suraj_movie_ticket_book where `is_delete`='0' ";
    $book_qry .= " and book_date='".date('Y-m-d',strtotime($show_date))."' and book_showstarttime='".$show_time."' and book_screen_number='".$screen_id."'";
    
     $select_booking_seat=$db->selectAll($book_qry);
    $seatstr='';
    if(!empty($select_booking_seat)){
        foreach ($select_booking_seat as $booking_seatkey => $booking_seatvalue) {
            $seatarr[$booking_seatkey]=$booking_seatvalue['book_seat'];
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
                                  }
                                  else{
                                    $table.='<td class="ticketboxavailable img-check" id="ticketbox'.$split_value_[0].'" data-place="'.$split_value_[0].'">'.$split_value_[0].'<input type="checkbox" class="hidden ticketbox" id="ticket'.$split_value_[0].'" name="ticket_book_sheet_seriasewithnumber[]" value="'.$split_value_[0].'"></td>';     
                                }

                          }else{
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
  
  return $table;exit;
}

function getABCD($i){

    $arrMon = array(1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F',7=>'G',8=>'H',9=>'I',10=>'J',11=>'K',12=>'L',13=>'M',14=>'N',15=>'O',16=>'P',17=>'Q',18=>'R',19=>'S',20=>'T',21=>'U',22=>'V',23=>'W',24=>'X',24=>'Y',24=>'Z');

    return $arrMon[$i];

}
function getticketprint($ticketidarry){
    global $db;
    $tickethtml = '';
    clearstatcache();
    if($ticketidarry!=''){
        $ary=ltrim($ticketidarry, '-');
        $exploadary=explode('-',$ary);
        $TicketId=implode(',',$exploadary);
        $tickethtml .='<html>';
        $tickethtml .='<head>';
        $tickethtml .='<title>Print Ticket | Suraj Cineplex</title>';
        $tickethtml .='<style>*{margin: 0;padding: 0;}';
        $tickethtml .='@media print {
                        #mytable { 
                            page-break-after:always;
                            -webkit-transform: rotate(270deg);
                            -moz-transform:rotate(270deg);
                        }
                        @page
                        {
                            size: 4in 4in ;
                            size: portrait;
                        }
                    }';
        $tickethtml .='#mytable {border-collapse: collapse;}';
        $tickethtml .='</style>';
        $tickethtml .='</head>';
        $tickethtml .='<body>';
        if($ary!=''){ 
            $book_qry = 'SELECT tk.book_id,tk.book_seat_series,
            tk.book_seat_no,
            tk.book_ticket_total,
            tk.book_showname,
            tk.book_showstarttime,
            tk.book_date,
            tk.book_seat,
            tk.book_seatclass,
            tk.book_moviename,
            tk.book_screen_number,
            ms.symbol  
            FROM suraj_movie_ticket_book as tk 
            LEFT JOIN suraj_screen_master as ms ON tk.book_screen_number=ms.id
            WHERE book_id IN ('.$TicketId.')';
            $bookdetails = $db->selectAll($book_qry);
            foreach ($bookdetails as $key => $bookdetailvalue) {
                $book_id = $bookdetailvalue['book_id'];
                $total = trim($bookdetailvalue['book_ticket_total']);
                if($total=='112' || $total<112){
                    //18 tax intrigration
                    $tax = number_format(($total*12/112),2);
                    $cgst = number_format(($tax/2),2);
                    $sgst = number_format(($tax/2),2);                 
                    $sch = (25-number_format(25*12/112,2));
                    $adm = number_format(($total-$cgst-$sgst-$sch),2);  
                }else{
                    //28 tax intrigration
                    $tax = number_format(($total*18/118),2);
                    $cgst = number_format(($tax/2),2);
                    $sgst = number_format(($tax/2),2);
                    $sch = (25-number_format(25*18/118,2));
                    $adm = number_format(($total-$cgst-$sgst-$sch),2);  
                }
                $tickethtml .='<div style="height:384px;width:384px;background-color: white;font-family: Arial;">';
                $tickethtml .='<table id="mytable" style="font-size:12px;" cellspacing="0" cellpadding="0" border="0">';
                $tickethtml .='<tbody>';
                $tickethtml .='<tr>';
                    $tickethtml .='<td style="width: 302px;height:105px;overflow:hidden;padding-left: 15px;padding-right: 0px;padding-bottom: 0px;padding-top:38px;">';
                    $tickethtml .='<table style="border: 2px solid black;height:102px;width: 298px;overflow: hidden;" cellspacing="0" cellpadding="0">';
                    $tickethtml .='<tr>';
                        $tickethtml .='<td>';
                        $tickethtml .='<table  cellspacing="2" cellpadding="0" width="100%">';
                        $tickethtml .='<tr>';
                        $tickethtml .='<td style="font-size:8px;font-family: Arial;" align="center">
                                <b style="margin-left: 5px;">A</b><br>
                            </td>';
                        $tickethtml .='<td colspan="4"><b style="font-size:10px;">SURAJ CINEPLEX - JUNAGADH</b><br><b style="font-size:8px;">'.$bookdetailvalue['book_moviename'].'</b></td>';
                        $tickethtml .='</tr>';
                        $tickethtml .='</table>';
                        $tickethtml .='</td>';
                    $tickethtml .='</tr>';
                    $tickethtml .='<tr>';
                        $tickethtml .='<td style="border-top: 1px solid black;">';
                        $tickethtml .='<table>';
                        $tickethtml .='<tr>';
                        $tickethtml .='<td width="30%">';
                            $tickethtml .='<table style="font-size:6px;font-family: Arial;">';
                            $tickethtml .='<tr>
                                        <td>ADM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$adm.'</td>
                                    </tr>
                                    <tr>
                                        <td>CGST&nbsp;&nbsp;&nbsp;&nbsp;'.$cgst.'</td>
                                    </tr>
                                    <tr>
                                        <td>SGST&nbsp;&nbsp;&nbsp;&nbsp;'.$sgst.'</td>
                                    </tr>
                                    <tr>
                                        <td>S.CH&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$sch.'</td>
                                    </tr>
                                    <tr>
                                        <td><b style="font-size:8px;font-family: Arial;">&nbsp; Total:&nbsp;'.number_format(trim($bookdetailvalue['book_ticket_total']),2).' </b></td>
                                    </tr>';
                                $tickethtml .='</table>';
                        $tickethtml .='</td>';
                        $tickethtml .='<td width="30%" style="border-left: 1px solid black;" valign="top">';
                            $tickethtml .='<table style="font-size:10px;font-family: Arial;font-weight: bold;">';
                            $tickethtml .='<tr>';
                            $tickethtml .='<td>'.date('D',strtotime($bookdetailvalue['book_date'])).','.date('d-m-y',strtotime($bookdetailvalue['book_date'])).'</td>';
                            $tickethtml .='</tr>';
                            $tickethtml .='<tr>';
                                    $tickethtml .='<td>'.ucwords(strtolower(substr($bookdetailvalue['book_showname'], 0, 3))).';?>, '.date('h:i A',strtotime($bookdetailvalue['book_showstarttime'])).'</td>';
                            $tickethtml .='</tr>';
                            $tickethtml .='<tr>';
                                $tickethtml .='<td style="font-size: 8px;">SAC 0</td>';
                            $tickethtml .='</tr>';
                            $tickethtml .='</table>';
                        $tickethtml .='</td>';
                        $tickethtml .='<td width="20%" style="border-left: 1px solid black;" valign="top">
                            <table style="font-size:10px;font-family: Arial;font-weight: bold;">
                                <tr>
                                    <td>Screen '.$bookdetailvalue['symbol'].'</td>
                                </tr>
                                <tr>
                                    <td>'.$bookdetailvalue['book_seat_series'].'-'.$bookdetailvalue['book_screen_number'].'</td>
                                </tr>
                                <tr>
                                    <td>'.$bookdetailvalue['book_seatclass'].'</td>
                                </tr>
                            </table>
                        </td>
                                </tr>
                            </table>
                        </td>
                    </tr>';
                    $tickethtml .='<tr>';
                        $tickethtml .='<td style="border-top: 1px solid black;">';
                        $tickethtml .='<table>';
                        $tickethtml .='<tr>';
                        $tickethtml .='<td width="100%" style="font-size: 6px;font-family: Arial;font-weight: bold;">GSTN :24AACCSS5586Q1Z &nbsp; Ticket No. '.$book_id.'L.No &nbsp;Transaction No: A0'.rand(1000,10000).'<br>CIN: 24309800936&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;INV No.: 000000'.rand(100,10000).' &nbsp;&nbsp;Issued on :'.date('d-M-y h:i:s A').'
                                    </td>';
                        $tickethtml .='</tr>';
                        $tickethtml .='</table>';
                        $tickethtml .='</td>';
                    $tickethtml .='</tr>';
                    $tickethtml .='</table>';
                    $tickethtml .='</td>';
                $tickethtml .='</tr>';
                $tickethtml .='<tr>';
                    $tickethtml .='<td style="width: 302px;height:105px;overflow:hidden;padding-left: 15px;padding-right: 0px;padding-bottom: 10px;padding-top:10px;">';
                        $tickethtml .='<table style="border: 2px solid black;height:102px;width: 298px;overflow: hidden;" cellspacing="0" cellpadding="0">';
                                $tickethtml .='<tr>';
                                    $tickethtml .='<td>';
                                        $tickethtml .='<table  cellspacing="2" cellpadding="0" width="100%">';
                                            $tickethtml .='<tr>';
                                                $tickethtml .='<td style="font-size:8px;font-family: Arial;" align="center">';
                                                    $tickethtml .='<b style="margin-left: 5px;">D</b><br>';
                                                $tickethtml .='</td>';
                                                $tickethtml .='<td colspan="4">';
                                                    $tickethtml .='<b style="font-size:10px;">SURAJ CINEPLEX - JUNAGADH</b><br>';
                                                    $tickethtml .='<b style="font-size:8px;">'.$bookdetailvalue['book_moviename'].'</b>';
                                                $tickethtml .='</td>';
                                            $tickethtml .='</tr>';
                                        $tickethtml .='</table>';
                                    $tickethtml .='</td>';
                                $tickethtml .='</tr>';

                                
                $tickethtml .='</tbody>';
                $tickethtml .='</table>';
                $tickethtml .='</div>';
            }
        }
        $tickethtml .='</body>';
        $tickethtml .='</html>';
    }
    return $tickethtml;
}
function sendsmsallinone($msg){
    if($msg != ''){
        $mob = '9913837370,9825222115,9879812000,8460213084';
        $url =  'https://login.smsforyou.biz/V2/http-api.php?';
        $data = 'apikey=m3FILzGV5OkCMQBj&senderid=SCINEM&number='.$mob.'&message='.urlencode($msg).'&format=json&pe_id=1201160688739661546&template_id=1207166141294115056';
        $ch = curl_init($url);
       // set URL and other appropriate options
       curl_setopt($ch, CURLOPT_URL, $url.$data );
       curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
       curl_exec($ch);
       curl_close($ch);
    }
}
function sendsmsallinonebk($msg){
    if($msg != ''){
        $mob = '9913837370,9825222115,9879812000';
        //$mob = '8460213084';
        $url =  'http://manage.smsforyou.biz/API/WebSMS/Http/v1.0a/index.php?';
        $data = 'username=surajc&password=Noblehouse@123&sender=CINEMA&to='.$mob.'&message='.urlencode($msg).'&reqid=1';
        $ch = curl_init($url);
       // set URL and other appropriate options
       curl_setopt($ch, CURLOPT_URL, $url.$data );
       curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
       curl_exec($ch);
       curl_close($ch);
    }
}
function encryptItscp($string){
    $simple_string = $string; 
    $ciphering = "AES-128-CTR"; 
    $iv_length = openssl_cipher_iv_length($ciphering); 
    $options = 0; 
    // Non-NULL Initialization Vector for encryption 
    $encryption_iv = '1234567891011121'; 
    // Store the encryption key 
    $encryption_key = "SurajCineplex"; 
    // Use openssl_encrypt() function to encrypt the data 
    $encryption = openssl_encrypt($simple_string, $ciphering, 
            $encryption_key, $options, $encryption_iv); 
    return $encryption;
}
function decryptItscp($EncryptionString){
    $encryption=$EncryptionString;
    $ciphering = "AES-128-CTR";
    $options = 0; 
    $iv_length = openssl_cipher_iv_length($ciphering); 
    // Non-NULL Initialization Vector for decryption 
    $decryption_iv = '1234567891011121'; 
    // Store the decryption key 
    $decryption_key = "SurajCineplex"; 
    // Use openssl_decrypt() function to decrypt the data 
    $decryption=openssl_decrypt ($encryption, $ciphering,  
        $decryption_key, $options, $decryption_iv); 
  
    // Display the decrypted string 
    return $decryption;
}
// Common
function sendsmsbyurl($msg,$mob='',$admin=true){
		global $db;
		if($msg != ''){
	
		$str = 'SELECT * from site_configuration where sc_id_pk =1';
		$res =  $db->query_first($str);
		
		if($admin == true)
			$mob = $res['sc_mobile'];
		
		$url =  $res['sc_url'];
		$data = '&username='.$res['sc_sms_user'].'&password='.$res['sc_sms_pass'].'&message='.urlencode( $msg ).'&mobile='.$mob.'&sender=';
		
		$ch = curl_init($url);

		// set URL and other appropriate options
		curl_setopt($ch, CURLOPT_URL, $url.$data );
		curl_setopt($ch, CURLOPT_HEADER, 0);
		
		// grab URL and pass it to the browser
		$return = curl_exec($ch);		
		// close cURL resource, and free up system resources
		curl_close($ch);
		
		if(strpos($return, $res['sc_sms_return']) !== false){
			return true;
		}else{
			return false;
		}
		
		}
		return false;
}

function getExtension($str) {

         $i = strrpos($str,".");
         if (!$i) { return ""; } 

         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return strtolower($ext);
}
function getFileExtension($file_name) {
    if ($file_name != '') {
        $file_name = strtolower($file_name);
        $extension = substr(strrchr($file_name, '.'), 1);
        return $extension;
    }
    return;
}

function isValidEmail($email) {
	
    if (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email)) {
        return false;
    } else {
        return true;
    }
}

function dmy_format($date, $time=false) {
    $dt = '';
    if ($date != '') {
        if ($time == true)
            $dt = date('d-m-Y H:i:s', strtotime($date));
        else
            $dt = date('d-m-Y', strtotime($date));
    }
    return $dt;
}

function db_date_format($date, $time=false) {
    $dt = '';
    if ($date != '') {
        if ($time == true)
            $dt = date('Y-m-d H:i:s', strtotime($date));
        else
            $dt = date('Y-m-d', strtotime($date));
    }
    return $dt;
}

function getMonthName($i){
	$arrMon = array(1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'May',6=>'Jun',7=>'Jul',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec');
	return $arrMon[$i];
}

function sort_fields($field, $sortby, $sort_order) {
    if ($field == $sortby) {
        echo '<img align="absmiddle" border="0" src="' . constant("IMAGE_PATH") . 'sort' . $sort_order . '.gif" alt="" />';
    }
}

function convert_number_to_words($number) {
    //A function to convert numbers into Indian readable words with Cores, Lakhs and Thousands.
    $words = array(
        '0' => '', '1' => 'one', '2' => 'two', '3' => 'three', '4' => 'four', '5' => 'five',
        '6' => 'six', '7' => 'seven', '8' => 'eight', '9' => 'nine', '10' => 'ten',
        '11' => 'eleven', '12' => 'twelve', '13' => 'thirteen', '14' => 'fouteen', '15' => 'fifteen',
        '16' => 'sixteen', '17' => 'seventeen', '18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty',
        '30' => 'thirty', '40' => 'fourty', '50' => 'fifty', '60' => 'sixty', '70' => 'seventy',
        '80' => 'eighty', '90' => 'ninty');

    //First find the length of the number
    $number_length = strlen($number);
    //Initialize an empty array
    $number_array = array(0, 0, 0, 0, 0, 0, 0, 0, 0);
    $received_number_array = array();

    //Store all received numbers into an array
    for ($i = 0; $i < $number_length; $i++) {
        $received_number_array[$i] = substr($number, $i, 1);
    }

    //Populate the empty array with the numbers received - most critical operation
    for ($i = 9 - $number_length, $j = 0; $i < 9; $i++, $j++) {
        $number_array[$i] = $received_number_array[$j];
    }
    $number_to_words_string = "";
    //Finding out whether it is teen ? and then multiplying by 10, example 17 is seventeen, so if 1 is preceeded with 7 multiply 1 by 10 and add 7 to it.
    for ($i = 0, $j = 1; $i < 9; $i++, $j++) {
        if ($i == 0 || $i == 2 || $i == 4 || $i == 7) {
            if ($number_array[$i] == "1") {
                $number_array[$j] = 10 + $number_array[$j];
                $number_array[$i] = 0;
            }
        }
    }

    $value = "";
    for ($i = 0; $i < 9; $i++) {
        if ($i == 0 || $i == 2 || $i == 4 || $i == 7) {
            $value = $number_array[$i] * 10;
        } else {
            $value = $number_array[$i];
        }
        if ($value != 0) {
            $number_to_words_string.= $words["$value"] . " ";
        }
        if ($i == 1 && $value != 0) {
            $number_to_words_string.= "Crores ";
        }
        if ($i == 3 && $value != 0) {
            $number_to_words_string.= "Lakhs ";
        }
        if ($i == 5 && $value != 0) {
            $number_to_words_string.= "Thousand ";
        }
        if ($i == 6 && $value != 0) {
            $number_to_words_string.= "Hundred &amp; ";
        }
    }
    if ($number_length > 9) {
        $number_to_words_string = "Sorry This does not support more than 99 Crores";
    }
    return ucwords(strtolower("" . $number_to_words_string) . "");
}

function isdigit($num) {
    if (preg_match("/^\d+(\.\d+)?$/", $num)) {
        return true;
    } else {
        return false;
    }
}

function addSlashesForDB($str) {
    return str_replace('\'', '\'\'', $str);
}
function pages($totalpages2, $targepage2, $limit2, $page2, $othrparameter) {
    $total_pages = $totalpages2;
    $targetpage = $targepage2;
    $limit = $limit2;
    $page = $page2;
    $adjacents = 3;
    /* Setup page vars for display. */
    if ($page == 0)
        $page = 1;     //if no page var is given, default to 1.
 $prev = $page - 1;       //previous page is page - 1
    $next = $page + 1;       //next page is page + 1
    $lastpage = ceil($total_pages / $limit);  //lastpage is = total pages / items per page, rounded up.
    $lpm1 = $lastpage - 1;      //last page minus 1

    /*
      Now we apply our rules and draw the pagination object.
      We're actually saving the code to a variable in case we want to draw it more than once.
     */
    $pagination = "";
    if ($lastpage > 1) {
        $pagination .= "<div class=\"dataTables_paginate paging_simple_numbers\" >";
        //previous button
        if ($page > 1)
            $pagination.= "<a href=\"$targetpage?page=$prev&$othrparameter\" class='paginate_button previous disabled' aria-controls='DataTables_Table_0'  id='DataTables_Table_0_previous'>&laquo;  Prev</a>";
        else
            $pagination.= "<a href=\"$targetpage?page=$prev&$othrparameter\" class='paginate_button previous disabled' aria-controls='DataTables_Table_0'  id='DataTables_Table_0_previous'>&laquo;  Prev</a>";

        //pages
        if ($lastpage < 7 + ($adjacents * 2)) { //not enough pages to bother breaking it up
            for ($counter = 1; $counter <= $lastpage; $counter++) {
                if ($counter == $page)
                    $pagination.= "<a href=\"$targetpage?page=$counter&$othrparameter\" class='paginate_button current' style='background-color:green;color:white;' >$counter</a>";
                   
                else
                    $pagination.= "<a href=\"$targetpage?page=$counter&$othrparameter\" class='paginate_button current' >$counter</a>";
            }
        }
        elseif ($lastpage > 5 + ($adjacents * 2)) { //enough pages to hide some
            //close to beginning; only hide later pages
            if ($page < 1 + ($adjacents * 2)) {
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                    if ($counter == $page)
                        $pagination.= "<a href=\"$targetpage?page=$counter&$othrparameter\" class='paginate_button current' >$counter</a>";
                    else
                        $pagination.= "<a href=\"$targetpage?page=$counter&$othrparameter\" class='paginate_button'>$counter</a>";
                }
                $pagination.= "...";
                $pagination.= "<a href=\"$targetpage?page=$lpm1&$othrparameter\" class='paginate_button'>$lpm1</a>";
                $pagination.= "<a href=\"$targetpage?page=$lastpage&$othrparameter\" class='paginate_button'>$lastpage</a>";
            }
            //in middle; hide some front and some back
            elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                $pagination.= "<a href=\"$targetpage?page=1\" class='paginate_button'>1</a>";
                $pagination.= "<a href=\"$targetpage?page=2\" class='paginate_button'>2</a>";
                $pagination.= "...";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                    if ($counter == $page)
                         $pagination.= "<a href=\"$targetpage?page=$counter&$othrparameter\" class='paginate_button current' >$counter</a>";
                    else
                        $pagination.= "<a href=\"$targetpage?page=$counter&$othrparameter\" class='paginate_button'>$counter</a>";
                }
                $pagination.= "...";
                $pagination.= "<a href=\"$targetpage?page=$lpm1&$othrparameter\" class='paginate_button'>$lpm1</a>";
                $pagination.= "<a href=\"$targetpage?page=$lastpage&$othrparameter\" class='paginate_button next'>$lastpage</a>";
            }
            //close to end; only hide early pages
            else {
                $pagination.= "<a href=\"$targetpage?page=1\" class='paginate_button'>1</a>";
                $pagination.= "<a href=\"$targetpage?page=2\" class='paginate_button'>2</a>";
                $pagination.= "...";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                         $pagination.= "<a href=\"$targetpage?page=$counter&$othrparameter\" class='paginate_button current' >$counter</a>";
                    else
                        $pagination.= "<a href=\"$targetpage?page=$counter&$othrparameter\" class='paginate_button'>$counter</a>";
                }
            }
        }

        //next button
        if ($page < $counter - 1)
            $pagination.= "<a href=\"$targetpage?page=$next&$othrparameter\" class='paginate_button'>Next &raquo;</a>";
        else
            $pagination.= "<span class='paginate_button next'>Next &raquo;</span>";
        $pagination.= "</div>\n";
        return $pagination;
    }
}

function get_random_string($length)
{
	$charset='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $str = '';
    $count = strlen($charset);
	
	for($i=1;$i<$length;$i++) {
        $str .= $charset[mt_rand(0, $count-1)];
    }
    return $str;
}

function dateTimeDiff($data_ref, $last_date) {
    $dateDiff = strtotime($last_date) - strtotime($data_ref);
    $fullDays = floor($dateDiff / (60 * 60 * 24));
    $fullHours = floor(($dateDiff - ($fullDays * 60 * 60 * 24)) / (60 * 60));
    $fullMinutes = floor(($dateDiff - ($fullDays * 60 * 60 * 24) - ($fullHours * 60 * 60)) / 60);
    //$ret= "$fullDays days, $fullHours hours and $fullMinutes minutes.";
    if ($fullHours < 10)
        $fullHours = "0" . $fullHours;
    if ($fullMinutes < 10)
        $fullMinutes = "0" . $fullMinutes;

    $ret = "$fullHours:$fullMinutes";
    return $ret;
}

function is_date($str) {
    $stamp = strtotime($str);

    if (!is_numeric($stamp)) {
        return FALSE;
    }
    $month = date('m', $stamp);
    $day = date('d', $stamp);
    $year = date('Y', $stamp);

    if (checkdate($month, $day, $year)) {
        return TRUE;
    }

    return FALSE;
}

function find_special_character($string) {
    if( $string != '' || $string != 'NULL' ) {
        if(!preg_match('#[^a-zA-Z0-9]#', $string)) {
            return true;
        }
    }
    return false;
}

function phoneNumbervalidation($mobile){
	
	$pattern  = '/^((\+){0,1}([0-9]{2,4})(\s){0,3}(\-){0,1}(\s){0,1})?([0-9]{8,10})$/';
	
	if(preg_match($pattern, $mobile,$matches)){
	//print_r($matches); exit;
	
	return true;
	}
	else
	return false;
}
function short_fields($field,$sortby,$sort_order) {
    if($field == $sortby) {
        echo '<img align="absmiddle" border="0" src="'.constant("ADMIN_SITE").'images/sort'.$sort_order.'.gif" alt="" />';
    }
}

?>