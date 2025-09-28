<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= $title ?? 'Settings' ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Settings CSS -->
<style>
    :root {
        /* Theme Variables */
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --warning-gradient: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        --danger-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);

        /* Enhanced Shadows */
        --shadow-xs: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        --shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        --shadow-3xl: 0 35px 60px -12px rgba(0, 0, 0, 0.3);

        /* Professional Borders */
        --border-radius: 24px;
        --border-radius-lg: 32px;
        --border-radius-sm: 16px;
        --border-radius-xs: 8px;
    }

    .settings-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .settings-header {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 40px;
        border-radius: var(--border-radius);
        margin-bottom: 30px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .settings-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.05)"/><circle cx="10" cy="60" r="0.5" fill="rgba(255,255,255,0.05)"/><circle cx="90" cy="40" r="0.5" fill="rgba(255,255,255,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.3;
    }

    .settings-header h1 {
        font-size: 2.5rem;
        font-weight: 900;
        margin-bottom: 10px;
        position: relative;
        z-index: 2;
    }

    .settings-header p {
        font-size: 1.1rem;
        opacity: 0.9;
        position: relative;
        z-index: 2;
    }

    .settings-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-bottom: 30px;
    }

    .settings-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: var(--border-radius);
        padding: 30px;
        box-shadow: var(--shadow-lg);
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
    }

    .settings-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-xl);
    }

    .settings-card h3 {
        font-size: 1.3rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .settings-card h3 i {
        color: #667eea;
    }

    .theme-options {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .theme-option {
        border: 2px solid rgba(102, 126, 234, 0.1);
        border-radius: var(--border-radius-sm);
        padding: 20px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .theme-option::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, transparent 0%, rgba(102, 126, 234, 0.05) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .theme-option:hover::before,
    .theme-option.active::before {
        opacity: 1;
    }

    .theme-option:hover,
    .theme-option.active {
        border-color: rgba(102, 126, 234, 0.4);
        transform: translateY(-3px);
        box-shadow: var(--shadow-lg);
    }

    .theme-option.active {
        border-color: #667eea;
        background: rgba(102, 126, 234, 0.05);
    }

    .theme-preview {
        height: 60px;
        border-radius: var(--border-radius-xs);
        margin-bottom: 15px;
        position: relative;
        overflow: hidden;
    }

    .theme-preview.light {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border: 1px solid #e9ecef;
    }

    .theme-preview.dark {
        background: linear-gradient(135deg, #121212 0%, #1e1e1e 100%);
        border: 1px solid #333;
    }

    .theme-preview.premium {
        background: radial-gradient(ellipse at top left, #667eea 0%, #764ba2 50%, #f093fb 100%);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .theme-preview.blue {
        background: linear-gradient(135deg, #2196f3 0%, #21cbf3 100%);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .theme-name {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 5px;
    }

    .theme-description {
        font-size: 0.85rem;
        color: #718096;
    }

    .theme-option.active .theme-name {
        color: #667eea;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 8px;
    }

    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid rgba(102, 126, 234, 0.1);
        border-radius: var(--border-radius-xs);
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.8);
    }

    .form-control:focus {
        outline: none;
        border-color: rgba(102, 126, 234, 0.4);
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        background: #fff;
    }

    .form-check {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px;
        border-radius: var(--border-radius-xs);
        transition: background-color 0.3s ease;
    }

    .form-check:hover {
        background: rgba(102, 126, 234, 0.05);
    }

    .form-check-input {
        width: 18px;
        height: 18px;
        margin: 0;
    }

    .form-check-label {
        font-weight: 500;
        color: #2d3748;
        cursor: pointer;
    }

    .settings-actions {
        display: flex;
        gap: 15px;
        justify-content: flex-end;
        margin-top: 30px;
        padding-top: 30px;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
    }

    .btn {
        padding: 12px 24px;
        border: none;
        border-radius: var(--border-radius-xs);
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-primary {
        background: var(--primary-gradient);
        color: white;
        box-shadow: var(--shadow-md);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
        color: white;
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background: #5a6268;
        color: white;
        transform: translateY(-2px);
    }

    .btn-danger {
        background: var(--danger-gradient);
        color: white;
    }

    .btn-danger:hover {
        transform: translateY(-2px);
        color: white;
    }

    .alert {
        padding: 15px 20px;
        border-radius: var(--border-radius-xs);
        margin-bottom: 20px;
        border: 1px solid transparent;
    }

    .alert-success {
        background: rgba(67, 233, 123, 0.1);
        color: #38a169;
        border-color: rgba(67, 233, 123, 0.3);
    }

    .alert-danger {
        background: rgba(250, 112, 154, 0.1);
        color: #c53030;
        border-color: rgba(250, 112, 154, 0.3);
    }

    .loading {
        opacity: 0.6;
        pointer-events: none;
    }

    .spinner {
        display: inline-block;
        width: 16px;
        height: 16px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 1s ease-in-out infinite;
        margin-right: 8px;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    @media (max-width: 768px) {
        .settings-grid {
            grid-template-columns: 1fr;
        }

        .theme-options {
            grid-template-columns: 1fr;
        }

        .settings-header {
            padding: 30px 20px;
        }

        .settings-header h1 {
            font-size: 2rem;
        }
    }
</style>

<div class="settings-container">
    <!-- Settings Header -->
     <div class="settings-header">
         <h1><i class="fas fa-cog"></i> <?= lang('Settings.header_title') ?></h1>
         <p><?= lang('Settings.header_subtitle') ?></p>
     </div>

    <!-- Success/Error Messages -->
    <div id="alertContainer"></div>

    <div class="settings-grid">
        <!-- Theme Settings -->
        <div class="settings-card">
            <h3><i class="fas fa-palette"></i> <?= lang('Settings.theme_settings') ?></h3>
            <p class="text-muted mb-4"><?= lang('Settings.theme_description') ?></p>

            <div class="theme-options">
                <?php foreach ($themes as $key => $theme): ?>
                    <div class="theme-option <?= $current_theme === $key ? 'active' : '' ?>"
                         data-theme="<?= $key ?>"
                         onclick="selectTheme('<?= $key ?>')">
                        <div class="theme-preview <?= $key ?>"></div>
                        <div class="theme-name"><?= $theme['name'] ?></div>
                        <div class="theme-description"><?= $theme['description'] ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- General Settings -->
        <div class="settings-card">
            <h3><i class="fas fa-sliders-h"></i> <?= lang('Settings.general_settings') ?></h3>
            <form id="settingsForm">
                <div class="form-group">
                    <label class="form-label"><?= lang('Settings.site_name') ?></label>
                    <input type="text" class="form-control" name="site_name"
                           value="<?= $settings['site_name'] ?? 'CI4 Management System' ?>">
                </div>

                <div class="form-group">
                    <label class="form-label"><?= lang('Settings.admin_email') ?></label>
                    <input type="email" class="form-control" name="admin_email"
                           value="<?= $settings['admin_email'] ?? 'admin@example.com' ?>">
                </div>

                <div class="form-group">
                    <label class="form-label"><?= lang('Settings.items_per_page') ?></label>
                    <input type="number" class="form-control" name="items_per_page"
                           value="<?= $settings['items_per_page'] ?? 10 ?>" min="5" max="100">
                </div>

                <div class="form-group">
                    <label class="form-label"><?= lang('Settings.timezone') ?></label>
                    <select class="form-control" name="timezone">
                        <option value="UTC" <?= ($settings['timezone'] ?? 'UTC') === 'UTC' ? 'selected' : '' ?>><?= lang('Settings.timezone_utc') ?></option>
                        <option value="America/New_York" <?= ($settings['timezone'] ?? 'UTC') === 'America/New_York' ? 'selected' : '' ?>><?= lang('Settings.timezone_eastern') ?></option>
                        <option value="America/Chicago" <?= ($settings['timezone'] ?? 'UTC') === 'America/Chicago' ? 'selected' : '' ?>><?= lang('Settings.timezone_central') ?></option>
                        <option value="America/Denver" <?= ($settings['timezone'] ?? 'UTC') === 'America/Denver' ? 'selected' : '' ?>><?= lang('Settings.timezone_mountain') ?></option>
                        <option value="America/Los_Angeles" <?= ($settings['timezone'] ?? 'UTC') === 'America/Los_Angeles' ? 'selected' : '' ?>><?= lang('Settings.timezone_pacific') ?></option>
                        <option value="Europe/London" <?= ($settings['timezone'] ?? 'UTC') === 'Europe/London' ? 'selected' : '' ?>><?= lang('Settings.timezone_london') ?></option>
                        <option value="Europe/Paris" <?= ($settings['timezone'] ?? 'UTC') === 'Europe/Paris' ? 'selected' : '' ?>><?= lang('Settings.timezone_paris') ?></option>
                        <option value="Asia/Tokyo" <?= ($settings['timezone'] ?? 'UTC') === 'Asia/Tokyo' ? 'selected' : '' ?>><?= lang('Settings.timezone_tokyo') ?></option>
                        <option value="Australia/Sydney" <?= ($settings['timezone'] ?? 'UTC') === 'Australia/Sydney' ? 'selected' : '' ?>><?= lang('Settings.timezone_sydney') ?></option>
                        <option value="Africa/Kampala" <?= ($settings['timezone'] ?? 'UTC') === 'Africa/Kampala' ? 'selected' : '' ?>><?= lang('Settings.timezone_east_africa') ?></option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label"><?= lang('Settings.language') ?></label>
                    <select class="form-control" name="language" onchange="changeLanguage(this.value)">
                        <option value="en" <?= (session()->get('language') ?? 'en') === 'en' ? 'selected' : '' ?>><?= lang('Settings.lang_english') ?></option>
                        <option value="es" <?= (session()->get('language') ?? 'en') === 'es' ? 'selected' : '' ?>><?= lang('Settings.lang_spanish') ?></option>
                        <option value="fr" <?= (session()->get('language') ?? 'en') === 'fr' ? 'selected' : '' ?>><?= lang('Settings.lang_french') ?></option>
                        <option value="de" <?= (session()->get('language') ?? 'en') === 'de' ? 'selected' : '' ?>><?= lang('Settings.lang_german') ?></option>
                        <option value="it" <?= (session()->get('language') ?? 'en') === 'it' ? 'selected' : '' ?>><?= lang('Settings.lang_italian') ?></option>
                        <option value="pt" <?= (session()->get('language') ?? 'en') === 'pt' ? 'selected' : '' ?>><?= lang('Settings.lang_portuguese') ?></option>
                    </select>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="maintenance_mode" id="maintenance_mode"
                           <?= ($settings['maintenance_mode'] ?? false) ? 'checked' : '' ?>>
                    <label class="form-check-label" for="maintenance_mode">
                        <?= lang('Settings.maintenance_mode') ?>
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="allow_registration" id="allow_registration"
                           <?= ($settings['allow_registration'] ?? true) ? 'checked' : '' ?>>
                    <label class="form-check-label" for="allow_registration">
                        <?= lang('Settings.allow_registration') ?>
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="auto_backup" id="auto_backup"
                           <?= ($settings['auto_backup'] ?? true) ? 'checked' : '' ?>>
                    <label class="form-check-label" for="auto_backup">
                        <?= lang('Settings.auto_backup') ?>
                    </label>
                </div>

                <div class="form-group">
                    <label class="form-label"><?= lang('Settings.backup_frequency') ?></label>
                    <select class="form-control" name="backup_frequency">
                        <option value="daily" <?= ($settings['backup_frequency'] ?? 'daily') === 'daily' ? 'selected' : '' ?>><?= lang('Settings.backup_daily') ?></option>
                        <option value="weekly" <?= ($settings['backup_frequency'] ?? 'daily') === 'weekly' ? 'selected' : '' ?>><?= lang('Settings.backup_weekly') ?></option>
                        <option value="monthly" <?= ($settings['backup_frequency'] ?? 'daily') === 'monthly' ? 'selected' : '' ?>><?= lang('Settings.backup_monthly') ?></option>
                    </select>
                </div>
            </form>
        </div>
    </div>

    <!-- Settings Actions -->
     <div class="settings-actions">
         <button type="button" class="btn btn-secondary" onclick="exportSettings()">
             <i class="fas fa-download"></i> <?= lang('Settings.export_settings') ?>
         </button>
         <button type="button" class="btn btn-danger" onclick="resetSettings()">
             <i class="fas fa-undo"></i> <?= lang('Settings.reset_default') ?>
         </button>
         <button type="button" class="btn btn-primary" onclick="saveSettings()">
             <i class="fas fa-save"></i> <?= lang('Settings.save_settings') ?>
         </button>
     </div>
</div>

<!-- Settings JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Theme selection functionality
    window.selectTheme = function(themeKey) {
        // Remove active class from all theme options
        document.querySelectorAll('.theme-option').forEach(option => {
            option.classList.remove('active');
        });

        // Add active class to selected theme
        event.currentTarget.classList.add('active');

        // Update theme via AJAX
        fetch('<?= site_url('settings/update-theme') ?>', {
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
                 showAlert('<?= lang('Settings.theme_updated') ?>', 'success');
                 // Apply theme immediately
                 applyTheme(themeKey);
             } else {
                 showAlert(data.message || '<?= lang('Settings.theme_failed') ?>', 'danger');
             }
         })
         .catch(error => {
             console.error('Error:', error);
             showAlert('<?= lang('Settings.theme_failed') ?>', 'danger');
         });
    };

    // Apply theme to current page
     function applyTheme(themeKey) {
         const themes = <?= json_encode($themes ?? []) ?>;
         const theme = themes[themeKey];

         if (theme) {
             // Apply theme colors to CSS variables
             const root = document.documentElement;
             root.style.setProperty('--primary-color', theme.colors.primary);
             root.style.setProperty('--secondary-color', theme.colors.secondary);
             root.style.setProperty('--success-color', theme.colors.success);
             root.style.setProperty('--warning-color', theme.colors.warning);
             root.style.setProperty('--danger-color', theme.colors.danger);
             root.style.setProperty('--background-color', theme.colors.background);
             root.style.setProperty('--surface-color', theme.colors.surface);
             root.style.setProperty('--text-primary', theme.colors.textPrimary);
             root.style.setProperty('--text-secondary', theme.colors.textSecondary);

             // Apply theme class to body for additional styling
             document.body.className = document.body.className.replace(/theme-\w+/g, '');
             document.body.classList.add(`theme-${themeKey}`);

             // Store theme in session
             sessionStorage.setItem('selectedTheme', themeKey);
         }
     }

     // Language switching functionality
     window.changeLanguage = function(language) {
         fetch('<?= site_url('settings/update-language') ?>', {
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
                  // Update session
                  sessionStorage.setItem('selectedLanguage', language);
 
                  // Apply language immediately to current page
                  applyLanguage(language);
 
                  showAlert('<?= lang('Settings.language_updated') ?>', 'success');
              } else {
                  showAlert(data.message || '<?= lang('Settings.language_failed') ?>', 'danger');
              }
          })
          .catch(error => {
              console.error('Error:', error);
              showAlert('<?= lang('Settings.language_failed') ?>', 'danger');
          });
     };

     // Apply language to current page
     function applyLanguage(language) {
         // Update direction for RTL languages if needed
         document.documentElement.setAttribute('lang', language);
         document.documentElement.setAttribute('dir', language === 'ar' ? 'rtl' : 'ltr');

         // Store language in session
         sessionStorage.setItem('selectedLanguage', language);

         // Update page content with new language
         updatePageContent(language);
     }

     // Update page content with translations
     function updatePageContent(language) {
         const translations = {
             en: {
                 'settings.system_settings': 'System Settings',
                 'settings.theme_settings': 'Theme Settings',
                 'settings.general_settings': 'General Settings',
                 'settings.choose_theme': 'Choose your preferred color scheme and visual style.',
                 'settings.site_name': 'Site Name',
                 'settings.admin_email': 'Admin Email',
                 'settings.items_per_page': 'Items Per Page',
                 'settings.timezone': 'Timezone',
                 'settings.language': 'Language',
                 'settings.maintenance_mode': 'Enable Maintenance Mode',
                 'settings.allow_registration': 'Allow User Registration',
                 'settings.auto_backup': 'Enable Automatic Backups',
                 'settings.backup_frequency': 'Backup Frequency',
                 'settings.save_settings': 'Save Settings',
                 'settings.export_settings': 'Export Settings',
                 'settings.reset_default': 'Reset to Default'
             },
             es: {
                 'settings.system_settings': 'Configuración del Sistema',
                 'settings.theme_settings': 'Configuración de Tema',
                 'settings.general_settings': 'Configuración General',
                 'settings.choose_theme': 'Elige tu esquema de color y estilo visual preferido.',
                 'settings.site_name': 'Nombre del Sitio',
                 'settings.admin_email': 'Correo del Administrador',
                 'settings.items_per_page': 'Elementos por Página',
                 'settings.timezone': 'Zona Horaria',
                 'settings.language': 'Idioma',
                 'settings.maintenance_mode': 'Habilitar Modo de Mantenimiento',
                 'settings.allow_registration': 'Permitir Registro de Usuarios',
                 'settings.auto_backup': 'Habilitar Copias de Seguridad Automáticas',
                 'settings.backup_frequency': 'Frecuencia de Copia de Seguridad',
                 'settings.save_settings': 'Guardar Configuración',
                 'settings.export_settings': 'Exportar Configuración',
                 'settings.reset_default': 'Restablecer por Defecto'
             }
         };

         const texts = translations[language] || translations.en;

         // Update page elements with translations
         if (document.querySelector('h1')) {
             document.querySelector('h1').innerHTML = '<i class="fas fa-cog"></i> ' + (texts['settings.system_settings'] || 'System Settings');
         }

         // Update card titles and descriptions
         const themeCard = document.querySelector('.settings-card:first-child');
         if (themeCard) {
             const title = themeCard.querySelector('h3');
             const desc = themeCard.querySelector('p');
             if (title) title.innerHTML = '<i class="fas fa-palette"></i> ' + (texts['settings.theme_settings'] || 'Theme Settings');
             if (desc) desc.textContent = texts['settings.choose_theme'] || 'Choose your preferred color scheme and visual style.';
         }

         const generalCard = document.querySelector('.settings-card:last-child');
         if (generalCard) {
             const title = generalCard.querySelector('h3');
             if (title) title.innerHTML = '<i class="fas fa-sliders-h"></i> ' + (texts['settings.general_settings'] || 'General Settings');
         }

         // Update form labels
         const formLabels = document.querySelectorAll('.form-label');
         formLabels.forEach(label => {
             const labelText = label.textContent.trim();
             switch(labelText) {
                 case 'Site Name':
                     label.textContent = texts['settings.site_name'] || labelText;
                     break;
                 case 'Admin Email':
                     label.textContent = texts['settings.admin_email'] || labelText;
                     break;
                 case 'Items Per Page':
                     label.textContent = texts['settings.items_per_page'] || labelText;
                     break;
                 case 'Timezone':
                     label.textContent = texts['settings.timezone'] || labelText;
                     break;
                 case 'Language':
                     label.textContent = texts['settings.language'] || labelText;
                     break;
                 case 'Backup Frequency':
                     label.textContent = texts['settings.backup_frequency'] || labelText;
                     break;
             }
         });

         // Update checkbox labels
         const checkboxLabels = document.querySelectorAll('.form-check-label');
         checkboxLabels.forEach(label => {
             const labelText = label.textContent.trim();
             switch(labelText) {
                 case 'Enable Maintenance Mode':
                     label.textContent = texts['settings.maintenance_mode'] || labelText;
                     break;
                 case 'Allow User Registration':
                     label.textContent = texts['settings.allow_registration'] || labelText;
                     break;
                 case 'Enable Automatic Backups':
                     label.textContent = texts['settings.auto_backup'] || labelText;
                     break;
             }
         });

         // Update button texts
         const buttons = document.querySelectorAll('.btn');
         buttons.forEach(button => {
             const buttonText = button.textContent.trim();
             switch(buttonText) {
                 case 'Save Settings':
                     button.innerHTML = '<i class="fas fa-save"></i> ' + (texts['settings.save_settings'] || 'Save Settings');
                     break;
                 case 'Export Settings':
                     button.innerHTML = '<i class="fas fa-download"></i> ' + (texts['settings.export_settings'] || 'Export Settings');
                     break;
                 case 'Reset to Default':
                     button.innerHTML = '<i class="fas fa-undo"></i> ' + (texts['settings.reset_default'] || 'Reset to Default');
                     break;
             }
         });
     }

    // Save settings functionality
    window.saveSettings = function() {
        const form = document.getElementById('settingsForm');
        const formData = new FormData(form);
        const settings = {};

        // Convert form data to object
        for (let [key, value] of formData.entries()) {
            if (key.includes('[]')) {
                key = key.replace('[]', '');
                if (!settings[key]) settings[key] = [];
                settings[key].push(value);
            } else {
                settings[key] = value;
            }
        }

        // Add checkbox values
        settings.maintenance_mode = document.getElementById('maintenance_mode').checked;
        settings.allow_registration = document.getElementById('allow_registration').checked;
        settings.auto_backup = document.getElementById('auto_backup').checked;

        // Show loading state
        const saveBtn = event.currentTarget;
        const originalText = saveBtn.innerHTML;
        saveBtn.innerHTML = '<span class="spinner"></span> Saving...';
        saveBtn.disabled = true;
        saveBtn.classList.add('loading');

        // Send settings to server
        fetch('<?= site_url('settings/update-settings') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(settings)
        })
        .then(response => response.json())
        .then(data => {
             if (data.success) {
                 showAlert('<?= lang('Settings.settings_saved') ?>', 'success');
             } else {
                 showAlert(data.message || '<?= lang('Settings.save_failed') ?>', 'danger');
             }
         })
         .catch(error => {
             console.error('Error:', error);
             showAlert('<?= lang('Settings.save_failed') ?>', 'danger');
         })
        .finally(() => {
            // Restore button state
            saveBtn.innerHTML = originalText;
            saveBtn.disabled = false;
            saveBtn.classList.remove('loading');
        });
    };

    // Reset settings
     window.resetSettings = function() {
         if (confirm('<?= lang('Settings.reset_confirm') ?>')) {
             fetch('<?= site_url('settings/reset') ?>', {
                 method: 'POST',
                 headers: {
                     'X-Requested-With': 'XMLHttpRequest'
                 }
             })
             .then(response => response.json())
             .then(data => {
                 if (data.success) {
                     showAlert('<?= lang('Settings.settings_reset') ?>', 'success');
                     setTimeout(() => location.reload(), 1500);
                 } else {
                     showAlert(data.message || '<?= lang('Settings.reset_failed') ?>', 'danger');
                 }
             })
             .catch(error => {
                 console.error('Error:', error);
                 showAlert('<?= lang('Settings.reset_failed') ?>', 'danger');
             });
         }
     };

    // Export settings
    window.exportSettings = function() {
        fetch('<?= site_url('settings/export') ?>', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Create and download settings file
            const blob = new Blob([JSON.stringify(data, null, 2)], { type: 'application/json' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'settings-backup-' + new Date().toISOString().split('T')[0] + '.json';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);

            showAlert('<?= lang('Settings.settings_exported') ?>', 'success');
         })
         .catch(error => {
             console.error('Error:', error);
             showAlert('<?= lang('Settings.export_failed') ?>', 'danger');
         });
    };

    // Show alert messages
    function showAlert(message, type = 'info') {
        const alertContainer = document.getElementById('alertContainer');
        const alert = document.createElement('div');
        alert.className = `alert alert-${type}`;
        alert.innerHTML = `
            <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'danger' ? 'exclamation-triangle' : 'info-circle'}"></i>
            ${message}
        `;

        alertContainer.appendChild(alert);

        // Auto-remove after 5 seconds
        setTimeout(() => {
            if (alert.parentNode) {
                alert.remove();
            }
        }, 5000);
    }

    // Apply saved theme and language on page load
     const savedTheme = sessionStorage.getItem('selectedTheme') || '<?= $current_theme ?>';
     const savedLanguage = sessionStorage.getItem('selectedLanguage') || '<?= session()->get('language') ?? 'en' ?>';

     if (savedTheme && savedTheme !== 'light') {
         applyTheme(savedTheme);
     }

     if (savedLanguage && savedLanguage !== 'en') {
         applyLanguage(savedLanguage);
     }
});
</script>

<?= $this->endSection() ?>