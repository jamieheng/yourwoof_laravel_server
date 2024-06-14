<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tracking extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'trackings';
    protected $fillable = [
        'user_id',
        'pet_id',
        'pet_img_week1',
        'pet_img_week2',
        'pet_img_week3',
        'pet_img_week4',
        'is_completed',
        'is_bad_user',


    ];
}
