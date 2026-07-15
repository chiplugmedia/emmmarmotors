<?php
  
  
$genMsg = "";
$title=$image=$desc=$genMsg=$profileLink=$url="";
require $_SERVER['DOCUMENT_ROOT'] . "/emmmarmotors/stream.php";
require $_SERVER['DOCUMENT_ROOT'] . "$stream/includes/generalinclude.php";

  
  include "includes/header.php" ?> 


<section id="home" class="grad-hero pt-32 pb-20 lg:pt-40 lg:pb-28 px-5 sm:px-8">
  <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-14 items-center">
    <div>
      <span class="inline-flex items-center gap-2 text-xs font-semibold tracking-wide uppercase text-brand-700 dark:text-brand-300 bg-brand-50 dark:bg-brand-500/10 border border-brand-200 dark:border-brand-500/20 px-3.5 py-1.5 rounded-full">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l2.4 6.5L21 9l-5 4.4L17.4 21 12 17.3 6.6 21 8 13.4 3 9l6.6-.5z"/></svg>
         Welcome To Emmmar Motors Company 

      </span>

      <h1 class="mt-6 text-4xl sm:text-5xl lg:text-[3.4rem] font-extrabold leading-[1.08] tracking-tight text-navy-900 dark:text-white">
        Partner With 

        <span class="block text-brand-600 dark:text-brand-400">Confidence</span>
      </h1>

      <p class="mt-6 text-lg text-navy-600 dark:text-slate-400 max-w-lg leading-relaxed">
        At emmmar motors, we believe that successful partnerships are built on trust, transparency, and results. We are a growing transportation and logistics company involved in vehicle acquisition, transportation services, import and export operations, and business partnerships designed to create value for our clients and investors.

      </p>

      <div class="mt-9 flex flex-wrap gap-4">
        <a href="register" class="inline-flex items-center gap-2 bg-brand-600 hover:bg-brand-700 text-white font-semibold px-7 py-3.5 rounded-xl shadow-glow transition-all hover:-translate-y-0.5">
          Get started
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
        <a href="login" class="inline-flex items-center gap-2 bg-white dark:bg-white/5 text-navy-900 dark:text-white font-semibold px-7 py-3.5 rounded-xl border border-navy-900/10 dark:border-white/10 shadow-soft hover:-translate-y-0.5 transition-all">
          Login
        </a>
      </div>

    </div>

    <div class="relative">
      <div class="rounded-3xl overflow-hidden shadow-soft-lg border border-white/40 dark:border-white/10">
        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1200&q=80"
             alt="Featured Emmmar Motors vehicle" class="w-full h-[420px] sm:h-[480px] object-cover" />
      </div>

      <!-- Floating badge -->
      <div class="absolute -top-5 -left-5 sm:-left-8 glass rounded-2xl shadow-soft-lg px-4 py-3 flex items-center gap-3">
        <span class="w-9 h-9 rounded-full bg-brand-600 flex items-center justify-center shrink-0">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
        </span>
        <div>
          <p class="text-xs font-semibold text-navy-900 dark:text-white leading-tight">Certified Quality</p>
          <p class="text-[11px] text-navy-500 dark:text-slate-400">150-point inspection</p>
        </div>
      </div>

      <!-- Floating finance widget -->
      <div class="absolute -bottom-8 -right-3 sm:-right-8 w-64 glass rounded-2xl shadow-soft-lg p-4">
        <p class="text-[11px] uppercase tracking-wide font-semibold text-navy-500 dark:text-slate-400">Instant Estimate</p>
        <p class="mt-1 text-2xl font-extrabold text-navy-900 dark:text-white">$412<span class="text-sm font-medium text-navy-500 dark:text-slate-400">/mo</span></p>
        <div class="mt-3 h-1.5 rounded-full bg-navy-900/10 dark:bg-white/10 overflow-hidden">
          <div class="h-full w-3/5 rounded-full bg-gradient-to-r from-brand-600 to-brand-400"></div>
        </div>
        <p class="mt-2 text-[11px] text-navy-500 dark:text-slate-400">72-mo term · 6.4% APR est.</p>
      </div>
    </div>
  </div>
