@extends('layouts.app')
<style>
    .modal .modal-content {
        overflow: hidden;
    }

    .modal-body {
        overflow-y: scroll;
        text-align: center;
    }

    .stepwizard-step p {
        margin-top: 0px;
        color: #666;
    }

    .stepwizard-row {
        display: table-row;
    }

    .stepwizard {
        display: table;
        width: 100%;
        position: relative;
    }

    .stepwizard-step button[disabled] {
        /*opacity: 1 !important;
        filter: alpha(opacity=100) !important;*/
    }

    .stepwizard .btn.disabled, .stepwizard .btn[disabled], .stepwizard fieldset[disabled] .btn {
        opacity: 1 !important;
        color: #bbb;
    }

    .stepwizard-row:before {
        top: 14px;
        bottom: 0;
        position: absolute;
        content: " ";
        width: 100%;
        height: 1px;
        background-color: #ccc;
        z-index: 0;
    }

    .stepwizard-step {
        display: table-cell;
        text-align: center;
        position: relative;
    }

    .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
    }

    .rbtn {
        margin-right: 10%;
    }

    .rbtn {
        margin: 2%;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        localStorage.setItem('type',{!! json_encode($type) !!});
        var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');

        allWells.hide();

        navListItems.click(function (e) {
            e.preventDefault();
            var $target = $($(this).attr('href')),
                $item = $(this);

            if (!$item.hasClass('disabled')) {
                navListItems.removeClass('btn-success').addClass('btn-default');
                $item.addClass('btn-success');
                allWells.hide();
                $target.show();
                $target.find('input:eq(0)').focus();
            }
        });

        allNextBtn.click(function () {
            var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                curInputs = curStep.find("input[type='text'],input[type='url'],input[type='email']"),
                isValid = true;

            $(".form-group").removeClass("has-error");
            for (var i = 0; i < curInputs.length; i++) {
                if (!curInputs[i].validity.valid) {
                    isValid = false;
                    $(curInputs[i]).closest(".form-group").addClass("has-error");
                }
            }

            if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
        });
        $('#next1').on('click',function () {
            $('#modal_name').html($('#first_name').val() +' '+$('#last_name').val());
        });
        $('div.setup-panel div a.btn-success').trigger('click');
    });
</script>

