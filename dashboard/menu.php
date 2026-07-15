<?php
require $_SERVER['DOCUMENT_ROOT']."/emmmarmotors/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/actions/account-settings.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/actions/password.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/actions/buyprod.php";


$ptitle="Menu";
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

<div class="px-4 py-4 space-y-5 mt-[5px] max-w-[590px] mx-auto">

    <!-- PROFILE CARD -->
    <div class="relative overflow-hidden rounded-2xl
                bg-white dark:bg-slate-900
                border border-slate-200 dark:border-slate-700
                p-6
                text-slate-900 dark:text-white
                shadow-sm dark:shadow-none">

        <!-- Glow -->
        <div class="absolute top-0 right-0 h-32 w-32 rounded-full bg-blue-500/10 dark:bg-blue-500/20 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 h-32 w-32 rounded-full bg-blue-400/10 dark:bg-blue-400/20 blur-3xl"></div>

        <div class="relative z-10 flex flex-col items-center text-center">

            <!-- Avatar -->
            <div class="mb-4 h-24 w-24 overflow-hidden rounded-full
                        border-4 border-slate-200 dark:border-white/20
                        bg-slate-100 dark:bg-white/10
                        shadow-xl">

                <?php
                if ($profileImg == "no-avatar.png") {
                    echo '<img src="/invest/mysite/bandogreen.jfif" class="h-full w-full object-cover">';
                } else {
                    echo '<img src="/emmmarmotors/dashboard/assets/img/profilephotos/' . $profileImg . '" class="h-full w-full object-cover">';
                }
                ?>
            </div>

            <!-- User -->
            <h2 class="mb-1 text-xl font-bold tracking-tight text-slate-900 dark:text-white">
                <?php echo $firstname ?> <?php echo $lastname ?>
            </h2>

            <p class="text-sm text-slate-600 dark:text-slate-300">
                <?php echo $email ?>
            </p>

        </div>
    </div>





  <!-- Profile -->
<div>

    <p class="mb-6 ml-3 text-[11px] font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">
        Profile
    </p>

    <div class="overflow-hidden border border-gray-200 dark:border-gray-200 rounded-2xl bg-[#fff] dark:bg-slate-800/50 divide-y divide-gray-100 dark:divide-white/5 transition-colors duration-300">

      <!-- ITEM: Account Settings -->