</section>


<section class="py-14 border-y border-navy-900/5 dark:border-white/5 bg-navy-50/40 dark:bg-white/[0.02] overflow-hidden">
  <p class="text-center text-xs font-semibold uppercase tracking-widest text-navy-500 dark:text-slate-500 mb-8">Sourcing from the brands you trust</p>
  <div class="max-w-full overflow-hidden">
    <div class="marquee-track gap-16 px-8 text-2xl font-bold text-navy-400 dark:text-slate-600">
      <span>Toyota</span><span>Honda</span><span>Mercedes-Benz</span><span>BMW</span><span>Lexus</span><span>Ford</span><span>Nissan</span><span>Hyundai</span>
      <span>Toyota</span><span>Honda</span><span>Mercedes-Benz</span><span>BMW</span><span>Lexus</span><span>Ford</span><span>Nissan</span><span>Hyundai</span>
    </div>
  </div>
</section>

<section class="py-24 px-5 sm:px-8">
  <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-16 items-center">
    <div class="relative order-2 lg:order-1">
      <div class="rounded-3xl overflow-hidden shadow-soft-lg">
        <img src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?auto=format&fit=crop&w=1100&q=80" alt="Emmmar Motors showroom interior" class="w-full h-[380px] object-cover" />
      </div>
    
    </div>
    <div class="order-1 lg:order-2">
      <span class="text-xs font-semibold tracking-widest uppercase text-brand-600 dark:text-brand-400">About Emmmar Motors</span>
      <h2 class="mt-3 text-3xl sm:text-4xl font-extrabold tracking-tight text-navy-900 dark:text-white">Built on trust, driven by transparency</h2>
      <p class="mt-5 text-navy-600 dark:text-slate-400 leading-relaxed">
       Our mission is simple: to provide reliable business opportunities while building sustainable growth for everyone connected to our company. Through our experience in transportation and commercial operations, we continuously identify profitable opportunities and work diligently to maximize returns while maintaining professionalism and integrity.

      </p>
      <a href="about" class="inline-flex items-center gap-2 bg-brand-600 hover:bg-brand-700 text-white font-semibold px-7 py-3.5 rounded-xl shadow-glow transition-all hover:-translate-y-0.5">
         Learn more
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
     
    </div>
  </div>
</section>

