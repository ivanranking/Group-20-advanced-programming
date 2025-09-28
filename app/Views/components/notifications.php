<!-- Real-time Notifications Component -->
<div class="notifications-panel" id="notificationsPanel">
    <div class="notifications-header">
        <h3><i class="fas fa-bell"></i> Recent Activity</h3>
        <div class="notifications-controls">
            <button class="btn btn-sm btn-outline-primary" onclick="refreshNotifications()">
                <i class="fas fa-sync-alt"></i> Refresh
            </button>
            <button class="btn btn-sm btn-outline-secondary" onclick="toggleAutoRefresh()">
                <i class="fas fa-pause" id="autoRefreshIcon"></i> <span id="autoRefreshText">Pause</span>
            </button>
        </div>
    </div>

    <div class="notifications-body">
        <div class="notifications-list" id="notificationsList">
            <!-- Notifications will be loaded here -->
        </div>

        <div class="notifications-loading" id="notificationsLoading" style="display: none;">
            <div class="text-center py-3">
                <div class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <small class="text-muted d-block mt-1">Loading activities...</small>
            </div>
        </div>

        <div class="notifications-empty" id="notificationsEmpty" style="display: none;">
            <div class="text-center py-4">
                <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                <p class="text-muted mb-0">No recent activities</p>
            </div>
        </div>
    </div>

    <div class="notifications-footer">
        <a href="#" class="text-decoration-none">
            <i class="fas fa-cog"></i> Notification Settings
        </a>
    </div>
</div>

<!-- Notification Item Template -->
<template id="notificationTemplate">
    <div class="notification-item" data-activity-id="">
        <div class="notification-icon">
            <i class="fas"></i>
        </div>
        <div class="notification-content">
            <div class="notification-message"></div>
            <div class="notification-time"></div>
        </div>
        <div class="notification-actions">
            <button class="btn btn-sm btn-outline-danger" onclick="dismissNotification(this)" title="Dismiss">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
</template>

<style>
.notifications-panel {
    background: var(--surface-color);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-lg);
    border: 1px solid rgba(255, 255, 255, 0.1);
    overflow: hidden;
    max-height: 500px;
    display: flex;
    flex-direction: column;
}

.notifications-header {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.notifications-header h3 {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
}

.notifications-controls {
    display: flex;
    gap: 8px;
}

.btn-outline-primary {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.3);
    color: white;
}

.btn-outline-primary:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: rgba(255, 255, 255, 0.5);
    color: white;
}

.btn-outline-secondary {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.3);
    color: white;
}

.btn-outline-secondary:hover {
    background: rgba(255, 255, 255, 0.2);
    color: white;
}

.notifications-body {
    flex: 1;
    overflow-y: auto;
    max-height: 350px;
}

.notifications-list {
    padding: 0;
}

.notification-item {
    display: flex;
    align-items: center;
    padding: 12px 15px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    transition: background-color 0.2s ease;
    position: relative;
}

.notification-item:hover {
    background-color: rgba(102, 126, 234, 0.05);
}

.notification-item:last-child {
    border-bottom: none;
}

.notification-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 12px;
    flex-shrink: 0;
}

.notification-icon.success {
    background: rgba(67, 233, 123, 0.1);
    color: #38a169;
}

.notification-icon.danger {
    background: rgba(250, 112, 154, 0.1);
    color: #c53030;
}

.notification-icon.primary {
    background: rgba(102, 126, 234, 0.1);
    color: #667eea;
}

.notification-icon.info {
    background: rgba(74, 172, 254, 0.1);
    color: #4facfe;
}

.notification-icon.warning {
    background: rgba(250, 224, 64, 0.1);
    color: #d69e2e;
}

.notification-content {
    flex: 1;
    min-width: 0;
}

.notification-message {
    font-size: 0.9rem;
    color: var(--text-primary);
    margin-bottom: 2px;
    font-weight: 500;
}

.notification-time {
    font-size: 0.75rem;
    color: var(--text-secondary);
}

.notification-actions {
    margin-left: 10px;
    opacity: 0;
    transition: opacity 0.2s ease;
}

.notification-item:hover .notification-actions {
    opacity: 1;
}

.notifications-footer {
    padding: 12px 15px;
    background: rgba(0, 0, 0, 0.02);
    border-top: 1px solid rgba(0, 0, 0, 0.05);
    text-align: center;
}

.notifications-footer a {
    color: var(--text-secondary);
    font-size: 0.85rem;
    transition: color 0.2s ease;
}

.notifications-footer a:hover {
    color: var(--primary-color);
}

/* Animation for new notifications */
@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(100%);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.notification-item.new {
    animation: slideInRight 0.3s ease-out;
    background-color: rgba(102, 126, 234, 0.1);
}

/* Responsive design */
@media (max-width: 768px) {
    .notifications-panel {
        max-height: 400px;
    }

    .notifications-body {
        max-height: 280px;
    }

    .notifications-header {
        padding: 12px 15px;
    }

    .notifications-controls {
        gap: 5px;
    }

    .btn {
        padding: 6px 10px;
        font-size: 0.8rem;
    }
}
</style>

<script>
class NotificationManager {
    constructor() {
        this.autoRefreshInterval = null;
        this.isAutoRefreshEnabled = true;
        this.lastUpdateTime = null;
        this.notificationCount = 0;

        this.init();
    }

    init() {
        this.loadNotifications();
        this.startAutoRefresh();
        this.bindEvents();
    }

    bindEvents() {
        // Listen for real-time updates from other parts of the app
        window.addEventListener('activityUpdate', (event) => {
            this.handleRealTimeUpdate(event.detail);
        });

        // Listen for new activities
        window.addEventListener('newActivity', (event) => {
            this.addNotification(event.detail, true);
        });
    }

