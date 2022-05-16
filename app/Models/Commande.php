<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commande extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_commande', 'commande_id', 'article_id')
                    ->withPivot('remise', 'quantite', 'remise_utilisateur', 'prix_net', 'total')
                    ->withTimestamps();
    }
}