@section('content')
    <div class="container">
        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step col-xs-4">
                    <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                    <p>
                        <small>Client Information</small>
                    </p>
                </div>
                <div class="stepwizard-step col-xs-4">
                    <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                    <p>
                        <small>Device Information</small>
                    </p>
                </div>
                <div class="stepwizard-step col-xs-4">
                    <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                    <p>
                        <small>Pricing Information</small>
                    </p>
                </div>
            </div>
        </div>

    </div>
    <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <form role="form" method="post" action="/device_deliver/{{$device['id']}}">
                        @csrf
                        <input type="hidden" name="type" value="{{$type}}">
                        <div class="panel panel-primary setup-content" id="step-1">
                            <div class="panel-heading">
                                <h3 class="panel-title">Client Information</h3>
                            </div>
                            <div class="panel-body">
                                <div class="col-sm-6">
                                    <div class="form-group ">
                                        <label class="control-label">First Name</label>
                                        <input type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="first_name" required
                                               placeholder="Enter First Name"
                                               value="{{ $device['first_name'] }}" required
                                               autocomplete="first_name"
                                               id="first_name"
                                               autofocus>
                                        @if($errors->has('first_name'))
                                            <code>{{ $errors->first('first_name') }}</code>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group ">
                                        <label class="control-label">Last Name</label>
                                        <input type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="last_name"
                                               placeholder="Enter Last Name"
                                               value="{{ $device['last_name'] }}" autocomplete="last_name"
                                               id="last_name"
                                               autofocus>

                                        @if($errors->has('last_name'))
                                            <code>{{ $errors->first('last_name') }}</code>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Address</label>
                                        <input type="text" required
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="address"
                                               placeholder="Enter Address"
                                               value="{{ $device['address'] }}" autocomplete="address"
                                               autofocus>
                                        @if($errors->has('address'))
                                            <code>{{ $errors->first('address') }}</code>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">City</label>
                                        <input type="text" required
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="city"
                                               placeholder="Enter City/State and ZipCode"
                                               value="{{ $device['city'] }}" autocomplete="city"
                                               autofocus>

                                        @if($errors->has('city'))
                                            <code>{{ $errors->first('city') }}</code>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input type="email" required="required"
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="email"
                                               placeholder="Enter Email"
                                               value="{{ $device['email'] }}" autocomplete="email"
                                               autofocus>

                                        @if($errors->has('email'))
                                            <code>{{ $errors->first('email') }}</code>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Phone</label>
                                        <input id="name" type="text" required
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="phone"
                                               placeholder="Enter Phone"
                                               value="{{ $device['phone'] }}" autocomplete="phone"
                                               autofocus>

                                        @if($errors->has('phone'))
                                            <code>{{ $errors->first('phone') }}</code>
                                        @endif
                                    </div>
                                </div>

                                <button class="btn btn-primary nextBtn pull-right" type="button" id="next1">Next <span
                                        class="glyphicon glyphicon-arrow-right"></span></button>
                            </div>
                        </div>

                        <div class="panel panel-primary setup-content" id="step-2">
                            <div class="panel-heading">
                                <h3 class="panel-title">Device Information</h3>
                            </div>
                            <div class="panel-body">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Model Info</label>
                                        <input type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="model"
                                               placeholder="Model Info"
                                               value="{{ $device['model'] }}" required autocomplete="model"
                                               autofocus>

                                        @if($errors->has('model'))
                                            <code>{{ $errors->first('model') }}</code>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Model Make</label>
                                        <input type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="model_make"
                                               placeholder="Make/Model"
                                               value="{{$device['model_make']}}" required autocomplete="model_make"
                                               autofocus>

                                        @if($errors->has('model_make'))
                                            <code>{{ $errors->first('model_make') }}</code>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Device Type</label>
                                        <input type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="device_type"
                                               placeholder="Device Type"
                                               value="{{ $device['device_type'] }}" required autocomplete="device_type"
                                               autofocus>

                                        @if($errors->has('device_type'))
                                            <code>{{ $errors->first('device_type') }}</code>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Serial/IMEI Number</label>
                                        <input type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="serial_number"
                                               placeholder="Serial / IMEI number"
                                               value="{{ $device['serial_number'] }}" required autocomplete="serial_number"
                                               autofocus>

                                        @if($errors->has('serial_number'))
                                            <code>{{ $errors->first('serial_number') }}</code>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Ph. Pin/Passcode</label>
                                        <input id="name" type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="pin_code"
                                               placeholder="Ph. Pin/Passcode"
                                               value="{{ $device['pin_code'] }}" autocomplete="pin_code"
                                               autofocus>

                                        @if($errors->has('pin_code'))
                                            <code>{{ $errors->first('pin_code') }}</code>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6" style="margin-top: 3%;">
                                    <div class="form-group">
                                        <label>Accessories:</label>
                                        <div class="checkbox-inline">
                                            <label><input type="checkbox" name="charger" {{$device['charger'] == 'on' ? 'checked' : ''}}
                                                >Charger</label>
                                        </div>
                                        <div class="checkbox-inline">
                                            <label><input type="checkbox" name="box" {{$device['box'] == 'on' ? 'checked' : ''}}
                                                >Box</label>
                                        </div>
                                        <div class="checkbox-inline">
                                            <label><input type="checkbox" name="case" {{$device['case'] == 'on' ? 'checked' : ''}}
                                                >Case</label>
                                        </div>
                                        <div class="checkbox-inline">
                                            <input type="text" placeholder="Others" name="other" value="{{$device['other']}}">
                                        </div>
                                        @if($errors->has('accessories'))
                                            <code>{{ $errors->first('accessories') }}</code>
                                        @endif
                                    </div>
                                </div><hr/>
                                <div class="col-sm-6" style="font-size: 12px;">
                                    Face ID
                                    <label class="radio-inline">
                                        <input type="radio" name="face_id" value="working" {{$device['deviceMobileCheckList']['face_id'] == 'working' ? 'checked' : ''}}>Working
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="face_id" value="not_working" {{$device['deviceMobileCheckList']['face_id'] == 'not_working' ? 'checked' : ''}}>not Working
                                    </label>
                                    <br/><hr/>
                                    Home Button
                                    <label class="radio-inline">
                                        <input type="radio" name="home_button" value="working" {{$device['deviceMobileCheckList']['home_button'] == 'working' ? 'checked' : ''}}>Working
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="home_button" value="not_working" {{$device['deviceMobileCheckList']['home_button'] == 'not_working' ? 'checked' : ''}}>not Working
                                    </label>
                                    <br/><hr/>
                                    Microphone
                                    <label class="radio-inline">
                                        <input type="radio" name="microphone" value="working" {{$device['deviceMobileCheckList']['microphone'] == 'working' ? 'checked' : ''}}>Working
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="microphone" value="not_working" {{$device['deviceMobileCheckList']['microphone'] == 'not_working' ? 'checked' : ''}}>not Working
                                    </label>
                                    <br/><hr/>
                                    Ear Speaker
                                    <label class="radio-inline">
                                        <input type="radio" name="earphone" value="working" {{$device['deviceMobileCheckList']['earphone'] == 'working' ? 'checked' : ''}}>Working
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="earphone" value="not_working" {{$device['deviceMobileCheckList']['earphone'] == 'not_working' ? 'checked' : ''}}>not Working
                                    </label>
                                    <br/><hr/>
                                    Ringtone/Loud Speaker
                                    <label class="radio-inline">
                                        <input type="radio" name="ringtone_loudspeaker" value="working" {{$device['deviceMobileCheckList']['ringtone_loudspeaker'] == 'working' ? 'checked' : ''}}>Working
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="ringtone_loudspeaker" value="not_working" {{$device['deviceMobileCheckList']['ringtone_loudspeaker'] == 'not_working' ? 'checked' : ''}}>not Working
                                    </label>
                                    <br/><hr/>
                                    Volume Control
                                    <label class="radio-inline">
                                        <input type="radio" name="volume_control" value="working" {{$device['deviceMobileCheckList']['volume_control'] == 'working' ? 'checked' : ''}}>Working
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="volume_control" value="not_working" {{$device['deviceMobileCheckList']['volume_control'] == 'not_working' ? 'checked' : ''}}>not Working
                                    </label>
                                    <br/><hr/>
                                    Power Button
                                    <label class="radio-inline">
                                        <input type="radio" name="power_button" value="working" {{$device['deviceMobileCheckList']['power_button'] == 'working' ? 'checked' : ''}}>Working
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="power_button" value="not_working" {{$device['deviceMobileCheckList']['power_button'] == 'not_working' ? 'checked' : ''}}>not Working
                                    </label>
                                    <br/><hr/>
                                    Charging Port/Data Port
                                    <label class="radio-inline">
                                        <input type="radio" name="charging_port" value="working" {{$device['deviceMobileCheckList']['charging_port'] == 'working' ? 'checked' : ''}}>Working
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="charging_port" value="not_working" {{$device['deviceMobileCheckList']['charging_port'] == 'not_working' ? 'checked' : ''}}>not Working
                                    </label>
                                    <br/><hr/>
                                    Rear Glass
                                    <label class="radio-inline">
                                        <input type="radio" name="rear_glass" value="working" {{$device['deviceMobileCheckList']['rear_glass'] == 'working' ? 'checked' : ''}}>Working
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="rear_glass" value="not_working" {{$device['deviceMobileCheckList']['rear_glass'] == 'not_working' ? 'checked' : ''}}>not Working
                                    </label>
                                    <br/><hr/>
                                    Rear Camera
                                    <label class="radio-inline">
                                        <input type="radio" name="rear_camera" value="working" {{$device['deviceMobileCheckList']['rear_camera'] == 'working' ? 'checked' : ''}}>Working
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="rear_camera" value="not_working" {{$device['deviceMobileCheckList']['rear_camera'] == 'not_working' ? 'checked' : ''}}>not Working
                                    </label>
                                    <br/><hr/>
                                    Front Camera
                                    <label class="radio-inline">
                                        <input type="radio" name="front_camera" value="working" {{$device['deviceMobileCheckList']['front_camera'] == 'working' ? 'checked' : ''}}>Working
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="front_camera" value="not_working" {{$device['deviceMobileCheckList']['front_camera'] == 'not_working' ? 'checked' : ''}}>not Working
                                    </label>
                                    <br/><hr/>
                                    Silent Mode Switch
                                    <label class="radio-inline">
                                        <input type="radio" name="silent_mode_switch" value="working" {{$device['deviceMobileCheckList']['silent_mode_switch'] == 'working' ? 'checked' : ''}}>Working
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="silent_mode_switch" value="not_working" {{$device['deviceMobileCheckList']['silent_mode_switch'] == 'not_working' ? 'checked' : ''}}>not Working
                                    </label>
                                    <br/><hr/>
                                    Wi-Fi
                                    <label class="radio-inline">
                                        <input type="radio" name="wifi" value="working" {{$device['deviceMobileCheckList']['wifi'] == 'working' ? 'checked' : ''}}>Working
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="wifi" value="not_working" {{$device['deviceMobileCheckList']['wifi'] == 'not_working' ? 'checked' : ''}}>not Working
                                    </label>
                                    <br/><hr/>
                                    Cell Signal
                                    <label class="radio-inline">
                                        <input type="radio" name="cell_signal" value="working" {{$device['deviceMobileCheckList']['cell_signal'] == 'working' ? 'checked' : ''}}>Working
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="cell_signal" value="not_working" {{$device['deviceMobileCheckList']['cell_signal'] == 'not_working' ? 'checked' : ''}}>not Working
                                    </label>
                                    <br/><hr/>
                                </div>
                                <div class="col-sm-6" style="font-size: 12px;">
                                    Battery Health
                                    <label class="radio-inline">
                                        <input type="radio" name="battery_health" value="working" {{$device['deviceMobileCheckList']['battery_health'] == 'working' ? 'checked' : ''}}>Working
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="battery_health" value="not_working" {{$device['deviceMobileCheckList']['battery_health'] == 'not_working' ? 'checked' : ''}}>not Working
                                    </label>
                                    <br/><hr/>
                                    Sim Card Reader
                                    <label class="radio-inline">
                                        <input type="radio" name="sim_card_reader" value="working" {{$device['deviceMobileCheckList']['sim_card_reader'] == 'working' ? 'checked' : ''}}>Working
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="sim_card_reader" value="not_working" {{$device['deviceMobileCheckList']['sim_card_reader'] == 'not_working' ? 'checked' : ''}}>not Working
                                    </label>
                                    <br/><hr/>
                                    Card/SD Card Slot
                                    <label class="radio-inline">
                                        <input type="radio" name="memory_card" value="working" {{$device['deviceMobileCheckList']['memory_card'] == 'working' ? 'checked' : ''}}>Working
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="memory_card" value="not_working" {{$device['deviceMobileCheckList']['memory_card'] == 'not_working' ? 'checked' : ''}}>not Working
                                    </label>
                                    <br/><hr/>
                                    Headset Jack
                                    <label class="radio-inline">
                                        <input type="radio" name="headset_jack" value="working" {{$device['deviceMobileCheckList']['headset_jack'] == 'working' ? 'checked' : ''}}>Working
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="headset_jack" value="not_working" {{$device['deviceMobileCheckList']['headset_jack'] == 'not_working' ? 'checked' : ''}}>not Working
                                    </label>
                                    <br/><hr/>
                                    Proximity Sensor
                                    <small style="font-size: 8.5px">(allow the display to shut on or off when on a call)
                                    </small>
                                    <label class="radio-inline">
                                        <input type="radio" name="proximity_sensor" value="working" {{$device['deviceMobileCheckList']['proximity_sensor'] == 'working' ? 'checked' : ''}}>Working
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="proximity_sensor" value="not_working" {{$device['deviceMobileCheckList']['proximity_sensor'] == 'not_working' ? 'checked' : ''}}>not Working
                                    </label>
                                    <br/><hr/>
                                    Missing screws
                                    <label class="radio-inline">
                                        <input type="radio" name="missing_screws" value="working" {{$device['deviceMobileCheckList']['missing_screws'] == 'yes' ? 'checked' : ''}}>Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="missing_screws" value="not_working" {{$device['deviceMobileCheckList']['missing_screws'] == 'no' ? 'checked' : ''}}>No
                                    </label>
                                    <br/><hr/>
                                    Vibrator
                                    <label class="radio-inline">
                                        <input type="radio" name="vibrator" value="working" {{$device['deviceMobileCheckList']['vibrator'] == 'working' ? 'checked' : ''}}>Working
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="vibrator" value="not_working" {{$device['deviceMobileCheckList']['vibrator'] == 'not_working' ? 'checked' : ''}}>not Working
                                    </label>
                                    <br/><hr/>
                                    Battery Connector
                                    <label class="radio-inline">
                                        <input type="radio" name="battery_connector" value="working" {{$device['deviceMobileCheckList']['battery_connector'] == 'working' ? 'checked' : ''}}>Working
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="battery_connector" value="not_working" {{$device['deviceMobileCheckList']['battery_connector'] == 'not_working' ? 'checked' : ''}}>not Working
                                    </label>
                                    <br/><hr/>
                                    Bluetooth
                                    <label class="radio-inline">
                                        <input type="radio" name="bluetooth" value="working" {{$device['deviceMobileCheckList']['bluetooth'] == 'working' ? 'checked' : ''}}>Working
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="bluetooth" value="not_working" {{$device['deviceMobileCheckList']['bluetooth'] == 'not_working' ? 'checked' : ''}}>not Working
                                    </label>
                                    <br/><hr/>
                                    Internet
                                    <label class="radio-inline">
                                        <input type="radio" name="internet" value="working" {{$device['deviceMobileCheckList']['internet'] == 'working' ? 'checked' : ''}}>Working
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="internet" value="not_working" {{$device['deviceMobileCheckList']['internet'] == 'not_working' ? 'checked' : ''}}>not Working
                                    </label>
                                    <br/><hr/>
                                    BatteryAntenna
                                    <small>(Signal)</small><br/>
                                    <label class="radio-inline">
                                        <input type="radio" name="antenna" value="working" {{$device['deviceMobileCheckList']['antenna'] == 'working' ? 'checked' : ''}}>Working
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="antenna" value="not_working" {{$device['deviceMobileCheckList']['antenna'] == 'not_working' ? 'checked' : ''}}>not Working
                                    </label>
                                    <br/><hr/>
                                    All Buttons
                                    <small>(Domes or Switches)</small><br/>
                                    <label class="radio-inline">
                                        <input type="radio" name="buttons" value="working" {{$device['deviceMobileCheckList']['buttons'] == 'working' ? 'checked' : ''}}>Working
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="buttons" value="not_working" {{$device['deviceMobileCheckList']['buttons'] == 'not_working' ? 'checked' : ''}}>not Working
                                    </label>
                                    <br/><hr/>
                                    Device has no power and can not test
                                    <input type="checkbox" name="device_checked" {{$device['deviceMobileCheckList']['device_checked'] == 'on' ? 'checked' : ''}}>
                                </div>
                                <br/><hr/>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Note</label>
                                        <input type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="note"
                                               placeholder="Enter Note"
                                               value="{{ $device['note'] }}" required
                                               autocomplete="note"
                                               autofocus>
                                        @if($errors->has('note'))
                                            <code>{{ $errors->first('note') }}</code>
                                        @endif
                                    </div>
                                </div>
                                <button class="btn btn-primary nextBtn pull-right" type="button">Next <span
                                        class="glyphicon glyphicon-arrow-right"></span></button>
                            </div>
                        </div>

                        <div class="panel panel-primary setup-content" id="step-3">
                            <div class="panel-heading">
                                <h3 class="panel-title">Pricing Information</h3>
                            </div>
                            <div class="panel-body">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Description</label>
                                                    <textarea class="form-control @error('name') is-invalid @enderror"
                                                              name="description"
                                                              placeholder="Description"
                                                              >
                                                        {{ $device['description'] }}
                                                    </textarea>
                                        @if($errors->has('description'))
                                            <code>{{ $errors->first('description') }}</code>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="payment_type"
                                               placeholder="Payment Type"
                                               value="{{ $device['payment_type'] }}" required
                                               autocomplete="payment_type"
                                               autofocus>
                                        @if($errors->has('payment_type'))
                                            <code>{{ $errors->first('payment_type') }}</code>
                                        @endif
                                    </div>
                                </div>
                                <hr/><hr/><hr/>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input id="name" type="number"
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="price"
                                               placeholder="Price"
                                               value="{{ $device['price'] }}" required
                                               autocomplete="price"
                                               autofocus>
                                        @if($errors->has('price'))
                                            <code>{{ $errors->first('price') }}</code>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="received_by"
                                               placeholder="Received By"
                                               value="{{ $device['received_by'] }}" required
                                               autocomplete="received_by"
                                               autofocus>
                                        @if($errors->has('received_by'))
                                            <code>{{ $errors->first('received_by') }}</code>
                                        @endif
                                    </div>
                                </div>
                                <div class="checkbox-inline">
                                    <label>
                                        <input type="checkbox" name="agreement" required>
                                        Click here to indicate that you have read and agree to
                                        the terms of the<a href="#" data-toggle="modal"
                                                           data-target="#myModal"> Terms of Service
                                            Agreement</a>.
                                    </label>
                                </div>
                                <div id="myModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <b>PLEASE READ THE FOLLOWING TERMS OF SERVICE CAREFULLY AS IT CONTAINS
                                                    IMPORTANT
                                                    INFORMATION ABOUT YOUR RIGHTS AND OBLIGATION, AS WELL AS
                                                    LIMITATIONS AND EXCLUSIONS THAT MAY APPLY TO YOU</b><hr/>
                                                <p>These terms govern the provision of any device support services (“Services”) provided
                                                    by FXitRight.</p>
                                                <p><b id="modal_name"></b> provides you with access to and use of the Services subject to your
                                                    compliance with the Terms. <b>FXitRight</b> reserves the right to refuse to provide the
                                                    Services to anyone at any time without notice for any reason. You represent and
                                                    warrant to us that you are at least 18 years old, and that you have the right, capacity
                                                    and authorization necessary to legally bind yourself to these Terms.</p>

                                                <p>Authorization to Access your Mobile Phone or Tablet, Computer Device
                                                    You acknowledge that by your use of the Services you are authorizing <b>FXitRight</b> to
                                                    access and control your mobile phone or tablet, computer for the purposes of diagnosis, service
                                                    and repair.</p>

                                                <p>In connection with delivering the services <b>FXitRight</b> may download and use software,
                                                    gather system data and access or modify your devices settings. By accepting these
                                                    terms, you hereby grant <b>FXitRight</b> the right to download, install and use software on
                                                    your device to gather system data, repair your device and change the settings on your
                                                    device while performing the services.</p>

                                                <p>Quotes Any verbal quote given by FXitRight is given as a guide based on limited information
                                                    provided by a customer. A verbal quote is intended to give the customer an estimate
                                                    on the price and not an assurance that the product or service will be sold at that price.
                                                    Any written quote will be provided by <b>FXitRight</b> at that price. All written quotes are valid
                                                    Backup Services & Potential Data Loss While <b>FXitRight</b> will make all reasonable efforts to safeguard the contents (data)
                                                    stored on your device, you understand and agree that prior to contacting or allowing
                                                    <b>FXitRight</b> to perform diagnostic, repair, or other services on your device, it is your responsibility to back-up the data, software, information or other files stored on your device’s memory if you so desire. You acknowledge and agree that
                                                    <b>FXitRight</b> and/or its third-party service provider shall not be responsible
                                                    under any circumstances for any loss, alteration, or corruption of any software, data or files.</p>

                                                <p>If you do not have a backup of your software and data, we can provide you with our
                                                    data backup service at an additional cost. However,
                                                    we cannot guarantee the integrity
                                                    of the data when backing up.</p>

                                                <h3>Confidentiality</h3>
                                                <p>FXitRight agrees not to disclose any and all information or data files supplied with,
                                                    stored on, or recovered from client's equipment except to employees or agents of FXitRight subject to confidentiality agreements or as required by law.</p>

                                                <h3>Terms</h3>
                                                <p>All work must be paid in full upon completion of service. If an amount remains
                                                    delinquent 14 days after its issue date, an additional 5% penalty will be added for each
                                                    week of delinquency or the maximum permitted by law. In case collection proves
                                                    necessary, the client agrees to pay all fees incurred by that process.
                                                    Limited Liability.</p>

                                                <p>FXitRight shall not be liable for any claims regarding the physical functioning of equipment/media or the condition or existence of data on storage media supplied before, during or after service.In no event will FXitRight be liable for any damage to the mobile for only 7 days. Once work commences, after a technician has evaluated the system, should it appear that the cost to repair is more than quoted, no work will commence without explicit client approval.</p>

                                                <h3>Legal Rights</h3>
                                                <p>The client is the legal owner or authorized representative of the legal owner of the
                                                    property and all data and components contained there in sent to <b>FXitRight</b>. You must be
                                                    the owner, or have the permission of the owner, for us to work on your equipment. We
                                                    will only take instructions for work from the owner or their designated representative.
                                                    If equipment is left with FXitRight and is not collected within sixty (60) days after we notify you that the requested service is complete, we will treat your equipment as abandoned and becomes the sole property of <b>FXitRight</b>. You agree to hold <b>FXitRight</b> harmless for any damage or claim for the abandoned property, which we may discard at our sole discretion. Any and all charges are still your responsibility.</p>

                                                <p>phone/tablet/computer/equipment, loss of data, loss of revenue or profits, or any special,incidental, contingent, or consequential damages, however caused, before, during or after service even if <b>FXitRight</b> has been advised of the possibility of damages or loss to persons or property. <b>FXitRight</b> liability of any kind with respect to the services, including any negligence on its part, shall be limited to the contract price for the services.
                                                    The client and <b>FXitRight</b> agree that the sole and exclusive remedy for unsatisfactory work shall be, at FXitRight option, additional attempts by <b>FXitRight</b> must be allowed to complete the work in a satisfactory manner, or refund of the amount paid by the client. The parties acknowledge that the price of <b>FXitRight</b> services would be much greater if <b>FXitRight</b> undertook more extensive liability.</p>

                                                <p>The client is aware of the inherent risks of injury and property damage involved in
                                                    mobile device repair, including without limitation, risks due to destruction or damage
                                                    to the machine, media, or data and inability to repair the device or recover data,
                                                    including those that may result from the negligence of <b>FXitRight</b>, and assumes any and all known risks of injury and property damage that may result.</p>

                                                <h3>Warranty Disclaimer</h3>

                                                <p>Thank you for your interest in the products and services of FXitRight.</p>

                                                <p>The limited warranty applies to physical goods, and only for physical goods, purchased from FXitRight(the "Physical Goods").</p>

                                                <h3>
                                                    What does this limited Warranty cover?
                                                </h3>
                                                <p>
                                                    The limited warranty covers any defects in material or workmanship under normal use during the Warranty Period.
                                                </p>

                                                <p>
                                                    During the Warranty Period. FXitRight will repair or replace, at no charge, products ot parts of the product that proves defective because of improper material or workmanship, under normal use and maintaince.
                                                </p>

                                                <h3>
                                                    What will we do to correct problems?
                                                </h3>

                                                <p>
                                                    FXitRight will either repair the Product at no charge, using new or refurbished replacement parts.
                                                </p>

                                                <h3>How long does the coverage last?</h3>
                                                <p>The Warranty Period for Physical Goods purchased from FXitRight is 60 days from the date of purchase.<br/>
                                                    A replacement Physical Good or part assumes the remaining warranty of the original Physical Good or 60 days from the date of replacement or repair, whichever is longer.
                                                </p>

                                                <h3>What does this limited warranty not cover?</h3>
                                                <ul>The Limited Warranty does not cover any problem that is caused by:
                                                    <li>conditions, malfunctions or damage not reulting from defects in material or workmanship.</li>
                                                </ul>

                                                <h3>What do you have to do?</h3>
                                                <p>
                                                    To obtain warranty service, you must first contact us to determine the problem and the most appropiate solution for you.
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    Close
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <button class="btn btn-primary nextBtn pull-right" type="submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
@endsection
