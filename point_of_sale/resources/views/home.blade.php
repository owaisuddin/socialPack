@extends('layouts.app')

@section('content')
    <div class="panel panel-primary setup-content container" id="step-1">
        <div class="panel-heading">
            <h3 class="panel-title">Device Type</h3>
        </div>
        <div class="panel-body">
            <div class="col-xs-12">
                <form method="post" action="/device_type">
                    @csrf
                    <div class="form-group">
                        <label class="control-label">Select Device Type For Repairing</label>
                        <select class="form-control" name="device_type">
                            <option value="mobile">Mobile</option>
                            <option value="computer">Computer</option>
                        </select>
                    </div>
                    <button class="btn btn-primary nextBtn pull-right" type="submit">Next <span
                            class="glyphicon glyphicon-arrow-right"></span></button>
                </form>
            </div>
        </div>
    </div>

@endsection
