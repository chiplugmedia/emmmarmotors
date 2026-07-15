<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require $_SERVER['DOCUMENT_ROOT']."/invest/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/includes/generalinclude.php";

$ptitle="Team Members";
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

    
<div class="mx-auto mt-[80px] max-w-3xl space-y-5 p-4">

  <!-- ================= HERO ================= -->
  <div class="relative overflow-hidden rounded-2xl border border-red-100 bg-white shadow-sm">

    <img
      src="/mysite/VZentry35.jpeg"
      alt="Product slide 1"
      class="h-auto w-full object-cover"
    >

    <!-- dots -->
    <div id="slider-dots" class="absolute bottom-3 left-1/2 flex -translate-x-1/2 gap-2"></div>

  </div>

  <!-- ================= STATS ================= -->
  <div class="flex overflow-hidden rounded-2xl border border-[#1a3332] bg-[#FEFBEF] shadow-sm">

    <!-- RANK -->
    <div class="flex flex-1 flex-col items-center justify-center border-r border-gray-100 py-4">

      <div class="flex items-center gap-2 text-base font-semibold text-gray-900">
        <span class="flex h-6 w-6 items-center justify-center text-red-600">
          <?php echo $userIcon; ?>
        </span>
        <span><?php echo htmlspecialchars($userRank); ?></span>
      </div>

      <div class="mt-1 text-xs text-gray-500">Rank</div>

    </div>

    <!-- REFERRALS -->
    <div class="flex flex-1 flex-col items-center justify-center border-r border-gray-100 py-4">

      <div class="text-base font-bold text-gray-900">
        <?php echo $totalReferralsAll ?>
      </div>

      <div class="mt-1 text-xs text-gray-500">Total Invitation</div>

    </div>

    <!-- VALID -->
    <div class="flex flex-1 flex-col items-center justify-center py-4">

      <div class="text-base font-bold text-gray-900">
        <?php echo $totalActiveAll ?>
      </div>

      <div class="mt-1 text-xs text-gray-500">Total Valid</div>

    </div>

  </div>

  <!-- ================= LEVELS ================= -->
  <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

    <!-- LEVEL 1 -->
    <div class="flex flex-col items-center gap-2 rounded-2xl border border-[#1a3332] bg-[#FEFBEF] p-4">

      <div class="text-center text-sm font-semibold text-gray-900">
        Referral Commission <span class="text-[#1a3332]">1st Level (10%)</span>
      </div>

      <div class="text-2xl font-black text-gray-900">
        <?php echo $totalReferrals ?>
      </div>

      <a href="/invest/dashboard/details?reference=1"
   class="inline-flex items-center justify-center rounded-md bg-[#2F4F4E] px-5 py-2 text-sm font-semibold text-white shadow-sm transition-all duration-200 hover:opacity-90 hover:-translate-y-1
         hover:rotate-[-2deg]
         active:scale-95">
    View Details
</a>

    </div>

    <!-- LEVEL 2 -->
    <div class="flex flex-col items-center gap-2 rounded-2xl border border-[#1a3332] bg-[#FEFBEF] p-4">

      <div class="text-center text-sm font-semibold text-gray-900">
        Referral Commission <span class="text-[#1a3332]">2nd Level (1%)</span>
      </div>

      <div class="text-2xl font-black text-gray-900">
        <?php echo $totalReferrals2 ?>
      </div>

      <a href="/invest/dashboard/details?reference=2"
          class="inline-flex items-center justify-center rounded-md bg-[#2F4F4E] px-5 py-2 text-sm font-semibold text-white shadow-sm transition-all duration-200 hover:opacity-90 hover:-translate-y-1
         hover:rotate-[-2deg]
         active:scale-95">
    View Details
