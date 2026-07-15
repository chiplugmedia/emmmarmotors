<?php
$brandName = 'Invest';
$logoUrl = '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo htmlspecialchars($brandName); ?> | Smarter Growth Starts Here</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
/* ─── TOKENS ──────────────────────────────────────────────── */
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
:root{
  --blue:    #042FCC;
  --blue2:   #0A3DFF;
  --blue3:   #2D59FF;
  --blue-lt: #E8EEFF;
  --blue-xt: #F3F5FF;
  --navy:    #021280;
  --white:   #FFFFFF;
  --offwhite:#F7F9FF;
  --text:    #0A1240;
  --muted:   #5A6A90;
  --line:    rgba(4,47,204,.12);
  --shadow:  0 20px 60px rgba(4,47,204,.13);
  --r:       18px;
  --ease:    cubic-bezier(0.22,1,0.36,1);
}

html{scroll-behavior:smooth;}

body{
  font-family:'Outfit',sans-serif;
  background:var(--white);
  color:var(--text);
  line-height:1.65;
  overflow-x:hidden;
  cursor:none;
}

a{color:inherit;text-decoration:none;}
img{display:block;max-width:100%;}

/* ─── CUSTOM CURSOR ───────────────────────────────────────── */
#cursor-dot,#cursor-ring{position:fixed;pointer-events:none;z-index:9999;border-radius:50%;transform:translate(-50%,-50%);}
#cursor-dot{width:7px;height:7px;background:var(--blue2);transition:opacity .2s;}
#cursor-ring{width:36px;height:36px;border:2px solid rgba(4,47,204,.4);transition:transform .12s var(--ease),opacity .3s;}

/* ─── GRID LINES BG ───────────────────────────────────────── */
.grid-bg{
  position:fixed;inset:0;z-index:0;pointer-events:none;
  background-image:
    linear-gradient(rgba(4,47,204,.04) 1px,transparent 1px),
    linear-gradient(90deg,rgba(4,47,204,.04) 1px,transparent 1px);
  background-size:64px 64px;
}

/* ─── LAYOUT ─────────────────────────────────────────────── */
.wrap{width:min(1160px,calc(100% - 48px));margin:0 auto;position:relative;z-index:1;}

/* ─── NAV ────────────────────────────────────────────────── */
nav.site-nav{
  position:fixed;top:0;left:0;right:0;z-index:100;
  padding:18px 0;
  transition:background .4s,backdrop-filter .4s,box-shadow .4s;
}
nav.site-nav.scrolled{
  background:rgba(255,255,255,.92);
  backdrop-filter:blur(20px);
  box-shadow:0 1px 0 var(--line),0 4px 20px rgba(4,47,204,.07);
}
.nav-inner{display:flex;align-items:center;justify-content:space-between;gap:24px;}

.logo-mark{
  display:flex;align-items:center;gap:10px;
  font-family:'Bebas Neue',sans-serif;
  font-size:1.85rem;letter-spacing:.07em;color:var(--blue);
}
.logo-diamond{
  width:26px;height:26px;background:var(--blue2);transform:rotate(45deg);
  box-shadow:0 0 16px rgba(4,47,204,.45);flex-shrink:0;
}

.nav-links-desktop{
  display:flex;align-items:center;gap:4px;
  padding:6px;border:1px solid var(--line);border-radius:999px;
  background:rgba(255,255,255,.8);backdrop-filter:blur(12px);
  box-shadow:0 4px 16px rgba(4,47,204,.08);
}
.nav-links-desktop a{
  padding:7px 17px;border-radius:999px;
  color:var(--muted);font-weight:700;font-size:.93rem;
  transition:color .22s,background .22s;
}
.nav-links-desktop a:hover{color:var(--blue);background:var(--blue-lt);}

.nav-cta{
  display:inline-flex;align-items:center;justify-content:center;
  padding:10px 24px;border-radius:999px;
  background:var(--blue);color:#fff;
  font-weight:800;font-size:.95rem;
  box-shadow:0 8px 28px rgba(4,47,204,.32);
  transition:transform .22s var(--ease),box-shadow .22s,filter .22s;
}
.nav-cta:hover{transform:translateY(-2px);box-shadow:0 14px 36px rgba(4,47,204,.42);filter:brightness(1.1);}

/* hamburger */
.ham{
  display:none;flex-direction:column;gap:5px;cursor:pointer;
  background:#fff;border:1px solid var(--line);border-radius:10px;padding:10px 12px;
  box-shadow:0 2px 8px rgba(4,47,204,.08);
}
.ham span{width:22px;height:2px;border-radius:2px;background:var(--blue);transition:transform .3s,opacity .3s;}
.ham.open span:nth-child(1){transform:translateY(7px) rotate(45deg);}
.ham.open span:nth-child(2){opacity:0;}
.ham.open span:nth-child(3){transform:translateY(-7px) rotate(-45deg);}

.mobile-menu{
  display:none;position:absolute;top:calc(100% + 10px);left:16px;right:16px;
  background:rgba(255,255,255,.98);border:1px solid var(--line);border-radius:16px;
  backdrop-filter:blur(24px);padding:10px;
  box-shadow:0 20px 60px rgba(4,47,204,.15);
  max-height:0;opacity:0;transition:max-height .4s var(--ease),opacity .3s;
}
.mobile-menu.open{display:grid;max-height:420px;opacity:1;}
.mobile-menu a{
  display:flex;align-items:center;min-height:50px;padding:0 18px;
  border-radius:10px;color:var(--text);font-weight:700;
  transition:background .2s,color .2s;
}
.mobile-menu a:hover{background:var(--blue-lt);color:var(--blue);}
.mobile-menu .m-cta{
  justify-content:center;background:var(--blue);color:#fff;
  font-weight:800;margin-top:6px;border-radius:10px;
}

/* ─── HERO ───────────────────────────────────────────────── */
.hero{
  min-height:100svh;display:grid;
  grid-template-columns:1fr 1fr;
  align-items:center;gap:60px;
  padding:130px 0 90px;
  position:relative;
}
/* blue blob bg */
.hero::before{
  content:'';position:absolute;
  top:-120px;right:-160px;width:720px;height:720px;
  border-radius:50%;
  background:radial-gradient(circle,rgba(4,47,204,.1) 0%,transparent 70%);
  pointer-events:none;z-index:0;
}
.hero::after{
  content:'';position:absolute;
  bottom:-80px;left:-100px;width:500px;height:500px;
  border-radius:50%;
  background:radial-gradient(circle,rgba(10,61,255,.07) 0%,transparent 70%);
  pointer-events:none;z-index:0;
}
.hero>*{position:relative;z-index:1;}

.hero-badge{
  display:inline-flex;align-items:center;gap:8px;
  padding:8px 16px;border:1px solid rgba(4,47,204,.2);border-radius:999px;
  background:var(--blue-lt);color:var(--blue);
  font-size:.8rem;font-weight:800;letter-spacing:.07em;text-transform:uppercase;
  margin-bottom:24px;
}
.badge-dot{width:7px;height:7px;border-radius:50%;background:var(--blue2);animation:pulse 2s infinite;}
@keyframes pulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.4;transform:scale(.7)}}

