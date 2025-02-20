<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstilMusica extends Model
{
    use HasFactory;

    protected $table = 'estil_musica';

    protected $primaryKey = 'id_estil';

    public $timestamps = false;

    public function musics()
    {
        return $this->hasMany(Music::class, 'id_estil');
    }
}
