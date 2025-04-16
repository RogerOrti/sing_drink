<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


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

    public function propietario()
    {
        return $this->belongsTo(Propietari::class, 'id_propietari', 'id_user');
    }

    public function musico()
    {
        return $this->belongsTo(Music::class, 'id_music', 'id_user');
    }

    public function remitente()
    {
        return $this->belongsTo(Usuari::class, 'id_propietari', 'id_user');
    }

    public function destinatario()
    {
        return $this->belongsTo(Usuari::class, 'id_music', 'id_user');
    }
}
