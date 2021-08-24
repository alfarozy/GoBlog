<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['text', 'article_id'];
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
