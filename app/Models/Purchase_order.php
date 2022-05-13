<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase_order extends Model
{
    
    use HasFactory;
    use SoftDeletes;

    public function vehicule()
    {
        return $this->hasOne(Vehicule::class);
    }

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'purchase_order_product', 'article_id', 'purchase_order_id')
                    ->withPivot('remise', 'quantite', 'remise_utilisateur', 'prix_net', 'total')
                    ->withTimestamps();
    }
}
