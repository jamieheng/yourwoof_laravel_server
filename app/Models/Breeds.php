<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Breeds extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'breeds';
    protected $fillable = [
        'cate_id',
        'breed_name',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'cate_id');
    }
}
