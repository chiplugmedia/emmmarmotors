<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require $_SERVER['DOCUMENT_ROOT']."/emmmarmotors/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/actions/buyprod.php";

$ptitle="Dashboard";

if (isset($_SESSION['username'])) { 
    $dbUsername = $_SESSION['username'];
    $time = date("H:i:s");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['claim_checkin'])) {
    $date = date("Y-m-d");
    $dateTime = date("Y-m-d H:i:s");

    // Check if already claimed today
    $stmt = $link->prepare("SELECT * FROM dailylogin WHERE username=? AND DATE(date)=?");
    $stmt->bind_param("ss", $dbUsername, $date);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        echo json_encode(["status"=>"error", "message"=>"You already claimed today"]);
        exit;
    }

    // Credit user
    $stmt = $link->prepare("UPDATE users SET funds = funds + ? WHERE username=?");
    $stmt->bind_param("ds", $dailyLogin, $dbUsername);
    $stmt->execute();
    $stmt->close();

    // Insert logs
    $stmt = $link->prepare("INSERT INTO dailylogin(username, amount, date) VALUES(?, ?, ?)");
    $stmt->bind_param("sds", $dbUsername, $dailyLogin, $dateTime);
    $stmt->execute();
    $stmt->close();

    $type = "Check In";
    $stmt = $link->prepare("INSERT INTO userearnings(username, type, amount, time, date) VALUES(?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdss", $dbUsername, $type, $dailyLogin, $time, $dateTime);
    $stmt->execute();
    $stmt->close();

    echo json_encode(["status"=>"success", "message"=>"Check-in successful! â‚¦50"]);
    exit;
}


$masked_username = substr($username, 0, 6) . '****' . substr($username, -4);
include "inc/header2.php" ?>



    
        <div><?php echo $genMsg?></div>
        
       <div class="px-4 pt-5 pb-3 relative z-10 border-b border-gray-100">

  <div class="flex items-center justify-between">

    <!-- Left: Profile -->
    <div class="flex items-center gap-3">

      <div class="h-11 w-11 rounded-full bg-blue-50 flex items-center justify-center overflow-hidden border-2 border-blue-100 relative">

        <?php
      if ($profileImg == "no-avatar.png") {
          echo '<img src="/invest/mysite/bandogreen.jfif" class="w-full h-full object-cover relative z-10">';
      } else {
          echo '<img src="/dashboard/assets/img/profilephotos/' . $profileImg . '" class="w-full h-full object-cover relative z-10">';
      }
      ?>

        <!-- fallback initials -->
        <div class="absolute inset-0 flex items-center justify-center">
          <span class="text-sm font-bold text-blue-600">WA</span>
        </div>

      </div>

      <div>
        <p class="text-[11px] text-gray-500">Welcome back 👋</p>
        <p class="text-sm font-semibold text-gray-900"><?php echo $masked_username?></p>
      </div>

    </div>

    <!-- Right Actions -->
    <div class="flex items-center gap-2">

     
      <!-- Notifications -->
      <a href="#" class="relative">

       <button class="relative h-9 w-9 rounded-full bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition">

    <!-- Icon -->
    <i class="fas fa-bell text-gray-800 text-sm"></i>

    <!-- Notification dot -->
    <span class="absolute top-1.5 right-1.5 h-2 w-2 rounded-full bg-red-400"></span>

</button>

      </a>

    </div>

  </div>

</div>
<!-- Wallet Card — Tailwind CSS -->
<!-- Requires Tailwind CSS v3+ in your project -->

