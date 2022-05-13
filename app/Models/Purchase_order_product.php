<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Purchase_order_product extends Model
{
    protected $table = 'puchase_order_product';
    use HasFactory;
}
