<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reception extends Model
{
    use HasFactory;

    public function commandes()
    {
        return $this->hasMany(Commande::class, 'id', 'commande_id');
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_reception')
                    ->withTimestamps();
    }
}
