<?php 
require $_SERVER['DOCUMENT_ROOT']."/invest/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/actions/buyprod.php";

$ptitle="Product Details";
include "inc/header2.php" ;



?>

<div class="pt-15">
  <div class="fixed left-1/2 top-0 z-50 flex w-full max-w-[590px] -translate-x-1/2 items-center justify-between
              rounded-b-3xl bg-[#fdf8e5]/80 backdrop-blur-2xl shadow-lg border border-white/20 px-4 py-3">

    <!-- Back Button -->
    <div class="flex min-w-[40px] items-center gap-2">
      <a href="javascript:history.back()"
         class="flex h-8 w-8 items-center justify-center rounded-full bg-white shadow-sm transition hover:bg-[#2f4f4e]/10">

        <i class="bi bi-chevron-left text-sm text-[#2f4f4e]"></i>

      </a>
    </div>

    <!-- Title -->
    <h1 class="text-md font-semibold text-[#2f4f4e]">
      <?php echo $ptitle?>
    </h1>

    <!-- Right Side -->
    <div class="flex min-w-[40px] justify-end"></div>

  </div>
</div>


    


<?php
// Ensure database connection exists
if (!isset($link) || !$link) {
    die('Database connection not established.');
}

if (isset($_GET['reference']) && !empty($_GET['reference'])) {
    $reference = trim($_GET['reference']);
} else {
    echo '<p class="p-4 text-sm font-semibold text-red-500">Reference not specified.</p>';
    exit();
}

$sql = "SELECT * FROM investment_plans WHERE reference = ?";
$stmt = mysqli_prepare($link, $sql);

if ($stmt) {

    mysqli_stmt_bind_param($stmt, "s", $reference);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);

        $id       = htmlspecialchars($row['id']);
        $title    = htmlspecialchars($row['title']);
        $price    = htmlspecialchars($row['price']);
        $daily    = htmlspecialchars($row['daily']);
        $image    = htmlspecialchars($row['image']);
        $duration = htmlspecialchars($row['duration']);
        $ref_code = htmlspecialchars($row['reference']);

        $total_income = $daily * $duration;
?>

<!-- ================= UI ================= -->
<div class="w-full space-y-5 p-4 mt-[80px]">
<?php echo $genMsg?>
    <!-- IMAGE -->
    <div class="overflow-hidden rounded-2xl border border-gray-100 shadow-sm">
        <img
            src="/dashboard/img/invest/<?php echo $image; ?>"
            alt="<?php echo $title; ?>"
            class="h-64 w-full object-contain p-4"
        >
    </div>

    <!-- PRICE + TOTAL -->
    <div class="grid grid-cols-2 gap-4">

        <div class="rounded-2xl border border-[#1a3332] bg-[#FEFBEF] p-4 shadow-sm">
            <p class="text-xs font-bold uppercase tracking-wider text-gray-500">Price</p>
            <p class="mt-1 text-2xl font-black text-gray-900">
                ₦<?php echo number_format($price); ?>
            </p>
        </div>

        <div class="rounded-2xl border border-[#1a3332] bg-[#FEFBEF] p-4 shadow-sm text-right">
            <p class="text-xs font-bold uppercase tracking-wider text-gray-500">Total Income</p>
            <p class="mt-1 text-2xl font-black text-[#1a3332]">
                ₦<?php echo number_format($total_income); ?>
            </p>
        </div>

    </div>

    <!-- DETAILS -->
    <div class="rounded-2xl border border-[#1a3332] bg-[#FEFBEF]e p-4 shadow-sm space-y-3 text-sm">

        <div class="flex justify-between border-b border-gray-100 pb-2">
            <span class="text-gray-500">Validity Period</span>
            <span class="font-semibold text-gray-900">
                <?php echo $duration; ?> Days
            </span>
        </div>

        <div class="flex justify-between border-b border-gray-100 pb-2">
            <span class="text-gray-500">Daily Income</span>
            <span class="font-bold text-[#1a3332]">
                ₦<?php echo number_format($daily); ?>
            </span>
        </div>

        <!-- <div class="flex justify-between">
            <span class="text-gray-500">Purchase</span>
            <span class="font-semibold text-gray-900">Today</span>
        </div> -->

    </div>

    <!-- CONFIRM BUTTON -->
    <form method="post">
        <input type="hidden" name="reference" value="<?php echo $ref_code; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <button
            type="submit"
            name="investin"
            class="group relative flex w-full items-center justify-center gap-2 rounded-md bg-[#2F4F4E] py-3.5 font-semibold text-white transition-all duration-300
         hover:-translate-y-1
         hover:rotate-[-2deg]
         active:scale-95"
        >
            Confirm Investment
        </button>
    </form>

    <!-- DESCRIPTION -->
    <div class="space-y-2 pt-2">

        <h3 class="border-b border-gray-100 pb-2 text-lg font-bold text-gray-900">
            Details
        </h3>

        <p class="text-sm text-gray-600">
            1. <?php echo $title; ?> daily income is
            <span class="font-bold text-[#1a3332]">₦<?php echo number_format($daily); ?></span>,
            total income is
            <span class="font-bold text-[#1a3332]">₦<?php echo number_format($total_income); ?></span>.
        </p>

    </div>

</div>
<!-- ================= END UI ================= -->

<?php
    } else {
        echo '<p class="p-4 text-sm font-semibold text-red-500">Invalid reference ID.</p>';
    }

} else {
    echo '<p class="p-4 text-sm font-semibold text-red-500">Database query failed.</p>';
}
?>

<?php include "inc/footer2.php" ?>