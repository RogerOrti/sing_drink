<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    use HasFactory;

    protected $table = 'local';

    protected $primaryKey = 'id_local';

    public $timestamps = false;

    public function tipoLocal()
    {
        return $this->belongsTo(TipouLocal::class, 'id_tipo_local');
    }

    public function propietari()
    {
        return $this->hasMany(Propietari::class, 'id_local');
    }

    public function actuar()
    {
        return $this->hasMany(Actuar::class, 'id_local');
    }





}
