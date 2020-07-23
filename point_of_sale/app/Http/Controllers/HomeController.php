<?php

namespace App\Http\Controllers;

use App\Device;
use App\Invoice;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $number_of_devices = Device::all()->count();
        $process_device = Device::where('status','processing')->count();
        $delivered_device = Device::where('status','delivered')->count();
        $invoiced_amount = Invoice::all()->sum('price');
        return view('dashboard')->with(compact('number_of_devices','process_device','delivered_device','invoiced_amount'));
    }
}
