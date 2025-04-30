<?php

namespace App\Models;

use App\Models\Chat;
use App\Models\Actuar;
use App\Models\RolUser;
use App\Models\Calendari;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuari extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'user';

    protected $primaryKey = 'id_user';

    public $timestamps = false;

    public function calendari()
    {
        return $this->belongsTo(Calendari::class, 'id_calendari');
    }

    public function rolUser()
    {
        return $this->belongsTo(RolUser::class, 'id_rol');
    }

    public function propietaris()
    {
        return $this->hasMany(Propietari::class, 'id_user');
    }

    public function musics()
    {
        return $this->hasMany(Music::class, 'id_user');
    }

    public function actuar()
    {
        return $this->hasMany(Actuar::class, 'id_user');
    }

    public function xatsPropietari()
    {
        return $this->hasMany(Chat::class, 'id_propietari');
    }

    public function xatsMusic()
    {
        return $this->hasMany(Chat::class, 'id_music');
    }







}


