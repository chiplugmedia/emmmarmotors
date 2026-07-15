<?php
require $_SERVER['DOCUMENT_ROOT']."/emmmarmotors/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/actions/invest.php";


 include"inc/header.php" ?>



<div class="container-fluid">

    <div class="layout-specing">

        <div class="d-md-flex justify-content-between align-items-center">

            <h5 class="mb-0 text-dark fw-bold">Investment Package</h5>



            <nav aria-label="breadcrumb" class="d-inline-block mt-2 mt-sm-0">

                <ul class="breadcrumb bg-transparent rounded mb-0 p-0">



                    <li class="breadcrumb-item text-capitalize"><a href="#">Activity </a></li>

                    <li class="breadcrumb-item text-capitalize active" aria-current="page">Investment Package</li>

                </ul>

            </nav>

        </div>

<div class="row">
    <div class="col-lg-4 mt-4">
        <?php echo $genMsg; ?>

        <div class="card border-0 rounded shadow">
            <div class="card-body">

                <h5 class="text-md-start text-dark fw-bold text-center mb-0">
                    Add Investment Package:
                </h5>

                <form method="POST" enctype="multipart/form-data">

                    <div class="row mt-4">

                        <!-- Package Title -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Package Title</label>
                                <div class="form-icon position-relative">
                                    <i data-feather="user" class="fea icon-sm icons"></i>
                                    <input
                                        id="title"
                                        type="text"
                                        class="form-control ps-5"
                                        placeholder="Package Title"
                                        name="title"
                                        value="<?php echo $title ?? ''; ?>">
                                </div>
                            </div>
                        </div>

                        <!-- Package Image -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Package Image</label>
                                <div class="form-icon position-relative">
                                    <i data-feather="image" class="fea icon-sm icons"></i>
                                    <input
                                        id="img"
                                        type="file"
                                        class="form-control ps-5"
                                        accept=".png,.jpg,.jpeg,.heic"
                                        name="image">
                                </div>
                            </div>
                        </div>

                        <!-- Package Price -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Package Price</label>
                                <div class="form-icon position-relative">
                                    <i data-feather="link" class="fea icon-sm icons"></i>
                                    <input
                                        id="price"
                                        type="text"
                                        class="form-control ps-5"
                                        placeholder="Package Price"
                                        name="price"
                                        value="<?php echo $price ?? ''; ?>">
                                </div>
                            </div>
                        </div>

                        <!-- Hidden Level -->
                        <input
                            type="hidden"
                            name="level"
                            value="basic">

                        <!-- Daily Income -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Package Daily Income</label>
                                <div class="form-icon position-relative">
                                    <i data-feather="link" class="fea icon-sm icons"></i>
                                    <input
                                        id="daily"
                                        type="text"
                                        class="form-control ps-5"
                                        placeholder="Daily Income"
                                        name="daily"
                                        value="<?php echo $daily ?? ''; ?>">
                                </div>
                            </div>
                        </div>

                        <!-- Duration -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Package Duration</label>
                                <div class="form-icon position-relative">
                                    <i data-feather="link" class="fea icon-sm icons"></i>
                                    <input
                                        id="duration"
                                        type="text"
                                        class="form-control ps-5"
                                        placeholder="Package Duration"
                                        name="duration"
                                        value="<?php echo $duration ?? ''; ?>">
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Package Description</label>
                                <div class="form-icon position-relative">
                                    <i data-feather="file-text" class="fea icon-sm icons"></i>
                                    <textarea id="description" type="text" class="form-control ps-5" placeholder="description :" name="content"><?php echo $description?></textarea>
                                    
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-sm-12">
                            <input
                                type="submit"
                                id="submit"
                                name="addinvestment"
                                class="btn btn-primary"
                                value="Upload Package">
                        </div>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>
    

<div class="col mt-4 pt-2" id="tables">

    <div class="component-wrapper rounded shadow">

        <div class="p-4 border-bottom">
            <h4 class="text-dark fw-bold">Investment Plans</h4>
        </div>

        <div class="p-4">

            <div class="table-responsive">
                <table class="table table-hover table-center mb-0">

                    <thead>
                        <tr>
                            <th class="text-dark fw-bold">#</th>
                            <th class="text-dark fw-bold">Image</th>
                            <th class="text-dark fw-bold">Title</th>
                            <th class="text-dark fw-bold">Description</th>
                            <th class="text-dark fw-bold">Price</th>
                            <th class="text-dark fw-bold">Daily Income</th>
                            <th class="text-dark fw-bold">Duration</th>
                            <th class="text-dark fw-bold">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        $sql = $link->prepare("SELECT * FROM investment_plans ORDER BY id DESC");
                        $sql->execute();
                        $result = $sql->get_result();
$rank = 1;
                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){

                           
                        ?>

                        <tr>
                             <td>
                                <span class="rank-box">
                                    <?php echo $rank++; ?>
                                </span>
                            </td>

                            <td>
                                <img src="/dashboard/img/invest/<?php echo $row['image']; ?>"
                                     class="avatar avatar-ex-small rounded-circle shadow"
                                     alt="">
                            </td>

                            <td class="text-dark"><?php echo $row['title']; ?></td>

                            <td class="text-dark"><?php echo $row['description']; ?></td>
                            <td class="text-dark">₦<?php echo number_format($row['price']); ?></td>

                            <td class="text-dark">₦<?php echo number_format($row['daily']); ?></td>

                            <td class="text-dark"><?php echo $row['duration']; ?> days</td>

                            <td>
                                <button class="btn btn-danger deleteinvestment">
                                    Delete
                                </button>

                                <input type="hidden"
                                       value="<?php echo $row['id']; ?>"
                                       class="id">
                            </td>
                        </tr>

                        <?php
                            }
                        }else{
                        ?>
                        <tr>
                            <td colspan="8" class="text-center">
                                No investment plans found.
                            </td>
                        </tr>
                        <?php } ?>

                    </tbody>

                </table>
            </div>

        </div>

    </div>

</div>

        <script>
        // Attach click event listener to elements with class "deleteinvestment"
        $(".deleteinvestment").on("click", function() {
            // Get the id and image values from the closest table row
            let id = $(this).closest("tr").find(".id").val();
            let image = $(this).closest("tr").find(".image").val();
            // Call the deleteinvestment function with the id and image values
            deleteinvestment(id, image);
        });

        // Function to create and submit a form to delete the investment
        function deleteinvestment(id, image) {
            // Create a form element
            let form = document.createElement('form');
            // Create input elements for deleteinvestment, id, and image
            let input = document.createElement('input');
            let inputID = document.createElement('input');
            let inputImg = document.createElement('input');
            // Get the body element to append the form
            let body = document.querySelector('body');

            // Set form method to POST
            form.method = "POST";

            // Set input type and value for deleteinvestment
            input.type = "hidden";
            input.value = "deleteinvestment";
            input.name = "deleteinvestment";

            // Set input type and value for id
            inputID.type = "hidden";
            inputID.value = id;
            inputID.name = "id";

            // Set input type and value for image
            inputImg.type = "hidden";
            inputImg.value = image;
            inputImg.name = "image";

            // Append the inputs to the form
            form.appendChild(input);
            form.appendChild(inputID);
            form.appendChild(inputImg);
            // Append the form to the body
            body.appendChild(form);
            // Submit the form
            form.submit();
        }
        </script>









        <?php include"inc/footer.php" ?>