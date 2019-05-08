<?php

namespace App;

use App\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug'
    ];

    protected $dates = [
    	'deleted_at',
    ];

    public function articles ()
    {
    	return $this->belongsToMany(Article::class);
    }
}
