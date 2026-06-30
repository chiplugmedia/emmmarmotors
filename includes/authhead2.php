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
 <link rel="stylesheet" href="/invest/mysite/sweet/sweet.css">
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
    
    <style>
 
::-webkit-scrollbar {
  display: none;
}

/* Mobile first */
.app-wrapper {
  max-width: 480px;
  margin: 0 auto;
  min-height: 100vh;
  position: relative;
  padding-bottom: 80px;
}

/* Tablet */
@media (min-width: 640px) {
  .app-wrapper {
    max-width: 720px;
  }
}

/* Desktop */
@media (min-width: 1024px) {
  .app-wrapper {
    max-width: 1100px;
  }
}

.chat-drawer {
  transform: translateX(100%);
  transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.chat-drawer.active {
  transform: translateX(0);
}

@keyframes scaleIn {
  from {
    opacity: 0;
    transform: scale(0.9);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

.scale-in-center {
  animation: scaleIn 0.2s ease-out;
}

@keyframes float-y {
  0%, 100% {
    transform: translateY(0px);
  }
  50% {
    transform: translateY(-8px);
  }
}

.animate-float {
  animation: float-y 3s ease-in-out infinite;
}

    </style>
</head>
<body>


<style>
    body, html { overflow-x: hidden; max-width: 100vw; background-color: #FEFBEF !important; }
    
    @keyframes float-y {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
        100% { transform: translateY(0px); }
    }
    
    .animate-float {
        animation: float-y 3s ease-in-out infinite;
    }
</style>
<!-- loader.php -->
<!-- Page Loader with Pure Tailwind CSS -->
<div id="pageLoader" class="fixed inset-0 bg-white dark:bg-black flex items-center justify-center z-[9999] transition-all duration-500 ease-in-out">
    <div class="text-center animate-[fadeInUp_0.6s_ease]">
        <!-- Logo -->
        <div class="w-20 h-20 mx-auto mb-5 animate-[pulse_1.5s_ease-in-out_infinite]">
            <img src="/mysite/WAX.png" alt="<?php echo htmlspecialchars($sitename); ?>" class="w-full h-full object-cover rounded-2xl shadow-lg dark:shadow-2xl">
        </div>
        
        <!-- Spinner -->
        <div class="w-12 h-12 mx-auto my-5 border-4 border-gray-200 dark:border-gray-700 border-t-[#052da7] dark:border-t-blue-400 rounded-full animate-spin"></div>
        
        <!-- Loading Text -->
        <div class="text-[#052da7] dark:text-gray-100 text-sm font-medium tracking-wide mt-4">
            <?php echo isset($loaderText) ? htmlspecialchars($loaderText) : 'Loading'; ?>
            <span class="inline-flex gap-1 ml-1">
                <span class="w-1 h-1 bg-[#052da7] dark:bg-black rounded-full animate-[bounce_1.4s_ease-in-out_infinite] [animation-delay:0s]"></span>
                <span class="w-1 h-1 bg-[#052da7] dark:bg-black rounded-full animate-[bounce_1.4s_ease-in-out_infinite] [animation-delay:0.2s]"></span>
                <span class="w-1 h-1 bg-[#052da7] dark:bg-black rounded-full animate-[bounce_1.4s_ease-in-out_infinite] [animation-delay:0.4s]"></span>
            </span>
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
 <!-- Optional: Display current theme badge (read-only) -->
<div class="fixed top-4 right-4 z-50 flex items-center gap-2
            bg-white dark:bg-black
            border border-gray-300 dark:border-gray-700
            text-[#052da7] dark:text-white
            px-4 py-2 rounded-xl shadow-lg
            opacity-75 pointer-events-none">
    
    <i class="fas fa-mobile-alt"></i>
    <span>Auto Theme</span>
    
    <i id="themeIndicatorIcon" class="fas fa-moon ml-2"></i>

</div> 