<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_stock', 'stock_id', 'article_id')
                    ->withPivot('id', 'quantite', 'date')
                    ->withTimestamps();
    }

    public function depot()
    {
        return $this->belongsTo(Depot::class, 'id_depot', 'id');
    }
}
