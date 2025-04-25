<?php

namespace App\Models;

use App\Models\Usuari;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Chat extends Model
{
    use HasFactory;

    protected $table = 'chat';
    public $timestamps = false;

    protected $fillable = [
        'id_propietari',
        'id_music',
        'missatge',
        'enviat'
    ];

    public function propietari()
    {
        return $this->belongsTo(Usuari::class, 'id_propietari', 'id_user');
    }

    public function music()
    {
        return $this->belongsTo(Usuari::class, 'id_music', 'id_user');
    }

    // public function remitente()
    // {
    //     return $this->belongsTo(Usuari::class, 'id_propietari', 'id_user');
    // }

    // public function destinatario()
    // {
    //     return $this->belongsTo(Usuari::class, 'id_music', 'id_user');
    // }
}
