<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Adoption extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'adoptions';
    protected $fillable = [
        'user_id',
        'pet_id',
        'is_approved',


    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
