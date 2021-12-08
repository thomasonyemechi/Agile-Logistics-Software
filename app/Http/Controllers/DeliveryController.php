<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Freight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeliveryController extends Controller
{
    function driverFreightMessage(Request $request)
    {

        Validator::make($request->all(), [
            'action' => 'required|string',
            'message' => 'required|string',
        ])->validate();

        $msg = [
            'message' => $request->message,
            'time' => time(),
        ];

        $delivery = Freight::find($request->freight_id);
        if($delivery->message == ''){
            $all_new[] = $msg;
        }else {
            $former_message = json_decode($delivery->message, true);
            $former_message[] = $msg;
            $all_new = $former_message;
        }

        Freight::where('id', $request->freight_id)->update([
            'message' => json_encode($all_new),
            'status' => $request->action,
        ]);

        return back()->with('success', 'Freight updated <br> Message submitted sucessfuly');
    }


    function reassignFreight(Request $request)
    {

    }


    function assignFreightToDriver(Request $request)
    {
        Validator::make($request->all(), [
            'pieces' => 'required',
            'driver_id' => 'required',
        ])->validate();

        Freight::where('id', $request->freight_id)->update([
            'assigned_to' => $request->driver_id,
            'status' => 3
        ]);
        return back()->with('success', 'Freight sucessfully assigned to driver');
    }
}
