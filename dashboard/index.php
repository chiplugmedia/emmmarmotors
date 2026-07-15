<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require $_SERVER['DOCUMENT_ROOT']."/emmmarmotors/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/includes/generalinclude.php";

$ptitle="Dashboard";


include "inc/header2.php" ?>


<!-- HEADER -->
<!-- Enhanced Sticky Header -->
<div id="stickyHeader" class="sticky top-0 z-50 px-4 pt-5 pb-3 sm:px-0 sm:max-w-[1200px] mx-auto transition-all duration-300">

    <div class="relative group">

        <!-- Hanging String -->
        <div class="absolute -top-3 left-1/2 -translate-x-1/2">
            <div class="w-[2px] h-3 bg-gradient-to-b from-gray-400/50 dark:from-gray-300/30 to-transparent group-hover:h-4 transition-all duration-300"></div>
        </div>

        <!-- Glass Card -->
        <div class="relative overflow-hidden backdrop-blur-xl bg-white/70 dark:bg-slate-900/70 border border-gray-200 dark:border-slate-700 rounded-2xl p-4 md:p-5 transition-all duration-500">

            <!-- Shine Effect -->
            <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-white/30 dark:from-white/5 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

            <div class="relative flex items-center justify-between">

                <!-- Profile -->
                <div class="flex items-center gap-3">

                    <div class="h-11 w-11 rounded-full overflow-hidden flex items-center justify-center bg-gradient-to-br from-blue-400/20 to-blue-600/20 dark:from-blue-400/10 dark:to-blue-600/10 border-2 border-blue-100 dark:border-blue-500/20 shadow-md group-hover:shadow-lg transition-all duration-300">

                        <?php if (!empty($profileImg) && $profileImg !== "no-avatar.png") : ?>
                            <img
                                src="/dashboard/assets/img/profilephotos/<?php echo htmlspecialchars($profileImg); ?>"
                                alt="Profile Photo"
                                class="h-full w-full object-cover">
                        <?php else : ?>
                            <img
                                src="/mysite/AVater.jpg"
                                alt="Default Avatar"
                                class="h-full w-full object-cover">
                        <?php endif; ?>

                    </div>

                    <div>
                       

                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400">
                            Start Saving &amp; Investing
                        </p>
                    </div>

                </div>

                <!-- Right Side -->
                <div class="flex items-center gap-2">

                    <!-- Notifications -->
                    <a href="notifications"
                       class="relative flex h-11 w-11 items-center justify-center rounded-xl bg-white/60 dark:bg-slate-700/60 border border-gray-200 dark:border-slate-600 backdrop-blur-sm text-slate-700 dark:text-white shadow-sm hover:shadow-lg hover:scale-110 transition-all duration-300 group">

                        <i class="fas fa-bell transition-transform duration-300 group-hover:rotate-12"></i>

                        <span class="absolute top-2 right-2 h-2 w-2 rounded-full bg-red-500 ring-2 ring-white dark:ring-slate-800 animate-ping"></span>
                        <span class="absolute top-2 right-2 h-2 w-2 rounded-full bg-red-500 ring-2 ring-white dark:ring-slate-800"></span>

                    </a>

                    <!-- Help -->
                    <a href="#"
                       class="flex h-11 w-11 items-center justify-center rounded-xl bg-white/60 dark:bg-slate-700/60 border border-gray-200 dark:border-slate-600 backdrop-blur-sm text-slate-700 dark:text-white shadow-sm hover:shadow-lg hover:scale-110 transition-all duration-300 group">

                        <i class="fas fa-question-circle transition-transform duration-300 group-hover:rotate-12"></i>

                    </a>

                </div>

            </div>

        </div>

        <!-- Decorative Shadow -->
        <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 w-3/4 h-4 bg-gradient-to-r from-transparent via-black/10 dark:via-black/20 to-transparent blur-sm rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

    </div>

</div>


<div class="max-w-[1200px] mx-auto px-4 pt-8 pb-4 space-y-6">
<!-- Skeleton Loader -->
<div id="walletSkeleton" class="grid lg:grid-cols-3 gap-3">

  <div class="bg-white dark:bg-navy-900 border border-gray-200 dark:border-gray-700 lg:col-span-2 rounded-2xl p-6">
    <div class="flex items-center justify-between">
      <div class="skeleton h-4 w-32 rounded"></div>
      <div class="skeleton h-5 w-5 rounded-full"></div>
    </div>

    <div class="skeleton h-10 w-56 rounded mt-4"></div>

    <div class="mt-6 flex gap-3">
      <div class="skeleton h-10 w-32 rounded-lg"></div>
      <div class="skeleton h-10 w-28 rounded-lg"></div>
    </div>
  </div>

  <div class="grid grid-cols-2 lg:grid-cols-1 gap-5">
    <div class="bg-white dark:bg-panel-dark border border-blue-100 dark:border-white/10 rounded-2xl p-5">
      <div class="skeleton h-3 w-32 rounded"></div>
      <div class="skeleton h-8 w-24 rounded mt-3"></div>
      <div class="skeleton h-3 w-20 rounded mt-3"></div>
    </div>

    <div class="bg-white dark:bg-panel-dark border border-blue-100 dark:border-white/10 rounded-2xl p-5">
      <div class="skeleton h-3 w-32 rounded"></div>
      <div class="skeleton h-8 w-24 rounded mt-3"></div>
      <div class="skeleton h-3 w-16 rounded mt-3"></div>
    </div>
  </div>