h1.hero-h1{
  font-family:'Bebas Neue',sans-serif;
  font-size:clamp(4rem,9vw,8.5rem);
  line-height:.92;letter-spacing:.01em;
  color:var(--text);
}
.h1-line{display:block;overflow:hidden;}
.h1-inner{
  display:block;
  transform:translateY(110%);
  animation:lineUp .8s var(--ease) forwards;
}
.h1-inner.d1{animation-delay:.1s;}
.h1-inner.d2{animation-delay:.22s;}
.h1-inner.d3{animation-delay:.34s;}
.h1-accent{color:var(--blue2);}
@keyframes lineUp{to{transform:translateY(0);}}

.hero-sub{
  max-width:500px;color:var(--muted);font-size:1.08rem;
  margin:26px 0 40px;
  opacity:0;transform:translateY(20px);
  animation:fadeUp .7s .6s var(--ease) forwards;
}
.hero-actions{
  display:flex;flex-wrap:wrap;align-items:center;gap:16px;
  opacity:0;transform:translateY(20px);
  animation:fadeUp .7s .75s var(--ease) forwards;
}
@keyframes fadeUp{to{opacity:1;transform:translateY(0);}}

.btn-primary{
  display:inline-flex;align-items:center;gap:10px;
  padding:14px 30px;border-radius:999px;
  background:var(--blue);color:#fff;
  font-weight:800;font-size:1rem;
  box-shadow:0 12px 36px rgba(4,47,204,.35);
  transition:transform .2s var(--ease),box-shadow .2s,filter .2s;
}
.btn-primary:hover{transform:translateY(-3px);box-shadow:0 20px 44px rgba(4,47,204,.45);filter:brightness(1.1);}
.btn-primary svg{width:18px;height:18px;transition:transform .2s;}
.btn-primary:hover svg{transform:translateX(4px);}

.btn-ghost{
  display:inline-flex;align-items:center;gap:8px;padding:14px 24px;
  border-radius:999px;border:1.5px solid var(--line);
  color:var(--muted);font-weight:700;
  background:#fff;
  box-shadow:0 2px 10px rgba(4,47,204,.06);
  transition:color .2s,border-color .2s,background .2s,transform .2s;
}
.btn-ghost:hover{color:var(--blue);border-color:rgba(4,47,204,.3);background:var(--blue-lt);transform:translateY(-2px);}

/* ── Dashboard widget ── */
.hero-visual{
  position:relative;
  opacity:0;transform:translateX(40px) scale(.96);
  animation:heroIn .9s .4s var(--ease) forwards;
}
@keyframes heroIn{to{opacity:1;transform:translateX(0) scale(1);}}

.dashboard-frame{
  border-radius:22px;overflow:hidden;
  border:1px solid var(--line);
  background:#fff;
  box-shadow:0 40px 100px rgba(4,47,204,.18),0 0 0 1px rgba(4,47,204,.06);
}
.dash-bar{
  display:flex;align-items:center;gap:8px;
  padding:13px 18px;background:var(--blue-xt);
  border-bottom:1px solid var(--line);
}
.dash-dot{width:10px;height:10px;border-radius:50%;}
.dash-dot.r{background:#FF5F57;}.dash-dot.y{background:#FFBD2E;}.dash-dot.g{background:#28CA41;}
.dash-url{flex:1;text-align:center;font-size:.78rem;color:var(--muted);font-family:monospace;}
.dash-body{padding:22px;}
.dash-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;margin-bottom:18px;}
.stat-card{
  padding:14px;border-radius:12px;
  background:var(--blue-xt);
  border:1px solid var(--line);
}
.stat-label{font-size:.7rem;color:var(--muted);font-weight:700;text-transform:uppercase;letter-spacing:.06em;}
.stat-val{font-family:'Bebas Neue',sans-serif;font-size:1.9rem;color:var(--blue);margin-top:3px;}
.stat-up{font-size:.76rem;color:#16A34A;font-weight:700;}

.chart-area{border-radius:12px;overflow:hidden;background:var(--blue-xt);border:1px solid var(--line);padding:16px;}
.chart-label{font-size:.76rem;color:var(--muted);margin-bottom:10px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;}
.chart-line{stroke-dasharray:600;stroke-dashoffset:600;animation:drawLine 2s 1.2s var(--ease) forwards;}
@keyframes drawLine{to{stroke-dashoffset:0;}}
.chart-fill{opacity:0;animation:fadeIn .5s 2.8s forwards;}
@keyframes fadeIn{to{opacity:1;}}

/* floating cards */
.float-card{
  position:absolute;padding:13px 17px;border-radius:14px;
  background:#fff;border:1px solid var(--line);
  box-shadow:0 16px 44px rgba(4,47,204,.16);
  backdrop-filter:blur(12px);white-space:nowrap;
}
.fc-top{top:-28px;right:20px;animation:floatA 4s ease-in-out infinite;}
.fc-bot{bottom:-28px;left:20px;animation:floatB 4.5s ease-in-out infinite;}
@keyframes floatA{0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)}}
@keyframes floatB{0%,100%{transform:translateY(0)}50%{transform:translateY(8px)}}
.fc-label{font-size:.7rem;color:var(--muted);font-weight:700;text-transform:uppercase;letter-spacing:.05em;}
.fc-val{font-family:'Bebas Neue',sans-serif;font-size:1.5rem;color:var(--blue);letter-spacing:.04em;}

/* ── Stats row ── */
.stats-row{
  display:flex;flex-wrap:wrap;gap:0;
  border:1px solid var(--line);border-radius:var(--r);overflow:hidden;
  background:#fff;box-shadow:var(--shadow);
  margin-top:64px;
}
.stat-item{
  flex:1;min-width:160px;padding:28px 32px;
  border-right:1px solid var(--line);
  position:relative;overflow:hidden;
  transition:background .3s;
}
.stat-item:last-child{border-right:0;}
.stat-item::before{
  content:'';position:absolute;inset:0;
  background:linear-gradient(135deg,var(--blue-lt) 0%,transparent 60%);
  opacity:0;transition:opacity .3s;
}
.stat-item:hover::before{opacity:1;}
.stat-number{font-family:'Bebas Neue',sans-serif;font-size:2.8rem;color:var(--blue);display:block;}
.stat-desc{color:var(--muted);font-size:.88rem;font-weight:600;margin-top:2px;}

/* ─── COMMON SECTION ─────────────────────────────────────── */
section{position:relative;z-index:1;}

.section-tag{
  display:inline-flex;align-items:center;gap:6px;
  padding:6px 14px;border-radius:999px;
  border:1px solid rgba(4,47,204,.18);background:var(--blue-lt);
  color:var(--blue);font-size:.78rem;font-weight:800;
  letter-spacing:.08em;text-transform:uppercase;margin-bottom:18px;
}
.section-tag::before{content:'';width:6px;height:6px;border-radius:50%;background:var(--blue2);}

