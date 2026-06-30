<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require $_SERVER['DOCUMENT_ROOT']."/emmmarmotors/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/actions/formprocess.php";

$ptitle="Login";
include "includes/authhead2.php";
?>


<div class="min-h-screen flex flex-col lg:flex-row bg-white dark:bg-black transition-colors duration-300">

    <!-- =========================
         LEFT SIDE - INFO PANEL (matches register page)
    ========================== -->
    <div class="hidden lg:flex flex-1 relative overflow-hidden items-center justify-center p-12
                bg-gray-50 dark:bg-[#0E1947] transition-colors duration-300">

        <div class="absolute top-0 left-0 -ml-20 -mt-20 w-80 h-80 bg-blue-400/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 -mr-20 -mb-20 w-80 h-80 bg-blue-400/10 rounded-full blur-3xl"></div>

        <div class="relative max-w-lg">

            <h2 class="text-4xl font-bold mb-6 leading-tight text-gray-900 dark:text-white">
                Welcome back to <?php echo htmlspecialchars($sitename); ?>
            </h2>

            <p class="text-xl mb-12 text-gray-600 dark:text-gray-300">
                Access your account and continue your financial journey with us.
            </p>

            <div class="grid grid-cols-2 gap-8">

                <div class="bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 p-6 rounded-2xl">
                    <h4 class="text-2xl font-bold text-gray-900 dark:text-white">24/7</h4>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">Support</p>
                </div>

                <div class="bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 p-6 rounded-2xl">
                    <h4 class="text-2xl font-bold text-gray-900 dark:text-white">Secure</h4>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">Transactions</p>
                </div>

            </div>

        </div>
    </div>

    <!-- =========================
         RIGHT SIDE - LOGIN FORM
    ========================== -->
    <div class="flex-1 flex lg:items-center lg:justify-center items-start justify-center px-4 py-10">

        <div class="w-full max-w-md">

        <!-- Logo + Welcome -->
        <div class="flex flex-col items-center text-center space-y-4 mb-6">

            <a class="transition-transform hover:scale-105 active:scale-95" href="/">
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center">
                    <img
                        alt="Logo"
                        loading="lazy"
                        width="40"
                        height="40"
                        decoding="async"
                        class="w-full h-full object-cover rounded-2xl"
                        src="/mysite/WAX.png">
                </div>
            </a>

            <div class="space-y-1">
                <h2 class="text-2xl font-bold tracking-tight text-[#052da7] dark:text-white">
                    Welcome Back
                </h2>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Access your <?php echo $sitename ?> account to continue
                </p>
            </div>

        </div>

        <!-- Card -->
        <div class="p-6 rounded-3xl">

            <?php echo $genMsg; ?>

            <!-- Form -->
            <form method="POST" action="" class="space-y-5">

                <!-- Username -->
                <div>

                    <label class="text-xs font-semibold text-gray-600 dark:text-gray-300 ml-1">
                        Username or Email Address
                    </label>

                    <div class="relative mt-1">

                        <span class="absolute left-4 top-3.5 text-[#052da7] dark:text-blue-400">
                            <i class="fas fa-user"></i>
                        </span>

                        <input
                            type="text"
                            name="username"
                            value="<?php echo htmlspecialchars($username ?? ''); ?>"
                            placeholder="Enter Username or Email Address"
                            class="w-full pl-12 pr-4 py-3 rounded-xl
                                   bg-white dark:bg-black
                                   text-gray-800 dark:text-white
                                   border border-gray-300 dark:border-gray-600
                                   focus:ring-2 focus:ring-[#052da7]
                                   focus:border-[#052da7]
                                   focus:outline-none transition-all duration-300">

                    </div>

                </div>

                <!-- Password -->
                <div>

                    <label class="text-xs font-semibold text-gray-600 dark:text-gray-300 ml-1">
                        Password
                    </label>

                    <div class="relative mt-1">

                        <span class="absolute left-4 top-3.5 text-[#052da7] dark:text-blue-400">
                            <i class="fas fa-lock"></i>
                        </span>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter Password"
                            class="w-full pl-12 pr-12 py-3 rounded-xl
                                   bg-white dark:bg-black
                                   text-gray-800 dark:text-white
                                   border border-gray-300 dark:border-gray-600
                                   focus:ring-2 focus:ring-[#052da7]
                                   focus:border-[#052da7]
                                   focus:outline-none transition-all duration-300">

                        <button
                            type="button"
                            class="absolute right-4 top-3.5 text-gray-400 hover:text-[#052da7] dark:hover:text-blue-400"
                            onclick="togglePasswordVisibility('password', this)">
                            <i class="fas fa-eye"></i>
                        </button>

                    </div>

                    <!-- Forgot Password -->
                    <div class="mt-2 text-right">
                        <a href="forgot-password"
                           class="text-xs font-semibold text-[#052da7] hover:text-blue-500 transition-colors">
                            Forgot Password?
                        </a>
                    </div>

                </div>

                <!-- Login Button -->
                <button
                    type="submit"
                    name="login"
                    class="group relative flex w-full items-center justify-center gap-2
                           rounded-xl bg-[#052da7]
                           py-3.5 font-semibold text-white
                           transition-all duration-300
                           hover:bg-[#041f74]
                           hover:-translate-y-1
                           active:scale-95">

                    <span class="transition-all duration-300 group-hover:tracking-wide">
                        Login
                    </span>

                </button>

                <!-- Register -->
                <p class="text-center text-sm text-gray-600 dark:text-gray-400 mt-6">
                    Don't Have Account With Us?

                    <a href="register"
                       class="font-semibold text-[#052da7] hover:text-blue-500 transition-colors">
                        Create One
                    </a>
                </p>

            </form>

        </div>

    </div>

</div>

<script>
function togglePasswordVisibility(inputId, button) {
    const input = document.getElementById(inputId);
    const icon = button.querySelector('i');

    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}
</script>

<?php include "includes/authfoot2.php" ?>