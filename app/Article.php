<?php

namespace App;

use App\Category;
use App\Tag;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    const DRAFT     = '0';
    const PUBLISHED = '1';

    protected $fillable = [
    	'title',
    	'slug',
    	'body',
    	'description',
    	'image',
    	'status',
    	'user_id',
    	'category_id',
    ];

    protected $dates = [
    	'deleted_at',
    ];

    public function category ()
    {
    	return $this->belongsTo(Category::class);
    }

    public function user () 
    {
    	return $this->belongsTo(User::class);
    }

    public function tags ()
    {
    	return $this->belongsToMany(Tag::class);
    }
}
