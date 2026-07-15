<?php
require $_SERVER['DOCUMENT_ROOT']."/emmmarmotors/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/actions/main.php";
;



$ptitle="Account Verification";
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
 <?php echo $genMsg ?>
<section class="max-w-4xl mx-auto px-4 space-y-6">

    <!-- Header -->
    <div>
        <h3 class="font-bold text-slate-900 dark:text-white text-xl">
            Verify Your Identity
        </h3>

        <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">
            As a licensed financial institution, we are required by law to collect your NIN
            and a clear photo of your face to verify your identity and comply with regulatory requirements.
        </p>
    </div>

    <!-- KYC Notice -->
    <div class="rounded-xl bg-blue-50 dark:bg-blue-950/20 border border-blue-200 dark:border-blue-900 p-4">
        <p class="text-sm text-blue-700 dark:text-blue-300">
            Make sure your face is clearly visible, well-lit, and not covered by sunglasses,
            masks, hats, or filters.
        </p>
    </div>

    <!-- Form -->
    <form method="POST" enctype="multipart/form-data" class="space-y-5">

        <!-- Photo Upload -->
        <div>

            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                Selfie / Passport Photo
            </label>

            <label for="photo-input"
                id="photo-dropzone"
                class="group relative flex flex-col items-center justify-center
                       w-full px-4 py-8
                       bg-white dark:bg-slate-900
                       border-2 border-dashed border-slate-300 dark:border-slate-700
                       rounded-2xl
                       cursor-pointer
                       transition-all
                       hover:border-[#052da7]
                       hover:bg-blue-50 dark:hover:bg-blue-950/20">

                <!-- Upload Placeholder -->
                <div id="photo-placeholder"
                    class="flex flex-col items-center text-center pointer-events-none">

                    <svg class="w-10 h-10 mb-3 text-slate-400 group-hover:text-[#052da7] transition"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.5">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 16.5V9m0 0-3 3m3-3 3 3M4.5 19.5h15a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5h-5.379a1.5 1.5 0 0 1-1.06-.44L11.44 2.94A1.5 1.5 0 0 0 10.38 2.5H4.5A1.5 1.5 0 0 0 3 4v14a1.5 1.5 0 0 0 1.5 1.5Z" />

                    </svg>

                    <p class="text-sm text-slate-600 dark:text-slate-300">
                        <span class="font-semibold text-[#052da7]">
                            Take a selfie
                        </span>
                        or upload a photo
                    </p>

                    <p class="text-xs text-slate-400 mt-1">
                        Use your camera or select an image from your device (Max 5MB)
                    </p>

                </div>

                <!-- Image Preview -->
                <div id="photo-preview"
                    class="hidden flex-col items-center text-center">

                    <img id="photo-thumb"
                        class="w-24 h-24 rounded-xl object-cover border border-slate-200 dark:border-slate-700 mb-3"
                        alt="Preview">

                    <p id="photo-filename"
                        class="text-sm font-medium text-slate-900 dark:text-white truncate max-w-[220px]">
                    </p>

                    <button type="button"
                        id="photo-remove"
                        class="mt-2 text-xs font-medium text-red-500 hover:text-red-600">
                        Remove
                    </button>

                </div>

                <!-- Camera + Upload -->
                <input
                    type="file"
                    name="image"
                    id="photo-input"
                    accept="image/*"
                    capture="user"
                    required
                    class="hidden">

            </label>

        </div>

        <!-- NIN -->
        <div>

            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                NIN Number
            </label>

            <input
                type="text"
                name="nin"
                inputmode="numeric"
                pattern="[0-9]{11}"
                maxlength="11"
                minlength="11"
                placeholder="Enter your 11-digit NIN"
                required
                class="w-full px-4 py-3
                       bg-white dark:bg-slate-900
                       text-slate-900 dark:text-white
                       border border-slate-300 dark:border-slate-700
                       rounded-xl
                       focus:ring-2 focus:ring-[#052da7]
                       focus:border-[#052da7]
                       outline-none">

        </div>

        <!-- Submit -->
        <button
            type="submit"
            name="verifyAccount"
            class="w-full py-3 rounded-xl
                   bg-[#052da7]
                   text-white
                   font-semibold
                   hover:bg-[#041f74]
                   transition-all">

            Verify Identity

        </button>

    </form>

</section>

<script>
const photoInput = document.getElementById('photo-input');
const photoPreview = document.getElementById('photo-preview');
const photoPlaceholder = document.getElementById('photo-placeholder');
const photoThumb = document.getElementById('photo-thumb');
const photoFilename = document.getElementById('photo-filename');
const photoRemove = document.getElementById('photo-remove');

photoInput.addEventListener('change', function () {

    const file = this.files[0];

    if (!file) return;

    const reader = new FileReader();

    reader.onload = function (e) {

        photoThumb.src = e.target.result;
        photoFilename.textContent = file.name;

        photoPlaceholder.classList.add('hidden');
        photoPreview.classList.remove('hidden');
        photoPreview.classList.add('flex');

    };

    reader.readAsDataURL(file);

});

photoRemove.addEventListener('click', function () {

    photoInput.value = '';

    photoPreview.classList.add('hidden');
    photoPreview.classList.remove('flex');

    photoPlaceholder.classList.remove('hidden');

});
</script>


<?php include "inc/footer2.php" ?>