<?php
require $_SERVER['DOCUMENT_ROOT']."/emmmarmotors/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/actions/password.php";

$ptitle="Change Passcode";
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

 <!-- Notice -->
    <div class="mb-2">
     <h3 class="font-bold text-slate-900 dark:text-white text-xl">
<?php echo $ptitle?></h3>
     
    </div>

  <div class="rounded-2xl space-y-5">
<?php echo $genMsg?>
   

    <form action="" method="post" class="space-y-4">

      <!-- Current Password -->
      <div>
        <label class="block text-sm font-medium text-gray-600 mb-1">
          Current Password
        </label>

        <div class="relative">
          <input
            type="password"
            id="currPsw"
            name="currPsw"
            placeholder="••••••••••••"
            class="w-full px-4 py-3
                      bg-white dark:bg-slate-800
                      text-slate-900 dark:text-white
                      border border-slate-300 dark:border-slate-700
                      rounded-md
                      focus:ring-2 focus:ring-[#052da7]
                      focus:outline-none
                      placeholder:text-slate-400 dark:placeholder:text-slate-500"
          >

          <button
            type="button"
            onclick="toggleVisibility('currPsw', this)"
            class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-[#1a3332]"
          >
            <i class="fas fa-eye"></i>
          </button>
        </div>
      </div>

      <!-- New Password -->
      <div>
        <label class="block text-sm font-medium text-gray-600 mb-1">
          New Password
        </label>

        <div class="relative">
          <input
            type="password"
            id="newPsw"
            name="newPsw"
            placeholder="••••••••••••"
            class="w-full px-4 py-3
                      bg-white dark:bg-slate-800
                      text-slate-900 dark:text-white
                      border border-slate-300 dark:border-slate-700
                      rounded-md
                      focus:ring-2 focus:ring-[#052da7]
                      focus:outline-none
                      placeholder:text-slate-400 dark:placeholder:text-slate-500"
          >

          <button
            type="button"
            onclick="toggleVisibility('newPsw', this)"
            class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-[#1a3332]"
          >
            <i class="fas fa-eye"></i>
          </button>
        </div>
      </div>

      <!-- Confirm Password -->
      <div>
        <label class="block text-sm font-medium text-gray-600 mb-1">
          Confirm New Password
        </label>

        <div class="relative">
          <input
            type="password"
            id="confirmPsw"
            name="confirmPsw"
            placeholder="••••••••••••"
            class="w-full px-4 py-3
                      bg-white dark:bg-slate-800
                      text-slate-900 dark:text-white
                      border border-slate-300 dark:border-slate-700
                      rounded-md
                      focus:ring-2 focus:ring-[#052da7]
                      focus:outline-none
                      placeholder:text-slate-400 dark:placeholder:text-slate-500"
          >

          <button
            type="button"
            onclick="toggleVisibility('confirmPsw', this)"
            class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-[#1a3332]"
          >
            <i class="fas fa-eye"></i>
          </button>
        </div>
      </div>

      <!-- Submit -->
      <button
        type="submit"
        name="updatePsw"
        class="flex w-full items-center justify-center
                     rounded-xl bg-[#052da7]
                     py-3 font-semibold text-white
                     transition-all duration-300
                     hover:bg-[#041f74]
                     active:scale-95"
      >
        Update Password
      </button>

    </form>
  </div>
</section>


<script>
function toggleVisibility(inputId, iconWrapper) {
  const input = document.getElementById(inputId);
  const icon = iconWrapper.querySelector('i');

  if (input.type === 'password') {
    input.type = 'text';
    icon.classList.replace('fa-eye', 'fa-eye-slash');
  } else {
    input.type = 'password';
    icon.classList.replace('fa-eye-slash', 'fa-eye');
  }
}
</script>

<?php include "inc/footer2.php" ?>