<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }

    public function purchase_order()
    {
        return $this->belongsTo(Purchase_order::class);
    }
}
