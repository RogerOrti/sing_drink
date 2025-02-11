<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMultimedia extends Model
{
    use HasFactory;

    protected $table = 'tipo_multimedia';

    protected $primaryKey = 'id_tipo_multimedia';

    public $timestamps = false;

    public function multimedia()
    {
        return $this->hasMany(Multimedia::class, 'id_multimedia');
    }
}
