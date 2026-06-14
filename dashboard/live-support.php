<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require $_SERVER['DOCUMENT_ROOT']."/invest/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/actions/account-settings.php";



$ptitle="Live Support";
include "inc/header2.php" ?>


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



    <?php include "inc/footer2.php" ?>