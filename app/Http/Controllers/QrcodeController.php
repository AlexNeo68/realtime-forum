<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrcodeController extends Controller
{
    public function get() {
       return QrCode::generate('http://www.simplesoftware.io');;
    }
}