</div>
<!-- Actual Content -->
<div id="walletContent" style="display:none;">

  <!-- Wallet + stats -->
  <div class="grid lg:grid-cols-3 gap-5">

    <div class="bg-white dark:bg-navy-900 border border-gray-200 dark:border-gray-200 lg:col-span-2 rounded-2xl p-6 relative overflow-hidden transition-colors duration-300">

      <div class="absolute top-0 right-0 w-64 h-64 bg-blue-500/50 dark:bg-blue-500/50 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>

      <div class="relative z-10">

        <div class="flex items-center justify-between">
          <p class="text-sm text-gray-500 dark:text-blue-200">
            Available balance
          </p>

          <button id="toggleBalance" type="button" aria-pressed="false" aria-label="Hide balance"
                  class="text-gray-400 dark:text-blue-900 hover:text-gray-700 dark:hover:text-white transition-colors duration-300">

            <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
              <path id="eyeOpenPath" stroke-linecap="round" stroke-linejoin="round"
                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
              <path id="eyePupilPath" stroke-linecap="round" stroke-linejoin="round"
                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
              <path id="eyeSlashPath" stroke-linecap="round" stroke-linejoin="round"
                    d="M3 3l18 18" style="display:none;"/>
            </svg>

          </button>
        </div>

        <p id="balance"
           class="mt-2 text-3xl sm:text-4xl font-bold tracking-tight text-gray-900 dark:text-white"
           data-balance="<?= htmlspecialchars($dollar . (isset($funds) && is_numeric($funds) ? number_format((float)$funds, 2) : '0.00')) ?>">
          <?= htmlspecialchars($dollar . (isset($funds) && is_numeric($funds) ? number_format((float)$funds, 2) : '0.00')) ?>
        </p>

<?php if ($accountVerified == 1): ?>
<div class="mt-6 flex flex-wrap gap-3">

  <button id="openFundWallet" type="button"
    class="text-sm font-semibold text-white rounded-lg px-4 py-2.5 transition-all duration-300 shadow-sm hover:shadow-md inline-flex items-center gap-2"
    style="background-color:#052da7;">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
      <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
    </svg>
    Add money
  </button>

  <button id="openWithdraw" type="button"
    class="text-sm font-semibold text-gray-700 dark:text-white border border-gray-300 dark:border-white/25 hover:bg-gray-100 dark:hover:bg-white/10 rounded-lg px-4 py-2.5 transition-all duration-300 inline-flex items-center gap-2">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
      <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
    </svg>
    Withdraw
  </button>

</div>

<div class="mt-4 inline-flex items-center gap-2 text-xs font-medium text-gray-500 dark:text-blue-200 bg-gray-50 dark:bg-white/10 rounded-full px-3 py-1.5">
  <span><?php echo $accountname; ?></span>
  <span class="text-gray-300 dark:text-white/30">&bull;</span>
  <span id="walletAccountNumber" class="text-gray-700 dark:text-white font-semibold"><?php echo $accountnumber; ?></span>
</div>
<?php endif; ?>
      </div>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-1 gap-5">

      <div class="bg-white dark:bg-panel-dark border border-blue-100 dark:border-white/10 rounded-2xl p-5">
        <p class="text-xs text-slate-500 dark:text-slate-400">
          Total Investment Balance
        </p>
        <p class="mt-1.5 text-xl font-bold text-navy-900 dark:text-white">
          <?= htmlspecialchars($dollar . (isset($totalrefearnings) && is_numeric($totalrefearnings) ? number_format((float)$totalrefearnings, 2) : '0.00')) ?>
        </p>
        <p class="mt-1 text-xs text-emerald-600 dark:text-emerald-400 font-medium">
          ↑ 12% vs last month
        </p>
      </div>

      <div class="bg-white dark:bg-panel-dark border border-blue-100 dark:border-white/10 rounded-2xl p-5">
        <p class="text-xs text-slate-500 dark:text-slate-400">
          Total Profit Earned
        </p>
        <p class="mt-1.5 text-xl font-bold text-navy-900 dark:text-white">
          <?= htmlspecialchars($dollar . (isset($score) && is_numeric($score) ? number_format((float)$score, 2) : '0.00')) ?>
        </p>
        <p class="mt-1 text-xs text-slate-400 dark:text-slate-500">
          this month
        </p>
      </div>

    </div>

  </div>

