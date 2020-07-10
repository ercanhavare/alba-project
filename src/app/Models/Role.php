<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Role
 * @package App\Models
 * @property int id
 * @property string name
 * @property string authority
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 * @property User users
 */
class Role extends Model
{
    use SoftDeletes;

    protected $fillable = ["name", "authority"];

    public function users()
    {
        return $this->hasMany(User::class);
    }

}
