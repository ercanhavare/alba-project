<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 * @package App\Models
 * @property int id
 * @property string name
 * @property string code
 * @property int quantity
 * @property mixed price
 * @property string desc
 * @property int category_id
 * @property int user_id
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 * @property Category category
 * @property User user
 * @property Image images
 * @property Payment payments
 */
class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ["name","code", "quantity", "price", "desc", "category_id", "user_id"];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
