<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php echo $ptitle ?> - <?php echo $sitename ?></title>

<script>
(function () {
    const storageKey = "theme";
    let theme = null;

    try {
        theme = localStorage.getItem(storageKey);
    } catch (error) {
        theme = null;
    }

    const prefersDark = window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches;
    const useDark = theme === "dark" || (!theme && prefersDark);

    document.documentElement.classList.toggle("dark", useDark);
    document.documentElement.dataset.theme = useDark ? "dark" : "light";
})();
</script>

<script src="https://cdn.tailwindcss.com"></script>
<script>
if (window.tailwind) {
    tailwind.config = {
        darkMode: 'class'
    };
}
</script>
<link rel="stylesheet" href="/emmmarmotors/emma/css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
 <link rel="stylesheet" href="/emmmarmotors/mysite/sweet/sweet.css">
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">


</head>

<body class="w-full px-3 mx-auto bg-white/70 text-slate-900 dark:bg-slate-950 dark:text-white transition-colors duration-300">
<!-- DESKTOP SIDEBAR -->
<!-- loader.php -->
<div id="pageLoader" class="fixed inset-0 bg-white dark:bg-black flex items-center justify-center z-[9999] transition-all duration-500 ease-in-out">
    <div class="text-center animate-[fadeInUp_0.6s_ease]">

        <!-- Logo -->
        <div class="w-20 h-20 mx-auto mb-5 animate-[pulse_1.5s_ease-in-out_infinite]">

            <!-- Light Mode Logo -->
            <img src="/emmmarmotors/emma/img/emmalightmood.png"
                 alt="<?php echo htmlspecialchars($sitename); ?>"
                 class="w-full h-full object-cover rounded-2xl shadow-lg block dark:hidden">

            <!-- Dark Mode Logo -->
            <img src="/emmmarmotors/emma/img/emmadarkmood.png"
                 alt="<?php echo htmlspecialchars($sitename); ?>"
                 class="w-full h-full object-cover rounded-2xl shadow-2xl hidden dark:block">

        </div>

        <!-- Straight Line Loader -->
        <div class="w-40 h-1 mx-auto my-5 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden relative">
            <span class="absolute top-0 left-0 h-full w-1/3 bg-[#052da7] dark:bg-blue-400 rounded-full animate-[lineLoader_1.2s_ease-in-out_infinite]"></span>
        </div>

        
    </div>
</div>
<!-- SIDEBAR -->
<aside
    id="sidebar"
    class="hidden md:flex fixed top-0 left-0 h-screen w-64
           bg-white dark:bg-slate-900
           border-r border-slate-200 dark:border-slate-800
           flex-col
           transition-all duration-300
           z-[60]">

   <!-- LOGO -->
<div class="h-20 flex items-center justify-center border-b border-slate-200 dark:border-slate-800">

    <!-- Light Mode Logo -->
    <img
        src="/emmmarmotors/emma/img/emmalightmood.png"
        alt="Logo"
        class="max-h-16 w-auto object-contain block dark:hidden">

    <!-- Dark Mode Logo -->
    <img
        src="/emmmarmotors/emma/img/emmadarkmood.png"
        alt="Logo"
        class="max-h-16 w-auto object-contain hidden dark:block">

