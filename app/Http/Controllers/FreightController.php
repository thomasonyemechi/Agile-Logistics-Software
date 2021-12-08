<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Freight;
use App\Models\FreightApproval;
use App\Models\Manifest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FreightController extends Controller
{


    function freightSummary($freight_id)
    {
        $freight = Freight::find($freight_id);

        $data = [
            'total' => $freight->pieces,
            'assigned' =>  Delivery::where(['freight_id' => $freight->id])->count(),
            'delivered' => Delivery::where(['freight_id' => $freight->id, 'status' => 1])->count(),
        ];

        $data['info'] = $freight;


        $data['deliveries'] = Delivery::where('freight_id', $freight->id)->limit(10)->get();


        return $data;

    }



    function approveFreight(Request $request)
    {
        $val = Validator::make($request->all(), [
            'pallet_in' => 'required|integer',
        ])->validate();

        $freight = Freight::find($request->freight_id);
        $names = [];
        if($request->hasFile('photos')){
            $photos = $request->file('photos');
            foreach($photos as $photo){
                $extension = $photo->getClientOriginalExtension();
                $name = rand(11111,9999999).time().'.'.$extension;
                $names[] = $name;
                move_uploaded_file($photo, 'assets/img/freight/'.$name);
            }
        }

        FreightApproval::create([
            'freight_id' => $request->freight_id,
            'pieces' => $request->pallet_in,
            'message' => $request->message,
            'approved_by' => auth()->user()->id,
            'photos' => json_encode($names),
        ]);

        if($freight->status < 2){
            $this->approve($request->freight_id);
        }

        return back()->with('success', 'Freight approve sucessfully');
    }



    function approveMultipleFreight(Request $request)
    {
        Validator::make($request->all(), [
            'freights' => 'required',
        ])->validate();
        $freights = explode(',', $request->freights);
        foreach($freights as $fre){
            $this->approve($fre);
        }
        return back()->with('success', 'Freight approved sucessfully');
    }

    function approve($freight_id)
    {
        Freight::where('id',  $freight_id)->update([
            'status' => 2
        ]);
    }

    function eidtFreight(Request $request)
    {
        $val = Validator::make($request->all(), [
            'bill_number' => 'required',
            'consignee' => 'required',
            'shipper' => 'required',
            'destination' => 'required',
            'pieces' => 'required',
            'weight' => 'required',
            'byd_split' => 'required',
            'date' => 'required',
            'due_date' => 'required',
        ])->validate();
        $freight = Freight::find($request->freight_id);

        // if($freight->status == 3){
        //     return back()->with('error', 'Freight assigned to a driver cannot be edited');
        // }

        Freight::where('id', $request->freight_id)->update([
            'bill_number' => $request->bill_number,
            'consignee' => $request->consignee,
            'consignee_email' => $request->consignee_email,
            'consignee_phone' => $request->consignee_phone,
            'consignee_address' => $request->consignee_address,
            'shipper' => $request->shipper,
            'destination' => $request->destination,
            'pieces' => $request->pieces,
            'weight' => $request->weight,
            'byd_split' => $request->byd_split,
            'protective_service' => $request->protective_service,
            'need_appointment' =>  $request->need_appointment ?? 0,
            'date' => $request->date,
            'due_date' => $request->due_date,
        ]);
        return back()->with('success', 'Freight updated sucessfully bsuccessfully');
    }







    function createFreight(Request $request)
    {
        $val = Validator::make($request->all(), [
            'bill_number' => 'required',
            'consignee' => 'required',
            'shipper' => 'required',
            'destination' => 'required',
            'pieces' => 'required',
            'weight' => 'required',
            'byd_split' => 'required',
            'date' => 'required',
            'due_date' => 'required',
        ])->validate();
        Freight::create([
            'manifest_id' => $request->manifest_id,
            'bill_number' => $request->bill_number,
            'consignee' => $request->consignee,
            'consignee_email' => $request->consignee_email,
            'consignee_phone' => $request->consignee_phone,
            'consignee_address' => $request->consignee_address,
            'shipper' => $request->shipper,
            'destination' => $request->destination,
            'pieces' => $request->pieces,
            'weight' => $request->weight,
            'byd_split' => $request->byd_split,
            'protective_service' => $request->protective_service,
            'date' => $request->date,
            'due_date' => $request->due_date,
            'need_appointment' =>  $request->need_appointment ?? 0,
            'created_by' => auth()->user()->id,
        ]);
        return back()->with('success', 'Freight added successfully');
    }


    function editManifest(Request $request)
    {
        Manifest::where('id', $request->manifest_id)->update([
            'manifest_number' => $request->manifest_number,
            'driver' => $request->driver,
            'owner' => $request->owner,
            'tractor_no' => $request->tractor_no,
            'trailer_no' => $request->trailer_no,
            'trailer_seal_no' => $request->trailer_seal_no,
            'plac'  => $request->plac,
        ]);
        return back()->with('success', 'Mainfest updated sucessfully!');
    }

    function createMainfest(Request $request)
    {
        $val = Validator::make($request->all(), [
            'manifest_number' => 'required',
        ])->validate();

        Manifest::create([
            'org_id' => $request->org_id,
            'manifest_number' => $request->manifest_number,
            'driver' => $request->driver,
            'owner' => $request->owner,
            'tractor_no' => $request->tractor_no,
            'trailer_no' => $request->trailer_no,
            'trailer_seal_no' => $request->trailer_seal_no,
            'plac'  => $request->plac,
            'created_by' => auth()->user()->id,
        ]);
        return back()->with('success', 'Mainfest created, add all freight now!');
    }
}
