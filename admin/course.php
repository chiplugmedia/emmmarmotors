<?php
require $_SERVER['DOCUMENT_ROOT']."/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/actions/upcourse.php";

?>

<?php include"inc/header.php" ?>

                 <div class="container-fluid">

                    <div class="layout-specing">

                        <div class="d-md-flex justify-content-between align-items-center">

                            <h5 class="mb-0">Upload Course</h5>



                            <nav aria-label="breadcrumb" class="d-inline-block mt-2 mt-sm-0">

                                <ul class="breadcrumb bg-transparent rounded mb-0 p-0">

                                    

                                    <li class="breadcrumb-item text-capitalize"><a href="profile">Activity </a></li>

                                    <li class="breadcrumb-item text-capitalize active" aria-current="page">Course</li>

                                </ul>

                            </nav>

                        </div>
                       
                       <div class="row">
    <div class="col-lg-12 mt-4">
        <?php echo $genMsg ?>
        <div class="card border-0 rounded shadow">
            <div class="card-body">
                <h5 class="text-md-start text-center mb-0">Course Details :</h5>
                <form method="POST" enctype="multipart/form-data">
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Course Title</label>
                                <div class="form-icon position-relative">
                                    <i data-feather="user" class="fea icon-sm icons"></i>
                                    <input name="title" id="title" type="text" class="form-control ps-5" placeholder="Course Title:" value="<?php echo $title ?>">
                                </div>
                            </div>
                        </div><!-- end col -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Course Description</label>
                                <div class="form-icon position-relative">
                                    <i data-feather="mail" class="fea icon-sm icons"></i>
                                    <textarea name="desc" id="desc" type="textarea" class="form-control ps-5" placeholder="Course Description:"><?php echo $desc ?></textarea>
                                </div>
                            </div>
                        </div><!-- end col -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Course Link</label>
                                <div class="form-icon position-relative">
                                    <i data-feather="link" class="fea icon-sm icons"></i>
                                    <input name="url" id="last" type="text" class="form-control ps-5" placeholder="Course Link:" value="<?php echo $url ?>">
                                </div>
                            </div>
                        </div><!-- end col -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Course Image</label>
                                <div class="form-icon position-relative">
                                    <i data-feather="image" class="fea icon-sm icons"></i>
                                    <input id="image" type="file" class="form-control ps-5" placeholder="Image :" accept="image/*" name="image">
                                </div>
                                <?php echo $imageErr ?>
                            </div>
                        </div><!-- end col -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Course Price</label>
                                <div class="form-icon position-relative">
                                    <i data-feather="link" class="fea icon-sm icons"></i>
                                    <input name="amount" id="amount" type="number" class="form-control ps-5" placeholder="Course Price:" value="<?php echo $amount ?>">
                                </div>
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->
                    <div class="row">
                        <div class="col-sm-12">
                            <input type="submit" id="submit" name="uploadcourse" class="btn btn-primary" value="Upload Course">
                        </div><!-- end col -->
                    </div><!-- end row -->
                </form><!-- end form -->
            </div>
        </div>
    </div>
</div><!-- end row -->

<!-- Table Start -->

                            <!-- ... (previous HTML code) -->

<div class="col mt-4 pt-2" id="tables">
    <div class="component-wrapper rounded shadow">
        <div class="p-4 border-bottom">
            <h4 class="title mb-0"> Recent </h4>
        </div>

        <div class="p-4">
            <div class="table-responsive bg-white shadow rounded">
                <table class="table mb-0 table-center">
                    <thead>
                        <tr>
                            <th scope="col" class="border-bottom">#</th>
                            <th scope="col" class="border-bottom">Title</th>
                            <th scope="col" class="border-bottom">Amount</th>
                            <th scope="col" class="border-bottom">Link</th>
                            <th scope="col" class="border-bottom">Status</th>
                            <th scope="col" class="border-bottom">Date</th>
                            <th scope="col" class="border-bottom">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                        $sql=$link->prepare("SELECT * FROM subscription_products ORDER BY id DESC");
                        $sql->execute();
                        $result=$sql->get_result();
                        
                        $numrow=$result->num_rows;
                        if($numrow > 0){
                            $idCount=0;
                            while($row=$result->fetch_assoc()){
                                $idCount++;
                                $title=$row['title'];
                                $date=$row['date'];
                                $url=$row['url'];
                                $desc=$row['description'];
                                $status=$row['status'];
                                $amount=$row['amount'];
                                $id=$row['id'];
                                $reference=$row['reference'];
                                $img=$row['image'];
                                
                                $statusColor="";
                                if($status == "active"){
                                    $statusColor="success";
                                }
                                else if($status == "completed"){
                                    $statusColor="danger";
                                }
                        ?>
                        <tr>
                            <th scope="row"><?php echo $idCount?></th>
                            <td class="p-3">
                                                        <a href="#" class="text-primary">
                                                            <div class="d-flex align-items-center">
                                                                <img src="/dash/img/course/<?php echo $img ?>" class="avatar avatar-ex-small rounded-circle shadow" alt="No image found">
                                                                <span class="ms-2"></span>
                                                                </div>
                                                        </a>
                            <td><?php echo ucwords($title)?></td>
                            <td>NGN<?php echo $amount?></td>
                            <td><?php echo $url?></td>
                            <td>
                                <div class="badge bg-soft-<?php echo $statusColor?> rounded px-3 py-1">
                                    <?php echo $status?>
                                </div>
                            </td>
                            <td><?php echo $date?></td>
                            <td>
                                <button class="btn btn-sm btn-danger deletePost">Delete</button>
                                <input type="hidden" value="<?php echo $id?>" class="id">
                                <input type="hidden" value="<?php echo $reference?>" class="reference">
                            </td>
                        </tr>
                        <?php }} ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div><!--end col-->

<!-- ... (previous HTML code) -->

<script>
                    $(".deletePost").on("click", function(){
                        let id= $(this).closest("tr").find(".id").val();
                        postAction(id, "deletePost");
                         
                    })
                    $(".completePost").on("click", function(){
                        let id= $(this).closest("tr").find(".reference").val();
                        postAction(id, "completePost");
                        
                    })
                    function postAction(id, action){
                        let form=document.createElement('form');
                        let input=document.createElement('input');
                        let inputID=document.createElement('input');
                        let body=document.querySelector('body');
                        form.method="POST";
                        input.type="hidden";
                        input.value=action;
                        input.name=action;

                        inputID.type="hidden";
                        inputID.value=id;
                        inputID.name="id";

                        form.appendChild(inputID);
                        form.appendChild(input);
                        body.appendChild(form);
                        form.submit();
                    }


                </script>

                    
                        
                        <?php include"inc/footer.php" ?>
