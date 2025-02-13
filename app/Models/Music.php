<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;

    protected $table = 'music';

    protected $primaryKey = 'id_user';

    public $timestamps = false;

    public function estilMusica()
    {
        return $this->belongsTo(EstilMusica::class, 'id_estil');
    }

    public function contracte()
    {
        return $this->hasMany(Contractar::class, 'id_music');
    }

    public function multimedia()
    {
        return $this->belongsTo(Multimedia::class, 'id_multimedia');
    }

    public function user()
    {
        return $this->belongsTo(Usuari::class, 'id_user');
    }






}
