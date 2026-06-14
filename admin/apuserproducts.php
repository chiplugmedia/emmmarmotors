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

                            <h5 class="mb-0">Products</h5>



                            <nav aria-label="breadcrumb" class="d-inline-block mt-2 mt-sm-0">

                                <ul class="breadcrumb bg-transparent rounded mb-0 p-0">

                                    

                                    <li class="breadcrumb-item text-capitalize"><a href="profile">Activity </a></li>

                                    <li class="breadcrumb-item text-capitalize active" aria-current="page">Products</li>

                                </ul>

                            </nav>

                        </div>
 
 <!-- Table Start -->
<!-- Table Start -->
<div class="col mt-4 pt-2" id="tables">
    <div class="component-wrapper rounded shadow">
        <div class="p-4 border-bottom">
            <h4 class="title mb-0">All Products </h4>
        </div>
        <div class="p-4">
            <div class="table-responsive bg-white shadow rounded" data-simplebar style="height: 545px;">
                <table class="table mb-0 table-center">
                    <thead>
                        <tr>
                            <th scope="col" class="border-bottom">#</th>
                            <th scope="col" class="border-bottom">Image</th>
                            <th scope="col" class="border-bottom">Title</th>
                            <th scope="col" class="border-bottom">Username</th>
                            <th scope="col" class="border-bottom">Price</th>
                            <th scope="col" class="border-bottom">Date</th>
                            <th scope="col" class="border-bottom">Status</th>
                            <th scope="col" class="border-bottom">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = $link->prepare("SELECT * FROM products");
                        $sql->execute();
                        $result = $sql->get_result();
                        $idCount = 0;
                        while ($row = $result->fetch_assoc()) {
                            $idCount++;
                            $reference = $row['reference'];
                            $image1 = $row['image1'];
                            $title = $row['title'];
                            $username = $row['username'];
                            $price = $row['price'];
                            $date = $row['date'];
                            $status = $row['status']; // Fetching status from the database
                            if ($status == "pending") {
                                $statusColor = "warning";
                            } elseif ($status == "rejected") {
                                $statusColor = "danger";
                            } else {
                                $statusColor = "success"; // Changed "approved" to "success"
                            }
                        ?>
                            <tr>
                                <th class="p-3"><?php echo $idCount ?></th>
                                <td class="p-3">
                                    <a href="#" class="text-primary">
                                        <div class="d-flex align-items-center">
                                            <img src="/dash/img/products/<?php echo $image1 ?>" class="avatar avatar-ex-small rounded-circle shadow" alt="No image found">
                                            <span class="ms-2"><?php echo $title ?></span>
                                        </div>
                                    </a>
                                </td>
                                <td class="text-center p-3"><?php echo $username ?></td>
                                <td class="text-center p-3">$<?php echo number_format($price, 2) ?></td>
                                <td class="text-center p-3"><?php echo $date ?></td>
                                <td class="text-end p-3">
                                    <div class="status-container">
                                        <button class="btn btn-sm btn-<?php echo $statusColor ?> status-btn"><?php echo $status ?></button>
                                        <select class="form-select status-select d-none">
                                            <option value="pending" <?php echo $status === 'pending' ? 'selected' : '' ?>>Pending</option>
                                            <option value="rejected" <?php echo $status === 'rejected' ? 'selected' : '' ?>>Rejected</option>
                                            <option value="approved" <?php echo $status === 'approved' ? 'selected' : '' ?>>Approved</option>
                                        </select>
                                        <button class="btn btn-sm btn-primary save-status d-none">Save</button>
                                    </div>
                                </td>
                                <td class="text-end p-3">
                                    <button class="btn btn-sm btn-danger deleteProduct">Delete</button>
                                    <input type="hidden" class="reference" value="<?php echo $reference ?>">
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div><!--end col-->
<!-- Table End -->
</div>
</div><!--end container-->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Assuming you're using SweetAlert2 for the confirmation dialog -->

<script>
$(document).ready(function() {
    $('.status-btn').click(function() {
        $(this).toggleClass('d-none');
        $(this).siblings('.status-select').toggleClass('d-none');
        $(this).siblings('.save-status').toggleClass('d-none');
    });

    $('.save-status').click(function() {
        let reference = $(this).closest('tr').find('.reference').val();
        let newStatus = $(this).siblings('.status-select').val();
        updateStatus(reference, newStatus);
    });

    $(".deleteProduct").on("click", function() {
        let reference = $(this).closest("tr").find(".reference").val();
        let actionType = "deleteProduct";
        Swal.fire({
            title: "Are you sure you want to delete?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: 'Yes, delete',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                action(reference, actionType);
            }
        });
    });
});

function updateStatus(reference, newStatus) {
    let form = $('<form method="POST"></form>');
    form.append($('<input type="hidden" name="reference" value="' + reference + '">'));
    form.append($('<input type="hidden" name="newStatus" value="' + newStatus + '">'));
    form.append($('<input type="hidden" name="updateStatus" value="updateStatus">'));
    $('body').append(form);
    form.submit();
}

function action(reference, action) {
    // Using jQuery to create and submit form
    let form = $('<form method="POST"></form>');
    $('<input type="hidden" name="reference" value="' + reference + '">').appendTo(form);
    $('<input type="hidden" name="' + action + '" value="' + action + '">').appendTo(form);
    $('body').append(form);
    form.submit();
}
</script>



                <?php include"inc/footer.php" ?>