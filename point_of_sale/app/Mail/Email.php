<?php

namespace App\Mail;

use App\DeliveredDevice;
use App\Invoice;
use App\Device;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Email extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $demo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($demo)
    {
        $this->demo = $demo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        if(!empty($this->demo->type) && $this->demo->type == 'DS') {
            $device = Device::with(['deviceMobileCheckList','deviceComputerCheckList'])->where('id', $this->demo->invoice_id)->first();
            return $this->from('brian@fxitright.com')
                ->subject('Thanks for submitting your device to FXitRight.')
                ->markdown('mails.device_submit')
                ->with(
                    [
                        'device' => $device,
                    ]);
        }elseif(!empty($this->demo->type) && $this->demo->type == 'DD'){
            $device = DeliveredDevice::with(['deviceMobileCheckList','deviceComputerCheckList'])->where('id', $this->demo->invoice_id)->first();
            return $this->from('brian@fxitright.com')
                ->subject('Your device has been delivered to you.')
                ->markdown('mails.device_submit')
                ->with(
                    [
                        'device' => $device,
                    ]);
        }
        elseif(!empty($this->demo->type) && $this->demo->type == 'REVIEW') {
            return $this->from('brian@fxitright.com')
                ->subject('FXitRight post a review to our profile.')
                ->markdown('mails.review-email');
        }
        else{
            $invoice = Invoice::with(['deviceInvoice'])->where('id', $this->demo->invoice_id)->first();
            return $this->from('brian@fxitright.com')
                ->subject('Invoice From FXitRight Of Your Device.')
                ->markdown('mails.invoice')
                ->with(
                    [
                        'invoice' => $invoice,
                    ]);
        }
    }
}
