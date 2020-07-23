<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\Email;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send($email,$invoice_id,$type = null)
    {
        $objDemo = new \stdClass();
        $objDemo->invoice_id = $invoice_id;
        $objDemo->type = $type;
        Mail::to($email)->send(new Email($objDemo));
    }
}
