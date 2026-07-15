<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require $_SERVER['DOCUMENT_ROOT']."/emmmarmotors/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/includes/generalinclude.php";



$ptitle="Transactions";
include "inc/header2.php" ?>


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

<section class="max-w-4xl mx-auto px-4 space-y-6">

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">
            Transaction History
        </h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
            View and filter all your transactions.
        </p>
    </div>

    <!-- ========================= -->
    <!-- FILTER CARD (always visible) -->
    <!-- ========================= -->
      <div class="bg-white dark:bg-slate-800 overflow-hidden p-5 mb-3">
 
        <!-- Search -->
        <div class="relative mb-4">
            <input
                type="text"
                id="searchInput"
                placeholder="Search transactions"
                class="w-full h-14 pl-12 pr-4 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500">
 
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>
 
        <!-- Filters -->
        <div class="grid grid-cols-2 gap-3">
 
            <input type="date"
                   id="dateFilter"
                   class="w-full h-12 px-3 sm:px-4 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm font-medium min-w-0">
 
            <select id="typeFilter"
                    class="w-full h-12 px-3 sm:px-4 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm font-medium min-w-0">
                <option value="">All Types</option>
 
                <?php
                $types = $link->query("SELECT DISTINCT type FROM userearnings WHERE username='$username' ORDER BY type ASC");
                while($t = $types->fetch_assoc()){
                    echo '<option value="'.htmlspecialchars($t['type']).'">'.htmlspecialchars($t['type']).'</option>';
                }
                ?>
            </select>
 
        </div>
 
    </div>
    <!-- ========================= -->
    <!-- TRANSACTIONS SKELETON -->
    <!-- ========================= -->
    <div id="transactionSkeleton" class="animate-pulse">
        <div class="bg-white dark:bg-slate-800 overflow-hidden">
            <div class="flex items-center justify-between p-5">
                <div class="h-5 w-40 rounded bg-slate-200 dark:bg-slate-700"></div>
                <div class="h-4 w-16 rounded bg-slate-200 dark:bg-slate-700"></div>
            </div>

            <div class="divide-y divide-slate-100 dark:divide-slate-700">
                <?php for ($i = 0; $i < 6; $i++) { ?>
                    <div class="flex items-center justify-between p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl bg-slate-200 dark:bg-slate-700"></div>
                            <div>
                                <div class="h-4 w-32 rounded bg-slate-200 dark:bg-slate-700 mb-2"></div>
                                <div class="h-3 w-20 rounded bg-slate-200 dark:bg-slate-700"></div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="h-4 w-20 rounded bg-slate-200 dark:bg-slate-700 mb-2"></div>
                            <div class="h-5 w-16 rounded-full bg-slate-200 dark:bg-slate-700"></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- ========================= -->
    <!-- TRANSACTIONS CONTENT -->
    <!-- ========================= -->
    <div id="transactionContent" class="skeleton-hidden mb-[80px]">
        <div class="bg-white dark:bg-slate-800 overflow-hidden">

            <?php
            $countStmt = $link->prepare("SELECT COUNT(*) AS total FROM userearnings WHERE username=?");
            $countStmt->bind_param("s", $username);
            $countStmt->execute();
            $totalCount = $countStmt->get_result()->fetch_assoc()['total'];
            ?>


            <div id="transactionList">

                <?php
                $stmt = $link->prepare("SELECT * FROM userearnings WHERE username=? ORDER BY id DESC");
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result = $stmt->get_result();

                if($result->num_rows > 0):

                    $today = (new DateTime())->format('Y-m-d');
                    $yesterday = (new DateTime('yesterday'))->format('Y-m-d');
                    $currentGroup = null;

                    while($row = $result->fetch_assoc()):

                        $type = $row['type'];
                        $amount = (float)$row['amount'];
                        $date = $row['date'];

                        $dateObj = new DateTime($date);

                        $displayTime = $dateObj->format('g:i A');
                        $filterDate = $dateObj->format('Y-m-d');

                        if ($filterDate === $today) {
                            $groupLabel = 'Today';
                        } elseif ($filterDate === $yesterday) {
                            $groupLabel = 'Yesterday';
                        } else {
                            $groupLabel = $dateObj->format('D, M j, Y');
                        }

                        if ($groupLabel !== $currentGroup):
                            if ($currentGroup !== null) {
                                echo '</div>'; // close previous divide-y group
                            }
                            $currentGroup = $groupLabel;
                        ?>

                        <div class="px-5 pt-4 pb-2 text-xs font-semibold uppercase tracking-wide text-slate-400 dark:text-slate-500 bg-slate-50 dark:bg-slate-800/60">
                            <?= htmlspecialchars($groupLabel) ?>
                        </div>
                        <div class="divide-y divide-slate-100 dark:divide-slate-700">

                        <?php endif; ?>

                        <?php
                        $positiveTypes = [
                            'Deposit',
                            'Withdraw',
                            'Bonus',
                            'Commission',
                            'Reward',
                            'Earning',
                            'Income'
                        ];

                        $isCredit = in_array($type, $positiveTypes);

                        $iconBg = $isCredit
                            ? 'bg-green-100 dark:bg-green-900/20'
                            : 'bg-red-100 dark:bg-red-900/20';

                        $iconColor = $isCredit
                            ? 'text-green-600'
                            : 'text-red-600';

                        $iconClass = $isCredit
                            ? 'fa-arrow-down'
                            : 'fa-arrow-up';

                        $amountColor = $isCredit
                            ? 'text-green-600'
                            : 'text-red-600';

                        $amountPrefix = $isCredit ? '+' : '-';

                        $statusClass = $isCredit
                            ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400'
                            : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400';
                        ?>

                        <div
                            class="transaction flex items-center justify-between gap-3 px-5 py-4"
                            data-date="<?= $filterDate ?>"
                            data-type="<?= htmlspecialchars($type) ?>">

                            <div class="flex items-center gap-3 min-w-0">

                                <div class="w-11 h-11 shrink-0 rounded-xl <?= $iconBg ?> flex items-center justify-center">
                                    <i class="fas <?= $iconClass ?> <?= $iconColor ?> text-sm"></i>
                                </div>

                                <div class="min-w-0">
                                    <h4 class="font-medium text-slate-900 dark:text-white truncate">
                                        <?= htmlspecialchars($type) ?>
                                    </h4>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">
                                        <?= htmlspecialchars($displayTime) ?>
                                    </p>
                                </div>

                            </div>

                            <div class="text-right shrink-0">
                                <p class="font-semibold <?= $amountColor ?>">
                                    <?= $amountPrefix ?>₦<?= number_format($amount, 2) ?>
                                </p>

                                <span class="inline-block text-xs <?= $statusClass ?> px-2 py-0.5 rounded-full mt-1">
                                    Completed
                                </span>
                            </div>

                        </div>

                    <?php
                        endwhile;

                        echo '</div>'; // close last divide-y group

                    else:
                    ?>

                    <div id="emptyState" class="p-8 text-center">
                        <i class="fas fa-receipt text-4xl text-slate-300 mb-3"></i>
                        <p class="text-slate-500 dark:text-slate-400">
                            No transactions found.
                        </p>
                    </div>

                    <?php endif; ?>

            </div>

            <div id="noMatchState" class="hidden p-8 text-center">
                <i class="fas fa-receipt text-4xl text-slate-300 mb-3"></i>
                <p class="text-slate-500 dark:text-slate-400">
                    No matching transactions found.
                </p>
            </div>

        </div>
    </div>

</section>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const skeleton = document.getElementById('transactionSkeleton');
    const content = document.getElementById('transactionContent');

    // Simulate load complete / swap skeleton for real content.
    // Replace this timeout with your actual data-ready signal if needed.
    setTimeout(function () {
        if (skeleton) skeleton.style.display = 'none';
        if (content) content.classList.remove('skeleton-hidden');
    }, 500);

    const searchInput = document.getElementById('searchInput');
    const dateFilter = document.getElementById('dateFilter');
    const typeFilter = document.getElementById('typeFilter');

    function filterTransactions() {

        const search = searchInput.value.toLowerCase();
        const date = dateFilter.value;
        const type = typeFilter.value;

        const groups = document.querySelectorAll('#transactionList > .divide-y');

        let visible = 0;

        groups.forEach(group => {

            const header = group.previousElementSibling;
            let groupVisible = 0;

            group.querySelectorAll('.transaction').forEach(item => {

                const text = item.innerText.toLowerCase();
                const itemDate = item.dataset.date;
                const itemType = item.dataset.type;

                let show = true;

                if (search && !text.includes(search)) show = false;
                if (date && itemDate !== date) show = false;
                if (type && itemType !== type) show = false;

                item.style.display = show ? 'flex' : 'none';

                if (show) {
                    groupVisible++;
                    visible++;
                }
            });

            const groupShown = groupVisible > 0;
            group.style.display = groupShown ? 'block' : 'none';
            if (header) header.style.display = groupShown ? 'block' : 'none';
        });

        const noMatchState = document.getElementById('noMatchState');
        if (noMatchState) {
            noMatchState.style.display = visible === 0 ? 'block' : 'none';
        }
    }

    searchInput.addEventListener('keyup', filterTransactions);
    dateFilter.addEventListener('change', filterTransactions);
    typeFilter.addEventListener('change', filterTransactions);

    filterTransactions();
});
</script>

<?php include "inc/footer2.php"?>