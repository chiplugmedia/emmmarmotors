<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="utf-8" />

    <title>Admin - Dashbord</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="" />

    <meta name="keywords"
        content="mtn, glo, airtel, 9mobile, vtu, vtu api, cheapest data, cheapest vtu api, buy cheapest data, buy data, sell data, resellers, electricty bills, cable, subscription" />



    <!-- favicon -->

    <link rel="shortcut icon" href="#">

    <link rel="stylesheet" href="/mysite/sweet/sweet.css">

    <!-- Bootstrap -->

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <!-- simplebar -->

    <link href="assets/css/simplebar.css" rel="stylesheet" type="text/css" />



    <!-- Icons -->

    <link href="assets/css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />

    <link href="assets/css/tabler-icons.min.css" rel="stylesheet" type="text/css" />

    <link href="https://unicons.iconscout.com/release/v3.0.6/css/line.css" rel="stylesheet">

    <!-- Css -->

    <link href="assets/css/style.css" rel="stylesheet" type="text/css" id="theme-opt" />

    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/sweetalert.js"></script>
    <script data-require="jquery@*" data-semver="3.0.0"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
    .small-swal {
        font-size: 14px !important;
        padding: 8px 16px !important;
        max-width: 300px !important;
        border-radius: 8px !important;
        background: #333 !important;
        color: #fff !important;
    }

    .small-swal .swal2-title {
        font-size: 16px !important;
        margin-bottom: 5px !important;
        color: #fff !important;
    }

    .small-swal .swal2-html-container {
        font-size: 14px !important;
        margin: 0 !important;
        color: #ddd !important;
    }
    </style>

</head>



<body>
<div class="page-wrapper landrick-theme toggled">

    <nav id="sidebar" class="sidebar-wrapper">

        <div class="sidebar-content" data-simplebar style="height: calc(100% - 60px);">

            <div class="sidebar-brand">
                <a href="index.php">
                    <img src="#" height="24" width="120" class="logo-light-mode" alt="">
                    <img src="#" height="24" width="120" class="logo-dark-mode" alt="">
                    <span class="sidebar-colored">
                        <img src="#" height="24" alt="">
                    </span>
                </a>
            </div>

            <!-- Main Menu - No Dropdowns -->
            <ul class="sidebar-menu">
                <!-- Dashboard -->
                <li>
                    <a href="dashboard.php">
                        <i class="uil uil-create-dashboard me-2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Users Withdrawals -->
                <li>
                    <a href="act-payout.php">
                        <i class="uil uil-money-withdraw me-2"></i>
                        <span>Users Withdrawals</span>
                    </a>
                </li>

                <!-- Users Deposit Auto -->
                <li>
                    <a href="data-prices.php">
                        <i class="uil uil-arrow-circle-down me-2"></i>
                        <span>Users Deposit Auto</span>
                    </a>
                </li>

                <!-- Users Deposit Manual
                <li>
                    <a href="deposit.php">
                        <i class="uil uil-credit-card me-2"></i>
                        <span>Users Deposit Manual</span>
                    </a>
                </li> -->

                <!-- Add Investment Package -->
                <li>
                    <a href="invest.php">
                        <i class="uil uil-plus-circle me-2"></i>
                        <span>Add Investment Package</span>
                    </a>
                </li>

                <!-- Users Investment Package -->
                <li>
                    <a href="userstasks.php">
                        <i class="uil uil-chart-growth me-2"></i>
                        <span>Users Investment Package</span>
                    </a>
                </li>

                <!-- Add Popup Posts -->
                <li>
                    <a href="add-blog.php">
                        <i class="uil uil-megaphone me-2"></i>
                        <span>Add Popup Posts</span>
                    </a>
                </li>

                <!-- Create Coupons 
                <li>
                    <a href="coupons.php">
                        <i class="uil uil-ticket me-2"></i>
                        <span>Create Coupons</span>
                    </a>
                </li>-->

                <!-- Users Management -->
                <li>
                    <a href="users.php">
                        <i class="uil uil-users-alt me-2"></i>
                        <span>Users Management</span>
                    </a>
                </li>

                <!-- Site Settings -->
                <li>
                    <a href="setting.php">
                        <i class="uil uil-setting me-2"></i>
                        <span>Site Settings</span>
                    </a>
                </li>
            </ul>
            <!-- sidebar-menu -->

        </div>

    </nav>
    <!-- sidebar-wrapper -->

    <!-- Start Page Content -->
    <main class="page-content bg-light">

        <div class="top-header">
            <div class="header-bar d-flex justify-content-between border-bottom">

                <div class="d-flex align-items-center">
                    <a href="#" class="logo-icon me-3">
                        <img src="../images/favicon.png" height="30" class="small" alt="">
                        <span class="big">
                            <img src="../images/favicon.png" height="24" class="logo-light-mode" alt="">
                            <img src="../images/favicon.png" height="24" class="logo-dark-mode" alt="">
                        </span>
                    </a>
                    <a id="close-sidebar" class="btn btn-icon btn-soft-light" href="javascript:void(0)">
                        <i class="ti ti-menu-2"></i>
                    </a>
                    <div class="search-bar p-0 d-none d-md-block ms-2">
                        <div id="search" class="menu-search mb-0">
                            <form role="search" method="get" id="searchform" class="searchform">
                                <div>
                                    <input type="text" class="form-control border rounded" name="s" id="s"
                                        placeholder="Search Keywords...">
                                    <input type="submit" id="searchsubmit" value="Search">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

              <ul class="list-unstyled mb-0">
    <li class="list-inline-item mb-0 ms-1">
        <div class="dropdown dropdown-primary">
            <button type="button" class="btn btn-soft-light dropdown-toggle p-0"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="/invest/mysite/bandogreen.jfif" class="avatar avatar-ex-small rounded" alt="">
            </button>
            <div class="dropdown-menu dd-menu dropdown-menu-end shadow border-0 mt-3 py-3"
                style="min-width: 200px;">
                <a class="dropdown-item d-flex align-items-center pb-3" href="setting">
                    <img src="/invest/mysite/bandogreen.jfif" class="avatar avatar-md-sm rounded-circle border shadow" alt="">
                    <div class="flex-1 ms-2">
                        <span class="d-block"><?php echo $fullname?></span>
                        <small class="text-muted"><?php echo $username?></small>
                    </div>
                </a>
                <a class="dropdown-item" href="dashboard.php">
                    <span class="mb-0 d-inline-block me-1"><i class="ti ti-home"></i></span>
                    Dashboard
                </a>
                <a class="dropdown-item" href="setting.php">
                    <span class="mb-0 d-inline-block me-1"><i class="ti ti-settings"></i></span>
                    Account Settings
                </a>
                <div class="dropdown-divider border-top"></div>
                <a class="dropdown-item" href="logout.php">
                    <span class="mb-0 d-inline-block me-1"><i class="ti ti-logout"></i></span>
                    Logout
                </a>
            </div>
        </div>
    </li>
</ul>
            </div>
        </div>