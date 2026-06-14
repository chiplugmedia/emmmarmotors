<?php

require $_SERVER['DOCUMENT_ROOT']."/invest/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/includes/generalinclude.php";


$ptitle="Transaction History";
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

<!-- TABS -->
<div class="mt-8 flex gap-2 rounded-2xl border border-[#1a3332] bg-[#FEFBEF] p-1 mt-[80px]">

    <button class="tab-btn flex-1 rounded-xl bg-white px-4 py-2 text-sm font-bold text-[#1a3332] shadow" data-target="tab-recharge">
        Recharge
    </button>

    <button class="tab-btn flex-1 rounded-xl px-4 py-2 text-sm font-bold text-gray-600" data-target="tab-withdrawal">
        Withdrawal
    </button>

</div>

<!-- ===================== -->
<!-- RECHARGE TAB -->
<!-- ===================== -->
<div class="tab-content mt-5" id="tab-recharge">

    <div class="overflow-hidden rounded-2xl border border-[#1a3332] bg-[#FEFBEF]">

        <ul class="divide-y divide-gray-100">

            <?php
            $sql = $link->prepare("SELECT * FROM fundwallet WHERE username=? ORDER BY id DESC");
            $sql->bind_param("s", $username);
            $sql->execute();
            $result = $sql->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    $method = htmlspecialchars($row['channel']);
                    $amount = htmlspecialchars($row['amount']);
                    $date   = htmlspecialchars($row['date']);
                    $status = strtolower(trim($row['status']));

                   $icon = ($status == "pending") ? "spinner" :
        (($status == "processing") ? "sync" :
        (($status == "rejected") ? "xmark" :
        (($status == "success" || $status == "successful") ? "check-circle" : "arrow-up")));
            ?>

            <li class="flex items-center justify-between p-4">

                <!-- LEFT -->
                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-red-100 text-red-600">
                        <i class="fa-solid fa-<?php echo $icon; ?>"></i>
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-gray-900">
                            Method: <?php echo $method; ?>
                        </p>

                        <p class="text-xs text-gray-500">
                            <?php echo $date; ?>
                        </p>
                    </div>

                </div>

                <!-- RIGHT -->
                <div class="text-right">

                    <p class="text-sm font-bold text-green-600">
                        <?php echo $dollar . $amount; ?>
                    </p>

                    <span class="mt-1 inline-block rounded-full bg-gray-100 px-2 py-1 text-[10px] font-bold text-gray-600">
                        <?php echo ucfirst($status); ?>
                    </span>

                </div>

            </li>

            <?php
                }
            } else {
                echo '<li class="p-6 text-center text-sm text-gray-500">No recharge records found</li>';
            }
            ?>

        </ul>

    </div>
</div>

<!-- ===================== -->
<!-- WITHDRAWAL TAB -->
<!-- ===================== -->
<div class="tab-content mt-5 hidden" id="tab-withdrawal">

    <div class="overflow-hidden rounded-2xl border border-[#1a3332] bg-[#FEFBEF] shadow-sm">

        <ul class="divide-y divide-gray-100">

            <?php
            $sql = $link->prepare("SELECT * FROM withdrawals WHERE username=? AND type='activity' ORDER BY id DESC");
            $sql->bind_param("s", $username);
            $sql->execute();
            $result = $sql->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    $amount = htmlspecialchars($row['amount']);
                    $date   = htmlspecialchars($row['date']);
                    $status = strtolower(trim($row['status']));

                   $icon = ($status == "pending") ? "spinner" :
        (($status == "processing") ? "sync" :
        (($status == "rejected") ? "xmark" :
        (($status == "success" || $status == "successful") ? "check-circle" : "arrow-up")));
            ?>

            <li class="flex items-center justify-between p-4">

                <!-- LEFT -->
                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-red-100 text-red-600">
                        <i class="fa-solid fa-<?php echo $icon; ?>"></i>
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-gray-900">
                            Withdrawal
                        </p>

                        <p class="text-xs text-gray-500">
                            <?php echo $date; ?>
                        </p>
                    </div>

                </div>

                <!-- RIGHT -->
                <div class="text-right">

                    <p class="text-sm font-bold text-red-600">
                        <?php echo $dollar . $amount; ?>
                    </p>

                    <span class="mt-1 inline-block rounded-full bg-gray-100 px-2 py-1 text-[10px] font-bold text-gray-600">
                        <?php echo ucfirst($status); ?>
                    </span>

                </div>

            </li>

            <?php
                }
            } else {
                echo '<li class="p-6 text-center text-sm text-gray-500">No withdrawal records found</li>';
            }
            ?>

        </ul>

    </div>
</div>

<!-- ===================== -->
<!-- TABS SCRIPT -->
<!-- ===================== -->
<script>
const tabs = document.querySelectorAll('.tab-btn');
const contents = document.querySelectorAll('.tab-content');

tabs.forEach(tab => {
    tab.addEventListener('click', () => {

        tabs.forEach(t => {
            t.classList.remove('bg-white', 'text-[#1a3332]', 'shadow');
            t.classList.add('text-gray-600');
        });

        tab.classList.add('bg-white', 'text-[#1a3332]', 'shadow');
        tab.classList.remove('text-gray-600');

        contents.forEach(c => c.classList.add('hidden'));

        document.getElementById(tab.dataset.target).classList.remove('hidden');
    });
});
</script>


<?php include "inc/footer2.php"?>