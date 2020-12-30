<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment'
    ];

    public function path ($append = "") {
        return "/comment/" . $this->id . "/" . $append;
    }

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function poem () {
        return $this->belongsTo(Poem::class);
    }
}
