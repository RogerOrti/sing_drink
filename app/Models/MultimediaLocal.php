<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultimediaLocal extends Model
{
    use HasFactory;

    protected $table = 'multimedia_local';

    protected $primaryKey = 'id_multimedia';

    public $timestamps = false;

    public function tipoMultimedia()
    {
        return $this->belongsTo(TipoMultimedia::class, 'id_tipo_multimedia');
    }

    public function Local()
    {
        return $this->hasOne(Local::class, 'id_local');
    }

}
