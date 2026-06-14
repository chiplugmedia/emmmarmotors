<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require $_SERVER['DOCUMENT_ROOT']."/invest/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/actions/account-settings.php";



$ptitle="Payout Settings";
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

<section class="max-w-4xl mx-auto px-4 mt-6 space-y-6 mt-[80px]">

 <div class="rounded-2xl p-5 space-y-5">
 <?php echo $genMsg?>
  <form action="" method="post" class="space-y-5">

    <!-- BANK SELECT -->
    <div>
      <label class="block text-sm font-medium text-gray-600 mb-2">
        Select Bank
      </label>

      <select
        name="bankName"
        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-[#FEFBEF] text-gray-700
               focus:outline-none focus:ring-2 focus:ring-[#2F4F4E] focus:border-[#2F4F4E] transition"
      >
        <option disabled selected>Select Bank</option>

        <?php
          $sql = $link->prepare("SELECT * FROM banks");
          $sql->execute();
          $result = $sql->get_result();

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $bank = $row['bankname'];
              $code = $row['bankcode'];
              $codeBank = $code . "_" . $bank;

              $selected = ($bankName == $bank) ? "selected" : "";
              echo "<option value='$codeBank' $selected>$bank</option>";
            }
          }
        ?>
      </select>
    </div>

    
    <!-- AMOUNT INPUT -->
    <div>
      <label class="block text-sm font-medium text-gray-600 mb-2">
        Account Number
      </label>

      <div class="relative">
       <input
        type="text"
        name="acctNum"
        value="<?php echo $acctNum; ?>"
        placeholder="Enter account number"
       class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-[#FEFBEF] text-gray-700
               focus:outline-none focus:ring-2 focus:ring-[#2F4F4E] focus:border-[#2F4F4E] transition"
      >

      </div>

    </div>

    <!-- BREAKDOWN -->
    <div>
      <label class="block text-sm font-medium text-gray-600 mb-2">
         Account Name
      </label>

      <div class="relative">
      <input
        type="text"
        name="acctName"
        value="<?php echo $acctName; ?>"
        placeholder="Enter account name"
        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-[#FEFBEF] text-gray-700
               focus:outline-none focus:ring-2 focus:ring-[#2F4F4E] focus:border-[#2F4F4E] transition"
      >
      </div>

    </div>

    <!-- SUBMIT -->
    <button
      type="submit"
      name="saveBank"
      class="group relative flex w-full items-center justify-center gap-2 rounded-md bg-[#2F4F4E] py-3.5 font-semibold text-white transition-all duration-300
         hover:-translate-y-1
         hover:rotate-[-2deg]
         active:scale-95"
    >
       Update Details
    </button>

  </form>
  </div>
</section>

    <?php include "inc/footer2.php" ?>