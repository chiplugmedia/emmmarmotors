<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require $_SERVER['DOCUMENT_ROOT']."/emmmarmotors/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/actions/account-settings.php";



$ptitle="Transaction Pin";
include "inc/header2.php" ?>


<div class="pt-20">

    <!-- HEADER -->
    <div class="fixed top-0 left-1/2 z-50 w-full -translate-x-1/2">

        <div class="flex items-center justify-between
                    border border-white/40 dark:border-slate-700/50
                    bg-white/70 dark:bg-slate-900/70
                   
                    px-4 py-3">

            <!-- Back Button -->
            <div class="w-10">

                <a href="javascript:history.back()"
                   class="flex h-9 w-9 items-center justify-center rounded-full
                          bg-white/80 dark:bg-slate-800/80
                          text-[#2f4f4e] dark:text-yellow-400
                          backdrop-blur-md
                          transition-all duration-300
                          hover:scale-105
                          hover:bg-white
                          dark:hover:bg-slate-700">

                    <i class="bi bi-chevron-left text-sm"></i>

                </a>

            </div>

          
            <!-- Right Spacer -->
            <div class="w-10"></div>

        </div>

    </div>

</div>

<section class="max-w-4xl mx-auto px-4 space-y-6">
  <!-- Notice -->
    <div class="mb-2">
     <h3 class="font-bold text-slate-900 dark:text-white text-xl">
Set transaction pin</h3>
     
    </div>

 <div class="rounded-2xl space-y-5">
 <?php echo $genMsg?>
  <form action="" method="post" class="space-y-5">

    
    <!-- Transaction -->
    <div>
      <label class="block text-sm font-medium text-gray-600 mb-2">
        Transaction Pin (4 digits)
      </label>

      <div class="relative">
       <input
        type="text"
        name="acctNum"
        placeholder="Enter Transaction Pin"
       class="w-full px-4 py-3
                      bg-white dark:bg-slate-800
                      text-slate-900 dark:text-white
                      border border-slate-300 dark:border-slate-700
                      rounded-md
                      focus:ring-2 focus:ring-[#052da7]
                      focus:outline-none
                      placeholder:text-slate-400 dark:placeholder:text-slate-500"
      >

      </div>

    </div>

    <!-- Confirm Transaction Pin -->
    <div>
      <label class="block text-sm font-medium text-gray-600 mb-2">
        Confirm Transaction Pin
      </label>

      <div class="relative">
      <input
        type="text"
        name="acctName"
        placeholder="Enter Confirm Transaction Pin"
        class="w-full px-4 py-3
                      bg-white dark:bg-slate-800
                      text-slate-900 dark:text-white
                      border border-slate-300 dark:border-slate-700
                      rounded-md
                      focus:ring-2 focus:ring-[#052da7]
                      focus:outline-none
                      placeholder:text-slate-400 dark:placeholder:text-slate-500"
      >
      </div>

    </div>

    <!-- SUBMIT -->
    <button
      type="submit"
      name="saveBank"
      class="flex w-full items-center justify-center
                     rounded-xl bg-[#052da7]
                     py-3 font-semibold text-white
                     transition-all duration-300
                     hover:bg-[#041f74]
                     active:scale-95"
    >
       Request Code
    </button>

  </form>
  </div>



</section>

    <?php include "inc/footer2.php" ?>