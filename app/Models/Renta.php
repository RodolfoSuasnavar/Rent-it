<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Renta extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'producto_id',
        'fecha_inicio',
        'fecha_final',
        'precio_total',
    ];
    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_final' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }


}
