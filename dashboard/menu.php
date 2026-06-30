<?php
require $_SERVER['DOCUMENT_ROOT']."/emmmarmotors/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/actions/account-settings.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/actions/password.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/actions/buyprod.php";


$masked_username = substr($username, 0, 6) . '****' . substr($username, -4);
$ptitle="Menu";
include "inc/header2.php" ?>

<div class="pt-20">

    <!-- HEADER -->
    <div class="fixed top-0 left-1/2 z-50 w-full -translate-x-1/2">

        <div class="flex items-center justify-between
                    border border-white/40 dark:border-slate-700/50
                    bg-white/70 dark:bg-slate-900/70
                    backdrop-blur-xl
                    shadow-lg
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

            <!-- Title -->
            <h1 class="flex-1 text-center text-sm font-semibold text-[#2f4f4e] dark:text-yellow-400 truncate">
                <?php echo $ptitle; ?>
            </h1>

            <!-- Right Spacer -->
            <div class="w-10"></div>

        </div>

    </div>

</div>

<div class="px-4 py-4 space-y-5 mt-[5px] max-w-[590px] mx-auto">

    <!-- PROFILE CARD -->
    <div class="relative overflow-hidden rounded-2xl border border-[#FEFBEF] bg-[#1a3332] p-6 text-white">

        <!-- Glow -->
        <div class="absolute top-0 right-0 h-32 w-32 rounded-full bg-red-500/20 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 h-32 w-32 rounded-full bg-red-400/20 blur-3xl"></div>

        <div class="relative z-10 flex flex-col items-center text-center">

            <!-- Avatar -->
            <div class="mb-4 h-24 w-24 overflow-hidden rounded-full border-4 border-white/20 bg-white/10 shadow-xl backdrop-blur-md">

 <?php
      if ($profileImg == "no-avatar.png") {
          echo '<img src="/invest/mysite/bandogreen.jfif" class="h-full w-full object-cover">';
      } else {
          echo '<img src="/dashboard/assets/img/profilephotos/' . $profileImg . '" class="h-full w-full object-cover">';
      }
      ?>
            </div>

            <!-- User -->
            <h2 class="mb-1 text-xl font-bold tracking-tight">
                <?php echo $masked_username?>
            </h2>
<p><?php echo $email?></p>
        

        </div>
    </div>


<div class="grid grid-cols-2 gap-3 mt-4">

  <!-- Card 1 -->
  <div class="relative flex flex-col overflow-hidden rounded-2xl bg-[#1a3332] p-3 text-sm">
    <p class="mb-1 text-xs text-gray-400">Team Income</p>
    <p class="text-sm font-semibold text-white"><?php echo $dollar ?><?php echo number_format((float)$score, 2) ?></p>

    <svg xmlns="http://www.w3.org/2000/svg"
     viewBox="0 0 24 24"
     fill="none"
     stroke="currentColor"
     stroke-width="2"
     stroke-linecap="round"
     stroke-linejoin="round"
     class="absolute bottom-3 right-3 h-8 w-8 text-white/20">

  <!-- cash note outline -->
  <rect x="3" y="6" width="18" height="12" rx="2" />

  <!-- center circle (coin) -->
  <circle cx="12" cy="12" r="2.5" />

  <!-- side lines (money detail) -->
  <path d="M7 10h.01" />
  <path d="M17 14h.01" />

</svg>
  </div>

  <!-- Card 2 -->
  <div class="relative flex flex-col overflow-hidden rounded-2xl bg-[#1a3332] p-3 text-sm text-white">
    <p class="mb-1 text-xs text-white/70"> Valid Team Size</p>
    <p class="text-sm font-semibold"><?php echo $totalActiveAll ?></p>
 
    <svg xmlns="http://www.w3.org/2000/svg"
     viewBox="0 0 24 24"
     fill="none"
     stroke="currentColor"
     stroke-width="2"
     stroke-linecap="round"
     stroke-linejoin="round"
     class="absolute bottom-3 right-3 h-8 w-8 text-white/20">

  <!-- heads -->
  <circle cx="9" cy="8" r="2.5"></circle>
  <circle cx="15" cy="8" r="2.5"></circle>

  <!-- body -->
  <path d="M4.5 18c0-2.5 2.5-4.5 4.5-4.5s4.5 2 4.5 4.5"></path>
  <path d="M10.5 18c0-2.5 2.5-4.5 4.5-4.5s4.5 2 4.5 4.5"></path>