<a href="profile" class="group flex items-center justify-between p-4 transition-all duration-300 hover:bg-gray-50 dark:hover:bg-white/5">
    <div class="flex items-center gap-4">
        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-[#052da7]/10 text-[#052da7] transition-all duration-300 group-hover:bg-[#052da7] group-hover:text-white dark:bg-[#052da7]/20 dark:text-[#052da7] dark:group-hover:bg-[#052da7] dark:group-hover:text-white">
            <i class="bi bi-person-circle text-[18px]"></i>
        </div>
        <div>
            <span class="text-sm font-semibold text-gray-800 dark:text-gray-200 transition-colors duration-300">Personal Information</span>
            <p class="text-xs text-gray-500 dark:text-gray-400 transition-colors duration-300">Manage your personal information</p>
        </div>
    </div>
    <i class="bi bi-chevron-right text-gray-400 dark:text-gray-600 transition-all duration-300 group-hover:translate-x-1"></i>
</a>
<?php if ($accountVerified == 0): ?>

      <!-- ITEM: Account Verification -->
<a href="verify" class="group flex items-center justify-between p-4 transition-all duration-300 hover:bg-gray-50 dark:hover:bg-white/5">
    <div class="flex items-center gap-4">
        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-[#052da7]/10 text-[#052da7] transition-all duration-300 group-hover:bg-[#052da7] group-hover:text-white dark:bg-[#052da7]/20 dark:text-[#052da7] dark:group-hover:bg-[#052da7] dark:group-hover:text-white">
<i class="bi bi-credit-card text-[18px]"></i>

        </div>
        <div>
            <span class="text-sm font-semibold text-gray-800 dark:text-gray-200 transition-colors duration-300">Account Verification</span>
            <p class="text-xs text-gray-500 dark:text-gray-400 transition-colors duration-300 mt-0.5">Verify your account status</p>
        </div>
    </div>
    <i class="bi bi-chevron-right text-gray-400 dark:text-gray-600 transition-all duration-300 group-hover:translate-x-1"></i>
</a>
<?php endif; ?>


     <!-- ITEM: Payout Bank -->
<a href="bank" class="group flex items-center justify-between p-4 transition-all duration-300 hover:bg-gray-50 dark:hover:bg-white/5">
    <div class="flex items-center gap-4">
        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-[#052da7]/10 text-[#052da7] transition-all duration-300 group-hover:bg-[#052da7] group-hover:text-white dark:bg-[#052da7]/20 dark:text-[#052da7] dark:group-hover:bg-[#052da7] dark:group-hover:text-white">
            <i class="bi bi-bank text-[18px]"></i>
        </div>
        <div>
            <span class="text-sm font-semibold text-gray-800 dark:text-gray-200 transition-colors duration-300">Payout Bank</span>
            <p class="text-xs text-gray-500 dark:text-gray-400 transition-colors duration-300 mt-0.5">Manage your bank details for payouts</p>
        </div>
    </div>
    <i class="bi bi-chevron-right text-gray-400 dark:text-gray-600 transition-all duration-300 group-hover:translate-x-1"></i>
</a>

    
    </div>
</div>


 <!-- security -->
<div>

    <p class="mb-6 ml-3 text-[11px] font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">
        security
    </p>

    <div class="overflow-hidden rounded-2xl border border-gray-200 dark:border-gray-200 bg-[#fff] dark:bg-slate-800/50 divide-y divide-gray-100 dark:divide-white/5 transition-colors duration-300">


<!-- ITEM: Transaction Pin -->
<a href="tranpin" class="group flex items-center justify-between p-4 transition-all duration-300 hover:bg-gray-50 dark:hover:bg-white/5">
    <div class="flex items-center gap-4">
        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-[#052da7]/10 text-[#052da7] transition-all duration-300 group-hover:bg-[#052da7] group-hover:text-white dark:bg-[#052da7]/20 dark:text-[#052da7] dark:group-hover:bg-[#052da7] dark:group-hover:text-white">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
            </svg>
        </div>
        <div>
            <span class="text-sm font-semibold text-gray-800 dark:text-gray-200 transition-colors duration-300">Transaction Pin</span>
            <p class="text-xs text-gray-500 dark:text-gray-400 transition-colors duration-300 mt-0.5">Set your transaction PIN</p>
        </div>
    </div>
    <svg class="w-4 h-4 text-gray-400 dark:text-gray-600 transition-all duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
    </svg>
</a>

       <!-- ITEM: Change Password -->
<a href="security" class="group flex items-center justify-between p-4 transition-all duration-300 hover:bg-gray-50 dark:hover:bg-white/5">
    <div class="flex items-center gap-4">
        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-[#052da7]/10 text-[#052da7] transition-all duration-300 group-hover:bg-[#052da7] group-hover:text-white dark:bg-[#052da7]/20 dark:text-[#052da7] dark:group-hover:bg-[#052da7] dark:group-hover:text-white">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
        </div>
        <div>
            <span class="text-sm font-semibold text-gray-800 dark:text-gray-200 transition-colors duration-300">Change Password</span>
            <p class="text-xs text-gray-500 dark:text-gray-400 transition-colors duration-300 mt-0.5">Change your Change Password</p>
        </div>
    </div>
    <svg class="w-4 h-4 text-gray-400 dark:text-gray-600 transition-all duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
    </svg>
</a>
        <!-- ITEM: Switch Mode (No link, has toggle) -->
        <div class="group flex items-center justify-between p-4 transition-all duration-300 hover:bg-gray-50 dark:hover:bg-white/5">
            <div class="flex items-center gap-4">
                <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-[#052da7]/10 text-[#052da7] transition-all duration-300 group-hover:bg-[#052da7] group-hover:text-white dark:bg-[#052da7]/20 dark:text-[#052da7] dark:group-hover:bg-[#052da7] dark:group-hover:text-white">
                    <i class="bi bi-moon-stars text-[18px]"></i>
                </div>
                <span class="text-sm font-semibold text-gray-800 dark:text-gray-200 transition-colors duration-300">Switch Mode</span>
            </div>
            <button type="button" id="settingsThemeSwitch" class="relative h-6 w-11 rounded-full bg-gray-300 dark:bg-[#052da7] transition-all duration-300">
                <span id="settingsThemeDot" class="absolute left-1 top-1 h-4 w-4 rounded-full bg-white shadow-md transition-all duration-300 dark:translate-x-5"></span>
            </button>
        </div>


    </div>
</div>



 <!-- Others -->
<div>

    <p class="mb-6 ml-3 text-[11px] font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">
        Others
    </p>

    <div class="overflow-hidden rounded-2xl border border-gray-200 dark:border-gray-200 bg-[#fff] dark:bg-slate-800/50 divide-y divide-gray-100 dark:divide-white/5 transition-colors duration-300">

<!-- ITEM: Help and support -->
<a href="transaction" class="group flex items-center justify-between p-4 transition-all duration-300 hover:bg-gray-50 dark:hover:bg-white/5">
    <div class="flex items-center gap-4">
        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-[#052da7]/10 text-[#052da7] transition-all duration-300 group-hover:bg-[#052da7] group-hover:text-white dark:bg-[#052da7]/20 dark:text-[#052da7] dark:group-hover:bg-[#052da7] dark:group-hover:text-white">
            <i class="fas fa-headset text-[18px]"></i>
        </div>
        <div>
            <span class="text-sm font-semibold text-gray-800 dark:text-gray-200 transition-colors duration-300">Help and support</span>
            <p class="text-xs text-gray-500 dark:text-gray-400 transition-colors duration-300 mt-0.5">Get support or submit a complaint</p>
        </div>
    </div>
    <i class="fas fa-chevron-right text-gray-400 dark:text-gray-600 transition-all duration-300 group-hover:translate-x-1"></i>
</a>

<!-- ITEM: About Emmmar Motors -->
<a href="security" class="group flex items-center justify-between p-4 transition-all duration-300 hover:bg-gray-50 dark:hover:bg-white/5">
    <div class="flex items-center gap-4">
        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-[#052da7]/10 text-[#052da7] transition-all duration-300 group-hover:bg-[#052da7] group-hover:text-white dark:bg-[#052da7]/20 dark:text-[#052da7] dark:group-hover:bg-[#052da7] dark:group-hover:text-white">
            <i class="fas fa-info-circle text-[18px]"></i>
        </div>
        <div>
            <span class="text-sm font-semibold text-gray-800 dark:text-gray-200 transition-colors duration-300">About Emmmar Motors</span>
            <p class="text-xs text-gray-500 dark:text-gray-400 transition-colors duration-300 mt-0.5">Learn more about Emmmar Motors</p>
        </div>
    </div>
    <i class="fas fa-chevron-right text-gray-400 dark:text-gray-600 transition-all duration-300 group-hover:translate-x-1"></i>
</a>
       

    </div>
</div>
<a href="logout.php" class="block">
    <div class="mt-6 mb-8 flex items-center justify-center gap-3 rounded-2xl border border-red-500/20 bg-red-500/5 p-4 transition hover:bg-red-500/10 group">
        <i class="bi bi-box-arrow-right text-[18px] text-red-500 transition group-hover:-translate-x-1"></i>
        <span class="text-sm font-bold text-red-500">
            Sign Out Safely
        </span>
    </div>
</a>

</button>


</div>
<!-- Simple version in footer -->
<div class="text-center text-xs text-gray-500 dark:text-gray-400 py-4">
    <span>Version 1.0.0</span>
    <span class="mx-2">•</span>
    <span>© 2026 Emmmar Motors</span>
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