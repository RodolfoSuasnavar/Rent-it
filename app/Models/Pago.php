<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pagos';

    protected $fillable = [
        'renta_id',
        'fecha_pago',
        'tipo_pago',
    ];

    public function renta()
    {
        return $this->belongsTo(Renta::class);
    }




}
