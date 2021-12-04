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

        $delivery = Delivery::find($request->delivery_id);
        if($delivery->message == ''){
            $all_new[] = $msg;
        }else {
            $former_message = json_decode($delivery->message, true);
            $former_message[] = $msg;
            $all_new = $former_message;
        }

        Delivery::where('id', $request->delivery_id)->update([
            'message' => json_encode($all_new),
        ]);

        if($request->action > 0) {
            Delivery::where('id', $request->delivery_id)->update([
                'status' => $request->action,
                'date_del' => time(),
            ]);
        }

        return back()->with('success', 'Freight updated <br> Message submitted sucessfuly');
    }


    function reassignFreight(Request $request)
    {

    }


    function assignFreight(Request $request)
    {
        Validator::make($request->all(), [
            'pieces' => 'required',
            'driver_id' => 'required',
        ])->validate();

        $freight = Freight::find($request->freight_id);
        $pieces_assigned = Delivery::where('freight_id', $request->freight_id)->sum('pieces');
        $all = $pieces_assigned + $request->pieces;
        if($all > $freight->pieces){
            return back()->with('error', 'Value specifed is more than value in stock');
        }
        Delivery::create([
            'freight_id' => $request->freight_id,
            'driver_id' => $request->driver_id,
            'pieces' => $request->pieces,
            'staus' => 1,
            'created_by' => auth()->user()->id,
        ]);
        Freight::where('id', $request->freight_id)->update([
            'status' => 3
        ]);
        return back()->with('success', 'Freight sucessfully assigned to driver');
    }
}
