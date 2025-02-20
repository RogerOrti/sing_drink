<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actuar extends Model
{
    use HasFactory;

    protected $table = 'actuar';

    protected $primaryKey = '';

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(Usuari::class, 'id_user');

    }

    public function local()
    {
        return $this->belongsTo(Local::class, 'id_local');
    }



}
