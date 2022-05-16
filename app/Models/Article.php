<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'article_commande', 'commande_id', 'article_id')
                    ->withPivot('remise', 'quantite', 'remise_utilisateur', 'prix_net', 'total')
                    ->withTimestamps();
    }
}
