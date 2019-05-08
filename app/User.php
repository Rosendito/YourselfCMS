<?php

namespace App;

use App\Article;
use App\Comment;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'password',
        'image',
        'email'
    ];

    protected $date = [
        'deleted_at',
    ];

    public function articles ()
    {
        return $this->hasMany(Article::class);
    }

    public function comments ()
    {
        return $this->hasMany(Article::class);
    }
}