</div>

    <!-- MENU -->
    <nav class="flex-1 overflow-y-auto py-4 space-y-1">

        <!-- Dashboard -->
        <a href="index"
           class="sidebar-link flex items-center gap-3 px-6 py-3 rounded-xl mx-2 transition
                  text-slate-700 dark:text-slate-300
                  hover:bg-slate-100 dark:hover:bg-slate-800
                  <?php echo (basename($_SERVER['PHP_SELF']) == 'index') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' : ''; ?>">
            <i class="fas fa-home w-5"></i>
            <span>Dashboard</span>
        </a>

        <!-- Verification -->
        <?php if ($accountVerified == 0): ?>
        <a href="verify"
           class="sidebar-link flex items-center gap-3 px-6 py-3 rounded-xl mx-2 transition
                  text-slate-700 dark:text-slate-300
                  hover:bg-slate-100 dark:hover:bg-slate-800
                  <?php echo (basename($_SERVER['PHP_SELF']) == 'verify') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' : ''; ?>">
            <i class="bi bi-credit-card text-[18px]"></i>
            <span>Account Verification</span>
        </a>
        <?php endif; ?>

        <!-- Plans -->
        <a href="orders"
           class="sidebar-link flex items-center gap-3 px-6 py-3 rounded-xl mx-2 transition
                  text-slate-700 dark:text-slate-300
                  hover:bg-slate-100 dark:hover:bg-slate-800
                  <?php echo (basename($_SERVER['PHP_SELF']) == 'orders') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' : ''; ?>">
            <i class="fas fa-layer-group text-lg"></i>
            <span>Plans</span>
        </a>

        <!-- Transactions -->
        <a href="transaction"
           class="sidebar-link flex items-center gap-3 px-6 py-3 rounded-xl mx-2 transition
                  text-slate-700 dark:text-slate-300
                  hover:bg-slate-100 dark:hover:bg-slate-800
                  <?php echo (basename($_SERVER['PHP_SELF']) == 'transaction') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' : ''; ?>">
            <i class="fas fa-arrow-right-arrow-left text-lg"></i>
            <span>Transactions</span>
        </a>

        <!-- ACCOUNT DROPDOWN -->
        <div class="mx-2">

            <button
                type="button"
                onclick="toggleDropdown('accountMenu','accountArrow')"
                class="w-full flex items-center justify-between px-6 py-3 rounded-xl transition
                       text-slate-700 dark:text-slate-300
                       hover:bg-slate-100 dark:hover:bg-slate-800">

                <div class="flex items-center gap-3">
                    <i class="fas fa-user text-lg"></i>
                    <span>Account</span>
                </div>

                <i id="accountArrow"
                   class="fas fa-chevron-down text-xs transition-transform duration-300"></i>

            </button>

            <div id="accountMenu" class="hidden mt-2 space-y-1">

                <a href="profile"
                   class="flex items-center gap-3 px-6 py-3 rounded-xl
                          text-slate-600 dark:text-slate-400
                          hover:bg-slate-100 dark:hover:bg-slate-800">

                    <i class="fas fa-user-circle"></i>
                    <span>Personal Information</span>

                </a>

                <a href="bank"
                   class="flex items-center gap-3 px-6 py-3 rounded-xl
                          text-slate-600 dark:text-slate-400
                          hover:bg-slate-100 dark:hover:bg-slate-800">

                    <i class="bi bi-bank text-[18px]"></i>
                    <span>Payout Bank</span>

                </a>

            </div>

        </div>

        <!-- SECURITY DROPDOWN -->
        <div class="mx-2">

            <button
                type="button"
                onclick="toggleDropdown('securityMenu','securityArrow')"
                class="w-full flex items-center justify-between px-6 py-3 rounded-xl transition
                       text-slate-700 dark:text-slate-300
                       hover:bg-slate-100 dark:hover:bg-slate-800">

                <div class="flex items-center gap-3">
                    <i class="fas fa-shield-alt text-lg"></i>
                    <span>Security</span>
                </div>

                <i id="securityArrow"
                   class="fas fa-chevron-down text-xs transition-transform duration-300"></i>

            </button>

            <div id="securityMenu" class="hidden mt-2 space-y-1">

                <a href="tranpin"
                   class="flex items-center gap-3 px-6 py-3 rounded-xl
                          text-slate-600 dark:text-slate-400
                          hover:bg-slate-100 dark:hover:bg-slate-800">

                    <i class="fas fa-lock"></i>
                    <span>Transaction Pin</span>

                </a>

                <a href="security"
                   class="flex items-center gap-3 px-6 py-3 rounded-xl
                          text-slate-600 dark:text-slate-400
                          hover:bg-slate-100 dark:hover:bg-slate-800">

                    <i class="fas fa-key"></i>
                    <span>Change Password</span>

                </a>

               

            </div>
 <!-- Dark Mode Switch -->
                <div class="flex items-center justify-between px-6 py-3 rounded-xl
                            text-slate-600 dark:text-slate-400
                            hover:bg-slate-100 dark:hover:bg-slate-800">

                    <div class="flex items-center gap-3">
                        <i class="fas fa-moon"></i>
                        <span>Dark Mode</span>
                    </div>

                    <button type="button"
                        id="settingsThemeSwitch"
                        class="relative h-6 w-11 rounded-full bg-gray-300 dark:bg-[#052da7] transition-all duration-300">

                        <span id="settingsThemeDot"
                            class="absolute left-1 top-1 h-4 w-4 rounded-full bg-white shadow-md transition-all duration-300 dark:translate-x-5">
                        </span>

                    </button>

                </div>
        </div>

    </nav>

    <!-- FOOTER -->
    <div class="p-4 border-t border-slate-200 dark:border-slate-800">

        <a href="logout"
           class="flex items-center justify-center gap-2
                  w-full py-3 rounded-xl
                  bg-red-600 hover:bg-red-700
                  text-white font-semibold transition">

            <i class="fas fa-sign-out-alt"></i>
            Logout

        </a>

        <div class="text-center text-xs text-gray-500 dark:text-gray-400 py-3 mt-2 border-t border-slate-200 dark:border-slate-800">

            <span>Version 1.0.0</span>
            <span class="mx-2">•</span>
            <span>© 2026 Emmmar Motors</span>

        </div>

    </div>

</aside>



<!-- MAIN CONTENT -->
<div id="mainContent" class="transition-all duration-300 md:ml-64">

    <!-- Your Page Content -->

</div>
