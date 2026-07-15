<?php 
require $_SERVER['DOCUMENT_ROOT']."/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/actions/products.php";

include"inc/header.php" 

?>



                <div class="container-fluid">

                    <div class="layout-specing">
                        <?php echo $genMsg ?>
                        <div class="d-md-flex justify-content-between align-items-center">

                            <h5 class="mb-0">Add Products</h5>



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

                                        <h5 class="text-md-start text-center mb-0">Add products:</h5>

        

                                        

                                        <form method="POST" enctype="multipart/form-data">

                                            <div class="row mt-4">

                                                <div class="col-md-6">

                                                    <div class="mb-3">

                                                        <label class="form-label">Product Title</label>

                                                        <div class="form-icon position-relative">

                                                            <i data-feather="user" class="fea icon-sm icons"></i>

                                                            <input name="title" id="title" type="text" class="form-control ps-5" placeholder="Product Title :"  value="<?php echo $title ?>">

                                                        </div>

                                                    </div>

                                                </div><!--end col-->
                                                <div class="col-md-6">

                                                    <div class="mb-3">

                                                        <label class="form-label">Product price</label>

                                                        <div class="form-icon position-relative">

                                                            <i data-feather="user" class="fea icon-sm icons"></i>

                                                            <input name="price" id="title" type="text" class="form-control ps-5" placeholder="Product price:"  value="<?php echo $price ?>">

                                                        </div>

                                                    </div>

                                                </div><!--end col-->
                                                <div class="col-md-6">

                                                    <div class="mb-3">

                                                        <label class="form-label">Product seller name</label>

                                                        <div class="form-icon position-relative">

                                                            <i data-feather="user" class="fea icon-sm icons"></i>

                                                            <input name="sellerName" id="title" type="text" class="form-control ps-5" placeholder="Product seller name :"  value="<?php echo $sellerName ?>">

                                                        </div>

                                                    </div>

                                                </div><!--end col-->
                                                <div class="col-md-6">

                                                    <div class="mb-3">

                                                        <label class="form-label">Product location</label>

                                                        <div class="form-icon position-relative">

                                                            <i data-feather="user" class="fea icon-sm icons"></i>

                                                            <input name="location" id="title" type="text" class="form-control ps-5" placeholder="Product location :"  value="<?php echo $location ?>">

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

                                                        <div class="form-icon position-relative">

                                                            <i data-feather="image" class="fea icon-sm icons"></i>

                                                            <input name="img1" id="img" type="file" class="form-control ps-5" placeholder="Image :" accept="image/*" required>

                                                        </div>

                                                    </div> 
                                                    
                                                    <div class="mb-3">

                                                        <label class="form-label">Product Image 1 (optional)</label>

                                                        <div class="form-icon position-relative">

                                                            <i data-feather="image" class="fea icon-sm icons"></i>

                                                            <input name="img2" id="img" type="file" class="form-control ps-5" placeholder="Image :" accept="image/*">

                                                        </div>

                                                    </div> 
                                                    <div class="mb-3">

                                                        <label class="form-label">Product  Image 2 (optional) </label>

                                                        <div class="form-icon position-relative">

                                                            <i data-feather="image" class="fea icon-sm icons"></i>

                                                            <input name="img3" id="img" type="file" class="form-control ps-5" placeholder="Image :" accept="image/*">

                                                        </div>

                                                    </div> 
                                                    <div class="mb-3">

                                                        <label class="form-label">Productt  Image 3 (optional) </label>

                                                        <div class="form-icon position-relative">

                                                            <i data-feather="image" class="fea icon-sm icons"></i>

                                                            <input name="img4" id="img" type="file" class="form-control ps-5" placeholder="Image :" accept="image/*">

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
    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="showInHomePage">
    <label class="form-check-label" for="flexSwitchCheckChecked">Show in homepage</label>
</div>

<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"  name="showInDashboard">
    <label class="form-check-label" for="flexSwitchCheckChecked">show in dashboards</label>
</div>

                                                      

                                            </div><!--end row-->

                                            <div class="row">

                                                <div class="col-sm-12">

                                                    <input type="submit" id="submit" name="addProduct" class="btn btn-primary" value="Upload Product">

                                                </div><!--end col-->

                                            </div><!--end row-->

                                        </form><!--end form-->

                                    </div>
</div>
                                </div>

