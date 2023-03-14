<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class QrCodeReceiverController extends Controller
{
    public function scan(Request $request)
    {
        $code = $request->query('code');
        $serialNumber = substr($code, 6);

        $user = User::whereSerialNumber($serialNumber)->first();
        if (!$user) abort(404);

        return view('pages.client.qr-code.scan', [
            'user' => $user
        ]);
    }
}
