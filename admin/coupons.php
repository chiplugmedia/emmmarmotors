<?php 
require $_SERVER['DOCUMENT_ROOT']."/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/actions/users.php";

include"inc/header.php" ;

?>


                <div class="container-fluid">

                    <div class="layout-specing">

                        <div class="d-md-flex justify-content-between align-items-center">

                            <h5 class="mb-0">Coupons</h5>



                            <nav aria-label="breadcrumb" class="d-inline-block mt-2 mt-sm-0">

                                <ul class="breadcrumb bg-transparent rounded mb-0 p-0">

                                    <li class="breadcrumb-item text-capitalize"><a href="dashboard.php"><?php echo $sitename?> </a></li>

                                   

                                    <li class="breadcrumb-item text-capitalize active" aria-current="page"> Create/View Coupons </li>

                                </ul>

                            </nav>

                        </div>

                    

                        <div class="row">

 <?php echo $genMsg?>
<!--<div class="col-md-7 col-lg-8 mt-4">-->
                           


<!--                                <div class="card rounded shadow p-4 border-0">-->

<!--                                    <h4 class="mb-3">Delete users registered by a vendor code</h4>-->

<!--                                    <div class="row g-3">-->
<!--                                    <form method="POST">-->
<!--                                        <div class="col-12 mb-2">-->
<!--                                            <label for="coup" class="form-label">Vendor username</label>-->
<!--                                                <input type="text" class="form-control" name="vendor" placeholder="Edimax" required>-->
<!--                                            </div>-->
<!--                                        <div>-->
                                            
<!--                                    </div>-->
<!--                                </div>-->
<!--                                        <button class="w-100 btn btn-primary" name="deleteVendorCoupons" type="submit">Delete</button>-->
<!--                                     </div>-->
<!--                                     </form>-->
<!--                            </div><!--end col--> 
                           
                            
                            
                            <div class="col-md-7 col-lg-8 mt-4">
    <div class="card rounded shadow p-4 border-0">
        <h4 class="mb-3">Generate Coupons</h4>
        <div class="row g-3">
            <form method="POST">
                    <input type="hidden" class="form-control prefix" name="vendor" value="selfVendor" placeholder="" required>
                   
                <div class="col-12 mb-2">
                    <label for="coup" class="form-label">How Many Coupon</label>
                    <input type="number" class="form-control couponNum" name="couponNum" placeholder="" required>
                </div>
                <div class="col-12 mb-2">
                    <label for="coup" class="form-label">Prefix</label>
                    <input type="text" class="form-control prefix" name="prefix" placeholder="" required>
                </div>
                <div class="col-12 mb-2">
                    <label for="type" class="form-label">Amount Crediting</label>
                    <input type="text" class="form-control type" name="type" placeholder="" required>
                </div>
                <div>
                </div>
                <button class="w-100 btn btn-primary" name="generateCoupon" type="submit">Generate</button>
            </form>
        </div><!-- end row -->
    </div>
</div><!-- end col -->




                                                    <div class="col-xl-8 mt-4">
                                <div class="d-flex justify-content-between p-4 bg-white shadow rounded-top">


                                    <?php
                                    if(isset($_GET['s']) && !empty($_GET['s'])){
                                        $search=$_GET['s'];
                                        $text="Showing searched results for <strong>$search</strong>";
                                    }
                                    else{
                                        $text="Generated Coupons";
                                    }
                                    ?>
                                    <h6 class="fw-bold mb-0"><?php echo $text?></h6>
                                    <ul class="list-unstyled mb-0">
                                        <li class="dropdown dropdown-primary list-inline-item">
                                            <button type="button" class="btn btn-icon btn-pills btn-soft-primary dropdown-toggle p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti ti-dots-vertical"></i></button>
                                            <div class="dropdown-menu dd-menu dropdown-menu-end bg-white shadow border-0 mt-3 py-3">
                                                <a class="dropdown-item text-dark" href="#"> Used</a>
                                                <a class="dropdown-item text-dark" href="#"> Unused</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="table-responsive shadow rounded-bottom" data-simplebar >
                                    <table class="table table-center bg-white mb-0" id="myTable">
                                        <thead>
                                            <tr>
                                               <th>ID</th>
                                        <th>Generated Code</th>
                                        <th>Date</th>
                                        <th>Vendor</th>
                                        <th>Used By</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Start -->
                                           <?php
                                    $sql=$link->prepare("SELECT * FROM coupons ORDER BY id DESC");
                                    $sql->execute();
                                    $result=$sql->get_result();
                                    $numrow=$result->num_rows;
                                    if($numrow > 0){
                                        while($row=$result->fetch_assoc()){
                                            $vendor=$row['vendor'];
                                            $id=$row['id'];
                                            $coupon=$row['coupon'];
                                            $status=$row['status'];
                                            $date=$row['date'];
                                            
                                            

                                            $statusColor="";
                                            if($status == "active"){
                                                $statusColor="success";
                                            }
                                            else if($status == "pending"){
                                                $statusColor="warning";
                                            }
                                            else{
                                                $statusColor="danger";
                                            }

                                            $sql_ref=$link->prepare("SELECT * FROM users WHERE coupon=?");
                                            $sql_ref->bind_param("s", $coupon);
                                            $sql_ref->execute();
                                            $result_ref=$sql_ref->get_result();
                                            $row_ref=$result_ref->fetch_assoc();
                                            $numrow_ref=$result_ref->num_rows;
                                            $usedBy="--";
                                            if($numrow_ref == 1){
                                                $usedBy=$row_ref['username'];
                                            } 

                                    ?>
                                            <tr>
                                               <td>#<?php echo $id ?></td>
                                        <td><?php echo $coupon ?></td>
                                        <td><?php echo $date ?></td>
                                        <td><?php echo $vendor ?></td>
                                        <td><?php echo $usedBy ?></td>
                                        <td class="text-<?php echo $statusColor?>"><?php echo $status?></td>
                                        <td ><form method="POST">
                                            <input type="hidden" name="id" value="<?php echo $id?>">
                                            <input type="hidden" name="username" value="<?php echo $usedBy ?>">
                                            <input type="hidden" name="coupon" value="<?php echo $coupon?>">
                                            <button class="btn btn-danger btn-sm" name="deleteCoupon">Delete</button>
                                            </form>
                                        </td>
                                        
                                    </tr>
                                    <?php }} ?>
                                            <!-- End -->
                                        </tbody>
                                    </table>
                                </div>
                            </div><!--end col-->
                    </div>
                </div><!--end container-->
                 <script>
                    $(".deleteCoupon").on("click", function(){
                        let id= $(this).closest("tr").find(".id").val();
                        let actionType="deleteCoupon";
                        action(id, actionType);
                        
                    })
                
                    function action(id, action, extraName="", extraVal=""){
                        let form=document.createElement('form');
                        let inputID=document.createElement('input');
                        let inputAction=document.createElement('input');
                        let inputExtra=document.createElement('input');
                        let body=document.querySelector('body');
                        form.method="POST";

                        inputID.type="hidden";
                        inputID.value=id;
                        inputID.name="id";

                        inputAction.type="hidden";
                        inputAction.value=action;
                        inputAction.name=action;

                        inputExtra.type="hidden";
                        inputExtra.value=extraVal;
                        inputExtra.name=extraName;

                        form.appendChild(inputExtra);
                        form.appendChild(inputAction);
                        form.appendChild(inputID);
                        body.appendChild(form);
                        form.submit();
                    }
                </script>
<?php include"inc/footer.php" ?>