<div class="relative w-full overflow-hidden rounded-2xl border border-white/[0.08] bg-[#1a3332] p-7 font-sans">

  <!-- Decorative circles -->
  <div class="pointer-events-none absolute -right-[70px] -top-[70px] h-[200px] w-[200px] rounded-full bg-white/[0.035]"></div>
  <div class="pointer-events-none absolute -bottom-[50px] left-[30px] h-[140px] w-[140px] rounded-full bg-white/[0.025]"></div>

  <!-- Header -->
  <div class="relative z-10 flex items-center justify-between">

    

  </div>

  <!-- Balance -->
  <div class="relative z-10 mb-7">
    <p class="mb-2.5 text-[11px] font-medium uppercase tracking-[0.08em] text-white/40">Available balance</p>
    <div class="flex items-center gap-1">
      <span class="mr-0.5 self-center font-mono text-lg text-white/45">₦</span>
      <span id="balance" class="font-mono text-4xl font-normal tracking-[-0.03em] text-white transition-[filter,opacity] duration-[250ms]">0.00</span>
      <button id="toggleBtn" aria-label="Toggle balance visibility" class="ml-2.5 flex cursor-pointer items-center bg-transparent p-1 text-white/35 transition-colors hover:text-white/75">
        <svg id="eyeIcon" class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z"/>
          <circle cx="12" cy="12" r="3"/>
        </svg>
      </button>
    </div>
  </div>

  

</div>

<script>
  const toggleBtn = document.getElementById('toggleBtn');
  const balance   = document.getElementById('balance');
  const eyeIcon   = document.getElementById('eyeIcon');

  const eyeOpen   = `<path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/>`;
  const eyeClosed = `<path d="M3 3l18 18"/><path d="M10.58 10.58A3 3 0 0 0 12 15a3 3 0 0 0 2.42-4.42"/><path d="M9.88 4.24A10.46 10.46 0 0 1 12 4c6.5 0 10 8 10 8a18.5 18.5 0 0 1-3.17 4.5"/><path d="M6.1 6.1C3.9 8 2 12 2 12s3.5 7 10 7a10.5 10.5 0 0 0 5.9-1.7"/>`;

  let hidden = false;

  toggleBtn.addEventListener('click', () => {
    hidden = !hidden;
    balance.style.filter  = hidden ? 'blur(10px)' : '';
    balance.style.opacity = hidden ? '0.6' : '';
    balance.style.userSelect = hidden ? 'none' : '';
    eyeIcon.innerHTML = hidden ? eyeClosed : eyeOpen;
  });
</script>

<div class="grid grid-cols-2 gap-3 mt-4">

  <!-- Card 1 -->
  <div class="relative flex flex-col overflow-hidden rounded-2xl bg-[#1a3332] p-3 text-sm">
    <p class="mb-1 text-xs text-gray-400">Daily Income</p>
    <p class="text-sm font-semibold text-white">₦0.00</p>

    <svg xmlns="http://www.w3.org/2000/svg"
         viewBox="0 0 24 24"
         fill="none"
         stroke="currentColor"
         stroke-width="2"
         stroke-linecap="round"
         stroke-linejoin="round"
         class="absolute bottom-3 right-3 h-8 w-8 text-white/10">
      <path d="M7 7h10v10"></path>
      <path d="M7 17 17 7"></path>
    </svg>
  </div>

  <!-- Card 2 -->
  <div class="relative flex flex-col overflow-hidden rounded-2xl bg-[#1a3332] p-3 text-sm text-white">
    <p class="mb-1 text-xs text-white/70">Referral Commission</p>
    <p class="text-sm font-semibold">₦0.00</p>

    <svg xmlns="http://www.w3.org/2000/svg"
         viewBox="0 0 24 24"
         fill="none"
         stroke="currentColor"
         stroke-width="2"
         stroke-linecap="round"
         stroke-linejoin="round"
         class="absolute bottom-3 right-3 h-8 w-8 text-white/20">
      <path d="M7 7h10v10"></path>
      <path d="M7 17 17 7"></path>
    </svg>
  </div>

</div>

