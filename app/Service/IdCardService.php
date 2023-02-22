<?php

namespace App\Service;

use App\Models\CardMember;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;

class IdCardService
{
    /**
     * App\Models\User $user
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function generate()
    {
        $publicStorage = Storage::disk('public');

        $cardMember = CardMember::first();

        # get front background image card
        $frontBackgroundImage = $cardMember->front_background_image;
        $frontBackgroundImageContent = File::get($publicStorage->path($frontBackgroundImage));
        $frontBackgroundImageExtension = File::extension($frontBackgroundImage);
        $frontBackgroundImageSrc = Image::make($frontBackgroundImageContent);
        $filename = date('YmdHisz').'_'.$this->user->id.'_.'.$frontBackgroundImageExtension;

        # get profile image user
        $profileImageHeight = $cardMember->profile_height;
        $profileImageWidth = $cardMember->profile_width;
        $profileImagePosition = $cardMember->profile_position;
        $profileImageOffsetX = $cardMember->profile_offset_x;
        $profileImageOffsetY = $cardMember->profile_offset_y;
        $profileImage = $this->user->profile_image;
        $profileImageContent = File::get($publicStorage->path($profileImage));
        $profileImageSrc = Image::make($profileImageContent)->resize($profileImageWidth, $profileImageHeight);

        # get qr code image
        $qrcodeImageHeight = $cardMember->qrcode_height;
        $qrcodeImageWidth = $cardMember->qrcode_width;
        $qrcodeImagePosition = $cardMember->qrcode_position;
        $qrcodeImageOffsetX = $cardMember->qrcode_offset_x;
        $qrcodeImageOffsetY = $cardMember->qrcode_offset_y;
        $qrcodeImage = $this->user->qrcode_image;
        $qrcodeImageContent = File::get($publicStorage->path($qrcodeImage));
        $qrcodeImageSrc = Image::make($qrcodeImageContent)->resize($qrcodeImageWidth, $qrcodeImageHeight);

        $img = imagecreate(500, 100);

        $textbgcolor = imagecolorallocate($img, 173, 230, 181);
        $textcolor = imagecolorallocate($img, 0, 192, 255);
        $txt = $this->user->name;
        imagestring($img, 5, 5, 5, $txt, $textcolor);
        ob_start();
        imagepng($img);
        ob_clean();
        $nameImage = $img;

        $nameImageHeight = $cardMember->name_height;
        $nameImageWidth = $cardMember->name_width;
        $nameImagePosition = $cardMember->name_position;
        $nameImageOffsetX = $cardMember->name_offset_x;
        $nameImageOffsetY = $cardMember->name_offset_y;
        // printf('<img src="data:image/png;base64,%s"/ width="100">', base64_encode(ob_get_clean()));

        $frontBackgroundImageSrc
            ->insert($nameImage, $nameImagePosition, $nameImageOffsetX, $nameImageOffsetY)
            ->insert($profileImageSrc, $profileImagePosition, $profileImageOffsetX, $profileImageOffsetY)
            ->insert($qrcodeImageSrc, $qrcodeImagePosition, $qrcodeImageOffsetX, $qrcodeImageOffsetY)
            ->save(storage_path('app/public/').$filename);
        dd($filename);

        $srcImage = $this->user->qrcode_image;
        // dd($publicStorage->url($srcImage));
        $insertImage = $this->user->profile_image;
        // dd($insertImage);
        // dd($publicStorage->url($insertImage));
        $srcImaageContent = File::get($publicStorage->path($srcImage));
        $srcImageExtension = File::extension($publicStorage->path($srcImage));
        $insertImageContent = File::get($publicStorage->path($insertImage));
        $insertImageExtension = File::extension($publicStorage->path($insertImage));

        $img = Image::make($srcImaageContent);
        $insertImage = Image::make($insertImageContent);
        $filename = storage_path('app/public/').'TEST_'.date('YmdHisz').'.'.$srcImageExtension;
        $data = $img->insert($insertImage, 'center', 10, 10)->save($filename);
        // $publicStorage->put($filename, $data);

        dd($publicStorage->path($filename));

        // $path = $publicStorage->put(, $data);
        dd($publicStorage->path($filename));

        return $data;
    }

    private function insertProfileImage($srcImage, CardMember $cardMember)
    {

    }
}
