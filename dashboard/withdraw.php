<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require $_SERVER['DOCUMENT_ROOT']."/invest/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/actions/withdraw.php";

$masked_username = substr($acctNum, 0, 6) . '****' . substr($acctNum, -4);


$ptitle="Request Withdrawal";
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



<div class="space-y-1 mt-[80px]"><h2 class="text-xl font-bold tracking-tight">Withdraw Funds</h2><p class="text-xs text-muted-foreground font-medium">Withdraw your earnings to your linked bank account.</p></div>

<div class="relative overflow-hidden rounded-3xl bg-[#1a3332] p-6 text-white shadow-xl mt-[20px]">

    <!-- Background glow -->
    <div class="pointer-events-none absolute -bottom-10 -right-10 h-32 w-32 rounded-full bg-white/10 blur-2xl"></div>

    <div class="relative z-10 space-y-6">

        <!-- Header -->
        <div class="flex items-start justify-between">

            <div class="space-y-1">
                <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-white/60">
                    Bank Details
                </p>
                <p class="text-lg font-black">
                    <?php echo $bankName; ?>
                </p>
            </div>

            <i class="fas fa-landmark text-2xl text-white/40"></i>

        </div>

        <!-- Account Number -->
        <div class="space-y-1">

            <p class="text-[10px] font-bold uppercase text-white/50">
                Account Number
            </p>

            <div class="flex items-center justify-between">

                <p class="text-3xl font-black tracking-wider">
                    <?php echo $acctName?>
                </p>
            
            </div>
        </div>

        <!-- Account Name -->
        <div class="space-y-1 pt-2">

            <p class="text-[10px] font-bold uppercase text-white/50">
                Account Name
            </p>

            <p class="truncate text-sm font-bold">
                <?php echo $masked_username?>
            </p>

        </div>

    </div>

</div>

<div class="mt-[20px] rounded-2xl p-5 text-sm">

  <?php echo $genMsg; ?>

  <form action="" id="fundWalletForm" method="post">

    <input type="hidden" name="email" value="waxsng@gmail.com">
    <input type="hidden" name="phone" value="<?php echo $username?>">

    <!-- Amount Section -->
    <div class="space-y-4">

      <label for="withdraw-amount" class="text-sm font-semibold text-[#1a3332]">
        Amount
      </label>

      <!-- Quick Amount Buttons -->
      <div class="flex flex-wrap gap-2">

        <button type="button" data-amount="1000"
          class="amount-option rounded-lg bg-[#1a3332]/10 px-3 py-2 text-sm text-[#1a3332] transition hover:bg-[#1a3332]/20 active:scale-95">
          ₦1,000
        </button>

        <button type="button" data-amount="5000"
          class="amount-option rounded-lg bg-[#1a3332]/10 px-3 py-2 text-sm text-[#1a3332] transition hover:bg-[#1a3332]/20 active:scale-95">
          ₦5,000
        </button>

        <button type="button" data-amount="10000"
          class="amount-option rounded-lg bg-[#1a3332]/10 px-3 py-2 text-sm text-[#1a3332] transition hover:bg-[#1a3332]/20 active:scale-95">
          ₦10,000
        </button>

        <button type="button" data-amount="20000"
          class="amount-option rounded-lg bg-[#1a3332]/10 px-3 py-2 text-sm text-[#1a3332] transition hover:bg-[#1a3332]/20 active:scale-95">
          ₦20,000
        </button>

        <button type="button" data-amount="50000"
          class="amount-option rounded-lg bg-[#1a3332]/10 px-3 py-2 text-sm text-[#1a3332] transition hover:bg-[#1a3332]/20 active:scale-95">
          ₦50,000
        </button>

        <button type="button" data-amount="100000"
          class="amount-option rounded-lg bg-[#1a3332]/10 px-3 py-2 text-sm text-[#1a3332] transition hover:bg-[#1a3332]/20 active:scale-95">
          ₦100,000
        </button>

        <button type="button" data-amount="500000"
          class="amount-option rounded-lg bg-[#1a3332]/10 px-3 py-2 text-sm text-[#1a3332] transition hover:bg-[#1a3332]/20 active:scale-95">
          ₦500,000
        </button>

      </div>

      <!-- Input -->
      <div class="relative">

        <span class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-[#1a3332]/70">
          ₦
        </span>

        <input type="number"
          id="withdraw-amount"
          name="amount"
          placeholder="Enter amount to fund"
          required
          class="w-full rounded-lg border border-[#1a3332]/30 bg-[#FEFBEF] py-3 pl-8 pr-4 text-[#1a3332] placeholder-[#1a3332]/40 outline-none focus:ring-2 focus:ring-[#1a3332]">

      </div>

      <!-- Submit -->
      <button type="submit"
        name="paying"
        class="group relative flex w-full items-center justify-center gap-2 rounded-md bg-[#2F4F4E] py-3.5 font-semibold text-white transition-all duration-300
         hover:-translate-y-1
         hover:rotate-[-2deg]
         active:scale-95">

        <i class="fas fa-money-bill-wave"></i>
        Withdraw Now

      </button>

    </div>

  </form>

</div>

<script>
const input = document.getElementById('withdraw-amount');
const buttons = document.querySelectorAll('.amount-option');

buttons.forEach(btn => {
  btn.addEventListener('click', () => {
    input.value = btn.dataset.amount;

    buttons.forEach(b => {
      b.classList.remove('bg-[#2F4F4E]', 'text-white');
      b.classList.add('bg-[#1a3332]/10', 'text-[#1a3332]');
    });

    btn.classList.add('bg-[#2F4F4E]', 'text-white');
    btn.classList.remove('bg-[#1a3332]/10', 'text-[#1a3332]');
  });
});

input.addEventListener('input', () => {
  buttons.forEach(b => {
    b.classList.remove('bg-[#2F4F4E]', 'text-white');
    b.classList.add('bg-[#1a3332]/10', 'text-[#1a3332]');
  });
});
</script>


    <?php include "inc/footer2.php" ?>