<?php 
require $_SERVER['DOCUMENT_ROOT']."/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/actions/sp-posts.php";

include"inc/header.php" ;

?>


               <div class="container-fluid">

                    <div class="layout-specing">

                        <div class="d-md-flex justify-content-between align-items-center">

                            <h5 class="mb-0">Sponsored Post</h5>



                            <nav aria-label="breadcrumb" class="d-inline-block mt-2 mt-sm-0">

                                <ul class="breadcrumb bg-transparent rounded mb-0 p-0">

                                    

                                    <li class="breadcrumb-item text-capitalize"><a href="profile">Activity </a></li>

                                    <li class="breadcrumb-item text-capitalize active" aria-current="page">Post</li>

                                </ul>

                            </nav>

                        </div>
                       
                      <div class="row">
    <div class="col-lg-4 mt-4">
        <?php echo $spostMsg?>
        <div class="card border-0 rounded shadow">
            <div class="card-body">
                <h5 class="text-md-start text-center mb-0">Sponsored Post:</h5>
                <form method="POST" enctype="multipart/form-data">
                    <div class="row mt-4">
                        <?php echo $postMsg?>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Sponsored Post Title</label>
                                <div class="form-icon position-relative">
                                    <i data-feather="user" class="fea icon-sm icons"></i>
                                    <input id="title" type="text" class="form-control ps-5" placeholder="Post Title :" name="title" value="<?php echo $title?>">
                                </div>
                                <?php echo $titleErr?>
                            </div>
                        </div><!--end col-->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Sponsored Post Image</label>
                                <div class="form-icon position-relative">
                                    <i data-feather="image" class="fea icon-sm icons"></i>
                                    <input id="img" type="file" class="form-control ps-5" placeholder="Image :" accept="image/*" name="image">
                                </div>
                                <?php echo $imageErr?>
                            </div>
                        </div><!--end col-->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Sponsored Post Link</label>
                                <div class="form-icon position-relative">
                                    <i data-feather="link" class="fea icon-sm icons"></i>
                                    <input id="type" type="text" class="form-control ps-5" placeholder="Sponsored Post link :" name="type" value="<?php echo $type?>">
                                </div>
                                <?php echo $typeErr?>
                            </div>
                        </div><!--end col-->
                        </div><!--end col-->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <div class="form-icon position-relative">
                                    <i data-feather="mail" class="fea icon-sm icons"></i>
                                    <textarea id="default" style="width: 100%; height: 300px;" class="form-control ps-5" placeholder="Description :" name="desc"><?php echo $desc?></textarea>
                                </div>
                                <?php echo $descErr?>
                            </div>
                        </div><!--end col-->
                    <div class="row">
                        <div class="col-sm-12">
                            <input type="submit" id="submit" name="uploadPost" class="btn btn-primary" value="Upload Post">
                        </div><!--end col-->
                    </div><!--end row-->
                </form><!--end form-->
            </div>
        </div>
    </div>
</div><!--end row-->


                            <div class="col mt-4 pt-2"  id="tables">

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
                                                    
                                                    <th scope="col" class="border-bottom">image</th>
                                                    

                                                    <th scope="col" class="border-bottom">Date</th>

                                                    <th scope="col" class="border-bottom">Action</th>

                                                    </tr>

                                                </thead>

                                                <tbody>

                                                <?php 
                                                        $sql=$link->prepare("SELECT * FROM sponsoredpost ORDER BY id DESC");
                                                        $sql->execute();
                                                        $result=$sql->get_result();
                                                        
                                                        $numrow=$result->num_rows;
                                                        if($numrow > 0){
                                                            $idCount=0;
                                                            while($row=$result->fetch_assoc()){
                                                                $id=$row['id'];
                                                                $title=$row['title'];
                                                                $date=$row['date'];
                                                                $idCount=$row['id'];
                                                                $img=$row['image'];
                                                                $url=$row['url'];
                                                        ?>
                                                        <tr>
                                                            <th scope="row"><?php echo $id?></th>
                                                            <td class="p-3">
                                                        <a href="#" class="text-primary">
                                                            <div class="d-flex align-items-center">
                                                                <img src="/dash/img/sponsoredposts/<?php echo $img ?>" class="avatar avatar-ex-small rounded-circle shadow" alt="No image found">
                                                                <span class="ms-2"></span>
                                                                </div>
                                                        </a>
                                                    </td>
                                                    <td><?php echo $title ?></td>
                                                    <td><?php echo $url?></td>
                                                            <td><?php echo $date?></td>
                                                            <td><button class="btn btn-danger deletePost">Delete</button></td>
                                                            <input type="hidden" value="<?php echo $id?>" class="id">
                                                            
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
                    $(".deletePost").on("click", function(){
                        let id= $(this).closest("tr").find(".id").val();
                        let image= $(this).closest("tr").find(".image").val();
                        deletePost(id, image);
                        
                    })
                    function deletePost(id, image){
                        let form=document.createElement('form');
                        let input=document.createElement('input');
                        let inputID=document.createElement('input');
                        let inputImg=document.createElement('input');
                        let body=document.querySelector('body');
                        form.method="POST";
                        input.type="hidden";
                        input.value="deletePost";
                        input.name="deletePost";

                        inputID.type="hidden";
                        inputID.value=id;
                        inputID.name="id";

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

 <script src="/seotech/tinymce/tinymce.min.js"></script>
<script src="script.js"></script>


                <script>
    tinymce.init({
        selector: 'textarea#default',
        width: 300,
        height: 300,
        plugins:[
            'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
            'searchreplace', 'wordcount', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 'media', 
            'table', 'emoticons', 'template', 'codesample'
        ],
        toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify |' + 
        'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
        'forecolor backcolor emoticons',
        menu: {
            favs: {title: 'menu', items: 'code visualaid | searchreplace | emoticons'}
        },
        menubar: 'favs file edit view insert format tools table',
        content_style: 'body{font-family:Helvetica,Arial,sans-serif; font-size:16px}'
    });
</script>


                <?php include"inc/footer.php" ?>