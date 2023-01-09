<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depot extends Model
{
    protected $table = "depots";
    use HasFactory;

    public function receptions()
    {
        return $this->hasMany(Reception::class, 'id');
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class, 'id_depot');
    }
}
