<?php 
require $_SERVER['DOCUMENT_ROOT']."/invest/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/actions/post.php";

include"inc/header.php" ;

?>


                <div class="container-fluid">

                    <div class="layout-specing">

                        <div class="d-md-flex justify-content-between align-items-center">

                            <h5 class="mb-0">Blog Post</h5>



                            <nav aria-label="breadcrumb" class="d-inline-block mt-2 mt-sm-0">

                                <ul class="breadcrumb bg-transparent rounded mb-0 p-0">

                                    

                                    <li class="breadcrumb-item text-capitalize"><a href="profile">Activity </a></li>

                                    <li class="breadcrumb-item text-capitalize active" aria-current="page">Post</li>

                                </ul>

                            </nav>

                        </div>
                       
                       <div class="row">

                            <div class="col-lg-4 mt-4">
                            <?php echo $bppostMsg?>

                                <div class="card border-0 rounded shadow">

                                    <div class="card-body">

                                        <h5 class="text-md-start text-center mb-0">Popup Post:</h5>

        

                                        

                                        <form method="POST" enctype="multipart/form-data">

                                            <div class="row mt-4">
                                                <?php echo $OpostMsg?>

                                                <div class="col-md-6">

                                                    <div class="mb-3">

                                                        <label class="form-label">Popup Post Title</label>

                                                        <div class="form-icon position-relative">

                                                            <i data-feather="user" class="fea icon-sm icons"></i>

                                                            <input post_id="title" type="text" class="form-control ps-5" placeholder="Post Title :" name="title" value="<?php echo $title?>">

                                                        </div>
                                                         <?php echo $titleprr?>

                                                    </div>

                                                </div><!--end col-->

                                                
                                                <div class="col-md-6">

                                                    <div class="mb-3">

                                                        <label class="form-label">Popup Post Image </label>

                                                        <div class="form-icon position-relative">

                                                            <i data-feather="image" class="fea icon-sm icons"></i>

                                                            <input post_id="image" type="file" class="form-control ps-5" placeholder="Image :" accept="image/*" name="image">

                                                        </div>
                                                           <?php echo $imageprr?>
                                                    </div> 

                                                
                                                
                                                

                                                </div><!--end col-->

                                                <div class="col-md-6">

                                                    <div class="mb-3">

                                                        <label class="form-label">Content </label>

                                                        <div class="form-icon position-relative">

                                                            <i data-feather="mail" class="fea icon-sm icons"></i>

                                                            <textarea post_id="content" type="email" class="form-control ps-5" placeholder="Content :" name="content"><?php echo $content?></textarea>

                                                        </div>
                                                              <?php echo $contentprr?>

                                                    </div> 

                                                </div><!--end col-->

                                               <div class="col-md-6">

                                                    <div class="mb-3">

                                                        <label class="form-label">Popup- link</label>

                                                        <div class="form-icon position-relative">

                                                            <i data-feather="user" class="fea icon-sm icons"></i>

                                                            <input post_id="author_id" type="text" class="form-control ps-5" placeholder="Post author_id :" name="author_id" value="<?php echo $author_id?>">

                                                        </div>
                                                                    <?php echo $authorprr?>
     
                                                    </div>
                                                  
                                            </div><!--end row-->

                                            <div class="row">

                                                <div class="col-sm-12">

                                                    <input type="submit" post_id="submit" name="bPostupload" class="btn btn-primary" value="Upload Post">
</div><!--end col-->

                                            </div><!--end row-->

                                        </form><!--end form-->

                                    </div>
</div>
                                </div>

</div><!--end row-->

<!-- Table Start -->

                            <!-- Table Start -->

                           <div class="col mt-4 pt-2"  id="tables">

                                <div class="component-wrapper rounded shadow">

                                    <div class="p-4 border-bottom">

                                        <h4 class="title mb-0"> Recent </h4>

                                    </div>



                                    <div class="p-4">

                                       <div class="table-responsive shadow rounded">
    <table class="table mb-0 table-center">
        <thead>
            <tr>
                <th scope="col" class="border-bottom">#</th>
                <th scope="col" class="border-bottom">Image</th>
                <th scope="col" class="border-bottom">Title</th>
                <th scope="col" class="border-bottom">Date</th>
                <th scope="col" class="border-bottom">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $sql = $link->prepare("SELECT * FROM posts ORDER BY post_id DESC");
                $sql->execute();
                $result = $sql->get_result();
                $numrow = $result->num_rows;
$rank = 1;
                if($numrow > 0){
                    while($row = $result->fetch_assoc()){
                        $post_id = $row['post_id'];
                        $title = $row['title'];
                        $created_at = $row['created_at'];
                        $image = $row['image'];
            ?>
            <tr>
                <td><span class="rank-box"><?php echo $rank++; ?></span></td>
                <td class="p-3">
                    <a href="#" class="text-primary">
                        <div class="d-flex align-items-center">
                            <img src="/dashboard/img/posts/<?php echo $image ?>" class="avatar avatar-ex-small rounded-circle shadow" alt="No image found">
                            <span class="ms-2"></span>
                        </div>
                    </a>
                </td>
                <td><?php echo $title ?></td>
                <td><?php echo $created_at?></td>
                <td><button class="btn btn-danger deletebPost">Delete</button></td>
                <input type="hidden" value="<?php echo $post_id?>" class="post_id">
            </tr>
            <?php }} ?>
        </tbody>
    </table>
</div>

                </div><!--end container-->
                <script>
                    $(".deletebPost").on("click", function(){
                        let post_id= $(this).closest("tr").find(".post_id").val();
                        let image= $(this).closest("tr").find(".image").val();
                        deletebPost(post_id, image);
                        
                    })
                    function deletebPost(post_id, image){
                        let form=document.createElement('form');
                        let input=document.createElement('input');
                        let inputID=document.createElement('input');
                        let inputImg=document.createElement('input');
                        let body=document.querySelector('body');
                        form.method="POST";
                        input.type="hidden";
                        input.value="deletebPost";
                        input.name="deletebPost";

                        inputID.type="hidden";
                        inputID.value=post_id;
                        inputID.name="post_id";

                        inputImg.type="hidden";
                        inputImg.value=image;
                        inputImg.name="image";

                        form.appendChild(inputImg);
                        form.appendChild(inputID);
                        form.appendChild(input);
                        body.appendChild(form);
                        form.submit();
                    }


                </script>


                <?php include"inc/footer.php" ?>