<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    public function reception()
    {
        return $this->hasOne(Reception::class, 'id', 'id_reception');
    }
}
