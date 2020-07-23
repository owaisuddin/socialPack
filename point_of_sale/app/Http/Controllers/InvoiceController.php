<?php

namespace App\Http\Controllers;

use App\DeliveredDevice;
use App\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::all();

        return view('invoice_list')->with('invoices', $invoices);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {

        $device = DeliveredDevice::where('id',$id)->first();

        $data = [
            'customer_name' => $device['first_name'].' '.$device['last_name'],
            'device_id' => $device['id'],
            'serial_number' => $device['serial_number'],
            'phone' => $device['phone'],
            'model' => $device['model'],
            'model_make' => $device['model_make'],
            'device_type' => $device['device_type'],
            'description' => $device['description'],
            'comments' => $device['comments'],
            'address' => $device['address'],
            'price' => $device['price'],
            'shipping_price' => 0
        ];

        $invoice = Invoice::create($data);
        $mail = new MailController();
        $mail->send($device['email'],$invoice->id);
        $mail->send($device['email'],$invoice->id,'REVIEW');
        return redirect()->route('invoices')->withSuccess('Invoice successfully generated.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::with(['deviceInvoice'])->where('id',$id)->first();
        return view('invoice')->with('invoice',$invoice);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
