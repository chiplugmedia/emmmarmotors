<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require $_SERVER['DOCUMENT_ROOT']."/invest/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/actions/spin.php";



$ptitle="Lucky Draw";
include "inc/header2.php" ?>


    

<div class="pt-15">
    <div class="fixed left-1/2 top-0 z-50 flex w-full max-w-[590px] -translate-x-1/2 items-center justify-between 
                rounded-b-3xl bg-white/70 backdrop-blur-md shadow-lg border-gray-200 px-4 py-3 mb-5">

        <!-- Back Button -->
        <div class="flex min-w-[40px] items-center gap-2">
            <a href="javascript:history.back()"
               class="flex h-8 w-8 items-center justify-center rounded-full bg-white text-white shadow-sm transition hover:bg-gray-100">

                <i class="bi bi-chevron-left text-sm text-[#ad050b]"></i>

            </a>
        </div>

        <!-- Title -->
        <h1 class="text-md font-semibold text-gray-800">
            <?php echo $ptitle?>
        </h1>

        <!-- Right Side -->
        <div class="flex min-w-[40px] justify-end"></div>

    </div>
</div>

<!-- Fonts & Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<div class="mt-[80px] mb-[20px]">

   <?php echo $genMsg ?>
        <!-- HEADER -->
        <div class="flex flex-wrap items-center justify-between gap-4">

           

        </div>

        <!-- WHEEL -->
        <div class="relative mx-auto aspect-square w-full max-w-[420px]">

            <div class="absolute inset-0 rounded-full bg-red-400/30 blur-3xl animate-pulse"></div>

            <div class="relative z-10 h-full w-full rounded-full border-[12px] border-red-500 bg-white shadow-[0_20px_60px_rgba(239,68,68,0.4)]">

                <canvas id="wheelCanvas" width="400" height="400"
                    class="h-full w-full rounded-full"></canvas>

                <!-- SPIN BUTTON (FIXED) -->
                <button
                    type="button"
                    id="spinBtn"
                    class="absolute left-1/2 top-1/2 z-20 flex h-[120px] w-[120px] -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-full border-8 border-white bg-red-600 text-xl font-extrabold tracking-widest text-white shadow-2xl transition hover:scale-105 active:scale-95">
                    CLICK
                </button>

                <!-- TEXT (BLACK FIXED) -->
                <div id="spinText"
                    class="absolute -bottom-10 left-0 right-0 text-center text-lg font-bold text-black">
                </div>

            </div>
        </div>

        <!-- FORM (still used for backend) -->
        <form id="spinForm" method="POST" action="">
            <input type="hidden" name="spin" value="spin">
            <input type="hidden" id="scoreInput" name="score" value="">
        </form>

    </div>

    

    <!-- TABLE -->
    <div class="mx-auto max-w-3xl overflow-hidden rounded-[30px] border border-red-100 bg-white shadow-xl shadow-red-100">

        <div class="border-b border-red-100 px-6 py-5">
            <h2 class="text-2xl font-bold text-red-600">Recent Winnings</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full">

                <thead class="bg-red-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase text-red-500">Rank</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase text-red-500">Amount</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase text-red-500">Date</th>
                    </tr>
                </thead>

                <tbody>

                <?php
                $sql = $link->prepare("SELECT * FROM userearnings WHERE type='WinCircle' AND username=? ORDER BY id DESC LIMIT 50");
                $sql->bind_param("s", $username);
                $sql->execute();
                $result = $sql->get_result();

                if ($result->num_rows > 0) {
                    $rank = 1;

                    while ($row = $result->fetch_assoc()) {
                ?>

                    <tr class="border-b hover:bg-red-50">
                        <td class="px-6 py-4 font-bold">#<?php echo $rank; ?></td>
                        <td class="px-6 py-4 text-red-600 font-bold">$<?php echo number_format($row['amount'], 2); ?></td>
                        <td class="px-6 py-4 text-gray-500"><?php echo $row['date']; ?></td>
                    </tr>

                <?php
                        $rank++;
                    }
                } else {
                    echo '<tr><td colspan="3" class="text-center py-6 text-gray-400">No recent winnings found.</td></tr>';
                }
                ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- AUDIO -->
