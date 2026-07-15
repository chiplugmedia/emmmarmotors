<?php
  
  
$genMsg = "";
$title=$image=$desc=$genMsg=$profileLink=$url="";
require $_SERVER['DOCUMENT_ROOT'] . "/emmmarmotors/stream.php";
require $_SERVER['DOCUMENT_ROOT'] . "$stream/includes/generalinclude.php";

  
  include "includes/header.php" ?> 


<section class="grad-hero pt-32 pb-16 px-5 sm:px-8">
  <div class="max-w-4xl mx-auto text-center">
    <span class="text-xs font-semibold tracking-widest uppercase text-brand-600 dark:text-brand-400">About Emmmar Motors</span>
    <h1 class="mt-3 text-4xl sm:text-5xl font-extrabold tracking-tight text-navy-900 dark:text-white">A dealership built around the driver, not the deal</h1>
    <p class="mt-5 text-lg text-navy-600 dark:text-slate-400 leading-relaxed">
      For over thirteen years, Emmmar Motors has helped drivers across the region find vehicles they trust, at prices they can plan around.
    </p>
  </div>
</section>
 
<section class="py-16 px-5 sm:px-8">
  <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-16 items-center">
    <div class="relative">
      <div class="rounded-3xl overflow-hidden shadow-soft-lg">
        <img src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?auto=format&fit=crop&w=1100&q=80" alt="Emmmar Motors showroom" class="w-full h-[420px] object-cover" />
      </div>
      <div class="absolute -bottom-6 -right-6 hidden sm:block bg-brand-600 text-white rounded-2xl px-6 py-5 shadow-soft-lg">
        <p class="text-3xl font-extrabold">13+</p>
        <p class="text-xs text-brand-100 mt-1">Years in the industry</p>
      </div>
    </div>
    <div>
      <span class="text-xs font-semibold tracking-widest uppercase text-brand-600 dark:text-brand-400">Our Story</span>
      <h2 class="mt-3 text-3xl sm:text-4xl font-extrabold tracking-tight text-navy-900 dark:text-white">Started with one honest sale</h2>
      <p class="mt-5 text-navy-600 dark:text-slate-400 leading-relaxed">
        Emmmar Motors opened its first lot in 2013 with a single promise: no inflated prices, no surprise fees, and no vehicle sold without a full inspection report. That promise scaled with us — from a three-person team to a full dealership network handling sales, importation, financing, and inspection under one roof.
      </p>
      <p class="mt-4 text-navy-600 dark:text-slate-400 leading-relaxed">
        We measure success in repeat customers and referrals, not just units moved. That's why our advisors are salaried, not commission-driven — their only job is to help you make the right call.
      </p>
    </div>
  </div>
</section>
 
<section class="py-16 px-5 sm:px-8 bg-navy-50/50 dark:bg-white/[0.02]">
  <div class="max-w-7xl mx-auto grid sm:grid-cols-2 gap-6">
    <div class="p-8 rounded-3xl bg-white dark:bg-navy-900 shadow-soft border border-navy-900/5 dark:border-white/5">
      <span class="w-12 h-12 rounded-2xl bg-brand-600/10 text-brand-600 dark:text-brand-400 flex items-center justify-center"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l8 4v6c0 5-3.4 8.4-8 10-4.6-1.6-8-5-8-10V6z"/></svg></span>
      <p class="mt-4 text-xl font-bold text-navy-900 dark:text-white">Our Mission</p>
      <p class="mt-2 text-sm text-navy-500 dark:text-slate-400 leading-relaxed">Make vehicle ownership simple, fair, and accessible for every driver — through honest pricing, verified quality, and financing that respects your budget.</p>
    </div>
    <div class="p-8 rounded-3xl bg-white dark:bg-navy-900 shadow-soft border border-navy-900/5 dark:border-white/5">
      <span class="w-12 h-12 rounded-2xl bg-brand-600/10 text-brand-600 dark:text-brand-400 flex items-center justify-center"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg></span>
      <p class="mt-4 text-xl font-bold text-navy-900 dark:text-white">Our Values</p>
      <p class="mt-2 text-sm text-navy-500 dark:text-slate-400 leading-relaxed">Honesty over hype, craftsmanship in every inspection, and long-term relationships over one-time sales.</p>
    </div>
  </div>
