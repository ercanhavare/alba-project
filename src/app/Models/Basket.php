<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Basket
 * @package App\Models
 * @property int id
 * @property int product_id
 * @property mixed price
 * @property mixed quantity
 * @property int user_id
 */
class Basket extends Model
{
    protected $fillable = ["product_id", "price", "quantity", "user_id"];
}
