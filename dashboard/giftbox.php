<?php
require $_SERVER['DOCUMENT_ROOT']."/invest/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/actions/main.php";

$ptitle="Redeem Gift Voucher";
include "inc/header2.php" ?>



<div class="pt-15">
    <div class="fixed left-1/2 top-0 z-50 flex w-full max-w-[590px] -translate-x-1/2 items-center justify-between 
                rounded-b-3xl bg-white/70 backdrop-blur-md shadow-lg border-gray-200 px-4 py-3 mb-5">

        <!-- Back Button -->
        <div class="flex min-w-[40px] items-center gap-2">
            <a href="javascript:history.back()"
               class="flex h-8 w-8 items-center justify-center rounded-full bg-white text-white shadow-sm transition hover:bg-gray-100">

                <i class="bi bi-chevron-left text-sm text-[#ad050b]"></i>

            </a>
        </div>

        <!-- Title -->
        <h1 class="text-md font-semibold text-gray-800">
            <?php echo $ptitle?>
        </h1>

        <!-- Right Side -->
        <div class="flex min-w-[40px] justify-end"></div>

    </div>
</div>


<!-- CONTAINER -->
<div class="max-w-md mx-auto px-4 mt-[80px]">

    <div class="bg-white shadow-sm border border-gray-100 rounded-2xl p-5">
<?php echo $genMsg; ?>
        <form action="" method="post" class="space-y-4">

            <!-- INPUT -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Bonus Code
                </label>

                <input
                    type="text"
                    name="coupon"
                    id="coupon"
                    placeholder="Xona-9768-6R7J"
                    class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                >
            </div>

            <!-- BUTTON -->
            <button
                type="submit"
                name="giftBonus"
                class="w-full bg-[#750000] text-white py-3 rounded-xl font-semibold hover:bg-red-700 transition"
            >
                Proceed
            </button>

        </form>

    </div>

</div>


<?php include "inc/footer2.php" ?>