<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $table = 'chat';

    protected $primaryKey = ['id_propietari', 'id_music'];

    public $timestamps = false;

    public function propietari()
    {
        return $this->belongsTo(Usuari::class, 'id_propietari');
    }

    public function music()
    {
        return $this->belongsTo(Usuari::class, 'id_music');
    }

}
