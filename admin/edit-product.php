<?php 
require $_SERVER['DOCUMENT_ROOT']."/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/includes/generalinclude.php";

if(!isset($_GET['reference']) || empty($_GET['reference'])){
    header("location:$stream/admin/add-product.php");
    exit;
}

$reference=filter_string($_GET['reference']);
$sql=$link->prepare("SELECT * FROM products WHERE reference=?");
$sql->bind_param("s", $reference);
$sql->execute();
$result=$sql->get_result();
$numrow=$result->num_rows;
$row=$result->fetch_assoc();
if($numrow == 1){
    $title=$row['title'];
    $price=$row['price'];
    $sellerName=$row['sellername'];
    $location=$row['location'];
    $contact=$row['contact'];
    $desc=$row['description'];
    $image1=$row['image1'];
    $image2=$row['image2'];
    $image3=$row['image3'];
    $image4=$row['image4'];
    $showDash=($row['showdash'] == 1) ? "checked" : "";
    $showHome=($row['showhome'] == 1) ? "checked" : "";
}
else{
    header("location:$stream/admin/add-product.php");
    exit;
}

require $_SERVER['DOCUMENT_ROOT']."$stream/admin/actions/products.php";


include"inc/header.php" 

?>


                <div class="container-fluid">

                    <div class="layout-specing">
                        <?php echo $genMsg ?>

                        <div class="d-md-flex justify-content-between align-items-center">

                            <h5 class="mb-0">Edit Products</h5>



                            <nav aria-label="breadcrumb" class="d-inline-block mt-2 mt-sm-0">

                                <ul class="breadcrumb bg-transparent rounded mb-0 p-0">

                                    

                                    <li class="breadcrumb-item text-capitalize"><a href="profile">Activity </a></li>

                                    <li class="breadcrumb-item text-capitalize active" aria-current="page">Products</li>

                                </ul>

                            </nav>

                        </div>
                       
                       <div class="row">

                            <div class="col-lg-4 mt-4">

                                <div class="card border-0 rounded shadow">

                                    <div class="card-body">

                                        <h5 class="text-md-start text-center mb-0">Edit product:</h5>

        

                                        

                                        <form method="POST" enctype="multipart/form-data">

                                            <div class="row mt-4">

                                                <div class="col-md-6">

                                                    <div class="mb-3">

                                                        <label class="form-label">Product Title</label>

                                                        <div class="form-icon position-relative">

                                                            <i data-feather="user" class="fea icon-sm icons"></i>

                                                            <input name="title" id="title" type="text" class="form-control ps-5" placeholder="Product Title :" value="<?php echo $title ?>">

                                                        </div>

                                                    </div>

                                                </div><!--end col-->
                                                <div class="col-md-6">

                                                    <div class="mb-3">

                                                        <label class="form-label">Product price</label>

                                                        <div class="form-icon position-relative">

                                                            <i data-feather="user" class="fea icon-sm icons"></i>

                                                            <input name="price" id="title" type="text" class="form-control ps-5" placeholder="Product price:" value="<?php echo $price ?>">

                                                        </div>

                                                    </div>

                                                </div><!--end col-->
                                                <div class="col-md-6">

                                                    <div class="mb-3">

                                                        <label class="form-label">Product seller name</label>

                                                        <div class="form-icon position-relative">

                                                            <i data-feather="user" class="fea icon-sm icons"></i>

                                                            <input name="sellerName" id="title" type="text" class="form-control ps-5" placeholder="Product seller name :" value="<?php echo $sellerName ?>">

                                                        </div>

                                                    </div>

                                                </div><!--end col-->
                                                <div class="col-md-6">

                                                    <div class="mb-3">

                                                        <label class="form-label">Product location</label>

                                                        <div class="form-icon position-relative">

                                                            <i data-feather="user" class="fea icon-sm icons"></i>

                                                            <input name="location" id="title" type="text" class="form-control ps-5" placeholder="Product location :" value="<?php echo $location ?>">

                                                        </div>

                                                    </div>

                                                </div><!--end col-->
                                                <div class="col-md-6">

                                                    <div class="mb-3">

                                                        <label class="form-label">Product Contact/whatsapp link</label>

                                                        <div class="form-icon position-relative">

                                                            <i data-feather="user" class="fea icon-sm icons"></i>

                                                            <input name="contact" id="title" type="text" class="form-control ps-5" placeholder="Product Contact/whatsapp link:"  value="<?php echo $contact ?>">

                                                        </div>

                                                    </div>

                                                </div><!--end col-->

                                                
