<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require $_SERVER['DOCUMENT_ROOT']."/invest/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/actions/account-settings.php";



$ptitle="Invite Link";
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

<!-- ================= INVITE LINK + QR SCAN ================= -->
<div class="space-y-3 mt-[80px]">

  <h4 class="text-sm font-bold text-gray-900">
    Invitation Link
  </h4>

  <div class="grid gap-3 sm:grid-cols-3">

    <!-- LINK BOX -->
    <div class="sm:col-span-2 flex items-center justify-between gap-2 rounded-2xl border border-gray-100 bg-white p-3 shadow-sm">

      <div id="invite-link" class="text-xs break-all text-gray-600">
        <?php echo $sitelink; ?>/register?code=<?php echo $code; ?>
      </div>

      <button
        class="rounded-xl border border-red-600 px-3 py-1 text-xs font-semibold text-red-600 transition hover:bg-red-600 hover:text-white"
        onclick="copyToClipboard('invite-link')"
      >
        COPY
      </button>

    </div>

    <!-- QR CODE BOX -->
    <div class="flex flex-col items-center justify-center rounded-2xl border border-gray-100 bg-white p-3 shadow-sm">

      <!-- TEXT TOP -->
      <p class="mb-2 text-[10px] font-semibold text-gray-500">
        Scan to join
      </p>

      <!-- QR -->
      <img
        class="h-28 w-28 rounded-lg"
        src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php echo urlencode($sitelink . '/register?code=' . $code); ?>"
        alt="QR Code"
      />

    </div>

  </div>

</div>
<!-- ================= TOAST ================= -->
  <div id="alert-container" class="fixed right-5 top-5 z-50 space-y-2"></div>

  <!-- ================= SCRIPT ================= -->
<script>
function copyToClipboard(elementId) {
    const el = document.getElementById(elementId);
    if (!el) return;

    const text = el.textContent.trim();

    navigator.clipboard.writeText(text).then(() => {
        showRedToast("Copied successfully!");
    });
}

function showRedToast(message) {
    const toast = document.createElement('div');

    toast.className =
        "flex items-center gap-2 rounded-xl border border-red-600 bg-black/90 px-4 py-2 text-white shadow-lg";

    toast.innerHTML = `
        <span class="text-red-600"><i class="fas fa-check-circle"></i></span>
        <div><strong class="text-red-600">Success:</strong> ${message}</div>
    `;

    document.getElementById('alert-container').appendChild(toast);

    setTimeout(() => toast.remove(), 3000);
}
</script>

    <?php include "inc/footer2.php" ?>