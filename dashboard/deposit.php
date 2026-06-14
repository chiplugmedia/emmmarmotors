<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require $_SERVER['DOCUMENT_ROOT']."/invest/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/actions/dsociopay/pay.php";


$ptitle="Deposit";
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
<div class="space-y-1 mt-[80px]"><h2 class="text-xl font-bold tracking-tight">Wallet Funding</h2><p class="text-xs text-muted-foreground font-medium">Add money to your wallet via bank transfer.</p></div>

<div class="relative rounded-3xl bg-[#000] p-5 text-white shadow-lg mt-[20px]">

    <div class="relative z-10 flex items-center justify-between">

        <div class="space-y-1">

            <!-- Label -->
            <div class="flex items-center gap-2 text-white/60">

                <i class="bi bi-wallet2 text-xs"></i>

                <span class="text-[10px] font-bold uppercase tracking-widest">
                    Current Balance
                </span>

            </div>

            <!-- Amount -->
            <h2 class="text-2xl font-black">
                <span class="mr-1 text-sm font-medium">₦</span><?php echo number_format((int)$funds, 2) ?>
            </h2>

        </div>

    </div>

</div>

<?php
// =====================
// FETCH USER ACCOUNT
// =====================
$sql = $link->prepare("SELECT * FROM virtualaccounts WHERE username = ?");
$sql->bind_param('s', $username);
$sql->execute();
$result = $sql->get_result();

$hasAccount = false;
$accountnumber = "";
$accountname = "";
$bankname = "";

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();

    $accountnumber = $row['accountnumber'];
    $accountname   = $row['accountname'];
    $bankname      = $row['bankname'];

    $hasAccount = true;
}
?>

<!-- ===================== -->
<!-- IF USER HAS ACCOUNT -->
<!-- ===================== -->
<?php if ($hasAccount): ?>

<div class="relative mt-[20px] overflow-hidden rounded-3xl bg-[#1a3332] p-6 text-white shadow-xl">

    <!-- Glow -->
    <div class="pointer-events-none absolute -bottom-10 -right-10 h-32 w-32 rounded-full bg-white/10 blur-2xl"></div>

    <div class="relative z-10 space-y-6">

        <!-- Header -->
        <div class="flex items-start justify-between">

            <div class="space-y-1">
                <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-white/60">
                    Bank Details
                </p>
                <p class="text-lg font-black">
                    <?= htmlspecialchars($bankname) ?>
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

                <p id="accNumber" class="text-3xl font-black tracking-wider">
                    <?= htmlspecialchars($accountnumber) ?>
                </p>

                <button type="button"
                        onclick="copyAccount()"
                        class="rounded-xl bg-white px-3 py-2 text-[#1a3332] transition hover:bg-white/90">

                    <i class="bi bi-copy"></i>

                </button>

            </div>

            <small id="copyMsg" class="mt-2 hidden text-white/80">
                Copied!
            </small>

        </div>

        <!-- Account Name -->
        <div class="space-y-1 pt-2">

            <p class="text-[10px] font-bold uppercase text-white/50">
                Account Name
            </p>

            <p class="truncate text-sm font-bold">
                <?= htmlspecialchars($accountname) ?>
            </p>

        </div>

    </div>
</div>

<?php endif; ?>


<!-- ===================== -->
<!-- IF NO ACCOUNT -->
<!-- ===================== -->
<?php if (!$hasAccount): ?>

<div class="mx-auto mt-[20px] max-w-md rounded-2xl border border-[#1a3332] bg-[#FEFBEF] p-6 text-center">
<?php echo $genMsg; ?>
    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-green-50">
        <i class="fas fa-bank text-2xl text-[#1a3332]"></i>
    </div>

    <h3 class="text-lg font-bold text-gray-800">
        No Virtual Account
    </h3>

    <p class="mt-2 text-sm text-gray-500">
        Click below to generate a permanent virtual account for instant funding.
    </p>

    <form method="POST" class="mt-5 space-y-3">

        <input type="hidden" name="email" value="waxsng@gmail.com">
        <input type="hidden" name="phone" value="<?= htmlspecialchars($username) ?>">

        <button type="submit"
                name="paying"
                class="group relative flex w-full items-center justify-center gap-2 rounded-md bg-[#2F4F4E] py-3.5 font-semibold text-white transition-all duration-300
         hover:-translate-y-1
         hover:rotate-[-2deg]
         active:scale-95">

            Generate My Account

        </button>

    </form>

</div>

<?php endif; ?>

<div class="border border-[#1a3332] bg-[#FEFBEF] rounded-[2rem] p-6 space-y-4 mt-[20px]">

    <!-- TOP CONTENT -->
    <div class="flex gap-4 items-center">

        <!-- ICON -->
        <div class="h-12 w-12 rounded-2xl bg-green-500/20 flex items-center justify-center text-[#1a3332] shrink-0">
            <i class="fas fa-comment-dots text-xl"></i>
        </div>

        <!-- TEXT -->
        <div class="space-y-1">
            <p class="text-sm font-black text-[#1a3332]">
                Deposit not reflecting?
            </p>

            <p class="text-xs text-gray-600 leading-relaxed font-semibold">
                If your funding hasn't reflected after 5 minutes, please chat with our customer service to help confirm your deposit.
            </p>
        </div>

    </div>

    <!-- BUTTON -->
    <a href="<?php echo $sitetag; ?>"
       target="_blank"
       rel="noreferrer"
       class="block">

        <div class="group relative flex w-full items-center justify-center gap-2 rounded-md bg-[#2F4F4E] py-3.5 font-semibold text-white transition-all duration-300
         hover:-translate-y-1
         hover:rotate-[-2deg]
         active:scale-95">
            CHAT WITH CUSTOMER SERVICE
        </div>

    </a>

</div>

<!-- ===================== -->
<!-- COPY SCRIPT -->
<!-- ===================== -->
<script>
function copyAccount() {
    const text = document.getElementById("accNumber").innerText;

    navigator.clipboard.writeText(text).then(() => {
        const msg = document.getElementById("copyMsg");

        msg.classList.remove("hidden");

        setTimeout(() => {
            msg.classList.add("hidden");
        }, 1500);
    });
}
</script>

<?php include "inc/footer2.php" ?>