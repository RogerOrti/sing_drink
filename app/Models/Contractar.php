<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contractar extends Model
{
    use HasFactory;

    protected $table = 'contractar';

    protected $primaryKey = "id_contracte";

    public $timestamps = false;

    public function musics()
    {
        return $this->belongsTo(Music::class, 'id_music');
    }

    public function propietaris()
    {
        return $this->belongsTo(Propietaris::class, 'id_propietari');
    }




}
