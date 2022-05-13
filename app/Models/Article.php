<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public function purchase_orders()
    {
        return $this->belongsToMany(Purchase_order::class, 'purchase_order_product','article_id', 'purchase_order_id')
                    ->withPivot('remise', 'quantite', 'remise_utilisateur', 'prix_net', 'total')
                    ->withTimestamps();
    }
}
