<?php

class ForumThread extends Eloquent
{
	protected $table = 'forum_threads';

	public function group()
	{
		$this->belongsTo('ForumGroup');
	}

	public function category()
	{
		$this->belongsTo('ForumCategory');
	}

	public function comments()
	{
		return $this->hasMany('ForumComment', 'thread_id');
	}

	public function author()
	{
		return $this->belongsTo('User', 'author_id');
	}
}