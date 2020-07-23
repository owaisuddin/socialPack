@extends('layouts.app')

@section('content')
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

@endection
