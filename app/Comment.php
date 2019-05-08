<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'autor_name',
		'autor_email',
		'body',
		'parent_id',
		'user_id',
	];

	protected $dates = [
		'deleted_at',
	];

	public function responses ()
	{
		return $this->hasMany(Comment::class);
	}

	public function commentParent () 
	{
		return $this->belongsTo(Comment::class);
	}

	public function article ()
	{
		return $this->belongsTo(Article::class);
	}
}
