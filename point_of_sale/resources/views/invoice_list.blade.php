@extends('layouts.app')
<style>
    .table {
        background-color: whitesmoke;
    }
</style>
@section('content')
    <div class="container">
        <div class="row">


            <div class="justify-content-center col-sm-12">
                <h3 style="color: rgb(96, 89, 27); font-weight: bold">Invoices :</h3>
                <table class="table table-striped ">
                    <!--Table head-->
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Serial Number</th>
                        <th>Phone</th>
                        <th>Type</th>
                        <th>Model</th>
                        <th>Model Make</th>
                        <th>Price</th>
                        <th>Creation Date</th>
                        <th></th>
                    </tr>
                    </thead>
                    <!--Table head-->

                    <!--Table body-->
                    <tbody>
                    @foreach($invoices as $invoice)
                        @if($invoice->status == 'processing')
                            <tr class="table-info">
                        @else
                            <tr class="table-success">
                                @endif
                                <td>{{$invoice->customer_name}}</td>
                                <td>{{$invoice->serial_number}}</td>
                                <td>{{$invoice->phone}}</td>
                                <td>{{$invoice->device_type}}</td>
                                <td>{{$invoice->model}}</td>
                                <td>{{$invoice->model_make}}</td>
                                <td>{{$invoice->price}}</td>
                                <td>{{$invoice->created_at}}</td>
                                <td>
                                    <a href="invoice_details/{{$invoice->id}}" type="button" class="btn btn-warning btn-sm">
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
