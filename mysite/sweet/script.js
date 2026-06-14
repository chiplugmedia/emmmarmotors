/* ── THEME ── */
let isDark = true;
function toggleTheme() {
  isDark = !isDark;
  document.documentElement.classList.toggle("light", !isDark);
}

/* ── DROPDOWN ── */
function toggleDD(id) {
  const el = document.getElementById(id);
  const wasOpen = el.classList.contains("open");
  closeAllDD();
  if (!wasOpen) el.classList.add("open");
}
function closeAllDD() {
  document
    .querySelectorAll(".dropdown.open")
    .forEach((d) => d.classList.remove("open"));
}
document.addEventListener("click", (e) => {
  if (!e.target.closest(".dropdown")) closeAllDD();
});

/* ── DRAWER ── */
function toggleDrawer() {
  const open = document.getElementById("drawer").classList.contains("open");
  open ? closeDrawer() : openDrawer();
}
function openDrawer() {
  document.getElementById("drawer").classList.add("open");
  document.getElementById("drawerOverlay").classList.add("open");
  document.getElementById("hamBtn").classList.add("open");
}
function closeDrawer() {
  document.getElementById("drawer").classList.remove("open");
  document.getElementById("drawerOverlay").classList.remove("open");
  document.getElementById("hamBtn").classList.remove("open");
}

/* ── ACCORDION ── */
function toggleAcc(id) {
  document.getElementById(id).classList.toggle("open");
}

/* ── SCROLL REVEAL ── */
const io = new IntersectionObserver(
  (entries) => {
    entries.forEach((e) => {
      if (!e.isIntersecting) return;
      e.target.classList.add("revealed");
      io.unobserve(e.target);
    });
  },
  { threshold: 0.1, rootMargin: "0px 0px -36px 0px" },
);
document.querySelectorAll("[data-reveal]").forEach((el) => io.observe(el));

/* ── NAV SHADOW ── */
window.addEventListener("scroll", () => {
  document
    .getElementById("navbar")
    .classList.toggle("scrolled", window.scrollY > 30);
});

/* ── FAQ accordion ── */
function toggleFaq(btn) {
  const item = btn.closest(".faq-item");
  const isOpen = item.classList.contains("open");
  document
    .querySelectorAll(".faq-item.open")
    .forEach((i) => i.classList.remove("open"));
  if (!isOpen) item.classList.add("open");
}

/* ── Form submit (demo) ── */
function submitForm(e) {
  e.preventDefault();
  const fname = document.getElementById("fname").value.trim();
  const email = document.getElementById("email").value.trim();
  const subject = document.getElementById("subject").value;
  const message = document.getElementById("message").value.trim();
  const consent = document.getElementById("consent").checked;
  if (!fname || !email || !subject || !message || !consent) {
    alert("Please fill in all required fields and accept the privacy policy.");
    return;
  }
  const btn = e.target;
  btn.disabled = true;
  btn.textContent = "Sending…";
  setTimeout(() => {
    document.getElementById("contactForm").style.display = "none";
    document.getElementById("formSuccess").classList.add("show");
  }, 1200);
}
function resetForm() {
  document.getElementById("contactForm").style.display = "block";
  document.getElementById("formSuccess").classList.remove("show");
  document.getElementById("fname").value = "";
  document.getElementById("lname").value = "";
  document.getElementById("email").value = "";
  document.getElementById("subject").value = "";
  document.getElementById("message").value = "";
  document.getElementById("consent").checked = false;
  const btn = document.querySelector(".form-submit");
  btn.disabled = false;
  btn.textContent = "Send Message ↗";
}
