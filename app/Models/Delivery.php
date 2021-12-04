<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $table = 'deliveries';

    protected $fillable = [
        'freight_id', 'driver_id', 'pieces', 'status', 'message', 'created_by', 'date_del'
    ];

    function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    function freight()
    {
        return $this->belongsTo(Freight::class, 'freight_id');
    }

    function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
