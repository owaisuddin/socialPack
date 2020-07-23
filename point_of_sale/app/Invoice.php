<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

    protected $table = 'invoices';


    protected $fillable = ['customer_name','device_id','serial_number','phone','model', 'model_make', 'device_type', 'description',
    'comments','address','price','shipping_price'];

    public function deviceInvoice(){
        return $this->belongsTo('App\DeliveredDevice','device_id','id');
    }
}
