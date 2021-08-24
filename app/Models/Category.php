<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'slug', 'status', 'class'];

    public function article()
    {
        return $this->hasMany(Article::class);
    }
}
