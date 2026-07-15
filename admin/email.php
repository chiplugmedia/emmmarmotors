<?php 
require $_SERVER['DOCUMENT_ROOT']."/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/includes/generalinclude.php";

require $_SERVER['DOCUMENT_ROOT']."$stream/admin/actions/email.php";

include"inc/header.php" ;

?>


                <div class="container-fluid">

                    <div class="layout-specing">

                        <div class="d-md-flex justify-content-between align-items-center">

                            <h5 class="mb-0">Send Email to users</h5>



                            <nav aria-label="breadcrumb" class="d-inline-block mt-2 mt-sm-0">

                                <ul class="breadcrumb bg-transparent rounded mb-0 p-0">

                                    

                                    <li class="breadcrumb-item text-capitalize"><a href="profile">Activity </a></li>

                                    <li class="breadcrumb-item text-capitalize active" aria-current="page">Email</li>

                                </ul>

                            </nav>

                        </div>
                       
                       <div class="row">

                            <div class="col-lg-4 mt-4">
                            <?php echo $genMsg?>

                                <div class="card border-0 rounded shadow">

                                    <div class="card-body">

                                        <h5 class="text-md-start text-center mb-0">Task Details :</h5>

                               <form method="POST" enctype="multipart/form-data">

                                            <div class="row mt-4">

                                                <div class="col-md-6">

                                                    <div class="mb-3">

                                                        <label class="form-label">Email Title</label>

                                                        <div class="form-icon position-relative">

                                                            <i data-feather="user" class="fea icon-sm icons"></i>

                                                            <input name="title" id="title" type="text" class="form-control ps-5" placeholder="Email Title:" value="<?php echo $title?>">

                                                        </div>

                                                    </div>

                                                </div><!--end col-->

                                                
                                                <div class="col-md-6">

                                                    <div class="mb-3">

                                                        <label class="form-label">Email Body </label>

                                                        <div class="form-icon position-relative">

                                                            <i data-feather="mail" class="fea icon-sm icons"></i>

                                                            <textarea name="desc" id="desc" type="textarea" class="form-control ps-5" placeholder="Task Description :"><?php echo $desc?></textarea>

                                                        </div>

                                                    </div> 

                                                </div><!--end col-->
                                                
                                                                   

                                            </div><!--end row-->

                                            <div class="row">

                                                <div class="col-sm-12">

                                                    <input type="submit" id="submit" name="sendEmail" class="btn btn-primary" value="Send Mail">

                                                </div><!--end col-->

                                            </div><!--end row-->

                                        </form><!--end form-->

                                    </div>
</div>
                                </div>

</div><!--end row-->

<!-- Table Start -->

                           


                    </div>

                </div><!--end container-->
              

 <?php include"inc/footer.php" ?>