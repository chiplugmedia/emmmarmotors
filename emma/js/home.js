tailwind.config = {
    darkMode: 'class',
    theme: {
      extend: {
        fontFamily: {
          sans: ['ui-sans-serif','system-ui','-apple-system','"Segoe UI"','Roboto','"Helvetica Neue"','Arial','sans-serif'],
        },
        colors: {
          navy: { 950: '#060B16', 900: '#0A1122', 800: '#101B33', 700: '#172544' },
          brand: { 50:'#EEF4FF',100:'#E0EBFF',200:'#C2D7FE',300:'#93B7FD',400:'#5D8FFB',500:'#3466F6',600:'#1D4ED8',700:'#1739AC',800:'#152F87',900:'#122A6E' },
        },
        boxShadow: {
          'soft': '0 2px 10px -2px rgba(16,27,51,0.08), 0 8px 24px -8px rgba(16,27,51,0.10)',
          'soft-lg': '0 12px 40px -12px rgba(16,27,51,0.25)',
          'glow': '0 0 0 1px rgba(52,102,246,0.15), 0 8px 30px -6px rgba(52,102,246,0.35)',
        },
      }
    }
  }

    const html = document.documentElement;
  const themeToggle = document.getElementById('theme-toggle');
  const iconSun = document.getElementById('icon-sun');
  const iconMoon = document.getElementById('icon-moon');
  function setDark(isDark) {
    html.classList.toggle('dark', isDark);
    iconSun.classList.toggle('hidden', isDark);
    iconMoon.classList.toggle('hidden', !isDark);
  }
  const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
  setDark(prefersDark);
  themeToggle.addEventListener('click', () => setDark(!html.classList.contains('dark')));

  const menuBtn = document.getElementById('mobile-menu-btn');
  const mobileMenu = document.getElementById('mobile-menu');
  const iconBurger = document.getElementById('icon-burger');
  const iconClose = document.getElementById('icon-close');
  menuBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
    iconBurger.classList.toggle('hidden');
    iconClose.classList.toggle('hidden');
  });
  document.querySelectorAll('#mobile-menu a').forEach(a => a.addEventListener('click', () => {
    mobileMenu.classList.add('hidden');
    iconBurger.classList.remove('hidden');
    iconClose.classList.add('hidden');
  }));

  // vehicle filter tabs (vehicles.html only)
  const tabs = document.querySelectorAll('.tab-btn');
  if (tabs.length) {
    const cards = document.querySelectorAll('.vehicle-card');
    tabs.forEach(tab => tab.addEventListener('click', () => {
      tabs.forEach(t => t.classList.remove('active'));
      tab.classList.add('active');
      const cat = tab.dataset.cat;
      cards.forEach(c => {
        c.style.display = (cat === 'all' || c.dataset.cat === cat) ? '' : 'none';
      });
    }));
  }
  