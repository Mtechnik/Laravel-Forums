@extends('layouts.master')

@section('head')
	@parent
	<title>Forum | {{ $thread->title }}</title>
@stop

@section('content')
	<div class="well">
		<h1>{{ $thread->title }}</h1>
		<h4>By: {{ $author }} on {{ $thread->created_at }}</h4>
		<hr>
		<p>{{ nl2br(BBCode::parse($thread->body)) }}</p>
	</div>
@stop
