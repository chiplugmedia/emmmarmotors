<?php 
require $_SERVER['DOCUMENT_ROOT']."/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/includes/generalinclude.php";
$amount="";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/actions/tasks.php";


$sql = $link->prepare("SELECT COALESCE(SUM(price), 0) AS totalactiveI FROM user_investments WHERE status = 'active'");
$sql->execute();
$result = $sql->get_result();
$totalactiveI = $result->fetch_assoc()['totalactiveI'];


$sql = $link->prepare("SELECT COALESCE(SUM(price), 0) AS totalexpiredI FROM user_investments WHERE status = 'expired'");
$sql->execute();
$result = $sql->get_result();
$totalexpiredI = $result->fetch_assoc()['totalexpiredI'];


include"inc/header.php" ;

?>






<div class="container-fluid">

                    <div class="layout-specing">

                        <div class="d-md-flex justify-content-between align-items-center">

                            <h5 class="mb-0">Users Investments</h5>



                            <nav aria-label="breadcrumb" class="d-inline-block mt-2 mt-sm-0">

                                <ul class="breadcrumb bg-transparent rounded mb-0 p-0">

                                    

                                    <li class="breadcrumb-item text-capitalize"><a href="profile">Users Investments </a></li>

                                    <li class="breadcrumb-item text-capitalize active" aria-current="page"> Home</li>

                                </ul>

                            </nav>

                        </div>



<div class="col mt-4">

                                <a href="#!" class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">

                                    <div class="d-flex align-items-center">

                                        <div class="icon text-center rounded-pill">

                                            <i class="uil uil-wallet fs-1 mb-0"></i>

                                        </div>

                                        <div class="flex-1 ms-3">

                                                <h6 class="mb-0 text-muted">Total Active Investments</h6>

                                            <p class="fs-5 text-dark fw-bold mb-0"><span>₦<?php echo number_format($totalactiveI, 2)?></span></p>

                                        </div>

                                    </div>



                                    <span class="text-primary"><i class="uil uil-wallet"></i></span>

                                </a>

                            </div><!--end col-->
                            
                            
                            <div class="col mt-4">

                                <a href="#!" class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">

                                    <div class="d-flex align-items-center">

                                        <div class="icon text-center rounded-pill">

                                            <i class="uil uil-wallet fs-1 mb-0"></i>

                                        </div>

                                        <div class="flex-1 ms-3">

                                                <h6 class="mb-0 text-muted">Total Expired Investments</h6>

                                            <p class="fs-5 text-dark fw-bold mb-0"><span>₦<?php echo number_format($totalexpiredI, 2)?></span></p>

                                        </div>

                                    </div>



                                    <span class="text-primary"><i class="uil uil-wallet"></i></span>

                                </a>

                            </div><!--end col-->

    <?php echo $genMsg?>
<!-- =========================
     PAGINATION SETUP
========================= -->
<?php
$limit = 10;

// current page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

// offset
$offset = ($page - 1) * $limit;

// total records
$totalQuery = $link->query("SELECT COUNT(*) AS total FROM user_investments");
$totalRow = $totalQuery->fetch_assoc();
$totalRecords = $totalRow['total'];

$totalPages = ceil($totalRecords / $limit);
?>


<!-- =========================
     USER INVESTMENTS TABLE
========================= -->
<div class="col mt-4 pt-2" id="tables">
    <div class="component-wrapper rounded shadow">

        <!-- Header -->
        <div class="p-4 border-bottom">
            <h4 class="title mb-0">Users Investments</h4>
        </div>

        <!-- Table -->
        <div class="p-4">
            <div class="table-responsive shadow rounded">

                <table class="table mb-0 table-center">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Package</th>
                            <th>Amount</th>
                            <th>Daily Income</th>
                            <th>Days</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $sql = $link->prepare("
                            SELECT * 
                            FROM user_investments 
                            ORDER BY id DESC 
                            LIMIT ? OFFSET ?
                        ");
                        $sql->bind_param("ii", $limit, $offset);
                        $sql->execute();
                        $result = $sql->get_result();

                        $numrow = $result->num_rows;
                        $idCount = 0;

                        if ($numrow > 0) {
                            while ($row = $result->fetch_assoc()) {

                                $idCount++;

                                $username = $row['username'];
                                $title    = $row['title'];
                                $amount   = $row['price'];
                                $daily    = $row['daily'];
                                $duration = $row['duration'];
                                $status   = $row['status'];
                                $date     = $row['date'];

                                $statusColor = "";

                                if ($status == "expired") {
                                    $statusColor = "danger";
                                } elseif ($status == "active") {
                                    $statusColor = "success";
                                }
                        ?>
                        <tr>

                            <!-- Numbering (fixed across pages) -->
                            <td>
                                <span class="rank-box">
                                    <?php echo $offset + $idCount; ?>
                                </span>
                            </td>

                            <td><?php echo ucwords($username); ?></td>
                            <td><?php echo ucwords($title); ?></td>
                            <td>₦<?php echo $amount; ?></td>
                            <td>₦<?php echo $daily; ?></td>
                            <td><?php echo $duration; ?> Days</td>

                            <td>
                                <div class="badge bg-soft-<?php echo $statusColor; ?> rounded px-3 py-1">
                                    <?php echo $status; ?>
                                </div>
                            </td>

                            <td><?php echo $date; ?></td>

                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>

                </table>

            </div>

            <!-- =========================
                 PAGINATION BUTTONS
            ========================== -->
            <div class="d-flex justify-content-between align-items-center mt-3">

                <!-- Previous -->
                <div>
                    <?php if ($page > 1): ?>
                        <a href="?page=<?php echo $page - 1; ?>#tables"
                           class="btn btn-sm btn-primary">
                            Previous
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Page Info -->
                <div class="text-muted">
                    Page <?php echo $page; ?> of <?php echo $totalPages; ?>
                </div>

                <!-- Next -->
                <div>
                    <?php if ($page < $totalPages): ?>
                        <a href="?page=<?php echo $page + 1; ?>#tables"
                           class="btn btn-sm btn-primary">
                            Next
                        </a>
                    <?php endif; ?>
                </div>

            </div>

        </div>
    </div>
</div>

<!-- ... (previous HTML code) -->

<script>
    $(".completePost").on("click", function(){
        let id = $(this).closest("tr").find(".id").val();
        postAction(id, "completePost");
        // Update the status to "Completed" immediately
        $(this).closest("tr").find(".status").text("Completed");
    })

    // ... (similar event listener for other actions)

    function postAction(id, action){
        let form = document.createElement('form');
        let input = document.createElement('input');
        let inputID = document.createElement('input');
        let body = document.querySelector('body');
        form.method = "POST";
        input.type = "hidden";
        input.value = action;
        input.name = action;

        inputID.type = "hidden";
        inputID.value = id;
        inputID.name = "id";

        form.appendChild(inputID);
        form.appendChild(input);
        body.appendChild(form);
        form.submit();
    }
</script>


                <?php include"inc/footer.php" ?>