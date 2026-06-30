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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<style>
:root{
    color-scheme: light;
}

html.dark{
    color-scheme: dark;
}

body{
    overflow-x:hidden;
}

body,
button,
a,
input,
select,
textarea{
    transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform;
    transition-duration: 300ms;
}

html.dark .bg-\[\#FEFBEF\],
html.dark .bg-white,
html.dark .bg-white\/70,
html.dark .bg-white\/95,
html.dark .bg-\[\#fdf8e5\]\/80{
    background-color: rgb(15 23 42 / 0.94) !important;
}

html.dark .bg-\[\#1a3332\],
html.dark .bg-\[\#2F4F4E\]{
    background-color: rgb(20 83 78) !important;
}

html.dark .bg-\[\#1a3332\]\/10,
html.dark .bg-gray-50,
html.dark .bg-gray-100,
html.dark .bg-green-50,
html.dark .bg-green-100{
    background-color: rgb(30 41 59 / 0.9) !important;
}

html.dark .hover\:bg-\[\#2f4f4e\]\/10:hover,
html.dark .hover\:bg-\[\#1a3332\]\/20:hover,
html.dark .hover\:bg-gray-50:hover,
html.dark .hover\:bg-gray-100:hover{
    background-color: rgb(51 65 85 / 0.85) !important;
}

html.dark .border-\[\#1a3332\],
html.dark .border-\[\#FEFBEF\],
html.dark .border-gray-100,
html.dark .border-gray-200,
html.dark .border-gray-300,
html.dark .border-green-100,
html.dark .border-red-100,
html.dark .border-white\/20{
    border-color: rgb(51 65 85) !important;
}

html.dark .divide-gray-100 > :not([hidden]) ~ :not([hidden]),
html.dark .divide-red-100 > :not([hidden]) ~ :not([hidden]){
    border-color: rgb(51 65 85) !important;
}

html.dark .text-\[\#1a3332\],
html.dark .text-\[\#2f4f4e\],
html.dark .text-\[\#2F4F4E\],
html.dark .text-gray-900,
html.dark .text-gray-800,
html.dark .text-gray-700{
    color: rgb(248 250 252) !important;
}

html.dark .text-\[\#1a3332\]\/60,
html.dark .text-\[\#1a3332\]\/70,
html.dark .text-gray-600,
html.dark .text-gray-500,
html.dark .text-gray-400{
    color: rgb(203 213 225) !important;
}

html.dark .placeholder-\[\#1a3332\]\/40::placeholder{
    color: rgb(148 163 184 / 0.75) !important;
}

@keyframes float-y {
    0% {transform: translateY(0);}
    50% {transform: translateY(-8px);}
    100% {transform: translateY(0);}
}

.animate-float{
    animation:float-y 3s ease-in-out infinite;
}
</style>

</head>

<body class="w-full px-3 mx-auto bg-slate-100 text-slate-900 dark:bg-slate-950 dark:text-white transition-colors duration-300">
<!-- DESKTOP SIDEBAR -->
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
        <img
            src="assets/images/logo.png"
            alt="Logo"
            class="max-h-16 w-auto object-contain">
    </div>

    <!-- MENU -->
    <nav class="flex-1 overflow-y-auto py-4 space-y-1">

        <a href="dashboard.php"
           class="sidebar-link flex items-center gap-3 px-6 py-3 rounded-xl mx-2 transition
                  text-slate-700 dark:text-slate-300
                  hover:bg-slate-100 dark:hover:bg-slate-800">
            <i class="fas fa-home w-5"></i>
            <span>Dashboard</span>
        </a>

        <a href="deposit.php"
           class="sidebar-link flex items-center gap-3 px-6 py-3 rounded-xl mx-2 transition
                  text-slate-700 dark:text-slate-300
                  hover:bg-slate-100 dark:hover:bg-slate-800">
            <i class="fas fa-wallet w-5"></i>
            <span>Deposits</span>
        </a>

        <a href="invest.php"
           class="sidebar-link flex items-center gap-3 px-6 py-3 rounded-xl mx-2 transition
                  text-slate-700 dark:text-slate-300
                  hover:bg-slate-100 dark:hover:bg-slate-800">
            <i class="fas fa-chart-line w-5"></i>
            <span>Investment Packages</span>
        </a>

        <a href="userstasks.php"
           class="sidebar-link flex items-center gap-3 px-6 py-3 rounded-xl mx-2 transition
                  text-slate-700 dark:text-slate-300
                  hover:bg-slate-100 dark:hover:bg-slate-800">
            <i class="fas fa-briefcase w-5"></i>
            <span>User Packages</span>
        </a>

        <a href="tasks.php"
           class="sidebar-link flex items-center gap-3 px-6 py-3 rounded-xl mx-2 transition
                  text-slate-700 dark:text-slate-300
                  hover:bg-slate-100 dark:hover:bg-slate-800">
            <i class="fas fa-check-circle w-5"></i>
            <span>Daily Tasks</span>
        </a>

        <a href="add-blog.php"
           class="sidebar-link flex items-center gap-3 px-6 py-3 rounded-xl mx-2 transition
                  text-slate-700 dark:text-slate-300
                  hover:bg-slate-100 dark:hover:bg-slate-800">
            <i class="fas fa-bullhorn w-5"></i>
            <span>Popup Posts</span>
        </a>

        <a href="coupons.php"
           class="sidebar-link flex items-center gap-3 px-6 py-3 rounded-xl mx-2 transition
                  text-slate-700 dark:text-slate-300
                  hover:bg-slate-100 dark:hover:bg-slate-800">
            <i class="fas fa-ticket-alt w-5"></i>
            <span>Coupons</span>
        </a>

        <a href="users.php"
           class="sidebar-link flex items-center gap-3 px-6 py-3 rounded-xl mx-2 transition
                  text-slate-700 dark:text-slate-300
                  hover:bg-slate-100 dark:hover:bg-slate-800">
            <i class="fas fa-users w-5"></i>
            <span>Users</span>
        </a>

        <a href="setting.php"
           class="sidebar-link flex items-center gap-3 px-6 py-3 rounded-xl mx-2 transition
                  text-slate-700 dark:text-slate-300
                  hover:bg-slate-100 dark:hover:bg-slate-800">
            <i class="fas fa-cog w-5"></i>
            <span>Settings</span>
        </a>

    </nav>

    <!-- FOOTER -->
    <div class="p-4 border-t border-slate-200 dark:border-slate-800">

        <a href="logout.php"
           class="flex items-center justify-center gap-2
                  w-full py-3 rounded-xl
                  bg-red-600 hover:bg-red-700
                  text-white font-semibold transition">
            <i class="fas fa-sign-out-alt"></i>
            Logout
        </a>

    </div>

</aside>

<!-- MAIN CONTENT -->
<div id="mainContent" class="transition-all duration-300 md:ml-64">

    <!-- Your Page Content -->

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // ACTIVE MENU
    const currentPage = window.location.pathname.split("/").pop() || "dashboard.php";
    const links = document.querySelectorAll(".sidebar-link");

    links.forEach(link => {

        const href = link.getAttribute("href");

        if (href === currentPage) {

            link.classList.add(
                "bg-blue-100",
                "dark:bg-blue-900/30",
                "text-blue-600",
                "dark:text-blue-400",
                "font-semibold"
            );

            link.classList.remove(
                "text-slate-700",
                "dark:text-slate-300"
            );

        }

    });

    // SIDEBAR TOGGLE
    const sidebar = document.getElementById("sidebar");
    const mainContent = document.getElementById("mainContent");
    const toggleBtn = document.getElementById("toggleSidebar");

    if (toggleBtn) {

        let collapsed = false;

        toggleBtn.addEventListener("click", function () {

            collapsed = !collapsed;

            if (collapsed) {

                sidebar.classList.remove("w-64");
                sidebar.classList.add("w-0", "overflow-hidden");

                mainContent.classList.remove("md:ml-64");
                mainContent.classList.add("md:ml-0");

            } else {

                sidebar.classList.remove("w-0", "overflow-hidden");
                sidebar.classList.add("w-64");

                mainContent.classList.remove("md:ml-0");
                mainContent.classList.add("md:ml-64");

            }

        });

    }

});
</script>