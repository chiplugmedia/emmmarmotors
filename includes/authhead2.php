<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebApplication">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <title><?php echo $ptitle?> - <?php echo $sitename ?></title>
    <meta name="title" content="<?php echo $ptitle?> - <?php echo $sitename ?>">
    <meta name="description" content="<?php echo $ptitle?> - <?php echo $sitename ?>">
    <meta name="keywords" content="<?php echo $ptitle?> - <?php echo $sitename ?>">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <meta name="language" content="English">
    <meta name="author" content="Chi Plug Media">
 <link rel="stylesheet" href="/emmmarmotors/mysite/sweet/sweet.css">
    <meta property="og:type" content="website"> 
    <meta property="og:url" content="/">
    <meta property="og:title" content="<?php echo $sitename ?>">
    <meta property="og:description" content="<?php echo $sitename ?>">
    <meta property="og:image" content="assets/img/share_preview.jpg">
    <meta property="og:site_name" content="<?php echo $sitename ?>"> 

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="/">
    <meta property="twitter:title" content="<?php echo $sitename ?>">
    <meta property="twitter:description" content="<?php echo $sitename ?>">
    <meta property="twitter:image" content="assets/img/share_preview.jpg">
 
    <meta name="theme-color" content="#f97316"> <meta name="msapplication-navbutton-color" content="#f97316">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-capable" content="yes">
    
    <link rel="icon" type="image/png" href="/romixa/Redidd B.png">

    <script src="https://cdn.tailwindcss.com"></script>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    
</head>
<body>
<!-- loader.php -->
<div id="pageLoader" class="fixed inset-0 bg-white dark:bg-black flex items-center justify-center z-[9999] transition-all duration-500 ease-in-out">
    <div class="text-center animate-[fadeInUp_0.6s_ease]">

        <!-- Logo -->
        <div class="w-20 h-20 mx-auto mb-5 animate-[pulse_1.5s_ease-in-out_infinite]">

            <!-- Light Mode Logo -->
            <img src="/emmmarmotors/emma/img/emmalightmood.png"
                 alt="<?php echo htmlspecialchars($sitename); ?>"
                 class="w-full h-full object-cover rounded-2xl shadow-lg block dark:hidden">

            <!-- Dark Mode Logo -->
            <img src="/emmmarmotors/emma/img/emmadarkmood.png"
                 alt="<?php echo htmlspecialchars($sitename); ?>"
                 class="w-full h-full object-cover rounded-2xl shadow-2xl hidden dark:block">

        </div>

        <!-- Straight Line Loader -->
        <div class="w-40 h-1 mx-auto my-5 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden relative">
            <span class="absolute top-0 left-0 h-full w-1/3 bg-[#052da7] dark:bg-blue-400 rounded-full animate-[lineLoader_1.2s_ease-in-out_infinite]"></span>
        </div>

        
    </div>
</div>

<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes bounce {
        0%, 80%, 100% { transform: scale(0); }
        40% { transform: scale(1); }
    }
    
    /* Straight line loader: slides forward then back */
    @keyframes lineLoader {
        0% {
            left: -33%;
        }
        50% {
            left: 66%;
        }
        100% {
            left: -33%;
        }
    }
    
    #pageLoader.hide {
        opacity: 0;
        visibility: hidden;
    }
    
    .page-content {
        opacity: 0;
        transition: opacity 0.5s ease;
    }
    
    .page-content.visible {
        opacity: 1;
    }
</style>
