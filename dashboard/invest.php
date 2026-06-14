<?php 
require $_SERVER['DOCUMENT_ROOT']."/invest/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/actions/buyprod.php";

$ptitle="Product";
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

<strong><?php echo $genMsg?></strong>

<!-- ===== CONTRACT SECTIONS ===== -->
<div class="w-full mt-[80px] mb-[120px]">
 <?php
    $levels = ['Basic', 'Quadro', 'Plant'];

    foreach ($levels as $index => $level) {
    ?>

    <!-- LEVEL GRID -->
    <div
        id="level-<?php echo strtolower($level); ?>"
        class="contracts-grid grid grid-cols-1 sm:grid-cols-2 gap-6 xl:gap-8 <?php echo $index === 0 ? '' : 'hidden'; ?>"
    >

        <?php
        $sql = $link->prepare("SELECT * FROM investment_plans WHERE level=? ORDER BY CAST(price AS UNSIGNED) ASC");
        $sql->bind_param("s", $level);
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                $title     = htmlspecialchars($row['title']);
                $price     = htmlspecialchars($row['price']);
                $daily     = htmlspecialchars($row['daily']);
                $image     = htmlspecialchars($row['image']);
                $duration  = htmlspecialchars($row['duration']);
                $reference = htmlspecialchars($row['reference']);

                $total_income = $daily * $duration;
        ?>

        <!-- CARD -->
        <div class="group flex flex-col overflow-hidden rounded-2xl  border border-[#1a3332] bg-[#FEFBEF] transition duration-300">

            <!-- IMAGE -->
            <div class="relative flex h-40 items-center justify-center bg-gray-50">
                <div class="absolute inset-0 bg-green-500/5 blur-2xl"></div>

                <img
                    src="/dashboard/img/invest/<?php echo $image; ?>"
                    alt="<?php echo $title; ?>"
                    class="relative z-10 h-full object-contain p-4 transition group-hover:scale-105"
                >
            </div>

            <!-- BODY -->
            <div class="flex-1 p-5">

                <h3 class="mb-4 text-center text-lg font-bold text-gray-900">
                    <?php echo $title; ?>
                </h3>

                <div class="space-y-3 text-sm">

                    <div class="flex justify-between">
                        <span class="text-gray-500">Price</span>
                        <span class="font-semibold text-gray-900">₦<?php echo number_format($price); ?></span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-500">Period</span>
                        <span class="font-semibold text-gray-900"><?php echo $duration; ?> days</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-500">Daily Earning</span>
                        <span class="font-semibold text-gray-900">₦<?php echo number_format($daily); ?></span>
                    </div>

                    <div class="flex justify-between border-t border-gray-100 pt-2">
                        <span class="font-medium text-gray-700">Total Earning</span>
                        <span class="font-bold text-[#2F4F4E]">₦<?php echo number_format($total_income); ?></span>
                    </div>

                </div>
            </div>

            <!-- BUTTON -->
            <a
                href="/invest/dashboard/invest-details?reference=<?php echo $reference; ?>"
                class="group relative flex w-full items-center justify-center gap-2 rounded-md bg-[#2F4F4E] py-3.5 font-semibold text-white transition-all duration-300
         hover:-translate-y-1
         hover:rotate-[-2deg]
         active:scale-95"
            >
                View Plan
            </a>

        </div>

        <?php
            }
        } else {
            echo "<p class='col-span-full text-center text-sm text-gray-500'>No plans found for $level.</p>";
        }
        ?>

    </div>

    <?php } ?>


</div>


<?php include "inc/footer2.php" ?>