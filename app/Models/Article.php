<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'article_commande',  'article_id', 'commande_id')
                    ->withPivot('id', 'remise', 'quantite', 'remise_utilisateur', 'prix_net', 'total', 'quantite_reception')
                    ->withTimestamps();
    }

    public function receptions()
    {
        return $this->belongsToMany(Reception::class, 'article_reception')
                    ->withTimestamps();
    }
}