.section-h2{
  font-family:'Bebas Neue',sans-serif;
  font-size:clamp(2.8rem,5vw,5rem);
  line-height:.96;letter-spacing:.02em;color:var(--text);
  margin-bottom:16px;
}
.section-h2 .accent{color:var(--blue2);}
.section-body{color:var(--muted);font-size:1.05rem;max-width:560px;}

.divider{height:1px;background:linear-gradient(90deg,transparent,var(--line) 30%,var(--line) 70%,transparent);}

/* ─── WHO WE ARE ─────────────────────────────────────────── */
.who-section{padding:100px 0;background:var(--offwhite);}
.who-grid{display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:center;}

.who-copy{color:var(--muted);font-size:1.06rem;}
.who-copy p+p{margin-top:20px;}
.who-quote{
  margin-top:32px;padding:22px 26px;
  border-left:4px solid var(--blue2);border-radius:0 14px 14px 0;
  background:var(--blue-lt);
  color:var(--blue);font-size:1.1rem;font-weight:800;line-height:1.45;
  font-style:italic;
}

.who-card-stack{position:relative;height:360px;}
.wc{position:absolute;border-radius:16px;overflow:hidden;border:1px solid var(--line);}
.wc-main{inset:0 40px 0 0;background:#fff;box-shadow:0 24px 60px rgba(4,47,204,.14);}
.wc-accent{
  top:20px;right:0;width:160px;height:220px;
  background:linear-gradient(135deg,var(--blue2),var(--navy));
  display:flex;align-items:center;justify-content:center;
  font-family:'Bebas Neue',sans-serif;font-size:4rem;color:rgba(255,255,255,.12);
  animation:floatA 5s ease-in-out infinite;
}
.wc-main-inner{padding:24px;}
.wc-row{display:flex;align-items:center;gap:12px;margin-bottom:16px;}
.wc-avatar{
  width:38px;height:38px;border-radius:50%;
  background:linear-gradient(135deg,var(--blue2),var(--blue));
  display:flex;align-items:center;justify-content:center;
  font-weight:800;font-size:.85rem;color:#fff;flex-shrink:0;
}
.wc-info strong{display:block;font-size:.92rem;color:var(--text);}
.wc-info span{color:var(--muted);font-size:.78rem;}
.wc-bar-label{font-size:.74rem;color:var(--muted);margin-bottom:6px;font-weight:700;}
.wc-bar{height:8px;border-radius:999px;background:var(--blue-lt);overflow:hidden;margin-bottom:12px;}
.wc-fill{height:100%;border-radius:999px;background:linear-gradient(90deg,var(--blue2),var(--blue3));transition:width 1.5s var(--ease);}

/* ─── FEATURES ───────────────────────────────────────────── */
.features-section{padding:100px 0;background:#fff;}
.features-header{display:grid;grid-template-columns:1fr 1fr;gap:60px;align-items:end;margin-bottom:56px;}
.feature-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}

.f-card{
  padding:32px 28px;border-radius:22px;
  border:1px solid var(--line);background:var(--offwhite);
  position:relative;overflow:hidden;
  transition:transform .3s var(--ease),border-color .3s,box-shadow .3s,background .3s;
}
.f-card::before{
  content:'';position:absolute;inset:0;
  background:radial-gradient(circle at 0% 0%,rgba(4,47,204,.09) 0%,transparent 60%);
  opacity:0;transition:opacity .4s;
}
.f-card:hover{transform:translateY(-8px);border-color:rgba(4,47,204,.28);box-shadow:0 28px 70px rgba(4,47,204,.14);background:#fff;}
.f-card:hover::before{opacity:1;}
.f-num{font-family:'Bebas Neue',sans-serif;font-size:5rem;color:rgba(4,47,204,.1);line-height:1;margin-bottom:-10px;transition:color .3s;}
.f-card:hover .f-num{color:rgba(4,47,204,.18);}
.f-icon{display:inline-flex;align-items:center;justify-content:center;width:48px;height:48px;border-radius:12px;background:var(--blue-lt);font-size:1.4rem;margin-bottom:8px;}
.f-card h3{font-size:1.22rem;font-weight:800;color:var(--text);margin:14px 0 10px;}
.f-card p{color:var(--muted);font-size:.95rem;}

/* ─── SPLIT SECTIONS ─────────────────────────────────────── */
.split-section{padding:100px 0;background:var(--offwhite);}
.split-section.white{background:#fff;}
.split-grid{display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:center;}
.split-grid.rev{direction:rtl;}
.split-grid.rev>*{direction:ltr;}

.split-list{display:grid;gap:14px;margin:28px 0;}
.split-list li{
  display:flex;align-items:flex-start;gap:14px;
  padding:16px 18px;border-radius:12px;
  border:1px solid var(--line);background:#fff;
  transition:border-color .25s,background .25s,transform .2s;
  list-style:none;
}
.split-list li:hover{border-color:rgba(4,47,204,.25);background:var(--blue-lt);transform:translateX(4px);}
.li-bullet{
  width:24px;height:24px;border-radius:6px;flex-shrink:0;
  background:var(--blue);display:flex;align-items:center;justify-content:center;
  margin-top:2px;
}
.li-bullet svg{width:12px;height:12px;}
.li-text strong{display:block;font-size:.95rem;color:var(--text);font-weight:700;}
.li-text span{font-size:.87rem;color:var(--muted);}

.split-media{
  border-radius:22px;overflow:hidden;
  border:1px solid var(--line);background:#fff;
  box-shadow:0 32px 80px rgba(4,47,204,.13);
}
.split-media-inner{padding:30px;}
.media-badge{
  display:inline-flex;align-items:center;gap:8px;padding:7px 13px;
  border-radius:999px;background:var(--blue-lt);border:1px solid rgba(4,47,204,.18);
  color:var(--blue);font-size:.79rem;font-weight:800;margin-bottom:20px;
}
.ring-chart-wrap{display:flex;align-items:center;justify-content:center;gap:28px;margin:18px 0;}
.ring-legend{display:grid;gap:10px;}
.rl-item{display:flex;align-items:center;gap:8px;font-size:.85rem;color:var(--text);font-weight:600;}
.rl-dot{width:10px;height:10px;border-radius:50%;flex-shrink:0;}

/* blue split panel */
.blue-panel{
  border-radius:22px;overflow:hidden;padding:40px;
  background:linear-gradient(135deg,var(--blue) 0%,var(--navy) 100%);
  border:none;box-shadow:0 32px 80px rgba(4,47,204,.3);
}
.blue-panel .section-h2{color:#fff;}
.blue-panel .section-body{color:rgba(255,255,255,.7);}
.blue-panel .section-tag{background:rgba(255,255,255,.15);border-color:rgba(255,255,255,.25);color:#fff;}
.blue-panel .section-tag::before{background:#fff;}
.blue-panel .split-list li{background:rgba(255,255,255,.08);border-color:rgba(255,255,255,.12);}
.blue-panel .split-list li:hover{background:rgba(255,255,255,.15);border-color:rgba(255,255,255,.25);}
.blue-panel .li-bullet{background:#fff;}
.blue-panel .li-bullet svg path{stroke:var(--blue);}
.blue-panel .li-text strong{color:#fff;}
.blue-panel .li-text span{color:rgba(255,255,255,.65);}
.blue-panel .btn-primary{background:#fff;color:var(--blue);box-shadow:0 12px 30px rgba(0,0,0,.18);}
.blue-panel .btn-primary:hover{filter:brightness(.96);}

/* ─── TESTIMONIALS ───────────────────────────────────────── */
.testi-section{padding:100px 0;background:#fff;}
.testi-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:20px;margin-top:48px;}
.t-card{
  padding:32px;border-radius:22px;
  border:1px solid var(--line);background:var(--offwhite);
  position:relative;overflow:hidden;
  transition:transform .3s var(--ease),box-shadow .3s,border-color .3s;
}
.t-card:hover{transform:translateY(-6px);box-shadow:0 28px 70px rgba(4,47,204,.12);border-color:rgba(4,47,204,.2);}
.t-quote-mark{
  font-family:'Bebas Neue',sans-serif;font-size:5rem;
  color:rgba(4,47,204,.1);line-height:1;
  position:absolute;top:16px;right:22px;
}
.t-stars{color:var(--blue2);font-size:.85rem;margin-bottom:14px;letter-spacing:.08em;}
.t-text{font-size:1.02rem;color:var(--muted);line-height:1.7;margin-bottom:24px;font-style:italic;}
.t-person{display:flex;align-items:center;gap:14px;}
.t-avatar{
  width:46px;height:46px;border-radius:50%;
  background:linear-gradient(135deg,var(--blue2),var(--blue3));
  display:flex;align-items:center;justify-content:center;
  font-weight:800;font-size:.9rem;color:#fff;flex-shrink:0;
}
.t-person strong{display:block;font-size:.95rem;color:var(--text);}
.t-person span{color:var(--muted);font-size:.82rem;}

/* ─── FAQ ────────────────────────────────────────────────── */
.faq-section{padding:100px 0;background:var(--offwhite);}
.faq-layout{display:grid;grid-template-columns:2fr 3fr;gap:80px;align-items:start;}
.faq-list{display:grid;gap:12px;}

details.faq{
  border-radius:16px;border:1px solid var(--line);background:#fff;
  overflow:hidden;transition:border-color .3s,box-shadow .3s;
}
details.faq[open]{border-color:rgba(4,47,204,.3);box-shadow:0 16px 50px rgba(4,47,204,.1);}
details.faq summary{
  display:flex;align-items:center;justify-content:space-between;gap:16px;
  min-height:68px;padding:20px 24px;
  color:var(--text);font-weight:700;cursor:pointer;list-style:none;
}
details.faq summary::-webkit-details-marker{display:none;}
details.faq summary::after{
  content:'';width:28px;height:28px;flex-shrink:0;border-radius:50%;
  background:var(--blue-lt);border:1px solid rgba(4,47,204,.2);
  background-image:url("data:image/svg+xml,%3Csvg width='12' height='12' viewBox='0 0 12 12' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M6 2v8M2 6h8' stroke='%23042FCC' stroke-width='1.8' stroke-linecap='round'/%3E%3C/svg%3E");
  background-repeat:no-repeat;background-position:center;
  transition:background-color .2s,transform .3s;
}
details.faq[open] summary::after{
  background-color:var(--blue);border-color:var(--blue);
  background-image:url("data:image/svg+xml,%3Csvg width='12' height='12' viewBox='0 0 12 12' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M2 6h8' stroke='white' stroke-width='2' stroke-linecap='round'/%3E%3C/svg%3E");
  transform:rotate(180deg);
}
.faq-ans{padding:0 24px 22px;color:var(--muted);font-size:.97rem;}

/* ─── CTA ────────────────────────────────────────────────── */
.cta-section{padding:80px 0 120px;background:#fff;}
.cta-box{
  border-radius:28px;overflow:hidden;position:relative;
  background:linear-gradient(135deg,var(--blue) 0%,var(--navy) 100%);
  border:none;padding:90px 70px;text-align:center;
  box-shadow:0 40px 100px rgba(4,47,204,.35);
}
.cta-box::before{
  content:'';position:absolute;inset:0;
  background:radial-gradient(ellipse at 50% -10%,rgba(255,255,255,.15) 0%,transparent 55%);
}
.cta-box>*{position:relative;}
.cta-box .section-h2{color:#fff;font-size:clamp(3rem,6vw,6rem);margin-bottom:18px;}
.cta-box .section-h2 .accent{color:rgba(255,255,255,.7);}
.cta-box p{color:rgba(255,255,255,.72);font-size:1.1rem;max-width:560px;margin:0 auto 40px;}
.cta-actions{display:flex;justify-content:center;flex-wrap:wrap;gap:16px;}
.cta-box .btn-primary{background:#fff;color:var(--blue);box-shadow:0 12px 30px rgba(0,0,0,.2);}
.cta-box .btn-primary:hover{filter:brightness(.96);}
.cta-box .btn-ghost{border-color:rgba(255,255,255,.3);color:rgba(255,255,255,.8);background:rgba(255,255,255,.08);}
.cta-box .btn-ghost:hover{color:#fff;border-color:rgba(255,255,255,.6);background:rgba(255,255,255,.15);}
.cta-deco{
  position:absolute;
  font-family:'Bebas Neue',sans-serif;font-size:18rem;
  line-height:1;color:rgba(255,255,255,.04);
  user-select:none;pointer-events:none;top:50%;left:50%;
  transform:translate(-50%,-50%);white-space:nowrap;
}

/* ─── FOOTER ─────────────────────────────────────────────── */
footer{
  background:var(--text);
  border-top:1px solid rgba(255,255,255,.06);
  padding:80px 0 36px;
}
.footer-grid{
  display:grid;grid-template-columns:1.4fr 1fr 1fr 1fr;gap:40px;
  padding-bottom:48px;border-bottom:1px solid rgba(255,255,255,.08);
}
.footer-logo-mark{
  display:flex;align-items:center;gap:10px;
  font-family:'Bebas Neue',sans-serif;font-size:1.7rem;
  color:#fff;margin-bottom:18px;
}
.footer-logo-mark .logo-diamond{background:#fff;box-shadow:0 0 14px rgba(255,255,255,.3);}
.footer-about{color:rgba(255,255,255,.52);font-size:.9rem;max-width:280px;line-height:1.7;}
.footer-col h4{font-size:.76rem;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:rgba(255,255,255,.4);margin-bottom:18px;}
.footer-col ul{list-style:none;display:grid;gap:10px;}
.footer-col ul a{color:rgba(255,255,255,.6);font-size:.9rem;transition:color .2s,transform .2s;display:inline-block;}
.footer-col ul a:hover{color:#fff;transform:translateX(3px);}
.footer-contact-item{color:rgba(255,255,255,.6);font-size:.9rem;}
.footer-contact-item a{color:rgba(255,255,255,.6);transition:color .2s;}
.footer-contact-item a:hover{color:#fff;}
.footer-socials{display:flex;gap:12px;margin-top:14px;}
.footer-socials a{
  width:36px;height:36px;border-radius:50%;
  border:1px solid rgba(255,255,255,.12);display:flex;align-items:center;justify-content:center;
  color:rgba(255,255,255,.5);font-size:.82rem;font-weight:700;
  transition:border-color .2s,color .2s,background .2s;
}
.footer-socials a:hover{border-color:var(--blue2);color:#fff;background:var(--blue);}
.footer-bottom{
  display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:14px;
  padding-top:32px;color:rgba(255,255,255,.35);font-size:.85rem;
}
.footer-legal{display:flex;gap:20px;flex-wrap:wrap;}
.footer-legal a{color:rgba(255,255,255,.35);transition:color .2s;}
.footer-legal a:hover{color:#fff;}

/* ─── SCROLL REVEAL ──────────────────────────────────────── */
.reveal{
  opacity:0;transform:translateY(34px);
  transition:opacity .7s var(--ease),transform .7s var(--ease);
}
.reveal.visible{opacity:1;transform:translateY(0);}

/* ─── RESPONSIVE ─────────────────────────────────────────── */
@media(max-width:1024px){
  .hero{grid-template-columns:1fr;gap:50px;padding:120px 0 70px;}
  h1.hero-h1{font-size:clamp(3.4rem,10vw,6rem);}
  .hero-visual{max-width:600px;}
  .features-header{grid-template-columns:1fr;gap:24px;}
  .feature-grid{grid-template-columns:repeat(2,1fr);}
  .split-grid,.who-grid,.faq-layout{grid-template-columns:1fr;gap:48px;}
  .split-grid.rev{direction:ltr;}
  .split-grid.rev .split-media{order:-1;}
  .testi-grid{grid-template-columns:1fr;}
  .footer-grid{grid-template-columns:1fr 1fr;gap:36px;}
  .cta-box{padding:60px 40px;}
}
@media(max-width:768px){
  body{cursor:auto;}
  #cursor-dot,#cursor-ring{display:none;}
  .nav-links-desktop,.nav-cta{display:none;}
  .ham{display:flex;}
  .hero{padding:100px 0 60px;}
  h1.hero-h1{font-size:clamp(2.8rem,13vw,4.8rem);}
  .hero-sub{font-size:1rem;}
  .btn-primary,.btn-ghost{width:100%;justify-content:center;min-height:56px;}
  .hero-actions{flex-direction:column;}
  .stats-row{flex-direction:column;}
  .stat-item{border-right:0;border-bottom:1px solid var(--line);}
  .stat-item:last-child{border-bottom:0;}
  .feature-grid{grid-template-columns:1fr;}
  .section-h2{font-size:clamp(2.2rem,8vw,3.8rem);}
  .blue-panel{padding:28px;}
  .cta-box{padding:40px 24px;}
  .cta-deco{font-size:9rem;}
  .footer-grid{grid-template-columns:1fr;}
  .footer-bottom{flex-direction:column;align-items:flex-start;}
  .who-section,.features-section,.split-section,.testi-section,.faq-section{padding:70px 0;}
  .who-card-stack{height:260px;}
}
@media(max-width:420px){
  h1.hero-h1{font-size:clamp(2.4rem,14vw,3.8rem);}
  .f-card{padding:22px 18px;}
  .t-card{padding:22px;}
  .dash-stats{grid-template-columns:1fr 1fr;gap:8px;}
  .dash-stats .stat-card:last-child{grid-column:1/-1;}
  .wrap{width:calc(100% - 32px);}
}
@media(prefers-reduced-motion:reduce){
  *,*::before,*::after{animation-duration:.01ms!important;transition-duration:.01ms!important;}
}
</style>
</head>
<body>

<div id="cursor-dot"></div>
<div id="cursor-ring"></div>
<div class="grid-bg"></div>

<!-- ──────────── NAV ──────────── -->
<nav class="site-nav" id="siteNav">
  <div class="wrap nav-inner">
    <a href="#" class="logo-mark">
      <div class="logo-diamond"></div>
      <?php echo htmlspecialchars($brandName); ?>
    </a>

    <div class="nav-links-desktop">
      <a href="#features">Features</a>
      <a href="#testimonials">Stories</a>
      <a href="#who-we-are">Who We Are</a>
      <a href="#faqs">FAQs</a>
      <a href="#start">Start</a>
    </div>

    <a class="nav-cta" href="register.php">Get Started</a>

    <button class="ham" id="hamBtn" aria-label="Toggle menu" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>
  </div>

  <nav class="mobile-menu" id="mobileMenu">
    <a href="#features">Features</a>
    <a href="#testimonials">Stories</a>
    <a href="#who-we-are">Who We Are</a>
    <a href="#faqs">FAQs</a>
    <a href="#start">Start</a>
    <a href="register.php" class="m-cta">Get Started</a>
  </nav>
</nav>

<!-- ──────────── HERO ──────────── -->
<section class="wrap hero">
  <div class="hero-copy">
    <div class="hero-badge">
      <span class="badge-dot"></span>
      Modern Wealth Tools for Ambitious People
    </div>
    <h1 class="hero-h1">
      <span class="h1-line"><span class="h1-inner d1">Grow</span></span>
      <span class="h1-line"><span class="h1-inner d2">With <span class="h1-accent">Clarity.</span></span></span>
      <span class="h1-line"><span class="h1-inner d3">Own Your Move.</span></span>
    </h1>
    <p class="hero-sub">
      <?php echo htmlspecialchars($brandName); ?> helps you organize goals, monitor opportunities,
      and make smarter financial moves from one calm, intuitive dashboard.
    </p>
    <div class="hero-actions">
      <a class="btn-primary" href="register.php">
        Start Growing
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
      <a class="btn-ghost" href="#features">See How It Works</a>
    </div>
  </div>

  <div class="hero-visual">
    <div class="float-card fc-top">
      <div class="fc-label">Portfolio Growth</div>
      <div class="fc-val">+24.6%</div>
    </div>

    <div class="dashboard-frame">
      <div class="dash-bar">
        <div class="dash-dot r"></div>
        <div class="dash-dot y"></div>
        <div class="dash-dot g"></div>
        <div class="dash-url">invest.dashboard.app</div>
      </div>
      <div class="dash-body">
        <div class="dash-stats">
          <div class="stat-card">
            <div class="stat-label">Balance</div>
            <div class="stat-val">$84K</div>
            <div class="stat-up">↑ 8.2%</div>
          </div>
          <div class="stat-card">
            <div class="stat-label">Returns</div>
            <div class="stat-val">$12K</div>
            <div class="stat-up">↑ 4.5%</div>
          </div>
          <div class="stat-card">
            <div class="stat-label">Goals</div>
            <div class="stat-val">5</div>
            <div class="stat-up">3 Active</div>
          </div>
        </div>
        <div class="chart-area">
          <div class="chart-label">Performance — 12 Months</div>
          <svg viewBox="0 0 400 120" xmlns="http://www.w3.org/2000/svg" style="width:100%;display:block;">
            <defs>
              <linearGradient id="cg" x1="0" y1="0" x2="0" y2="1">
                <stop offset="0%" stop-color="#042FCC" stop-opacity=".22"/>
                <stop offset="100%" stop-color="#042FCC" stop-opacity="0"/>
              </linearGradient>
            </defs>
            <path class="chart-fill" d="M0,110 L0,90 C30,85 55,70 85,65 C115,60 140,72 170,55 C200,38 225,45 255,30 C285,15 315,22 345,10 L380,5 L400,8 L400,110 Z" fill="url(#cg)"/>
            <path class="chart-line" d="M0,90 C30,85 55,70 85,65 C115,60 140,72 170,55 C200,38 225,45 255,30 C285,15 315,22 345,10 L380,5 L400,8" fill="none" stroke="#042FCC" stroke-width="2.5" stroke-linecap="round"/>
          </svg>
        </div>
      </div>
    </div>

    <div class="float-card fc-bot">
      <div class="fc-label">Next Goal</div>
      <div class="fc-val">$100K</div>
    </div>
  </div>
</section>

<!-- Stats row -->
<div class="wrap">
  <div class="stats-row reveal">
    <div class="stat-item">
      <span class="stat-number">12K+</span>
      <span class="stat-desc">Active Users</span>
    </div>
    <div class="stat-item">
      <span class="stat-number">$2B+</span>
      <span class="stat-desc">Assets Tracked</span>
    </div>
    <div class="stat-item">
      <span class="stat-number">98%</span>
      <span class="stat-desc">Satisfaction Rate</span>
    </div>
    <div class="stat-item">
      <span class="stat-number">50+</span>
      <span class="stat-desc">Countries Served</span>
    </div>
  </div>
</div>

<div class="divider" style="margin-top:80px;"></div>

<!-- ──────────── WHO WE ARE ──────────── -->
<section class="who-section" id="who-we-are">
  <div class="wrap who-grid">
    <div class="reveal">
      <div class="section-tag">Who We Are</div>
      <h2 class="section-h2">A trusted global partner built for <span class="accent">progress.</span></h2>
      <div class="who-copy">
        <p>Veritance Global is a modern international company committed to delivering trusted, innovative, and reliable solutions across multiple industries. Built on integrity, excellence, and professionalism.</p>
        <p>We focus on creating opportunities, connecting people, and providing high-quality services that meet global standards.</p>
        <div class="who-quote">"We are not just another brand — we are a partner in your progress."</div>
      </div>
    </div>

    <div class="who-visual reveal" style="transition-delay:.15s;">
      <div class="who-card-stack">
        <div class="wc wc-accent">VG</div>
        <div class="wc wc-main">
          <div class="wc-main-inner">
            <div class="wc-row">
              <div class="wc-avatar">AM</div>
              <div class="wc-info">
                <strong>Amina Musa</strong>
                <span>Portfolio Analyst</span>
              </div>
            </div>
            <div class="wc-bar-label">Goal Progress — Q2 Target</div>
            <div class="wc-bar"><div class="wc-fill" style="width:72%;"></div></div>
            <div class="wc-bar-label">Risk Balance</div>
            <div class="wc-bar"><div class="wc-fill" style="width:55%;"></div></div>
            <div class="wc-bar-label">Market Exposure</div>
            <div class="wc-bar"><div class="wc-fill" style="width:84%;"></div></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="divider"></div>

<!-- ──────────── FEATURES ──────────── -->
<section class="features-section" id="features">
  <div class="wrap">
    <div class="features-header">
      <div class="reveal">
        <div class="section-tag">Features</div>
        <h2 class="section-h2">Built for decisions that <span class="accent">deserve</span> better.</h2>
      </div>
      <p class="section-body reveal" style="transition-delay:.15s;">Every detail is designed to help users move from scattered ideas to practical next steps, with less noise and more clarity.</p>
    </div>

    <div class="feature-grid">
      <article class="f-card reveal">
        <div class="f-icon">🎯</div>
        <div class="f-num">01</div>
        <h3>Goal Mapping</h3>
        <p>Turn financial targets into clear milestones, timelines, and actions you can actually follow without second-guessing every step.</p>
      </article>
      <article class="f-card reveal" style="transition-delay:.1s;">
        <div class="f-icon">⚡</div>
        <div class="f-num">02</div>
        <h3>Smart Insights</h3>
        <p>See the signals that matter most with clean summaries, useful context, and fewer distractions cutting through the noise.</p>
      </article>
      <article class="f-card reveal" style="transition-delay:.2s;">
        <div class="f-icon">🔐</div>
        <div class="f-num">03</div>
        <h3>Secure Access</h3>
        <p>Keep your account experience simple, protected, and ready whenever your next move appears — from any device, anywhere.</p>
      </article>
    </div>
  </div>
</section>

<div class="divider"></div>

<!-- ──────────── SPLIT LIGHT ──────────── -->
<section class="split-section white">
  <div class="wrap split-grid">
    <div class="reveal">
      <div class="section-tag">Clearer Planning</div>
      <h2 class="section-h2">See your next move <span class="accent">before</span> you make it.</h2>
      <p class="section-body">Bring your goals, opportunities, and progress into one simple view so every decision feels easier to understand and act on.</p>
      <ul class="split-list">
        <li>
          <div class="li-bullet"><svg viewBox="0 0 12 12" fill="none"><path d="M2 6l2.5 2.5L10 3" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
          <div class="li-text"><strong>Track priorities with a cleaner overview</strong><span>See what matters most at a glance</span></div>
        </li>
        <li>
          <div class="li-bullet"><svg viewBox="0 0 12 12" fill="none"><path d="M2 6l2.5 2.5L10 3" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
          <div class="li-text"><strong>Spot opportunities without extra noise</strong><span>Curated signals, not information overload</span></div>
        </li>
        <li>
          <div class="li-bullet"><svg viewBox="0 0 12 12" fill="none"><path d="M2 6l2.5 2.5L10 3" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
          <div class="li-text"><strong>Stay focused on consistent growth</strong><span>Build habits that compound over time</span></div>
        </li>
      </ul>
      <div style="margin-top:30px;">
        <a class="btn-primary" href="register.php">
          Get Started
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="width:18px;height:18px;"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </div>
    </div>

    <div class="split-media reveal" style="transition-delay:.2s;">
      <div class="split-media-inner">
        <div class="media-badge">📊 Live Portfolio View</div>
        <div class="ring-chart-wrap">
          <svg width="140" height="140" viewBox="0 0 140 140">
            <circle cx="70" cy="70" r="54" fill="none" stroke="var(--blue-lt)" stroke-width="18"/>
            <circle cx="70" cy="70" r="54" fill="none" stroke="var(--blue2)" stroke-width="18" stroke-dasharray="220 120" stroke-dashoffset="55" stroke-linecap="round" transform="rotate(-90 70 70)"/>
            <circle cx="70" cy="70" r="54" fill="none" stroke="var(--blue3)" stroke-width="18" stroke-dasharray="90 250" stroke-dashoffset="-170" stroke-linecap="round" transform="rotate(-90 70 70)" opacity=".5"/>
            <text x="70" y="65" text-anchor="middle" fill="#0A1240" font-family="Bebas Neue,sans-serif" font-size="22">72%</text>
            <text x="70" y="82" text-anchor="middle" fill="#5A6A90" font-family="Outfit,sans-serif" font-size="10">on track</text>
          </svg>
          <div class="ring-legend">
            <div class="rl-item"><div class="rl-dot" style="background:var(--blue2);"></div>Equities 65%</div>
            <div class="rl-item"><div class="rl-dot" style="background:var(--blue3);opacity:.6;"></div>Bonds 25%</div>
            <div class="rl-item"><div class="rl-dot" style="background:var(--blue-lt);border:1px solid var(--line);"></div>Cash 10%</div>
          </div>
        </div>
        <div style="display:grid;gap:10px;">
          <div style="display:flex;justify-content:space-between;align-items:center;padding:12px 14px;border-radius:10px;background:var(--offwhite);border:1px solid var(--line);">
            <span style="color:var(--muted);font-size:.88rem;font-weight:600;">Annual Return Target</span>
            <span style="color:#16A34A;font-weight:800;">+18.5%</span>
          </div>
          <div style="display:flex;justify-content:space-between;align-items:center;padding:12px 14px;border-radius:10px;background:var(--offwhite);border:1px solid var(--line);">
            <span style="color:var(--muted);font-size:.88rem;font-weight:600;">Risk Score</span>
            <span style="color:var(--blue);font-weight:800;">Moderate</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="divider"></div>

<!-- ──────────── SPLIT BLUE ──────────── -->
<section class="split-section">
  <div class="wrap split-grid rev">
    <div class="blue-panel reveal">
      <div class="section-tag">Built for Momentum</div>
      <h2 class="section-h2">Turn plans into progress you <span class="accent">keep following.</span></h2>
      <p class="section-body" style="margin-bottom:28px;">Keep your investment activity organized with a practical system that supports everyday choices and long-term thinking.</p>
      <ul class="split-list">
        <li>
          <div class="li-bullet"><svg viewBox="0 0 12 12" fill="none"><path d="M2 6l2.5 2.5L10 3" stroke="#042FCC" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
          <div class="li-text"><strong>Review progress in one focused place</strong><span>No tab switching, no scattered data</span></div>
        </li>
        <li>
          <div class="li-bullet"><svg viewBox="0 0 12 12" fill="none"><path d="M2 6l2.5 2.5L10 3" stroke="#042FCC" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
          <div class="li-text"><strong>Use clearer context before deciding</strong><span>Insights before action, always</span></div>
        </li>
        <li>
          <div class="li-bullet"><svg viewBox="0 0 12 12" fill="none"><path d="M2 6l2.5 2.5L10 3" stroke="#042FCC" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
          <div class="li-text"><strong>Build habits that support long-term growth</strong><span>Consistency beats intensity every time</span></div>
        </li>
      </ul>
      <div style="margin-top:30px;">
        <a class="btn-primary" href="register.php">
          Get Started
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="width:18px;height:18px;"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </div>
    </div>

    <div class="split-media reveal" style="transition-delay:.2s;">
      <div class="split-media-inner">
        <div class="media-badge">📅 Weekly Strategy Workspace</div>
        <div style="display:grid;gap:12px;margin-top:14px;">
          <div style="padding:18px;border-radius:12px;background:var(--blue-lt);border:1px solid rgba(4,47,204,.18);">
            <div style="display:flex;justify-content:space-between;margin-bottom:10px;">
              <span style="font-weight:800;font-size:.92rem;color:var(--text);">Q3 Growth Target</span>
              <span style="color:var(--blue);font-weight:900;font-size:.85rem;">78%</span>
            </div>
            <div class="wc-bar"><div class="wc-fill" style="width:78%;"></div></div>
          </div>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
            <div style="padding:16px;border-radius:12px;background:var(--offwhite);border:1px solid var(--line);text-align:center;">
              <div style="font-family:'Bebas Neue',sans-serif;font-size:2rem;color:var(--blue);">14</div>
              <div style="font-size:.78rem;color:var(--muted);font-weight:600;">Days Streak</div>
            </div>
            <div style="padding:16px;border-radius:12px;background:var(--offwhite);border:1px solid var(--line);text-align:center;">
              <div style="font-family:'Bebas Neue',sans-serif;font-size:2rem;color:#16A34A;">↑7</div>
              <div style="font-size:.78rem;color:var(--muted);font-weight:600;">Goals Met</div>
            </div>
          </div>
          <div style="padding:16px;border-radius:12px;background:var(--offwhite);border:1px solid var(--line);">
            <div style="font-size:.75rem;color:var(--muted);margin-bottom:6px;font-weight:800;text-transform:uppercase;letter-spacing:.06em;">Next Milestone</div>
            <div style="font-weight:800;font-size:1rem;color:var(--text);">Emergency Fund Fully Funded</div>
            <div style="font-size:.82rem;color:var(--blue);margin-top:4px;font-weight:700;">Est. in 23 days</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="divider"></div>

<!-- ──────────── TESTIMONIALS ──────────── -->
<section class="testi-section" id="testimonials">
  <div class="wrap">
    <div class="reveal">
      <div class="section-tag">Stories</div>
      <h2 class="section-h2">Trusted by people building their <span class="accent">next chapter.</span></h2>
    </div>
    <div class="testi-grid">
      <article class="t-card reveal" style="transition-delay:.05s;">
        <div class="t-quote-mark">"</div>
        <div class="t-stars">★★★★★</div>
        <p class="t-text">"The experience feels calm and focused. I can finally see what matters and take action without second-guessing every step. This platform changed how I think about money."</p>
        <div class="t-person">
          <div class="t-avatar">AM</div>
          <div>
            <strong>Amina M.</strong>
            <span>Small business owner</span>
          </div>
        </div>
      </article>
      <article class="t-card reveal" style="transition-delay:.15s;">
        <div class="t-quote-mark">"</div>
        <div class="t-stars">★★★★★</div>
        <p class="t-text">"It gave me a cleaner way to plan, track, and stay consistent. The layout makes financial decisions feel much less intimidating. I hit my first savings goal in 3 months."</p>
        <div class="t-person">
          <div class="t-avatar">DK</div>
          <div>
            <strong>David K.</strong>
            <span>Independent investor</span>
          </div>
        </div>
      </article>
    </div>
  </div>
</section>

<div class="divider"></div>

<!-- ──────────── FAQ ──────────── -->
<section class="faq-section" id="faqs">
  <div class="wrap faq-layout">
    <div class="reveal">
      <div class="section-tag">FAQs</div>
      <h2 class="section-h2">Got <span class="accent">questions?</span></h2>
      <p class="section-body">Quick answers about Veritance Global, how we work, and what you can expect from us.</p>
    </div>

    <div class="faq-list reveal" style="transition-delay:.15s;">
      <details class="faq" open>
        <summary>What is Veritance Global?</summary>
        <div class="faq-ans"><p>Veritance Global is a modern international company focused on delivering trusted, innovative, and reliable solutions across multiple industries — built on integrity and professionalism.</p></div>
      </details>
      <details class="faq">
        <summary>What makes Veritance Global different?</summary>
        <div class="faq-ans"><p>We combine integrity, excellence, and professionalism with a practical focus on creating opportunities, connecting people, and supporting long-term progress that actually moves the needle.</p></div>
      </details>
      <details class="faq">
        <summary>Who can work with Veritance Global?</summary>
        <div class="faq-ans"><p>Individuals, businesses, and organizations looking for dependable services, strategic support, and solutions built to meet global standards. If you have ambitions, we have the tools.</p></div>
      </details>
      <details class="faq">
        <summary>How do I get started?</summary>
        <div class="faq-ans"><p>Simply create an account — it only takes a few minutes. From there you'll have access to your dashboard, goal mapping tools, and the full Veritance Global ecosystem.</p></div>
      </details>
      <details class="faq">
        <summary>Is my data secure?</summary>
        <div class="faq-ans"><p>Absolutely. We use bank-grade encryption and follow global security standards to ensure your financial data remains private and protected at all times.</p></div>
      </details>
    </div>
  </div>
</section>

<div class="divider"></div>

<!-- ──────────── CTA ──────────── -->
<section class="cta-section" id="start">
  <div class="wrap">
    <div class="cta-box reveal">
      <div class="cta-deco">GROW</div>
      <div class="section-tag" style="justify-content:center;margin:0 auto 24px;background:rgba(255,255,255,.15);border-color:rgba(255,255,255,.25);color:#fff;">Ready to start?</div>
      <h2 class="section-h2">Build Your <span class="accent">Momentum.</span></h2>
      <p>Start with a focused dashboard, clear priorities, and a smoother way to manage your financial growth. Join thousands already moving forward.</p>
      <div class="cta-actions">
        <a class="btn-primary" href="register.php">
          Create Free Account
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="width:18px;height:18px;"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
        <a class="btn-ghost" href="#faqs">Learn More</a>
      </div>
    </div>
  </div>
</section>

<!-- ──────────── FOOTER ──────────── -->
<footer id="about">
  <div class="wrap">
    <div class="footer-grid">
      <div>
        <div class="footer-logo-mark">
          <div class="logo-diamond" style="background:var(--blue2);"></div>
          <?php echo htmlspecialchars($brandName); ?>
        </div>
        <p class="footer-about">
          <?php echo htmlspecialchars($brandName); ?> helps people plan, track, and act on financial opportunities with a calmer, clearer digital experience. Growth made simple.
        </p>
        <div class="footer-socials">
          <a href="#">in</a>
          <a href="#">ig</a>
          <a href="#">𝕏</a>
        </div>
      </div>

      <div class="footer-col">
        <h4>Company</h4>
        <ul>
          <li><a href="#who-we-are">About Us</a></li>
          <li><a href="#features">Features</a></li>
          <li><a href="#testimonials">Testimonials</a></li>
          <li><a href="#faqs">FAQs</a></li>
          <li><a href="register.php">Create Account</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h4>Resources</h4>
        <ul>
          <li><a href="login.php">Login</a></li>
          <li><a href="forgot-password.php">Password Help</a></li>
          <li><a href="dashboard/invest.php">Dashboard</a></li>
          <li><a href="#start">Get Started</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h4>Contact</h4>
        <ul>
          <li class="footer-contact-item"><a href="mailto:support@example.com">support@example.com</a></li>
          <li class="footer-contact-item"><a href="tel:+2340000000000">+234 000 000 0000</a></li>
          <li class="footer-contact-item">Lagos, Nigeria</li>
        </ul>
      </div>
    </div>

    <div class="footer-bottom">
      <span>&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($brandName); ?>. All rights reserved.</span>
      <div class="footer-legal">
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Service</a>
        <a href="#">Security</a>
      </div>
    </div>
  </div>
</footer>

<script>
/* ── Cursor ── */
const dot = document.getElementById('cursor-dot');
const ring = document.getElementById('cursor-ring');
if (dot && ring) {
  let mx=0,my=0,rx=0,ry=0;
  document.addEventListener('mousemove',e=>{mx=e.clientX;my=e.clientY;});
  (function track(){
    rx+=(mx-rx)*.12;ry+=(my-ry)*.12;
    dot.style.left=mx+'px';dot.style.top=my+'px';
    ring.style.left=rx+'px';ring.style.top=ry+'px';
    requestAnimationFrame(track);
  })();
  document.querySelectorAll('a,button,.f-card,.t-card,.faq').forEach(el=>{
    el.addEventListener('mouseenter',()=>{ring.style.transform='translate(-50%,-50%) scale(1.8)';ring.style.borderColor='rgba(4,47,204,.7)';});
    el.addEventListener('mouseleave',()=>{ring.style.transform='translate(-50%,-50%) scale(1)';ring.style.borderColor='rgba(4,47,204,.4)';});
  });
}

/* ── Nav scroll ── */
const nav=document.getElementById('siteNav');
window.addEventListener('scroll',()=>{nav.classList.toggle('scrolled',window.scrollY>50);},{passive:true});

/* ── Hamburger ── */
const ham=document.getElementById('hamBtn');
const mob=document.getElementById('mobileMenu');
if(ham&&mob){
  ham.addEventListener('click',()=>{
    const open=mob.classList.toggle('open');
    ham.classList.toggle('open',open);
    ham.setAttribute('aria-expanded',open);
  });
  mob.querySelectorAll('a').forEach(a=>a.addEventListener('click',()=>{
    mob.classList.remove('open');ham.classList.remove('open');ham.setAttribute('aria-expanded','false');
  }));
}

/* ── Scroll reveal ── */
const reveals=document.querySelectorAll('.reveal');
const io=new IntersectionObserver(entries=>{
  entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('visible');io.unobserve(e.target);}});
},{threshold:0.12});
reveals.forEach(el=>io.observe(el));

/* ── Progress bars ── */
const bars=document.querySelectorAll('.wc-fill');
const barObs=new IntersectionObserver(entries=>{
  entries.forEach(e=>{
    if(e.isIntersecting){
      const w=e.target.style.width;
      e.target.style.width='0%';
      setTimeout(()=>{e.target.style.width=w;},100);
      barObs.unobserve(e.target);
    }
  });
},{threshold:.2});
bars.forEach(b=>barObs.observe(b));

/* ── Counter animation ── */
const statNums=document.querySelectorAll('.stat-number');
const numObs=new IntersectionObserver(entries=>{
  entries.forEach(e=>{
    if(!e.isIntersecting)return;
    const el=e.target,txt=el.textContent;
    const num=parseFloat(txt.replace(/[^0-9.]/g,''));
    const suffix=txt.replace(/[0-9.]/g,'');
    if(isNaN(num))return;
    let startTime=null,dur=1600;
    function step(ts){
      if(!startTime)startTime=ts;
      const p=Math.min((ts-startTime)/dur,1);
      const ease=1-Math.pow(1-p,3);
      el.textContent=Math.floor(ease*num)+suffix;
      if(p<1)requestAnimationFrame(step);else el.textContent=txt;
    }
    requestAnimationFrame(step);
    numObs.unobserve(el);
  });
},{threshold:.5});
statNums.forEach(n=>numObs.observe(n));
</script>
</body>
</html>