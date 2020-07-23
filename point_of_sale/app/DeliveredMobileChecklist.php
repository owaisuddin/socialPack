<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveredMobileChecklist extends Model
{
    protected $table = 'delivered_mobile_checklist';


    protected $fillable = [
        'device_id','face_id','home_button','volume_control','earphone', 'microphone', 'ringtone_loudspeaker', 'sim_card_reader',
        'memory_card', 'charging_port', 'headset_jack', 'camera', 'device_tested', 'vibrator', 'battery_connector', 'antenna',
        'proximity_sensor', 'wifi', 'bluetooth', 'internet', 'buttons','power_button','rear_glass','rear_camera','front_camera',
        'silent_mode_switch','cell_signal','battery_health','missing_screws','device_checked'
    ];
}
