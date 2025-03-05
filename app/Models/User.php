<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use HasFactory;

class User extends Authenticatable
{
    use Notifiable;

    // Tentukan kolom primary key pada model
    protected $primaryKey = 'id_user';

    // Tentukan tipe dari primary key sebagai integer
    protected $keyType = 'int';

    // Tentukan apakah primary key menggunakan auto increment atau tidak
    public $incrementing = true;

    // Field lain yang diperlukan
    protected $fillable = ['name', 'email', 'password', 'id_role'];
}