</div>
<?php

$username = $_SESSION['username'] ?? '';

$isVerified = false;
$hasBank = false;

/*
|--------------------------------------------------------------------------
| CHECK KYC STATUS
|--------------------------------------------------------------------------
*/
$sql = $link->prepare("
    SELECT verified
    FROM users
    WHERE username = ?
    LIMIT 1
");

$sql->bind_param("s", $username);
$sql->execute();

$user = $sql->get_result()->fetch_assoc();

if ($user) {
    $isVerified = ($user['verified'] == 1);
}

$sql->close();

/*
|--------------------------------------------------------------------------
| CHECK BANK ACCOUNT
|--------------------------------------------------------------------------
*/
$sql = $link->prepare("
    SELECT id
    FROM bankaccounts
    WHERE username = ?
    LIMIT 1
");

$sql->bind_param("s", $username);
$sql->execute();

$bank = $sql->get_result()->fetch_assoc();

if ($bank) {
    $hasBank = true;
}

$sql->close();

/*
|--------------------------------------------------------------------------
| CALCULATE PROGRESS
|--------------------------------------------------------------------------
*/
$totalSteps = 2;
$completedSteps = 0;

if ($isVerified) {
    $completedSteps++;
}

if ($hasBank) {
    $completedSteps++;
}

/*
|--------------------------------------------------------------------------
| PAYOUT LINK
|--------------------------------------------------------------------------
*/
$payoutLink = $isVerified
    ? "bank"
    : "verify";
?>

<?php if (!$isVerified || !$hasBank): ?>

<div class="max-w-xl mx-auto">

    <div id="setup-card"
        class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">

        <!-- Header -->
        <div
            class="flex items-center justify-between bg-gradient-to-r from-blue-600 to-blue-700 dark:from-blue-700 dark:to-blue-900 px-5 py-4">

            <h2 class="text-sm font-semibold text-white">
                Setup your account
            </h2>

            <span class="text-sm font-semibold text-blue-100">
                <?= $completedSteps ?>/<?= $totalSteps ?>
            </span>

        </div>

        <!-- Checklist -->
        <div class="p-4 sm:p-5 space-y-4">

            <?php if (!$isVerified): ?>

            <!-- KYC CARD -->
            <a href="verify"
                class="group flex items-center gap-4 rounded-xl border border-slate-200 dark:border-slate-700 p-4 bg-white dark:bg-slate-800 hover:border-blue-500 hover:bg-blue-50 dark:hover:bg-blue-950/30 transition-all">

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/40">

                    <svg class="h-6 w-6 text-blue-600 dark:text-blue-400"
                        fill="currentColor"
                        viewBox="0 0 24 24">
                        <path d="M12 2 4 5v6c0 5.25 3.4 9.74 8 11 4.6-1.26 8-5.75 8-11V5l-8-3Z"/>
                        <path d="M10.2 13.6 8.4 11.8l-1.2 1.2 3 3 5-5-1.2-1.2-3.8 3.8Z" fill="white"/>
                    </svg>

                </div>

                <div class="flex-1 min-w-0">

                    <p class="text-sm font-semibold text-slate-800 dark:text-white">
                        Complete your KYC
                    </p>

                    <p class="mt-0.5 text-xs text-slate-500 dark:text-slate-400">
                        Verify your identity to unlock all account features.
                    </p>

                </div>

                <span
                    class="h-5 w-5 rounded-full border-2 border-slate-300 dark:border-slate-600">
                </span>

            </a>

            <?php endif; ?>


            <?php if (!$hasBank): ?>

            <!-- PAYOUT BANK CARD -->
            <a href="<?= $payoutLink ?>"
                class="group flex items-center gap-4 rounded-xl border border-slate-200 dark:border-slate-700 p-4 bg-white dark:bg-slate-800 hover:border-blue-500 hover:bg-blue-50 dark:hover:bg-blue-950/30 transition-all">

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/40">

                    <svg class="h-6 w-6 text-blue-600 dark:text-blue-400"
                        fill="currentColor"
                        viewBox="0 0 24 24">
                        <path d="M12 2 2 8v2h20V8L12 2Z"/>
                        <path d="M4 11h2v7H4v-7Zm4 0h2v7H8v-7Zm4 0h2v7h-2v-7Zm4 0h2v7h-2v-7Z"/>
                        <path d="M2 20h20v2H2v-2Z"/>
                    </svg>

                </div>

                <div class="flex-1 min-w-0">

                    <p class="text-sm font-semibold text-slate-800 dark:text-white">
                        Add your Payout Bank
                    </p>

                    <p class="mt-0.5 text-xs text-slate-500 dark:text-slate-400">

                        <?php if (!$isVerified): ?>
                            Complete KYC verification before adding a payout bank.
                        <?php else: ?>
                            Add a bank account to receive withdrawals and payouts.
                        <?php endif; ?>

                    </p>

                </div>

                <span
                    class="h-5 w-5 rounded-full border-2 border-slate-300 dark:border-slate-600">
                </span>

            </a>

            <?php endif; ?>

        </div>

    </div>

</div>

<?php endif; ?>


  <!-- ========================= -->
  <!-- SUGGESTIONS SKELETON -->
  <!-- ========================= -->
  <div id="suggestionSkeleton" class="animate-pulse">
    <div class="flex items-center justify-between mb-4">
      <div class="h-6 w-40 rounded-lg bg-slate-200 dark:bg-slate-700"></div>
    </div>
    <div class="flex gap-4 overflow-hidden">
      <div class="min-w-[280px] h-[140px] rounded-2xl bg-slate-200 dark:bg-slate-700"></div>
      <div class="min-w-[280px] h-[140px] rounded-2xl bg-slate-200 dark:bg-slate-700"></div>
      <div class="min-w-[280px] h-[140px] rounded-2xl bg-slate-200 dark:bg-slate-700"></div>
    </div>
  </div>

  <!-- ========================= -->
  <!-- SUGGESTIONS FOR YOU -->
  <!-- ========================= -->
  <div id="suggestionContent" class="skeleton-hidden">
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-lg sm:text-xl font-bold text-slate-900 dark:text-white">Explore</h2>
    </div>
    <div class="flex gap-4 overflow-x-auto pb-2 scrollbar-hide snap-x snap-mandatory">
      <div class="min-w-[85%] sm:min-w-[420px] snap-start">
        <img src="https://storage.googleapis.com/piggybankservice.appspot.com/v5/banner/2024-investment-1.jpg" alt="Investment promo banner" class="w-full h-[140px] sm:h-[170px] object-cover rounded-2xl shadow-sm hover:scale-[1.02] transition duration-300">
      </div>
      <div class="min-w-[85%] sm:min-w-[420px] snap-start">
        <img src="https://storage.googleapis.com/piggybankservice.appspot.com/v5/banner/house-money.jpg" alt="Savings promo banner" class="w-full h-[140px] sm:h-[170px] object-cover rounded-2xl shadow-sm hover:scale-[1.02] transition duration-300">
      </div>
      <div class="min-w-[85%] sm:min-w-[420px] snap-start">
        <img src="https://storage.googleapis.com/piggybankservice.appspot.com/v5/banner/2024-investment-1.jpg" alt="Investment promo banner" class="w-full h-[140px] sm:h-[170px] object-cover rounded-2xl shadow-sm hover:scale-[1.02] transition duration-300">
      </div>
      <div class="min-w-[85%] sm:min-w-[420px] snap-start">
        <img src="https://storage.googleapis.com/piggybankservice.appspot.com/v5/banner/2024-investment-1.jpg" alt="Investment promo banner" class="w-full h-[140px] sm:h-[170px] object-cover rounded-2xl shadow-sm hover:scale-[1.02] transition duration-300">
      </div>
      <div class="min-w-[85%] sm:min-w-[420px] snap-start">
        <img src="https://storage.googleapis.com/piggybankservice.appspot.com/v5/banner/house-money.jpg" alt="Savings promo banner" class="w-full h-[140px] sm:h-[170px] object-cover rounded-2xl shadow-sm hover:scale-[1.02] transition duration-300">
      </div>
    </div>
  </div>

 <!-- ========================= -->
<!-- AVAILABLE PLANS SKELETON -->
<!-- ========================= -->
<div id="opportunitySkeleton" class="animate-pulse">
    <div class="flex items-center justify-between mb-5">
        <div class="h-6 w-44 bg-slate-200 dark:bg-slate-700 rounded"></div>
        <div class="h-5 w-20 bg-slate-200 dark:bg-slate-700 rounded"></div>
    </div>

    <div class="flex gap-4 overflow-hidden">
        <?php for($i=0; $i<3; $i++): ?>
        <div class="min-w-[280px] bg-white dark:bg-slate-800 rounded-2xl overflow-hidden">
            <div class="h-40 bg-slate-200 dark:bg-slate-700"></div>
            <div class="p-4">
                <div class="h-3 w-20 bg-slate-200 dark:bg-slate-700 rounded mb-3"></div>
                <div class="h-4 w-full bg-slate-200 dark:bg-slate-700 rounded mb-2"></div>
                <div class="h-4 w-3/4 bg-slate-200 dark:bg-slate-700 rounded mb-4"></div>
                <div class="h-3 w-28 bg-slate-200 dark:bg-slate-700 rounded"></div>
            </div>
        </div>
        <?php endfor; ?>
    </div>
</div>

<!-- ========================= -->
<!-- AVAILABLE PLANS -->
<!-- ========================= -->
<div id="opportunityContent" class="skeleton-hidden">
    
    <div class="flex items-center justify-between mb-5">
        <h2 class="text-xl font-bold text-slate-900 dark:text-white">
            Available Plans
        </h2>

        <a href="plans.php"
           class="text-purple-600 hover:text-purple-700 font-medium text-sm">
            Find More →
        </a>
    </div>

    <div class="flex gap-4 overflow-x-auto pb-3 snap-x snap-mandatory scrollbar-hide">

        <?php
        $sql = $link->prepare("
            SELECT *
            FROM investment_plans
            ORDER BY CAST(price AS UNSIGNED) ASC
            LIMIT 4
        ");

        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows > 0):

            while ($row = $result->fetch_assoc()):

                $title     = htmlspecialchars($row['title']);
                $description = !empty($row['description']) ? htmlspecialchars($row['description']) : "null";
                $price     = (float)$row['price'];
                $daily     = (float)$row['daily'];
                $image     = htmlspecialchars($row['image']);
                $duration  = (int)$row['duration'];
                $reference = htmlspecialchars($row['reference']);

                $total_income = $daily * $duration;
        ?>

        <a href="/dashboard/invest-details.php?reference=<?php echo urlencode($reference); ?>"
           class="block min-w-[280px] max-w-[280px] bg-white dark:bg-slate-800 rounded-2xl overflow-hidden shadow-sm border border-slate-100 dark:border-slate-700 snap-start hover:shadow-lg transition duration-300">

            <div class="relative">
                <img src="/dashboard/img/invest/<?php echo $image; ?>"
                     alt="<?php echo $title; ?>"
                     class="w-full h-40 object-cover">

                <span class="absolute top-3 right-3 bg-purple-600 text-white text-xs px-3 py-1 rounded-full">
                    ₦<?php echo number_format($price); ?>
                </span>
            </div>

            <div class="p-4">
                <p class="text-xs text-slate-500">
                    Duration: <b><?php echo $duration; ?> Days</b>
                </p>

                <h3 class="mt-2 font-semibold text-slate-900 dark:text-white">
                    <?php echo $title; ?>
                </h3>
 <p class="text-sm text-slate-500 mt-2">
                     <b><?php echo $description; ?></b>
                </p>
                <p class="text-sm text-slate-500 mt-2">
                    Daily Income:
                    <b>₦<?php echo number_format($daily, 2); ?></b>
                </p>

                <p class="text-sm text-green-600 font-medium mt-1">
                    Total Return:
                    ₦<?php echo number_format($total_income, 2); ?>
                </p>
            </div>

        </a>

        <?php
            endwhile;
        else:
        ?>
            <div class="w-full text-center py-8 text-slate-500">
                No investment plans available.
            </div>
        <?php endif; ?>

    </div>
</div>
<!-- ========================= -->
<!-- RECENT TRANSACTIONS SKELETON -->
<!-- ========================= -->
<div id="transactionSkeleton" class="animate-pulse">
    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl overflow-hidden">
        <div class="flex items-center justify-between p-5 border-b border-slate-200 dark:border-slate-700">
            <div class="h-5 w-40 rounded bg-slate-200 dark:bg-slate-700"></div>
            <div class="h-4 w-16 rounded bg-slate-200 dark:bg-slate-700"></div>
        </div>

        <div class="divide-y divide-slate-100 dark:divide-slate-700">
            <?php for ($i = 0; $i < 4; $i++) { ?>
                <div class="flex items-center justify-between p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-slate-200 dark:bg-slate-700"></div>
                        <div>
                            <div class="h-4 w-32 rounded bg-slate-200 dark:bg-slate-700 mb-2"></div>
                            <div class="h-3 w-20 rounded bg-slate-200 dark:bg-slate-700"></div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="h-4 w-20 rounded bg-slate-200 dark:bg-slate-700 mb-2"></div>
                        <div class="h-5 w-16 rounded-full bg-slate-200 dark:bg-slate-700"></div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- ========================= -->
<!-- RECENT TRANSACTIONS -->
<!-- ========================= -->
<div id="transactionContent" class="skeleton-hidden mb-[80px]">
    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl overflow-hidden">

        <div class="flex items-center justify-between p-5 border-b border-slate-200 dark:border-slate-700">
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">
                Recent Activities
            </h3>
            <a href="transaction" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                View All
            </a>
        </div>

        <div class="divide-y divide-slate-100 dark:divide-slate-700">

            <?php
            $sql = $link->prepare("SELECT * FROM userearnings WHERE username=? ORDER BY id DESC LIMIT 2");
            $sql->bind_param("s", $username);
            $sql->execute();
            $result = $sql->get_result();

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

                    $type   = $row['type'];
                    $amount = (float)$row['amount'];
                    $date   = $row['date'];

                    $formattedDate = !empty($date)
                        ? (new DateTime($date))->format('M j, Y g:i A')
                        : '-';

                    $symbol = "₦";
            ?>

                <div class="flex items-center justify-between p-4">
                    <div class="flex items-center gap-3">

                        <div class="w-12 h-12 rounded-xl bg-green-100 dark:bg-green-900/20 flex items-center justify-center">
                            <i class="fas fa-arrow-down text-green-600"></i>
                        </div>

                        <div>
                            <h4 class="font-medium text-slate-900 dark:text-white">
                                <?= htmlspecialchars($type) ?>
                            </h4>
                            <p class="text-xs text-slate-500">
                                <?= htmlspecialchars($formattedDate) ?>
                            </p>
                        </div>

                    </div>

                    <div class="text-right">
                        <p class="font-semibold text-green-600">
                            <?= $symbol . number_format($amount, 2) ?>
                        </p>

                        <span class="text-xs text-green-600 bg-green-100 dark:bg-green-900/20 px-2 py-1 rounded-full">
                            Completed
                        </span>
                    </div>
                </div>

            <?php
                }
            } else {
            ?>
                <div class="p-8 text-center">
                    <i class="fas fa-receipt text-4xl text-slate-300 mb-3"></i>
                    <p class="text-slate-500 dark:text-slate-400">
                        No transactions found.
                    </p>
                </div>
            <?php } ?>

        </div>

    </div>
</div>

<!-- ============ FUND WALLET MODAL ============ -->
<div id="fundWalletModal" class="fixed inset-0 z-50 hidden">
  <!-- backdrop -->
  <div class="absolute inset-0 bg-black/40" data-modal-close="fundWalletModal"></div>

  <!-- sheet -->
  <div class="absolute inset-x-0 bottom-0 sm:inset-0 sm:flex sm:items-center sm:justify-center">
    <div class="bg-white dark:bg-navy-900 w-full sm:max-w-md sm:rounded-2xl rounded-t-2xl p-6 max-h-[90vh] overflow-y-auto relative transition-colors duration-300">

      <button type="button" data-modal-close="fundWalletModal"
              class="absolute top-5 right-5 text-gray-400 hover:text-gray-700 dark:hover:text-white transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>

      <div class="w-9 h-9 flex items-center justify-center rounded-lg mb-4" style="background-color:#eef2ff;">
  <svg class="w-5 h-5" fill="none" stroke="#052da7" stroke-width="2" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M19 12l-7 7-7-7"/>
  </svg>
</div>
      <h3 class="text-lg font-bold text-gray-900 dark:text-white">Fund your wallet</h3>
      <p class="mt-1 text-sm text-gray-500 dark:text-blue-200">
        Transfer to this bank account and your wallet will be funded
      </p>

      <div class="mt-5 border border-gray-200 dark:border-white/15 rounded-xl p-4">

        <div class="flex items-center gap-3">
          <div class="w-9 h-9 rounded-lg flex items-center justify-center" style="background-color:#052da7;">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 6h18M4 14h16v6H4v-6Z"/>
            </svg>
          </div>
          <div>
            <p class="text-[11px] uppercase tracking-wide text-gray-400 dark:text-blue-300">Receiving bank</p>
            <p class="text-sm font-bold text-gray-900 dark:text-white"><?php echo $virtbankName; ?></p>
          </div>
        </div>

        <hr class="my-4 border-gray-100 dark:border-white/10">

        <div class="flex items-start justify-between gap-3">
          <div>
            <p class="text-[11px] uppercase tracking-wide text-gray-400 dark:text-blue-300">Account number</p>
            <p id="fundAccountNumber" class="text-xl font-bold text-gray-900 dark:text-white mt-0.5"><?php echo $accountnumber; ?></p>
          </div>
          <button type="button" id="copyAccountNumber"
                  class="mt-1 text-gray-400 hover:text-gray-700 dark:hover:text-white transition-colors" aria-label="Copy account number">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
              <rect x="9" y="9" width="11" height="11" rx="2"/>
              <path d="M5 15V5a2 2 0 0 1 2-2h10"/>
            </svg>
          </button>
        </div>

        <p id="copyFeedback" class="mt-1 text-xs font-medium hidden" style="color:#16a34a;">Copied to clipboard</p>

        <div class="mt-4">
          <p class="text-[11px] uppercase tracking-wide text-gray-400 dark:text-blue-300">Account name</p>
          <p class="text-sm font-bold text-gray-900 dark:text-white mt-0.5"><?php echo $accountname; ?></p>
        </div>

      </div>

      <div class="flex items-center gap-3 my-5">
        <div class="h-px flex-1 bg-gray-200 dark:bg-white/10"></div>
        <span class="text-xs font-medium text-gray-400 dark:text-blue-300">OR</span>
        <div class="h-px flex-1 bg-gray-200 dark:bg-white/10"></div>
      </div>

      <p class="text-sm font-semibold text-gray-800 dark:text-white mb-2">Choose how you want to fund</p>

      <!-- Pay With Card Button -->
      <button type="button" id="showCardPayment"
              class="w-full flex items-center justify-between border border-gray-200 dark:border-white/15 rounded-xl px-4 py-3.5 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
          <span class="flex items-center gap-3 text-sm font-semibold text-gray-800 dark:text-white">
              <svg class="w-5 h-5 text-gray-500 dark:text-blue-200" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                  <rect x="2" y="5" width="20" height="14" rx="2"/>
                  <path d="M2 10h20"/>
              </svg>
              Pay with card
          </span>

          <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 6l6 6-6 6"/>
          </svg>
      </button>

      <button type="button" id="fundIHavePaid"
              class="w-full mt-5 text-sm font-semibold text-gray-800 dark:text-white bg-gray-100 dark:bg-white/10 hover:bg-gray-200 dark:hover:bg-white/20 rounded-xl px-4 py-3.5 transition-colors">
        I have paid
      </button>

    </div>
  </div>
</div>


<!-- ============ WITHDRAW MODAL ============ -->
<div id="withdrawModal" class="fixed inset-0 z-50 hidden">
  <!-- backdrop -->
  <div class="absolute inset-0 bg-black/40" data-modal-close="withdrawModal"></div>

  <!-- sheet -->
  <div class="absolute inset-x-0 bottom-0 sm:inset-0 sm:flex sm:items-center sm:justify-center">
    <div class="bg-white dark:bg-navy-900 w-full sm:max-w-md sm:rounded-2xl rounded-t-2xl p-6 max-h-[90vh] overflow-y-auto relative transition-colors duration-300">

      <button type="button" data-modal-close="withdrawModal"
              class="absolute top-5 right-5 text-gray-400 hover:text-gray-700 dark:hover:text-white transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>

      <div class="w-9 h-9 flex items-center justify-center rounded-lg mb-4" style="background-color:#eef2ff;">
        <svg class="w-5 h-5" fill="none" stroke="#052da7" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 19V5M5 12l7-7 7 7"/>
        </svg>
      </div>

      <h3 class="text-lg font-bold text-gray-900 dark:text-white">Withdraw</h3>
      <p class="mt-1 text-sm text-gray-500 dark:text-blue-200">
        Send funds from your wallet to a bank account
      </p>

      <p class="mt-5 text-sm font-semibold text-gray-800 dark:text-white">Withdraw to</p>

      <button type="button"
              class="w-full mt-2 flex items-center gap-3 border border-gray-200 dark:border-white/15 rounded-xl px-4 py-3.5 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors text-left">
       <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
  <rect x="2" y="10" width="20" height="4" rx="1" />
  <path d="M4 14v6a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-6" />
  <path d="M12 3L2 10h20L12 3z" />
  <line x1="8" y1="14" x2="8" y2="18" />
  <line x1="12" y1="14" x2="12" y2="18" />
  <line x1="16" y1="14" x2="16" y2="18" />
</svg>
        <span>
          <span class="block text-sm font-bold text-gray-900 dark:text-white"><?php echo $acctName; ?></span>
          <span class="block text-xs text-gray-500 dark:text-blue-200"><?php echo $acctNum; ?> &bull; <?php echo $bankName; ?></span>
        </span>
      </button>

      <p class="mt-5 text-sm font-semibold text-gray-800 dark:text-white">Enter amount</p>

      <div class="mt-2 border border-gray-200 dark:border-white/15 rounded-xl overflow-hidden">
        <div class="px-4 py-2.5 bg-gray-50 dark:bg-white/5 text-xs font-medium text-gray-500 dark:text-blue-200">
          Available balance: <span id="withdrawAvailable"><?= htmlspecialchars($dollar . (isset($funds) && is_numeric($funds) ? number_format((float)$funds, 2) : '0.00')) ?></span>
        </div>
        <div class="flex items-center gap-2 px-4 py-3 border-t border-gray-200 dark:border-white/15">
          <span class="text-gray-400 dark:text-blue-300 font-semibold">₦</span>
          <input id="withdrawAmount" type="text" inputmode="numeric" placeholder="Enter amount"
                 class="w-full bg-transparent outline-none text-sm font-semibold text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-blue-300">
        </div>
      </div>

      <div class="mt-3 flex flex-wrap gap-2">
        <button type="button" data-quick-amount="500" class="quick-amount-btn text-xs font-semibold text-gray-700 dark:text-white border border-gray-200 dark:border-white/15 rounded-full px-3.5 py-2 hover:bg-gray-50 dark:hover:bg-white/10 transition-colors">₦500</button>
        <button type="button" data-quick-amount="1000" class="quick-amount-btn text-xs font-semibold text-gray-700 dark:text-white border border-gray-200 dark:border-white/15 rounded-full px-3.5 py-2 hover:bg-gray-50 dark:hover:bg-white/10 transition-colors">₦1,000</button>
        <button type="button" data-quick-amount="2000" class="quick-amount-btn text-xs font-semibold text-gray-700 dark:text-white border border-gray-200 dark:border-white/15 rounded-full px-3.5 py-2 hover:bg-gray-50 dark:hover:bg-white/10 transition-colors">₦2,000</button>
        <button type="button" data-quick-amount="5000" class="quick-amount-btn text-xs font-semibold text-gray-700 dark:text-white border border-gray-200 dark:border-white/15 rounded-full px-3.5 py-2 hover:bg-gray-50 dark:hover:bg-white/10 transition-colors">₦5,000</button>
        <button type="button" data-quick-amount="10000" class="quick-amount-btn text-xs font-semibold text-gray-700 dark:text-white border border-gray-200 dark:border-white/15 rounded-full px-3.5 py-2 hover:bg-gray-50 dark:hover:bg-white/10 transition-colors">₦10,000</button>
      </div>

      <p class="mt-5 text-sm font-semibold text-gray-800 dark:text-white">Narration <span class="font-normal text-gray-400">(Optional)</span></p>
      <input type="text" placeholder="Enter description"
             class="w-full mt-2 border border-gray-200 dark:border-white/15 rounded-xl px-4 py-3 text-sm outline-none bg-transparent text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-blue-300">

      <button type="button" id="withdrawContinue"
              class="w-full mt-6 text-sm font-semibold text-white rounded-xl px-4 py-3.5 transition-all duration-300 shadow-sm hover:shadow-md"
              style="background-color:#052da7;">
        Continue
      </button>

    </div>
  </div>
</div>


<!-- ============ CARD PAYMENT MODAL ============ -->
<div id="cardPaymentModal" class="fixed inset-0 z-50 hidden">
  <!-- backdrop -->
  <div class="absolute inset-0 bg-black/40" data-modal-close="cardPaymentModal"></div>

  <!-- sheet -->
  <div class="absolute inset-x-0 bottom-0 sm:inset-0 sm:flex sm:items-center sm:justify-center">
    <div class="bg-white dark:bg-navy-900 w-full sm:max-w-md sm:rounded-2xl rounded-t-2xl p-6 max-h-[90vh] overflow-y-auto relative transition-colors duration-300">

      <button type="button" data-modal-close="cardPaymentModal"
              class="absolute top-5 right-5 text-gray-400 hover:text-gray-700 dark:hover:text-white transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>

      <div class="w-9 h-9 flex items-center justify-center rounded-lg mb-4" style="background-color:#eef2ff;">
        <svg class="w-5 h-5" fill="none" stroke="#052da7" stroke-width="1.8" viewBox="0 0 24 24">
          <rect x="2" y="5" width="20" height="14" rx="2"/>
          <path d="M2 10h20"/>
        </svg>
      </div>

      <h3 class="text-lg font-bold text-gray-900 dark:text-white">Pay with card</h3>
      <p class="mt-1 text-sm text-gray-500 dark:text-blue-200">
        Enter an amount to fund your wallet using your debit/credit card
      </p>

      <label class="block text-sm font-medium text-gray-700 dark:text-white mt-5 mb-2">
          Amount to Fund
      </label>

      <div class="flex items-center gap-2 border border-gray-300 dark:border-white/15 rounded-xl px-4 py-3 dark:bg-navy-800">
        <span class="text-gray-400 dark:text-blue-300 font-semibold">₦</span>
        <input
            type="number"
            id="cardAmount"
            min="100"
            placeholder="Enter amount"
            class="w-full bg-transparent outline-none text-sm font-semibold text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-blue-300">
      </div>

      <button
          type="button"
          id="continueCardPayment"
          class="w-full mt-6 bg-[#052da7] hover:bg-[#041f78] text-white font-semibold py-3.5 rounded-xl transition">
          Continue to Pay
      </button>

    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const showBtn = document.getElementById('showCardPayment');
    const continueBtn = document.getElementById('continueCardPayment');

    if (showBtn) {

        showBtn.addEventListener('click', function () {

            const fundWalletModal = document.getElementById('fundWalletModal');
            const cardPaymentModal = document.getElementById('cardPaymentModal');

            if (fundWalletModal) {
                fundWalletModal.classList.add('hidden');
            }

            if (cardPaymentModal) {
                cardPaymentModal.classList.remove('hidden');
            }

            document.body.style.overflow = 'hidden';

        });

    }

    if (continueBtn) {

        continueBtn.addEventListener('click', function () {

            const amountInput = document.getElementById('cardAmount');

            if (!amountInput) {
                alert('Amount field not found');
                return;
            }

            const amount = amountInput.value.trim();

            if (!amount) {
                alert('Please enter an amount');
                amountInput.focus();
                return;
            }

            if (isNaN(amount) || parseFloat(amount) < 100) {
                alert('Minimum amount is ₦100');
                amountInput.focus();
                return;
            }

            window.location.href =
                "actions/paystack/pay?amount=" +
                encodeURIComponent(amount);

        });

    }

});
</script>

<br>
<br>
<br>
<br>
 
       <?php include "inc/footer2.php" ?>