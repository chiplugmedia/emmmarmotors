
<footer class="fixed bottom-0 left-1/2 -translate-x-1/2 z-[999] w-full max-w-[590px]
bg-[#fdf8e5]/80 backdrop-blur-2xl rounded-t-3xl shadow-2xl
border border-white/20 border-b-0">

    <div class="flex items-end justify-between px-3 py-2">

        <!-- Teams -->
        <a href="teams"
           class="flex flex-col items-center gap-1 px-3 py-1 rounded-xl
           transition-all duration-300 text-gray-500 hover:text-[#2f4f4e] group">

            <i class="fas fa-users text-[16px] group-hover:scale-110 transition-transform"></i>

            <span class="text-[10px] tracking-tight">
                Teams
            </span>
        </a>

        <!-- Product -->
        <a href="invest"
           class="flex flex-col items-center gap-1 px-3 py-1 rounded-xl
           transition-all duration-300 text-gray-500 hover:text-[#2f4f4e] group">

            <i class="fas fa-box text-[16px] group-hover:scale-110 transition-transform"></i>

            <span class="text-[10px] tracking-tight">
                Product
            </span>
        </a>

        <!-- Home -->
        <a href="index" class="flex flex-col items-center -mt-4">

            <div class="relative">

                <!-- Glow -->
                <div class="absolute inset-0 rounded-2xl bg-[#2f4f4e]/20 blur-xl"></div>

                <!-- Button -->
                <span class="relative flex h-14 w-14 items-center justify-center
                rounded-2xl bg-gradient-to-br from-[#2f4f4e] to-[#3f6664]
                text-white shadow-xl border border-white/20
                hover:-translate-y-1 transition-all duration-300">

                    <i class="fas fa-home text-[18px]"></i>
                </span>

            </div>

            <span class="text-[10px] mt-2 font-semibold tracking-wide text-[#2f4f4e]">
                Home
            </span>

        </a>

        <!-- profile -->
        <a href="profile"
           class="flex flex-col items-center gap-1 px-3 py-1 rounded-xl
           transition-all duration-300 text-gray-500 hover:text-[#2f4f4e] group">

            <i class="fa-solid fa-user text-[16px] group-hover:scale-110 transition-transform"></i>
            <span class="text-[10px] tracking-tight">
                Profile
            </span>
        </a>

        <!-- Menu -->
        <a href="menu"
           class="flex flex-col items-center gap-1 px-3 py-1 rounded-xl
           transition-all duration-300 text-gray-500 hover:text-[#2f4f4e] group cursor-pointer">

            <i class="fas fa-bars text-[16px] group-hover:scale-110 transition-transform"></i>

            <span class="text-[10px] tracking-tight">
                Menu
            </span>
        </a>

    </div>

</footer>

<!-- Floating Button -->
<button onclick="toggleChat()"
class="fixed bottom-5 right-5 z-50 group flex items-center justify-center gap-2 
       rounded-full bg-[#2F4F4E] px-5 py-3 font-semibold text-white shadow-lg 
       transition-all duration-300
       hover:-translate-y-1 hover:rotate-[-2deg]
       active:scale-95 mb-[80px] sm:mb-0"

    <!-- Chat Icon -->
    <svg xmlns="http://www.w3.org/2000/svg"
         class="w-5 h-5"
         viewBox="0 0 24 24"
         fill="none"
         stroke="currentColor"
         stroke-width="2"
         stroke-linecap="round"
         stroke-linejoin="round">
        <path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"></path>
    </svg>

    <span>Live Support</span>
</button>

<!-- Chat Box -->
<div id="chatBox"
class="fixed bottom-20 right-5 w-80 hidden bg-[#1a3332] text-white rounded-xl shadow-xl overflow-hidden">

    <div class="p-3 border-b border-white/10 flex justify-between">
        <span class="font-semibold">Live Support</span>
        <button onclick="toggleChat()">✕</button>
    </div>

    <div id="messages" class="h-72 overflow-y-auto p-3 space-y-2 text-sm"></div>

    <div class="p-2 border-t border-white/10 flex gap-2">
        <input id="msg"
               class="w-full p-2 rounded bg-white/10 text-white outline-none"
               placeholder="Type message...">

        <button onclick="sendMessage()"
                class="bg-[#FEFBEF] text-black px-3 rounded">
            Send
        </button>
    </div>
</div>

<script>
function toggleChat() {
    document.getElementById("chatBox").classList.toggle("hidden");
}

// SEND MESSAGE
function sendMessage() {
    let msg = document.getElementById("msg").value;

    if (msg.trim() === "") return;

    fetch("chat.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "message=" + encodeURIComponent(msg)
    });

    document.getElementById("msg").value = "";
    loadMessages();
}

// LOAD MESSAGES
function loadMessages() {
    fetch("chat.php")
        .then(res => res.text())
        .then(data => {
            document.getElementById("messages").innerHTML = data;
        });
}

setInterval(loadMessages, 2000);
loadMessages();
</script>

<script>
function confirmLogout(event) {
    event.preventDefault(); // Stop default link behavior

    Swal.fire({
        title: 'Are you sure?',
        text: "You will be signed out.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, sign out',
        cancelButtonText: 'Cancel',
        customClass: {
            popup: 'small-swal',
            title: 'small-swal-mytitle',
            htmlContainer: 'small-swal-text'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "/dashboard/logout.php";
        }
    });

    return false;
}
</script>

<style>
.small-swal {
  font-size: 14px !important;
  max-width: 300px !important;
  border-radius: 8px !important;
  padding: 8px 16px !important;
  background-color: #ffffff; 
  color: #000;
}

.small-swal-mytitle {
  font-size: 16px !important;
  margin-bottom: 5px !important;
  color: #750000;
}

.small-swal-text {
  font-size: 14px !important;
  margin: 0 !important;
  color: #000;
}
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
let index = 0;
const slides = document.querySelectorAll(".carousel-item");

function showSlide(i) {
    slides.forEach(slide => slide.classList.remove("active"));
    slides[i].classList.add("active");
}

function nextSlide() {
    index = (index + 1) % slides.length;
    showSlide(index);
}

// start first slide
showSlide(index);

// auto slide every 3 seconds
setInterval(nextSlide, 3000);
</script>

     <script src="/invest/mysite/sweet/sweet.js"></script>
</body>
</html>