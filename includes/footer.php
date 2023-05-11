 </div>
        <!-- END wrapper -->

        


        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

       


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

        <!-- Vendor js -->
        <script src="<?php echo SITE;?>assets/js/vendor.min.js"></script>

        <script src="<?php echo SITE;?>assets/libs/morris-js/morris.min.js"></script>
        <script src="<?php echo SITE;?>assets/libs/raphael/raphael.min.js"></script>

        <script src="<?php echo SITE;?>assets/js/pages/dashboard.init.js"></script>

        <!-- App js -->
        <script src="<?php echo SITE;?>assets/js/app.min.js"></script>
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