<section id="vehicles" class="py-24 px-5 sm:px-8 bg-navy-50/50 dark:bg-white/[0.02]">
  <div class="max-w-7xl mx-auto">
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-12">
      <div>
        <span class="text-xs font-semibold tracking-widest uppercase text-brand-600 dark:text-brand-400">Featured Vehicles</span>
        <h2 class="mt-3 text-3xl sm:text-4xl font-extrabold tracking-tight text-navy-900 dark:text-white">Ready to drive home</h2>
      </div>
      <a href="vehicles.html" class="inline-flex items-center gap-1.5 text-sm font-semibold text-brand-600 dark:text-brand-400 hover:gap-2.5 transition-all">
        View full inventory
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-7">
      <div class="card-hover bg-white dark:bg-navy-900 rounded-3xl overflow-hidden shadow-soft border border-navy-900/5 dark:border-white/5">
        <div class="relative">
          <img src="https://images.unsplash.com/photo-1542362567-b07e54358753?auto=format&fit=crop&w=800&q=80" alt="2024 Sedan" class="w-full h-52 object-cover" />
          <span class="absolute top-3 left-3 bg-brand-600 text-white text-[11px] font-semibold px-3 py-1 rounded-full">Certified</span>
        </div>
        <div class="p-5">
          <div class="flex items-start justify-between">
            <div><p class="font-bold text-navy-900 dark:text-white">Aurora GLX Sedan</p><p class="text-xs text-navy-500 dark:text-slate-400 mt-0.5">2024 · 8,200 mi · Automatic</p></div>
            <p class="font-extrabold text-brand-600 dark:text-brand-400">$28,900</p>
          </div>
          <a href="vehicles.html" class="mt-4 block text-center bg-navy-900 dark:bg-brand-600 hover:bg-navy-800 dark:hover:bg-brand-700 text-white text-sm font-semibold py-2.5 rounded-xl transition-colors">View Details</a>
        </div>
      </div>
      <div class="card-hover bg-white dark:bg-navy-900 rounded-3xl overflow-hidden shadow-soft border border-navy-900/5 dark:border-white/5">
        <div class="relative">
          <img src="https://images.unsplash.com/photo-1605559424843-9e4c228bf1c2?auto=format&fit=crop&w=800&q=80" alt="2023 SUV" class="w-full h-52 object-cover" />
          <span class="absolute top-3 left-3 bg-navy-900 text-white text-[11px] font-semibold px-3 py-1 rounded-full">New Arrival</span>
        </div>
        <div class="p-5">
          <div class="flex items-start justify-between">
            <div><p class="font-bold text-navy-900 dark:text-white">Summit XR7 SUV</p><p class="text-xs text-navy-500 dark:text-slate-400 mt-0.5">2023 · 12,500 mi · AWD</p></div>
            <p class="font-extrabold text-brand-600 dark:text-brand-400">$36,450</p>
          </div>
          <a href="vehicles.html" class="mt-4 block text-center bg-navy-900 dark:bg-brand-600 hover:bg-navy-800 dark:hover:bg-brand-700 text-white text-sm font-semibold py-2.5 rounded-xl transition-colors">View Details</a>
        </div>
      </div>
      <div class="card-hover bg-white dark:bg-navy-900 rounded-3xl overflow-hidden shadow-soft border border-navy-900/5 dark:border-white/5">
        <div class="relative">
          <img src="https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?auto=format&fit=crop&w=800&q=80" alt="2024 Coupe" class="w-full h-52 object-cover" />
          <span class="absolute top-3 left-3 bg-brand-600 text-white text-[11px] font-semibold px-3 py-1 rounded-full">Certified</span>
        </div>
        <div class="p-5">
          <div class="flex items-start justify-between">
            <div><p class="font-bold text-navy-900 dark:text-white">Velocity S Coupe</p><p class="text-xs text-navy-500 dark:text-slate-400 mt-0.5">2024 · 3,100 mi · Automatic</p></div>
            <p class="font-extrabold text-brand-600 dark:text-brand-400">$42,700</p>
          </div>
          <a href="vehicles.html" class="mt-4 block text-center bg-navy-900 dark:bg-brand-600 hover:bg-navy-800 dark:hover:bg-brand-700 text-white text-sm font-semibold py-2.5 rounded-xl transition-colors">View Details</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-24 px-5 sm:px-8">
  <div class="max-w-7xl mx-auto">
    <div class="text-center max-w-2xl mx-auto mb-14">
      <span class="text-xs font-semibold tracking-widest uppercase text-brand-600 dark:text-brand-400">Why Choose Us</span>
      <h2 class="mt-3 text-3xl sm:text-4xl font-extrabold tracking-tight text-navy-900 dark:text-white">The Emmmar difference</h2>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <div class="card-hover p-6 rounded-3xl bg-white dark:bg-navy-900 shadow-soft border border-navy-900/5 dark:border-white/5">
        <span class="w-12 h-12 rounded-2xl bg-brand-600/10 text-brand-600 dark:text-brand-400 flex items-center justify-center"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l2.4 6.5L21 9l-5 4.4L17.4 21 12 17.3 6.6 21 8 13.4 3 9l6.6-.5z"/></svg></span>
        <p class="mt-4 font-bold text-navy-900 dark:text-white">Quality Vehicles</p>
        <p class="mt-2 text-sm text-navy-500 dark:text-slate-400 leading-relaxed">Every vehicle passes a 150-point mechanical and safety inspection before listing.</p>
      </div>
      <div class="card-hover p-6 rounded-3xl bg-white dark:bg-navy-900 shadow-soft border border-navy-900/5 dark:border-white/5">
        <span class="w-12 h-12 rounded-2xl bg-brand-600/10 text-brand-600 dark:text-brand-400 flex items-center justify-center"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 1v22M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg></span>
        <p class="mt-4 font-bold text-navy-900 dark:text-white">Affordable Pricing</p>
        <p class="mt-2 text-sm text-navy-500 dark:text-slate-400 leading-relaxed">Transparent, market-checked pricing with no hidden dealer fees.</p>
      </div>
      <div class="card-hover p-6 rounded-3xl bg-white dark:bg-navy-900 shadow-soft border border-navy-900/5 dark:border-white/5">
        <span class="w-12 h-12 rounded-2xl bg-brand-600/10 text-brand-600 dark:text-brand-400 flex items-center justify-center"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg></span>
        <p class="mt-4 font-bold text-navy-900 dark:text-white">Flexible Financing</p>
        <p class="mt-2 text-sm text-navy-500 dark:text-slate-400 leading-relaxed">Custom plans across multiple lenders, tailored to your monthly budget.</p>
      </div>
      <div class="card-hover p-6 rounded-3xl bg-white dark:bg-navy-900 shadow-soft border border-navy-900/5 dark:border-white/5">
        <span class="w-12 h-12 rounded-2xl bg-brand-600/10 text-brand-600 dark:text-brand-400 flex items-center justify-center"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 01-9 8.4A8.5 8.5 0 113 11.5a8.38 8.38 0 018-8.4c.5 0 1 0 1.5.1"/><path d="M20 4l-8.5 8.5-3-3"/></svg></span>
        <p class="mt-4 font-bold text-navy-900 dark:text-white">Professional Support</p>
        <p class="mt-2 text-sm text-navy-500 dark:text-slate-400 leading-relaxed">A dedicated advisor guides you from first test drive to final paperwork.</p>
      </div>
    </div>
  </div>
