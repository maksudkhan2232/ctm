<?php include("../includes/config.php");
isLoggedIn();
include("../includes/header.php");?>
<?php 
    if($_SESSION['user_session_right']=='administrator'){
?>
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div>
                            <h4 class="header-title mb-3">Welcome !</h4>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-4">
                        <div>
                            <div class="card-box widget-inline">
                                <div class="row">
                                    <div class="col-xl-12 col-sm-12">
                                        <div class="text-center p-3">
                                            <?php 

                                            ?>
                                            <h2 class="mt-2"><b>75000.00</b></h2>
                                            <p class="text-muted mb-0">Today's Collection</p>
                                        </div>
                                    </div>
                             </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row -->

                
               <div class="row">
                    <div class="col-12">
                        <div>
                            <h4 class="header-title mb-3">Daily Analytics</h4>

                            <!-- Start row -->
                            <div class="row mt-5 justify-content-center">
                                <div class="col-md-10">
                                    

                                    <div class="row mt-5">
                                        <div class="col-lg-4">
                                            <div class="card text-center mt-3 bg-light border-0">
                                                <div class="card-header bg-primary">
                                                    <h5 class="text-uppercase text-white font-16">Film Name Display Here</h5>
                                                </div>

                                                <div class="text-center p-4 mb-3">
                                                    <h1 class="display-4 mt-0 font-weight-bold">12000.00</h1>
                                                    <p class="font-13">Total Show : 3</p>
                                                    <div class="text-center mt-5">
                                                        <a href="#" class="btn btn-danger width-md btn-rounded">View</a>                                                            </div>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="col-lg-4">
                                            <div class="card text-center mt-3 bg-light border-0">
                                                <div class="card-header bg-primary">
                                                    <h5 class="text-uppercase text-white font-16">Film Name Display Here</h5>
                                                </div>

                                                <div class="text-center p-4 mb-3">
                                                    <h1 class="display-4 mt-0 font-weight-bold">12000.00</h1>
                                                    <p class="font-13">Total Show : 3</p>
                                                    <div class="text-center mt-5">
                                                        <a href="#" class="btn btn-danger width-md btn-rounded">View</a>                                                            </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="card text-center mt-3 bg-light border-0">
                                                <div class="card-header bg-primary">
                                                    <h5 class="text-uppercase text-white font-16">Second Film Name Display Here</h5>
                                                </div>

                                                <div class="text-center p-4 mb-3">
                                                    <h1 class="display-4 mt-0 font-weight-bold">15000.00</h1>
                                                    <p class="font-13">Total Show : 5</p>
                                                    <div class="text-center mt-5">
                                                        <a href="#" class="btn btn-danger width-md btn-rounded">View</a>                                                            </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-4">
                                            <div class="card text-center mt-3 bg-light border-0">
                                                <div class="card-header bg-primary">
                                                    <h5 class="text-uppercase text-white font-16">Third Film Name Display Here</h5>
                                                </div>

                                                <div class="text-center p-4 mb-3">
                                                    <h1 class="display-4 mt-0 font-weight-bold">10000.00</h1>
                                                    <p class="font-13">Total Show : 2</p>
                                                    <div class="text-center mt-5">
                                                        <a href="#" class="btn btn-danger width-md btn-rounded">View</a>                                                            </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-4">
                                            <div class="card text-center mt-3 bg-light border-0">
                                                <div class="card-header bg-primary">
                                                    <h5 class="text-uppercase text-white font-16">Another Film Name Display Here</h5>
                                                </div>

                                                <div class="text-center p-4 mb-3">
                                                    <h1 class="display-4 mt-0 font-weight-bold">7000.00</h1>
                                                    <p class="font-13">Total Show : 2</p>
                                                    <div class="text-center mt-5">
                                                        <a href="#" class="btn btn-danger width-md btn-rounded">View</a>                                                            </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->
                        </div>
                    </div>
                </div>

                
                <!-- end row -->
            </div>
        </div>
    </div>
<?php } ?>                                
    
<?php include('../includes/footer.php');?>
