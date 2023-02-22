<?php

namespace App\Service;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadHelper
{
    /**
     * Illuminate\Http\UploadedFile $file
     */
    private $file;

    /**
     * Filename without extension $filename
     */
    private $filename;

    /**
     * Filename with extension $fullname
     */
    private $fullname;

    public function __construct(UploadedFile $file, $filename = null)
    {
        $this->file = $file;
        $this->filename = $filename;
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function getExtension()
    {
        return $this->file->getClientOriginalExtension();
    }

    public function compress($source, $destination, $quality = 75)
    {
        $mimeType = $this->file->getClientMimeType();
        $destination = null;
        if (in_array($mimeType, [
            'image/jpeg',
            'image/gif',
            'image/png',
        ])) {
            $info = getimagesize($source);
            if ($info['mime'] == 'image/jpeg') {
              $image = imagecreatefromjpeg($source);
            } elseif ($info['mime'] == 'image/gif') {
              $image = imagecreatefromgif($source);
            } elseif ($info['mime'] == 'image/png') {
              $image = imagecreatefrompng($source);
            }
            imagejpeg($image, $destination, $quality);
        }

        return $destination;
      }

    public function upload($oldFile = null)
    {
        if (!$this->filename) {
            $this->filename = time().Str::random(10);
        }

        $publicStorage = Storage::disk('public');
        $this->fullname = $this->filename . '.' . $this->file->getClientOriginalExtension();
        $fullPath = $publicStorage->path($this->fullname);
        $compressFile = $this->compress($this->file, $fullPath, 50);
        if ($compressFile) {
            $dataFile = $compressFile;
        } else {
            $dataFile = $this->file;
        }

        $upload = $publicStorage->put($this->fullname, file_get_contents($dataFile));

        if ($oldFile) {
            $publicStorage->delete($oldFile);
        }

        return $upload;
    }

    public function getFullName()
    {
        return $this->fullname;
    }

    public static function delete($oldFile)
    {
        $publicStorage = Storage::disk('public');
        $publicStorage->delete($oldFile);
    }
}
