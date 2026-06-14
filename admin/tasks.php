<?php 
require $_SERVER['DOCUMENT_ROOT']."/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/includes/generalinclude.php";
$amount="";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/actions/tasks.php";

include"inc/header.php" ;

?>

                <div class="container-fluid">

                    <div class="layout-specing">

                        <div class="d-md-flex justify-content-between align-items-center">

                            <h5 class="mb-0">Upload Task</h5>



                            <nav aria-label="breadcrumb" class="d-inline-block mt-2 mt-sm-0">

                                <ul class="breadcrumb bg-transparent rounded mb-0 p-0">

                                    

                                    <li class="breadcrumb-item text-capitalize"><a href="profile">Activity </a></li>

                                    <li class="breadcrumb-item text-capitalize active" aria-current="page">Task</li>

                                </ul>

                            </nav>

                        </div>
                       
                       <div class="row">

                            <div class="col-lg-12 mt-4">
                            <?php echo $genMsg?>

                                <div class="card border-0 rounded shadow">

                                    <div class="card-body">

                                        <h5 class="text-md-start text-center mb-0">Task Details :</h5>

                               <form method="POST" enctype="multipart/form-data">

                                            <div class="row mt-4">

                                                <div class="col-md-6">

                                                    <div class="mb-3">

                                                        <label class="form-label">Task Title</label>

                                                        <div class="form-icon position-relative">

                                                            <i data-feather="user" class="fea icon-sm icons"></i>

                                                            <input name="title" id="title" type="text" class="form-control ps-5" placeholder="Task Title:" value="<?php echo $title?>">

                                                        </div>

                                                    </div>

                                                </div><!--end col-->

                                                <div class="col-md-6">

                                                    <div class="mb-3">

                                                        <label class="form-label">Task Link </label>

                                                        <div class="form-icon position-relative">

                                                            <i data-feather="link" class="fea icon-sm icons"></i>

                                                            <input name="url" id="last" type="text" class="form-control ps-5" placeholder="Task Link :" value="<?php echo $url?>">

                                                        </div>

                                                    </div>

                                                </div><!--end col-->
                                                <div class="col-md-6">

                                                    <div class="mb-3">

                                                        <label class="form-label">Task Amount </label>

                                                        <div class="form-icon position-relative">

                                                            <i data-feather="link" class="fea icon-sm icons"></i>

                                                            <input name="amount" id="last" type="text" class="form-control ps-5" placeholder="Task Amount :"  value="<?php echo $amount?>">

                                                        </div>

                                                    </div>

                                                </div><!--end col-->
                                                <input name="type" id="type" type="hidden" class="form-control ps-5" placeholder="Task Amount :"  value="facebook" <?php echo $isSelectedFb?>>
                                                

                                                <div class="col-md-6">

                                                    <div class="mb-3">

                                                        <label class="form-label">Task Description </label>

                                                        <div class="form-icon position-relative">

                                                            <i data-feather="mail" class="fea icon-sm icons"></i>

                                                            <textarea name="desc" id="desc" type="textarea" class="form-control ps-5" placeholder="Task Description :"><?php echo $desc?></textarea>

                                                        </div>

                                                    </div> 

                                                </div><!--end col-->
                                                
                                                                   

                                            </div><!--end row-->

                                            <div class="row">

                                                <div class="col-sm-12">

                                                    <input type="submit" id="submit" name="postTask" class="btn btn-primary" value="Post Task">

                                                </div><!--end col-->

                                            </div><!--end row-->

                                        </form><!--end form-->

                                    </div>
</div>
                                </div>

</div><!--end row-->

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
                        $sql=$link->prepare("SELECT * FROM dailytasks ORDER BY id DESC");
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
                                <button class="btn btn-sm btn-success completePost">Mark Complete</button>
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