<div class="w-full max-w-[590px] mx-auto px-4 py-5">

    <!-- TITLE -->
    <h3 class="text-sm font-bold mb-4 px-1 text-gray-900">
        Quick Link
    </h3>

    <!-- GRID -->
    <div class="grid grid-cols-4 gap-4">

        
        <!-- ITEM -->
        <a href="withdraw" class="flex flex-col items-center gap-2 group">
            <div class="flex h-12 w-12 items-center justify-center rounded-xl border border-gray-200 bg-white shadow-sm transition group-hover:bg-gray-50">
              <i class="fas fa-arrow-up text-lg" style="color: #1a3332;"></i>

            </div>
            <span class="text-[10px] text-center font-semibold text-gray-700">Withdraw</span>
        </a>
        
        <!-- ITEM -->
        <a href="deposit" class="flex flex-col items-center gap-2 group">
            <div class="flex h-12 w-12 items-center justify-center rounded-xl border border-gray-200 bg-white shadow-sm transition group-hover:bg-gray-50">
              <i class="fas fa-arrow-down text-lg" style="color: #1a3332;"></i>

            </div>
            <span class="text-[10px] text-center font-semibold text-gray-700">Deposit</span>
        </a>

        <!-- ITEM -->
        <a href="#" class="flex flex-col items-center gap-2 group">
            <div class="flex h-12 w-12 items-center justify-center rounded-xl border border-gray-200 bg-white shadow-sm transition group-hover:bg-gray-50">
               <i class="fas fa-mobile-alt text-lg" style="color: #1a3332;"></i>
            </div>
            <span class="text-[10px] text-center font-semibold text-gray-700">App</span>
        </a>

        <!-- ITEM -->
        <a href="<?php echo $siteDesc; ?>" class="flex flex-col items-center gap-2 group">
            <div class="flex h-12 w-12 items-center justify-center rounded-xl border border-gray-200 bg-white shadow-sm transition group-hover:bg-gray-50">
               <i class="fab fa-telegram text-lg" style="color: #1a3332;"></i>
            </div>
            <span class="text-[10px] text-center font-semibold text-gray-700">Telegram Channel</span>
        </a>

        

    </div>
</div>
<!-- =========================
     LIVE WITHDRAWAL TICKER (AVATAR + FAST)
========================= -->
<div class="w-full rounded-xl p-4 text-black overflow-hidden">

    <div class="mb-3 flex items-center justify-between">

    </div>

    <div class="ticker-wrap">
        <div id="withdrawFeed" class="ticker-text"></div>
    </div>

</div>

<!-- =========================
     JS
========================= -->
<script>
const withdrawals = [
    { name: "John D.", amount: 12500 },
    { name: "Mary K.", amount: 8200 },
    { name: "David S.", amount: 15400 },
    { name: "Aisha B.", amount: 6700 },
    { name: "Michael T.", amount: 23000 },
    { name: "Blessing O.", amount: 9100 },
    { name: "Peter A.", amount: 14300 },
    { name: "Grace N.", amount: 5600 },
    { name: "Samuel I.", amount: 17800 },
    { name: "Fatima Z.", amount: 9900 }
];

const avatars = [
    "/invest/mysite/bandogreen.jfif",
    "/invest/mysite/bandogreen.jfif",
    "/invest/mysite/bandogreen.jfif",
    "/invest/mysite/bandogreen.jfif",
    "/invest/mysite/bandogreen.jfif",
    "/invest/mysite/bandogreen.jfif",
    "/invest/mysite/bandogreen.jfif",
    "/invest/mysite/bandogreen.jfif"
];

let text = "";

withdrawals.forEach(u => {
    const avatar = avatars[Math.floor(Math.random() * avatars.length)];

    text += `
        <span class="inline-flex items-center gap-2 mx-6">
            <img src="${avatar}" class="w-6 h-6 rounded-full border border-white/20">
            <b>${u.name}</b> withdrew ₦${u.amount.toLocaleString()}
        </span>
      
    `;
});

// duplicate for smooth loop
text += text;

document.getElementById("withdrawFeed").innerHTML = text;
</script>

<style>
.ticker-wrap {
    width: 100%;
    overflow: hidden;
    white-space: nowrap;
}

.ticker-text {
    display: inline-block;
    white-space: nowrap;
    padding-left: 100%;
    animation: scrollText 29s linear infinite;
    font-size: 14px;
}

.ticker-text:hover {
    animation-play-state: paused;
}

