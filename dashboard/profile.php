<?php
require $_SERVER['DOCUMENT_ROOT']."/invest/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/actions/account-settings.php";
;



$ptitle="Account Settings";
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


<section class="py-10 mt-[80px]">

  <div class="mx-auto max-w-[590px] px-4">

    <!-- Profile Header -->
    <div class="flex flex-col items-center text-center">

      <!-- Avatar -->
      <div class="relative">

        <?php if ($profileImg == "no-avatar.png") { ?>
          <img src="/invest/mysite/bandogreen.jfif"
               class="h-24 w-24 rounded-full object-cover border-4 border-[#1a3332]"
               alt="profile">
        <?php } else { ?>
          <img src="assets/img/profilephotos/<?php echo $profileImg ?>"
               class="h-24 w-24 rounded-full object-cover border-4 border-[#1a3332]"
               alt="profile">
        <?php } ?>

        <!-- Camera Icon -->
        <div class="absolute bottom-0 right-0 flex h-8 w-8 items-center justify-center rounded-full bg-[#1a3332] text-white shadow">
          <svg xmlns="http://www.w3.org/2000/svg"
               viewBox="0 0 24 24"
               fill="none"
               stroke="currentColor"
               stroke-width="2"
               stroke-linecap="round"
               stroke-linejoin="round"
               class="h-4 w-4">
            <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
            <circle cx="12" cy="13" r="4"></circle>
          </svg>
        </div>

      </div>

      <!-- Name -->
      <h2 class="mt-3 text-lg font-bold text-[#1a3332]">
        <?php echo $fullname ?>
      </h2>

      <!-- Email -->
      <h5 class="text-sm text-[#1a3332]/60">
        <?php echo $email ?>
      </h5>

    </div>

    <!-- Message -->
    <div class="mt-4">
      <?php echo $genMsg ?>
    </div>

    <!-- Form -->
    <form method="POST" enctype="multipart/form-data" class="mt-6 space-y-4">

      <!-- Upload -->
      <div>
        <label class="mb-1 block text-sm font-semibold text-[#1a3332]">
          Upload new photo
        </label>
        <input type="file"
               name="image"
               class="w-full pl-12 pr-4 py-3 bg-[#FEFBEF] text-gray-800 border border-gray-200 focus:ring-2 focus:ring-[#2F4F4E] focus:outline-none">
      </div>
<!-- FullName -->
        <div>
          <label class="text-xs font-semibold text-gray-500 ml-1">Fullname</label>
          <div class="relative mt-1">
            <span class="absolute left-4 top-3.5 text-gray-400">
              <i class="fas fa-user"></i>
            </span>
            <input type="text" name="fullname" placeholder="Enter Fullname"  value="<?php echo $fullname ?>"
                   class="w-full pl-12 pr-4 py-3 bg-[#FEFBEF] text-gray-800 border border-gray-200 focus:ring-2 focus:ring-[#2F4F4E] focus:outline-none">
          </div>
        </div>
      
      <!-- Username -->
        <div>
          <label class="text-xs font-semibold text-gray-500 ml-1">Username</label>
          <div class="relative mt-1">
            <span class="absolute left-4 top-3.5 text-gray-400">
              <i class="fas fa-user"></i>
            </span>
            <input type="text" name="username" placeholder="Enter username"  value="<?php echo $username ?>"
                   class="w-full pl-12 pr-4 py-3 bg-[#FEFBEF] text-gray-800 border border-gray-200 focus:ring-2 focus:ring-[#2F4F4E] focus:outline-none">
          </div>
        </div>

<!-- FullName -->
        <div>
          <label class="text-xs font-semibold text-gray-500 ml-1">Email</label>
          <div class="relative mt-1">
            <span class="absolute left-4 top-3.5 text-gray-400">
               <i class="fas fa-envelope"></i>
            </span>
            <input type="text" readonly name="email" placeholder="Enter email"  value="<?php echo $email ?>"
                   class="w-full pl-12 pr-4 py-3 bg-[#FEFBEF] text-gray-800 border border-gray-200 focus:ring-2 focus:ring-[#2F4F4E] focus:outline-none">
          </div>
        </div>

<!-- FullName -->
        <div>
          <label class="text-xs font-semibold text-gray-500 ml-1">Phone Number</label>
          <div class="relative mt-1">
            <span class="absolute left-4 top-3.5 text-gray-400">
             <i class="fas fa-phone"></i>
            </span>
            <input type="text" name="phone" placeholder="Enter Phone Number"  value="<?php echo $phoneNumber ?>"
                   class="w-full pl-12 pr-4 py-3 bg-[#FEFBEF] text-gray-800 border border-gray-200 focus:ring-2 focus:ring-[#2F4F4E] focus:outline-none">
          </div>
        </div>

      <!-- Submit -->
      <button type="submit"
              name="saveProfile"
              class="group relative flex w-full items-center justify-center gap-2 rounded-md bg-[#2F4F4E] py-3.5 font-semibold text-white transition-all duration-300
         hover:-translate-y-1
         hover:rotate-[-2deg]
         active:scale-95">
        Update
      </button>

    </form>

  </div>

</section>
        
<?php include "inc/footer2.php" ?>