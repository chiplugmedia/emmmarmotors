<?php
require $_SERVER['DOCUMENT_ROOT']."/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/actions/deposit.php";

?>

<?php include"inc/header.php" ?>

                <div class="container-fluid">
                    <div class="layout-specing">
                        <div class="d-md-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Vistapay</h5>

                            <nav aria-label="breadcrumb" class="d-inline-block mt-2 mt-sm-0">
                                <ul class="breadcrumb bg-transparent rounded mb-0 p-0">
                                    <li class="breadcrumb-item text-capitalize"><a href="index">Vistapay</a></li>
                                   
                                    <li class="breadcrumb-item text-capitalize active" aria-current="page"> Deposit Request
                                </ul>
                            </nav>
                        </div>
                    
                        <br>
                        <?php echo $genMsg?>

                                                    <div class="col-xl-8 mt-4">

                                <div class="d-flex justify-content-between p-4 bg-white shadow rounded-top">

                                    <h6 class="fw-bold mb-0">Deposit Requests</h6>



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

                               <div class="table-responsive shadow rounded-bottom" data-simplebar style="height: 545px;">
    <table class="table table-center bg-white mb-0">
        <thead>
            <tr>
                <th class="border-bottom p-3">No.</th>
                <th class="border-bottom p-3" style="min-width: 220px;">Username</th>
                <th class="text-center border-bottom p-3">Payment Method</th>
                <th class="text-center border-bottom p-3">Amount</th>
                <th class="text-center border-bottom p-3">Sender Name</th>
                <th class="text-end border-bottom p-3" style="min-width: 100px;">Screenshot</th>
                <th class="text-center border-bottom p-3" style="min-width: 150px;">Submitted Date</th>
                <th class="text-center border-bottom p-3">Status</th>
                <th class="text-end border-bottom p-3" colspan="2" style="min-width: 200px;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = $link->prepare("SELECT * FROM bankdeposit WHERE status ='pending' ORDER BY id DESC");
            $sql->execute();
            $result = $sql->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $username = $row['username'];
                    $image = $row['image'];
                    $sendername = $row['sendername'];
                    $method = $row['method'];
                    $amount = number_format($row['amount'], 2);
                    $status = $row['status'];
                    $date = $row['date'];
                    $statusColor = ($status == "paid" || $status == "successful") ? "success" : ($status == "pending" ? "warning" : "danger");
            ?>
                    <tr>
                        <td class="p-3">#<?php echo $id ?></td>
                        <td class="p-3">
                            <a href="#" class="text-primary">
                                <div class="d-flex align-items-center">
                                    <span class="ms-2"><?php echo $username ?></span>
                                </div>
                            </a>
                        </td>
                        <td class="text-center p-3"><?php echo $method ?></td>
                        <td class="text-center p-3">₦<?php echo $amount ?></td>
                         <td class="text-center p-3"><?php echo $sendername ?></td>
                        <td class="text-end p-3">
                            <a href="/dash/img/directory/<?php echo $image ?>" class="btn btn-sm btn-primary">View Image</a>
                        </td>
                        <td class="text-center p-3"><?php echo $date ?></td>
                        <td class="text-center p-3">
                            <div class="badge bg-soft-<?php echo $statusColor ?> rounded px-3 py-1"><?php echo $status ?></div>
                        </td>
                        <td class="text-end p-3">
                            <button class="btn btn-sm btn-primary approve" data-id="<?php echo $id ?>">Approve</button>
                        </td>
                        <td class="text-end p-3">
                            <button class="btn btn-sm btn-danger decline" data-id="<?php echo $id ?>">Decline</button>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    $(".approve, .decline").on("click", function() {
        let id = $(this).data("id");
        let action = $(this).hasClass("approve") ? "approve" : "decline";
        actionRequest(id, action);
    });

    function actionRequest(id, action) {
        let form = $("<form>")
            .attr("method", "POST")
            .appendTo("body");
        $("<input>").attr("type", "hidden").attr("name", "id").val(id).appendTo(form);
        $("<input>").attr("type", "hidden").attr("name", action).appendTo(form);
        form.submit();
    }
</script>


<?php include"inc/footer.php" ?>
                