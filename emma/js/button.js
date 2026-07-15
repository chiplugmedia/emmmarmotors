(function () {
  // --- helpers ---------------------------------------------------------
  function openModal(id) {
    var el = document.getElementById(id);
    if (!el) return;
    el.classList.remove("hidden");
    document.body.style.overflow = "hidden";
  }

  function closeModal(id) {
    var el = document.getElementById(id);
    if (!el) return;
    el.classList.add("hidden");
    document.body.style.overflow = "";
  }

  // --- open triggers -----------------------------------------------------
  var fundBtn = document.getElementById("openFundWallet");
  var withdrawBtn = document.getElementById("openWithdraw");

  if (fundBtn)
    fundBtn.addEventListener("click", function () {
      openModal("fundWalletModal");
    });
  if (withdrawBtn)
    withdrawBtn.addEventListener("click", function () {
      openModal("withdrawModal");
    });

  // --- close triggers (backdrop + X buttons) ------------------------------
  document.querySelectorAll("[data-modal-close]").forEach(function (el) {
    el.addEventListener("click", function () {
      closeModal(el.getAttribute("data-modal-close"));
    });
  });

  // close on Escape
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
      closeModal("fundWalletModal");
      closeModal("withdrawModal");
      closeModal("cardPaymentModal");
    }
  });

  // --- copy account number ------------------------------------------------
  var copyBtn = document.getElementById("copyAccountNumber");
  if (copyBtn) {
    copyBtn.addEventListener("click", function () {
      var number = document
        .getElementById("fundAccountNumber")
        .textContent.trim();
      var feedback = document.getElementById("copyFeedback");
      if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(number);
      }
      if (feedback) {
        feedback.classList.remove("hidden");
        setTimeout(function () {
          feedback.classList.add("hidden");
        }, 1800);
      }
    });
  }

  // --- "I have paid" ----------------------------------------------------
  var iHavePaidBtn = document.getElementById("fundIHavePaid");
  if (iHavePaidBtn) {
    iHavePaidBtn.addEventListener("click", function () {
      closeModal("fundWalletModal");
      // hook your "verify payment" flow here
    });
  }

  // --- withdraw quick amounts --------------------------------------------
  document.querySelectorAll(".quick-amount-btn").forEach(function (btn) {
    btn.addEventListener("click", function () {
      var amount = btn.getAttribute("data-quick-amount");
      var input = document.getElementById("withdrawAmount");
      if (input) input.value = Number(amount).toLocaleString();
    });
  });

  // --- withdraw continue --------------------------------------------------
  var withdrawContinueBtn = document.getElementById("withdrawContinue");
  if (withdrawContinueBtn) {
    withdrawContinueBtn.addEventListener("click", function () {
      closeModal("withdrawModal");
      // hook your withdrawal-confirmation flow here
    });
  }
})();

   // Simulate fetching account status, then swap skeleton for the real card.
      setTimeout(() => {
        const skeleton = document.getElementById('verify-skeleton');
        const card = document.getElementById('verify-card');
        skeleton.remove();
        card.classList.remove('hidden');
        card.classList.add('flex');
      }, 1200);

        // Simulate fetching account setup status, then swap skeleton for the real card.
    setTimeout(() => {
      document.getElementById('setup-skeleton').remove();
      document.getElementById('setup-card').classList.remove('hidden');
    }, 1200);

    (function () {
    const input = document.getElementById('photo-input');
    const dropzone = document.getElementById('photo-dropzone');
    const placeholder = document.getElementById('photo-placeholder');
    const preview = document.getElementById('photo-preview');
    const thumb = document.getElementById('photo-thumb');
    const filename = document.getElementById('photo-filename');
    const removeBtn = document.getElementById('photo-remove');

    function showPreview(file) {
        const reader = new FileReader();
        reader.onload = e => {
            thumb.src = e.target.result;
            filename.textContent = file.name;
            placeholder.classList.add('hidden');
            preview.classList.remove('hidden');
            preview.classList.add('flex');
        };
        reader.readAsDataURL(file);
    }

    input.addEventListener('change', () => {
        if (input.files && input.files[0]) showPreview(input.files[0]);
    });

    removeBtn.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        input.value = '';
        preview.classList.add('hidden');
        preview.classList.remove('flex');
        placeholder.classList.remove('hidden');
    });

    ['dragenter', 'dragover'].forEach(evt => {
        dropzone.addEventListener(evt, (e) => {
            e.preventDefault();
            dropzone.classList.add('border-[#052da7]', 'bg-[#052da7]/5');
        });
    });

    ['dragleave', 'drop'].forEach(evt => {
        dropzone.addEventListener(evt, (e) => {
            e.preventDefault();
            dropzone.classList.remove('border-[#052da7]', 'bg-[#052da7]/5');
        });
    });

    dropzone.addEventListener('drop', (e) => {
        const file = e.dataTransfer.files[0];
        if (file) {
            input.files = e.dataTransfer.files;
            showPreview(file);
        }
    });
})();