<div class="col-md-6">

                                                    <div class="mb-3">

                                                        <label class="form-label">Product Featured Image (Required)</label>
                                                        <?php if($image1 != ""){ ?>
                                                            <div class="">
                                                                <img src="../assets/images/products/<?php echo $image1 ?>" class="avatar avatar-ex-large shadow" alt="No image found">
                                                            </div>
                                                            <br>
                                                        <?php } ?>
                                                        
                                                        <div class="form-icon position-relative">

                                                            <i data-feather="image" class="fea icon-sm icons"></i>

                                                            <input name="img1" id="img" type="file" class="form-control ps-5" placeholder="Image :" accept="image/*">
                                                            <input type="hidden" name="oldImage1" value="<?php echo $image1 ?>">

                                                        </div>

                                                    </div> 
                                                    
                                                    <div class="mb-3">

                                                        <label class="form-label">Product Image 1 (optional)</label>
                                                        <?php if($image2 != ""){ ?>
                                                            <div class="">
                                                                <img src="../assets/images/products/<?php echo $image2 ?>" class="avatar avatar-ex-large shadow" alt="No image found">
                                                            </div>
                                                            <br>
                                                        <?php } ?>
                                                        
                                                        <div class="form-icon position-relative">

                                                            <i data-feather="image" class="fea icon-sm icons"></i>

                                                            <input name="img2" id="img" type="file" class="form-control ps-5" placeholder="Image :" accept="image/*">
                                                            <input type="hidden" name="oldImage2" value="<?php echo $image2 ?>">

                                                        </div>

                                                    </div> 
                                                    <div class="mb-3">

                                                        <label class="form-label">Product  Image 2 (optional) </label>
                                                        <?php if($image3 != ""){ ?>
                                                            <div class="">
                                                                <img src="../assets/images/products/<?php echo $image3 ?>" class="avatar avatar-ex-large shadow" alt="No image found">
                                                            </div>
                                                            <br>
                                                        <?php } ?>
                                                        
                                                        <div class="form-icon position-relative">

                                                            <i data-feather="image" class="fea icon-sm icons"></i>

                                                            <input name="img3" id="img" type="file" class="form-control ps-5" placeholder="Image :" accept="image/*">
                                                            <input type="hidden" name="oldImage3" value="<?php echo $image3 ?>">

                                                        </div>

                                                    </div> 
                                                    <div class="mb-3">

                                                        <label class="form-label">Productt  Image 3 (optional) </label>
                                                        <?php if($image4 != ""){ ?>
                                                            <div class="">
                                                                <img src="../assets/images/products/<?php echo $image4 ?>" class="avatar avatar-ex-large shadow" alt="No image found">
                                                            </div>
                                                            <br>
                                                        <?php } ?>
                                                        
                                                        <div class="form-icon position-relative">

                                                            <i data-feather="image" class="fea icon-sm icons"></i>

                                                            <input name="img4" id="img" type="file" class="form-control ps-5" placeholder="Image :" accept="image/*">
                                                            <input type="hidden" name="oldImage4" value="<?php echo $image4 ?>">

                                                        </div>

                                                    </div> 

                                                </div><!--end col-->

                                                <div class="col-md-6">

                                                    <div class="mb-3">

                                                        <label class="form-label">Description </label>

                                                        <div class="form-icon position-relative">

                                                            <i data-feather="mail" class="fea icon-sm icons"></i> 

                                                            <textarea name="desc" id="des" type="email" class="form-control ps-5" placeholder="Product Description :"><?php echo $desc ?></textarea>

                                                        </div>

                                                    </div> 

                                                </div><!--end col-->
                                                <div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" <?php echo $showHome?> name="showInHomePage">
    <label class="form-check-label" for="flexSwitchCheckChecked">Show in homepage</label>
</div>

<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" <?php echo $showDash?> name="showInDashboard">
    <label class="form-check-label" for="flexSwitchCheckChecked">show in dashboards</label>
</div>

                                                      

                                            </div><!--end row-->

                                            <div class="row">

                                                <div class="col-sm-12">

                                                    <input type="submit" id="submit" name="updateProduct" class="btn btn-primary" value="Update Product">
                                                    <input type="hidden" name="reference" value="<?php echo $reference ?>">


                                                </div><!--end col-->

                                            </div><!--end row-->

                                        </form><!--end form-->

                                    </div>
</div>
                                </div>

</div><!--end row-->




                    </div>

                </div><!--end container-->



                <?php include"inc/footer.php" ?>