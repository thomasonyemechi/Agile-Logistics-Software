<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manifest extends Model
{
    use HasFactory;

    protected $table = 'manifests';

    protected $fillable = [
        'org_id', 'manifest_number', 'driver', 'owner', 'tractor_no', 'trailer_no', 'trailer_seal_no', 'plac', 'created_by'
    ];

    function org()
    {
        return $this->belongsTo(Organization::class, 'org_id');
    }

    function freights()
    {
        return $this->hasMany(Freight::class, 'manifest_id');
    }
}
