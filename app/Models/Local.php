<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Local extends Model
{
    use HasFactory;

    protected $table = 'local';

    protected $primaryKey = 'id_local';

    public $timestamps = false;

    public function tipoLocal()
    {
        return $this->belongsTo(TipoLocal::class, 'id_tipo_local');
    }

    public function propietari()
    {
        return $this->hasMany(Propietari::class, 'id_local');
    }

    public function actuar()
    {
        return $this->hasMany(Actuar::class, 'id_local');
    }

    /**
     * Get the multimedia associated with the Local
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function multimedia(): BelongsTo
    {
        return $this->belongsTo(Multimedia::class, 'multimedia_id_multimedia');
    }



}
