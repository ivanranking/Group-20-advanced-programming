<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class SettingsController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Settings',
            'current_theme' => session()->get('theme') ?? 'light',
            'themes' => [
                'light' => [
                    'name' => 'Light Theme',
                    'description' => 'Clean and bright interface',
                    'colors' => [
                        'primary' => '#667eea',
                        'secondary' => '#764ba2',
                        'background' => '#ffffff',
                        'surface' => '#f8f9fa',
                        'text' => '#2d3748'
                    ]
                ],
                'dark' => [
                    'name' => 'Dark Theme',
                    'description' => 'Easy on the eyes',
                    'colors' => [
                        'primary' => '#bb86fc',
                        'secondary' => '#9d4edd',
                        'background' => '#121212',
                        'surface' => '#1e1e1e',
                        'text' => '#ffffff'
                    ]
                ],
                'premium' => [
                    'name' => 'Premium Dark',
                    'description' => 'Premium gradient theme',
                    'colors' => [
                        'primary' => '#667eea',
                        'secondary' => '#764ba2',
                        'background' => 'radial-gradient(ellipse at top left, #667eea 0%, #764ba2 50%, #f093fb 100%)',
                        'surface' => 'rgba(255, 255, 255, 0.05)',
                        'text' => '#ffffff'
                    ]
                ],
                'blue' => [
                    'name' => 'Ocean Blue',
                    'description' => 'Calming blue tones',
                    'colors' => [
                        'primary' => '#2196f3',
                        'secondary' => '#21cbf3',
                        'background' => 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
                        'surface' => 'rgba(255, 255, 255, 0.1)',
                        'text' => '#ffffff'
                    ]
                ]
            ],
            'settings' => [
                'site_name' => 'CI4 Management System',
                'admin_email' => 'admin@example.com',
                'maintenance_mode' => false,
                'allow_registration' => true,
                'items_per_page' => 10,
                'timezone' => 'UTC',
                'language' => 'en',
                'auto_backup' => true,
                'backup_frequency' => 'daily'
            ]
        ];

        return view('settings/index', $data);
    }

    public function updateTheme()
    {
        $theme = $this->request->getPost('theme');

        if ($theme && in_array($theme, ['light', 'dark', 'premium', 'blue'])) {
            session()->set('theme', $theme);

            // Define theme configurations
            $themes = [
                'light' => [
                    'primary' => '#667eea',
                    'secondary' => '#764ba2',
                    'background' => '#ffffff',
                    'surface' => '#f8f9fa',
                    'text' => '#2d3748'
                ],
                'dark' => [
                    'primary' => '#bb86fc',
                    'secondary' => '#9d4edd',
                    'background' => '#121212',
                    'surface' => '#1e1e1e',
                    'text' => '#ffffff'
                ],
                'premium' => [
                    'primary' => '#667eea',
                    'secondary' => '#764ba2',
                    'background' => 'radial-gradient(ellipse at top left, #667eea 0%, #764ba2 50%, #f093fb 100%)',
                    'surface' => 'rgba(255, 255, 255, 0.05)',
                    'text' => '#ffffff'
                ],
                'blue' => [
                    'primary' => '#2196f3',
                    'secondary' => '#21cbf3',
                    'background' => 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
                    'surface' => 'rgba(255, 255, 255, 0.1)',
                    'text' => '#ffffff'
                ]
            ];

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Theme updated successfully',
                'theme' => $theme,
                'colors' => $themes[$theme]
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Invalid theme selected'
        ]);
    }

    public function updateLanguage()
    {
        $language = $this->request->getPost('language');

        $allowedLanguages = ['en', 'es', 'fr', 'de', 'it', 'pt'];
        if ($language && in_array($language, $allowedLanguages)) {
            session()->set('language', $language);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Language updated successfully',
                'language' => $language
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Invalid language selected'
        ]);
    }

    public function getCurrentSettings()
    {
        return $this->response->setJSON([
            'theme' => session()->get('theme') ?? 'light',
            'language' => session()->get('language') ?? 'en',
            'settings' => session()->get('app_settings') ?? []
        ]);
    }

    public function updateSettings()
    {
        $settings = $this->request->getPost();

        // Validate and sanitize settings
        $allowedSettings = [
            'site_name', 'admin_email', 'maintenance_mode',
            'allow_registration', 'items_per_page', 'timezone',
            'language', 'auto_backup', 'backup_frequency'
        ];

        $updateData = [];
        foreach ($allowedSettings as $setting) {
            if (isset($settings[$setting])) {
                $updateData[$setting] = $this->sanitizeSetting($setting, $settings[$setting]);
            }
        }

        // In a real application, you would save these to a database
        // For now, we'll store them in session
        session()->set('app_settings', $updateData);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Settings updated successfully'
        ]);
    }

    private function sanitizeSetting($key, $value)
    {
        switch ($key) {
            case 'site_name':
            case 'admin_email':
                return filter_var($value, FILTER_SANITIZE_STRING);
            case 'maintenance_mode':
            case 'allow_registration':
            case 'auto_backup':
                return filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? false;
            case 'items_per_page':
                return filter_var($value, FILTER_VALIDATE_INT, ['options' => ['min_range' => 5, 'max_range' => 100]]);
            case 'timezone':
                $allowedTimezones = timezone_identifiers_list();
                return in_array($value, $allowedTimezones) ? $value : 'UTC';
            case 'language':
                $allowedLanguages = ['en', 'es', 'fr', 'de', 'it', 'pt'];
                return in_array($value, $allowedLanguages) ? $value : 'en';
            case 'backup_frequency':
                $allowedFrequencies = ['daily', 'weekly', 'monthly'];
                return in_array($value, $allowedFrequencies) ? $value : 'daily';
            default:
                return $value;
        }
    }

    public function resetSettings()
    {
        session()->remove('theme');
        session()->remove('app_settings');

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Settings reset to default'
        ]);
    }

    public function exportSettings()
    {
        $settings = session()->get('app_settings') ?? [];
        $currentTheme = session()->get('theme') ?? 'light';

        $exportData = [
            'theme' => $currentTheme,
            'settings' => $settings,
            'exported_at' => date('Y-m-d H:i:s')
        ];

        return $this->response->setJSON($exportData);
    }
}