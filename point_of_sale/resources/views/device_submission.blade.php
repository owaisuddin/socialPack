@extends('layouts.app')

@section('content')




    <div class="container">
        @if($device->status == 'processing' && empty($type))
            <div class="row">
                <div class="col-sm-12 pull-right">
                    <a href="/mobile_deliver_device/{{$device->id}}" class="btn btn-success btn-md pull-right"
                       style="margin-bottom: 10px;">
                        Deliver Device To Customer<span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>
        @else
            @if(!empty($type) && $type == 'delivered')
                <div class="row">
                    <div class="col-sm-12 pull-right">
                        <a href="/invoice/{{$device->id}}" class="btn btn-success btn-md pull-right"
                           style="margin-bottom: 10px;">
                            Create Invoice<span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>
                </div>
            @endif
        @endif
        <div class="card">
            <div class="card-header"><b>Client Info:</b></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <label>First Name : </label>
                        <span>{{$device->first_name}}</span>
                    </div>
                    <div class="col-sm-6">
                        <label>Last Name : </label>
                        <span>{{$device->last_name}}</span>
                    </div>
                    <hr/>
                    <div class="col-sm-6">
                        <label>Address : </label>
                        <span>{{$device->address}}</span>
                    </div>
                    <div class="col-sm-6">
                        <label>City : </label>
                        <span>{{$device->city}}</span>
                    </div>
                    <hr/>
                    <div class="col-sm-6">
                        <label>Email : </label>
                        <span>{{$device->email}}</span>
                    </div>
                    <div class="col-sm-6">
                        <label>Phone : </label>
                        <span>{{$device->phone}}</span>
                    </div>
                    <hr/>
                </div>
            </div>
            <div class="card-header"><b>Device Info:</b></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <label>Model : </label>
                        <span>{{$device->model}}</span>
                    </div>
                    <div class="col-sm-6">
                        <label>Model Make : </label>
                        <span>{{$device->model_make}}</span>
                    </div>
                    <hr/>
                    <div class="col-sm-6">
                        <label>Device Type: </label>
                        <span>{{$device->device_type}}</span>
                    </div>
                    <div class="col-sm-6">
                        <label>Serial / IMEI number: </label>
                        <span>{{$device->serial_number}}</span>
                    </div>
                    <hr/>
                    <div class="col-sm-6">
                        <label>Ph. pin/code : </label>
                        <span>{{$device->pin_code}}</span>
                    </div>
                    <div class="col-sm-6" id="menu" style="border-bottom-color: #0b2e13;margin-bottom: 1%;">
                        <label>Accessories: </label>

                        Case
                        @if($device->case == 'on')
                            <span class="glyphicon glyphicon-ok"></span>
                        @else
                            <span class="glyphicon glyphicon-remove"></span>
                        @endif
                        Box
                        @if($device->box == 'on')
                            <span class="glyphicon glyphicon-ok"></span>
                        @else
                            <span class="glyphicon glyphicon-remove"></span>
                        @endif
                        Charger
                        @if($device->charger == 'on')
                            <span class="glyphicon glyphicon-ok"></span>
                        @else
                            <span class="glyphicon glyphicon-remove"></span>
                        @endif
                        Other:
                        <span>{{$device->other}}</span>

                    </div>
                    <br/>
                    <hr/>
                    @if(!empty($device->deviceMobileCheckList))
                        <div class="col-sm-6">
                            <ul>
                                <li>
                                    Face Id
                                    @if($device->deviceMobileCheckList->face_id == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    Home Button
                                    @if($device->deviceMobileCheckList->home_button == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    Ear Speaker
                                    @if($device->deviceMobileCheckList->earphone == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    Microphone
                                    @if($device->deviceMobileCheckList->microphone == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    Ringtone / LoudSpeaker
                                    @if($device->deviceMobileCheckList->ringtone_loudspeaker == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    Volume Control
                                    @if($device->deviceMobileCheckList->volume_control == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    Power Button
                                    @if($device->deviceMobileCheckList->power_button == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    Rear Glass
                                    @if($device->deviceMobileCheckList->rear_glass == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    Rear Camera
                                    @if($device->deviceMobileCheckList->rear_camera == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    Front Camera
                                    @if($device->deviceMobileCheckList->front_camera == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    Silent Mode Switch
                                    @if($device->deviceMobileCheckList->silent_mode_switch == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    Cell Signal
                                    @if($device->deviceMobileCheckList->cell_signal == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    Sim Card Reader
                                    @if($device->deviceMobileCheckList->sim_card_reader == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    Missing Screws
                                    @if($device->deviceMobileCheckList->missing_screws == 'yes')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <ul>
                                <li>
                                    Memory Card
                                    @if($device->deviceMobileCheckList->memory_card == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    Charging Port
                                    @if($device->deviceMobileCheckList->charging_port == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    Headset Jack
                                    @if($device->deviceMobileCheckList->headset_jack == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    Camera
                                    @if($device->deviceMobileCheckList->camera == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    Vibrator
                                    @if($device->deviceMobileCheckList->vibrator == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    Battery Health
                                    @if($device->deviceMobileCheckList->battery_health == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    Battery Connector
                                    @if($device->deviceMobileCheckList->battery_connector == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    Antenna
                                    <small>(signal)</small>
                                    @if($device->deviceMobileCheckList->antenna == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    Proximity Sensor
                                    <small>(allow the display to shut on or off when on a call)</small>
                                    @if($device->deviceMobileCheckList->proximity_sensor == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    Wifi
                                    @if($device->deviceMobileCheckList->wifi == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    Bluetooth
                                    @if($device->deviceMobileCheckList->bluetooth == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    Internet
                                    @if($device->deviceMobileCheckList->internet == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    All Buttons
                                    <small>(Domes or Switches)</small>
                                    @if($device->deviceMobileCheckList->buttons == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                Device cann't be tested
                                @if($device->deviceMobileCheckList->device_checked == 'on')
                                <span class="glyphicon glyphicon-ok"></span>
                                @else
                                <span class="glyphicon glyphicon-remove"></span>
                                @endif
                                </li>
                            </ul>
                        </div>
                    @else
                        <div class="col-sm-6">
                            <ul>
                                <li>
                                    Unit
                                    <Reloaded></Reloaded>
                                    @if($device->deviceComputerCheckList->unit_reloaded == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    Optical Drive
                                    @if($device->deviceComputerCheckList->optical_drive == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    HeatSink
                                    @if($device->deviceComputerCheckList->heatsink == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    Touch Pad
                                    @if($device->deviceComputerCheckList->touchpad == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    LCD
                                    @if($device->deviceComputerCheckList->lcd == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    Ac Adapter
                                    @if($device->deviceComputerCheckList->ac_adapter == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    System Board
                                    @if($device->deviceComputerCheckList->system_board == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    CPU
                                    @if($device->deviceComputerCheckList->cpu == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <ul>
                                <li>
                                    Mouse
                                    @if($device->deviceComputerCheckList->mouse == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    Hinge
                                    @if($device->deviceComputerCheckList->hinge == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    HardDrive
                                    @if($device->deviceComputerCheckList->hard_drive == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    RAM memory
                                    @if($device->deviceComputerCheckList->ram_memory == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    Keyboard
                                    @if($device->deviceComputerCheckList->keyboard == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    Fan
                                    <Reloaded></Reloaded>
                                    @if($device->deviceComputerCheckList->fan == 'working')
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </li>
                                <li>
                                    Other:
                                    <span>{{$device->deviceComputerCheckList->other}}</span>
                                </li>
                            </ul>
                        </div>
                    @endif
                    <hr/>
                    <div class="col-sm-12">
                        <label>Note : </label>
                        <span>{{$device->note}}</span>
                    </div>
                </div>
            </div>
            <div class="card-header"><b>Pricing:</b></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <label>Description : </label>
                        <span>{{$device->description}}</span>
                    </div>
                    <div class="col-sm-6">
                        <label>Payment Type : </label>
                        <span>{{$device->payment_type}}</span>
                    </div>
                    <hr/>
                    <div class="col-sm-6">
                        <label>Price : </label>
                        <span>$ {{$device->price}}</span>
                    </div>
                    <div class="col-sm-6">
                        <label>Received By : </label>
                        <span>{{$device->received_by}}</span>
                    </div>
                    <hr/>
                    <div class="col-sm-6">
                        <label>Agreement Sign : </label>
                        @if($device->agreement == 'on')
                            <span class="glyphicon glyphicon-ok"></span>
                        @else
                            <span class="glyphicon glyphicon-remove"></span>
                        @endif
                    </div>
                    <hr/>
                    <div class="col-sm-6">
                        <label>Status : </label>
                        <span>{{$device->status}}</span>
                    </div>
                    <div class="col-sm-6">
                        <label>Device Submitted Date : </label>
                        <span>{{$device->created_at}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
