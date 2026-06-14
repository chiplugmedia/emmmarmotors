<?php 
require $_SERVER['DOCUMENT_ROOT']."/invest/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/includes/generalinclude.php";

$ptitle="Income History";
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
       <div class="col-span-1 mt-[80px] mb-[80px]">

    <div class="overflow-hidden rounded-2xl border border-[#1a3332] bg-[#FEFBEF] transition">


        <!-- LIST -->
        <ul class="divide-y divide-gray-100">

            <?php
            $sql = $link->prepare("SELECT * FROM userearnings WHERE username=? ORDER BY id DESC");
            $sql->bind_param("s", $username);
            $sql->execute();
            $result = $sql->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    $type = $row['type'];
                    $amount = $row['amount'];
                    $date = $row['date'];

                    $formattedDate = (new DateTime($date))->format('M j, Y g:i A');

                    $symbol = "₦";
            ?>

                <li class="flex items-center justify-between p-4">

                    <!-- LEFT SIDE -->
                    <div class="flex items-center gap-3">

                        <!-- ICON -->
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-green-100 text-[#1a3332]">
                            <i class="ri-arrow-right-down-line text-sm"></i>
                        </div>

                        <!-- TEXT -->
                        <div>
                            <div class="text-sm font-semibold text-gray-900">
                                <?= htmlspecialchars($type) ?>
                            </div>

                            <div class="text-xs text-gray-500">
                                <?= htmlspecialchars($formattedDate) ?>
                            </div>
                        </div>

                    </div>

                    <!-- AMOUNT -->
                    <span class="text-sm font-bold text-green-600">
                        <?= $symbol ?> <?= number_format((float)$amount, 2) ?>
                    </span>

                </li>

            <?php
                }
            } else {
                echo '<li class="py-8 text-center text-sm text-gray-500">No earnings found.</li>';
            }
            ?>

        </ul>

    </div>

</div>

<?php include "inc/footer2.php" ?>