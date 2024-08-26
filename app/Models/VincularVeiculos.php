<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VincularVeiculos extends Model
{
    use HasFactory;

    protected $fillable = [
        'placa',
        'grupo_cliente',
        'whatsapp',
        'deleted_at'
    ];
}
