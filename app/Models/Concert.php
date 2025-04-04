<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    use HasFactory;

    protected $table = 'calendari';

    protected $primaryKey = 'id_calendari';

    protected $fillable = ['data', 'estil_musica'];

    public $timestamps = false;

//     public function local()
// {
//     return $this->belongsTo(Local::class, 'local_id');
// }

// public function locals()
// {
//     return $this->belongsToMany(Local::class, 'actuar', 'id_user', 'id_local');
// }

public function local()
{
    return $this->belongsTo(Local::class, 'id_local');
}

}
