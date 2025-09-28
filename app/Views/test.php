<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theme & Language Test</title>
    <style>
        :root {
            --primary-color: #667eea;
            --secondary-color: #764ba2;
            --background-color: #ffffff;
            --surface-color: #f8f9fa;
            --text-primary: #2d3748;
            --text-secondary: #718096;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: var(--background-color);
            color: var(--text-primary);
            padding: 20px;
            transition: all 0.3s ease;
        }

        .test-container {
            max-width: 800px;
            margin: 0 auto;
            background: var(--surface-color);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .theme-demo {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .theme-card {
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .theme-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .theme-card.active {
            border-color: var(--primary-color);
        }

        .theme-light { background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%); }
        .theme-dark { background: linear-gradient(135deg, #121212 0%, #1e1e1e 100%); color: white; }
        .theme-premium { background: radial-gradient(ellipse at top left, #667eea 0%, #764ba2 50%, #f093fb 100%); color: white; }
        .theme-blue { background: linear-gradient(135deg, #2196f3 0%, #21cbf3 100%); color: white; }

        .language-selector {
            margin-bottom: 20px;
        }

        .language-selector select {
            padding: 10px;
            border: 2px solid var(--primary-color);
            border-radius: 5px;
            background: var(--surface-color);
            color: var(--text-primary);
            font-size: 16px;
        }

        .info-box {
            background: var(--primary-color);
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="test-container">
        <h1>Theme & Language Test Page</h1>

        <div class="info-box">
            <strong>Current Session:</strong><br>
            Theme: <?= session()->get('theme') ?? 'light' ?><br>
            Language: <?= session()->get('language') ?? 'en' ?>
        </div>

        <div class="language-selector">
            <label for="language">Select Language:</label>
            <select id="language" onchange="changeLanguage(this.value)">
                <option value="en" <?= (session()->get('language') ?? 'en') === 'en' ? 'selected' : '' ?>>English</option>
                <option value="es" <?= (session()->get('language') ?? 'en') === 'es' ? 'selected' : '' ?>>Español</option>
                <option value="fr" <?= (session()->get('language') ?? 'en') === 'fr' ? 'selected' : '' ?>>Français</option>
            </select>
        </div>

        <h2>Theme Selection:</h2>
        <div class="theme-demo">
            <div class="theme-card theme-light <?= (session()->get('theme') ?? 'light') === 'light' ? 'active' : '' ?>" onclick="selectTheme('light')">
                <h3>Light Theme</h3>
                <p>Clean and bright interface</p>
            </div>
            <div class="theme-card theme-dark <?= (session()->get('theme') ?? 'light') === 'dark' ? 'active' : '' ?>" onclick="selectTheme('dark')">
                <h3>Dark Theme</h3>
                <p>Easy on the eyes</p>
            </div>
            <div class="theme-card theme-premium <?= (session()->get('theme') ?? 'light') === 'premium' ? 'active' : '' ?>" onclick="selectTheme('premium')">
                <h3>Premium Dark</h3>
                <p>Premium gradient theme</p>
            </div>
            <div class="theme-card theme-blue <?= (session()->get('theme') ?? 'light') === 'blue' ? 'active' : '' ?>" onclick="selectTheme('blue')">
                <h3>Ocean Blue</h3>
                <p>Calming blue tones</p>
            </div>
        </div>

        <div id="alertContainer"></div>

        <p><a href="/settings">Go to Settings Page</a></p>
    </div>

    <script>
        function selectTheme(themeKey) {
            // Remove active class from all theme cards
            document.querySelectorAll('.theme-card').forEach(card => {
                card.classList.remove('active');
            });

            // Add active class to selected theme
            event.currentTarget.classList.add('active');

            // Update theme via AJAX
            fetch('/settings/update-theme', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: 'theme=' + themeKey
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    applyTheme(themeKey);
                    showAlert('Theme updated successfully!', 'success');
                } else {
                    showAlert('Failed to update theme', 'danger');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('Failed to update theme', 'danger');
            });
        }

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

                document.body.style.backgroundColor = theme.background;
                document.body.style.color = theme.text;

                sessionStorage.setItem('selectedTheme', themeKey);
            }
        }

        function changeLanguage(language) {
            fetch('/settings/update-language', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: 'language=' + language
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    sessionStorage.setItem('selectedLanguage', language);
                    showAlert('Language updated successfully!', 'success');
                    setTimeout(() => location.reload(), 1000);
                } else {
                    showAlert('Failed to update language', 'danger');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('Failed to update language', 'danger');
            });
        }

        function showAlert(message, type = 'info') {
            const alertContainer = document.getElementById('alertContainer');
            const alert = document.createElement('div');
            alert.className = `alert alert-${type}`;
            alert.style.cssText = `
                padding: 10px 15px;
                margin-bottom: 15px;
                border-radius: 5px;
                ${type === 'success' ? 'background: #d4edda; color: #155724; border: 1px solid #c3e6cb;' : ''}
                ${type === 'danger' ? 'background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;' : ''}
            `;
            alert.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'}"></i>
                ${message}
            `;

            alertContainer.appendChild(alert);

            setTimeout(() => {
                if (alert.parentNode) {
                    alert.remove();
                }
            }, 5000);
        }

        // Apply saved theme on page load
        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = sessionStorage.getItem('selectedTheme') || '<?= session()->get('theme') ?? 'light' ?>';
            if (savedTheme && savedTheme !== 'light') {
                applyTheme(savedTheme);
            }
        });
    </script>
</body>
</html>