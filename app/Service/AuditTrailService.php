<?php

namespace App\Service;

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
    public function saveActivity(string $activity, string $createdBy)
    {
        $this->auditTrailRepository->create([
            'action' => $activity,
            'created_by' => $createdBy
        ]);
    }
}