</svg>

  </div>

</div>

<div class="mb-6 overflow-hidden rounded-2xl border border-[#1a3332] bg-[#FEFBEF]">

    <!-- CONTENT -->
    <div class="divide-y divide-red-100">

        <!-- ITEM -->
        <div class="flex items-center justify-between p-4">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-green-100 text-[#1a3332]">
                    <i class="bi bi-cash-stack text-lg"></i>
                </div>

                <span class="text-xs font-bold uppercase tracking-wide text-gray-800">
                    Total Withdrawn
                </span>

            </div>

            <span class="rounded-xl border border-green-100 bg-green-50 px-3 py-1 text-[10px] font-black uppercase tracking-wide text-[#1a3332]">

                <?php echo $dollar ?>
                <?php echo number_format((float)$totalWithdrawn, 2) ?>

            </span>

        </div>

        <!-- ITEM -->
        <div class="flex items-center justify-between p-4">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-green-100 text-[#1a3332]">
                    <i class="bi bi-wallet2 text-lg"></i>
                </div>

                <span class="text-xs font-bold uppercase tracking-wide text-gray-800">
                    Total Income
                </span>

            </div>

            <span class="rounded-xl border border-green-100 bg-green-50 px-3 py-1 text-[10px] font-black uppercase tracking-wide text-[#1a3332]">

                <?php echo $dollar ?>
                <?php echo number_format((float)$totaldailyincome, 2) ?>

            </span>

        </div>

        <!-- ITEM -->
        <div class="flex items-center justify-between p-4">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-green-100 text-[#1a3332]">
                    <i class="bi bi-coin text-lg"></i>
                </div>

                <span class="text-xs font-bold uppercase tracking-wide text-gray-800">
                    Total Assets
                </span>

            </div>

            <span class="rounded-xl border border-green-100 bg-green-50 px-3 py-1 text-[10px] font-black uppercase tracking-wide text-[#1a3332]">

                <?php echo $dollar ?>
                <?php echo number_format((float)$totalprice, 2) ?>

            </span>

        </div>

       
    </div>

</div>

    <!-- ACCOUNT SETTINGS -->
    <div>

        <p class="mb-6 ml-3 text-[11px] font-bold uppercase tracking-wider text-gray-400">
            Account Settings
        </p>

       <div class="overflow-hidden rounded-[1.5rem] border border-[#1a3332] bg-[#FEFBEF] divide-y">

    <!-- ITEM: Account Settings -->
    <a href="profile" class="group flex items-center justify-between p-4 transition hover:bg-gray-50">
        <div class="flex items-center gap-4">
            <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-green-100 text-[#1a3332] transition group-hover:bg-[#1a3332] group-hover:text-white">
                <i class="bi bi-person-circle text-[18px]"></i>
            </div>
            <span class="text-sm font-semibold text-gray-800">Account Settings</span>
        </div>
        <i class="bi bi-chevron-right text-gray-400 transition group-hover:translate-x-1"></i>
    </a>

    <!-- ITEM: Income History -->
    <a href="history" class="group flex items-center justify-between p-4 transition hover:bg-gray-50">
        <div class="flex items-center gap-4">
            <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-green-100 text-[#1a3332] transition group-hover:bg-[#1a3332] group-hover:text-white">
                <i class="bi bi-clock-history text-[18px]"></i>
            </div>
            <span class="text-sm font-semibold text-gray-800">Income History</span>
        </div>
        <i class="bi bi-chevron-right text-gray-400 transition group-hover:translate-x-1"></i>
    </a>

    <!-- ITEM: Transaction History -->
    <a href="transaction" class="group flex items-center justify-between p-4 transition hover:bg-gray-50">
        <div class="flex items-center gap-4">
            <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-green-100 text-[#1a3332] transition group-hover:bg-[#1a3332] group-hover:text-white">
                <i class="bi bi-clock-history text-[18px]"></i>
            </div>
            <span class="text-sm font-semibold text-gray-800">Transaction History</span>
        </div>
        <i class="bi bi-chevron-right text-gray-400 transition group-hover:translate-x-1"></i>
    </a>

    <!-- ITEM: My Orders -->
    <a href="orders" class="group flex items-center justify-between p-4 transition hover:bg-gray-50">
        <div class="flex items-center gap-4">
            <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-green-100 text-[#1a3332] transition group-hover:bg-[#1a3332] group-hover:text-white">
                <i class="bi bi-cart text-[18px]"></i>
            </div>
            <span class="text-sm font-semibold text-gray-800">My Orders</span>
        </div>
        <i class="bi bi-chevron-right text-gray-400 transition group-hover:translate-x-1"></i>
    </a>

    <!-- ITEM: Payout Settings -->
    <a href="bank" class="group flex items-center justify-between p-4 transition hover:bg-gray-50">
        <div class="flex items-center gap-4">
            <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-green-100 text-[#1a3332] transition group-hover:bg-[#1a3332] group-hover:text-white">
                <i class="bi bi-credit-card text-[18px]"></i>
            </div>
            <span class="text-sm font-semibold text-gray-800">Payout Settings</span>
        </div>
        <i class="bi bi-chevron-right text-gray-400 transition group-hover:translate-x-1"></i>
    </a>

     <!-- ITEM: Switch Mode (No link, has toggle) -->
    <div class="group flex items-center justify-between p-4 transition hover:bg-gray-50">
        <div class="flex items-center gap-4">
            <div class="flex h-10 w-10 items-center justify-center rounded-2xl 
     bg-blue-100 text-[#1a3332] 
     dark:bg-slate-700 dark:text-blue-400 
     transition group-hover:bg-[#1a3332] group-hover:text-white 
     dark:group-hover:bg-blue-400 dark:group-hover:text-slate-900">
    <i class="bi bi-moon-stars text-[18px]"></i>
</div>
            <span class="text-sm font-semibold text-gray-800">Switch Mode</span>
        </div>
        <button type="button" id="settingsThemeSwitch" class="relative h-6 w-11 rounded-full bg-gray-300 transition-all duration-300">
            <span id="settingsThemeDot" class="absolute left-1 top-1 h-4 w-4 rounded-full bg-white transition-all duration-300"></span>
        </button>
    </div>

    <!-- ITEM: Change Password -->
    <a href="security" class="group flex items-center justify-between p-4 transition hover:bg-gray-50">
        <div class="flex items-center gap-4">
            <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-green-100 text-[#1a3332] transition group-hover:bg-[#1a3332] group-hover:text-white">
                <i class="bi bi-lock text-[18px]"></i>
            </div>
            <span class="text-sm font-semibold text-gray-800">Change Password</span>
        </div>
        <i class="bi bi-chevron-right text-gray-400 transition group-hover:translate-x-1"></i>
    </a>

   

</div>


    <div class="mt-6 mb-8 flex items-center justify-center gap-3 rounded-[1.5rem] border border-red-500/20 bg-red-500/5 p-4 transition hover:bg-red-500/10">

        <i class="bi bi-box-arrow-right text-[18px] text-red-500 transition group-hover:-translate-x-1"></i>

        <span class="text-sm font-bold text-red-500">
            Sign Out Safely
        </span>

    </div>

</button>
</div>
        <br>
        <br>
        <br>

<script>
function copyCode() {
    const codeText = document.getElementById("copyCode").innerText; 
    navigator.clipboard.writeText(codeText)
        .then(() => {
            const alertBox = document.getElementById("copyAlert");
            alertBox.style.opacity = "1";
            alertBox.style.transform = "translateY(0)";

            setTimeout(() => {
                alertBox.style.opacity = "0";
                alertBox.style.transform = "translateY(-10px)";
            }, 1500);
        })
        .catch(() => console.error("Copy failed"));
}
</script>

<?php include "inc/footer2.php" ?>