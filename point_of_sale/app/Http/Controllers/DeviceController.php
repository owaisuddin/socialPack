<?php

namespace App\Http\Controllers;

use App\ComputerChecklist;
use App\DeliveredComputerChecklist;
use App\DeliveredDevice;
use App\DeliveredMobileChecklist;
use Illuminate\Http\Request;
use Validator, Redirect, Input;
use App\Device;
use App\MobileChecklist;
use DB;

class DeviceController extends Controller
{
    public function index(Request $request)
    {
        $devices = Device::all();
        return view('device_submited')->with('devices', $devices);
    }

    public function show(Request $request, $id)
    {
        $device = Device::with(['deviceMobileCheckList','deviceComputerCheckList'])->where('id', $id)->first();
        return view('device_submission')->with('device', $device);
    }

    public function deviceSubmission(){
        return view('/home');
    }

    public function deliverDevice(Request $request, $id){
        $device = Device::with(['deviceMobileCheckList','deviceComputerCheckList'])->where('id', $id)->first();
        if(empty($device['deviceComputerCheckList'])){
            $type = 'mobile';
            return view('mobile_device_deliver')->with(compact('device','type'));
        }else{
            $type = 'computer';
            return view('computer_device_deliver')->with(compact('device','type'));
        }

    }

    public function deviceType(Request $request)
    {
        if ($request->get('device_type') == 'mobile') {
            return view('mobile_submission')->with('type', 'mobile');
        } else {
            return view('computer_submission')->with('type', 'computer');
        }
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'city' => 'required',
            'phone' => 'required',
            'pin_code' => 'required',
            'model' => 'required',
            'model_make' => 'required',
            'device_type' => 'required',
            'description' => 'required',
            'payment_type' => 'required',
            'price' => 'required',
            'note' => 'required',
            'received_by' => 'required',
            'agreement' => 'required',
            'serial_number' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $device = Device::create($request->all());
            $request->request->add([
                'device_id' => $device->id
            ]);

            if ($request->get('type') == 'mobile') {
                MobileChecklist::create($request->all());
            } else {
                ComputerChecklist::create($request->all());
            }
            DB::commit();
            $mail = new MailController();
            $mail->send($device['email'],$device['id'],'DS');
            return redirect()->route('device_submission')->withSuccess('Device successfully submitted.');
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            DB::roleback();
            return Redirect::back()->withErrors($exception->getMessage())->withInput();
        }

    }

    public function storeDeliver(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'city' => 'required',
            'phone' => 'required',
            'pin_code' => 'required',
            'model' => 'required',
            'model_make' => 'required',
            'device_type' => 'required',
            'description' => 'required',
            'payment_type' => 'required',
            'price' => 'required',
            'note' => 'required',
            'received_by' => 'required',
            'agreement' => 'required',
            'serial_number' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $device = DeliveredDevice::create($request->all());
            $request->request->add([
                'device_id' => $device->id,
                'status' => 'delivered'
            ]);

            Device::where('id' ,'=', $id)->update(['status'=>'delivered']);
            if ($request->get('type') == 'mobile') {
                DeliveredMobileChecklist::create($request->all());
            } else {
                DeliveredComputerChecklist::create($request->all());
            }
            DB::commit();
            $mail = new MailController();
            $mail->send($device['email'],$device['id'],'DD');
            return redirect()->route('delivered_device_submission')->withSuccess('Device successfully delivered.');
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            DB::roleback();
            return Redirect::back()->withErrors($exception->getMessage())->withInput();
        }
    }

    public function showDeliveredDevice(Request $request, $id)
    {
        $device = DeliveredDevice::with(['deviceMobileCheckList','deviceComputerCheckList'])->where('id', $id)->first();
        $type = 'delivered';
        return view('device_submission')->with(compact('device','type'));
    }

    public function deliveredList(){
        $devices = DeliveredDevice::all();
        return view('delivered_device')->with('devices', $devices);
    }

}
