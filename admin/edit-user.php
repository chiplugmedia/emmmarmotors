<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require $_SERVER['DOCUMENT_ROOT']."/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/actions/edit-user.php";

// Ensure database connection ($link) is already established before this code

if (!isset($_GET['code']) || empty($_GET['code'])) {
    header("Location: $stream/user/admin/users.php");
    exit;
}

$code = $_GET['code'];

// Prepare and execute query safely
$sql = $link->prepare("SELECT * FROM users WHERE code = ?");
$sql->bind_param("s", $code);
$sql->execute();
$result = $sql->get_result();

// Initialize variables
$username = $funds = $totalrefearnings = "";

// Check if user exists
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $username = $row['username'];
    $funds = $row['funds'];
    $totalrefearnings = $row['totalrefearnings'];
} else {
    // If no user found, redirect or handle error
    header("Location: $stream/user/admin/users.php");
    exit;
}




include"inc/header.php" ;

?>



                <div class="container-fluid">

                    <div class="layout-specing">
                        <br>
                        <?php echo $genMsg?>
                        <div class="d-md-flex justify-content-between align-items-center">

                            <h5 class="mb-0">Users</h5>



                            <nav aria-label="breadcrumb" class="d-inline-block mt-2 mt-sm-0">

                                <ul class="breadcrumb bg-transparent rounded mb-0 p-0">

                                    <li class="breadcrumb-item text-capitalize"><a href="dashboard.php"><?php echo $sitename ?></a></li>

                                    <li class="breadcrumb-item text-capitalize"><a href="#">Pages</a></li>

                                    <li class="breadcrumb-item text-capitalize active" aria-current="page">Users </li>

                                </ul>

                            </nav>

                        </div>

                    

                        <div class="row">

                            <div class="col-md-7 col-lg-8 mt-4">

                                <div class="card rounded shadow p-4 border-0">

                                    <h4 class="mb-3"> Edit User</h4>

                                    <form method="POST">

                                        <div class="row g-3">

                                        <div class="col-md-5">

                                            <label for="username" class="form-label">Phone Number</label>

                                                <input type="text" class="form-control" id="username" placeholder="" name="username" value="<?php echo $username?>" readonly>

                                                

                                            </div>

                                            

                                            <div class="col-md-5">

                                                <label for="wallet-bal" class="form-label">Balance</label>

                                                <input type="text" class="form-control" id="wallet-bal" placeholder=""  name="funds" value="<?php echo $funds?>">

                                                <div class="invalid-feedback">

                                                    Valid Number  .

                                                </div>

                                            </div>
<input type="hidden" class="form-control" id="ref" placeholder=""  name="totalrefearnings" value="<?php echo $totalrefearnings?>">
                                            <!--<div class="col-md-5">-->

                                            <!--    <label for="ref" class="form-label">Withdraw Balance</label>-->

                                            <!--    <input type="text" class="form-control" id="ref" placeholder=""  name="totalrefearnings" value="<?php echo $totalrefearnings?>">-->

                                            <!--    <div class="invalid-feedback">-->

                                            <!--        Valid Number  .-->

                                            <!--    </div>-->

                                            <!--</div>-->
                                            
                                            
                                            

                                        </div>

        

        <br>

                                        <button class="w-100 btn btn-primary" type="submit" name="update">Save</button>

                                    </form>

                                </div>

                            </div><!--end col-->

                        </div><!--end row-->

                    </div>

                </div><!--end container-->



<?php include"inc/footer.php" ?>

                