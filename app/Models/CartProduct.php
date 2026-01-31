<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    /** @use HasFactory<\Database\Factories\CartProductFactory> */
    use HasFactory;

    protected $primaryKey = 'cart_product_id';

    protected $guarded = [];
}
