<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fournisseur extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function purchase_orders()
    {
        return $this->hasMany(Purchase_order::class);
    }

    public function commandes() {
        return $this->hasMany(Commande::class);
    }
}
