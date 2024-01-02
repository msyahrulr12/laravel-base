<?php

namespace App\Service;

use App\Models\AuditTrail;
use App\Repositories\AuditTrailRepository;

class AuditTrailService
{
    private $auditTrailRepository;

    public function __construct(
        AuditTrailRepository $auditTrailRepository
    )
    {
        $this->auditTrailRepository = $auditTrailRepository;
    }

    /**
     * @param string $activity
     * @param string $createdBy
     *
     * @return bool
     */
    public static function saveActivity(string $activity, string $createdBy)
    {
        AuditTrail::create([
            'action' => $activity,
            'created_by' => $createdBy
        ]);
    }
}
