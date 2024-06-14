<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pets extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pets';
    protected $fillable = [
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
