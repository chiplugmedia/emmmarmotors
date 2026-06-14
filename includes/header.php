<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- PRIMARY SEO -->
    <title>Emmmar Motors | Transportation, Logistics & Investment Opportunities</title>

    <meta name="description" content="Emmmar Motors is a trusted transportation and logistics company specializing in vehicle acquisition, import and export operations, and profitable business partnerships. We provide reliable investment opportunities with transparency, trust, and sustainable growth.">

    <meta name="keywords" content="Emmmar Motors, transportation company Nigeria, logistics company, vehicle import export, car acquisition services, investment opportunities Nigeria, business partnership logistics, freight services, transport business Africa">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="robots" content="index, follow">
    <meta name="author" content="Emmmar Motors">

    <!-- CANONICAL -->
    <link rel="canonical" href="https://emmmarnet.com/">

    <!-- THEME -->
    <meta name="theme-color" content="#0f172a">

    <!-- OPEN GRAPH (FACEBOOK / WHATSAPP) -->
    <meta property="og:title" content="Emmmar Motors | Trusted Logistics & Investment Partner">
    <meta property="og:description" content="We provide transportation, logistics, import/export services, and secure business partnerships built on trust and transparency.">
    <meta property="og:image" content="https://emmmarnet.com/assets/og-image.jpg">
    <meta property="og:url" content="https://emmmarnet.com/">
    <meta property="og:type" content="website">

    <!-- TWITTER CARD -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Emmmar Motors | Logistics & Transport Solutions">
    <meta name="twitter:description" content="Reliable transportation, import/export services, and business investment opportunities with Emmmar Motors.">
    <meta name="twitter:image" content="https://emmmarnet.com/assets/og-image.jpg">

    <!-- FAVICON -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Outfit:wght@300;400;500&display=swap" rel="stylesheet"/>

    <!-- STYLES -->
    <link rel="stylesheet" href="/emmmarmotors/mysite/sweet/styles.css">
    <link rel="stylesheet" href="/emmmarmotors/mysite/sweet/sweet.css">

    <!-- STRUCTURED DATA (SEO BOOST) -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "Emmmar Motors",
      "url": "https://emmmarnet.com",
      "logo": "https://emmmarnet.com/assets/logo.png",
      "description": "Emmmar Motors is a transportation and logistics company specializing in vehicle acquisition, import/export operations, and business partnerships.",
      "sameAs": []
    }
    </script>

</head>
<body>
<!-- ───────────────────────────────── ORBS ─── -->
<div class="orbs" aria-hidden="true">
  <div class="orb orb-1"></div>
  <div class="orb orb-2"></div>
  <div class="orb orb-3"></div>
</div>

<!-- ───────────────────────────────── NAV ─── -->
<header class="navbar" id="navbar">
  <div class="nav-inner">

    <!-- Logo -->
    <div class="logo-link">
      <a href="/" class="logo-dark">
        <img src="/creatorix/img/Creator_IX_Light.png" width="150" alt="Emmmar Motors Logo Dark">
      </a>
      <a href="/" class="logo-light">
        <img src="/creatorix/img/Creator_IX_i_Dark.png" width="150" alt="Emmmar Motors Logo Light">
      </a>
    </div>

    <!-- Desktop nav -->
    <nav class="nav-links" id="desktopNav">
      <a href="/" class="nav-link">Home</a>
      <a href="/how_it_works.php" class="nav-link">About Us</a>

      <!-- Features dropdown -->
      <div class="dropdown" id="dd-features">
        <button class="dd-btn" type="button" onclick="toggleDD('dd-features')">
          Creator Pass
          <svg class="dd-arrow" viewBox="0 0 24 24">
            <polyline points="6 9 12 15 18 9"/>
          </svg>
        </button>

        <div class="dd-menu">
          <!--<a href="/activation-code.php" class="dd-item" onclick="closeAllDD()">Get Creator Pass</a>-->
          <a href="/coupon-checker.php" class="dd-item" onclick="closeAllDD()">Creator Pass Checker</a>
        </div>
      </div>

      <!--<a href="/leader.php" class="nav-link">Leaderboard</a>-->
      <!--<a href="/weekly.php" class="nav-link">Weekly Leaderboard</a>-->
      <a href="/contact.php" class="nav-link">Contact</a>
    </nav>

    <!-- Right controls -->
    <div class="nav-right">

      <!-- Theme toggle -->
      <div class="toggle-wrap" onclick="toggleTheme()" title="Toggle dark / light mode">
        <div class="toggle-track">
          <div class="toggle-knob"></div>
        </div>
      </div>

      <!-- Buttons -->
      <a href="/login.php" class="btn-ghost">Login</a>
      <a href="/register.php" class="btn-nav">Get Started ↗</a>

      <!-- Hamburger -->
      <button class="ham-btn" id="hamBtn" onclick="toggleDrawer()" aria-label="Open menu">
        <span class="ham-bar"></span>
        <span class="ham-bar"></span>
        <span class="ham-bar"></span>
      </button>

    </div>
  </div>
</header>

<!-- ─── MOBILE DRAWER ─── -->
<div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawer()"></div>

<div class="drawer" id="drawer">
  <div class="drawer-head">

    <!-- Logo -->
    <a class="logo-light" href="/">
      <img src="/creatorix/img/Creator_IX_i_Dark.png" width="150" alt="Creatorix Logo Dark">
    </a>
    <a class="logo-dark" href="/">
      <img src="/creatorix/img/Creator_IX_Light.png" width="150" alt="Creatorix Logo Light">
    </a>

    <button class="drawer-close" onclick="closeDrawer()">✕</button>
  </div>

  <!-- Links -->
  <a href="/" class="mob-plain-link" onclick="closeDrawer()">Home</a>
  <a href="/how_it_works.php" class="mob-plain-link" onclick="closeDrawer()">About Us</a>

  <!-- Accordion -->
  <div class="mob-acc" id="mob-features">
    <button class="mob-acc-btn" type="button" onclick="toggleAcc('mob-features')">
      Creator Pass
      <svg class="mob-acc-arrow" viewBox="0 0 24 24">
        <polyline points="6 9 12 15 18 9"/>
      </svg>
    </button>

    <div class="mob-acc-body">
      <div class="mob-acc-inner">
        <!--<a href="/activation-code.php" class="mob-link" onclick="closeDrawer()">Get Creator Pass</a>-->
        <a href="/coupon-checker.php" class="mob-link" onclick="closeDrawer()">Creator Pass Checker</a>
      </div>
    </div>
  </div>

  <!--<a href="/leader.php" class="mob-plain-link" onclick="closeDrawer()">Leaderboard</a>-->
  <!--<a href="/weekly.php" class="mob-plain-link" onclick="closeDrawer()">Weekly Leaderboard</a>-->
  <a href="/contact.php" class="mob-plain-link" onclick="closeDrawer()">Contact</a>

  <!-- Footer buttons -->
  <div class="drawer-footer">
    <a href="/login.php" class="btn-ghost" onclick="closeDrawer()" style="width:100%;justify-content:center;margin-bottom:10px;">Login</a>
    <a href="/register.php" class="btn-primary" onclick="closeDrawer()" style="width:100%;justify-content:center;">Get Started ↗</a>
  </div>
</div>