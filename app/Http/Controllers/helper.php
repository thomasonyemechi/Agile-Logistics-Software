<?php

use App\Models\Delivery;
use App\Models\Freight;
use App\Models\FreightApproval;

function manifestApproved($manifest_id, $col)
{
    $freights = Freight::where('manifest_id',  $manifest_id)->get(['id']); $a = 0;
    foreach($freights as $fre){
        $approvals = FreightApproval::where('freight_id', $fre->id)->get();
        foreach($approvals as $app){
            $a += $app->$col;
        }
    }
    return $a;
}


function manifestAssigned($manifest_id)
{
    $freights = Freight::where('manifest_id',  $manifest_id)->get(['id']); $assigned = 0;
    foreach($freights as $fre){
        $assigned += Delivery::where('freight_id', $fre->id)->sum('pieces');
    }
    return $assigned;
}

function manifestDelivered($manifest_id)
{
    $freights = Freight::where('manifest_id',  $manifest_id)->get(['id']); $delivered = 0;
    foreach($freights as $fre){
        $delivered += Delivery::where(['freight_id' => $fre->id, 'status' => 1 ])->sum('pieces');
    }
    return $delivered;
}


function errorParse($array){
    $array = json_decode($array);
    $all = []; $s = '';
    foreach ($array as $error){
        for($i = 0; $i < count($error); $i++){
            $all[] = $error[$i];
        }
    }
    foreach($all as $a) {
        $s .= $a. '<br>';
    }
    return $s;
}


function money($amt)
{
    return '$ '.number_format($amt, 2);
}

function UserRole($role)
{
    $name = '';
    if($role == 1) {
        $name = 'Driver';
    }else if($role == 3){
        $name = 'Staff';
    }else if($role == 5){
        $name = 'Super Admin';
    }else if($role == 0)
    {
        $name = 'Inactive account';
    }

    return $name;
}




function deliveryProStatus($status)
{
    $color = '';
    if($status == 0){
       $color = 'primary'; $title = 'APT';
    }elseif($status == 1){
        $color = 'success'; $title = 'DEL';
    }elseif($status == 2){
        $color = 'primary'; $title = 'RFS';
    }else{
        $color = 'secondary'; $title = '...';
    }
    $string  = '<div class="badge bg-'.$color.'">'.$title.'</div>';
    return $string;
}






function freightProStatus($status, $title)
{
    $color = '';
    if($status == 0){
       $color = 'danger';
    }elseif($status == 2){
        $color = 'warning';
    }elseif($status == 3){
        $color = 'primary';
    }elseif($status == 4){
        $color = 'secondary';
    }elseif($status == 5){
        $color = 'success';
    }
    $string  = '<div class="badge bg-'.$color.'">'.$title.'</div>';
    return $string;
}



function freightStatus($status)
{
    $title = '';  $color = '';
    if($status == 0){
        $title = 'Awaiting Approval'; $color = 'danger';
    }elseif($status == 2){
        $title = 'Approved'; $color = 'warning';
    }elseif($status == 3){
        $title = 'Assiginig'; $color = 'primary';
    }elseif($status == 4){
        $title = 'Assiginig Completed'; $color = 'secondary';
    }elseif($status == 5){
        $title = 'Completed'; $color = 'success';
    }
    $string  = '<div class="badge bg-'.$color.'">'.$title.'</div>';
    return $string;
}


function freightBgPick($status, $title)
{
    $color = '';
    if($status == 0){
       $color = 'danger';
    }elseif($status == 2){
        $color = 'warning';
    }elseif($status == 3){
        $color = 'primary';
    }elseif($status == 4){
        $color = 'secondary';
    }elseif($status == 5){
        $color = 'success';
    }
    $string  = '<div class="badge bg-'.$color.'">'.$title.'</div>';
    return $string;
}





function deliveryStatus($status)
{
    $title = '';  $color = '';
    if($status == 0){
        $title = 'Delivery Pending'; $color = 'secondary';
    }elseif($status == 1){
        $title = 'Delivered'; $color = 'success';
    }elseif($status == 3){
        $title = 'Not Delivered'; $color = 'danger';
    }
    $string  = '<div class="badge bg-'.$color.'">'.$title.'</div>';
    return $string;
}


// function totalF

