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

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

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
                curInputs = curStep.find("input[type='text'],input[type='url']"),
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

        $('div.setup-panel div a.btn-success').trigger('click');
    });
</script>

@section('content')
    <div class="container">
        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                    <p>
                        <small>Device Type</small>
                    </p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                    <p>
                        <small>Client Information</small>
                    </p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                    <p>
                        <small>Device Information</small>
                    </p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                    <p>
                        <small>Schedule</small>
                    </p>
                </div>
            </div>
        </div>

    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="row">
                <div class="col-md-12">
                    <form role="form" method="post" action="/device_submission">
                        @csrf
                        <div class="panel panel-primary setup-content" id="step-1">
                            <div class="panel-heading">
                                <h3 class="panel-title">Device Type</h3>
                            </div>
                            <div class="panel-body">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">Select Device Type For Repairing</label>
                                        <select class="form-control">
                                            <option>Mobile</option>
                                            <option>Computer</option>
                                        </select>
                                    </div>
                                </div>

                                <button class="btn btn-primary nextBtn pull-right" type="button">Next <span
                                        class="glyphicon glyphicon-arrow-right"></span></button>
                            </div>
                        </div>
                        <div class="panel panel-primary setup-content" id="step-2">
                            <div class="panel-heading">
                                <h3 class="panel-title">Client Information</h3>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="control-label">First Name</label>
                                        <input type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="first_name" required
                                               placeholder="Enter First Name"
                                               value="{{ old('first_name') }}" required
                                               autocomplete="first_name"
                                               autofocus>
                                        @if($errors->has('first_name'))
                                            <code>{{ $errors->first('first_name') }}</code>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="control-label">Last Name</label>
                                        <input type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="last_name"
                                               placeholder="Enter Last Name"
                                               value="{{ old('last_name') }}" autocomplete="last_name"
                                               autofocus>

                                        @if($errors->has('last_name'))
                                            <code>{{ $errors->first('last_name') }}</code>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Address</label>
                                        <input type="text" required
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="address"
                                               placeholder="Enter Address"
                                               value="{{ old('address') }}" autocomplete="address"
                                               autofocus>
                                        @if($errors->has('address'))
                                            <code>{{ $errors->first('address') }}</code>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">City</label>
                                        <input type="text" required
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="city"
                                               placeholder="Enter City/State"
                                               value="{{ old('city') }}" autocomplete="city"
                                               autofocus>

                                        @if($errors->has('city'))
                                            <code>{{ $errors->first('city') }}</code>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input type="email"
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="email"
                                               placeholder="Enter Email"
                                               value="{{ old('email') }}" autocomplete="email"
                                               autofocus>

                                        @if($errors->has('email'))
                                            <code>{{ $errors->first('email') }}</code>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Phone</label>
                                        <input id="name" type="text" required
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="phone"
                                               placeholder="Enter Phone"
                                               value="{{ old('phone') }}" autocomplete="phone"
                                               autofocus>

                                        @if($errors->has('phone'))
                                            <code>{{ $errors->first('phone') }}</code>
                                        @endif
                                    </div>
                                </div>

                                <button class="btn btn-primary nextBtn pull-right" type="button">Next <span
                                        class="glyphicon glyphicon-arrow-right"></span></button>
                            </div>
                        </div>

                        <div class="panel panel-primary setup-content" id="step-3">
                            <div class="panel-heading">
                                <h3 class="panel-title">Device Information</h3>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Model Info</label>
                                        <input type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="model"
                                               placeholder="Model Info"
                                               value="{{ old('model') }}" required autocomplete="model"
                                               autofocus>

                                        @if($errors->has('model'))
                                            <code>{{ $errors->first('model') }}</code>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Model Make</label>
                                        <input type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="model_make"
                                               placeholder="Make/Model"
                                               value="{{ old('model_make') }}" required autocomplete="model_make"
                                               autofocus>

                                        @if($errors->has('model_make'))
                                            <code>{{ $errors->first('model_make') }}</code>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Device Type</label>
                                        <input type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="device_type"
                                               placeholder="Device Type"
                                               value="{{ old('device_type') }}" required autocomplete="device_type"
                                               autofocus>

                                        @if($errors->has('device_type'))
                                            <code>{{ $errors->first('device_type') }}</code>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Serial/IMEI Number</label>
                                        <input type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="serial_number"
                                               placeholder="Serial / IMEI number"
                                               value="{{ old('serial_number') }}" required autocomplete="serial_number"
                                               autofocus>

                                        @if($errors->has('serial_number'))
                                            <code>{{ $errors->first('serial_number') }}</code>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Ph. Pin/Passcode</label>
                                        <input id="name" type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="pin_code"
                                               placeholder="Ph. Pin/Passcode"
                                               value="{{ old('pin_code') }}" autocomplete="pin_code"
                                               autofocus>

                                        @if($errors->has('pin_code'))
                                            <code>{{ $errors->first('pin_code') }}</code>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Accessories Sent In:</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="charger"
                                                >Charger</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="box"
                                                >Box</label>
                                        </div>
                                        {{--<div class="checkbox">--}}
                                        {{--<label><input type="checkbox" name="case"--}}
                                        {{-->Case</label>--}}
                                        {{--</div>--}}
                                        {{--<div class="checkbox">--}}
                                        {{--<input type="text" placeholder="Others" name="other_accessories"--}}
                                        {{--class="form-control">--}}
                                        {{--</div>--}}
                                        @if($errors->has('accessories'))
                                            <code>{{ $errors->first('accessories') }}</code>
                                        @endif
                                    </div>
                                </div>
                                <hr/>
                                <div class="col-md-6">
                                    <h5><b>CheckList:</b></h5>
                                    <div class="form-group">
                                        <ul>
                                            <li>
                                                <div class="custom-radio">
                                                    <label class="radio-inline rbtn">Face ID</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="face_id" checked>Good
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="face_id">Bad
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="custom-radio">
                                                    <label class="radio-inline rbtn">Home Button</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="home_button" checked>Good
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="home_button">Bad
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="custom-radio">
                                                    <label class="radio-inline rbtn">Volume Control</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="volume_control" checked>Good
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="volume_control">Bad
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="custom-radio">
                                                    <label class="radio-inline rbtn">Power Button</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="power_button" checked>Good
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="power_button">Bad
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="custom-radio">
                                                    <label class="radio-inline rbtn">Rear Glass</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="rear_glass" checked>Good
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="rear_glass">Bad
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="custom-radio">
                                                    <label class="radio-inline rbtn">Rear Camera</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="rear_camera" checked>Good
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="rear_camera">Bad
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="custom-radio">
                                                    <label class="radio-inline rbtn">Ear Speaker</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="earphone" checked>Good
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="earphone">Bad
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="custom-radio">
                                                    <label class="radio-inline rbtn">Microphone</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="microphone" checked>Good
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="microphone">Bad
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="custom-radio">
                                                    <label class="radio-inline rbtn">Ringtone/Loud
                                                        Speaker</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="ringtone_loudspeaker" checked>Good
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="ringtone_loudspeaker">Bad
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="custom-radio">
                                                    <label class="radio-inline rbtn">Sim Card
                                                        Reader</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="sim_card_reader" checked>Good
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="sim_card_reader">Bad
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="custom-radio">
                                                    <label class="radio-inline rbtn">Card/SD
                                                        Card Slot</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="memory_card" checked>Good
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="memory_card">Bad
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="custom-radio">
                                                    <label class="radio-inline rbtn">Charging Port/Data Port</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="charging_port" checked>Good
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="charging_port">Bad
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="custom-radio">
                                                    <label class="radio-inline rbtn">Headset Jack</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="headset_jack" checked>Good
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="headset_jack">Bad
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="custom-radio">
                                                    <label class="radio-inline rbtn">Front Camera</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="front_camera" checked>Good
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="front_camera">Bad
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group ">
                                        <ul>
                                            <li>
                                                <div class="custom-radio">
                                                    <label class="radio-inline rbtn">Silent Mode Switch</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="silent_mode_switch" checked>Good
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="silent_mode_switch">Bad
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="custom-radio">
                                                    <label class="radio-inline rbtn">Cell Signal</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="cell_signal" checked>Good
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="cell_signal">Bad
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="custom-radio">
                                                    <label class="radio-inline rbtn">Battery Health</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="battery_health" checked>Good
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="battery_health">Bad
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="custom-radio">
                                                    <label class="radio-inline rbtn">Missing screws</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="missing_screws" checked>Good
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="missing_screws">Bad
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="custom-radio">
                                                    <label class="radio-inline rbtn">Vibrator</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="vibrator" checked>Good
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="vibrator">Bad
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="custom-radio">
                                                    <label class="radio-inline rbtn">Battery
                                                        Connector</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="battery_connector" checked>Good
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="battery_connector">Bad
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="custom-radio">
                                                    <label class="radio-inline rbtn">Wi-Fi</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="wifi" checked>Good
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="wifi">Bad
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox">
                                                    <div class="custom-radio">
                                                        <label class="radio-inline rbtn">Bluetooth</label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="bluetooth" checked>Good
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="bluetooth">Bad
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox">
                                                    <div class="custom-radio">
                                                        <label class="radio-inline rbtn">Internet</label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="internet" checked>Good
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="internet">Bad
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="custom-radio">
                                                    <label class="radio-inline rbtn">BatteryAntenna
                                                        <small>(Signal)</small></label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="antenna" checked>Good
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="antenna">Bad
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox">
                                                    <div class="custom-radio">
                                                        <label class="radio-inline rbtn">All Buttons
                                                            <small>(Domes or Switches)</small></label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="buttons" checked>Good
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="buttons">Bad
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="custom-radio">
                                                    <label class="radio-inline rbtn">Proximity
                                                        Sensor
                                                        <small>(allow the display to shut on or off when on a call)</small></label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="proximity_sensor" checked>Good
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="proximity_sensor">Bad
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="note"
                                               placeholder="Note"
                                               value="{{ old('note') }}" required
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

                        <div class="panel panel-primary setup-content" id="step-4">
                            <div class="panel-heading">
                                <h3 class="panel-title">Schedule</h3>
                            </div>
                            <div class="panel-body">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                                    <textarea class="form-control @error('name') is-invalid @enderror"
                                                              name="description"
                                                              placeholder="Description"
                                                              required autocomplete="description" autofocus>
                                                        {{ old('description') }}
                                                    </textarea>
                                        @if($errors->has('description'))
                                            <code>{{ $errors->first('description') }}</code>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                                        <textarea
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            name="comments"
                                                            placeholder="Comments"
                                                            autocomplete="comments" autofocus>
                                                            {{ old('comments') }}
                                                        </textarea>
                                        @if($errors->has('comments'))
                                            <code>{{ $errors->first('comments') }}</code>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="payment_type"
                                               placeholder="Payment Type"
                                               value="{{ old('payment_type') }}" required
                                               autocomplete="payment_type"
                                               autofocus>
                                        @if($errors->has('payment_type'))
                                            <code>{{ $errors->first('payment_type') }}</code>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input id="name" type="number"
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="price"
                                               placeholder="Price"
                                               value="{{ old('price') }}" required
                                               autocomplete="price"
                                               autofocus>
                                        @if($errors->has('price'))
                                            <code>{{ $errors->first('price') }}</code>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="received_by"
                                               placeholder="Received By"
                                               value="{{ old('received_by') }}" required
                                               autocomplete="received_by"
                                               autofocus>
                                        @if($errors->has('received_by'))
                                            <code>{{ $errors->first('received_by') }}</code>
                                        @endif
                                    </div>
                                </div>
                                <div class="checkbox">
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
                                                <b>PLEASE READ THE FOLLOWING TERMS OF SERVICE CAREFULLY AS IT
                                                    CONTAINS
                                                    IMPORTANT INFORMATION ABOUT YOUR RIGHTS AND OBLIGATION. AS WELL
                                                    AS
                                                    LIMITATIONS AND EXCLUSIONS THAT MAY APPLY TO YOU:</b><br/><br/>
                                                <p>These terms govern the provision of any device support service;
                                                    provided
                                                    by FXitRight.</p>
                                                <p>All work must be paid in full upon Completion of services
                                                    provided.
                                                    If an
                                                    amount remains deliquent 14 days after its issue date, an
                                                    additional
                                                    5%
                                                    penalty fee will be added for each week of deliquentcy on the
                                                    maximum
                                                    permitted by law.</p>
                                                <p>In case collections proves necessary, the client agrees to pay
                                                    all
                                                    fees
                                                    incurred by that process.</p>
                                                <p>FXitRight shall not be liable for any claims regarding the
                                                    physical
                                                    function of equipment media or the condition or existence of
                                                    data or
                                                    storage media supplied before during or after service. In no
                                                    event
                                                    will
                                                    FXitRight be liable for any damage to device loss of data loss
                                                    of
                                                    revenue or profit, or any special/Incidental, contingent or
                                                    consequential damages, before,during or after service.</p>
                                                <p>The client and FXitRight agree that the sole and exclusive remedy
                                                    for
                                                    unsatisfactory work shall be at option; additional attempts by
                                                    FXItRight
                                                    must be allowed to complete the work in a satisfactory manner or
                                                    refund
                                                    of the amount paid by the client.The parties acknowledge that
                                                    the
                                                    price
                                                    of FXitRight seervices would be much greater.If FXitRight
                                                    undertook
                                                    more
                                                    extensive liability. </p>
                                                <p>The client is aware of the inherent risk or injury and property
                                                    damage
                                                    involved in mobile device repair,including without limitation
                                                    risks
                                                    of
                                                    destruction or damage due to the machine, media, or data and
                                                    inability
                                                    to repair the device or recover data, including those that may
                                                    result
                                                    from the negligence of FXitRight, and assume any and all known
                                                    risks
                                                    of
                                                    injury and property damage that may result.</p>
                                                <p>FXitRight agrees not to disclose any and all Information or data
                                                    flies
                                                    supplied with, stored on, or recovered from clients equipment
                                                    except
                                                    to
                                                    employees or agents of FXitRight subject to confidentiality
                                                    agreements
                                                    or as required by law.</p>
                                                <p>FXitRight provides you with access to and use of the services
                                                    subject
                                                    to
                                                    your compliance with the terms. FXitRight reserves the right to
                                                    refuse
                                                    to provide the services to anyone at anytime without notice for
                                                    any
                                                    reason. You represent and warrant to us that you are 18 years
                                                    old,
                                                    and
                                                    that you have the right capacity and authorization necessary to
                                                    legally
                                                    bind yourself to these terms.</p>
                                                <p>You acknowledge that by use of the seviCes you are authorizing
                                                    FXitRight
                                                    to access and control your mobile phone or tablet for the
                                                    purpose of
                                                    diagnosis, service, and repair• in connection with dellyering
                                                    the
                                                    services FXItRight rnay download and use software gather system
                                                    data
                                                    and
                                                    access or modify your devices settings. By accepting these terms
                                                    you
                                                    hereby grantkitRight the right t13.. donw1oad install and or use
                                                    software or riff. device to gather system data repair your
                                                    device
                                                    and
                                                    Change the settings on your device while performing the
                                                    services. '
                                                    The
                                                    verbal quote given by FXItRight 4 given as a guide based on
                                                    limited
                                                    information provided by a =tomer, A verbal quote is intended to
                                                    vie
                                                    the
                                                    customer an estimate on the price end ndt assurance that the
                                                    product
                                                    or
                                                    service will be sold at that price. All written quotes are valid
                                                    for
                                                    00/7 days. Once work commences, after a technician has evaluated
                                                    the
                                                    system, should it arise that the cost repair is snore than
                                                    quoted,
                                                    no
                                                    woli ;Ai commence without explicit dent approval. The Cllent 15
                                                    the
                                                    legal owner or authorized representathre of the lop/ owner of
                                                    the
                                                    PdPertY and all date and (iornPononis contained therein sent to
                                                    FXItilight You must be the owner or have permission of the owner
                                                    for
                                                    us
                                                    to wog* on your ouIpmentafterWe will nonotifyhrtake instructions
                                                    for
                                                    work from the owner or their destinated representative. if
                                                    equipment
                                                    is
                                                    left `with FXitiiight and Is not collected within thirty (30i
                                                    daYs
                                                    We
                                                    you that the requested resoles' have been completed, we will
                                                    treat
                                                    your
                                                    equipment as abandoneciand becomes the sole property of
                                                    natilight.
                                                    You
                                                    agree to hold FAO:light han-niess for any damages or claim for
                                                    rtht,
                                                    abandoned property, which We may discard at our sold dirretion.
                                                    Any
                                                    and
                                                    all charges are still your responsibilitv. . 11. IV ' 1::
                                                    FXiRight
                                                    Is
                                                    five from &felts in materials and workmanshIp.ills simply
                                                    promises
                                                    that
                                                    the 11.4.0 Woikaleneggz The 010st common kind of warranty on
                                                    goods
                                                    is e
                                                    warranty that the products customzrily do. rairtaacturer
                                                    properly
                                                    constructed the product, out of proper materials. !ropes that
                                                    the
                                                    product will perform as weU as such /AN PhYsical Deniate or
                                                    Water
                                                    Damage
                                                    mall Vold Warranty</p>
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
    </div>
@endsection
