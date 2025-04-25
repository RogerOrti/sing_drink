<?php

namespace App\Models;

use App\Models\Local;
use App\Models\Usuari;
use App\Models\Multimedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Propietari extends Model
{
    use HasFactory;

    protected $table = 'propietari';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'id_local'
    ];

    protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('id_user', '=', $this->getAttribute('id_user'))
            ->where('id_local', '=', $this->getAttribute('id_local'));

        return $query;
    }

    public function usuari()
    {
        return $this->belongsTo(Usuari::class, 'id_user', 'id_user');
    }

    public function local()
    {
        return $this->belongsTo(Local::class, 'id_local', 'id_local');
    }

    public function contractar()
    {
        return $this->hasMany(Contractar::class, 'id_propietari');
    }
}
