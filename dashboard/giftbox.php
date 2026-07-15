<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard — Optinex</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script>
  tailwind.config = {
    theme: {
      extend: {
        fontFamily: { sans: ['Inter','ui-sans-serif','system-ui','sans-serif'] },
        colors: {
          navy: { 900:'#0A1A33', 800:'#0F2547', 700:'#15305F' },
          brand: { 50:'#EFF6FF',100:'#DBEAFE',200:'#BFDBFE',300:'#93C5FD',400:'#60A5FA',500:'#3B82F6',600:'#2563EB',700:'#1D4ED8',800:'#1E40AF',900:'#1E3A8A' }
        }
      }
    }
  }
</script>
<style>
  body{font-family:'Inter',ui-sans-serif,system-ui,sans-serif;}
  #sidebar{transition:transform .25s ease;}
  @media (max-width: 1023px){
    #sidebar{position:fixed;inset:0 auto 0 0;width:16rem;transform:translateX(-100%);z-index:50;}
    #sidebar.open{transform:translateX(0);}
  }
</style>
</head>
<body class="bg-blue-50/40 text-navy-900 antialiased">

<div class="lg:grid lg:grid-cols-[16rem_1fr] min-h-screen">

  <!-- Sidebar -->
  <aside id="sidebar" class="bg-navy-900 text-white flex flex-col h-screen lg:sticky lg:top-0">
    <div class="flex items-center justify-between px-6 h-16 border-b border-white/10">
      <a href="dashboard.html" class="flex items-center gap-2">
        <span class="w-8 h-8 rounded-lg bg-white text-navy-900 flex items-center justify-center font-bold text-sm">O</span>
        <span class="font-semibold text-lg">Optinex</span>
      </a>
      <button id="closeSidebar" class="lg:hidden text-white/70 hover:text-white">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
      </button>
    </div>

    <nav class="flex-1 px-3 py-6 space-y-1 text-sm">
      <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-white/10 text-white font-medium">
        <svg class="w-4.5 h-4.5 w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12 12 4l9 8M5 10v9a1 1 0 0 0 1 1h4v-6h4v6h4a1 1 0 0 0 1-1v-9"/></svg>
        Overview
      </a>
      <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-blue-100 hover:bg-white/5 hover:text-white transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6a6 6 0 1 1-12 0 6 6 0 0 1 12 0Z"/></svg>
        Savings
      </a>
      <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-blue-100 hover:bg-white/5 hover:text-white transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 17 9 11l4 4 8-8M21 7h-4m4 0v4"/></svg>
        Invest
      </a>
      <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-blue-100 hover:bg-white/5 hover:text-white transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M4.5 5.25h15a1.5 1.5 0 0 1 1.5 1.5v10.5a1.5 1.5 0 0 1-1.5 1.5h-15A1.5 1.5 0 0 1 3 17.25V6.75a1.5 1.5 0 0 1 1.5-1.5Z"/></svg>
        Cards
      </a>
      <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-blue-100 hover:bg-white/5 hover:text-white transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m-12 5h12m-12 5h12M4 7h.01M4 12h.01M4 17h.01"/></svg>
        Transactions
      </a>
      <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-blue-100 hover:bg-white/5 hover:text-white transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.164.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.766.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
        Settings
      </a>
    </nav>

    <div class="px-3 pb-5 pt-3 border-t border-white/10">
      <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-blue-100 hover:bg-white/5 hover:text-white transition-colors text-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25"/></svg>
        Log out
      </a>
      <div class="mt-3 flex items-center gap-3 px-3">
        <img src="https://i.pravatar.cc/64?img=47" alt="" class="w-9 h-9 rounded-full object-cover">
        <div class="min-w-0">
          <p class="text-sm font-medium truncate">Ada Nwosu</p>
          <p class="text-xs text-blue-300 truncate">ada@email.com</p>
        </div>
      </div>
    </div>
  </aside>

  <div id="overlay" class="hidden fixed inset-0 bg-black/40 z-40 lg:hidden"></div>

  <!-- Main -->
  <div class="flex flex-col min-w-0">

    <!-- Topbar -->
    <header class="sticky top-0 z-30 bg-white border-b border-blue-100">
      <div class="h-16 px-4 sm:px-8 flex items-center justify-between gap-4">
        <div class="flex items-center gap-3">
          <button id="openSidebar" class="lg:hidden p-2 -ml-2 text-navy-900">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
          </button>
          <h1 class="font-semibold text-navy-900 text-lg">Overview</h1>
        </div>
        <div class="hidden md:flex items-center flex-1 max-w-xs">
          <div class="relative w-full">
            <svg class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35M18 10.5a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z"/></svg>
            <input type="text" placeholder="Search transactions, goals..." class="w-full text-sm bg-blue-50/60 rounded-lg pl-9 pr-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand-500">
          </div>
        </div>
        <div class="flex items-center gap-4">
          <button class="relative p-2 text-slate-500 hover:text-navy-900">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.85 23.85 0 0 0 5.454-1.31A8.97 8.97 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.97 8.97 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.26 24.26 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/></svg>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-brand-600 rounded-full"></span>
          </button>
          <img src="https://i.pravatar.cc/64?img=47" alt="" class="w-9 h-9 rounded-full object-cover border border-blue-100">
        </div>
      </div>
    </header>

    <main class="flex-1 px-4 sm:px-8 py-8 space-y-8">

      <!-- Greeting -->
      <div>
        <h2 class="text-xl font-bold text-navy-900">Good afternoon, Ada 👋</h2>
        <p class="text-sm text-slate-500 mt-1">Here's what's happening with your money today.</p>
      </div>

      <!-- Wallet + stats -->
      <div class="grid lg:grid-cols-3 gap-5">
        <div class="lg:col-span-2 bg-navy-900 rounded-2xl p-6 text-white relative overflow-hidden">
          <div class="flex items-center justify-between">
            <p class="text-sm text-blue-200">Wallet balance</p>
            <button id="toggleBalance" class="text-blue-200 hover:text-white">
              <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
            </button>
          </div>
          <p id="balance" class="mt-2 text-3xl sm:text-4xl font-bold tracking-tight">₦482,300.00</p>
          <p class="mt-1 text-xs text-blue-300">Across 3 active savings plans and 1 investment</p>
          <div class="mt-6 flex flex-wrap gap-3">
            <button class="text-sm font-semibold text-navy-900 bg-white hover:bg-blue-50 rounded-lg px-4 py-2.5 transition-colors">Fund wallet</button>
            <button class="text-sm font-semibold text-white border border-white/25 hover:bg-white/10 rounded-lg px-4 py-2.5 transition-colors">Withdraw</button>
          </div>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-1 gap-5">
          <div class="bg-white border border-blue-100 rounded-2xl p-5">
            <p class="text-xs text-slate-500">Total saved</p>
            <p class="mt-1.5 text-xl font-bold text-navy-900">₦356,000</p>
            <p class="mt-1 text-xs text-emerald-600 font-medium">↑ 12% vs last month</p>
          </div>
          <div class="bg-white border border-blue-100 rounded-2xl p-5">
            <p class="text-xs text-slate-500">Interest earned</p>
            <p class="mt-1.5 text-xl font-bold text-navy-900">₦8,420</p>
            <p class="mt-1 text-xs text-slate-400">this month</p>
          </div>
        </div>
      </div>

      <!-- Growth chart -->
      <div class="bg-white border border-blue-100 rounded-2xl p-6">
        <div class="flex items-center justify-between">
          <div>
            <h3 class="font-semibold text-navy-900">Savings growth</h3>
            <p class="text-xs text-slate-500 mt-0.5">Last 6 months</p>
          </div>
          <select class="text-xs border border-slate-200 rounded-lg px-2.5 py-1.5 text-slate-600 focus:outline-none">
            <option>6 months</option>
            <option>12 months</option>
          </select>
        </div>
        <div class="mt-4 h-40 sm:h-48">
          <svg class="w-full h-full" viewBox="0 0 600 160" preserveAspectRatio="none">
            <line x1="0" y1="40" x2="600" y2="40" stroke="#E2E8F0" stroke-width="1"/>
            <line x1="0" y1="80" x2="600" y2="80" stroke="#E2E8F0" stroke-width="1"/>
            <line x1="0" y1="120" x2="600" y2="120" stroke="#E2E8F0" stroke-width="1"/>
            <polyline points="0,130 100,110 200,118 300,80 400,88 500,45 600,20" fill="none" stroke="#2563EB" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            <polyline points="0,130 100,110 200,118 300,80 400,88 500,45 600,20 600,160 0,160" fill="url(#chartFill)" stroke="none"/>
            <defs>
              <linearGradient id="chartFill" x1="0" y1="0" x2="0" y2="1">
                <stop offset="0%" stop-color="#3B82F6" stop-opacity="0.25"/>
                <stop offset="100%" stop-color="#3B82F6" stop-opacity="0"/>
              </linearGradient>
            </defs>
            <circle cx="600" cy="20" r="5" fill="#1D4ED8"/>
          </svg>
        </div>
        <div class="flex justify-between text-xs text-slate-400 mt-1 px-1">
          <span>Feb</span><span>Mar</span><span>Apr</span><span>May</span><span>Jun</span><span>Jul</span>
        </div>
      </div>

      <!-- Savings goals -->
      <div>
        <div class="flex items-center justify-between">
          <h3 class="font-semibold text-navy-900">Savings goals</h3>
          <a href="#" class="text-sm font-medium text-brand-700 hover:underline">View all</a>
        </div>
        <div class="mt-4 grid sm:grid-cols-2 lg:grid-cols-3 gap-5">

          <div class="bg-white border border-blue-100 rounded-2xl p-5">
            <div class="flex items-center justify-between">
              <span class="w-10 h-10 rounded-lg bg-brand-50 text-brand-700 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.985-1.106a48.579 48.579 0 0 0-10.03 0c-.563.058-.985.538-.985 1.106v7.635m12-6.677v6.677m0 0h-12"/></svg>
              </span>
              <span class="text-xs font-semibold text-brand-700">68%</span>
            </div>
            <h4 class="mt-3 font-medium text-navy-900">New car</h4>
            <p class="text-xs text-slate-500">₦610,000 of ₦900,000</p>
            <div class="mt-3 h-2 bg-blue-50 rounded-full overflow-hidden">
              <div class="h-full bg-brand-600 rounded-full" style="width:68%"></div>
            </div>
            <p class="mt-2 text-xs text-slate-400">Target date: Nov 2026</p>
            <button class="mt-4 w-full text-sm font-medium text-brand-700 border border-brand-100 hover:bg-brand-50 rounded-lg py-2 transition-colors">Add money</button>
          </div>

          <div class="bg-white border border-blue-100 rounded-2xl p-5">
            <div class="flex items-center justify-between">
              <span class="w-10 h-10 rounded-lg bg-brand-50 text-brand-700 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75"/></svg>
              </span>
              <span class="text-xs font-semibold text-brand-700">41%</span>
            </div>
            <h4 class="mt-3 font-medium text-navy-900">Rent renewal</h4>
            <p class="text-xs text-slate-500">₦492,000 of ₦1,200,000</p>
            <div class="mt-3 h-2 bg-blue-50 rounded-full overflow-hidden">
              <div class="h-full bg-brand-600 rounded-full" style="width:41%"></div>
            </div>
            <p class="mt-2 text-xs text-slate-400">Target date: Jan 2027</p>
            <button class="mt-4 w-full text-sm font-medium text-brand-700 border border-brand-100 hover:bg-brand-50 rounded-lg py-2 transition-colors">Add money</button>
          </div>

          <div class="bg-white border border-blue-100 rounded-2xl p-5">
            <div class="flex items-center justify-between">
              <span class="w-10 h-10 rounded-lg bg-brand-50 text-brand-700 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.008v.008H12v-.008ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
              </span>
              <span class="text-xs font-semibold text-brand-700">85%</span>
            </div>
            <h4 class="mt-3 font-medium text-navy-900">Emergency fund</h4>
            <p class="text-xs text-slate-500">₦255,000 of ₦300,000</p>
            <div class="mt-3 h-2 bg-blue-50 rounded-full overflow-hidden">
              <div class="h-full bg-brand-600 rounded-full" style="width:85%"></div>
            </div>
            <p class="mt-2 text-xs text-slate-400">No target date</p>
            <button class="mt-4 w-full text-sm font-medium text-brand-700 border border-brand-100 hover:bg-brand-50 rounded-lg py-2 transition-colors">Add money</button>
          </div>

        </div>
      </div>

      <!-- Recent transactions -->
      <div class="bg-white border border-blue-100 rounded-2xl overflow-hidden">
        <div class="flex items-center justify-between px-5 sm:px-6 py-4 border-b border-blue-100">
          <h3 class="font-semibold text-navy-900">Recent transactions</h3>
          <a href="#" class="text-sm font-medium text-brand-700 hover:underline">View all</a>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-sm">
            <thead>
              <tr class="text-left text-xs text-slate-400 border-b border-blue-100">
                <th class="px-5 sm:px-6 py-3 font-medium">Description</th>
                <th class="px-5 sm:px-6 py-3 font-medium">Date</th>
                <th class="px-5 sm:px-6 py-3 font-medium">Type</th>
                <th class="px-5 sm:px-6 py-3 font-medium text-right">Amount</th>
                <th class="px-5 sm:px-6 py-3 font-medium text-right">Status</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-blue-50">
              <tr>
                <td class="px-5 sm:px-6 py-3.5 font-medium text-navy-900 whitespace-nowrap">New car — auto-save</td>
                <td class="px-5 sm:px-6 py-3.5 text-slate-500 whitespace-nowrap">Jul 2, 2026</td>
                <td class="px-5 sm:px-6 py-3.5 text-slate-500 whitespace-nowrap">Savings</td>
                <td class="px-5 sm:px-6 py-3.5 text-right font-medium text-navy-900 whitespace-nowrap">− ₦15,000</td>
                <td class="px-5 sm:px-6 py-3.5 text-right"><span class="text-xs font-medium text-emerald-700 bg-emerald-50 rounded-full px-2.5 py-1">Successful</span></td>
              </tr>
              <tr>
                <td class="px-5 sm:px-6 py-3.5 font-medium text-navy-900 whitespace-nowrap">Wallet funding — GTBank</td>
                <td class="px-5 sm:px-6 py-3.5 text-slate-500 whitespace-nowrap">Jul 1, 2026</td>
                <td class="px-5 sm:px-6 py-3.5 text-slate-500 whitespace-nowrap">Deposit</td>
                <td class="px-5 sm:px-6 py-3.5 text-right font-medium text-navy-900 whitespace-nowrap">+ ₦100,000</td>
                <td class="px-5 sm:px-6 py-3.5 text-right"><span class="text-xs font-medium text-emerald-700 bg-emerald-50 rounded-full px-2.5 py-1">Successful</span></td>
              </tr>
              <tr>
                <td class="px-5 sm:px-6 py-3.5 font-medium text-navy-900 whitespace-nowrap">Treasury bill — 182 days</td>
                <td class="px-5 sm:px-6 py-3.5 text-slate-500 whitespace-nowrap">Jun 28, 2026</td>
                <td class="px-5 sm:px-6 py-3.5 text-slate-500 whitespace-nowrap">Investment</td>
                <td class="px-5 sm:px-6 py-3.5 text-right font-medium text-navy-900 whitespace-nowrap">− ₦350,000</td>
                <td class="px-5 sm:px-6 py-3.5 text-right"><span class="text-xs font-medium text-emerald-700 bg-emerald-50 rounded-full px-2.5 py-1">Successful</span></td>
              </tr>
              <tr>
                <td class="px-5 sm:px-6 py-3.5 font-medium text-navy-900 whitespace-nowrap">Rent renewal — withdrawal</td>
                <td class="px-5 sm:px-6 py-3.5 text-slate-500 whitespace-nowrap">Jun 24, 2026</td>
                <td class="px-5 sm:px-6 py-3.5 text-slate-500 whitespace-nowrap">Withdrawal</td>
                <td class="px-5 sm:px-6 py-3.5 text-right font-medium text-navy-900 whitespace-nowrap">− ₦50,000</td>
                <td class="px-5 sm:px-6 py-3.5 text-right"><span class="text-xs font-medium text-amber-700 bg-amber-50 rounded-full px-2.5 py-1">Pending</span></td>
              </tr>
              <tr>
                <td class="px-5 sm:px-6 py-3.5 font-medium text-navy-900 whitespace-nowrap">Emergency fund — auto-save</td>
                <td class="px-5 sm:px-6 py-3.5 text-slate-500 whitespace-nowrap">Jun 20, 2026</td>
                <td class="px-5 sm:px-6 py-3.5 text-slate-500 whitespace-nowrap">Savings</td>
                <td class="px-5 sm:px-6 py-3.5 text-right font-medium text-navy-900 whitespace-nowrap">− ₦10,000</td>
                <td class="px-5 sm:px-6 py-3.5 text-right"><span class="text-xs font-medium text-emerald-700 bg-emerald-50 rounded-full px-2.5 py-1">Successful</span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </main>
  </div>
</div>

<script>
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('overlay');
  document.getElementById('openSidebar').addEventListener('click', () => {
    sidebar.classList.add('open');
    overlay.classList.remove('hidden');
  });
  function closeSidebar() {
    sidebar.classList.remove('open');
    overlay.classList.add('hidden');
  }
  document.getElementById('closeSidebar').addEventListener('click', closeSidebar);
  overlay.addEventListener('click', closeSidebar);

  let visible = true;
  document.getElementById('toggleBalance').addEventListener('click', () => {
    const el = document.getElementById('balance');
    visible = !visible;
    el.textContent = visible ? '₦482,300.00' : '••••••••';
  });
</script>
</body>
</html>