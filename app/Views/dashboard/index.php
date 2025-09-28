<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Premium Background Elements -->
<div class="animated-bg"></div>
<div class="grid-overlay"></div>
<div class="floating-element"></div>
<div class="floating-element"></div>
<div class="floating-element"></div>

<!-- Premium Dashboard CSS -->
<style>
    :root {
        /* Premium Color Palette */
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --warning-gradient: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        --danger-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        --premium-dark: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
        --premium-purple: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --premium-blue: linear-gradient(135deg, #2196f3 0%, #21cbf3 100%);
        --premium-gold: linear-gradient(135deg, #ffd89b 0%, #19547b 100%);
        --premium-emerald: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);

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

        /* Typography Scale */
        --font-size-xs: 0.75rem;
        --font-size-sm: 0.875rem;
        --font-size-base: 1rem;
        --font-size-lg: 1.125rem;
        --font-size-xl: 1.25rem;
        --font-size-2xl: 1.5rem;
        --font-size-3xl: 1.875rem;
        --font-size-4xl: 2.25rem;
        --font-size-5xl: 3rem;

        /* Spacing Scale */
        --space-1: 0.25rem;
        --space-2: 0.5rem;
        --space-3: 0.75rem;
        --space-4: 1rem;
        --space-5: 1.25rem;
        --space-6: 1.5rem;
        --space-8: 2rem;
        --space-10: 2.5rem;
        --space-12: 3rem;
        --space-16: 4rem;
        --space-20: 5rem;
        --space-24: 6rem;
    }

    body {
        background: radial-gradient(ellipse at top left, #667eea 0%, #764ba2 50%, #f093fb 100%);
        background-attachment: fixed;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', system-ui, sans-serif;
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
    }

    /* Premium Animated Background */
    .animated-bg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background:
            radial-gradient(circle at 20% 80%, rgba(102, 126, 234, 0.15) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(118, 75, 162, 0.15) 0%, transparent 50%),
            radial-gradient(circle at 40% 40%, rgba(240, 147, 251, 0.1) 0%, transparent 50%),
            linear-gradient(135deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #f5576c 75%, #4facfe 100%);
        background-size: 800% 800%, 600% 600%, 400% 400%, 100% 100%;
        animation: premiumGradientShift 20s ease-in-out infinite;
        z-index: -1;
        opacity: 0.8;
    }

    /* Floating Elements */
    .floating-element {
        position: fixed;
        border-radius: 50%;
        background: linear-gradient(45deg, rgba(102, 126, 234, 0.1), rgba(240, 147, 251, 0.1));
        animation: float 6s ease-in-out infinite;
        z-index: -1;
    }

    .floating-element:nth-child(1) {
        width: 80px;
        height: 80px;
        top: 10%;
        left: 10%;
        animation-delay: 0s;
    }

    .floating-element:nth-child(2) {
        width: 60px;
        height: 60px;
        top: 60%;
        right: 15%;
        animation-delay: 2s;
    }

    .floating-element:nth-child(3) {
        width: 100px;
        height: 100px;
        bottom: 20%;
        left: 20%;
        animation-delay: 4s;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        33% { transform: translateY(-20px) rotate(120deg); }
        66% { transform: translateY(-10px) rotate(240deg); }
    }

    @keyframes premiumGradientShift {
        0% { background-position: 0% 0%, 100% 100%, 0% 50%, 0% 0%; }
        25% { background-position: 100% 100%, 0% 0%, 50% 0%, 25% 25%; }
        50% { background-position: 100% 0%, 0% 100%, 100% 50%, 50% 50%; }
        75% { background-position: 0% 100%, 100% 0%, 50% 100%, 75% 75%; }
        100% { background-position: 0% 0%, 100% 100%, 0% 50%, 100% 100%; }
    }

    /* Premium Grid Overlay */
    .grid-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image:
            linear-gradient(rgba(102, 126, 234, 0.05) 1px, transparent 1px),
            linear-gradient(90deg, rgba(102, 126, 234, 0.05) 1px, transparent 1px);
        background-size: 50px 50px;
        z-index: -1;
        opacity: 0.3;
    }

    /* Premium Sidebar */
    .modern-sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 300px;
        height: 100vh;
        background: var(--premium-dark);
        color: #fff;
        transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
        padding: 0;
        box-shadow: var(--shadow-3xl);
        z-index: 1000;
        overflow: hidden;
        backdrop-filter: blur(20px);
        border-right: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        flex-direction: column;
    }

    .modern-sidebar::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 280px;
        background: var(--premium-purple);
        opacity: 0.95;
        border-radius: 0 0 30px 30px;
    }

    .modern-sidebar::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 100px;
        background: linear-gradient(transparent, rgba(0, 0, 0, 0.3));
    }

    .sidebar-header {
        position: relative;
        z-index: 3;
        padding: 40px 30px 25px;
        text-align: center;
    }

    .sidebar-logo {
        font-size: 2.2rem;
        font-weight: 900;
        color: #fff;
        margin-bottom: 12px;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
        background: linear-gradient(135deg, #fff 0%, rgba(255, 255, 255, 0.8) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        letter-spacing: -0.5px;
    }

    .sidebar-subtitle {
        color: rgba(255, 255, 255, 0.85);
        font-size: 0.95rem;
        font-weight: 500;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }

    .sidebar-version {
        position: absolute;
        bottom: 15px;
        left: 50%;
        transform: translateX(-50%);
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.75rem;
        font-weight: 500;
        background: rgba(255, 255, 255, 0.1);
        padding: 4px 12px;
        border-radius: 12px;
        backdrop-filter: blur(10px);
    }

    .modern-nav {
        position: relative;
        z-index: 3;
        padding: 30px 20px 20px;
        flex: 1;
        overflow-y: auto;
        overflow-x: hidden;
        scrollbar-width: thin;
        scrollbar-color: rgba(102, 126, 234, 0.3) transparent;
    }

    .modern-nav::-webkit-scrollbar {
        width: 6px;
    }

    .modern-nav::-webkit-scrollbar-track {
        background: transparent;
    }

    .modern-nav::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 3px;
        opacity: 0.7;
    }

    .modern-nav::-webkit-scrollbar-thumb:hover {
        opacity: 1;
    }

    /* Scroll Indicator */
    .scroll-indicator {
        position: absolute;
        bottom: 100px;
        left: 50%;
        transform: translateX(-50%);
        width: 3px;
        height: 30px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 2px;
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 4;
    }

    .scroll-indicator.show {
        opacity: 1;
    }

    .scroll-indicator::before {
        content: '';
        position: absolute;
        top: -8px;
        left: -3px;
        width: 9px;
        height: 9px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 50%;
        box-shadow: 0 0 10px rgba(102, 126, 234, 0.5);
    }

    .nav-item {
        margin-bottom: 12px;
        position: relative;
    }

    .modern-nav-link {
        display: flex;
        align-items: center;
        padding: 18px 24px;
        color: rgba(255, 255, 255, 0.75);
        text-decoration: none;
        border-radius: var(--border-radius-sm);
        transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        position: relative;
        overflow: hidden;
        font-weight: 600;
        font-size: 0.95rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .modern-nav-link::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 5px;
        background: var(--premium-purple);
        transform: scaleY(0);
        transition: transform 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        border-radius: 0 3px 3px 0;
    }

    .modern-nav-link::after {
        content: '';
        position: absolute;
        top: 50%;
        right: 20px;
        width: 0;
        height: 0;
        border-left: 6px solid rgba(255, 255, 255, 0.4);
        border-top: 4px solid transparent;
        border-bottom: 4px solid transparent;
        transform: translateY(-50%) scaleX(0);
        transition: transform 0.3s ease;
        opacity: 0;
    }

    .modern-nav-link:hover::before,
    .modern-nav-link.active::before {
        transform: scaleY(1);
    }

    .modern-nav-link:hover::after,
    .modern-nav-link.active::after {
        transform: translateY(-50%) scaleX(1);
        opacity: 1;
    }

    .modern-nav-link:hover,
    .modern-nav-link.active {
        background: rgba(255, 255, 255, 0.15);
        color: #fff;
        transform: translateX(8px) translateY(-2px);
        box-shadow: var(--shadow-xl);
        border-color: rgba(255, 255, 255, 0.2);
    }

    .modern-nav-link.active {
        background: rgba(102, 126, 234, 0.2);
        border-color: rgba(102, 126, 234, 0.3);
    }

    .modern-nav-link i {
        margin-right: 16px;
        font-size: 1.2rem;
        width: 24px;
        text-align: center;
        transition: transform 0.3s ease;
    }

    .modern-nav-link:hover i {
        transform: scale(1.1);
    }

    .nav-item-label {
        position: relative;
        z-index: 1;
    }

    /* Premium Top Navbar */
    .modern-navbar {
        position: fixed;
        top: 0;
        left: 300px;
        right: 0;
        height: 90px;
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(30px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 40px;
        z-index: 999;
        box-shadow: var(--shadow-lg);
        border-radius: 0 0 0 30px;
    }

    .navbar-brand {
        font-size: 1.8rem;
        font-weight: 900;
        background: var(--premium-purple);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        letter-spacing: -0.5px;
        position: relative;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .sidebar-toggle {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border: none;
        color: white;
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: none;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: var(--shadow-md);
    }

    .sidebar-toggle:hover {
        transform: scale(1.05);
        box-shadow: var(--shadow-lg);
    }

    .navbar-brand::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 60%;
        height: 3px;
        background: var(--premium-purple);
        border-radius: 2px;
    }

    .navbar-actions {
        display: flex;
        align-items: center;
        gap: 25px;
    }

    .search-box {
        position: relative;
        display: flex;
        align-items: center;
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        border-radius: 30px;
        padding: 12px 20px;
        border: 2px solid rgba(102, 126, 234, 0.1);
        transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        min-width: 280px;
        box-shadow: var(--shadow-sm);
    }

    .search-box:focus-within {
        border-color: rgba(102, 126, 234, 0.4);
        box-shadow: var(--shadow-lg), 0 0 0 4px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
    }

    .search-input {
        background: none;
        border: none;
        outline: none;
        flex: 1;
        font-size: 0.95rem;
        color: #2d3748;
        font-weight: 500;
    }

    .search-input::placeholder {
        color: #a0aec0;
        font-weight: 400;
    }

    .search-btn {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border: none;
        color: white;
        cursor: pointer;
        padding: 8px;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .search-btn:hover {
        transform: scale(1.05);
        box-shadow: var(--shadow-md);
    }

    .notification-bell {
        position: relative;
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        border: 2px solid rgba(102, 126, 234, 0.1);
        box-shadow: var(--shadow-sm);
    }

    .notification-bell:hover {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        transform: scale(1.1) translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .notification-badge {
        position: absolute;
        top: -6px;
        right: -6px;
        background: linear-gradient(135deg, #ff6b6b, #ee5a24);
        color: white;
        border-radius: 50%;
        width: 22px;
        height: 22px;
        font-size: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        box-shadow: var(--shadow-md);
        animation: pulse 2s infinite;
    }

    /* Notification Dropdown */
    .notification-dropdown {
        position: absolute;
        top: 60px;
        right: 0;
        width: 350px;
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        box-shadow: var(--shadow-2xl);
        border: 1px solid rgba(255, 255, 255, 0.3);
        z-index: 1001;
        max-height: 400px;
        overflow-y: auto;
        display: none;
    }

    .notification-dropdown.show {
        display: block;
        animation: fadeInDown 0.3s ease;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .notification-header {
        padding: 20px 20px 10px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        font-weight: 600;
        color: #2d3748;
    }

    .notification-item {
        padding: 15px 20px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .notification-item:hover {
        background: rgba(102, 126, 234, 0.05);
    }

    .notification-item:last-child {
        border-bottom: none;
    }

    .notification-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        margin-right: 15px;
        flex-shrink: 0;
    }

    .notification-content {
        flex: 1;
    }

    .notification-title {
        font-weight: 600;
        color: #2d3748;
        font-size: 0.9rem;
        margin-bottom: 4px;
    }

    .notification-message {
        color: #718096;
        font-size: 0.85rem;
        line-height: 1.4;
    }

    .notification-time {
        color: #a0aec0;
        font-size: 0.75rem;
        margin-top: 4px;
    }

    .notification-empty {
        text-align: center;
        padding: 40px 20px;
        color: #a0aec0;
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: 12px;
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        padding: 10px 18px;
        border-radius: 30px;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        border: 2px solid rgba(102, 126, 234, 0.1);
        box-shadow: var(--shadow-sm);
    }

    .user-profile:hover {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        transform: scale(1.05) translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--premium-purple);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 1.1rem;
        box-shadow: var(--shadow-md);
    }

    .user-info {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .user-name {
        font-weight: 600;
        font-size: 0.9rem;
        color: inherit;
    }

    .user-role {
        font-size: 0.75rem;
        opacity: 0.8;
        color: inherit;
    }

    /* Simple Main Content */
    .main-content {
        margin-left: 300px;
        padding: 90px 30px 30px 30px;
        background: #f8f9fc;
        min-height: 100vh;
        position: relative;
        z-index: 1;
        width: calc(100% - 300px);
        box-sizing: border-box;
    }

    .main-content::before {
        content: '';
        position: fixed;
        top: 0;
        left: 300px;
        right: 0;
        bottom: 0;
        background: #f8f9fc;
        z-index: -1;
        pointer-events: none;
    }

    /* Simple Cards */
    .summary-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.06);
        padding: 24px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border: none;
    }

    .summary-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 28px rgba(0,0,0,0.12);
    }

    .summary-title {
        font-size: 0.85rem;
        font-weight: 600;
        color: #6c757d;
        margin-bottom: 8px;
    }

    .summary-value {
        font-size: 1.75rem;
        font-weight: 700;
        color: #333;
    }

    .summary-sub {
        font-size: 0.9rem;
        font-weight: 500;
        color: #6c757d;
    }

    .badge-status {
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 12px;
        padding: 4px 10px;
    }

    /* Enhanced Activity Styles */
    .activity-list {
        max-height: 400px;
        overflow-y: auto;
    }

    .activity-item {
        display: flex;
        align-items: flex-start;
        padding: 15px 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .activity-item:hover {
        background: rgba(102, 126, 234, 0.05);
        padding-left: 15px;
        border-radius: 8px;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-size: 1.1rem;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .activity-content {
        flex: 1;
        min-width: 0;
    }

    .activity-title {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 4px;
        line-height: 1.4;
    }

    .activity-time {
        font-size: 0.8rem;
        color: #718096;
        font-weight: 500;
    }

    /* Progress Bars in Cards */
    .progress {
        border-radius: 4px;
        overflow: hidden;
    }

    .progress-bar {
        transition: width 0.6s ease;
    }

    /* Enhanced Card Hover Effects */
    .list-card {
        transition: all 0.3s ease;
    }

    .list-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    /* Text Size Utilities */
    .text-sm {
        font-size: 0.875rem;
    }

    /* System Status Cards */
    .bg-light {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%) !important;
        border: 1px solid rgba(102, 126, 234, 0.1);
    }

    .bg-light:hover {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        color: white;
        border-color: rgba(102, 126, 234, 0.3);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.2);
    }

    .bg-light:hover * {
        color: white !important;
    }

    .bg-light:hover .btn-outline-info {
        border-color: white;
        color: white;
    }

    .bg-light:hover .btn-outline-info:hover {
        background: white;
        color: #667eea;
    }

    /* Enhanced Quick Actions Grid */
    .quick-actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
    }

    .quick-action-btn {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 20px;
        background: var(--primary-gradient);
        color: white;
        text-decoration: none;
        border-radius: var(--border-radius-sm);
        font-weight: 500;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        min-height: 80px;
    }

    .quick-action-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
    }

    .quick-action-btn:hover::before {
        left: 100%;
    }

    .quick-action-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        color: white;
    }

    .quick-action-btn strong {
        display: block;
        font-size: 1rem;
        margin-bottom: 2px;
    }

    .quick-action-btn small {
        display: block;
        opacity: 0.9;
        font-size: 0.85rem;
    }

    .quick-action-icon {
        font-size: 1.5rem;
        opacity: 0.9;
    }

    /* Simple List Cards */
    .list-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.06);
        background: #fff;
    }

    .list-card .card-header {
        background: transparent;
        border-bottom: none;
        font-weight: 600;
        font-size: 0.95rem;
        padding: 20px 20px 0 20px;
    }

    .list-card .card-body {
        padding: 0 20px 20px 20px;
    }

    /* Simple Quick Actions */
    .quick-actions {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 16px;
        color: #fff;
        padding: 30px;
    }

    .quick-actions h6 {
        font-size: 0.9rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 20px;
    }

    .quick-btn {
        background: #fff;
        color: #333;
        border-radius: 10px;
        padding: 10px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        text-decoration: none;
    }

    .quick-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.12);
        color: #333;
    }

    .btn-icon {
        margin-right: 8px;
        font-size: 1rem;
    }

    /* Charts Section */
    .charts-section {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 25px;
        margin-bottom: 30px;
    }

    .chart-container {
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(20px);
        border-radius: var(--border-radius);
        padding: 25px;
        box-shadow: var(--shadow-medium);
        border: 1px solid rgba(255,255,255,0.3);
    }

    .chart-header {
        display: flex;
        justify-content: between;
        align-items: center;
        margin-bottom: 20px;
    }

    .chart-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2d3748;
        margin: 0;
    }

    /* Activity Feed */
    .activity-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
    }

    .activity-card {
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(20px);
        border-radius: var(--border-radius);
        padding: 25px;
        box-shadow: var(--shadow-medium);
        border: 1px solid rgba(255,255,255,0.3);
    }

    .activity-header {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .activity-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .activity-item {
        display: flex;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #e2e8f0;
        transition: all 0.2s ease;
    }

    .activity-item:hover {
        background: rgba(102, 126, 234, 0.05);
        padding-left: 10px;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-size: 1rem;
    }

    .activity-content {
        flex: 1;
    }

    .activity-title {
        font-weight: 500;
        color: #2d3748;
        margin-bottom: 2px;
    }

    .activity-time {
        font-size: 0.8rem;
        color: #718096;
    }

    /* Quick Actions */
    .quick-actions-modern {
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(20px);
        border-radius: var(--border-radius);
        padding: 30px;
        box-shadow: var(--shadow-medium);
        border: 1px solid rgba(255,255,255,0.3);
        margin-top: 30px;
    }

    .quick-actions-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .quick-actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
    }

    .quick-action-btn {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 15px 20px;
        background: var(--primary-gradient);
        color: white;
        text-decoration: none;
        border-radius: var(--border-radius-sm);
        font-weight: 500;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .quick-action-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
    }

    .quick-action-btn:hover::before {
        left: 100%;
    }

    .quick-action-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        color: white;
    }

    .quick-action-icon {
        font-size: 1.2rem;
    }

    /* Modal Enhancements */
    .modal-content {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-2xl);
    }

    .modal-header {
        background: var(--primary-gradient);
        color: white;
        border-radius: calc(var(--border-radius) - 1px) calc(var(--border-radius) - 1px) 0 0;
        border-bottom: none;
    }

    .modal-header .btn-close {
        filter: invert(1);
    }

    .modal-title {
        font-weight: 700;
    }

    .modal-body {
        padding: 2rem;
    }

    .modal-footer {
        border-top: 1px solid rgba(0, 0, 0, 0.1);
        background: rgba(248, 249, 250, 0.5);
        border-radius: 0 0 calc(var(--border-radius) - 1px) calc(var(--border-radius) - 1px);
    }

    /* Chart Container */
    .chart-container {
        position: relative;
        height: 200px;
        margin: 1rem 0;
    }

    /* System Info Table */
    .table {
        background: transparent;
    }

    .table td {
        border: none;
        padding: 0.5rem 0.75rem;
        background: transparent;
    }

    .display-6 {
        font-size: 2.5rem;
        font-weight: 700;
        line-height: 1;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .charts-section {
            grid-template-columns: 1fr;
        }
        .activity-section {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .sidebar-toggle {
            display: flex;
        }

        .modern-sidebar {
            transform: translateX(-100%);
            z-index: 1001;
        }

        .modern-sidebar.show {
            transform: translateX(0);
        }

        .main-content {
             margin-left: 0;
             padding: 90px 15px 15px;
             width: 100%;
             transition: margin-left 0.3s ease;
         }

        .modern-navbar {
            left: 0;
            padding: 0 15px;
        }

        .analytics-grid {
            grid-template-columns: 1fr;
        }

        .search-box {
            min-width: 200px;
        }

        /* Mobile overlay */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .sidebar-overlay.show {
            opacity: 1;
            visibility: visible;
        }
    }

    /* Loading Animation */
    .loading-spinner {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid rgba(255,255,255,0.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Pulse Animation for Live Data */
    .pulse {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.7); }
        70% { box-shadow: 0 0 0 10px rgba(102, 126, 234, 0); }
        100% { box-shadow: 0 0 0 0 rgba(102, 126, 234, 0); }
    }
</style>

<!-- Mobile Overlay -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Modern Sidebar -->
<div class="modern-sidebar" id="modernSidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">Dashboard</div>
        <div class="sidebar-subtitle">Management System</div>
    </div>
    <nav class="modern-nav">
        <div class="nav-item">
            <a class="modern-nav-link active" href="<?= site_url('dashboard') ?>">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
        </div>
        <div class="nav-item">
            <a class="modern-nav-link" href="<?= site_url('facilities') ?>">
                <i class="fas fa-building"></i>
                <span>Facilities</span>
            </a>
        </div>
        <div class="nav-item">
            <a class="modern-nav-link" href="<?= site_url('services') ?>">
                <i class="fas fa-cogs"></i>
                <span>Services</span>
            </a>
        </div>
        <div class="nav-item">
            <a class="modern-nav-link" href="<?= site_url('projects') ?>">
                <i class="fas fa-project-diagram"></i>
                <span>Projects</span>
            </a>
        </div>
        <div class="nav-item">
            <a class="modern-nav-link" href="<?= site_url('programs') ?>">
                <i class="fas fa-calendar-alt"></i>
                <span>Programs</span>
            </a>
        </div>
        <div class="nav-item">
            <a class="modern-nav-link" href="<?= site_url('equipment') ?>">
                <i class="fas fa-tools"></i>
                <span>Equipment</span>
            </a>
        </div>
        <div class="nav-item">
            <a class="modern-nav-link" href="<?= site_url('participants') ?>">
                <i class="fas fa-users"></i>
                <span>Participants</span>
            </a>
        </div>
        <div class="nav-item">
            <a class="modern-nav-link" href="<?= site_url('outcomes') ?>">
                <i class="fas fa-chart-line"></i>
                <span>Outcomes</span>
            </a>
        </div>
        <div class="nav-item">
            <a class="modern-nav-link" href="<?= site_url('settings') ?>">
                <i class="fas fa-cog"></i>
                <span>Settings</span>
            </a>
        </div>
    </nav>
    <div class="scroll-indicator" id="scrollIndicator"></div>
    <div class="sidebar-version">v2.1.0</div>
</div>

<!-- Modern Top Navbar -->
<div class="modern-navbar">
    <div class="navbar-brand">
        <button class="sidebar-toggle" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        Analytics Dashboard
    </div>
    <div class="navbar-actions">
        <div class="search-box">
            <input type="text" class="search-input" placeholder="Search...">
            <button class="search-btn">
                <i class="fas fa-search"></i>
            </button>
        </div>
        <div class="notification-bell" id="notificationBell">
            <i class="fas fa-bell"></i>
            <div class="notification-badge" id="notificationCount">0</div>
        </div>

        <!-- Notification Dropdown -->
        <div class="notification-dropdown" id="notificationDropdown">
            <div class="notification-header">
                <i class="fas fa-bell me-2"></i>
                Notifications
            </div>
            <div id="notificationList">
                <!-- Notifications will be populated here -->
            </div>
        </div>
        <div class="user-profile">
            <div class="user-avatar">A</div>
            <div class="user-info">
                <div class="user-name">Admin</div>
                <div class="user-role">Administrator</div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="main-content">
    <!-- Summary Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="summary-card">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="summary-title">Facilities</span>
                    <i class="fas fa-building text-secondary"></i>
                </div>
                <div class="summary-value"><?= $facility_count ?? 0 ?> <span class="summary-sub">Active</span></div>
                <span class="badge-status bg-success-subtle text-success">&lt; 5%</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="summary-card">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="summary-title">Services</span>
                    <i class="fas fa-cogs text-warning"></i>
                </div>
                <div class="summary-value"><?= $service_count ?? 0 ?> <span class="summary-sub">Open</span></div>
                <span class="badge-status bg-danger-subtle text-danger">&lt; 2%</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="summary-card">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="summary-title">Projects</span>
                    <i class="fas fa-project-diagram text-primary"></i>
                </div>
                <div class="summary-value"><?= $project_count ?? 0 ?> <span class="summary-sub">Upcoming</span></div>
                <span class="badge-status bg-danger-subtle text-danger">&lt; 2%</span>
            </div>
        </div>
    </div>

    <!-- Recent Activities Timeline -->
    <div class="row g-4 mb-5">
        <div class="col-lg-8">
            <div class="card list-card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-clock me-2"></i>Recent Activities</span>
                    <span class="badge bg-primary">Live Updates</span>
                </div>
                <div class="card-body">
                    <div class="activity-list" id="activityList">
                        <!-- Activities will be populated by JavaScript -->
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Real-time Notifications Panel -->
            <div class="card list-card mb-4">
                <?= $this->include('components/notifications') ?>
            </div>

            <div class="card list-card mb-4">
                <div class="card-header">
                    <span><i class="fas fa-chart-pie me-2"></i>Entity Distribution</span>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-sm">Projects</span>
                            <span class="badge bg-primary">0%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 0%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-sm">Programs</span>
                            <span class="badge bg-success">0%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 0%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-sm">Participants</span>
                            <span class="badge bg-info">0%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 0%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-sm">Equipment</span>
                            <span class="badge bg-warning">0%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 0%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-sm">Services</span>
                            <span class="badge bg-danger">0%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 0%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-sm">Facilities</span>
                            <span class="badge bg-secondary">0%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-secondary" role="progressbar" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Projects & Programs -->
    <div class="row g-4 mb-5">
        <div class="col-lg-6">
            <div class="card list-card mb-4">
                <div class="card-header d-flex justify-content-between">
                    <span>Recent Projects</span>
                    <a href="<?= site_url('projects') ?>" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <?php foreach($recent_projects as $project): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="<?= site_url('projects/' . $project['id']) ?>" class="fw-bold"><?= esc($project['name']) ?></a>
                                    <br><small class="text-muted">Status: <span class="badge bg-secondary"><?= esc($project['status']) ?></span></small>
                                </div>
                                <div class="btn-group btn-group-sm">
                                    <a href="<?= site_url('projects/' . $project['id'] . '/edit') ?>" class="btn btn-outline-warning btn-sm">Edit</a>
                                    <form action="<?= site_url('projects/' . $project['id']) ?>" method="post" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Del</button>
                                    </form>
                                </div>
                            </li>
                        <?php endforeach; ?>
                        <?php if (empty($recent_projects)): ?>
                            <li class="list-group-item text-muted">No projects yet.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card list-card mb-4">
                <div class="card-header d-flex justify-content-between">
                    <span>Recent Programs</span>
                    <a href="<?= site_url('programs') ?>" class="btn btn-sm btn-outline-success">View All</a>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <?php foreach($recent_programs as $program): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="<?= site_url('programs/' . $program['id']) ?>" class="fw-bold"><?= esc($program['name']) ?></a>
                                    <br><small class="text-muted">Created: <?= date('M d, Y', strtotime($program['created_at'])) ?></small>
                                </div>
                                <div class="btn-group btn-group-sm">
                                    <a href="<?= site_url('programs/' . $program['id'] . '/edit') ?>" class="btn btn-outline-warning btn-sm">Edit</a>
                                    <form action="<?= site_url('programs/' . $program['id']) ?>" method="post" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Del</button>
                                    </form>
                                </div>
                            </li>
                        <?php endforeach; ?>
                        <?php if (empty($recent_programs)): ?>
                            <li class="list-group-item text-muted">No programs yet.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Items Grid -->
    <div class="row g-4 mb-5">
        <div class="col-12">
            <div class="card list-card">
                <div class="card-header">
                    <span><i class="fas fa-th-large me-2"></i>Recent Items Overview</span>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-xl-3 col-md-6">
                            <div class="card border-0 bg-light">
                                <div class="card-body text-center">
                                    <i class="fas fa-users fa-2x text-info mb-3"></i>
                                    <h6>Participants</h6>
                                    <p class="text-muted mb-0">Manage and track participants</p>
                                    <a href="<?= site_url('participants') ?>" class="btn btn-sm btn-outline-info mt-2">View All</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card border-0 bg-light">
                                <div class="card-body text-center">
                                    <i class="fas fa-tools fa-2x text-danger mb-3"></i>
                                    <h6>Equipment</h6>
                                    <p class="text-muted mb-0">Track equipment inventory</p>
                                    <a href="<?= site_url('equipment') ?>" class="btn btn-sm btn-outline-danger mt-2">View All</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card border-0 bg-light">
                                <div class="card-body text-center">
                                    <i class="fas fa-cogs fa-2x text-warning mb-3"></i>
                                    <h6>Services</h6>
                                    <p class="text-muted mb-0">Available services</p>
                                    <a href="<?= site_url('services') ?>" class="btn btn-sm btn-outline-warning mt-2">View All</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card border-0 bg-light">
                                <div class="card-body text-center">
                                    <i class="fas fa-building fa-2x text-secondary mb-3"></i>
                                    <h6>Facilities</h6>
                                    <p class="text-muted mb-0">Manage facilities</p>
                                    <a href="<?= site_url('facilities') ?>" class="btn btn-sm btn-outline-secondary mt-2">View All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Quick Actions Grid -->
    <div class="row g-4 mb-5">
        <div class="col-12">
            <div class="quick-actions-modern">
                <div class="quick-actions-title">
                    <i class="fas fa-rocket"></i>
                    Quick Actions
                </div>
                <div class="quick-actions-grid">
                    <a href="<?= site_url('projects/new') ?>" class="quick-action-btn">
                        <i class="fas fa-project-diagram quick-action-icon"></i>
                        <div>
                            <strong>New Project</strong>
                            <small>Create a new project</small>
                        </div>
                    </a>
                    <a href="<?= site_url('programs/new') ?>" class="quick-action-btn">
                        <i class="fas fa-calendar-alt quick-action-icon"></i>
                        <div>
                            <strong>New Program</strong>
                            <small>Start a new program</small>
                        </div>
                    </a>
                    <a href="<?= site_url('participants/new') ?>" class="quick-action-btn">
                        <i class="fas fa-users quick-action-icon"></i>
                        <div>
                            <strong>Add Participant</strong>
                            <small>Register new participant</small>
                        </div>
                    </a>
                    <a href="<?= site_url('equipment/new') ?>" class="quick-action-btn">
                        <i class="fas fa-tools quick-action-icon"></i>
                        <div>
                            <strong>Add Equipment</strong>
                            <small>Register new equipment</small>
                        </div>
                    </a>
                    <a href="<?= site_url('services/new') ?>" class="quick-action-btn">
                        <i class="fas fa-cogs quick-action-icon"></i>
                        <div>
                            <strong>New Service</strong>
                            <small>Create new service</small>
                        </div>
                    </a>
                    <a href="<?= site_url('facilities/new') ?>" class="quick-action-btn">
                        <i class="fas fa-building quick-action-icon"></i>
                        <div>
                            <strong>Add Facility</strong>
                            <small>Register new facility</small>
                        </div>
                    </a>
                    <a href="<?= site_url('outcomes/new') ?>" class="quick-action-btn">
                        <i class="fas fa-chart-line quick-action-icon"></i>
                        <div>
                            <strong>New Outcome</strong>
                            <small>Track new outcome</small>
                        </div>
                    </a>
                    <a href="<?= site_url('settings') ?>" class="quick-action-btn">
                        <i class="fas fa-cog quick-action-icon"></i>
                        <div>
                            <strong>Settings</strong>
                            <small>System configuration</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- System Status Row -->
    <div class="row g-4">
        <div class="col-md-8">
            <div class="card list-card">
                <div class="card-header">
                    <span><i class="fas fa-info-circle me-2"></i>System Information</span>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 me-3">
                                    <div class="bg-success rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="fas fa-server text-white"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Server Status</h6>
                                    <span class="badge bg-success">Online</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 me-3">
                                    <div class="bg-info rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="fas fa-database text-white"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Database</h6>
                                    <span class="badge bg-info">Connected</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 me-3">
                                    <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="fas fa-clock text-white"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Last Backup</h6>
                                    <small class="text-muted">2 hours ago</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 me-3">
                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="fas fa-shield-alt text-white"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Security</h6>
                                    <span class="badge bg-primary">Protected</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card list-card">
                <div class="card-header">
                    <span><i class="fas fa-chart-bar me-2"></i>Performance Metrics</span>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span>CPU Usage</span>
                            <span class="fw-bold">23%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 23%"></div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span>Memory Usage</span>
                            <span class="fw-bold">45%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 45%"></div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span>Storage Usage</span>
                            <span class="fw-bold">67%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 67%"></div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span>Network I/O</span>
                            <span class="fw-bold">12%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 12%"></div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#metricsModal">View Details</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Performance Metrics Modal -->
<div class="modal fade" id="metricsModal" tabindex="-1" aria-labelledby="metricsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="metricsModalLabel">
                    <i class="fas fa-chart-bar me-2"></i>Performance Metrics Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card border-0 bg-light">
                            <div class="card-body text-center">
                                <i class="fas fa-microchip fa-3x text-primary mb-3"></i>
                                <h5>CPU Usage</h5>
                                <div class="mb-3">
                                    <span class="display-6 fw-bold text-primary">23%</span>
                                </div>
                                <div class="progress mb-3" style="height: 10px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 23%"></div>
                                </div>
                                <div class="row text-sm">
                                    <div class="col-4">
                                        <strong>Used:</strong><br>0.92 GHz
                                    </div>
                                    <div class="col-4">
                                        <strong>Available:</strong><br>3.08 GHz
                                    </div>
                                    <div class="col-4">
                                        <strong>Cores:</strong><br>4 Cores
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 bg-light">
                            <div class="card-body text-center">
                                <i class="fas fa-memory fa-3x text-warning mb-3"></i>
                                <h5>Memory Usage</h5>
                                <div class="mb-3">
                                    <span class="display-6 fw-bold text-warning">45%</span>
                                </div>
                                <div class="progress mb-3" style="height: 10px;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 45%"></div>
                                </div>
                                <div class="row text-sm">
                                    <div class="col-4">
                                        <strong>Used:</strong><br>3.6 GB
                                    </div>
                                    <div class="col-4">
                                        <strong>Available:</strong><br>4.4 GB
                                    </div>
                                    <div class="col-4">
                                        <strong>Total:</strong><br>8 GB
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 bg-light">
                            <div class="card-body text-center">
                                <i class="fas fa-hdd fa-3x text-info mb-3"></i>
                                <h5>Storage Usage</h5>
                                <div class="mb-3">
                                    <span class="display-6 fw-bold text-info">67%</span>
                                </div>
                                <div class="progress mb-3" style="height: 10px;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 67%"></div>
                                </div>
                                <div class="row text-sm">
                                    <div class="col-4">
                                        <strong>Used:</strong><br>134 GB
                                    </div>
                                    <div class="col-4">
                                        <strong>Available:</strong><br>66 GB
                                    </div>
                                    <div class="col-4">
                                        <strong>Total:</strong><br>200 GB
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 bg-light">
                            <div class="card-body text-center">
                                <i class="fas fa-network-wired fa-3x text-success mb-3"></i>
                                <h5>Network I/O</h5>
                                <div class="mb-3">
                                    <span class="display-6 fw-bold text-success">12%</span>
                                </div>
                                <div class="progress mb-3" style="height: 10px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 12%"></div>
                                </div>
                                <div class="row text-sm">
                                    <div class="col-4">
                                        <strong>Download:</strong><br>2.4 MB/s
                                    </div>
                                    <div class="col-4">
                                        <strong>Upload:</strong><br>1.1 MB/s
                                    </div>
                                    <div class="col-4">
                                        <strong>Latency:</strong><br>12ms
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Metrics -->
                <div class="row g-4 mt-4">
                    <div class="col-md-6">
                        <h6><i class="fas fa-server me-2"></i>System Information</h6>
                        <table class="table table-sm">
                            <tr>
                                <td>Operating System:</td>
                                <td><span class="badge bg-info">Windows 10 Pro</span></td>
                            </tr>
                            <tr>
                                <td>Web Server:</td>
                                <td><span class="badge bg-success">Apache/2.4.54</span></td>
                            </tr>
                            <tr>
                                <td>PHP Version:</td>
                                <td><span class="badge bg-warning">8.2.0</span></td>
                            </tr>
                            <tr>
                                <td>Database:</td>
                                <td><span class="badge bg-primary">MySQL 8.0</span></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6><i class="fas fa-chart-line me-2"></i>Performance History</h6>
                        <div class="mb-3">
                            <canvas id="performanceChart" width="400" height="200"></canvas>
                        </div>
                        <div class="d-flex justify-content-between text-sm">
                            <span>Last Hour: <strong class="text-success">Normal</strong></span>
                            <span>Last 24h: <strong class="text-success">Optimal</strong></span>
                            <span>Last 7d: <strong class="text-warning">Above Average</strong></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Refresh Data</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap + FontAwesome + Chart.js -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Dashboard JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animate counters
    function animateCounter(element, target) {
        let start = 0;
        const increment = target / 50;
        const timer = setInterval(() => {
            start += increment;
            if (start >= target) {
                element.textContent = target;
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(start);
            }
        }, 30);
    }

    // Animate all card values
    document.querySelectorAll('.card-value').forEach(card => {
        const target = parseInt(card.getAttribute('data-target'));
        if (target) {
            animateCounter(card, target);
        }
    });

    // Add premium hover effects
    document.querySelectorAll('.analytics-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-12px) scale(1.02)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Add floating animation to floating elements
    document.querySelectorAll('.floating-element').forEach((element, index) => {
        element.style.animationDelay = `${index * 2}s`;
    });

    // Add premium navbar effects
    const navbar = document.querySelector('.modern-navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(255, 255, 255, 0.98)';
                navbar.style.backdropFilter = 'blur(30px)';
            }
        });
    }

    // Search functionality
    const searchInput = document.querySelector('.search-input');
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            // Add search functionality here
            console.log('Searching for:', searchTerm);
        });
    }

    // Notification functionality
    const notificationBell = document.getElementById('notificationBell');
    const notificationDropdown = document.getElementById('notificationDropdown');
    const notificationCount = document.getElementById('notificationCount');
    const notificationList = document.getElementById('notificationList');

    // Enhanced notifications data with real-time tracking
    let notifications = <?= json_encode($notifications ?? []) ?>;

    // Track recent activities for notifications
    const recentActivities = {
        projects: <?= json_encode($recent_projects ?? []) ?>,
        programs: <?= json_encode($recent_programs ?? []) ?>,
        services: <?= json_encode($service_count ?? 0) ?>,
        facilities: <?= json_encode($facility_count ?? 0) ?>,
        participants: 0,
        equipment: 0,
        outcomes: 0
    };

    // Activity tracking system
    let userActivities = JSON.parse(sessionStorage.getItem('userActivities') || '[]');

    // Activity type configurations
    const activityConfigs = {
        project: {
            icon: 'fas fa-project-diagram',
            color: 'linear-gradient(135deg, #667eea, #764ba2)',
            title: 'Project Activity'
        },
        program: {
            icon: 'fas fa-calendar-alt',
            color: 'linear-gradient(135deg, #f093fb, #f5576c)',
            title: 'Program Activity'
        },
        participant: {
            icon: 'fas fa-users',
            color: 'linear-gradient(135deg, #4facfe, #00f2fe)',
            title: 'Participant Activity'
        },
        equipment: {
            icon: 'fas fa-tools',
            color: 'linear-gradient(135deg, #43e97b, #38f9d7)',
            title: 'Equipment Activity'
        },
        service: {
            icon: 'fas fa-cogs',
            color: 'linear-gradient(135deg, #fa709a, #fee140)',
            title: 'Service Activity'
        },
        facility: {
            icon: 'fas fa-building',
            color: 'linear-gradient(135deg, #ff9ff3, #f9ca24)',
            title: 'Facility Activity'
        },
        outcome: {
            icon: 'fas fa-chart-line',
            color: 'linear-gradient(135deg, #a8edea, #fed6e3)',
            title: 'Outcome Activity'
        },
        settings: {
            icon: 'fas fa-cog',
            color: 'linear-gradient(135deg, #ffecd2, #fcb69f)',
            title: 'Settings Activity'
        }
    };

    // Function to add new notification
    function addNotification(type, title, message, icon = 'fas fa-info-circle') {
        const notification = {
            id: Date.now(),
            type: type,
            title: title,
            message: message,
            icon: icon,
            timestamp: new Date().toISOString(),
            read: false
        };

        notifications.unshift(notification);

        // Keep only latest 20 notifications
        if (notifications.length > 20) {
            notifications = notifications.slice(0, 20);
        }

        updateNotificationCount();
        renderNotifications();

        // Show notification animation
        showNotificationAnimation(notification);
    }

    // Function to show notification animation
    function showNotificationAnimation(notification) {
        const notificationBadge = document.getElementById('notificationCount');
        if (notificationBadge) {
            notificationBadge.style.animation = 'pulse 0.5s ease-in-out';
            setTimeout(() => {
                notificationBadge.style.animation = '';
            }, 500);
        }
    }

    function updateNotificationCount() {
        const count = notifications.length;
        notificationCount.textContent = count;
        notificationCount.style.display = count > 0 ? 'flex' : 'none';
    }

    function formatTimeAgo(timestamp) {
        const now = new Date();
        const time = new Date(timestamp);
        const diff = Math.floor((now - time) / 1000);

        if (diff < 60) return 'Just now';
        if (diff < 3600) return `${Math.floor(diff / 60)}m ago`;
        if (diff < 86400) return `${Math.floor(diff / 3600)}h ago`;
        return `${Math.floor(diff / 86400)}d ago`;
    }

    function renderNotifications() {
        if (notifications.length === 0) {
            notificationList.innerHTML = `
                <div class="notification-empty">
                    <i class="fas fa-bell-slash fa-2x mb-3" style="opacity: 0.5;"></i>
                    <p>No notifications yet</p>
                    <small>Notifications will appear here when services are created</small>
                </div>
            `;
            return;
        }

        notificationList.innerHTML = notifications.map(notification => `
            <div class="notification-item">
                <div class="notification-icon" style="background: linear-gradient(135deg, #4facfe, #00f2fe);">
                    <i class="${notification.icon}"></i>
                </div>
                <div class="notification-content">
                    <div class="notification-title">${notification.title}</div>
                    <div class="notification-message">${notification.message}</div>
                    <div class="notification-time">${formatTimeAgo(notification.timestamp)}</div>
                </div>
            </div>
        `).join('');
    }

    if (notificationBell && notificationDropdown) {
        notificationBell.addEventListener('click', function(e) {
            e.stopPropagation();
            notificationDropdown.classList.toggle('show');

            // Mark notifications as read (optional)
            if (notificationDropdown.classList.contains('show')) {
                setTimeout(() => {
                    notificationDropdown.classList.remove('show');
                }, 5000); // Auto-hide after 5 seconds
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!notificationBell.contains(e.target) && !notificationDropdown.contains(e.target)) {
                notificationDropdown.classList.remove('show');
            }
        });
    }

    // Initialize notifications
    updateNotificationCount();
    renderNotifications();

    // Initialize scroll indicator
    const scrollIndicator = document.getElementById('scrollIndicator');
    const navElement = document.querySelector('.modern-nav');

    function updateScrollIndicator() {
        if (navElement.scrollHeight > navElement.clientHeight) {
            scrollIndicator.classList.add('show');
        } else {
            scrollIndicator.classList.remove('show');
        }
    }

    // Update scroll indicator on load and scroll
    if (navElement) {
        navElement.addEventListener('scroll', updateScrollIndicator);
        window.addEventListener('resize', updateScrollIndicator);
        // Initial check
        setTimeout(updateScrollIndicator, 100);
    }

    // Simulate real-time notifications (for demo purposes)
    function simulateActivity() {
        const activities = [
            { type: 'project', title: 'New Project Created', message: 'A new project has been added to the system', icon: 'fas fa-project-diagram' },
            { type: 'program', title: 'Program Updated', message: 'An existing program has been modified', icon: 'fas fa-calendar-alt' },
            { type: 'participant', title: 'New Participant', message: 'A new participant has joined', icon: 'fas fa-users' },
            { type: 'service', title: 'Service Added', message: 'A new service is now available', icon: 'fas fa-cogs' },
            { type: 'equipment', title: 'Equipment Added', message: 'New equipment has been registered', icon: 'fas fa-tools' }
        ];

        // Randomly trigger notifications every 30-60 seconds (for demo)
        const randomDelay = Math.random() * 30000 + 30000; // 30-60 seconds
        setTimeout(() => {
            const randomActivity = activities[Math.floor(Math.random() * activities.length)];
            addNotification(randomActivity.type, randomActivity.title, randomActivity.message, randomActivity.icon);
            simulateActivity(); // Schedule next
        }, randomDelay);
    }

    // Start simulation after 10 seconds
     setTimeout(simulateActivity, 10000);

     // Activity tracking functions
     function addUserActivity(type, action, details = '', entityName = '') {
         const activity = {
             id: Date.now(),
             type: type,
             action: action,
             details: details,
             entityName: entityName,
             timestamp: new Date().toISOString()
         };

         userActivities.unshift(activity);

         // Keep only latest 10 activities
         if (userActivities.length > 10) {
             userActivities = userActivities.slice(0, 10);
         }

         // Save to session storage
         sessionStorage.setItem('userActivities', JSON.stringify(userActivities));

         // Update activity display
         renderUserActivities();

         // Add notification for significant activities
         if (['create', 'delete', 'update'].includes(action)) {
             const config = activityConfigs[type];
             if (config) {
                 const title = `${config.title}: ${action}`;
                 const message = `${action} operation performed on ${entityName || type}`;
                 addNotification(type, title, message, config.icon);
             }
         }
     }

     function renderUserActivities() {
         const activityList = document.getElementById('activityList');
         if (!activityList) return;

         if (userActivities.length === 0) {
             activityList.innerHTML = `
                 <div class="text-center text-muted py-4">
                     <i class="fas fa-inbox fa-2x mb-3" style="opacity: 0.5;"></i>
                     <p>No recent activities</p>
                     <small>Activities will appear here when you perform actions</small>
                 </div>
             `;
             return;
         }

         activityList.innerHTML = userActivities.map(activity => {
             const config = activityConfigs[activity.type] || activityConfigs.project;
             const timeAgo = formatTimeAgo(activity.timestamp);

             return `
                 <div class="activity-item">
                     <div class="activity-icon" style="background: ${config.color};">
                         <i class="${config.icon}"></i>
                     </div>
                     <div class="activity-content">
                         <div class="activity-title">${activity.action} ${activity.entityName || activity.type}</div>
                         <div class="activity-time">${timeAgo}</div>
                     </div>
                 </div>
             `;
         }).join('');
     }

     // Track page visits and actions
     function trackPageVisit(page) {
         const pageActivityMap = {
             'projects': 'project',
             'programs': 'program',
             'participants': 'participant',
             'equipment': 'equipment',
             'services': 'service',
             'facilities': 'facility',
             'outcomes': 'outcome',
             'settings': 'settings'
         };

         const activityType = pageActivityMap[page];
         if (activityType) {
             addUserActivity(activityType, 'visited', `Accessed ${page} page`, page);
         }
     }

     // Track form submissions and creations
     function trackEntityCreation(entityType, entityName) {
         addUserActivity(entityType, 'created', `Created new ${entityType}`, entityName);
     }

     function trackEntityUpdate(entityType, entityName) {
         addUserActivity(entityType, 'updated', `Updated ${entityType}`, entityName);
     }

     function trackEntityDeletion(entityType, entityName) {
         addUserActivity(entityType, 'deleted', `Deleted ${entityType}`, entityName);
     }

     // Initialize activities display
     renderUserActivities();

    // Global function to add notifications from other pages
    window.addDashboardNotification = function(type, title, message, icon = 'fas fa-info-circle') {
        addNotification(type, title, message, icon);
    };

    // Global function to update activity counts
    window.updateActivityCount = function(type, count) {
        if (recentActivities.hasOwnProperty(type)) {
            recentActivities[type] = count;
        }
    };

    // Sidebar toggle functionality for mobile
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('modernSidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    function toggleSidebar() {
        sidebar.classList.toggle('show');
        sidebarOverlay.classList.toggle('show');

        // Update toggle button icon
        const icon = sidebarToggle.querySelector('i');
        if (sidebar.classList.contains('show')) {
            icon.className = 'fas fa-times';
        } else {
            icon.className = 'fas fa-bars';
        }
    }

    function closeSidebar() {
        sidebar.classList.remove('show');
        sidebarOverlay.classList.remove('show');
        const icon = sidebarToggle.querySelector('i');
        icon.className = 'fas fa-bars';
    }

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', toggleSidebar);
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', closeSidebar);
    }

    // Close sidebar when clicking on navigation links (mobile)
    document.querySelectorAll('.modern-nav-link').forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth <= 768) {
                closeSidebar();
            }
        });
    });

    // Handle window resize
    window.addEventListener('resize', () => {
        if (window.innerWidth > 768) {
            closeSidebar();
        }
    });

    // Add loading states to quick actions
     document.querySelectorAll('.quick-action-btn').forEach(btn => {
         btn.addEventListener('click', function(e) {
             e.preventDefault();
             const originalContent = this.innerHTML;
             this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
             this.style.pointerEvents = 'none';

             setTimeout(() => {
                 this.innerHTML = originalContent;
                 this.style.pointerEvents = 'auto';
                 window.location.href = this.href;
             }, 1000);
         });
     });

     // Initialize performance chart when modal is shown
     const metricsModal = document.getElementById('metricsModal');
     if (metricsModal) {
         metricsModal.addEventListener('show.bs.modal', function() {
             initializePerformanceChart();
         });
     }

     function initializePerformanceChart() {
         const ctx = document.getElementById('performanceChart');
         if (!ctx) return;

         // Destroy existing chart if it exists
         if (window.performanceChartInstance) {
             window.performanceChartInstance.destroy();
         }

         window.performanceChartInstance = new Chart(ctx, {
             type: 'line',
             data: {
                 labels: ['1h ago', '45m ago', '30m ago', '15m ago', 'Now'],
                 datasets: [{
                     label: 'CPU Usage (%)',
                     data: [18, 22, 25, 20, 23],
                     borderColor: '#667eea',
                     backgroundColor: 'rgba(102, 126, 234, 0.1)',
                     tension: 0.4,
                     fill: true
                 }, {
                     label: 'Memory Usage (%)',
                     data: [42, 45, 48, 44, 45],
                     borderColor: '#f093fb',
                     backgroundColor: 'rgba(240, 147, 251, 0.1)',
                     tension: 0.4,
                     fill: true
                 }]
             },
             options: {
                 responsive: true,
                 maintainAspectRatio: false,
                 plugins: {
                     legend: {
                         position: 'top',
                     },
                     title: {
                         display: true,
                         text: 'Performance Trends (Last Hour)'
                     }
                 },
                 scales: {
                     y: {
                         beginAtZero: true,
                         max: 100
                     }
                 }
             }
         });
     }

     // Track current page visit
     const currentPath = window.location.pathname;
     const pathSegments = currentPath.split('/').filter(Boolean);
     if (pathSegments.length > 0) {
         const currentPage = pathSegments[0];
         if (currentPage === 'dashboard' || pathSegments.length === 0) {
             addUserActivity('dashboard', 'visited', 'Accessed dashboard', 'Dashboard');
         } else {
             trackPageVisit(currentPage);
         }
     }

     // Global functions for other pages to call
     window.trackEntityCreation = trackEntityCreation;
     window.trackEntityUpdate = trackEntityUpdate;
     window.trackEntityDeletion = trackEntityDeletion;
     window.trackPageVisit = trackPageVisit;
 });
</script>

<?= $this->endSection() ?>
