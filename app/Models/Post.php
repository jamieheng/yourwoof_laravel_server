<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'post';
    protected $fillable = [
        'user_id',
        'adopter_id',

        'pet_name',
        'pet_breed',
        'pet_age',
        'pet_gender_id',
        'pet_description',
        'pet_img',
        'pet_status',
        'pet_cate_id',



    ];
}
