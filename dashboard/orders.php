<?php 
require $_SERVER['DOCUMENT_ROOT']."/emmmarmotors/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/includes/generalinclude.php";


$ptitle="My Orders";
include "inc/header2.php" ;



?>


<div class="pt-20">

    <!-- HEADER -->
    <div class="fixed top-0 left-1/2 z-50 w-full -translate-x-1/2">

        <div class="flex items-center justify-between
                    border border-white/40 dark:border-slate-700/50
                    bg-white/70 dark:bg-slate-900/70
                   
                    px-4 py-3">

            <!-- Back Button -->
            <div class="w-10">

                <a href="javascript:history.back()"
                   class="flex h-9 w-9 items-center justify-center rounded-full
                          bg-white/80 dark:bg-slate-800/80
                          text-[#2f4f4e] dark:text-yellow-400
                          backdrop-blur-md
                          transition-all duration-300
                          hover:scale-105
                          hover:bg-white
                          dark:hover:bg-slate-700">

                    <i class="bi bi-chevron-left text-sm"></i>

                </a>

            </div>

          
            <!-- Right Spacer -->
            <div class="w-10"></div>

        </div>

    </div>

</div>


   <!-- ================= Tabs ================= -->
<div class="flex justify-center gap-3 flex-wrap my-5 mt-[80px]">

    <button
        class="tab-btn active-tab px-4 py-2 rounded-md border border-[#1a3332] text-[#1a3332] font-semibold text-sm bg-white shadow-sm hover:bg-[#1a3332] hover:text-white transition hover:-translate-y-1
         hover:rotate-[-2deg]
         active:scale-95"
        data-level="active"
    >
        Active Product
    </button>

    <button
        class="tab-btn px-4 py-2 rounded-md border border-gray-300 text-gray-700 font-semibold text-sm bg-white shadow-sm hover:bg-[#1a3332] hover:text-white hover:border-[#1a3332] transition hover:-translate-y-1
         hover:rotate-[-2deg]
         active:scale-95"
        data-level="expired"
    >
        Expired Product
    </button>

</div>

<!-- ================= Contract Sections ================= -->
<div class="max-w-6xl mx-auto px-3">

<?php
$statuss = ['active', 'expired'];

foreach ($statuss as $index => $status) {
?>

    <div
        id="status-<?php echo strtolower($status); ?>"
        class="grid grid-cols-1 md:grid-cols-2 gap-5 <?php echo $index === 0 ? '' : 'hidden'; ?>"
    >

        <?php
        $sql = $link->prepare("
            SELECT * 
            FROM user_investments 
            WHERE username = ? AND status = ? 
            ORDER BY id DESC
        ");
        $sql->bind_param("ss", $username, $status);
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {

                $id = $row['id'];
                $daily = $row['daily'];
                $price = $row['price'];
                $title = $row['title'];
                $date = $row['date'];
                $expiration_date = $row['expiration_date'];
                $image = $row['image'];
                $statusValue = $row['status'];

                $statusColor = ($statusValue === "active")
                    ? "text-green-600 bg-green-50"
                    : "text-red-500 bg-red-100";
        ?>

        <!-- ================= Card ================= -->
        <div class="border border-[#1a3332] bg-[#FEFBEF] rounded-2xl transition-all duration-300 p-4 flex flex-col items-center gap-4 text-center">

            <!-- IMAGE -->
            <div class="w-full relative">
                <div class="absolute inset-0 bg-gradient-to-t from-red-50 to-transparent rounded-xl"></div>

                <img
                    src="/dashboard/img/invest/<?php echo htmlspecialchars($image); ?>"
                    alt="<?php echo $title; ?>"
                    class="w-full h-40 object-contain rounded-xl bg-gray-50 p-2 relative z-10"
                >
            </div>

            <!-- TITLE -->
            <h3 class="text-base font-bold text-gray-900">
                <?php echo $title; ?>
            </h3>

            <!-- DETAILS -->
            <div class="w-full space-y-2 text-sm">

                <div class="flex justify-between border-b border-gray-100 pb-1">
                    <span class="text-gray-500">Price</span>
                    <span class="font-semibold text-[#1a3332]">
                        ₦<?php echo number_format($price); ?>
                    </span>
                </div>

                <div class="flex justify-between border-b border-gray-100 pb-1">
                    <span class="text-gray-500">Date Bought</span>
                    <span class="font-semibold text-gray-800">
                        <?php echo htmlspecialchars($date); ?>
                    </span>
                </div>

                <div class="flex justify-between border-b border-gray-100 pb-1">
                    <span class="text-gray-500">Expiration Date</span>
                    <span class="font-semibold text-gray-800">
                        <?php echo htmlspecialchars($expiration_date); ?>
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-500">Plan Status</span>
                    <span class="font-semibold px-2 py-1 rounded-lg text-xs uppercase <?php echo $statusColor; ?>">
                        <?php echo htmlspecialchars($statusValue); ?>
                    </span>
                </div>

            </div>
        </div>
        <!-- ================= End Card ================= -->

        <?php
            }
        } else {
            echo "<p class='col-span-full text-center text-gray-400 text-sm'>No plans found for $status.</p>";
        }
        ?>

    </div>

<?php } ?>

</div>

<!-- ================= JS (Tabs) ================= -->
<script>
document.querySelectorAll(".tab-btn").forEach(button => {
    button.addEventListener("click", () => {

        document.querySelectorAll(".tab-btn").forEach(btn => {
            btn.classList.remove("bg-[#1a3332]", "text-white", "border-[#1a3332]");
            btn.classList.add("bg-white", "text-gray-700", "border-gray-300");
        });

        button.classList.add("bg-[#1a3332]", "text-white", "border-[#1a3332]");
        button.classList.remove("bg-white", "text-gray-700", "border-gray-300");

        document.querySelectorAll("[id^='status-']").forEach(grid => {
            grid.classList.add("hidden");
        });

        const level = button.dataset.level;
        document.getElementById(`status-${level}`).classList.remove("hidden");
    });
});
</script>

<?php include "inc/footer2.php" ?>