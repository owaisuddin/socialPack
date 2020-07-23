<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveredDevice extends Model
{

    protected $table = 'delivered_devices';


    protected $fillable = [
        'first_name', 'last_name', 'address', 'city', 'email', 'phone', 'pin_code', 'device_type', 'model', 'model_make',
        'description', 'comments', 'payment_type', 'price', 'received_by', 'note', 'agreement','serial_number','case',
        'charger','box','other','status'
    ];

    public function deviceMobileCheckList(){
        return $this->belongsTo('App\DeliveredMobileChecklist','id','device_id');
    }

    public function deviceComputerCheckList(){
        return $this->belongsTo('App\DeliveredComputerChecklist','id','device_id');
    }
}
