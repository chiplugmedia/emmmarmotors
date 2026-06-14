<?php
require $_SERVER['DOCUMENT_ROOT']."/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/actions/payouts.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/actions/edit-user.php";

?>

<?php include"inc/header.php" ?>

<div class="container-fluid">
    <div class="layout-specing">
        <div class="d-md-flex justify-content-between align-items-center">
            <h5 class="mb-0">Payout</h5>

            <nav aria-label="breadcrumb" class="d-inline-block mt-2 mt-sm-0">
                <ul class="breadcrumb bg-transparent rounded mb-0 p-0">
                    <li class="breadcrumb-item text-capitalize"><a href="index.html">Payouts</a></li>

                    <li class="breadcrumb-item text-capitalize active" aria-current="page"> Payouts Request </li>
                </ul>
            </nav>
        </div>

        <br>
        <?php echo $genMsg?>

        <div class="col-xl-8 mt-4">
            <div class="d-flex justify-content-between p-4 bg-white shadow rounded-top">
                <h6 class="fw-bold mb-0">Payout Requests</h6>
                <ul class="list-unstyled mb-0">
                    <li class="dropdown dropdown-primary list-inline-item">
                        <button type="button" class="btn btn-icon btn-pills btn-soft-primary dropdown-toggle p-0"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                        </button>
                        <div class="dropdown-menu dd-menu dropdown-menu-end bg-white shadow border-0 mt-3 py-3">
                            <a class="dropdown-item text-dark" href="#">Used</a>
                            <a class="dropdown-item text-dark" href="#">Unused</a>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="table-responsive shadow rounded-bottom" data-simplebar style="height: 545px;">
                <table id="myTable" class="table table-center bg-white mb-0">
                    <thead>
                        <tr>
                            <th class="border-bottom p-3">No.</th>
                            <th class="border-bottom p-3">Username</th>
                            <th class="border-bottom p-3">Bank Details</th>
                            <th class="text-center border-bottom p-3">Amount</th>
                            <th class="text-center border-bottom p-3">Amount To Pay</th>
                            <th class="text-center border-bottom p-3">Submitted Date</th>
                            <th class="text-center border-bottom p-3">Status</th>
                            <th class="text-center border-bottom p-3">Approve</th>
                            <th class="text-center border-bottom p-3">Decline</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                $sql = $link->prepare("SELECT * FROM withdrawals WHERE type='activity' AND status IN ('processing', 'pending') ORDER BY id DESC");
                $sql->execute();
                $result = $sql->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $id       = $row['id'];
                        $username = $row['username'];
                        $amount   = $row['amount'];
                        $wallet   = $row['type'];
                        $date     = $row['date'];
                        $status   = $row['status'];

                        // Fetch bank details
                        $acctName = $acctNum = $bankName = '';
                        $sql_ref = $link->prepare("SELECT * FROM bankaccounts WHERE username=?");
                        $sql_ref->bind_param("s", $username);
                        $sql_ref->execute();
                        $result_ref = $sql_ref->get_result();
                        if ($result_ref->num_rows > 0) {
                            $row_ref  = $result_ref->fetch_assoc();
                            $acctName = ucwords($row_ref['acctname']);
                            $acctNum  = $row_ref['acctnum'];
                            $bankName = ucwords($row_ref['bankname']);
                        }

                        $bankDetails = "$bankName $acctNum $acctName";

                        // Calculate original amount (before 15% charge)
                        $originalAmount = round($amount / 1.10, 2);


                        // Status badge
$statusColor = ($status == "paid" || $status == "successful") ? "success" :
               (($status == "processing") ? "info" :
               (($status == "pending") ? "warning" : "danger"));

                        echo '
                        <tr>
                            <th class="p-3">#' . $id . '</th>
                            <td class="p-3"><span class="ms-2">' . htmlspecialchars($username) . '</span></td>
                            <td class="p-3"><span class="ms-2">' . htmlspecialchars($bankDetails) . '</span></td>
                            <td class="text-center p-3">₦' . number_format($amount, 2) . '</td>
                            <td class="text-center p-3">₦' . number_format($originalAmount, 2) . '</td>
                            <td class="text-center p-3">' . htmlspecialchars($date) . '</td>
                            <td class="text-center p-3">
                                <div class="badge bg-soft-' . $statusColor . ' rounded px-3 py-1">' . htmlspecialchars($status) . '</div>
                            </td>
                            <td class="text-center p-3">
                                <button type="button" class="btn btn-sm btn-primary approve">Approve</button>
                            </td>
                            <td class="text-center p-3">
                                <button type="button" class="btn btn-sm btn-danger decline">Decline</button>
                            </td>
                            <input type="hidden" class="id" value="' . $id . '">
                        </tr>';
                    }
                } else {
                    echo '<tr><td colspan="10" class="text-center">No payout requests found</td></tr>';
                }
                ?>
                    </tbody>
                </table>
            </div>
        </div>

        <script>
        $(".approve").on("click", function() {
            let id = $(this).closest("tr").find(".id").val();
            let actionType = "approve";
            action(id, actionType);

        })
        $(".decline").on("click", function() {
            let id = $(this).closest("tr").find(".id").val();
            let actionType = "decline";
            action(id, actionType);

        })

        function action(id, action, extraName = "", extraVal = "") {
            let form = document.createElement('form');
            let inputID = document.createElement('input');
            let inputAction = document.createElement('input');
            let inputExtra = document.createElement('input');
            let body = document.querySelector('body');
            form.method = "POST";

            inputID.type = "hidden";
            inputID.value = id;
            inputID.name = "id";

            inputAction.type = "hidden";
            inputAction.value = action;
            inputAction.name = action;

            inputExtra.type = "hidden";
            inputExtra.value = extraVal;
            inputExtra.name = extraName;

            form.appendChild(inputExtra);
            form.appendChild(inputAction);
            form.appendChild(inputID);
            body.appendChild(form);
            form.submit();
        }
        </script>

        <?php include"inc/footer.php" ?>