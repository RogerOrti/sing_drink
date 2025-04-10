<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolUser extends Model
{
    use HasFactory;

    protected $table = 'rolUser';

    protected $primaryKey = 'id_rol';

    public $timestamps = false;

    public function user()
    {
        return $this->hasMany(User::class, 'id_rol');
    }
}
