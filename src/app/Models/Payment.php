<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Payment
 * @package App\Models
 * @property int id
 * @property mixed total_price
 * @property int user_id
 * @property int product_id
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_ad
 * @property User user
 * @property Product product
 */
class Payment extends Model
{
    use SoftDeletes;

    protected $fillable = ["total_price", "user_id", "product_id"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
