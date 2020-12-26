<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
    ];

    public function path ($append = "") {
        return "/poem/" . $this->id . "/" . $append;
    }

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function likes () {
        return $this->hasMany(Like::class);
    }

    public function dislikes () {
        return $this->hasMany(Dislike::class);
    }

    public function favorites () {
        return $this->hasMany(Favorite::class);
    }
}
