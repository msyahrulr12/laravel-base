<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service\AuditTrailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    public const TYPE_TEXT = 'text';
    public const TYPE_IMAGE = 'img';
    public const TYPE_FILE = 'file';
    public const TYPE_LINK = 'link';
    public const TYPE_BOOLEAN = 'boolean';
    public const TYPE_BELONGS_TO = 'belongs_to';
    public const TYPE_MANY_TO_MANY = 'many_to_many';

    protected $commonView = 'pages.admin.common.';

    public function checkPermission($permission)
    {
        if (!Auth::user()->hasPermissionTo($permission)) abort(403);
    }

    public function getUser()
    {
        return Auth::user();
    }

    /**
     * @param string $activity
     * @param string $createdBy
     *
     * @return void
     */
    public function writeAuditTrail(string $activity, string $createdBy)
    {
        AuditTrailService::saveActivity($activity, $createdBy);

        return;
    }
}
