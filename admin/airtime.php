<?php
require $_SERVER['DOCUMENT_ROOT']."/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/actions/airtime.php";

?>

<?php include"inc/header.php" ?>



                <div class="container-fluid">

                    <div class="layout-specing">
                        <br>
                        <?php echo $genMsg ?>
                        <div class="d-md-flex justify-content-between align-items-center">

                            <h5 class="mb-0">Prices </h5>



                            <nav aria-label="breadcrumb" class="d-inline-block mt-2 mt-sm-0">

                                <ul class="breadcrumb bg-transparent rounded mb-0 p-0">

                                    <li class="breadcrumb-item text-capitalize"><a href="dashboard.php"><?php echo $sitename ?></a></li>

                                    <li class="breadcrumb-item text-capitalize"><a href="#">Prices</a></li>

                                    <li class="breadcrumb-item text-capitalize active" aria-current="page">Data Prices </li>

                                </ul>

                            </nav>

                        </div>

                    

                        <div class="row">

                            <div class="col-md-7 col-lg-8 mt-4">

                                <div class="card rounded shadow p-4 border-0">

                                    <h4 class="mb-3">Airtime Discount </h4>

                                    <form method="POST">

                                        <div class="row g-3">

                                            <p>Enter discount amount for users as cashback. write in figure only</p>
                                            <div class="col-md-3">

                                                <label for="direct" class="form-label">Mtn </label>

                                                <input type="text" class="form-control" id="direct" placeholder="3" required  name="mtn" value="<?php echo $airtimeDiscountMtn ?>">

                                               

                                            </div>

                                        <div class="col-md-3">

                                                <label for="direct" class="form-label">Glo </label>

                                                <input type="text" class="form-control" id="direct" placeholder="5" required  name="glo" value="<?php echo $airtimeDiscountGlo ?>">

                                               

                                            </div>
                                            <div class="col-md-3">

                                                <label for="direct" class="form-label">Airtel </label>

                                                <input type="text" class="form-control" id="direct" placeholder="3" required  name="airtel" value="<?php echo $airtimeDiscountAirtel ?>">

                                               

                                            </div>

                                            <div class="col-md-3">

                                                <label for="direct" class="form-label">9mobile </label>

                                                <input type="text" class="form-control" id="direct" placeholder="7" required  name="9mobile" value="<?php echo $airtimeDiscount9Mobile ?>">

                                               

                                            </div>

        

                                            <div class="col-md-5">


                                            <div></div>

                                        </div>

        

        

                                        <button class="w-100 btn btn-primary" type="submit" name="addAirtimePrices">Save</button>

                                    </form>

                                </div>

                            </div><!--end col-->

                        </div><!--end row-->





                        

                    </div>

                </div><!--end container-->



<?php include"inc/footer.php" ?>

                