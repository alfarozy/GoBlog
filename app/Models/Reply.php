<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = ['comment_id', 'text'];
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
    public function user()
    {
        return $this->BelongsTo(User::class);
    }
}
