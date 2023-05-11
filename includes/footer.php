 </div><!-- END PAGE CONTENT -->



 </div>

        <!-- END PAGE CONTAINER -->



        <!-- MESSAGE BOX-->

        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">

            <div class="mb-container">

                <div class="mb-middle">

                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>

                    <div class="mb-content">

                        <p>Are you sure you want to log out?</p>                    

                        <p>Press No if youwant to continue work. Press Yes to logout current user.</p>

                    </div>

                    <div class="mb-footer">

                        <div class="pull-right">

                            <a href=<?php echo SITE.'logout.php'; ?> class="btn btn-success btn-lg">Yes</a>

                            <button class="btn btn-default btn-lg mb-control-close">No</button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- END MESSAGE BOX-->

        <div class="message-box message-box-success animated fadeIn" id="message-box-success">

            <div class="mb-container">

                <div class="mb-middle">

                    <div class="mb-title"><span class="fa fa-check"></span> Success</div>

                    <div class="mb-content">

                        <p id="containt"></p>

                    </div>

                    <div class="mb-footer">

                        <a href="user-list.php" class="btn btn-default btn-lg mb-control-close">Close</a>

                    </div>

                </div>

            </div>

        </div>
        <div class="modal fade" id="pation-infomation-details" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Details</h4>
                    </div>
                    
                    <div id="pation-infomation-detailspanel">
                        
                    </div>
                    
                     
                
                </div>
            </div>
        </div>
        
        <div class="modal" id="printprogresss" >
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div id="printprogressdetailspanel">
                        <img src="<?php echo SITE;?>img/ticketprinting.gif" width="200">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="printprogress">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <center>
                        <img src="<?php echo SITE;?>img/ticketprinting.gif" width="200">
                        </center>
                    </div>
                </div>
            </div>
        </div>



        
        

        <!-- START SCRIPTS -->

        <!-- START PLUGINS -->

        <script type="text/javascript" src=<?php echo SITE."js/plugins/jquery/jquery.min.js";?> ></script>
        <script type="text/javascript" src=<?php echo SITE."js/plugins/jquery/jquery-ui.min.js";?> ></script>
        <script type="text/javascript" src=<?php echo SITE."js/plugins/bootstrap/bootstrap.min.js";?> ></script>
        <script type='text/javascript' src=<?php echo SITE.'js/plugins/icheck/icheck.min.js';?> ></script>        
        <script type="text/javascript" src=<?php echo SITE."js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js";?> ></script>
        <script type="text/javascript" src=<?php echo SITE."js/plugins/scrolltotop/scrolltopcontrol.js";?> ></script>
        <script type="text/javascript" src=<?php echo SITE."js/plugins/morris/raphael-min.js";?> ></script>  
        <script type='text/javascript' src=<?php echo SITE.'js/plugins/bootstrap/bootstrap-datepicker.js';?> ></script> 
        <script type="text/javascript" src=<?php echo SITE."js/plugins/bootstrap/bootstrap-file-input.js";?> ></script>
        <script type="text/javascript" src=<?php echo SITE."js/plugins/bootstrap/bootstrap-select.js";?> ></script>
        <script type="text/javascript" src=<?php echo SITE."js/plugins/tagsinput/jquery.tagsinput.min.js";?> ></script>
        <script type="text/javascript" src=<?php echo SITE."js/plugins/owl/owl.carousel.min.js";?> ></script>
        <script type="text/javascript" src=<?php echo SITE."js/plugins/moment.min.js";?>></script>
        <script type="text/javascript" src=<?php echo SITE."js/plugins/daterangepicker/daterangepicker.js";?> ></script>
        <script type="text/javascript" src=<?php echo SITE."js/plugins/bootstrap/bootstrap-timepicker.min.js";?> ></script>
        <script type="text/javascript" src=<?php echo SITE."js/plugins/datatables/jquery.dataTables.min.js";?> ></script>
        <script type="text/javascript" src=<?php echo SITE."js/plugins/summernote/summernote.js";?> ></script>
        <script type="text/javascript" src=<?php echo SITE."js/plugins.js";?> ></script>        
        <script type="text/javascript" src=<?php echo SITE."js/actions.js";?> ></script>
        <script type='text/javascript' src=<?php echo SITE.'js/plugins/jquery-validation/jquery.validate.js';?> ></script>
        <script type="text/javascript" src="<?php echo SITE;?>js/sweetalert2.all.min.js"></script>
        <script type='text/javascript' src=<?php echo SITE.'js/genral.js';?> ></script>

        <!-- END TEMPLATE -->

    <!-- END SCRIPTS -->          
        <script type='text/javascript'>
            
        
            $(document).keydown(function (event) {
              if (event.keyCode == 123) { // Prevent F12
                 // return false;
              }else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I        
                // return false;
              }
            });
            $(document).on("contextmenu", function (e) {        
             // e.preventDefault();
            });
        </script>
          

    </body>

</html>







