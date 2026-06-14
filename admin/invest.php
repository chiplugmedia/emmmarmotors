<?php
require $_SERVER['DOCUMENT_ROOT']."/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/actions/invest.php";


 include"inc/header.php" ?>



<div class="container-fluid">

    <div class="layout-specing">

        <div class="d-md-flex justify-content-between align-items-center">

            <h5 class="mb-0">Investment Package</h5>



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
                        <h5 class="text-md-start text-center mb-0">Add Investment Package:</h5>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Package Title</label>
                                        <div class="form-icon position-relative">
                                            <i data-feather="user" class="fea icon-sm icons"></i>
                                            <input id="title" type="text" class="form-control ps-5"
                                                placeholder="Package Title :" name="title"
                                                value="<?php echo $title; ?>">
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Package Image</label>
                                        <div class="form-icon position-relative">
                                            <i data-feather="image" class="fea icon-sm icons"></i>
                                            <input id="img" type="file" class="form-control ps-5" placeholder="Image :"
                                                accept=".png, .jpg, .jpeg, .heic" name="image">
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Package Price</label>
                                        <div class="form-icon position-relative">
                                            <i data-feather="link" class="fea icon-sm icons"></i>
                                            <input id="price" type="text" class="form-control ps-5"
                                                placeholder="Package Price :" name="price"
                                                value="<?php echo $price; ?>">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" class="form-control ps-5"
                                                placeholder="Package Price :" name="level"
                                                value="basic">
                              
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Package Daily Income</label>
                                        <div class="form-icon position-relative">
                                            <i data-feather="link" class="fea icon-sm icons"></i>
                                            <input id="daily" type="text" class="form-control ps-5"
                                                placeholder="Daily Income :" name="daily" value="<?php echo $daily; ?>">
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Package Duration</label>
                                        <div class="form-icon position-relative">
                                            <i data-feather="link" class="fea icon-sm icons"></i>
                                            <input id="duration" type="text" class="form-control ps-5"
                                                placeholder="Package Duration :" name="duration"
                                                value="<?php echo $duration; ?>">
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="submit" id="submit" name="addinvestment" class="btn btn-primary"
                                        value="Upload Package">
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </form>
                        <!--end form-->
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->
      
<!-- =========================
     TABS
=========================
<div class="tabs-scroll-wrapper mb-3">
    <ul class="nav nav-tabs flex-nowrap" id="planTabs" role="tablist">

        <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#basic">
                Basic
            </button>
        </li>

        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#quadro">
                Quadro
            </button>
        </li>

        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#plant">
                Plant
            </button>
        </li>

    </ul>
</div> -->
<!-- =========================
     TAB CONTENTS
========================= -->
<div class="tab-content">

<!-- BASIC -->
<div class="tab-pane fade show active" id="basic">
    <div class="table-responsive">
        <table class="table mb-0 table-center">

            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Price</th>
                    <th scope="col">Daily Income</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $sql = $link->prepare("SELECT * FROM investment_plans WHERE level='basic' ORDER BY id DESC");
                $sql->execute();
                $result = $sql->get_result();

                $rank = 1;

                while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><span class="rank-box"><?php echo $rank++; ?></span></td>

                    <td>
                        <img src="/dashboard/img/invest/<?php echo $row['image']; ?>"
                             class="avatar avatar-ex-small rounded-circle shadow">
                    </td>

                    <td><?php echo $row['title']; ?></td>
                    <td>₦<?php echo $row['price']; ?></td>
                    <td>₦<?php echo $row['daily']; ?></td>
                    <td><?php echo $row['duration']; ?> days</td>

                    <td>
                        <button class="btn btn-danger deleteinvestment">Delete</button>
                        <input type="hidden" class="id" value="<?php echo $row['id']; ?>">
                    </td>
                </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>
</div>

<!-- QUADRO -->
<div class="tab-pane fade" id="quadro">
    <div class="table-responsive">
        <table class="table mb-0 table-center">

            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Price</th>
                    <th scope="col">Daily Income</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $sql = $link->prepare("SELECT * FROM investment_plans WHERE level='quadro' ORDER BY id DESC");
                $sql->execute();
                $result = $sql->get_result();

                $rank = 1;

                while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                   <td><span class="rank-box"><?php echo $rank++; ?></span></td>

                    <td>
                        <img src="/dashboard/img/invest/<?php echo $row['image']; ?>"
                             class="avatar avatar-ex-small rounded-circle shadow">
                    </td>

                    <td><?php echo $row['title']; ?></td>
                    <td>₦<?php echo $row['price']; ?></td>
                    <td>₦<?php echo $row['daily']; ?></td>
                    <td><?php echo $row['duration']; ?> days</td>

                    <td>
                        <button class="btn btn-danger deleteinvestment">Delete</button>
                        <input type="hidden" class="id" value="<?php echo $row['id']; ?>">
                    </td>
                </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>
</div>

<!-- PLANT -->
<div class="tab-pane fade" id="plant">
    <div class="table-responsive">
        <table class="table mb-0 table-center">

            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Price</th>
                    <th scope="col">Daily Income</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $sql = $link->prepare("SELECT * FROM investment_plans WHERE level='plant' ORDER BY id DESC");
                $sql->execute();
                $result = $sql->get_result();

                $rank = 1;

                while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                   <td><span class="rank-box"><?php echo $rank++; ?></span></td>

                    <td>
                        <img src="/dashboard/img/invest/<?php echo $row['image']; ?>"
                             class="avatar avatar-ex-small rounded-circle shadow">
                    </td>

                    <td><?php echo $row['title']; ?></td>
                    <td>₦<?php echo $row['price']; ?></td>
                    <td>₦<?php echo $row['daily']; ?></td>
                    <td><?php echo $row['duration']; ?> days</td>

                    <td>
                        <button class="btn btn-danger deleteinvestment">Delete</button>
                        <input type="hidden" class="id" value="<?php echo $row['id']; ?>">
                    </td>
                </tr>
                <?php } ?>
            </tbody>

        </table>
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