</section>

<section class="py-20 px-5 sm:px-8 grad-cta">
  <div class="max-w-7xl mx-auto grid grid-cols-2 lg:grid-cols-4 gap-8 text-center text-white">
    <div><p class="text-4xl font-extrabold">6,500+</p><p class="mt-2 text-sm text-brand-100">Vehicles Sold</p></div>
    <div><p class="text-4xl font-extrabold">5,200+</p><p class="mt-2 text-sm text-brand-100">Happy Customers</p></div>
    <div><p class="text-4xl font-extrabold">13+</p><p class="mt-2 text-sm text-brand-100">Years of Experience</p></div>
    <div><p class="text-4xl font-extrabold">40+</p><p class="mt-2 text-sm text-brand-100">Partner Brands</p></div>
  </div>
</section>

<section class="py-20 px-5 sm:px-8">
  <div class="max-w-6xl mx-auto rounded-3xl bg-white dark:bg-navy-900 border border-navy-900/5 dark:border-white/5 shadow-soft-lg px-8 py-14 text-center">
    <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-navy-900 dark:text-white">Your next vehicle is one call away</h2>
    <p class="mt-4 text-navy-600 dark:text-slate-400 max-w-xl mx-auto">Browse live inventory or speak with an advisor today — no pressure, just straight answers.</p>
    <div class="mt-8 flex flex-wrap justify-center gap-4">
      <a href="vehicles.html" class="inline-flex items-center gap-2 bg-brand-600 hover:bg-brand-700 text-white font-semibold px-7 py-3.5 rounded-xl shadow-glow transition-all hover:-translate-y-0.5">Browse Inventory</a>
      <a href="contact.html" class="inline-flex items-center gap-2 bg-navy-50 dark:bg-white/5 text-navy-900 dark:text-white font-semibold px-7 py-3.5 rounded-xl border border-navy-900/10 dark:border-white/10 hover:-translate-y-0.5 transition-all">Contact Us</a>
    </div>
  </div>
</section>


      <?php include "includes/footer.php" ?>