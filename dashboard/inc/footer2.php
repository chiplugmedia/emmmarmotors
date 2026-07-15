
<?php
$currentPage = basename($_SERVER['PHP_SELF'], '.php');
?>

<!-- FOOTER -->
<footer
class="fixed bottom-0 left-0 w-full
       bg-white/95 dark:bg-slate-900/95
       backdrop-blur-xl
       border-t border-slate-200 dark:border-slate-700
       shadow-xl
       px-5 py-3
       transition-all duration-300
       z-40
       md:hidden">

    <div class="flex items-center justify-between max-w-7xl mx-auto">
 <!-- Home -->
        <a href="index"
           class="flex flex-col items-center gap-1 transition
           <?= ($currentPage == 'index' || $currentPage == '')
                ? 'text-blue-600 dark:text-blue-400'
                : 'text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400' ?>">
            <i class="fas fa-home text-lg"></i>
            <span class="text-[10px] font-medium">Home</span>
        </a>

        <!-- Plans -->
        <a href="orders"
           class="flex flex-col items-center gap-1 transition
           <?= $currentPage == 'orders'
                ? 'text-blue-600 dark:text-blue-400'
                : 'text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400' ?>">
           <i class="fas fa-layer-group text-lg"></i>
            <span class="text-[10px]">Plans</span>
        </a>

        <!-- Product -->
        <a href="product"
           class="flex flex-col items-center gap-1 transition
           <?= $currentPage == 'product'
                ? 'text-blue-600 dark:text-blue-400'
                : 'text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400' ?>">
            <i class="fas fa-box text-lg"></i>
            <span class="text-[10px]">Product</span>
        </a>

       

        <!-- Transactions -->
        <a href="transaction"
           class="flex flex-col items-center gap-1 transition
           <?= $currentPage == 'transaction'
                ? 'text-blue-600 dark:text-blue-400'
                : 'text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400' ?>">
            <i class="fas fa-arrow-right-arrow-left text-lg"></i>
            <span class="text-[10px]">Transactions</span>
        </a>

        <!-- Menu -->
        <a href="menu"
           class="flex flex-col items-center gap-1 transition
           <?= $currentPage == 'menu'
                ? 'text-blue-600 dark:text-blue-400'
                : 'text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400' ?>">
            <i class="fas fa-user text-lg"></i>
            <span class="text-[10px]">Account</span>
        </a>

    </div>

</footer>

<script>
    window.addEventListener('load', function() {
        const loader = document.getElementById('pageLoader');
        const content = document.getElementById('pageContent');
        
        setTimeout(function() {
            if (loader) loader.classList.add('hide');
            if (content) content.classList.add('visible');
        }, 500);
    });
</script>
<script src="/emmmarmotors/emma/js/script.js"></script>
<script src="/emmmarmotors/emma/js/button.js"></script>

     <script src="/emmmarmotors/mysite/sweet/sweet.js"></script>
     
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
</body>
</html>
