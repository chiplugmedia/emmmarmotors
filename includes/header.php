<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Emmmar Motors — Premium Vehicles. Honest Deals.</title>
<script src="https://cdn.tailwindcss.com"></script>

    <link href="/emmmarmotors/emma/css/home.css" rel="stylesheet">

</head>
<body class="bg-white text-navy-900 dark:bg-navy-950 dark:text-slate-100 antialiased transition-colors duration-300">

<header class="fixed top-0 inset-x-0 z-50 glass-nav border-b border-navy-900/5 dark:border-white/5">
  <nav class="max-w-7xl mx-auto px-5 sm:px-8 h-18 py-3 flex items-center justify-between gap-4">
    <a href="/" class="flex items-center shrink-0">
      <img src="assets/logo-light.svg" alt="Emmmar Motors" class="h-9 w-auto dark:hidden" />
      <img src="assets/logo-dark.svg" alt="Emmmar Motors" class="h-9 w-auto hidden dark:block" />
    </a>

    <ul class="hidden lg:flex items-center gap-8 text-sm font-medium text-navy-700 dark:text-slate-300">
      <li><a href="/" class="transition-colors text-brand-600 dark:text-brand-400">Home</a></li>
      <li><a href="about" class="transition-colors hover:text-brand-600 dark:hover:text-brand-400">About Us</a></li>
      <li><a href="vehicles.html" class="transition-colors hover:text-brand-600 dark:hover:text-brand-400">Vehicles</a></li>
      <li><a href="services.html" class="transition-colors hover:text-brand-600 dark:hover:text-brand-400">Services</a></li>
      <li><a href="financing.html" class="transition-colors hover:text-brand-600 dark:hover:text-brand-400">Financing</a></li>
      <li><a href="testimonials.html" class="transition-colors hover:text-brand-600 dark:hover:text-brand-400">Testimonials</a></li>
      <li><a href="contact.html" class="transition-colors hover:text-brand-600 dark:hover:text-brand-400">Contact</a></li>
    </ul>

    <div class="flex items-center gap-3">
      <button id="theme-toggle" aria-label="Toggle dark mode" class="relative w-12 h-7 rounded-full bg-navy-100 dark:bg-navy-800 border border-navy-900/10 dark:border-white/10 flex items-center px-1 transition-colors">
        <span class="toggle-dot w-5 h-5 rounded-full bg-white dark:bg-brand-400 shadow flex items-center justify-center">
          <svg id="icon-sun" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#1D4ED8" stroke-width="2.2" stroke-linecap="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></svg>
          <svg id="icon-moon" class="hidden" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.8A9 9 0 1 1 11.2 3 7 7 0 0 0 21 12.8z"/></svg>
        </span>
      </button>

      <a href="financing.html" class="hidden md:inline-flex items-center gap-1.5 bg-brand-600 hover:bg-brand-700 text-white text-sm font-semibold px-5 py-2.5 rounded-xl shadow-soft transition-colors">
        Get Financing
      </a>

      <button id="mobile-menu-btn" class="lg:hidden w-10 h-10 rounded-lg flex items-center justify-center border border-navy-900/10 dark:border-white/10">
        <svg id="icon-burger" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
        <svg id="icon-close" class="hidden" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M6 6l12 12M18 6L6 18"/></svg>
      </button>
    </div>
  </nav>

  <div id="mobile-menu" class="hidden lg:hidden glass-nav border-t border-navy-900/5 dark:border-white/5 px-5 py-4">
    <ul class="flex flex-col gap-1 text-sm font-medium text-navy-700 dark:text-slate-300">
      <li><a href="/" class="block py-2.5 px-3 rounded-lg hover:bg-brand-50 dark:hover:bg-white/5 text-brand-600 dark:text-brand-400 font-semibold">Home</a></li>
      <li><a href="about" class="block py-2.5 px-3 rounded-lg hover:bg-brand-50 dark:hover:bg-white/5">About Us</a></li>
      <li><a href="vehicles.html" class="block py-2.5 px-3 rounded-lg hover:bg-brand-50 dark:hover:bg-white/5">Vehicles</a></li>
      <li><a href="services.html" class="block py-2.5 px-3 rounded-lg hover:bg-brand-50 dark:hover:bg-white/5">Services</a></li>
      <li><a href="financing.html" class="block py-2.5 px-3 rounded-lg hover:bg-brand-50 dark:hover:bg-white/5">Financing</a></li>
      <li><a href="testimonials.html" class="block py-2.5 px-3 rounded-lg hover:bg-brand-50 dark:hover:bg-white/5">Testimonials</a></li>
      <li><a href="contact.html" class="block py-2.5 px-3 rounded-lg hover:bg-brand-50 dark:hover:bg-white/5">Contact</a></li>
      <li class="pt-2"><a href="financing.html" class="block text-center bg-brand-600 text-white font-semibold py-2.5 rounded-xl">Get Financing</a></li>
    </ul>
  </div>
</header>

