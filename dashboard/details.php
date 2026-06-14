<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require $_SERVER['DOCUMENT_ROOT']."/invest/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/includes/generalinclude.php";

$ptitle="Team Details";
include "inc/header2.php" ?>


<div class="pt-15">
    <div class="fixed left-1/2 top-0 z-50 flex w-full max-w-[590px] -translate-x-1/2 items-center justify-between 
                rounded-b-3xl bg-white/70 backdrop-blur-md shadow-lg border-gray-200 px-4 py-3 mb-5">

        <!-- Back Button -->
        <div class="flex min-w-[40px] items-center gap-2">
            <a href="javascript:history.back()"
               class="flex h-8 w-8 items-center justify-center rounded-full bg-white text-white shadow-sm transition hover:bg-gray-100">

                <i class="bi bi-chevron-left text-sm text-[#ad050b]"></i>

            </a>
        </div>

        <!-- Title -->
        <h1 class="text-md font-semibold text-gray-800">
            <?php echo $ptitle?>
        </h1>

        <!-- Right Side -->
        <div class="flex min-w-[40px] justify-end"></div>

    </div>
</div>
    
    <?php
if (!isset($link) || !$link) {
    die('Database connection not established.');
}

if (!isset($_GET['reference']) || empty($_GET['reference'])) {
    echo 'Reference not specified.';
    exit();
}

$reference = trim($_GET['reference']);

$sql = "SELECT * FROM referrals WHERE reference = ?";
$stmt = mysqli_prepare($link, $sql);

if (!$stmt) {
    echo 'Failed to prepare SQL statement.';
    exit();
}

mysqli_stmt_bind_param($stmt, "s", $reference);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    echo '<p class="mt-[80px] text-center text-gray-400">No referral found for this reference.</p>';
    exit();
}

$row = mysqli_fetch_assoc($result);

switch ($row['reference']) {
    case '1': $referenceLabel = 'Referral Commission'; break;
    case '2': $referenceLabel = '2nd Level'; break;
    case '3': $referenceLabel = '3rd Level'; break;
    default: $referenceLabel = 'Unknown';
}
?>

<!-- ================= MAIN WRAPPER ================= -->
<div class="mx-auto mt-[80px] max-w-6xl px-4 py-6">

  <!-- CARD -->
  <div class="overflow-hidden rounded-2xl border border-[#1a3332] bg-[#FEFBEF]">

    <!-- HEADER -->
    <div class="border-b border-gray-100 px-5 py-4">
      <h2 class="text-lg font-bold text-gray-900">
        <?= htmlspecialchars($referenceLabel); ?>
      </h2>
    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto">

      <table class="min-w-full text-left text-sm">

        <!-- HEAD -->
        <thead class="bg-[#1a3332] text-xs uppercase tracking-wider text-[#fff]">
          <tr>
            <th class="px-5 py-3">Phone</th>
            <th class="px-5 py-3 text-center">Investments</th>
            <th class="px-5 py-3">Total Invested</th>
            <th class="px-5 py-3">Join Date</th>
            <th class="px-5 py-3">Status</th>
          </tr>
        </thead>

        <!-- BODY -->
        <tbody class="divide-y divide-gray-100">

        <?php
        if (!isset($myuserCode)) {
            echo '<tr><td colspan="5" class="px-5 py-6 text-center text-gray-400">User code not set.</td></tr>';
        } else {

            $sql1 = $link->prepare("SELECT * FROM referrals WHERE refcode = ? AND reference = ? ORDER BY id DESC");
            $sql1->bind_param("ss", $myuserCode, $reference);
            $sql1->execute();
            $result1 = $sql1->get_result();

            if ($result1->num_rows > 0) {

                while ($row1 = $result1->fetch_assoc()) {

                    $code1 = $row1['code'];
                    $formattedDate = (new DateTime($row1['date']))->format('jS F, Y');

                    $stmt1 = $link->prepare("SELECT username FROM users WHERE code = ?");
                    $stmt1->bind_param("s", $code1);
                    $stmt1->execute();
                    $res1 = $stmt1->get_result();

                    if ($res1->num_rows > 0) {

                        $username1 = $res1->fetch_assoc()['username'];

                        $invSql = $link->prepare("
                            SELECT 
                                MAX(status) AS status,
                                COUNT(*) AS timesInvested,
                                SUM(price) AS totalInvest
                            FROM user_investments
                            WHERE username = ?
                        ");
                        $invSql->bind_param("s", $username1);
                        $invSql->execute();
                        $invRow = $invSql->get_result()->fetch_assoc();

                        $timesInvested = $invRow['timesInvested'] ?? 0;
                        $totalInvest   = $invRow['totalInvest'] ?? 0;
                        $status        = $invRow['status'] ?? '';

                        if ($status === 'active') {
                            $statusLabel = '<span class="inline-flex items-center rounded-full bg-red-50 text-red-600 border border-red-200 px-3 py-1 text-xs font-semibold">Invested</span>';
                        } elseif ($status === 'expired') {
                            $statusLabel = '<span class="inline-flex items-center rounded-full bg-yellow-50 text-yellow-600 border border-yellow-200 px-3 py-1 text-xs font-semibold">Expired</span>';
                        } else {
                            $statusLabel = '<span class="inline-flex items-center rounded-full bg-gray-50 text-gray-500 border border-gray-200 px-3 py-1 text-xs font-semibold">Not Invested</span>';
                        }

                        $masked = substr($username1, 0, 4) . '****' . substr($username1, -3);
        ?>

        <!-- ROW -->
        <tr class="hover:bg-gray-50 transition">

          <td class="px-5 py-3 font-medium text-gray-900">
            <?= htmlspecialchars($masked) ?>
          </td>

          <td class="px-5 py-3 text-center text-gray-700">
            <?= (int)$timesInvested ?>
          </td>

          <td class="px-5 py-3 font-semibold text-[#1a3332]">
            <?= htmlspecialchars($dollar . number_format((float)$totalInvest, 2)) ?>
          </td>

          <td class="px-5 py-3 text-gray-500">
            <?= htmlspecialchars($formattedDate) ?>
          </td>

          <td class="px-5 py-3">
            <?= $statusLabel ?>
          </td>

        </tr>

        <?php
                    }
                }
            } else {
                echo '<tr><td colspan="5" class="px-5 py-6 text-center text-gray-400">No referrals yet.</td></tr>';
            }
        }
        ?>

        </tbody>
      </table>
    </div>
  </div>
</div>


<?php include "inc/footer2.php" ?>