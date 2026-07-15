<?php
$genMsg=$refBonus=$refDataBonus=$welcomeDataBonus=$minFunding=$minDataWithdrawAmt=$minRefWithdrawAmt=$minMainWithdrawAmt=$couponAmount=$refDataComm=$refAirtimeComm=$refCommFirstDeposit="";

require $_SERVER['DOCUMENT_ROOT']."/invest/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/actions/settings.php";


// Fetch data from fundwallet table
$sql = "SELECT * FROM fundwallet ORDER BY id DESC";
$result = $link->query($sql);

?>

<?php include"inc/header.php" ?>



                <div class="container-fluid">

                    <div class="layout-specing">
                        <br>
                        <?php echo $genMsg?>
                        <div class="d-md-flex justify-content-between align-items-center">

                            <h5 class="mb-0">Prices </h5>



                            <nav aria-label="breadcrumb" class="d-inline-block mt-2 mt-sm-0">

                                <ul class="breadcrumb bg-transparent rounded mb-0 p-0">

                                    <li class="breadcrumb-item text-capitalize"><a href="dashboard.php"><?php echo $sitename ?></a></li>

                                    <li class="breadcrumb-item text-capitalize"><a href="#">Prices</a></li>

                                    <li class="breadcrumb-item text-capitalize active" aria-current="page">Data Prices </li>

                                </ul>

                            </nav>

                        </div>

                    

<div class="col-xl-8 mt-4">
    <div class="d-flex justify-content-between p-4 shadow rounded-top">
        <h6 class="fw-bold mb-0">Users Wallet Funding Transactions</h6>

        <ul class="list-unstyled mb-0">
            <li class="dropdown dropdown-primary list-inline-item">
                <button type="button"
                        class="btn btn-icon btn-pills btn-soft-primary dropdown-toggle p-0"
                        data-bs-toggle="dropdown">
                    <i class="ti ti-dots-vertical"></i>
                </button>

                <div class="dropdown-menu dropdown-menu-end shadow border-0 mt-3 py-3">
                    <a class="dropdown-item text-dark" href="#">All</a>
                    <a class="dropdown-item text-dark" href="#">Pending</a>
                    <a class="dropdown-item text-dark" href="#">Success</a>
                    <a class="dropdown-item text-dark" href="#">Failed</a>
                </div>
            </li>
        </ul>
    </div>

    <div class="table-responsive shadow rounded-bottom" data-simplebar style="height: 545px;">
        <table class="table table-center mb-0">

            <thead>
                <tr>
                    <th class="border-bottom p-3">#</th>
                    <th class="border-bottom p-3">Order Number</th>
                    <th class="border-bottom p-3">Reference</th>
                    <th class="border-bottom p-3">Username</th>
                    <th class="text-center border-bottom p-3">Amount</th>
                    <th class="text-center border-bottom p-3">Channel</th>
                    <th class="text-center border-bottom p-3">Status</th>
                    <th class="text-center border-bottom p-3">Date</th>
                    <th class="text-center border-bottom p-3">Balance Before</th>
                    <th class="text-center border-bottom p-3">Balance After</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $rank = 1;

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                        // status color
                        $statusColor = 'success';
                        if ($row['status'] == 'pending') {
                            $statusColor = 'warning';
                        } elseif ($row['status'] == 'failed') {
                            $statusColor = 'danger';
                        }
                ?>
                <tr>

                    <td class="p-3">
                        <span class="rank-box"><?php echo $rank++; ?></span>
                    </td>

                    <td class="p-3"><?php echo $row['trxid']; ?></td>

                    <td class="p-3">
                        <a href="#" class="text-primary">
                            <?php echo $row['code']; ?>
                        </a>
                    </td>

                    <td class="p-3">
                        <?php echo $row['username']; ?>
                    </td>

                    <td class="text-center p-3">
                        <?php echo $row['currency'] . ' ' . number_format($row['amount'], 2); ?>
                    </td>

                    <td class="text-center p-3">
                        <?php echo $row['initiatedfrom']; ?>
                    </td>

                    <td class="text-center p-3">
                        <div class="badge bg-soft-<?php echo $statusColor; ?> rounded px-3 py-1">
                            <?php echo $row['status']; ?>
                        </div>
                    </td>

                    <td class="text-center p-3">
                        <?php echo $row['date']; ?>
                    </td>

                    <td class="text-center p-3">
                        <?php echo $row['currency'] . ' ' . number_format($row['balancebefore'], 2); ?>
                    </td>

                    <td class="text-center p-3">
                        <?php echo $row['currency'] . ' ' . number_format($row['balanceafter'], 2); ?>
                    </td>

                </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='10' class='text-center p-3'>No transactions found</td></tr>";
                }
                ?>
            </tbody>

        </table>
    </div>
</div>
   


<?php include"inc/footer.php" ?>

                