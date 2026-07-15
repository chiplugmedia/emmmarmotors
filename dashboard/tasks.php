<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require $_SERVER['DOCUMENT_ROOT']."/invest/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/actions/tasks.php";

$ptitle="Daily Tasks";

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


<div><?php echo $genMsg?></div>
           
   <?php
// Fetch tasks for the user
$sql = $link->prepare("
    SELECT * FROM dailytasks 
    WHERE reference NOT IN (
        SELECT reference FROM usertasks WHERE username=?
    ) 
    AND SUBSTRING(date, 1, 10) = ?
");
$sql->bind_param("ss", $username, $date);
$sql->execute();
$result  = $sql->get_result();
$numrows = $result->num_rows;

if ($numrows > 0):
    while ($row = $result->fetch_assoc()):
        $title     = htmlspecialchars($row['title']);
        $desc      = htmlspecialchars($row['description']);
        $amount    = htmlspecialchars($row['amount']);
        $reference = htmlspecialchars($row['reference']);
        $url       = htmlspecialchars($row['url']);
        $status    = $row['status'];
        $type      = $row['type'];
        $id        = $row['id'];
        $datenow   = $row['date'];

        // ── Image based on type ────────────────────────────────────────
        $imageMap = [
            'facebook'  => 'facebook.png',
            'instagram' => 'instagram.png',
            'twitter'   => 'twitter.png',
            'youtube'   => 'youtube.png',
        ];
        $image = $imageMap[$type] ?? 'default.png';

        // ── Status color ───────────────────────────────────────────────
        $statusColorMap = [
            'active'    => 'success',
            'completed' => 'danger',
        ];
        $statusColor = $statusColorMap[$status] ?? 'secondary';
?>

<!-- ── TASK CARD ──────────────────────────────────────────────────── -->
<section class="max-w-7xl mx-auto px-4 mt-[80px]">
    <div class="mb-4">
        <div onclick="openModal('modal<?= $id ?>')"
             class="flex items-center justify-between p-4 bg-white rounded-xl shadow hover:shadow-md cursor-pointer transition">

            <!-- Left: Icon + Info -->
            <div class="flex items-center gap-3">
                <img src="/home/img/<?= $image ?>"
                     class="w-12 h-12 rounded-lg object-cover"
                     alt="<?= htmlspecialchars($type) ?>">

                <div>
                    <p class="text-sm font-semibold text-gray-800"><?= $title ?></p>
                    <p class="text-xs text-gray-500"><?= htmlspecialchars($datenow) ?></p>
                </div>
            </div>

            <!-- Right: Amount -->
            <div class="text-green-600 font-bold text-sm">
                XAF <?= $amount ?>
            </div>

        </div>
    </div>
</section>

<!-- ── MODAL ──────────────────────────────────────────────────────── -->
<div id="modal<?= $id ?>" 
     class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="bg-white w-[90%] max-w-md rounded-xl p-6 relative">

        <!-- Close Button -->
        <button onclick="closeModal('modal<?= $id ?>')"
                class="absolute top-3 right-3 text-gray-500 hover:text-black text-lg">
            ✕
        </button>

        <!-- Title -->
        <h2 class="text-lg font-semibold mb-3"><?= $title ?></h2>

        <!-- Description -->
        <p class="text-gray-600 text-sm mb-5"><?= $desc ?></p>

        <!-- Amount Badge -->
        <div class="mb-4 text-center">
            <span class="bg-green-100 text-green-700 font-bold text-sm px-4 py-1 rounded-full">
                + XAF <?= $amount ?>
            </span>
        </div>

        <!-- Actions -->
        <div class="flex justify-between gap-3">

            <button onclick="closeModal('modal<?= $id ?>')"
                    class="w-1/2 py-2 rounded-lg bg-red-500 text-white text-sm hover:bg-red-600">
                Close
            </button>

            <form method="POST" class="w-1/2">
                <input type="hidden" name="reference" value="<?= $reference ?>">
                <input type="hidden" name="url"       value="<?= $url ?>">

                <button type="submit" name="addTask"
                        class="w-full py-2 rounded-lg bg-green-500 text-white text-sm hover:bg-green-600">
                    ✅ Complete
                </button>
            </form>

        </div>

    </div>
</div>

<?php
    endwhile;
else:
?>

<!-- ── EMPTY STATE ────────────────────────────────────────────────── -->
<div class="max-w-md mx-auto mt-6 px-4 mt-[80px] ">
    <div class="bg-red-100 text-white-800 p-4 rounded-lg text-center font-medium">
        No tasks available at the moment, check back later.
    </div>
</div>

<?php endif; ?>

<!-- ── MODAL SCRIPTS ──────────────────────────────────────────────── -->
<script>
    function openModal(id) {
        const modal = document.getElementById(id);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal(id) {
        const modal = document.getElementById(id);
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>


<?php include "inc/footer2.php" ?>