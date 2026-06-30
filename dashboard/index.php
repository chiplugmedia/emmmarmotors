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
<div class="px-4 pt-5 pb-3 sm:px-0 sm:max-w-[1200px] mx-auto relative z-10">

    <div class="flex items-center justify-between">

        <!-- Profile -->
        <div class="flex items-center gap-3">

            <div class="h-11 w-11 rounded-full bg-blue-50 flex items-center justify-center overflow-hidden border-2 border-blue-100">

                <?php if (!empty($profileImg) && $profileImg !== "no-avatar.png") : ?>
                    <img
                        src="/dashboard/assets/img/profilephotos/<?php echo htmlspecialchars($profileImg); ?>"
                        alt="Profile Photo"
                        class="w-full h-full object-cover">
                <?php else : ?>
                    <img
                        src="/mysite/AVater.jpg"
                        alt="Default Avatar"
                        class="w-full h-full object-cover">
                <?php endif; ?>

            </div>

            <div>
              
<h2 class="font-bold text-gray-900"> Hello <?php echo htmlspecialchars($username); ?>
                    </h2>
               
            </div>

        </div>

    </div>

</div>

<!-- ========================= -->
<!-- BALANCE SKELETON LOADER -->
<!-- ========================= -->
<div id="balanceSkeleton" class="mt-6 p-4 sm:p-6 max-w-[1200px] mx-auto animate-pulse">

    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl p-5 pt-10 pb-10">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-slate-200 dark:bg-slate-700"></div>
            <div class="h-4 w-40 rounded bg-slate-200 dark:bg-slate-700"></div>
        </div>

        <div class="flex items-center gap-3 mt-6">
            <div class="h-10 w-48 rounded bg-slate-200 dark:bg-slate-700"></div>
            <div class="w-6 h-6 rounded bg-slate-200 dark:bg-slate-700"></div>
        </div>
    </div>

    <div class="flex justify-center gap-2 mt-4">
        <div class="w-2 h-2 rounded-full bg-slate-200 dark:bg-slate-700"></div>
        <div class="w-2 h-2 rounded-full bg-slate-200 dark:bg-slate-700"></div>
        <div class="w-2 h-2 rounded-full bg-slate-200 dark:bg-slate-700"></div>
    </div>
</div>

<!-- ========================= -->
<!-- BALANCE SLIDER -->
<!-- ========================= -->
<div id="balanceContent" class="hidden">

<div class="mt-6 p-4 sm:p-6 shadow-sm max-w-[1200px] mx-auto">

<div class="overflow-hidden w-full" id="balanceTrack">
    <div class="flex transition-transform duration-300 ease-in-out" id="balanceInner">

        <!-- SLIDE 1 -->
        <div class="min-w-full box-border px-1">
            <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl p-5 pt-10 pb-10">

                <div class="flex items-center gap-2 text-slate-500 dark:text-slate-400">
                    <img src="/emmmarmotors/mysite/3diconscolor.png" alt="Wallet" class="w-10 h-10 object-contain">

                    <span class="text-xs sm:text-sm">
                        Total Investment Balance
                    </span>
                </div>

                <div class="flex items-center gap-2 mt-4">
                    <h2 class="bal-amount text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-900 dark:text-white blur-md transition-all duration-300 select-none">
                        ₦88,000
                    </h2>

                    <button class="eye-slave text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-white transition">
                        <i class="fas fa-eye-slash text-sm"></i>
                    </button>
                </div>

            </div>
        </div>

        <!-- SLIDE 2 -->
        <div class="min-w-full box-border px-1">
            <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl p-5 pt-10 pb-10">

                <div class="flex items-center gap-2 text-slate-500 dark:text-slate-400">
                    <img src="https://i.ibb.co/21bGyQSY/3dicons-wallet-dynamic-color.png" alt="Wallet" class="w-10 h-10 object-contain">

                    <span class="text-xs sm:text-sm">
                        Total Profit Earned
                    </span>
                </div>

                <div class="flex items-center gap-2 mt-4">
                    <h2 class="bal-amount text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-900 dark:text-white blur-md transition-all duration-300">
                        ₦12,500
                    </h2>

                    <button class="eye-slave text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-white transition">
                        <i class="fas fa-eye-slash text-sm"></i>
                    </button>
                </div>

            </div>
        </div>

        <!-- SLIDE 3 -->
        <div class="min-w-full box-border px-1">
            <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl p-5 pt-10 pb-10">

                <div class="flex items-center gap-2 text-slate-500 dark:text-slate-400">
                    <img src="https://i.ibb.co/21bGyQSY/3dicons-wallet-dynamic-color.png" alt="Wallet" class="w-10 h-10 object-contain">

                    <span class="text-xs sm:text-sm">
                        Available Withdrawal Balance
                    </span>
                </div>

                <div class="flex items-center gap-2 mt-4">
                    <h2 class="bal-amount text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-900 dark:text-white blur-md transition-all duration-300">
                        ₦5,200
                    </h2>

                    <button class="eye-slave text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-white transition">
                        <i class="fas fa-eye-slash text-sm"></i>
                    </button>
                </div>

            </div>
        </div>

    </div>
