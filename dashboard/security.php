<?php
require $_SERVER['DOCUMENT_ROOT']."/invest/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/actions/password.php";

$ptitle="Change Password";
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

<section class="max-w-4xl mx-auto px-4 mt-6 space-y-6 mt-[80px]">

 

  <div class="rounded-2xl shadow-sm p-5 space-y-5">
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
            class="w-full px-3 py-3 bg-[#FEFBEF] border border-gray-200 rounded-lg
                   focus:ring-2 focus:ring-[#1a3332] focus:outline-none text-gray-800"
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
            class="w-full px-3 py-3 bg-[#FEFBEF] border border-gray-200 rounded-lg
                   focus:ring-2 focus:ring-[#1a3332] focus:outline-none text-gray-800"
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
            class="w-full px-3 py-3 bg-[#FEFBEF] border border-gray-200 rounded-lg
                   focus:ring-2 focus:ring-[#1a3332] focus:outline-none text-gray-800"
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
        class="group relative flex w-full items-center justify-center gap-2 rounded-md bg-[#2F4F4E] py-3.5 font-semibold text-white transition-all duration-300
         hover:-translate-y-1
         hover:rotate-[-2deg]
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