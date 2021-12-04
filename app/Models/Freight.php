<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freight extends Model
{
    use HasFactory;

    protected $table = 'freights';

    protected $fillable = [
        'manifest_id', 'bill_number', 'consignee', 'consignee_email', 'consignee_phone', 'consignee_address', 'shipper', 'destination', 'pieces', 'weight', 'date', 'byd_split', 'protective_service', 'due_date', 'created_by', 'approved_by', 'assigned_to',
        'status'
    ];


    function manifest()
    {
        return $this->belongsTo(Manifest::class, 'manifest_id');
    }

    function approvals()
    {
        return $this->hasMany(FreightApproval::class, 'freight_id');
    }

    function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
