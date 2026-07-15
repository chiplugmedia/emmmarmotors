<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require $_SERVER['DOCUMENT_ROOT']."/emmmarmotors/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/actions/paystack/addbank.php";



$ptitle="Payout Bank";
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

<section class="max-w-4xl mx-auto px-4 space-y-6">
    <div class="mb-2">
        <h3 class="font-bold text-slate-900 dark:text-white text-xl">
            Add your payout bank
        </h3>
        <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">
            Setup your payout bank for withdrawal
        </p>
    </div>

    <div class="rounded-2xl space-y-5">
        <?php echo $genMsg; ?>

        <form action="" method="POST" class="space-y-5" id="bankForm">

            <!-- CSRF token - fill in with your framework's token -->
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken ?? '') ?>">

            <!-- Bank select (relative wrapper fixes the arrow icon positioning) -->
            <div class="relative">
                <label class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                    Bank Name
                </label>

                <select
                    id="bank_code"
                    name="bank_code"
                    required
                    class="w-full px-4 py-3 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white border border-slate-300 dark:border-slate-700 transition">

                    <option value="">Select Bank</option>

                    <?php
                    if (!empty($banks['status']) && $banks['status'] && !empty($banks['data'])) {

                        foreach ($banks['data'] as $bank) {

                            $selected = (
                                !empty($savedBank['bankcode']) &&
                                $savedBank['bankcode'] == $bank['code']
                            ) ? 'selected' : '';

                            echo '<option value="' . htmlspecialchars($bank['code']) . '" ' . $selected . ' data-bank="' . htmlspecialchars($bank['name']) . '">'
                                . htmlspecialchars($bank['name'])
                                . '</option>';
                        }

                    } else {

                        echo '<option value="" disabled>Unable to load banks — please refresh</option>';

                    }
                    ?>

                </select>

                <div class="absolute right-4 top-[46px] pointer-events-none">
                    <i class="fas fa-chevron-down text-slate-400 dark:text-slate-500"></i>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">
                    Account Number
                </label>
                <input
                    type="text"
                    id="account_number"
                    name="account_number"
                    maxlength="10"
                    inputmode="numeric"
                    autocomplete="off"
                    value="<?= htmlspecialchars($savedBank['acctnum'] ?? '') ?>"
                    placeholder="Enter 10-digit account number"
                    class="w-full px-4 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white border border-slate-300 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-[#052da7] outline-none"
                    required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">
                    Account Name
                </label>
                <input
                    type="text"
                    id="account_name"
                    name="account_name"
                    readonly
                    value="<?= htmlspecialchars($savedBank['acctname'] ?? '') ?>"
                    placeholder="Account name will appear automatically"
                    class="w-full px-4 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white border border-slate-300 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-[#052da7] outline-none">
            </div>

            <input type="hidden" id="bank_name" name="bank_name" value="<?= htmlspecialchars($savedBank['bankname'] ?? '') ?>">
            <!-- Tracks whether the last verification attempt succeeded, so the server can double-check on submit -->
            <input type="hidden" id="verified" name="verified" value="0">

            <div id="verifyStatus" aria-live="polite"></div>

            <button
                type="submit"
                name="saveBank"
                id="saveBtn"
                disabled
                class="flex w-full items-center justify-center
                       rounded-xl bg-[#052da7]
                       py-3.5 font-semibold text-white
                       transition-all duration-300
                       hover:bg-[#041f74]
                       active:scale-95
                       disabled:opacity-50 disabled:cursor-not-allowed">
                Add bank
            </button>
        </form>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const bankInput = document.getElementById("bank_code");
    const accountInput = document.getElementById("account_number");
    const accountName = document.getElementById("account_name");
    const bankName = document.getElementById("bank_name");
    const verifiedField = document.getElementById("verified");
    const verifyStatus = document.getElementById("verifyStatus");
    const saveBtn = document.getElementById("saveBtn");
    let tsControl = null;
    let debounceTimer = null;
    let activeController = null; // lets us cancel a stale in-flight request

    // Initialize TomSelect if the library is loaded on the page
    if (typeof TomSelect !== "undefined" && bankInput) {
        tsControl = new TomSelect("#bank_code", {
            create: false,
            sortField: { field: "text", direction: "asc" },
            searchField: ["text"],
            maxOptions: null,
            placeholder: "Type to search for your bank...",
            onChange: function () {
                verifyAccount();
            }
        });
    }

    function resetVerification() {
        verifiedField.value = "0";
        accountName.value = "";
        saveBtn.disabled = true;
        verifyStatus.innerHTML = "";
    }

    function verifyAccount() {
        const bankCode = bankInput.value;
        const accountNumber = accountInput.value;

        resetVerification();

        if (bankCode === "" || accountNumber.length !== 10) {
            return;
        }

        // Cancel any request still in flight so an old, slow response
        // can't overwrite a newer one
        if (activeController) {
            activeController.abort();
        }
        activeController = new AbortController();

        verifyStatus.innerHTML = '<span class="text-blue-600 text-sm"><i class="fas fa-spinner fa-spin mr-1"></i> Verifying account...</span>';

        let selectedText = "";
        if (tsControl) {
            selectedText = tsControl.options[bankCode] ? tsControl.options[bankCode].text : "";
        } else if (bankInput.selectedIndex >= 0) {
            selectedText = bankInput.options[bankInput.selectedIndex].getAttribute("data-bank");
        }
        bankName.value = selectedText;

        fetch("actions/paystack/verifybank", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
                "X-Requested-With": "XMLHttpRequest"
            },
            body: "bank_code=" + encodeURIComponent(bankCode) + "&account_number=" + encodeURIComponent(accountNumber),
            signal: activeController.signal
        })
        .then(async response => {
            const raw = await response.text();
            try {
                return JSON.parse(raw);
            } catch (e) {
                console.error("Expected JSON payload, but received raw string instead:", raw);
                throw new Error("Server response format error");
            }
        })
        .then(data => {
            if (data.status) {
                accountName.value = data.account_name;
                verifiedField.value = "1";
                saveBtn.disabled = false;
                verifyStatus.innerHTML = '<span class="text-green-600 text-sm font-medium">✓ Account verified successfully</span>';
            } else {
                accountName.value = "";
                verifiedField.value = "0";
                saveBtn.disabled = true;
                verifyStatus.innerHTML = '<span class="text-red-600 text-sm font-medium">' + data.message + '</span>';
            }
        })
        .catch(err => {
            if (err.name === "AbortError") return; // superseded by a newer request, ignore
            verifyStatus.innerHTML = '<span class="text-red-600 text-sm font-medium">Network/Server routing error — check your developer tools console</span>';
            console.error("Verification Request Failure Details:", err);
        });
    }

    function debouncedVerify() {
        resetVerification();
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(verifyAccount, 400);
    }

    // Only attach the native "change" listener when TomSelect isn't controlling
    // the select — otherwise verifyAccount() fires twice per selection.
    if (bankInput && !tsControl) {
        bankInput.addEventListener("change", verifyAccount);
    }

    if (accountInput) {
        // Strip non-digit characters as the user types, then debounce verification
        accountInput.addEventListener("input", function () {
            const digitsOnly = accountInput.value.replace(/\D/g, "").slice(0, 10);
            if (digitsOnly !== accountInput.value) {
                accountInput.value = digitsOnly;
            }
            debouncedVerify();
        });
    }

    // Belt-and-suspenders: block submit client-side if verification never succeeded
    document.getElementById("bankForm").addEventListener("submit", function (e) {
        if (verifiedField.value !== "1") {
            e.preventDefault();
            verifyStatus.innerHTML = '<span class="text-red-600 text-sm font-medium">Please verify the account before saving</span>';
        }
    });
});
</script>
 

    <?php include "inc/footer2.php" ?>