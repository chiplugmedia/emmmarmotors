<?php
require $_SERVER['DOCUMENT_ROOT']."/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/actions/plan-setting.php";
?>
<?php include"inc/header.php" ?>
                <div class="container-fluid">
                    <div class="layout-specing">
                        <br>
                        <?php echo $genMsg?>
                        <div class="d-md-flex justify-content-between align-items-center">
                            <h5 class="mb-0">General Setting</h5>
                            <nav aria-label="breadcrumb" class="d-inline-block mt-2 mt-sm-0">
                                <ul class="breadcrumb bg-transparent rounded mb-0 p-0">
                                    <li class="breadcrumb-item text-capitalize"><a href="profile">General </a></li>
                                    <li class="breadcrumb-item text-capitalize active" aria-current="page">Plan Settings</li>
                                </ul>
                            </nav>
                        </div>
                        <div class="row">

                            <div class="col-lg-4 mt-4">
                                <div class="card border-0 rounded shadow p-4 mt-4">
                                    <h5 class="mb-0"> PLAN A :</h5>
                                    <form method="POST">
                                        <div class="row mt-4">
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Daily login :</label>
                                                    <div class="form-icon position-relative">
                                                        <i data-feather="key" class="fea icon-sm icons"></i>
                                                        <input type="text" class="form-control ps-5" placeholder="Daily login " name="dailyLogina" value="<?php echo $dailyLoginA?>">
                                                    </div>
                                                </div>
                                            </div><!--end col-->
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Referral Bonus :</label>
                                                    <div class="form-icon position-relative">
                                                        <i data-feather="key" class="fea icon-sm icons"></i>
                                                        <input type="text" class="form-control ps-5" placeholder="Referral Bonus" name="refBonusa" value="<?php echo $refBonusA ?>">
                                                    </div>
                                                </div>
                                            </div><!--end col-->
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Welcome bonus:</label>
                                                    <div class="form-icon position-relative">
                                                        <i data-feather="key" class="fea icon-sm icons"></i>
                                                        <input type="text" class="form-control ps-5" placeholder="Welcome  bonus" name="welBonusa" value="<?php echo $welcomeBonusA ?>">
                                                    </div>
                                                </div>
                                            </div><!--end col-->
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Minimum act wallet Withdrawal :</label>
                                                    <div class="form-icon position-relative">
                                                        <i data-feather="key" class="fea icon-sm icons"></i>
                                                        <input type="text" class="form-control ps-5" placeholder="Minimum act Withdrawal " name="minActWithdrawAmta" value="<?php echo $minActWithdrawAmtA ?>">
                                                    </div>
                                                </div>
                                            </div><!--end col-->
                                            <div class="mb-3">
                                                <label class="form-label">Minimum Referral wallet withdrawal:</label>
                                                <div class="form-icon position-relative">
                                                    <i data-feather="key" class="fea icon-sm icons"></i>
                                                    <input type="text" class="form-control ps-5" placeholder="Minimum Referral wallet withdrawal" name="minRefWithdrawAmta" value="<?php echo $minRefWithdrawAmtA ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Sponsored post:</label>
                                                    <div class="form-icon position-relative">
                                                        <i data-feather="key" class="fea icon-sm icons"></i>
                                                        <input type="text" class="form-control ps-5" placeholder="Sponsored post " name="spAmta" value="<?php echo $sponsoredPostAmtA ?>">
                                                    </div>
                                                </div>
                                            </div><!--end col-->
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Indirect bonus:</label>
                                                    <div class="form-icon position-relative">
                                                        <i data-feather="key" class="fea icon-sm icons"></i>
                                                        <input type="text" class="form-control ps-5" placeholder="Indirect bonus " name="indRefa" value="<?php echo $indRefA ?>">
                                                    </div>
                                                </div>
                                            </div><!--end col-->
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Third Indirect bonus:</label>
                                                    <div class="form-icon position-relative">
                                                        <i data-feather="key" class="fea icon-sm icons"></i>
                                                        <input type="text" class="form-control ps-5" placeholder="Third Indirect bonus " name="thirdIndRefa" value="<?php echo $thirdIndRefA ?>">
                                                    </div>
                                                </div>
                                            </div><!--end col-->
                                            <div class="col-lg-12 mt-2 mb-0">
                                                <button class="btn btn-primary" name="savePlanA" type="submit">Save Settings</button>
                                            </div><!--end col-->
                                        </div><!--end row-->
                                    </form>
                                </div>
                            </div><!--end col-->
                            
                            <div class="col-lg-4 mt-4">
                                <div class="card border-0 rounded shadow p-4 mt-4">
                                    <h5 class="mb-0"> PLAN B :</h5>
                                    <form method="POST">
                                        <div class="row mt-4">
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Daily login :</label>
                                                    <div class="form-icon position-relative">
                                                        <i data-feather="key" class="fea icon-sm icons"></i>
                                                        <input type="text" class="form-control ps-5" placeholder="Daily login " name="dailyLoginb" value="<?php echo $dailyLoginB?>">
                                                    </div>
                                                </div>
                                            </div><!--end col-->
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Referral Bonus :</label>
                                                    <div class="form-icon position-relative">
                                                        <i data-feather="key" class="fea icon-sm icons"></i>
                                                        <input type="text" class="form-control ps-5" placeholder="Referral Bonus" name="refBonusb" value="<?php echo $refBonusB ?>">
                                                    </div>
                                                </div>
                                            </div><!--end col-->
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Welcome bonus:</label>
                                                    <div class="form-icon position-relative">
                                                        <i data-feather="key" class="fea icon-sm icons"></i>
                                                        <input type="text" class="form-control ps-5" placeholder="Welcome  bonus" name="welBonusb" value="<?php echo $welcomeBonusB ?>">
                                                    </div>
                                                </div>
                                            </div><!--end col-->
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Minimum act wallet Withdrawal :</label>
                                                    <div class="form-icon position-relative">
                                                        <i data-feather="key" class="fea icon-sm icons"></i>
                                                        <input type="text" class="form-control ps-5" placeholder="Minimum act Withdrawal " name="minActWithdrawAmtb" value="<?php echo $minActWithdrawAmtB ?>">
                                                    </div>
                                                </div>
                                            </div><!--end col-->
                                            <div class="mb-3">
                                                <label class="form-label">Minimum Referral wallet withdrawal:</label>
                                                <div class="form-icon position-relative">
                                                    <i data-feather="key" class="fea icon-sm icons"></i>
                                                    <input type="text" class="form-control ps-5" placeholder="Minimum Referral wallet withdrawal" name="minRefWithdrawAmtb" value="<?php echo $minRefWithdrawAmtB ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Sponsored post:</label>
                                                    <div class="form-icon position-relative">
                                                        <i data-feather="key" class="fea icon-sm icons"></i>
                                                        <input type="text" class="form-control ps-5" placeholder="Sponsored post " name="spAmtb" value="<?php echo $sponsoredPostAmtB ?>">
                                                    </div>
                                                </div>
                                            </div><!--end col-->
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Indirect bonus:</label>
                                                    <div class="form-icon position-relative">
                                                        <i data-feather="key" class="fea icon-sm icons"></i>
                                                        <input type="text" class="form-control ps-5" placeholder="Indirect bonus " name="indRefb" value="<?php echo $indRefB ?>">
                                                    </div>
                                                </div>
                                            </div><!--end col-->
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Third Indirect bonus:</label>
                                                    <div class="form-icon position-relative">
                                                        <i data-feather="key" class="fea icon-sm icons"></i>
                                                        <input type="text" class="form-control ps-5" placeholder="Third Indirect bonus " name="thirdIndRefb" value="<?php echo $thirdIndRefB ?>">
                                                    </div>
                                                </div>
                                            </div><!--end col-->
                                            <div class="col-lg-12 mt-2 mb-0">
                                                <button class="btn btn-primary" name="savePlanB" type="submit">Save Settings</button>
                                            </div><!--end col-->
                                        </div><!--end row-->
                                    </form>
                                </div>
                            </div><!--end col-->
                            
                            <div class="col-lg-4 mt-4">
                                <div class="card border-0 rounded shadow p-4 mt-4">
                                    <h5 class="mb-0"> PLAN C :</h5>
                                    <form method="POST">
                                        <div class="row mt-4">
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Daily login :</label>
                                                    <div class="form-icon position-relative">
                                                        <i data-feather="key" class="fea icon-sm icons"></i>
                                                        <input type="text" class="form-control ps-5" placeholder="Daily login " name="dailyLoginc" value="<?php echo $dailyLoginC?>">
                                                    </div>
                                                </div>
                                            </div><!--end col-->
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Referral Bonus :</label>
                                                    <div class="form-icon position-relative">
                                                        <i data-feather="key" class="fea icon-sm icons"></i>
                                                        <input type="text" class="form-control ps-5" placeholder="Referral Bonus" name="refBonusc" value="<?php echo $refBonusC ?>">
                                                    </div>
                                                </div>
                                            </div><!--end col-->
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Welcome bonus:</label>
                                                    <div class="form-icon position-relative">
                                                        <i data-feather="key" class="fea icon-sm icons"></i>
                                                        <input type="text" class="form-control ps-5" placeholder="Welcome  bonus" name="welBonusc" value="<?php echo $welcomeBonusC ?>">
                                                    </div>
                                                </div>
                                            </div><!--end col-->
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Minimum act wallet Withdrawal :</label>
                                                    <div class="form-icon position-relative">
                                                        <i data-feather="key" class="fea icon-sm icons"></i>
                                                        <input type="text" class="form-control ps-5" placeholder="Minimum act Withdrawal " name="minActWithdrawAmtc" value="<?php echo $minActWithdrawAmtC ?>">
                                                    </div>
                                                </div>
                                            </div><!--end col-->
                                            <div class="mb-3">
                                                <label class="form-label">Minimum Referral wallet withdrawal:</label>
                                                <div class="form-icon position-relative">
                                                    <i data-feather="key" class="fea icon-sm icons"></i>
                                                    <input type="text" class="form-control ps-5" placeholder="Minimum Referral wallet withdrawal" name="minRefWithdrawAmtc" value="<?php echo $minRefWithdrawAmtC ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Sponsored post:</label>
                                                    <div class="form-icon position-relative">
                                                        <i data-feather="key" class="fea icon-sm icons"></i>
                                                        <input type="text" class="form-control ps-5" placeholder="Sponsored post " name="spAmtc" value="<?php echo $sponsoredPostAmtC ?>">
                                                    </div>
                                                </div>
                                            </div><!--end col-->
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Indirect bonus:</label>
                                                    <div class="form-icon position-relative">
                                                        <i data-feather="key" class="fea icon-sm icons"></i>
                                                        <input type="text" class="form-control ps-5" placeholder="Indirect bonus " name="indRefc" value="<?php echo $indRefC ?>">
                                                    </div>
                                                </div>
                                            </div><!--end col-->
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Third Indirect bonus:</label>
                                                    <div class="form-icon position-relative">
                                                        <i data-feather="key" class="fea icon-sm icons"></i>
                                                        <input type="text" class="form-control ps-5" placeholder="Third Indirect bonus " name="thirdIndRefc" value="<?php echo $thirdIndRefC ?>">
                                                    </div>
                                                </div>
                                            </div><!--end col-->
                                            <div class="col-lg-12 mt-2 mb-0">
                                                <button class="btn btn-primary" name="savePlanC" type="submit">Save Settings</button>
                                            </div><!--end col-->
                                        </div><!--end row-->
                                    </form>
                                </div>
                            </div><!--end col-->
                        
                        
                    </div>
                </div><!--end container-->
               <?php include"inc/footer.php" ?>