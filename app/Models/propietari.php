<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class propietari extends Model
{
    use HasFactory;

    protected $table = 'propietari';

    protected $primaryKey = 'id_user';

    public $timestamps = false;

}
