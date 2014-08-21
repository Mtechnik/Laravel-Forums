<?php

class ForumController extends BaseController
{
	public function index()
	{
		$groups = ForumGroup::all();
		$categories = ForumCategory::all();
		
		return View::make('forum.index')->with('groups', $groups)->with('categories', $categories);
	}

	public function category($id)
	{
		$category = ForumCategory::find($id);
		if ($category == null)
		{
			return Redirect::route('forum-home')->with('fail', "That category doesn't exist.");
		}
		$threads = $category->threads();
		return View::make('forum.category')->with('category', $category)->with('threads', $threads);
	}

	public function thread($id)
	{
		
	}

	public function storeGroup()
	{
		$validator = Validator::make(Input::all(), array(
			'group_name' => 'required|unique:forum_groups,title'
		));
		if ($validator->fails())
		{
			return Redirect::route('forum-home')->withInput()->withErrors($validator)->with('modal', '#group_form');
		}
		else
		{
			$group = new ForumGroup;
			$group->title = Input::get('group_name');
			$group->author_id = Auth::user()->id;

			if($group->save())
			{
				return Redirect::route('forum-home')->with('success', 'The group was created');
			}
			else
			{
				return Redirect::route('forum-home')->with('fail', 'An error occured while saving the new group.');
			}
		}
	}

	public function deleteGroup($id)
	{
		$group = ForumGroup::find($id);
		if($group == null)
		{
			return Redirect::route('forum-home')->with('fail', 'That group doesn\'t exist.');
		}

		$categories = $group->categories();
		$threads = $group->threads();
		$comments = $group->comments();

		$delCa = true;
		$delT = true;
		$delCo = true;

		if($categories->count() > 0)
		{
			$delCa = $categories->delete();
		}
		if($threads->count() > 0)
		{
			$delT = $threads->delete();
		}
		if($comments->count() > 0)
		{
			$delCo = $comments->delete();
		}


		if ($delCa && $delT && $delCo && $group->delete())
		{
			return Redirect::route('forum-home')->with('success', 'The group was deleted.');
		}
		else
		{
			return Redirect::route('forum-home')->with('fail', 'An error occured while deleting the group.');
		}
	}

	public function deleteCategory($id)
	{
		$category = ForumCategory::find($id);
		if($category == null)
		{
			return Redirect::route('forum-home')->with('fail', 'That category doesn\'t exist.');
		}

		$threads = $category->threads();
		$comments = $category->comments();

		$delT = true;
		$delCo = true;

		if($threads->count() > 0)
		{
			$delT = $threads->delete();
		}
		if($comments->count() > 0)
		{
			$delCo = $comments->delete();
		}


		if ($delT && $delCo && $category->delete())
		{
			return Redirect::route('forum-home')->with('success', 'The category was deleted.');
		}
		else
		{
			return Redirect::route('forum-home')->with('fail', 'An error occured while deleting the category.');
		}
	}
}