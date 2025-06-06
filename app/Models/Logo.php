<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    protected $fillable = ['image', 'status', 'user_id'];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Static method to get the active logo with the highest ID
    public static function getActiveLogo()
    {
        return self::where('status', 1)
                   ->orderBy('id', 'desc')
                   ->first();
    }
}
