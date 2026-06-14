<?php
require $_SERVER['DOCUMENT_ROOT']."/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/actions/cable.php";

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

                                    <li class="breadcrumb-item text-capitalize"><a href="dashboard.php"><?php echo $sitename?></a></li>

                                    <li class="breadcrumb-item text-capitalize"><a href="#">Prices</a></li>

                                    <li class="breadcrumb-item text-capitalize active" aria-current="page">Cable Prices </li>

                                </ul>

                            </nav>

                        </div>

                    

                        <div class="row">

                            <div class="col-md-7 col-lg-8 mt-4">

                                <div class="card rounded shadow p-4 border-0">

                                    <h4 class="mb-3">Gotv Settings</h4>

                                    <form method="POST">

                                        <div class="row g-3">

                                            

        

                                            
                                            <div class="col-md-3">

                                                <label for="direct" class="form-label">Gotv Smallie (monthly)</label>

                                                <input type="text" class="form-control" id="direct" placeholder="500"  name="cable1" value="<?php echo $gotvSmallie?>" required>

                                               

                                            </div>

                                            <div class="col-md-3">

                                                <label for="direct" class="form-label">Gotv Smallie (quarterly) </label>

                                                <input type="text" class="form-control" id="2gb" placeholder="eg: 500"  name="cable2" value="<?php echo $gotvSmallieQ?>" required>

                                               

                                            </div>

                                             <div class="col-md-3">

                                                <label for="direct" class="form-label">Gotv Smallie (yearly)</label>

                                                <input type="number" class="form-control" id="2gb" placeholder="eg: 500"  name="cable3" value="<?php echo $gotvSmallieY?>" required>

                                               

                                            </div>

                                            <div class="col-md-5">

                                                <label for="number" class="form-label">Gotv Joli (monthly)</label>

                                                <input type="text" class="form-control" id="5gb" placeholder="eg: 500"  name="cable4" value="<?php echo $gotvJolli?>" required>

                                                

                                            </div>



                                                                         <div class="col-md-5">

                                                <label for="number" class="form-label">Gotv Jinja (monthly)</label>

                                                <input type="text" class="form-control" id="10gb" placeholder="eg: 500"  name="cable5" value="<?php echo $gotvJinja?>" required>

                                                

                                            </div>

                                            

                                            <div class="col-md-5">

                                                <label for="number" class="form-label">Gotv Max (monthly)</label>

                                                <input type="text" class="form-control" id="10gb" placeholder="eg: 500"  name="cable6" value="<?php echo $gotvMax?>" required>

                                                

                                            </div>

                                             <div class="col-md-3">

                                                <label for="direct" class="form-label">Gotv Supa  (monthly)</label>

                                                <input type="text" class="form-control" id="10gb" placeholder="eg: 500" name="cable7" value="<?php echo $gotvSupa?>" required>

                                               

                                            </div>


                                            <div></div>

                                        </div>

        

        

                                        <button class="w-100 btn btn-primary" type="submit" name="addGotv" value="addGotv">Save</button>

                                    </form>

                                </div>

                            </div><!--end col-->

                        </div><!--end row-->





                        <div class="row">

                            <div class="col-md-7 col-lg-8 mt-4">

                                <div class="card rounded shadow p-4 border-0">

                                    <h4 class="mb-3">Startimes Settings</h4>

                                    <form method="POST">

                                        <div class="row g-3">

                                            


                                            

                                            

                                            <div class="col-md-3">

                                                <label for="direct" class="form-label">Startimes Nova</label>

                                                <input type="text" class="form-control" id="500mb" placeholder="eg: 500"  name="cable1" value="<?php echo $startimesNova?>" required>

                                               

                                            </div>

                                        

        

                                            <div class="col-md-5">

                                                <label for="number" class="form-label">Startimes Basic</label>

                                                <input type="text" class="form-control" id="2gb" placeholder="eg: 500"  name="cable2" value="<?php echo $startimesBasic?>" required>

                                                

                                            </div>



                                            

                                            <div class="col-md-5">

                                                <label for="number" class="form-label">Startimes Smart</label>

                                                <input type="number" class="form-control" id="2gb" placeholder="eg: 500"  name="cable3" value="<?php echo $startimesSmart?>" required>

                                                

                                            </div>

                                            

                                            <div class="col-md-5">

                                                <label for="number" class="form-label">Startimes Classic</label>

                                                <input type="text" class="form-control" id="5gb" placeholder="eg: 500"  name="cable4" value="<?php echo $startimesClassic?>" required>

                                                

                                            </div>

                                            <div class="col-md-5">

                                                <label for="number" class="form-label">Startimes Super</label>

                                                <input type="text" class="form-control" id="10gb" placeholder="eg: 500"  name="cable5" value="<?php echo $startimesSuper?>" required>

                                                

                                            </div>

                                            <div></div>

                                        </div>

        

        

                                        <button class="w-100 btn btn-primary" type="submit" name="addStartimes" value="addStartimes">Save</button>

                                    </form>

                                </div>

                            </div><!--end col-->

                        </div><!--end row-->



                        <div class="row">

                            <div class="col-md-7 col-lg-8 mt-4">

                                <div class="card rounded shadow p-4 border-0">

                                    <h4 class="mb-3">Dstv Settings</h4>

                                    <form method="POST">

                                        <div class="row g-3">

                                            

        

                                            

                                            

                                            

                                            <div class="col-md-3">

                                                <label for="direct" class="form-label">DSTV Padi</label>

                                                <input type="text" class="form-control" id="500mb" placeholder="eg: 500" name="cable1" value="<?php echo $dstvPadi?>" required>

                                               

                                            </div>

                                        

        

                                            <div class="col-md-5">

                                                <label for="number" class="form-label">DSTV Yanga</label>

                                                <input type="text" class="form-control" id="2gb" placeholder="eg: 500" name="cable2" value="<?php echo $dstvYanga?>" required>

                                                

                                            </div>



                                                                    <div class="col-md-5">

                                                <label for="number" class="form-label">DSTV Confam</label>

                                                <input type="number" class="form-control" id="2gb" placeholder="eg: 500" name="cable3" value="<?php echo $dstvConfam?>" required>

                                                

                                            </div>

                                            

                                            <div class="col-md-5">

                                                <label for="number" class="form-label">DSTV Compact</label>

                                                <input type="text" class="form-control" id="10gb" placeholder="eg: 500" name="cable4" value="<?php echo $dstvCompact?>" required>

                                                

                                            </div>

                                            <div class="col-md-5">

                                                <label for="number" class="form-label">DSTV Compact Plus</label>

                                                <input type="text" class="form-control" id="10gb" placeholder="eg: 500" name="cable5" value="<?php echo $dstvCompactPlus?>" required>



                                            </div>


                                            <div class="col-md-5">

                                                <label for="number" class="form-label">DSTV Premium</label>

                                                <input type="text" class="form-control" id="5gb" placeholder="eg: 500" name="cable6" value="<?php echo $dstvPremium?>" required>

                                                

                                            </div>

                                            <div class="col-md-5">

                                                <label for="number" class="form-label">DSTV Padi + ExtraView</label>

                                                <input type="text" class="form-control" id="10gb" placeholder="eg: 500" name="cable7" value="<?php echo $dstvPadiExtraView?>" required>

                                                

                                            </div>

                                            <div></div>

                                        </div>

        

        

                                        <button class="w-100 btn btn-primary" type="submit" name="addDstv" value="addDstv">Save</button>

                                    </form>

                                </div>

                            </div><!--end col-->

                        </div><!--end row-->



                        

                    </div>

                </div><!--end container-->



<?php include"inc/footer.php" ?>

                