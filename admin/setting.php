<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$genMsg=$refBonus=$welcomeBonus=$minDataWithdrawAmt=$minRefWithdrawAmt=$minActWithdrawAmt=$sponsoredPostAmt=$indRef=$thirdIndRef=$dailyLogin="";

require $_SERVER['DOCUMENT_ROOT']."/invest/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/actions/settings.php";



$enableRef = $enableAct = $enableSpin = $enablevtu = "";

if ($refWithdraw == 1) {
    $enableRef = "checked";
}
if ($activityWithdraw == 1) {
    $enableAct = "checked";
}
if ($spinWheel == 1) {
    $enableSpin = "checked";
}
if ($vtuportal == 1) {
    $enablevtu = "checked";
}

include"inc/header.php" ?>



<div class="container-fluid">

    <div class="layout-specing">
        <br>
        <?php echo $genMsg?>

        <div class="d-md-flex justify-content-between align-items-center">

            <h5 class="mb-0">General Setting</h5>



            <nav aria-label="breadcrumb" class="d-inline-block mt-2 mt-sm-0">

                <ul class="breadcrumb bg-transparent rounded mb-0 p-0">



                    <li class="breadcrumb-item text-capitalize"><a href="profile">General </a></li>

                    <li class="breadcrumb-item text-capitalize active" aria-current="page">Plan Setting</li>

                </ul>

            </nav>

        </div>



        <div class="row">

            <div class="col-lg-4 mt-4">

                <div class="card border-0 rounded shadow">

                    <div class="card-body">

                        <h5 class="text-md-start text-center mb-0">Personal Details :</h5>







                        <form method="POST">

                            <div class="row mt-4">

                                <div class="col-md-6">

                                    <div class="mb-3">

                                        <label class="form-label">First Name</label>

                                        <div class="form-icon position-relative">

                                            <i data-feather="user" class="fea icon-sm icons"></i>

                                            <input name="firstname" id="first" type="text" class="form-control ps-5"
                                                placeholder="First Name :" required value="<?php echo $firstname?>">

                                        </div>

                                    </div>

                                </div>
                                <!--end col-->

                                <div class="col-md-6">

                                    <div class="mb-3">

                                        <label class="form-label">Last Name</label>

                                        <div class="form-icon position-relative">

                                            <i data-feather="user-check" class="fea icon-sm icons"></i>

                                            <input name="lastname" id="last" type="text" class="form-control ps-5"
                                                placeholder="Last Name :" required value="<?php echo $lastname?>">

                                        </div>

                                    </div>

                                </div>
                                <!--end col-->

                                <div class="col-md-6">

                                    <div class="mb-3">

                                        <label class="form-label">Your Email</label>

                                        <div class="form-icon position-relative">

                                            <i data-feather="mail" class="fea icon-sm icons"></i>

                                            <input name="email" id="email" type="email" class="form-control ps-5"
                                                placeholder="Your email :" required value="<?php echo $email?>">

                                        </div>

                                    </div>

                                </div>
                                <!--end col-->

                                <div class="col-md-6">

                                    <div class="mb-3">

                                        <label class="form-label">Phone No. :</label>

                                        <div class="form-icon position-relative">

                                            <i data-feather="phone" class="fea icon-sm icons"></i>

                                            <input name="phone" id="number" type="number" class="form-control ps-5"
                                                placeholder="Phone :" required value="<?php echo $phoneNumber?>">

                                        </div>

                                    </div>

                                </div>
                                <!--end col-->



                            </div>
                            <!--end row-->

                            <div class="row">

                                <div class="col-sm-12">

                                    <input type="submit" id="submit" name="saveDetails" class="btn btn-primary"
                                        value="Save Changes">

                                </div>
                                <!--end col-->

                            </div>
                            <!--end row-->

                        </form>
                        <!--end form-->

                    </div>

                </div>



            </div>
            <!--end col-->

            <div class="col-lg-4 mt-4">

                <div class="card border-0 rounded shadow p-4">

                    <h5 class="mb-0">Bank Details :</h5>

                    <form method="POST" enctype="multipart/form-data">

                        <div class="row mt-4">

                            <div class="col-lg-12">

                                <div class="mb-3">

                                    <label class="form-label">Bank :</label>

                                    <div class="form-icon position-relative">

                                        <i data-feather="key" class="fea icon-sm icons"></i>

                                        <input type="text" class="form-control ps-5" placeholder="Bank "
                                            name="flwSecretKey" value="<?php echo $flwSecretKey?>">

                                    </div>

                                </div>

                            </div>
                            <!--end col-->

                            <div class="col-lg-12">

                                <div class="mb-3">

                                    <label class="form-label">Account Name :</label>

                                    <div class="form-icon position-relative">

                                        <i data-feather="key" class="fea icon-sm icons"></i>

                                        <input type="text" class="form-control ps-5" placeholder="Account Name "
                                            name="flwPublicKey" value="<?php echo $flwPublicKey?>">

                                    </div>

                                </div>

                            </div>
                            <!--end col-->


                            <div class="col-lg-12">

                                <div class="mb-3">

                                    <label class="form-label">Account Number :</label>

                                    <div class="form-icon position-relative">

                                        <i data-feather="key" class="fea icon-sm icons"></i>

                                        <input type="text" class="form-control ps-5" placeholder="Account Number "
                                            name="paymentaccount" value="<?php echo $paymentAccount?>">

                                    </div>

                                </div>

                            </div>
                            <!--end col-->



                            <div class="col-lg-12 mt-2 mb-0">

                                <button class="btn btn-primary" name="saveFlutterwave">Save Details </button>

                            </div>
                            <!--end col-->



                        </div>
                        <!--end row-->

                    </form>

                </div>



            </div>
            <!--end col-->

            <div class="col-lg-4 mt-4">

                <div class="card border-0 rounded shadow p-4">

                    <h5 class="mb-0">Site Details :</h5>

                    <form method="POST" enctype="multipart/form-data">

                        <div class="row mt-4">

                            <div class="col-lg-12">

                                <div class="mb-3">

                                    <label class="form-label">SiteName :</label>

                                    <div class="form-icon position-relative">

                                        <i data-feather="key" class="fea icon-sm icons"></i>

                                        <input type="text" class="form-control ps-5" placeholder="Sitename "
                                            name="sitename" value="<?php echo $sitename?>">

                                    </div>

                                </div>

                            </div>
                            <!--end col-->

                            <div class="col-lg-12">

                                <div class="mb-3">

                                    <label class="form-label">Cstomer Service 1:</label>

                                    <div class="form-icon position-relative">

                                        <i data-feather="key" class="fea icon-sm icons"></i>

                                        <input type="text" class="form-control ps-5" placeholder="Cstomer Service 1 "
                                            name="sitetag" value="<?php echo $sitetag?>">

                                    </div>

                                </div>

                            </div>
                            <!--end col-->



                            <div class="col-lg-12">

                                <div class="mb-3">

                                    <label class="form-label">Cstomer Service 2:</label>

                                    <div class="form-icon position-relative">

                                        <i data-feather="key" class="fea icon-sm icons"></i>
                                        <input type="text" class="form-control ps-5" placeholder="Cstomer Service 2 "
                                            name="siteDesc" value="<?php echo $siteDesc?>">
                                    </div>

                                </div>

                            </div>
                            <!--end col-->



                            <!-- <div class="col-lg-12">

                                <div class="mb-3">

                                    <label class="form-label">Vtu API/Token :</label>

                                    <div class="form-icon position-relative">

                                        <i data-feather="key" class="fea icon-sm icons"></i>

                                        <input type="text" class="form-control ps-5" placeholder="Vtu API "
                                            name="apiKey" value="<?php echo $apiKey?>">

                                    </div>

                                </div>

                            </div> -->
                            <!--end col-->




                            <div>

                                <div class="form-check form-switch">

                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                        name="actWithdraw" <?php echo $enableAct?>>

                                    <label class="form-check-label" for="flexSwitchCheckDefault">Enable Withdrawal
                                    </label>

                                </div>

                                <!-- <div class="form-check form-switch">

                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                        name="refWithdraw" <?php echo $enableRef?>>

                                    <label class="form-check-label" for="flexSwitchCheckDefault">Enable 0 Level
                                        Withdrawal </label>

                                </div>

                                <div class="form-check form-switch">

                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                        name="spinWheel" <?php echo $enableSpin?>>

                                    <label class="form-check-label" for="flexSwitchCheckDefault">Enable 1 Level
                                        Withdrawal</label>

                                </div> -->

                                <div class="col-lg-12 mt-2 mb-0">

                                    <button class="btn btn-primary" name="siteDetails">Save Details </button>

                                </div>
                                <!--end col-->



                            </div>
                            <!--end row-->

                    </form>

                </div>


            </div>
            <!--end col-->

        </div>


    </div>
    <!--end col-->



</div>
<!--end row


                           <div class="container">
    <div class="row">
        <div class="mb-0 position-relative">
            <form method="POST">
                <button class="btn btn-primary m-1" name="deleteMsgusees">Delete User E</button>
            </form>
        </div>

        <div class="mb-0 position-relative">
            <form method="POST">
                <button class="btn btn-primary m-1" name="deleteusersponsored">Delete User T</button>
            </form>
        </div>

        <div class="mb-0 position-relative">
            <form method="POST">
                <button class="btn btn-primary m-1" name="deusert444asks">Delete User SP</button>
            </form>
        </div>
    </div>
</div><!--end container-->



<?php include"inc/footer.php" ?>