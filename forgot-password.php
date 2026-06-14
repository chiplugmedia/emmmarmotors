<?php 
require $_SERVER['DOCUMENT_ROOT']."/invest/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/actions/forgotten.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$ptitle="Forgot Password";
include "includes/authhead2.php";
?>

<div class="min-h-screen flex items-center justify-center px-4 bg-white dark:bg-[#0b1220] transition-colors duration-300">

    <div class="w-full max-w-md">

        <!-- Logo + Header -->
        <div class="flex flex-col items-center text-center space-y-4">

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
                    Forgot Password?
                </h2>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Enter your email and we'll send you instructions to reset your password
                </p>

            </div>

        </div>

        <!-- Card -->
        <div class="p-6 rounded-3xl mt-6
                    bg-white dark:bg-[#111827]
                    border border-gray-200 dark:border-gray-700
                    shadow-xl">

            <?php echo $genMsg; ?>

            <!-- Form -->
            <form method="POST" action="" class="space-y-5">

                <!-- Email -->
                <div>

                    <label class="text-xs font-semibold text-gray-600 dark:text-gray-300 ml-1">
                        Email Address
                    </label>

                    <div class="relative mt-1">

                        <span class="absolute left-4 top-3.5 text-[#052da7] dark:text-blue-400">
                            <i class="fas fa-envelope"></i>
                        </span>

                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="<?php echo htmlspecialchars($email); ?>"
                            placeholder="Enter email address"
                            class="w-full pl-12 pr-4 py-3 rounded-xl
                                   bg-white dark:bg-[#1f2937]
                                   text-gray-800 dark:text-white
                                   border border-gray-300 dark:border-gray-600
                                   focus:ring-2 focus:ring-[#052da7]
                                   focus:border-[#052da7]
                                   focus:outline-none">

                    </div>

                </div>

                <!-- Submit -->
                <button
                    type="submit"
                    name="forgotPsw"
                    class="group relative flex w-full items-center justify-center
                           rounded-xl bg-[#052da7]
                           py-3.5 font-semibold text-white
                           transition-all duration-300
                           hover:bg-[#041f74]
                           hover:-translate-y-1
                           active:scale-95">

                    <span class="transition-all duration-300 group-hover:tracking-wide">
                        Send Reset Link
                    </span>

                </button>

                <!-- Bottom Text -->
                <p class="text-center text-sm text-gray-600 dark:text-gray-400 mt-6">
                    Don't worry

                    <a href="login"
                       class="font-semibold text-[#052da7] hover:underline">
                        Login
                    </a>
                </p>

            </form>

        </div>

    </div>

</div>


 <?php include "includes/authfoot2.php" ?>