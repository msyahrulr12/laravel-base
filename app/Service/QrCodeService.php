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
        $code = self::getUniqueCode($this->user->region->code, $this->user);
        $link = sprintf('%s?code=%s', route('scan'), $code);
        $filename = $code.'.png';
        $this->filename = $filename;
        $path = $publicStorage->path($filename);
        QrCode::format('png')->size(500)->generate($link, $path);

        return $path;
    }

    public static function generateExample()
    {
        $publicStorage = Storage::disk('public');
        $code = self::getUniqueCode('EXMPL');
        $link = sprintf('%s?code=%s', route('scan'), $code);
        $filename = $code.'.png';
        $path = $publicStorage->path($filename);
        QrCode::format('png')->size(500)->generate($link, $path);

        return $filename;
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public static function getUniqueCode($regionCode, $user)
    {
        $currentSerialNumber = $user->serial_number ? $user->serial_number : User::getCurrentSerialNumber();
        $yearNow = date('Y');
        $year = substr($yearNow, 2, 4);
        $month = date('m');
        $code = $regionCode.$year.$month.$currentSerialNumber;
        return $code;
    }
}