@keyframes scrollText {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-100%);
    }
}

/* mobile even faster */
@media (max-width: 768px) {
    .ticker-text {
        animation-duration: 29s;
    }
}
</style>


<div class="relative overflow-hidden rounded-2xl border border-[#1a3332] bg-[#FEFBEF] p-5 text-sm">

  <!-- Glow effect -->
  <div class="absolute -top-5 -right-5 h-32 w-32 rounded-full bg-black/5 blur-3xl"></div>

  <div class="relative z-10 space-y-4">

    <!-- Header -->
    <div class="flex items-center gap-3">

      <div>
        <h3 class="text-sm font-bold text-[#1a3332]">Referrl Link</h3>
        <p class="text-[11px] text-[#1a3332]/70">
          Invite friends and Earn
        </p>
      </div>

    </div>

    <!-- Referral + Copy -->
    <div class="flex items-center gap-2">

      <div class="flex h-11 flex-1 items-center overflow-hidden rounded-xl border border-[#1a3332]/30 bg-[#1a3332]/10 px-4">
        <p id="refLink" class="truncate text-xs font-medium text-[#1a3332]/60">
         <?php echo $sitelink; ?>/register?code=<?php echo $code; ?>
        </p>
      </div>

      <button id="copyBtn"
              class="h-11 rounded-xl bg-[#1a3332] px-4 text-xs font-bold text-[#FEFBEF] transition hover:opacity-90">
        Copy
      </button>

    </div>


  </div>
</div>


<!-- ===== CONTRACT SECTION WRAPPER ===== -->
<div class="w-full mt-[20px] mb-[120px]">

   <!-- HEADER -->
<div class="flex items-center justify-end mb-6">
    <a href="invest" class="text-sm font-semibold text-[#2F4F4E] hover:underline">
        View More →
    </a>
</div>

    <?php
    $levels = ['Basic', 'Quadro', 'Plant'];

    foreach ($levels as $index => $level) {
    ?>

    <!-- LEVEL GRID -->
    <div
        id="level-<?php echo strtolower($level); ?>"
        class="contracts-grid grid grid-cols-1 sm:grid-cols-2 gap-6 xl:gap-8 <?php echo $index === 0 ? '' : 'hidden'; ?>"
    >

        <?php
        $sql = $link->prepare("
            SELECT * 
            FROM investment_plans 
            WHERE level=? 
            ORDER BY CAST(price AS UNSIGNED) ASC 
            LIMIT 4
        ");
        $sql->bind_param("s", $level);
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                $title     = htmlspecialchars($row['title']);
                $price     = htmlspecialchars($row['price']);
                $daily     = htmlspecialchars($row['daily']);
                $image     = htmlspecialchars($row['image']);
                $duration  = htmlspecialchars($row['duration']);
                $reference = htmlspecialchars($row['reference']);

                $total_income = $daily * $duration;
        ?>

        <!-- CARD -->
        <div class="group flex flex-col overflow-hidden rounded-2xl  border border-[#1a3332] bg-[#FEFBEF] transition duration-300 mb-[20px]">

            <!-- IMAGE -->
            <div class="relative flex h-40 items-center justify-center bg-gray-50">
                <div class="absolute inset-0 bg-green-500/5 blur-2xl"></div>

                <img
                    src="/dashboard/img/invest/<?php echo $image; ?>"
                    alt="<?php echo $title; ?>"
                    class="relative z-10 h-full object-contain p-4 transition group-hover:scale-105"
                >
            </div>

            <!-- BODY -->
            <div class="flex-1 p-5">

                <h3 class="mb-4 text-center text-lg font-bold text-gray-900">
                    <?php echo $title; ?>
                </h3>

                <div class="space-y-3 text-sm">

                    <div class="flex justify-between">
                        <span class="text-gray-500">Price</span>
                        <span class="font-semibold text-gray-900">₦<?php echo number_format($price); ?></span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-500">Period</span>
                        <span class="font-semibold text-gray-900"><?php echo $duration; ?> days</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-500">Daily Earning</span>
                        <span class="font-semibold text-gray-900">₦<?php echo number_format($daily); ?></span>
                    </div>

                    <div class="flex justify-between border-t border-gray-100 pt-2">
                        <span class="font-medium text-gray-700">Total Earning</span>
                        <span class="font-bold text-[#2F4F4E]">₦<?php echo number_format($total_income); ?></span>
                    </div>

                </div>
            </div>

            <!-- BUTTON -->
            <a
                href="/invest/dashboard/invest-details?reference=<?php echo $reference; ?>"
                class="group relative flex w-full items-center justify-center gap-2 rounded-md bg-[#2F4F4E] py-3.5 font-semibold text-white transition-all duration-300
         hover:-translate-y-1
         hover:rotate-[-2deg]
         active:scale-95"
            >
                View Plan
            </a>

        </div>

        <?php
            }
        } else {
            echo "<p class='col-span-full text-center text-sm text-gray-500'>No plans found for $level.</p>";
        }
        ?>

    </div>

    <?php } ?>

