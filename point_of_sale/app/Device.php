<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $table = 'devices';


    protected $fillable = [
        'first_name', 'last_name', 'address', 'city', 'email', 'phone', 'pin_code', 'device_type', 'model', 'model_make',
         'description', 'comments', 'payment_type', 'price', 'received_by', 'note', 'agreement','serial_number','case',
        'charger','box','other'
    ];

    public function deviceMobileCheckList(){
        return $this->belongsTo('App\MobileChecklist','id','device_id');
    }

    public function deviceComputerCheckList(){
        return $this->belongsTo('App\ComputerChecklist','id','device_id');
    }
}
