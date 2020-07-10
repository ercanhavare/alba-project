<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Image
 * @package App\Models
 * @property int id
 * @property string name
 * @property string path
 * @property int product_id
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 * @property Product product
 */
class Image extends Model
{
    use SoftDeletes;

    protected $fillable = ["name", "path", "product_id"];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
