<?php
require $_SERVER['DOCUMENT_ROOT']."/emmmarmotors/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/includes/generalinclude.php";



$ptitle="Notifications";
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


<section class="py-6">

  <div class="max-w-[590px] mx-auto px-4">

    <!-- Header -->
    <div class="mb-6">
      <h1 class="text-2xl font-bold text-slate-900 dark:text-white">
        Notifications
      </h1>
      <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
        Stay updated with your latest account activities.
      </p>
    </div>

    <!-- Notification List -->
    <div class="space-y-4">

      <!-- Notification Item -->
      <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-4 shadow-sm">
        <div class="flex items-start justify-between gap-3">
          <div>
            <h3 class="font-semibold text-slate-900 dark:text-white">
              Welcome Bonus Received
            </h3>
            <p class="text-sm text-slate-600 dark:text-slate-300 mt-1">
              Your welcome bonus of ₦500 has been credited to your account successfully.
            </p>
            <p class="text-xs text-slate-400 mt-2">
              Today • 10:30 AM
            </p>
          </div>

          <span class="h-3 w-3 rounded-full bg-green-500 mt-1"></span>
        </div>
      </div>

      <!-- Notification Item -->
      <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-4 shadow-sm">
        <div class="flex items-start justify-between gap-3">
          <div>
            <h3 class="font-semibold text-slate-900 dark:text-white">
              Withdrawal Processed
            </h3>
            <p class="text-sm text-slate-600 dark:text-slate-300 mt-1">
              Your withdrawal request has been approved and sent for payment.
            </p>
            <p class="text-xs text-slate-400 mt-2">
              Yesterday • 04:15 PM
            </p>
          </div>

          <span class="h-3 w-3 rounded-full bg-blue-500 mt-1"></span>
        </div>
      </div>

      <!-- Notification Item -->
      <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-4 shadow-sm">
        <div class="flex items-start justify-between gap-3">
          <div>
            <h3 class="font-semibold text-slate-900 dark:text-white">
              Referral Bonus Earned
            </h3>
            <p class="text-sm text-slate-600 dark:text-slate-300 mt-1">
              You earned ₦1,600 from a successful referral registration.
            </p>
            <p class="text-xs text-slate-400 mt-2">
              2 days ago
            </p>
          </div>

          <span class="h-3 w-3 rounded-full bg-purple-500 mt-1"></span>
        </div>
      </div>

      <!-- Notification Item -->
      <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-4 shadow-sm">
        <div class="flex items-start justify-between gap-3">
          <div>
            <h3 class="font-semibold text-slate-900 dark:text-white">
              Daily Reward Claimed
            </h3>
            <p class="text-sm text-slate-600 dark:text-slate-300 mt-1">
              Your daily reward has been successfully added to your balance.
            </p>
            <p class="text-xs text-slate-400 mt-2">
              3 days ago
            </p>
          </div>

          <span class="h-3 w-3 rounded-full bg-amber-500 mt-1"></span>
        </div>
      </div>

    </div>

    <!-- Empty State (Show when no notifications) -->
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-8 text-center">
      <div class="mx-auto h-16 w-16 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center">
        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 10-12 0v3.2a2 2 0 01-.6 1.4L4 17h5m6 0a3 3 0 11-6 0m6 0H9"></path>
        </svg>
      </div>

      <h3 class="mt-4 font-semibold text-slate-900 dark:text-white">
        No Notifications Yet
      </h3>

      <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
        Notifications about your account activities will appear here.
      </p>
    </div>

  </div>

</section>






<?php include "inc/footer2.php" ?>