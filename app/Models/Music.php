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

}