</div>

<!-- DOTS -->
<div class="flex justify-center gap-2 mt-4">
    <button class="dot w-2 h-2 rounded-full bg-slate-800 dark:bg-white transition-all" data-i="0"></button>
    <button class="dot w-2 h-2 rounded-full bg-slate-300 dark:bg-slate-600 transition-all" data-i="1"></button>
    <button class="dot w-2 h-2 rounded-full bg-slate-300 dark:bg-slate-600 transition-all" data-i="2"></button>
</div>

</div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {

    // Skeleton loading duration
    setTimeout(() => {
        document.getElementById("balanceSkeleton").classList.add("hidden");
        document.getElementById("balanceContent").classList.remove("hidden");
    }, 2000);

    const inner    = document.getElementById('balanceInner');
    const track    = document.getElementById('balanceTrack');
    const dots     = document.querySelectorAll('.dot');
    const amounts  = document.querySelectorAll('.bal-amount');
    const slaves   = document.querySelectorAll('.eye-slave');

    let current = 0;
    let revealed = false;
    let startX = 0;

    function goTo(i) {
        current = i;
        inner.style.transform = `translateX(-${i * 100}%)`;

        dots.forEach((d, idx) => {
            d.classList.toggle('bg-slate-800', idx === i);
            d.classList.toggle('bg-slate-300', idx !== i);
        });
    }

    function syncEyes(rev) {
        revealed = rev;

        amounts.forEach(amount => {
            amount.style.filter = rev ? 'none' : 'blur(6px)';
        });

        slaves.forEach(btn => {
            const icon = btn.querySelector('i');

            if (icon) {
                icon.className = rev
                    ? 'fas fa-eye text-sm'
                    : 'fas fa-eye-slash text-sm';
            }
        });
    }

    dots.forEach(dot => {
        dot.addEventListener('click', () => {
            goTo(+dot.dataset.i);
        });
    });

    slaves.forEach(btn => {
        btn.addEventListener('click', () => {
            syncEyes(!revealed);
        });
    });

    // Swipe Support
    track.addEventListener('touchstart', e => {
        startX = e.touches[0].clientX;
    }, { passive: true });

    track.addEventListener('touchend', e => {
        const diff = startX - e.changedTouches[0].clientX;

        if (Math.abs(diff) > 40) {
            goTo(
                Math.max(
                    0,
                    Math.min(2, current + (diff > 0 ? 1 : -1))
                )
            );
        }
    }, { passive: true });

});
</script>


<!-- ========================= -->
<!-- SUGGESTIONS SKELETON -->
<!-- ========================= -->
<div id="suggestionSkeleton" class="mt-6 max-w-[1200px] mx-auto px-4 animate-pulse">

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
<div id="suggestionContent" class="hidden mt-6 max-w-[1200px] mx-auto px-4">

    <!-- Header -->
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg sm:text-xl font-bold text-slate-900 dark:text-white">
            Explore
        </h2>
    </div>

    <!-- Horizontal Scroll -->
    <div class="flex gap-4 overflow-x-auto pb-2 scrollbar-hide snap-x snap-mandatory">

        <!-- Card 1 -->
        <div class="min-w-[85%] sm:min-w-[420px] snap-start">
            <img
                src=""
                alt=""
                class="w-full h-[140px] sm:h-[170px] object-cover rounded-2xl shadow-sm hover:scale-[1.02] transition duration-300"
            >
        </div>

        <!-- Card 2 -->
        <div class="min-w-[85%] sm:min-w-[420px] snap-start">
            <img
                src=""
                alt=""
                class="w-full h-[140px] sm:h-[170px] object-cover rounded-2xl shadow-sm hover:scale-[1.02] transition duration-300"
            >
        </div>

        <!-- Card 3 -->
        <div class="min-w-[85%] sm:min-w-[420px] snap-start">
            <img
                src=""
                alt=""
                class="w-full h-[140px] sm:h-[170px] object-cover rounded-2xl shadow-sm hover:scale-[1.02] transition duration-300"
            >
        </div>

        <!-- Card 4 -->
        <div class="min-w-[85%] sm:min-w-[420px] snap-start">
            <img
                src="https://storage.googleapis.com/piggybankservice.appspot.com/v5/banner/2024-investment-1.jpg"
                alt=""
                class="w-full h-[140px] sm:h-[170px] object-cover rounded-2xl shadow-sm hover:scale-[1.02] transition duration-300"
            >
        </div>

        <!-- Card 5 -->
        <div class="min-w-[85%] sm:min-w-[420px] snap-start">
            <img
                src="https://storage.googleapis.com/piggybankservice.appspot.com/v5/banner/house-money.jpg"
                alt=""
                class="w-full h-[140px] sm:h-[170px] object-cover rounded-2xl shadow-sm hover:scale-[1.02] transition duration-300"
            >
        </div>

    </div>

