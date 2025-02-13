<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class propietari extends Model
{
    use HasFactory;

    protected $table = 'propietari';

    protected $primaryKey = 'id_user';

    public $timestamps = false;

    public function local()
    {
        return $this->belongsTo(Local::class, 'id_local');
    }

    public function user()
    {
        return $this->belongsTo(Usuari::class, 'id_user');
    }

    public function contractar()
    {
        return $this->hasMany(Contractar::class, 'id_propietari');
    }






}
