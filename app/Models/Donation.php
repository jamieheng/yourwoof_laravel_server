<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'donations';
    protected $fillable = [
        'user_id',
        'donation_amount',
        'donation_type',


    ];

    //idk why I have to write this to make it work
    protected $primaryKey = 'donation_id';


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
