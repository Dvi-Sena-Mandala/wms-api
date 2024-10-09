<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model implements Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "users";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        "username",
        "password",
        "name",
    ];

    public function getAuthIdentifierName()
    {
        return "username";
    }


    public function getAuthIdentifier()
    {
        return $this->username;
    }


    public function getAuthPasswordName()
    {
        return "password";
    }


    public function getAuthPassword()
    {
        return $this->password;
    }


    public function getRememberToken()
    {
        return $this->token;
    }


    public function setRememberToken($value)
    {
        $this->token = $value;
    }


    public function getRememberTokenName()
    {
        return "token";
    }
}
