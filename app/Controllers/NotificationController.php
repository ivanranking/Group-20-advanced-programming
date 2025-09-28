<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ActivityModel;

class NotificationController extends BaseController
{
    protected $activityModel;

    public function __construct()
    {
        $this->activityModel = new ActivityModel();
    }

    /**
     * Get recent activities for real-time updates
     */
    public function getRecentActivities()
    {
        $limit = $this->request->getGet('limit') ?? 10;
        $since = $this->request->getGet('since');

        $query = $this->activityModel->orderBy('created_at', 'DESC')->limit($limit);

        if ($since) {
            $query = $query->where('created_at >', $since);
        }

        $activities = $query->find();

        // Format activities for frontend
        $formattedActivities = array_map(function($activity) {
            return [
                'id' => $activity['id'],
                'action' => $activity['action'],
                'entity_type' => $activity['entity_type'],
                'entity_id' => $activity['entity_id'],
                'description' => $activity['description'],
                'metadata' => $activity['metadata'] ? json_decode($activity['metadata'], true) : null,
                'created_at' => $activity['created_at'],
                'time_ago' => $this->timeAgo($activity['created_at']),
                'icon' => $this->getActivityIcon($activity['action'], $activity['entity_type']),
                'color' => $this->getActivityColor($activity['action'])
            ];
        }, $activities);

        return $this->response->setJSON([
            'success' => true,
            'activities' => $formattedActivities,
            'total' => count($formattedActivities),
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Get notification count
     */
    public function getNotificationCount()
    {
        $since = $this->request->getGet('since');
        $query = $this->activityModel;

        if ($since) {
            $query = $query->where('created_at >', $since);
        }

        $count = $query->countAllResults();

        return $this->response->setJSON([
            'success' => true,
            'count' => $count,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Mark notifications as read
     */
    public function markAsRead()
    {
        $activityIds = $this->request->getPost('activity_ids');

        if ($activityIds) {
            // In a real application, you might have a read status field
            // For now, we'll just return success
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Notifications marked as read'
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'No activity IDs provided'
        ]);
    }

    /**
     * Get activity statistics
     */
    public function getActivityStats()
    {
        $today = date('Y-m-d');
        $thisWeek = date('Y-m-d', strtotime('-7 days'));
        $thisMonth = date('Y-m-d', strtotime('-30 days'));

        $stats = [
            'today' => $this->activityModel->where('DATE(created_at)', $today)->countAllResults(),
            'this_week' => $this->activityModel->where('created_at >=', $thisWeek)->countAllResults(),
            'this_month' => $this->activityModel->where('created_at >=', $thisMonth)->countAllResults(),
            'total' => $this->activityModel->countAllResults()
        ];

        // Get activity breakdown by type
        $activityBreakdown = $this->activityModel->select('entity_type, COUNT(*) as count')
                                                 ->groupBy('entity_type')
                                                 ->orderBy('count', 'DESC')
                                                 ->find();

        return $this->response->setJSON([
            'success' => true,
            'stats' => $stats,
            'breakdown' => $activityBreakdown
        ]);
    }

    /**
     * Helper: Get time ago format
     */
    private function timeAgo($datetime)
    {
        $time = strtotime($datetime);
        $now = time();
        $diff = $now - $time;

        if ($diff < 60) {
            return 'Just now';
        } elseif ($diff < 3600) {
            return floor($diff / 60) . ' minutes ago';
        } elseif ($diff < 86400) {
            return floor($diff / 3600) . ' hours ago';
        } elseif ($diff < 2592000) {
            return floor($diff / 86400) . ' days ago';
        } else {
            return date('M j, Y', $time);
        }
    }

    /**
     * Helper: Get activity icon
     */
    private function getActivityIcon($action, $entityType)
    {
        $icons = [
            'create' => 'plus-circle',
            'update' => 'edit',
            'delete' => 'trash',
            'view' => 'eye',
            'login' => 'sign-in-alt',
            'logout' => 'sign-out-alt'
        ];

        $entityIcons = [
            'participant' => 'user',
            'project' => 'project-diagram',
            'program' => 'cogs',
            'equipment' => 'tools',
            'service' => 'wrench',
            'outcome' => 'chart-bar',
            'facility' => 'building'
        ];

        return $icons[$action] ?? $entityIcons[$entityType] ?? 'info-circle';
    }

    /**
     * Helper: Get activity color
     */
    private function getActivityColor($action)
    {
        $colors = [
            'create' => 'success',
            'update' => 'primary',
            'delete' => 'danger',
            'view' => 'info',
            'login' => 'warning',
            'logout' => 'secondary'
        ];

        return $colors[$action] ?? 'info';
    }
}