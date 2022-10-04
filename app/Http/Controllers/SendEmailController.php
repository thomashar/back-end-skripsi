<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\NotifyMail;
use App\Models\Transaksi;
use App\Models\Pembeli;

class SendEmailController extends Controller
{
    public function index(Request $request, $id)
    {
        $pembeli = Pembeli::find($id);

        if(is_null($pembeli)){
            return response([
                'message' => 'Pembeli Not Found',
                'data' => $pembeli
            ],400);
        }
        Mail::to($pembeli->email_pembeli)->send(new NotifyMail());

        if(Mail::failures()) {
            return response()->Fail('Sorry! Please try again latter');
        }else{
            return response()->success('Great! Successfully send in your mail');
        }
    }
}
