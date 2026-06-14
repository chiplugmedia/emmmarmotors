<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require $_SERVER['DOCUMENT_ROOT']."/emmmarmotors/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/actions/formprocess.php";

$isReferral = false;
$refcode = "";
if (isset($_GET['code'])) {
    $isReferral = true;
    $refcode = $_GET['code'];
}

$ptitle = "Register";
include "includes/authhead2.php";
?>
<div class="min-h-screen flex flex-col lg:flex-row bg-white dark:bg-[#0b1220] transition-colors duration-300">

    <!-- =========================
         LEFT SIDE - INFO PANEL
    ========================== -->
    <div class="hidden lg:flex flex-1 relative overflow-hidden items-center justify-center p-12
                bg-gray-50 dark:bg-[#0E1947] transition-colors duration-300">

        <div class="absolute top-0 left-0 -ml-20 -mt-20 w-80 h-80 bg-blue-400/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 -mr-20 -mb-20 w-80 h-80 bg-blue-400/10 rounded-full blur-3xl"></div>

        <div class="relative max-w-lg">

            <h2 class="text-4xl font-bold mb-6 leading-tight text-gray-900 dark:text-white">
                Start accepting payments in minutes
            </h2>

            <p class="text-xl mb-12 text-gray-600 dark:text-gray-300">
                From startups to enterprises, we help you scale faster and safer.
            </p>

            <div class="grid grid-cols-2 gap-8">

                <div class="bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 p-6 rounded-2xl">
                    <h4 class="text-2xl font-bold text-gray-900 dark:text-white">256-bit</h4>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">Encryption</p>
                </div>

                <div class="bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 p-6 rounded-2xl">
                    <h4 class="text-2xl font-bold text-gray-900 dark:text-white">100+</h4>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">Currencies</p>
                </div>

            </div>

        </div>
    </div>

    <!-- =========================
         RIGHT SIDE - FORM
    ========================== -->
    <div class="flex-1 flex lg:items-center lg:justify-center items-start justify-center px-4 py-10">

        <div class="w-full max-w-md">

            <!-- HEADER -->
            <div class="text-center space-y-3 mb-6">

                <a class="transition-transform hover:scale-105 active:scale-95 inline-block" href="/">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto">
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

                <div style="opacity: 1; transform: none;"><h2 class="text-3xl font-bold text-[#0E1947] dark:text-white font-heading tracking-tight">Create your account</h2><p class="mt-2 text-sm text-gray-600 dark:text-gray-400 font-sans">Already have an account? <a class="font-semibold text-blue-600 hover:text-blue-500 transition-colors" href="/emmmarmotors/login" data-discover="true">Sign in here</a></p></div>

            </div>

            <!-- CARD -->
            <div class="p-6 rounded-3xl">

                <?php echo $genMsg; ?>

                <form method="POST" action="" class="space-y-5">

                    <!-- FIRST + LAST NAME -->
                    <div class="grid grid-cols-2 gap-4">

                        <div class="relative">
                            <i class="fas fa-user absolute left-4 top-3.5 text-[#052da7]"></i>
                            <input type="text" name="firstname" placeholder="First Name" required
                                class="w-full pl-12 pr-4 py-3 rounded-xl border bg-white dark:bg-[#1f2937]
                                text-gray-800 dark:text-white focus:ring-2 focus:ring-[#052da7] outline-none
                                transition duration-200">
                        </div>

                        <div class="relative">
                            <i class="fas fa-user absolute left-4 top-3.5 text-[#052da7]"></i>
                            <input type="text" name="lastname" placeholder="Last Name" required
                                class="w-full pl-12 pr-4 py-3 rounded-xl border bg-white dark:bg-[#1f2937]
                                text-gray-800 dark:text-white focus:ring-2 focus:ring-[#052da7] outline-none
                                transition duration-200">
                        </div>

                    </div>

                    <!-- USERNAME -->
                    <div class="relative">
                        <i class="fas fa-at absolute left-4 top-3.5 text-[#052da7]"></i>
                        <input type="text" name="username" placeholder="Username" required
                            class="w-full pl-12 pr-4 py-3 rounded-xl border bg-white dark:bg-[#1f2937]
                            text-gray-800 dark:text-white focus:ring-2 focus:ring-[#052da7] outline-none
                            transition duration-200">
                    </div>

                    <!-- EMAIL -->
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-4 top-3.5 text-[#052da7]"></i>
                        <input type="email" name="email" placeholder="Email Address" required
                            class="w-full pl-12 pr-4 py-3 rounded-xl border bg-white dark:bg-[#1f2937]
                            text-gray-800 dark:text-white focus:ring-2 focus:ring-[#052da7] outline-none
                            transition duration-200">
                    </div>

                    <!-- PHONE -->
                    <div class="relative">
                        <i class="fas fa-phone absolute left-4 top-3.5 text-[#052da7]"></i>
                        <input type="tel" name="phonenumber" placeholder="Phone Number" required
                            class="w-full pl-12 pr-4 py-3 rounded-xl border bg-white dark:bg-[#1f2937]
                            text-gray-800 dark:text-white focus:ring-2 focus:ring-[#052da7] outline-none
                            transition duration-200">
                    </div>

                    <!-- GENDER -->
                    <div class="relative">
                        <i class="fas fa-user-circle absolute left-4 top-3.5 text-[#052da7]"></i>
                        <select name="gender" required
                            class="w-full pl-12 pr-4 py-3 rounded-xl border bg-white dark:bg-[#1f2937]
                            text-gray-800 dark:text-white focus:ring-2 focus:ring-[#052da7] outline-none
                            transition duration-200">

                            <option value="" disabled selected>Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>

                        </select>
                    </div>

                    <!-- PASSWORD (EYE) -->
                    <div class="relative">
                        <i class="fas fa-lock absolute left-4 top-3.5 text-[#052da7]"></i>

                        <input id="password" type="password" name="password" placeholder="Password" required
                            class="w-full pl-12 pr-12 py-3 rounded-xl border bg-white dark:bg-[#1f2937]
                            text-gray-800 dark:text-white focus:ring-2 focus:ring-[#052da7] outline-none
                            transition duration-200">

                        <span onclick="togglePassword('password')"
                            class="absolute right-4 top-3.5 cursor-pointer text-gray-500 hover:text-[#052da7] transition">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>

                    <!-- CONFIRM PASSWORD (EYE) -->
                    <div class="relative">
                        <i class="fas fa-lock absolute left-4 top-3.5 text-[#052da7]"></i>

                        <input id="confirm_password" type="password" name="confirm_password" placeholder="Confirm Password" required
                            class="w-full pl-12 pr-12 py-3 rounded-xl border bg-white dark:bg-[#1f2937]
                            text-gray-800 dark:text-white focus:ring-2 focus:ring-[#052da7] outline-none
                            transition duration-200">

                        <span onclick="togglePassword('confirm_password')"
                            class="absolute right-4 top-3.5 cursor-pointer text-gray-500 hover:text-[#052da7] transition">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>

                    <!-- TERMS -->
                    <div class="flex items-start gap-3 text-sm text-gray-600 dark:text-gray-300">

                        <input type="checkbox" id="terms"
                            class="mt-1 accent-[#052da7] w-4 h-4 cursor-pointer"
                            onchange="toggleSubmit()" required>

                        <label for="terms" class="cursor-pointer">
                            I agree to the
                            <a href="#" class="text-[#052da7] hover:underline">Terms</a>
                            and
                            <a href="#" class="text-[#052da7] hover:underline">Privacy Policy</a>.
                        </label>

                    </div>

                    <!-- SUBMIT -->
                    <button type="submit" id="submitBtn" name="signup" disabled
                        class="w-full py-3.5 rounded-xl bg-[#052da7] text-white font-semibold
                        opacity-50 cursor-not-allowed transition duration-200 hover:bg-[#041f7a]">

                        Create Account
                    </button>

                </form>

            </div>
        </div>
    </div>

</div>

<!-- SCRIPT -->
<script>
function toggleSubmit() {
    const checkbox = document.getElementById('terms');
    const btn = document.getElementById('submitBtn');

    if (checkbox && btn) {
        btn.disabled = !checkbox.checked;
        
        if (checkbox.checked) {
            btn.classList.remove('opacity-50', 'cursor-not-allowed');
        } else {
            btn.classList.add('opacity-50', 'cursor-not-allowed');
        }
    }
}

// PASSWORD TOGGLE
function togglePassword(id) {
    const input = document.getElementById(id);
    if (input) {
        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
        input.setAttribute('type', type);
        
        // Toggle eye icon (optional enhancement)
        const icon = event.currentTarget.querySelector('i');
        if (icon) {
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        }
    }
}

// Optional: Add real-time password match validation
document.addEventListener('DOMContentLoaded', function() {
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm_password');
    
    if (password && confirmPassword) {
        function validatePasswordMatch() {
            if (password.value !== confirmPassword.value) {
                confirmPassword.setCustomValidity("Passwords don't match");
            } else {
                confirmPassword.setCustomValidity('');
            }
        }
        
        password.addEventListener('change', validatePasswordMatch);
        confirmPassword.addEventListener('keyup', validatePasswordMatch);
    }
});
</script>


<?php include "includes/authfoot2.php" ?>