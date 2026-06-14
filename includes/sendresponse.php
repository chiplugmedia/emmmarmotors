<?php
ob_start();
$response = "";

function sendResponse($status, $message) {
    global $response;
    
    // Status-based configurations
    $config = [
        'success' => [
            'title' => 'Success',
            'icon_color' => '#10b981',
            'bg_color' => '#ecfdf5',
            'border_color' => '#10b981',
            'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
            </svg>'
        ],
        'error' => [
            'title' => 'Error',
            'icon_color' => '#ef4444',
            'bg_color' => '#fef2f2',
            'border_color' => '#ef4444',
            'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z" clip-rule="evenodd" />
            </svg>'
        ],
        'warning' => [
            'title' => 'Warning',
            'icon_color' => '#f59e0b',
            'bg_color' => '#fffbeb',
            'border_color' => '#f59e0b',
            'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
            </svg>'
        ],
        'info' => [
            'title' => 'Information',
            'icon_color' => '#3b82f6',
            'bg_color' => '#eff6ff',
            'border_color' => '#3b82f6',
            'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 01.67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 11-.671-1.34l.041-.022zM12 9a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
            </svg>'
        ]
    ];
    
    if (!isset($config[$status])) {
        $status = 'info';
    }
    
    $config = $config[$status];
    
    $response = '
    <div class="alert-toast alert-toast--' . $status . '" id="alert-toast-' . uniqid() . '">
        <div class="alert-toast__container">
            <div class="alert-toast__icon" style="color: ' . $config['icon_color'] . ';">
                ' . $config['icon_svg'] . '
            </div>
            <div class="alert-toast__content">
                <div class="alert-toast__title">' . $config['title'] . '</div>
                <div class="alert-toast__message">' . htmlspecialchars($message) . '</div>
            </div>
            <button class="alert-toast__close" onclick="closeAlert(this)">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd" />
                </svg>
            </button>
            <div class="alert-toast__progress"></div>
        </div>
    </div>';
    
    return $response;
}
?>