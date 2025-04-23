<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultimediaMusic extends Model
{
    use HasFactory;

    protected $table = 'multimedia_music';

    protected $primaryKey = 'id_multimedia';

    public $timestamps = false;

    public function tipoMultimedia()
    {
        return $this->belongsTo(TipoMultimedia::class, 'id_tipo_multimedia');
    }

    public function Music()
    {
        return $this->belongsTo(Music::class, 'id_user');
    }


}
