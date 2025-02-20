<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    use HasFactory;

    protected $table = 'multimedia';

    protected $primaryKey = 'id_multimedia';

    public $timestamps = false;

    public function tipoMultimedia()
    {
        return $this->belongsTo(TipoMultimedia::class, 'id_tipo_multimedia');
    }

    public function musics()
    {
        return $this->hasMany(Music::class, 'id_multimedia');
    }


}
