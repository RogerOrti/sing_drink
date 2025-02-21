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
        return $this->belongsTo(Tipoultimedia::class, 'id_tipo_multimedia');
    }
}