</div>



<?php
function makeLinksClickable($text) {
    return preg_replace(
        '/(https?:\/\/[^\s]+)/',
        '<a href="$1" target="_blank" class="text-blue-400 underline hover:text-blue-300">$1</a>',
        $text
    );
}

$sql = "SELECT * FROM posts ORDER BY created_at DESC LIMIT 1";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

        $title = $row["title"];
        $content = makeLinksClickable($row["content"]);
        $image = $row["image"];
        $author_id = $row["author_id"];
?>

<!-- Overlay -->
<div id="notifyModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60">

    <!-- Modal Box -->
    <div class="w-full max-w-md mx-4 bg-[#1a3332] text-white rounded-2xl shadow-xl overflow-hidden">

        <!-- Header -->
        <div class="flex items-center justify-between px-4 py-3 border-b border-white/10">
            <h2 class="text-lg font-semibold">
                <?php echo htmlspecialchars($title); ?>
            </h2>

            <button onclick="closeModal()"
                    class="text-white hover:text-red-400 text-xl">
                ✕
            </button>
        </div>

        <!-- Body -->
        <div class="p-4 space-y-4">

            <?php if (!empty($image)): ?>
                <img src="/account/img/posts/<?php echo htmlspecialchars($image); ?>"
                     class="w-full rounded-lg object-cover">
            <?php endif; ?>

            <p class="text-sm leading-relaxed text-gray-200">
                <?php echo nl2br($content); ?>
            </p>

            <a href="<?php echo htmlspecialchars($author_id); ?>"
               class="group relative flex w-full items-center justify-center gap-2 rounded-md bg-[#2F4F4E] py-3.5 font-semibold text-white transition-all duration-300
         hover:-translate-y-1
         hover:rotate-[-2deg]
         active:scale-95">
                <i class="bx bx-chevrons-up"></i> Click To Join...
            </a>

        </div>

    </div>
</div>

<?php
    }
}
?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("notifyModal").classList.remove("hidden");
    document.getElementById("notifyModal").classList.add("flex");
});

function closeModal() {
    document.getElementById("notifyModal").classList.add("hidden");
    document.getElementById("notifyModal").classList.remove("flex");
}
</script>

<!-- COPY SCRIPT -->
<script>
  const copyBtn = document.getElementById("copyBtn");
  const refLink = document.getElementById("refLink");

  copyBtn.addEventListener("click", async () => {
    try {
      const text = refLink.textContent.trim();

      await navigator.clipboard.writeText(text);

      copyBtn.textContent = "Copied!";
      copyBtn.classList.add("opacity-70");

      setTimeout(() => {
        copyBtn.textContent = "Copy";
        copyBtn.classList.remove("opacity-70");
      }, 1500);

    } catch (err) {
      console.error("Copy failed:", err);
      copyBtn.textContent = "Failed";

      setTimeout(() => {
        copyBtn.textContent = "Copy";
      }, 1500);
    }
  });
</script>

<?php include "inc/footer2.php" ?>