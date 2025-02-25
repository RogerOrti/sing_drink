<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuari extends Model
{
    use HasFactory;

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


