<?php
require $_SERVER['DOCUMENT_ROOT']."/invest/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/actions/main.php";

// $apiBalance=apiBalance();

$sql=$link->prepare("SELECT * FROM users WHERE role != 'admin' ");
$sql->execute();
$result=$sql->get_result();
$totalUsers=$result->num_rows;

$sql=$link->prepare("SELECT * FROM users WHERE acctype = 'standard' ");
$sql->execute();
$result=$sql->get_result();
$totalUpgraded=$result->num_rows;

$sql = $link->prepare("SELECT SUM(totalrefearnings) AS totalFunds FROM users WHERE totalrefearnings != '0' AND role = 'user'");
$sql->execute();
$result = $sql->get_result();
$totalFunds = $result->fetch_assoc()['totalFunds'];


$sql=$link->prepare("SELECT * FROM transactions");
$sql->execute();
$result=$sql->get_result();
$totalTrx=$result->num_rows;

$sql = $link->prepare("SELECT SUM(countryname) AS totalpending FROM withdrawals WHERE status = 'pending'");
$sql->execute();
$result = $sql->get_result();
$row = $result->fetch_assoc(); // Fetch the row containing the total sum
$totalpending = $row['totalpending']; // Access the total sum


$sql = $link->prepare("SELECT SUM(countryname) AS total_paid FROM withdrawals WHERE status = 'successful'");
$sql->execute();
$result = $sql->get_result();
$row = $result->fetch_assoc(); // Fetch the row containing the total sum
$totalPayout = $row['total_paid']; // Access the total sum

$sql=$link->prepare("SELECT SUM(amount) AS totalDataPayout FROM datawithdrawals WHERE status = 'success' ");
$sql->execute();
$result=$sql->get_result();
$totalDataPayout=$result->fetch_assoc()['totalDataPayout'];


$sql=$link->prepare("SELECT * FROM fundwallet WHERE status = 'successful' ");
$sql->execute();
$result=$sql->get_result();
$totalFunding=$result->num_rows;


?>

<?php include"inc/header.php" ?>



<div class="container-fluid">

    <div class="layout-specing">
        <br>
        <?php echo $genMsg?>
        <div class="d-flex align-items-center justify-content-between">

            <div>

                <h6 class="text-muted mb-1">Welcome back, <?php echo $greeting ?> </h6>

                <h5 class="mb-0"><?php echo $username ?></h5>

            </div>



            <div class="mb-0 position-relative">







            </div>

        </div> <!-- Announce Popup End -->









        <div class="col mt-4">

            <a href="#!"
                class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">

                <div class="d-flex align-items-center">

                    <div class="icon text-center rounded-pill">

                        <i class="uil uil-users-alt fs-1 mb-0"></i>

                    </div>

                    <div class="flex-1 ms-3">

                        <h6 class="mb-0 text-muted">Total Users</h6>

                        <p class="fs-5 text-dark fw-bold mb-0"><span><?php echo number_format($totalUsers)?></span></p>

                    </div>

                </div>



                <span class="text-primary"><i class="uil uil-users-alt"></i></span>

            </a>

        </div>
        <!--end col-->

        <div class="col mt-4">

            <a href="#!"
                class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">

                <div class="d-flex align-items-center">

                    <div class="icon text-center rounded-pill">

                        <i class="uil uil-wallet fs-1 mb-0"></i>

                    </div>

                    <div class="flex-1 ms-3">

                        <h6 class="mb-0 text-muted">Total Payout</h6>

                        <p class="fs-5 text-dark fw-bold mb-0"><span>₦<?php echo number_format($totalPayout, 2)?></span>
                        </p>

                    </div>

                </div>



                <span class="text-primary"><i class="uil uil-wallet"></i></span>

            </a>

        </div>
        <!--end col-->

        <div class="col mt-4">

            <a href="#!"
                class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">

                <div class="d-flex align-items-center">

                    <div class="icon text-center rounded-pill">

                        <i class="uil uil-users-alt fs-1 mb-0"></i>

                    </div>

                    <div class="flex-1 ms-3">

                        <h6 class="mb-0 text-muted">Total Pending</h6>

                        <p class="fs-5 text-dark fw-bold mb-0">
                            <span>₦<?php echo number_format($totalpending, 2)?></span>
                        </p>


                    </div>

                </div>



                <span class="text-primary"><i class="uil uil-users-alt"></i></span>

            </a>

        </div>


        <div class="col mt-4">

            <a href="#!"
                class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">

                <div class="d-flex align-items-center">

                    <div class="icon text-center rounded-pill">

                        <i class="uil uil-users-alt fs-1 mb-0"></i>

                    </div>

                    <div class="flex-1 ms-3">

                        <h6 class="mb-0 text-muted">Total Funds</h6>

                        <p class="fs-5 text-dark fw-bold mb-0"><span>₦<?php echo number_format($totalFunds, 2)?></span>
                        </p>

                    </div>

                </div>



                <span class="text-primary"><i class="uil uil-users-alt"></i></span>

            </a>

        </div>


        <div class="col mt-4 pt-2" id="tables">
            <div class="component-wrapper rounded shadow">
                <div class="p-4 border-bottom">
                    <h4 class="title mb-0">All Transactions</h4>
                </div>

                <div class="p-4">
                    <div class="table-responsive">
                        <table id="myTable" class="table mb-0 table-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Phone Number</th>
                                    <th>Amount</th>
                                    <th>Amount with 15%</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                        $sql = $link->prepare("SELECT * FROM withdrawals ORDER BY id DESC");
                        $sql->execute();
                        $result = $sql->get_result();
                        $rank = 1;

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $username = $row['username'];
                                $amountwithcharges = $row['amount'];
                                $amount = $row['countryname'];
                                $date = $row['date'];
                                $status = $row['status'];

                                // Determine the status color
                                $statusColor = ""; 
                                if ($status == "successful") {
                                    $statusColor = "success"; // Green for successful
                                } elseif ($status == "pending") {
                                    $statusColor = "warning"; // Yellow/orange for pending
                                } elseif ($status == "rejected") {
                                    $statusColor = "danger"; // Red for rejected
                                } else {
                                    $statusColor = "default"; // Optional: set a default color for unknown statuses
                                }

                                $dateTime = new DateTime($date);
                                $currentTime = new DateTime();
                                $interval = $dateTime->diff($currentTime);

                                if ($interval->y > 0) {
                                    $timeAgo = $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
                                } elseif ($interval->m > 0) {
                                    $timeAgo = $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
                                } elseif ($interval->d > 0) {
                                    $timeAgo = $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
                                } elseif ($interval->h > 0) {
                                    $timeAgo = $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
                                } elseif ($interval->i > 0) {
                                    $timeAgo = $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
                                } else {
                                    $timeAgo = 'just now';
                                }
                        ?>
                                <tr>
                                    <th><?php echo $rank++; ?></th>
                                    <td><?php echo $username; ?></td>
                                    <td>₦<?php echo number_format($amountwithcharges, 2); ?></td>
                                    <td>₦<?php echo number_format($amount, 2); ?></td>
                                    <td data-order="<?php echo strtotime($date); ?>">
                                        <?php echo $timeAgo; ?>
                                    </td>
                                    <td class="text-center p-3">
                                        <div class="badge bg-soft-<?php echo $statusColor; ?> rounded px-3 py-1">
                                            <?php echo $status; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo '<tr><td colspan="5" class="text-center">No transactions found</td></tr>';
                        }
                        ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <script>
        $(".deleteMsg").on("click", function() {
            let id = $(this).closest("tr").find(".id").val();
            let actionType = "deleteMsg";
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