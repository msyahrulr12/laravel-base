<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use QrCode;

class QrCodeService
{
    /**
     * App\Models\User $user
     */
    private $user;
    private $filename;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function generate()
    {
        $publicStorage = Storage::disk('public');
        $code = $this->getUniqueCode();
        $link = sprintf('%s?code=%s', route('scan'), $code);
        $filename = $code.'.png';
        $this->filename = $filename;
        $path = $publicStorage->path($filename);
        QrCode::format('png')->size(500)->generate($link, $path);

        return $path;
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function getUniqueCode()
    {
        $currentSerialNumber = User::getCurrentSerialNumber();
        $regionCode = $this->user->region->code;
        $yearNow = date('Y');
        $year = substr($yearNow, 2, 4);
        $month = date('m');
        $code = $regionCode.$year.$month.$currentSerialNumber;
        return $code;
    }
}