</a>

    </div>

    <!-- LEVEL 3 -->
    <div class="flex flex-col items-center gap-2 rounded-2xl border border-[#1a3332] bg-[#FEFBEF] p-4">

      <div class="text-center text-sm font-semibold text-gray-900">
        Referral Commission <span class="text-[#1a3332]">2nd Level (1%)</span>
      </div>

      <div class="text-2xl font-black text-gray-900">
        <?php echo $totalReferrals3 ?>
      </div>

      <a href="/invest/dashboard/details?reference=3"
          class="inline-flex items-center justify-center rounded-md bg-[#2F4F4E] px-5 py-2 text-sm font-semibold text-white shadow-sm transition-all duration-200 hover:opacity-90 hover:-translate-y-1
         hover:rotate-[-2deg]
         active:scale-95">
    View Details
</a>

    </div>

  </div>

  <!-- ================= INVITE LINK ================= -->
<div class="space-y-2">

  <h4 class="text-sm font-bold text-gray-900">
    Invitation Link
  </h4>

  <div class="flex items-center gap-2 rounded-2xl border border-[#1a3332] bg-[#FEFBEF] p-3 shadow-sm">

    <div id="invite-link" class="flex-1 text-xs break-all text-gray-600">
      <?php echo $sitelink; ?>/register?code=<?php echo $code; ?>
    </div>

    <button
      type="button"
      onclick="copyToClipboard('invite-link', this)"
      class="shrink-0 rounded-md bg-[#2F4F4E] px-4 py-2 text-xs font-semibold text-white transition-all duration-300 hover:-translate-y-1 hover:rotate-[-2deg] active:scale-95"
    >
      COPY
    </button>

  </div>

</div>

<!-- ================= CODE ================= -->
<div class="space-y-2">

  <div class="flex items-center justify-between gap-2 rounded-2xl border border-[#1a3332] bg-[#FEFBEF] p-3 shadow-sm">

    <div>
      <div class="text-xs text-gray-500">Invitation Code</div>
      <div id="invite-code" class="text-lg font-bold text-gray-900">
        <?php echo $code; ?>
      </div>
    </div>

    <button
      type="button"
      onclick="copyToClipboard('invite-code', this)"
      class="shrink-0 rounded-md bg-[#2F4F4E] px-4 py-2 text-xs font-semibold text-white transition-all duration-300 hover:-translate-y-1 hover:rotate-[-2deg] active:scale-95"
    >
      COPY
    </button>

  </div>

  <div class="text-xs text-gray-500">
    Share this code or link with your invitees.
  </div>

</div>

<!-- ================= TOAST CONTAINER ================= -->
<div id="alert-container" class="fixed top-5 right-5 z-50 space-y-2"></div>

<script>
function showToast(message) {
    const container = document.getElementById("alert-container");

    const toast = document.createElement("div");
    toast.className =
        "flex items-center gap-2 rounded-xl bg-[#2F4F4E] px-4 py-3 text-sm font-medium text-white shadow-lg transition-all duration-300";

    toast.innerHTML = `
        <span>✓</span>
        <span>${message}</span>
    `;

    container.appendChild(toast);

    setTimeout(() => {
        toast.classList.add("opacity-0", "translate-x-5");

        setTimeout(() => {
            toast.remove();
        }, 300);
    }, 2500);
}

function copyToClipboard(elementId, btn) {
    const text = document.getElementById(elementId).innerText.trim();

    if (navigator.clipboard) {
        navigator.clipboard.writeText(text)
            .then(() => handleCopySuccess(btn))
            .catch(() => fallbackCopy(text, btn));
    } else {
        fallbackCopy(text, btn);
    }
}

function fallbackCopy(text, btn) {
    const textarea = document.createElement("textarea");
    textarea.value = text;
    textarea.style.position = "fixed";
    textarea.style.opacity = "0";

    document.body.appendChild(textarea);
    textarea.select();

    try {
        document.execCommand("copy");
        handleCopySuccess(btn);
    } catch (err) {
        console.error("Copy failed", err);
    }

    document.body.removeChild(textarea);
}

function handleCopySuccess(btn) {
    const originalText = btn.innerHTML;

    btn.innerHTML = "✓ COPIED";
    btn.disabled = true;
    btn.classList.add("scale-105");

    showToast("Copied successfully");

    setTimeout(() => {
        btn.innerHTML = originalText;
        btn.disabled = false;
        btn.classList.remove("scale-105");
    }, 2000);
}
</script>

    <?php include "inc/footer2.php" ?>