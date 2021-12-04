<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreightApproval extends Model
{
    use HasFactory;


    protected $table = 'freight_approvals';

    protected $fillable = [
        'pieces', 'created_by', 'freight_id', 'approved_by', 'message', 'photos', ''
    ];

    function freight() {
        return $this->belongsTo(Freight::class, 'freight_id');
    }

    function user()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
