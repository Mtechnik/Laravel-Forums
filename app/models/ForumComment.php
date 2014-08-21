<?php

class ForumComment extends Eloquent
{
	protected $table = 'forum_comments';

	public function group()
	{
		$this->belongsTo('ForumGroup');
	}

	public function category()
	{
		$this->belongsTo('ForumCategory');
	}

	public function thread()
	{
		$this->belongsTo('ForumThread');
	}
}