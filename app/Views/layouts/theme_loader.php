<!-- Theme and Language Loader -->
<script>
// Apply saved theme and language on page load
document.addEventListener('DOMContentLoaded', function() {
    // Apply saved theme
    const savedTheme = sessionStorage.getItem('selectedTheme') || 'light';
    const savedLanguage = sessionStorage.getItem('selectedLanguage') || 'en';

    if (savedTheme && savedTheme !== 'light') {
        applyTheme(savedTheme);
    }

    if (savedLanguage && savedLanguage !== 'en') {
        applyLanguage(savedLanguage);
    }

    // Apply theme to current page
    function applyTheme(themeKey) {
        const themes = {
            'light': {
                'primary': '#667eea',
                'secondary': '#764ba2',
                'background': '#ffffff',
                'surface': '#f8f9fa',
                'text': '#2d3748'
            },
            'dark': {
                'primary': '#bb86fc',
                'secondary': '#9d4edd',
                'background': '#121212',
                'surface': '#1e1e1e',
                'text': '#ffffff'
            },
            'premium': {
                'primary': '#667eea',
                'secondary': '#764ba2',
                'background': 'radial-gradient(ellipse at top left, #667eea 0%, #764ba2 50%, #f093fb 100%)',
                'surface': 'rgba(255, 255, 255, 0.05)',
                'text': '#ffffff'
            },
            'blue': {
                'primary': '#2196f3',
                'secondary': '#21cbf3',
                'background': 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
                'surface': 'rgba(255, 255, 255, 0.1)',
                'text': '#ffffff'
            }
        };

        const theme = themes[themeKey];
        if (theme) {
            const root = document.documentElement;
            root.style.setProperty('--primary-color', theme.primary);
            root.style.setProperty('--secondary-color', theme.secondary);
            root.style.setProperty('--background-color', theme.background);
            root.style.setProperty('--surface-color', theme.surface);
            root.style.setProperty('--text-primary', theme.text);
            root.style.setProperty('--text-secondary', theme.text);

            // Apply theme class to body
            document.body.className = document.body.className.replace(/theme-\w+/g, '');
            document.body.classList.add(`theme-${themeKey}`);
        }
    }

    // Apply language to current page
    function applyLanguage(language) {
        document.documentElement.setAttribute('lang', language);
        document.documentElement.setAttribute('dir', language === 'ar' ? 'rtl' : 'ltr');

        // Update page content with new language if translations are available
        if (typeof updatePageContent === 'function') {
            updatePageContent(language);
        }
    }
});
</script>