</div><!--end row-->


                            <!-- Table Start -->

                            <div class="col mt-4 pt-2" id="tables">

                                <div class="component-wrapper rounded shadow">

                                    <div class="p-4 border-bottom">

                                        <h4 class="title mb-0"> Recent </h4>

                                    </div>



                                    <div class="p-4">

                                        <div class="table-responsive bg-white shadow rounded" data-simplebar style="height: 545px;">

                                            <table class="table mb-0 table-center">

                                                <thead>

                                                    <tr>

                                                    <th scope="col" class="border-bottom">#</th>

                                                    <th scope="col" class="border-bottom">Title</th>
                                                    <th scope="col" class="border-bottom">Seller</th>
                                                    <th scope="col" class="border-bottom">Price</th>
                                                    <th scope="col" class="border-bottom">Status</th>
                                                    <th scope="col" class="border-bottom">Date</th>

                                                    <th scope="col" class="border-bottom">Action</th>
                                                     <th scope="col" class="border-bottom">Action</th>

                                                    </tr>

                                                </thead>

                                                <tbody>

                                                   <?php
                                                   $sql=$link->prepare("SELECT * FROM products");
                                                   $sql->execute();
                                                   $result=$sql->get_result();
                                                   $numrow=$result->num_rows;
                                                   if($numrow > 0){
                                                       $idCount=0;
                                                       while($row=$result->fetch_assoc()){
                                                           $idCount++;
                                                           $reference=$row['reference'];
                                                           $image1=$row['image1'];
                                                           $title=$row['title'];
                                                           $sellerName=$row['sellername'];
                                                           $price=$row['price'];
                                                           $date=$row['date'];
                                                           $status=$row['status'];
                                                   ?>
                                                   <tr>
                                                    <th class="p-3">#<?php echo $idCount ?></th>
                                                    <td class="p-3">
                                                        <a href="#" class="text-primary">
                                                            <div class="d-flex align-items-center">
                                                                <img src="/admin/assets/images/products/<?php echo $image1 ?>" class="avatar avatar-ex-small rounded-circle shadow" alt="No image found">
                                                                <span class="ms-2"><?php echo $title ?></span>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td class="text-center p-3"><?php echo $sellerName ?></td>
                                                    <td class="text-center p-3">₦<?php echo number_format($price, 2) ?></td>
                                                    <td class="text-center p-3"><?php echo $date ?></td>
                                                    <td class="text-end p-3">
                                                        <button class="btn btn-sm btn-warning"> <?php echo $status ?></button>
                                                    </td>
                                                    <td class="text-end p-3">
                                                        <button class="btn btn-sm btn-danger deleteProduct">Delete</button>
                                                    </td>
                                                    <td class="text-end p-3">
                                                        <a href="edit-product.php?reference=<?php echo $reference?>" class="btn btn-sm btn-success">Edit</a>
                                                    </td>
                                                    <input type="hidden" class="reference" value="<?php echo $reference ?>">
                                                </tr>
                                                <?php }} ?>

                                                </tbody>

                                            </table>

                                        </div>

                                    </div>

                                </div>

                            </div><!--end col-->

                            <!-- Table End -->

                    </div>

                </div><!--end container-->

                 <script>
                    $(".deleteProduct").on("click", function(){
                        let reference= $(this).closest("tr").find(".reference").val();
                        let actionType="deleteProduct";
                        Swal.fire({
                            title : "Are you sure you want to delete",
                            html : "",
                            icon : "warning",
                            showDenyButton: true,
                            confirmButtonText: 'Yes, delete',
                            denyButtonText: 'God forbid',
                        })
                        .then((result) => {
                          if(result.isConfirmed){                        
                              action(reference, actionType);
                          }
                        })
                    })
                        
                    function action(reference, action){
                        let form=document.createElement('form');
                        let inputID=document.createElement('input');
                        let inputAction=document.createElement('input');
                        let body=document.querySelector('body');
                        form.method="POST";

                        inputID.type="hidden";
                        inputID.value=reference;
                        inputID.name="reference";

                        inputAction.type="hidden";
                        inputAction.value=action;
                        inputAction.name=action;

                        form.appendChild(inputAction);
                        form.appendChild(inputID);
                        body.appendChild(form);
                        form.submit();
                    }


                </script>

                <?php include"inc/footer.php" ?>