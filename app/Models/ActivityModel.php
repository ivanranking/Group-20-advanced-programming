<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityModel extends Model
{
    protected $table = 'activities';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'user_id', 'action', 'entity_type', 'entity_id',
        'description', 'metadata', 'ip_address', 'user_agent', 'created_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'user_id' => 'permit_empty|integer',
        'action' => 'required|string|max_length[100]',
        'entity_type' => 'required|string|max_length[50]',
        'entity_id' => 'permit_empty|integer',
        'description' => 'required|string|max_length[255]',
        'metadata' => 'permit_empty|string',
        'ip_address' => 'permit_empty|string|max_length[45]',
        'user_agent' => 'permit_empty|string|max_length[500]'
    ];

    /**
     * Log user activity
     */
    public function logActivity($action, $entityType, $entityId = null, $description = null, $metadata = null)
    {
        $userId = session()->get('user_id') ?? null;

        $activityData = [
            'user_id' => $userId,
            'action' => $action,
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'description' => $description ?? $this->generateDescription($action, $entityType, $entityId),
            'metadata' => $metadata ? json_encode($metadata) : null,
            'ip_address' => $this->getClientIP(),
            'user_agent' => $this->getUserAgent()
        ];

        return $this->insert($activityData);
    }

    /**
     * Get recent activities
     */
    public function getRecentActivities($limit = 10)
    {
        return $this->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->find();
    }

    /**
     * Get activities by entity
     */
    public function getActivitiesByEntity($entityType, $entityId)
    {
        return $this->where('entity_type', $entityType)
                    ->where('entity_id', $entityId)
                    ->orderBy('created_at', 'DESC')
                    ->find();
    }

    /**
     * Get activities by user
     */
    public function getActivitiesByUser($userId, $limit = 20)
    {
        return $this->where('user_id', $userId)
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->find();
    }

    /**
     * Generate activity description
     */
    private function generateDescription($action, $entityType, $entityId)
    {
        $entityNames = [
            'participant' => 'Participant',
            'project' => 'Project',
            'program' => 'Program',
            'equipment' => 'Equipment',
            'service' => 'Service',
            'outcome' => 'Outcome',
            'facility' => 'Facility'
        ];

        $actionLabels = [
            'create' => 'created',
            'update' => 'updated',
            'delete' => 'deleted',
            'view' => 'viewed',
            'login' => 'logged in',
            'logout' => 'logged out'
        ];

        $entityName = $entityNames[$entityType] ?? ucfirst($entityType);
        $actionLabel = $actionLabels[$action] ?? $action;

        return "{$entityName} {$actionLabel}" . ($entityId ? " (ID: {$entityId})" : '');
    }

    /**
     * Get client IP address
     */
    private function getClientIP()
    {
        $ipAddress = '';

        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipAddress = $_SERVER['HTTP_X_FORWARDED'];
        } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipAddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
            $ipAddress = $_SERVER['HTTP_FORWARDED'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ipAddress = $_SERVER['REMOTE_ADDR'];
        }

        return $ipAddress;
    }

    /**
     * Get user agent
     */
    private function getUserAgent()
    {
        return $_SERVER['HTTP_USER_AGENT'] ?? '';
    }

    /**
     * Clean old activities (keep last 30 days)
     */
    public function cleanOldActivities($days = 30)
    {
        $dateThreshold = date('Y-m-d H:i:s', strtotime("-{$days} days"));
        return $this->where('created_at <', $dateThreshold)->delete();
    }
}