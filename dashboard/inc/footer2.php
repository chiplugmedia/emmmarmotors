
<!-- FOOTER -->
<footer
class="fixed bottom-0 left-0 w-full
       bg-white/95 dark:bg-slate-900/95
       backdrop-blur-xl
       border-t border-slate-200 dark:border-slate-700
       shadow-xl
       px-5 py-3
       transition-all duration-300
       z-40
       md:hidden">

    <div class="flex items-end justify-between max-w-7xl mx-auto">

        <!-- Teams -->
        <a href="#"
           class="flex flex-col items-center gap-1
                  text-slate-600 dark:text-slate-300
                  hover:text-blue-600 dark:hover:text-blue-400
                  transition">

            <i class="fas fa-users text-lg"></i>
            <span class="text-[10px]">Teams</span>

        </a>

        <!-- Product -->
        <a href="#"
           class="flex flex-col items-center gap-1
                  text-slate-600 dark:text-slate-300
                  hover:text-blue-600 dark:hover:text-blue-400
                  transition">

            <i class="fas fa-box text-lg"></i>
            <span class="text-[10px]">Product</span>

        </a>

        <!-- HOME -->
        <a href="index" class="flex flex-col items-center -mt-8">

            <div class="relative">

                <div class="absolute inset-0 bg-blue-500 rounded-full blur-xl opacity-50 animate-pulse"></div>

                <div
                class="relative
                       h-14 w-14
                       rounded-full
                       bg-gradient-to-br
                       from-blue-500
                       to-blue-800
                       border-4 border-white dark:border-slate-950
                       shadow-xl
                       flex items-center justify-center
                       hover:scale-105 transition-transform duration-300">

                    <i class="fas fa-home text-white text-xl"></i>

                </div>

            </div>

            <span class="mt-1 text-[10px] font-bold text-blue-600 dark:text-blue-400">
                Home
            </span>

        </a>

        <!-- Profile -->
        <a href="profile"
           class="flex flex-col items-center gap-1
                  text-slate-600 dark:text-slate-300
                  hover:text-blue-600 dark:hover:text-blue-400
                  transition">

            <i class="fas fa-user text-lg"></i>
            <span class="text-[10px]">Profile</span>

        </a>

        <!-- Menu -->
        <a href="menu"
           class="flex flex-col items-center gap-1
                  text-slate-600 dark:text-slate-300
                  hover:text-blue-600 dark:hover:text-blue-400
                  transition">

            <i class="fas fa-bars text-lg"></i>
            <span class="text-[10px]">Menu</span>

        </a>

    </div>

</footer>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const html = document.documentElement;
    const switchBtn = document.getElementById("settingsThemeSwitch");
    const switchDot = document.getElementById("settingsThemeDot");

    function updateThemeSwitch() {

        if (html.classList.contains("dark")) {

            switchBtn.classList.remove("bg-gray-300");
            switchBtn.classList.add("bg-blue-500");

            switchDot.style.transform = "translateX(20px)";

        } else {

            switchBtn.classList.remove("bg-blue-500");
            switchBtn.classList.add("bg-gray-300");

            switchDot.style.transform = "translateX(0px)";
        }
    }

    // Load saved theme
    if (localStorage.getItem("theme") === "dark") {
        html.classList.add("dark");
    }

    updateThemeSwitch();

    switchBtn.addEventListener("click", function () {

        html.classList.toggle("dark");

        if (html.classList.contains("dark")) {
            localStorage.setItem("theme", "dark");
        } else {
            localStorage.setItem("theme", "light");
        }

        updateThemeSwitch();

    });

});
</script>

<!-- THEME SCRIPT -->
<script>
(function () {
    const html = document.documentElement;
    const storageKey = "theme";
    const mediaQuery = window.matchMedia ? window.matchMedia("(prefers-color-scheme: dark)") : null;

    function getStoredTheme() {
        try {
            return localStorage.getItem(storageKey);
        } catch (error) {
            return null;
        }
    }

    function saveTheme(theme) {
        try {
            localStorage.setItem(storageKey, theme);
        } catch (error) {
            return;
        }
    }

    function getPreferredTheme() {
        const storedTheme = getStoredTheme();

        if (storedTheme === "dark" || storedTheme === "light") {
            return storedTheme;
        }

        return mediaQuery && mediaQuery.matches ? "dark" : "light";
    }

    function applyTheme(theme) {
        const useDark = theme === "dark";
        const toggle = document.getElementById("themeToggle");

        html.classList.toggle("dark", useDark);
        html.dataset.theme = theme;

        if (toggle) {
            toggle.setAttribute("aria-pressed", String(useDark));
            toggle.setAttribute("aria-label", useDark ? "Switch to light mode" : "Switch to dark mode");
            toggle.title = useDark ? "Switch to light mode" : "Switch to dark mode";
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        const toggle = document.getElementById("themeToggle");

        applyTheme(getPreferredTheme());

        if (toggle) {
            toggle.addEventListener("click", function () {
                const nextTheme = html.classList.contains("dark") ? "light" : "dark";

                saveTheme(nextTheme);
                applyTheme(nextTheme);
            });
        }

        if (mediaQuery) {
            const syncSystemTheme = function () {
                if (!getStoredTheme()) {
                    applyTheme(getPreferredTheme());
                }
            };

            if (mediaQuery.addEventListener) {
                mediaQuery.addEventListener("change", syncSystemTheme);
            } else if (mediaQuery.addListener) {
                mediaQuery.addListener(syncSystemTheme);
            }
        }
    });
})();
</script>

</body>
</html>