</div>

<!-- ========================= -->
<!-- HIDE SCROLLBAR -->
<!-- ========================= -->
<style>
.scrollbar-hide::-webkit-scrollbar{
    display:none;
}
.scrollbar-hide{
    -ms-overflow-style:none;
    scrollbar-width:none;
}
</style>

<!-- ========================= -->
<!-- LOADER SCRIPT -->
<!-- ========================= -->
<script>
document.addEventListener("DOMContentLoaded", function() {

    // Simulate loading
    setTimeout(() => {
        document.getElementById("suggestionSkeleton").classList.add("hidden");
        document.getElementById("suggestionContent").classList.remove("hidden");
    }, 2000);

});
</script>
<!-- ========================= -->
<!-- RECENT TRANSACTIONS SKELETON -->
<!-- ========================= -->
<div id="transactionSkeleton" class="mt-6 max-w-[1200px] mx-auto px-4 sm:px-6 animate-pulse">

    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl overflow-hidden">

        <!-- Header Skeleton -->
        <div class="flex items-center justify-between p-5 border-b border-slate-200 dark:border-slate-700">
            <div class="h-5 w-40 rounded bg-slate-200 dark:bg-slate-700"></div>
            <div class="h-4 w-16 rounded bg-slate-200 dark:bg-slate-700"></div>
        </div>

        <!-- Transaction Skeleton Items -->
        <div class="divide-y divide-slate-100 dark:divide-slate-700">

            <!-- Item 1 -->
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

            <!-- Item 2 -->
            <div class="flex items-center justify-between p-4">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-slate-200 dark:bg-slate-700"></div>

                    <div>
                        <div class="h-4 w-36 rounded bg-slate-200 dark:bg-slate-700 mb-2"></div>
                        <div class="h-3 w-24 rounded bg-slate-200 dark:bg-slate-700"></div>
                    </div>
                </div>

                <div class="text-right">
                    <div class="h-4 w-24 rounded bg-slate-200 dark:bg-slate-700 mb-2"></div>
                    <div class="h-5 w-20 rounded-full bg-slate-200 dark:bg-slate-700"></div>
                </div>
            </div>

            <!-- Item 3 -->
            <div class="flex items-center justify-between p-4">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-slate-200 dark:bg-slate-700"></div>

                    <div>
                        <div class="h-4 w-28 rounded bg-slate-200 dark:bg-slate-700 mb-2"></div>
                        <div class="h-3 w-16 rounded bg-slate-200 dark:bg-slate-700"></div>
                    </div>
                </div>

                <div class="text-right">
                    <div class="h-4 w-20 rounded bg-slate-200 dark:bg-slate-700 mb-2"></div>
                    <div class="h-5 w-16 rounded-full bg-slate-200 dark:bg-slate-700"></div>
                </div>
            </div>

            <!-- Item 4 -->
            <div class="flex items-center justify-between p-4">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-slate-200 dark:bg-slate-700"></div>

                    <div>
                        <div class="h-4 w-32 rounded bg-slate-200 dark:bg-slate-700 mb-2"></div>
                        <div class="h-3 w-20 rounded bg-slate-200 dark:bg-slate-700"></div>
                    </div>
                </div>

                <div class="text-right">
                    <div class="h-4 w-24 rounded bg-slate-200 dark:bg-slate-700 mb-2"></div>
                    <div class="h-5 w-20 rounded-full bg-slate-200 dark:bg-slate-700"></div>
                </div>
            </div>

        </div>

    </div>

