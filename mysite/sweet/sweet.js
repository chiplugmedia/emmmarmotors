// Auto-dismiss after 5 seconds
setTimeout(() => {
    const alerts = document.querySelectorAll('.alert-toast');
    alerts.forEach(alert => {
        if (!alert.classList.contains('alert-toast--closing')) {
            closeAlert(alert.querySelector('.alert-toast__close'));
        }
    });
}, 5000);

function closeAlert(closeButton) {
    const alert = closeButton.closest('.alert-toast');
    if (alert) {
        alert.classList.add('alert-toast--closing');
        setTimeout(() => {
            alert.remove();
        }, 300); // Match animation duration
    }
}

// Optional: Close on click anywhere on alert (except close button)
document.addEventListener('click', function(e) {
    const alert = e.target.closest('.alert-toast');
    const closeBtn = e.target.closest('.alert-toast__close');
    
    if (alert && !closeBtn) {
        // Clicked on alert but not close button - you could add custom behavior here
    }
});