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


}


