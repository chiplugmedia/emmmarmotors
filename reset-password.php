<?php 
require $_SERVER['DOCUMENT_ROOT']."/invest/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/actions/forgotten.php";

if(!isset($_GET['tkn']) || empty($_GET['tkn'])){
    header("location:login.php");
    exit;
}
$token=filter_string($_GET['tkn']);
$sql=$link->prepare("SELECT * FROM otp WHERE otp=?");
$sql->bind_param("s", $token);
$sql->execute();
$result=$sql->get_result();
$numrow=$result->num_rows;
$row=$result->fetch_assoc();
if($numrow == 1){
    $email=$_SESSION['forgotEmail']=$row['email'];
}
else{
    header("location:login.php");
    exit;
}

$ptitle="Reset Password";
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
                    Reset Password 🔒
                </h2>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    For
                    <span class="font-semibold text-[#052da7] dark:text-blue-400">
                        <?php echo htmlspecialchars($email); ?>
                    </span>
                </p>

            </div>

        </div>

        <!-- Card -->
        <div class="p-6 rounded-3xl mt-4
                    bg-white dark:bg-[#111827]
                    border border-gray-200 dark:border-gray-700
                    shadow-xl">

            <?php echo $genMsg; ?>

            <!-- Form -->
            <form method="POST" action="" class="space-y-5">

                <!-- New Password -->
                <div>

                    <label class="text-xs font-semibold text-gray-600 dark:text-gray-300 ml-1">
                        New Password
                    </label>

                    <div class="relative mt-1">

                        <span class="absolute left-4 top-3.5 text-[#052da7] dark:text-blue-400">
                            <i class="fas fa-lock"></i>
                        </span>

                        <input
                            type="password"
                            id="new-password"
                            name="password"
                            placeholder="••••••••••••"
                            autocomplete="off"
                            autocorrect="off"
                            class="w-full pl-12 pr-12 py-3 rounded-xl
                                   bg-white dark:bg-[#1f2937]
                                   text-gray-800 dark:text-white
                                   border border-gray-300 dark:border-gray-600
                                   focus:ring-2 focus:ring-[#052da7]
                                   focus:border-[#052da7]
                                   focus:outline-none">

                        <button
                            type="button"
                            class="absolute right-4 top-3.5 text-gray-400 hover:text-[#052da7]"
                            onclick="togglePasswordVisibility('new-password', this)">
                            <i class="fas fa-eye"></i>
                        </button>

                    </div>

                </div>

                <!-- Confirm Password -->
                <div>

                    <label class="text-xs font-semibold text-gray-600 dark:text-gray-300 ml-1">
                        Confirm Password
                    </label>

                    <div class="relative mt-1">

                        <span class="absolute left-4 top-3.5 text-[#052da7] dark:text-blue-400">
                            <i class="fas fa-lock"></i>
                        </span>

                        <input
                            type="password"
                            id="confirm-password"
                            name="confirmPsw"
                            placeholder="••••••••••••"
                            autocomplete="off"
                            autocorrect="off"
                            class="w-full pl-12 pr-12 py-3 rounded-xl
                                   bg-white dark:bg-[#1f2937]
                                   text-gray-800 dark:text-white
                                   border border-gray-300 dark:border-gray-600
                                   focus:ring-2 focus:ring-[#052da7]
                                   focus:border-[#052da7]
                                   focus:outline-none">

                        <button
                            type="button"
                            class="absolute right-4 top-3.5 text-gray-400 hover:text-[#052da7]"
                            onclick="togglePasswordVisibility('confirm-password', this)">
                            <i class="fas fa-eye"></i>
                        </button>

                    </div>

                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    name="resetPsw"
                    class="group relative flex w-full items-center justify-center
                           rounded-xl bg-[#052da7]
                           py-3.5 font-semibold text-white
                           transition-all duration-300
                           hover:bg-[#041f74]
                           hover:-translate-y-1
                           active:scale-95">

                    <span class="transition-all duration-300 group-hover:tracking-wide">
                        Set New Password
                    </span>

                </button>

                <!-- Bottom Text -->
                <p class="text-center text-sm text-gray-600 dark:text-gray-400 mt-6">
                    Don't worry.

                    <a href="login"
                       class="font-semibold text-[#052da7] hover:underline">
                        Back to Login
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