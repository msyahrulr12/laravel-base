<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QrCodeReceiverController extends Controller
{
    public function scan(Request $request)
    {
        return view('client.qr-code.scan');
    }
}
