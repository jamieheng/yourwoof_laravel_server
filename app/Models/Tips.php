<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tips extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tips';
    protected $fillable = [
        'tip_title',
        'tip_img',
        'tip_description',

    ];
}
