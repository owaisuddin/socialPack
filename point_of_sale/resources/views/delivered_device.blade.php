@extends('layouts.app')
<style>
    .table {
        background-color: whitesmoke;
    }
</style>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6 pull-left">
                <h3 style="color: rgb(96, 89, 27); font-weight: bold">Delivered Devices :</h3>
            </div>
            <div class="col-sm-6 pull-right">
            </div>
            <div class="justify-content-center col-sm-12">

                <table class="table table-striped ">
                    <!--Table head-->
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>City</th>
                        <th>Phone</th>
                        <th>Type</th>
                        <th>Model</th>
                        <th>Model Make</th>
                        <th>Price</th>
                        <th>Received By</th>
                        <th>Status</th>
                        <th>Submitted Date</th>
                        <th></th>
                    </tr>
                    </thead>
                    <!--Table head-->

                    <!--Table body-->
                    <tbody>
                    @foreach($devices as $device)
                        @if($device->status == 'processing')
                            <tr class="table-info">
                        @else
                            <tr class="table-success">
                                @endif
                                <td>{{$device->first_name.' '.$device->last_name}}</td>
                                <td>{{$device->city}}</td>
                                <td>{{$device->phone}}</td>
                                <td>{{$device->device_type}}</td>
                                <td>{{$device->model}}</td>
                                <td>{{$device->model_make}}</td>
                                <td>{{$device->price}}</td>
                                <td>{{$device->received_by}}</td>
                                <td>{{$device->status}}</td>
                                <td>{{$device->created_at}}</td>
                                <td>
                                    <a href="/delivered_device/{{$device->id}}" type="button" class="btn btn-warning btn-sm">
                                        <span class="glyphicon glyphicon-eye-open"></span> View
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                    <!--Table body-->
                </table>
            </div>
        </div>
    </div>

@endsection
