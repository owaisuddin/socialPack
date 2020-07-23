<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveredComputerChecklist extends Model
{
    protected $table = 'computer_checklist';


    protected $fillable = [
        'device_id','unit_reloaded','optical_drive','heatsink','touchpad', 'lcd', 'ac_adapter', 'system_board',
        'cpu', 'mouse', 'hinge', 'hard_drive', 'ram_memory', 'keyboard', 'fan', 'other','device_checked'
    ];
}
