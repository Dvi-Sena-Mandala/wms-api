<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CheckOut extends Model
{
    protected $primaryKey = "id";
    protected $keyType = "int";
    protected $table = "checkout";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'checkin_id',
        'image_rear_truck',
        'image_front_truck'
    ];

    public function checkin()
    {
        return $this->hasOne(CheckIn::class, 'checkin_id', 'id');
    }
    public function users()
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }
}
