<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commande extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function fournisseurs() {
        return $this->belongsTo(Fournisseur::class);
    }

    public function vehicules() {
        return $this->belongsTo(Vehicule::class, 'id');
    }

    public function receptions()
    {
        return $this->belongsTo(Reception::class, 'commande_id');
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_commande', 'commande_id', 'article_id')
                    ->withPivot('id', 'remise', 'quantite', 'remise_utilisateur', 'prix_net', 'total', 'quantite_reception')
                    ->withTimestamps();
    }

}
