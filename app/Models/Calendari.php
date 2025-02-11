<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendari extends Model
{
    use HasFactory;

    protected $table = 'calendari';

    protected $primaryKey = 'id_calendari';

    public $timestamps = false;

    public function usuari()
    {
        return $this->hasMany(Usuari::class, 'id_usuari');
    }

}
