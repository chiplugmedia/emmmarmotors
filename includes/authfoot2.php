  
<script>
setTimeout(() => {
    document.querySelectorAll('.toast').forEach(t => t.remove());
}, 5000);
</script>
     <script src="/emmmarmotors/mysite/sweet/sweet.js"></script>

   

<script>
// Automatically follow device theme preference
function applyDeviceTheme() {
    const isDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
    
    if (isDarkMode) {
        document.documentElement.classList.add('dark');
        document.documentElement.classList.remove('light');
        
        // Update indicator icon if it exists
        const indicatorIcon = document.getElementById('themeIndicatorIcon');
        if (indicatorIcon) {
            indicatorIcon.className = 'fas fa-moon ml-2';
        }
    } else {
        document.documentElement.classList.add('light');
        document.documentElement.classList.remove('dark');
        
        // Update indicator icon if it exists
        const indicatorIcon = document.getElementById('themeIndicatorIcon');
        if (indicatorIcon) {
            indicatorIcon.className = 'fas fa-sun ml-2';
        }
    }
}

// Initialize
applyDeviceTheme();

// Listen for system theme changes
window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', applyDeviceTheme);

// Clear any manual overrides
localStorage.removeItem('theme');

// Optional: Remove any existing theme classes on page load
document.documentElement.classList.remove('light', 'dark');
applyDeviceTheme();
</script>

<script>
tailwind.config = {
    darkMode: 'class'
}
</script>

</body>
</html>