</div>


<!-- ========================= -->
<!-- VETTED OPPORTUNITIES SKELETON -->
<!-- ========================= -->
<div id="opportunitySkeleton" class="mt-6 px-4 animate-pulse">

    <div class="flex items-center justify-between mb-5">
        <div class="h-6 w-44 bg-slate-200 dark:bg-slate-700 rounded"></div>
        <div class="h-5 w-20 bg-slate-200 dark:bg-slate-700 rounded"></div>
    </div>

    <div class="flex gap-4 overflow-hidden">

        <div class="min-w-[280px] bg-white dark:bg-slate-800 rounded-2xl overflow-hidden">
            <div class="h-40 bg-slate-200 dark:bg-slate-700"></div>
            <div class="p-4">
                <div class="h-3 w-20 bg-slate-200 dark:bg-slate-700 rounded mb-3"></div>
                <div class="h-4 w-full bg-slate-200 dark:bg-slate-700 rounded mb-2"></div>
                <div class="h-4 w-3/4 bg-slate-200 dark:bg-slate-700 rounded mb-4"></div>
                <div class="h-3 w-28 bg-slate-200 dark:bg-slate-700 rounded"></div>
            </div>
        </div>

        <div class="min-w-[280px] bg-white dark:bg-slate-800 rounded-2xl overflow-hidden">
            <div class="h-40 bg-slate-200 dark:bg-slate-700"></div>
            <div class="p-4">
                <div class="h-3 w-20 bg-slate-200 dark:bg-slate-700 rounded mb-3"></div>
                <div class="h-4 w-full bg-slate-200 dark:bg-slate-700 rounded mb-2"></div>
                <div class="h-4 w-3/4 bg-slate-200 dark:bg-slate-700 rounded mb-4"></div>
                <div class="h-3 w-28 bg-slate-200 dark:bg-slate-700 rounded"></div>
            </div>
        </div>

        <div class="min-w-[280px] bg-white dark:bg-slate-800 rounded-2xl overflow-hidden">
            <div class="h-40 bg-slate-200 dark:bg-slate-700"></div>
            <div class="p-4">
                <div class="h-3 w-20 bg-slate-200 dark:bg-slate-700 rounded mb-3"></div>
                <div class="h-4 w-full bg-slate-200 dark:bg-slate-700 rounded mb-2"></div>
                <div class="h-4 w-3/4 bg-slate-200 dark:bg-slate-700 rounded mb-4"></div>
                <div class="h-3 w-28 bg-slate-200 dark:bg-slate-700 rounded"></div>
            </div>
        </div>

    </div>

</div>

