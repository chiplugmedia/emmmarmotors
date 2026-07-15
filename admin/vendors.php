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

                            <h5 class="mb-0">Vendors </h5>



                            <nav aria-label="breadcrumb" class="d-inline-block mt-2 mt-sm-0">

                                <ul class="breadcrumb bg-transparent rounded mb-0 p-0">

                                    <li class="breadcrumb-item text-capitalize"><a href="index.html"><?php echo $sitename?> </a></li>

                                    <li class="breadcrumb-item text-capitalize"><a href="#">Pages</a></li>

                                    <li class="breadcrumb-item text-capitalize active" aria-current="page"> Vendors </li>

                                </ul>

                            </nav>

                        </div>

                    

                        <div class="col-xl-8 mt-4">

                            <?php
                            if(isset($_GET['s']) && !empty($_GET['s'])){
                                $search=$_GET['s'];
                                $text="Showing results for vendor <strong>$search</strong>";
                            }
                            else{
                                $text="Vendors";
                            }
                            echo $userMsg
                            
                            ?>
                                <div class="d-flex justify-content-between p-4 bg-white shadow rounded-top">



                                <h6 class="fw-bold mb-0"><?php echo $text?></h6>







                                    <ul class="list-unstyled mb-0">



                                        <li class="dropdown dropdown-primary list-inline-item">



                                            <button type="button" class="btn btn-icon btn-pills btn-soft-primary dropdown-toggle p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti ti-dots-vertical"></i></button>



                                            <div class="dropdown-menu dd-menu dropdown-menu-end bg-white shadow border-0 mt-3 py-3">



                                                <a class="dropdown-item text-dark" href="#">Pro Users</a>



                                                <a class="dropdown-item text-dark" href="#"> Free Users</a>



                                            </div>



                                        </li>



                                    </ul>



                                </div>



                                <div class="table-responsive shadow rounded-bottom" data-simplebar >



                                    <table class="table table-center bg-white mb-0">



                                        <thead>



                                            <tr>



                                                <th class="border-bottom p-3">No.</th>



                                                <th class="border-bottom p-3" style="min-width: 220px;">Usernames</th>



                                                <th class="text-center border-bottom p-3">Referral Bal</th>
 
 <th class="text-center border-bottom p-3">Activity Bal</th>
 <th class="text-center border-bottom p-3">Account Type </th>



                                                <th class="text-center border-bottom p-3" style="min-width: 150px;">Registered Date</th>



                                                <th class="text-center border-bottom p-3">Subscription </th>



                                                <th class="text-end border-bottom p-3" style="min-width: 100px;">Preview</th>
<th class="text-end border-bottom p-3" style="min-width: 100px;">Vendor </th>
<th class="text-end border-bottom p-3" style="min-width: 100px;">Coupon</th>
<th class="text-end border-bottom p-3" style="min-width: 100px;">Delete</th>
<th class="text-end border-bottom p-3" style="min-width: 100px;">Activate</th>



                                            </tr>



                                        </thead>



                                        <tbody>



                                            <!-- Start -->

                                            <?php 
                                                if(isset($_GET['s']) && !empty($_GET['s'])){
                                                    $search=filter_string($_GET['s']);
                                                    $sql=$link->prepare("SELECT * FROM users WHERE username=? AND role='vendor' ORDER BY id DESC");
                                                    $sql->bind_param("s", $search);
                                                }
                                                else{
                                                    $sql=$link->prepare("SELECT * FROM users WHERE role ='vendor' ORDER BY id DESC");
                                                }
                                                $sql->execute();
                                                $result=$sql->get_result();
                                                
                                                $numrow=$result->num_rows;
                                                if($numrow > 0){
                                                    $idCount=$numrow + 1;
                                                    while($row=$result->fetch_assoc()){
                                                        $idCount--;
                                                        $username=$row['username'];
                                                        $date=$row['date'];
                                                        $status=$row['status'];
                                                        $funds=$row['funds'];
                                                        $referralFunds=$row['referralfunds'];
                                                        $role=$row['role'];


                                                        if($status == "expired" || $status == "suspended"){
                                                            $statusColor="danger";
                                                        }
                                                        else{
                                                            $statusColor="success";

                                                        }

                                                ?>


                                            <tr>



                                                <th class="p-3"><?php echo $idCount?></th>



                                                <td class="p-3">



                                                    <a href="#" class="text-primary">



                                                        <div class="d-flex align-items-center">



                                                            
                                                            <span class="ms-2"><?php echo $username?></span>



                                                        </div>



                                                    </a>



                                                </td>



                                                <td class="text-center p-3">₦<?php echo number_format($funds, 2)?></td>

<td class="text-center p-3">₦<?php echo number_format($referralFunds, 2)?></td>

<td class="text-center p-3">Pro <?php echo ucwords($role)?></td>



                                                <td class="text-center p-3"><?php echo $date?></td>



                                                <td class="text-center p-3">



                                                    <div class="badge bg-soft-<?php echo $statusColor?> rounded px-3 py-1">



                                                        <?php echo ucwords($status)?>



                                                    </div>



                                                </td>



                                                <td class="text-end p-3">



                                                    <a href="edit-user.php?username=<?php echo $username?>" class="btn btn-sm btn-primary">Preview</a>



                                                </td>
<td class="text-end p-3">



                                                    <button class="btn btn-sm btn-warning removeVendor">Remove Vendor</button>



                                                </td>

                                                <td class="text-end p-3">



                                                    <button class="btn btn-sm btn-primary sendCoupon">Send Coupon</button>



                                                </td>
<td class="text-end p-3">



                                                    <button class="btn btn-sm btn-danger suspend">Suspend</button>



                                                </td>

                                                </td>
<td class="text-end p-3">



                                                    <button class="btn btn-sm btn-success activate">Activate</button>



                                                </td>
                                                <input type="hidden" class="username" value="<?php echo $username?>">



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
                    $(".removeVendor").on("click", function(){
                        let username= $(this).closest("tr").find(".username").val();
                        let actionType="removeVendor";
                        action(username, actionType);
                        
                    })
                    $(".suspend").on("click", function(){
                        let username= $(this).closest("tr").find(".username").val();
                        let actionType="suspend";
                        action(username, actionType);
                        
                    })
                    $(".activate").on("click", function(){
                        let username= $(this).closest("tr").find(".username").val();
                        let actionType="activate";
                        action(username, actionType);
                        
                    })
                    $(".sendCoupon").on("click", function(){
                        let username= $(this).closest("tr").find(".username").val();
                        let actionType="sendCoupon";
                        action(username, actionType);
                        
                    })
                    function action(username, action){
                        let form=document.createElement('form');
                        let inputID=document.createElement('input');
                        let inputAction=document.createElement('input');
                        let body=document.querySelector('body');
                        form.method="POST";

                        inputID.type="hidden";
                        inputID.value=username;
                        inputID.name="username";

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

                