    async loadNotifications() {
        const loadingEl = document.getElementById('notificationsLoading');
        const emptyEl = document.getElementById('notificationsEmpty');
        const listEl = document.getElementById('notificationsList');

        try {
            loadingEl.style.display = 'block';
            emptyEl.style.display = 'none';

            const params = new URLSearchParams();
            params.append('limit', '10');
            if (this.lastUpdateTime) {
                params.append('since', this.lastUpdateTime);
            }

            const response = await fetch(`<?= site_url('notifications/recent') ?>?${params}`);
            const data = await response.json();

            if (data.success) {
                this.lastUpdateTime = data.timestamp;

                if (data.activities.length > 0) {
                    listEl.innerHTML = '';
                    data.activities.forEach(activity => {
                        this.addNotification(activity, false);
                    });
                    this.notificationCount = data.total;
                } else {
                    this.showEmptyState();
                }
            } else {
                this.showEmptyState();
            }
        } catch (error) {
            console.error('Error loading notifications:', error);
            this.showEmptyState();
        } finally {
            loadingEl.style.display = 'none';
        }
    }

    addNotification(activity, animate = false) {
        const listEl = document.getElementById('notificationsList');
        const template = document.getElementById('notificationTemplate');
        const notificationEl = template.content.cloneNode(true);

        const itemEl = notificationEl.querySelector('.notification-item');
        const iconEl = notificationEl.querySelector('.notification-icon i');
        const messageEl = notificationEl.querySelector('.notification-message');
        const timeEl = notificationEl.querySelector('.notification-time');

        // Set data attributes
        itemEl.dataset.activityId = activity.id;

        // Set icon and color
        iconEl.className = `fas fa-${activity.icon}`;
        itemEl.querySelector('.notification-icon').classList.add(activity.color);

        // Set content
        messageEl.textContent = activity.description;
        timeEl.textContent = activity.time_ago;

        // Add animation class if needed
        if (animate) {
            itemEl.classList.add('new');
        }

        // Add to list
        listEl.insertBefore(notificationEl, listEl.firstChild);

        // Update count
        this.notificationCount++;
        this.updateNotificationBadge();
    }

    handleRealTimeUpdate(activity) {
        this.addNotification(activity, true);
    }

    showEmptyState() {
        document.getElementById('notificationsEmpty').style.display = 'block';
        document.getElementById('notificationsList').innerHTML = '';
        this.notificationCount = 0;
        this.updateNotificationBadge();
    }

    updateNotificationBadge() {
        // Update notification badge in header if it exists
        const badge = document.querySelector('.notification-badge');
        if (badge) {
            badge.textContent = this.notificationCount;
            badge.style.display = this.notificationCount > 0 ? 'inline' : 'none';
        }
    }

    startAutoRefresh() {
        if (this.autoRefreshInterval) {
            clearInterval(this.autoRefreshInterval);
        }

        this.autoRefreshInterval = setInterval(() => {
            if (this.isAutoRefreshEnabled) {
                this.loadNotifications();
            }
        }, 30000); // Refresh every 30 seconds
    }

    stopAutoRefresh() {
        if (this.autoRefreshInterval) {
            clearInterval(this.autoRefreshInterval);
            this.autoRefreshInterval = null;
        }
    }

    refreshNotifications() {
        this.loadNotifications();
    }

    toggleAutoRefresh() {
        this.isAutoRefreshEnabled = !this.isAutoRefreshEnabled;

        const iconEl = document.getElementById('autoRefreshIcon');
        const textEl = document.getElementById('autoRefreshText');

        if (this.isAutoRefreshEnabled) {
            iconEl.className = 'fas fa-pause';
            textEl.textContent = 'Pause';
            this.startAutoRefresh();
        } else {
            iconEl.className = 'fas fa-play';
            textEl.textContent = 'Resume';
            this.stopAutoRefresh();
        }
    }

    dismissNotification(button) {
        const notificationEl = button.closest('.notification-item');
        notificationEl.style.opacity = '0';
        notificationEl.style.transform = 'translateX(100%)';

        setTimeout(() => {
            notificationEl.remove();
            this.notificationCount--;
            this.updateNotificationBadge();
        }, 300);
    }
}

// Initialize notification manager when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    window.notificationManager = new NotificationManager();
});

// Global function to trigger activity updates
window.triggerActivityUpdate = function(action, entityType, entityId, description, metadata = null) {
    const activity = {
        id: Date.now(),
        action: action,
        entity_type: entityType,
        entity_id: entityId,
        description: description,
        metadata: metadata,
        created_at: new Date().toISOString(),
        time_ago: 'Just now',
        icon: getActivityIcon(action, entityType),
        color: getActivityColor(action)
    };

    // Dispatch custom event for real-time updates
    window.dispatchEvent(new CustomEvent('newActivity', { detail: activity }));
};

function getActivityIcon(action, entityType) {
    const icons = {
        'create': 'plus-circle',
        'update': 'edit',
        'delete': 'trash',
        'view': 'eye',
        'login': 'sign-in-alt',
        'logout': 'sign-out-alt'
    };

    const entityIcons = {
        'participant': 'user',
        'project': 'project-diagram',
        'program': 'cogs',
        'equipment': 'tools',
        'service': 'wrench',
        'outcome': 'chart-bar',
        'facility': 'building'
    };

    return icons[action] || entityIcons[entityType] || 'info-circle';
}

function getActivityColor(action) {
    const colors = {
        'create': 'success',
        'update': 'primary',
        'delete': 'danger',
        'view': 'info',
        'login': 'warning',
        'logout': 'secondary'
    };

    return colors[action] || 'info';
}
</script>