<!-- ========================= -->
<!-- VETTED OPPORTUNITIES -->
<!-- ========================= -->
<div id="opportunityContent" class="hidden mt-6 px-4">

    <!-- Header -->
    <div class="flex items-center justify-between mb-5">

        <h2 class="text-xl font-bold text-slate-900 dark:text-white">
            Vetted Opportunities
        </h2>

        <a href="#"
           class="text-purple-600 hover:text-purple-700 font-medium text-sm">
            Find More →
        </a>

    </div>

    <!-- Horizontal Cards -->
    <div class="flex gap-4 overflow-x-auto pb-3 snap-x snap-mandatory scrollbar-hide">

        <!-- CARD 1 -->
        <div class="min-w-[280px] max-w-[280px] bg-white dark:bg-slate-800 rounded-2xl overflow-hidden shadow-sm border border-slate-100 dark:border-slate-700 snap-start">

            <div class="relative">

                <img
                    src="3"
                    class="w-full h-40 object-cover">

                <span class="absolute top-3 right-3 bg-rose-600 text-white text-xs px-3 py-1 rounded-full">
                    ₦5K • SOLD OUT
                </span>

            </div>

            <div class="p-4">

                <p class="text-xs text-slate-500">
                    INVESTORS: <b>715</b> ⚡
                </p>

                <h3 class="mt-2 font-semibold text-slate-900 dark:text-white">
                    CORPORATE DEBT NOTES SERIES LXXII
                </h3>

                <p class="text-sm text-slate-500 mt-2">
                    <b>19.9%</b> • returns in 12 months
                </p>

            </div>

        </div>

        <!-- CARD 2 -->
        <div class="min-w-[280px] max-w-[280px] bg-white dark:bg-slate-800 rounded-2xl overflow-hidden shadow-sm border border-slate-100 dark:border-slate-700 snap-start">

            <div class="relative">

                <img
                    src="3"
                    class="w-full h-40 object-cover">

                <span class="absolute top-3 right-3 bg-rose-600 text-white text-xs px-3 py-1 rounded-full">
                    ₦5K • SOLD OUT
                </span>

            </div>

            <div class="p-4">

                <p class="text-xs text-slate-500">
                    INVESTORS: <b>541</b> ⚡
                </p>

                <h3 class="mt-2 font-semibold text-slate-900 dark:text-white">
                    CORPORATE DEBT NOTES SERIES LXIV-B
                </h3>

                <p class="text-sm text-slate-500 mt-2">
                    <b>3.9%</b> • returns in 3 months
                </p>

            </div>

        </div>

        <!-- CARD 3 -->
        <div class="min-w-[280px] max-w-[280px] bg-white dark:bg-slate-800 rounded-2xl overflow-hidden shadow-sm border border-slate-100 dark:border-slate-700 snap-start">

            <div class="relative">

                <img
                    src="3"
                    class="w-full h-40 object-cover">

                <span class="absolute top-3 right-3 bg-rose-600 text-white text-xs px-3 py-1 rounded-full">
                    ₦5K • SOLD OUT
                </span>

            </div>

            <div class="p-4">

                <p class="text-xs text-slate-500">
                    INVESTORS: <b>524</b> ⚡
                </p>

                <h3 class="mt-2 font-semibold text-slate-900 dark:text-white">
                    Advans La Fayette MFB Commercial Paper
                </h3>

                <p class="text-sm text-slate-500 mt-2">
                    <b>20.6%</b> • returns in 12 months
                </p>

            </div>

        </div>

    </div>

</div>

<style>
.scrollbar-hide::-webkit-scrollbar{
    display:none;
}
.scrollbar-hide{
    scrollbar-width:none;
    -ms-overflow-style:none;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", () => {

    // Simulate loading
    setTimeout(() => {
        document.getElementById("opportunitySkeleton").classList.add("hidden");
        document.getElementById("opportunityContent").classList.remove("hidden");
    }, 2000);

});
</script>

<!-- ========================= -->
<!-- RECENT TRANSACTIONS -->
<!-- ========================= -->
<div id="transactionContent" class="hidden mt-6 max-w-[1200px] mx-auto px-4 sm:px-6">

    <div class="bg-white dark:bg-slate-800 mb-30 border border-slate-200 dark:border-slate-700 rounded-2xl overflow-hidden">

        <!-- Header -->
        <div class="flex items-center justify-between p-5 border-b border-slate-200 dark:border-slate-700">
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">
                Recent Activities
            </h3>

            <a href="#" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                View All
            </a>
        </div>

        <!-- Transactions -->
        <div class="divide-y divide-slate-100 dark:divide-slate-700">

            <div class="flex items-center justify-between p-4">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                        <i class="fas fa-arrow-down text-green-600"></i>
                    </div>

                    <div>
                        <h4 class="font-medium text-slate-900 dark:text-white">
                            Investment Deposit
                        </h4>
                        <p class="text-xs text-slate-500">
                            Today • 10:45 AM
                        </p>
                    </div>
                </div>

                <div class="text-right">
                    <p class="font-semibold text-green-600">
                        +₦50,000
                    </p>
                   
                </div>
            </div>

            <div class="flex items-center justify-between p-4">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center">
                        <i class="fas fa-wallet text-red-600"></i>
                    </div>

                    <div>
                        <h4 class="font-medium text-slate-900 dark:text-white">
                            Withdrawal Request
                        </h4>
                        <p class="text-xs text-slate-500">
                            Jun 29 • 2:30 PM
                        </p>
                    </div>
                </div>

                <div class="text-right">
                    <p class="font-semibold text-red-600">
                        -₦15,000
                    </p>
                    <span class="text-xs text-yellow-600 bg-yellow-100 px-2 py-1 rounded-full">
                        Pending
                    </span>
                </div>
            </div>

        </div>

    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // Simulate loading
    setTimeout(() => {
        document.getElementById("transactionSkeleton").classList.add("hidden");
        document.getElementById("transactionContent").classList.remove("hidden");
    }, 2000);

});
</script>



       <?php include "inc/footer2.php" ?>