<audio id="spinSound" preload="auto">
    <source src="https://assets.mixkit.co/active_storage/sfx/2003/2003-preview.mp3">
</audio>

<audio id="winSound" preload="auto">
    <source src="https://assets.mixkit.co/active_storage/sfx/1435/1435-preview.mp3">
</audio>

<div id="fireworks"></div>

<script>
(function () {

    const canvas = document.getElementById('wheelCanvas');
    const ctx = canvas.getContext('2d');

    const spinBtn = document.getElementById('spinBtn');
    const spinText = document.getElementById('spinText');
    const scoreInput = document.getElementById('scoreInput');
    const spinForm = document.getElementById('spinForm');

    const spinSound = document.getElementById('spinSound');
    const winSound = document.getElementById('winSound');

    const prizes = [
        { spinname: '$2000', color: '#F6E9FF', value: 0 },
        { spinname: '$500', color: '#EAD9FF', value: 0.2 },
        { spinname: '$100', color: '#F6E9FF', value: 1 },
        { spinname: '$5000', color: '#EAD9FF', value: 10 },
        { spinname: '$100', color: '#F6E9FF', value: 50 },
        { spinname: '$1200', color: '#EAD9FF', value: 0 },
        { spinname: '$1000', color: '#F6E9FF', value: 100 },
        { spinname: '$2000', color: '#EAD9FF', value: 0 }
    ];

    const sliceAngle = (2 * Math.PI) / prizes.length;

    let currentRotation = 0;
    let isSpinning = false;
    let animationFrameId = null;

    function drawWheel() {
        const cx = canvas.width / 2;
        const cy = canvas.height / 2;
        const radius = 180;

        ctx.clearRect(0, 0, canvas.width, canvas.height);

        prizes.forEach((p, i) => {
            const start = i * sliceAngle + currentRotation;
            const end = start + sliceAngle;

            ctx.beginPath();
            ctx.moveTo(cx, cy);
            ctx.arc(cx, cy, radius, start, end);
            ctx.closePath();

            ctx.fillStyle = p.color;
            ctx.fill();
            ctx.strokeStyle = "#fff";
            ctx.stroke();

            // TEXT
            ctx.save();
            ctx.translate(cx, cy);
            ctx.rotate(start + sliceAngle / 2);
            ctx.fillStyle = "#000";
            ctx.font = "bold 12px Arial";
            ctx.textAlign = "center";
            ctx.fillText(p.spinname, radius * 0.6, 5);
            ctx.restore();
        });
    }

    function spin() {

        if (isSpinning) return;

        isSpinning = true;
        spinBtn.disabled = true;
        spinText.innerText = "SPINNING...";

        spinSound.play().catch(()=>{});

        const duration = 5000;
        const start = performance.now();
        const extra = Math.random() * 360;
        const total = 360 * 8 + extra;

        const startRot = currentRotation;

        function animate(now) {
            const t = Math.min((now - start) / duration, 1);
            const ease = 1 - Math.pow(1 - t, 3);

            currentRotation = startRot + (total * ease * Math.PI / 180);
            drawWheel();

            if (t < 1) {
                animationFrameId = requestAnimationFrame(animate);
            } else {
                finish();
            }
        }

        function finish() {

            let index = Math.floor(((2 * Math.PI) - (currentRotation % (2 * Math.PI))) / sliceAngle);
            index = index % prizes.length;

            const prize = prizes[index];

            spinText.innerText = "WIN: " + prize.spinname;
            scoreInput.value = prize.value;

            if (prize.value > 0) {
                winSound.play().catch(()=>{});
            }

            isSpinning = false;
            spinBtn.disabled = false;

            setTimeout(() => {
                spinForm.submit();
            }, 500);
        }

        animationFrameId = requestAnimationFrame(animate);
    }

    spinBtn.addEventListener('click', spin);

    drawWheel();

})();
</script>

    <?php include "inc/footer2.php" ?>