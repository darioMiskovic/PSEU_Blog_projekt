<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $table = 'posts';

    protected $fillable = [
        'naslov',
        'autor',
        'tekst',
        "kategorija_id"

    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