</section>
 
<section class="py-24 px-5 sm:px-8">
  <div class="max-w-7xl mx-auto">
    <div class="text-center max-w-2xl mx-auto mb-14">
      <span class="text-xs font-semibold tracking-widest uppercase text-brand-600 dark:text-brand-400">Our Team</span>
      <h2 class="mt-3 text-3xl sm:text-4xl font-extrabold tracking-tight text-navy-900 dark:text-white">The people behind every sale</h2>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <div class="card-hover rounded-3xl overflow-hidden bg-white dark:bg-navy-900 shadow-soft border border-navy-900/5 dark:border-white/5">
        <img src="https://images.unsplash.com/photo-1607990281513-2c110a25bd8c?auto=format&fit=crop&w=400&q=80" alt="Team member" class="w-full h-48 object-cover" />
        <div class="p-4">
          <p class="font-bold text-navy-900 dark:text-white text-sm">David Okafor</p>
          <p class="text-xs text-brand-600 dark:text-brand-400 mt-0.5">Founder &amp; CEO</p>
        </div>
      </div>
      <div class="card-hover rounded-3xl overflow-hidden bg-white dark:bg-navy-900 shadow-soft border border-navy-900/5 dark:border-white/5">
        <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&w=400&q=80" alt="Team member" class="w-full h-48 object-cover" />
        <div class="p-4">
          <p class="font-bold text-navy-900 dark:text-white text-sm">Amara Bello</p>
          <p class="text-xs text-brand-600 dark:text-brand-400 mt-0.5">Head of Financing</p>
        </div>
      </div>
      <div class="card-hover rounded-3xl overflow-hidden bg-white dark:bg-navy-900 shadow-soft border border-navy-900/5 dark:border-white/5">
        <img src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?auto=format&fit=crop&w=400&q=80" alt="Team member" class="w-full h-48 object-cover" />
        <div class="p-4">
          <p class="font-bold text-navy-900 dark:text-white text-sm">Chinedu Eze</p>
          <p class="text-xs text-brand-600 dark:text-brand-400 mt-0.5">Lead Vehicle Inspector</p>
        </div>
      </div>
      <div class="card-hover rounded-3xl overflow-hidden bg-white dark:bg-navy-900 shadow-soft border border-navy-900/5 dark:border-white/5">
        <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&w=400&q=80" alt="Team member" class="w-full h-48 object-cover" />
        <div class="p-4">
          <p class="font-bold text-navy-900 dark:text-white text-sm">Ngozi Adeyemi</p>
          <p class="text-xs text-brand-600 dark:text-brand-400 mt-0.5">Customer Success Lead</p>
        </div>
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
    <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-navy-900 dark:text-white">Ready to meet the team in person?</h2>
    <p class="mt-4 text-navy-600 dark:text-slate-400 max-w-xl mx-auto">Visit our showroom or book a call with an advisor — we're happy to answer every question.</p>
    <div class="mt-8 flex flex-wrap justify-center gap-4">
      <a href="contact.html" class="inline-flex items-center gap-2 bg-brand-600 hover:bg-brand-700 text-white font-semibold px-7 py-3.5 rounded-xl shadow-glow transition-all hover:-translate-y-0.5">Contact Us</a>
      <a href="vehicles.html" class="inline-flex items-center gap-2 bg-navy-50 dark:bg-white/5 text-navy-900 dark:text-white font-semibold px-7 py-3.5 rounded-xl border border-navy-900/10 dark:border-white/10 hover:-translate-y-0.5 transition-all">Browse Inventory</a>
    </div>
  </div>
</section>

  
      <?php include "includes/footer.php" ?>