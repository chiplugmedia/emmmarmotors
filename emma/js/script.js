document.addEventListener("DOMContentLoaded", () => {
  // Skeleton loading duration
  setTimeout(() => {
    document.getElementById("balanceSkeleton").classList.add("hidden");
    document.getElementById("balanceContent").classList.remove("hidden");
  }, 2000);

  const inner = document.getElementById("balanceInner");
  const track = document.getElementById("balanceTrack");
  const dots = document.querySelectorAll(".dot");
  const amounts = document.querySelectorAll(".bal-amount");
  const slaves = document.querySelectorAll(".eye-slave");
  const slideCount = inner.children.length;

  let current = 0;
  let revealed = false;
  let startX = 0;

  function goTo(i) {
    current = i;
    inner.style.transform = `translateX(-${i * 100}%)`;

    dots.forEach((d, idx) => {
      const active = idx === i;
      d.classList.toggle("bg-slate-800", active);
      d.classList.toggle("dark:bg-white", active);
      d.classList.toggle("bg-slate-300", !active);
      d.classList.toggle("dark:bg-slate-600", !active);
    });
  }

  function syncEyes(rev) {
    revealed = rev;

    // Toggle the same blur-md class the markup already uses,
    // instead of an inline style, so the blur amount stays consistent.
    amounts.forEach((amount) => {
      amount.classList.toggle("blur-md", !rev);
    });

    slaves.forEach((btn) => {
      const icon = btn.querySelector("i");

      if (icon) {
        icon.className = rev
          ? "fas fa-eye text-sm"
          : "fas fa-eye-slash text-sm";
      }
    });
  }

  dots.forEach((dot) => {
    dot.addEventListener("click", () => {
      goTo(+dot.dataset.i);
    });
  });

  slaves.forEach((btn) => {
    btn.addEventListener("click", () => {
      syncEyes(!revealed);
    });
  });

  // Swipe Support
  track.addEventListener(
    "touchstart",
    (e) => {
      startX = e.touches[0].clientX;
    },
    { passive: true },
  );

  track.addEventListener(
    "touchend",
    (e) => {
      const diff = startX - e.changedTouches[0].clientX;

      if (Math.abs(diff) > 40) {
        goTo(
          Math.max(0, Math.min(slideCount - 1, current + (diff > 0 ? 1 : -1))),
        );
      }
    },
    { passive: true },
  );
});

document.addEventListener("DOMContentLoaded", function () {
  // Simulate loading
  setTimeout(() => {
    document.getElementById("suggestionSkeleton").classList.add("hidden");
    document.getElementById("suggestionContent").classList.remove("hidden");
  }, 2000);
});

document.addEventListener("DOMContentLoaded", () => {
  // Simulate loading
  setTimeout(() => {
    document.getElementById("opportunitySkeleton").classList.add("hidden");
    document.getElementById("opportunityContent").classList.remove("hidden");
  }, 2000);
});

document.addEventListener("DOMContentLoaded", function () {
  // Simulate loading
  setTimeout(() => {
    document.getElementById("transactionSkeleton").classList.add("hidden");
    document.getElementById("transactionContent").classList.remove("hidden");
  }, 2000);
});

document.addEventListener("DOMContentLoaded", function () {
  // ACTIVE MENU
  const currentPage =
    window.location.pathname.split("/").pop() || "dashboard.php";
  const links = document.querySelectorAll(".sidebar-link");

  links.forEach((link) => {
    const href = link.getAttribute("href");

    if (href === currentPage) {
      link.classList.add(
        "bg-blue-100",
        "dark:bg-blue-900/30",
        "text-blue-600",
        "dark:text-blue-400",
        "font-semibold",
      );

      link.classList.remove("text-slate-700", "dark:text-slate-300");
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

(function () {
  const html = document.documentElement;
  const storageKey = "theme";
  const mediaQuery = window.matchMedia
    ? window.matchMedia("(prefers-color-scheme: dark)")
    : null;

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
      toggle.setAttribute(
        "aria-label",
        useDark ? "Switch to light mode" : "Switch to dark mode",
      );
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

(function () {
  // ---------- Balance show/hide toggle ----------
  const toggleBtn = document.getElementById("toggleBalance");
  const balanceEl = document.getElementById("balance");
  const slashPath = document.getElementById("eyeSlashPath");

  const realBalance = balanceEl.dataset.balance;
  let hidden = false;

  function toggleBalanceVisibility(isHidden) {
    if (isHidden) {
      balanceEl.style.filter = "blur(8px)";
      balanceEl.style.userSelect = "none";
    } else {
      balanceEl.style.filter = "none";
      balanceEl.style.userSelect = "auto";
    }
  }

  toggleBtn.addEventListener("click", function () {
    hidden = !hidden;
    balanceEl.textContent = realBalance; // Always show real balance
    toggleBalanceVisibility(hidden);
    slashPath.style.display = hidden ? "inline" : "none";
    toggleBtn.setAttribute("aria-pressed", String(hidden));
    toggleBtn.setAttribute(
      "aria-label",
      hidden ? "Show balance" : "Hide balance",
    );
  });

  // ---------- Skeleton loaders ----------
  // Simulates async data fetches for each section, swapping the
  // skeleton placeholder for real content once "loaded".
  function loadSection(skeletonId, contentId, delay) {
    const skeleton = document.getElementById(skeletonId);
    const content = document.getElementById(contentId);
    setTimeout(function () {
      skeleton.classList.add("skeleton-hidden");
      content.classList.remove("skeleton-hidden");
      content.classList.add("fade-in");
    }, delay);
  }

  loadSection("suggestionSkeleton", "suggestionContent", 1500);
  loadSection("opportunitySkeleton", "opportunityContent", 1500);
  loadSection("transactionSkeleton", "transactionContent", 1500);
})();

window.addEventListener("load", function () {
  setTimeout(function () {
    document.getElementById("walletSkeleton").style.display = "none";
    document.getElementById("walletContent").style.display = "block";
  }, 1500);
});

function toggleDropdown(menuId, arrowId) {
  const menu = document.getElementById(menuId);
  const arrow = document.getElementById(arrowId);

  menu.classList.toggle("hidden");
  arrow.classList.toggle("rotate-180");
}
