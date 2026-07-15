<?php
require $_SERVER['DOCUMENT_ROOT']."/emmmarmotors/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/actions/account-settings.php";
;



$ptitle="Account Settings";
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

    <!-- Profile Header -->
    <div class="flex flex-col items-center text-center">
        <div class="relative">
            <?php if ($profileImg == "no-avatar.png") { ?>
                <img src="/invest/mysite/bandogreen.jfif"
                     class="h-24 w-24 rounded-full object-cover border-4 border-[#2563eb]"
                     alt="profile">
            <?php } else { ?>
                <img src="assets/img/profilephotos/<?php echo $profileImg ?>"
                     class="h-24 w-24 rounded-full object-cover border-4 border-[#2563eb]"
                     alt="profile">
            <?php } ?>
        </div>
    </div>

    <?php echo $genMsg ?>

    <!-- Form -->
    <form action="" method="POST" enctype="multipart/form-data" class="mt-6 space-y-4 rounded-2xl p-5">

       

        <!-- First Name -->
        <div>
            <label class="mb-1 block text-xs font-semibold text-slate-700 dark:text-slate-300">
                First Name
            </label>
            <input type="text"
                   name="firstname"
                   placeholder="Enter First Name"
                   value="<?php echo $firstname ?>"
                   readonly
                   class="w-full px-4 py-3
                          bg-white dark:bg-slate-800
                          text-gray-500 dark:text-gray-500 
                          border border-slate-300 dark:border-slate-700
                          rounded-md
                          focus:ring-2 focus:ring-[#052da7]
                          focus:outline-none
                          placeholder:text-slate-400 dark:placeholder:text-slate-500">
        </div>

        <!-- Last Name -->
        <div>
            <label class="mb-1 block text-xs font-semibold text-slate-700 dark:text-slate-300">
                Last Name
            </label>
            <input type="text"
                   name="lastname"
                   placeholder="Enter Last Name"
                   value="<?php echo $lastname ?>"
                   readonly
                   class="w-full px-4 py-3
                          bg-white dark:bg-slate-800
                          text-gray-500 dark:text-gray-500 
                          border border-slate-300 dark:border-slate-700
                          rounded-md
                          focus:ring-2 focus:ring-[#052da7]
                          focus:outline-none
                          placeholder:text-slate-400 dark:placeholder:text-slate-500">
        </div>

        <!-- Username -->
        <div>
            <label class="mb-1 block text-xs font-semibold text-slate-700 dark:text-slate-300">
                Username
            </label>
            <input type="text"
                   name="username"
                   readonly
                   placeholder="Enter Username"
                   value="<?php echo $username ?>"
                   class="w-full px-4 py-3
                          bg-white dark:bg-slate-800
                          text-gray-500 dark:text-gray-500 
                          border border-slate-300 dark:border-slate-700
                          rounded-md
                          focus:ring-2 focus:ring-[#052da7]
                          focus:outline-none
                          placeholder:text-slate-400 dark:placeholder:text-slate-500">
        </div>
<!-- Gender -->
<div>
    <label class="mb-1 block text-xs font-semibold text-slate-700 dark:text-slate-300">
        Gender
    </label>
    <input type="text"
           readonly
           name="gender"
           value="<?php echo $gender ?>"
           class="w-full px-4 py-3
                  bg-white dark:bg-slate-800
                  text-gray-500 dark:text-gray-500
                  border border-slate-300 dark:border-slate-700
                  rounded-md
                  focus:ring-2 focus:ring-[#052da7]
                  focus:outline-none">
</div>
        <!-- Email -->
        <div>
            <label class="mb-1 block text-xs font-semibold text-slate-700 dark:text-slate-300">
                Email
            </label>
            <input type="text"
                   readonly
                   name="email"
                   placeholder="Enter Email"
                   value="<?php echo $email ?>"
                   class="w-full px-4 py-3
                          bg-white dark:bg-slate-800
                          text-gray-500 dark:text-gray-500 
                          border border-slate-300 dark:border-slate-700
                          rounded-md
                          focus:ring-2 focus:ring-[#052da7]
                          focus:outline-none
                          placeholder:text-slate-400 dark:placeholder:text-slate-500">
        </div>

        <!-- Phone Number -->
        <div>
            <label class="mb-1 block text-xs font-semibold text-slate-700 dark:text-slate-300">
                Phone Number
            </label>
            <div class="flex">
                <!-- Flag -->
                <div class="flex items-center px-3 border border-r-0 border-slate-300 dark:border-slate-700 rounded-l-md bg-slate-50 dark:bg-slate-800">
                    <img id="countryFlag" src="" alt="Flag" class="w-6 h-4 object-cover">
                </div>

                <!-- Country Code -->
                <input type="text"
                       id="countryCode"
                       readonly
                       class="w-20 text-center
                              border-y border-slate-300 dark:border-slate-700
                              bg-slate-50 dark:bg-slate-800
                              text-slate-900 dark:text-white">

                <!-- Phone -->
                <input type="text"
                       name="phone"
                       value="<?php echo htmlspecialchars($phoneNumber); ?>"
                       placeholder="Enter Phone Number"
                       class="flex-1 px-4 py-3
                              bg-white dark:bg-slate-800
                              text-slate-900 dark:text-white
                              border border-slate-300 dark:border-slate-700
                              rounded-r-md">
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit"
                name="saveProfile"
                class="flex w-full items-center justify-center
                       rounded-xl bg-[#052da7]
                       py-3.5 font-semibold text-white
                       transition-all duration-300
                       hover:bg-[#041f74]
                       active:scale-95">
            Update Profile
        </button>

    </form>

</section>

<script>
const countryData = {
    "Nigeria": { code: "+234", flag: "https://flagcdn.com/ng.svg" },
    "Ghana": { code: "+233", flag: "https://flagcdn.com/gh.svg" },
    "Cameroon": { code: "+237", flag: "https://flagcdn.com/cm.svg" },
    "Kenya": { code: "+254", flag: "https://flagcdn.com/ke.svg" },
    "Uganda": { code: "+256", flag: "https://flagcdn.com/ug.svg" },
    "South Africa": { code: "+27", flag: "https://flagcdn.com/za.svg" },
    "Sierra Leone": { code: "+232", flag: "https://flagcdn.com/sl.svg" },
    "Tanzania": { code: "+255", flag: "https://flagcdn.com/tz.svg" },
    "Liberia": { code: "+231", flag: "https://flagcdn.com/lr.svg" },
    "Zambia": { code: "+260", flag: "https://flagcdn.com/zm.svg" },
    "Gambia": { code: "+220", flag: "https://flagcdn.com/gm.svg" },
    "United States": { code: "+1", flag: "https://flagcdn.com/us.svg" },
    "United Kingdom": { code: "+44", flag: "https://flagcdn.com/gb.svg" }
};

// Country already selected from PHP
const selectedCountry = "<?php echo addslashes($countryname); ?>";

if (countryData[selectedCountry]) {
    document.getElementById("countryCode").value = countryData[selectedCountry].code;
    document.getElementById("countryFlag").src = countryData[selectedCountry].flag;
}
</script>
<?php include "inc/footer2.php" ?>