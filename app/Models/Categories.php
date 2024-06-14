<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'categories';
    protected $fillable = [
        'id',
        'cate_name'
    ];

    public function breeds()
    {
        return $this->hasMany(Breeds::class, 'cate_id');
    }

    protected static function boot()
    {
        parent::boot();

        // Handle category ID updates
        static::updated(function ($category) {
            if ($category->isDirty('id')) {
                $oldId = $category->getOriginal('id');
                $newId = $category->id;

                Breeds::where('cate_id', $oldId)->update(['cate_id' => $newId]);
            }
        });
    }
}
