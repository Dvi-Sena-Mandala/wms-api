<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{
    protected $primaryKey = "id";
    protected $keyType = "int";
    protected $table = "checkin";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'no_document',
        'kuantum',
        'driver_name',
        'vehicle_plat',
        'container_number',
        'document_type',
        'image_identity_card',
        'image_front_truck',
    ];
}
