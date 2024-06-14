<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Surrender extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'surrenders';
    protected $fillable = [
        'user_id',
        'pet_name',
        'pet_breed',
        'pet_age',
        'pet_gender_id',
        'pet_description',
        'pet_img',
        'pet_status',
        'pet_cate_id',

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
