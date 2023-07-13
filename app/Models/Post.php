<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Post extends Model
{
    use HasFactory;

    protected $table = "posts" ;
    // public $timestamps = false;
    protected $fillable = [
        'title', 
        'description',
        'user_id',
        'category_id',
        'IsActive'      
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
