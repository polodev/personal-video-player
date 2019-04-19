@extends('layouts.app')

@section('content')

<div class=''>
	<h2>Add a series</h2>

	<form action="{{ route('series.update', ['series' => $series->id]) }}" method="post">
		@csrf
		@method('PUT')
		<div class='form-group'>
			<label for="topic">Topic</label>
			<select name="topic" class="form-control" id="topic">
				@foreach ($topics as $topic)
					<option {{$topic->id == $series->topic_id ? 'selected' : ''}} value="{{$topic->id}}">{{$topic->title}}</option>
				@endforeach
			</select>
		</div>
		<!-- /.form-group -->
		<div class='form-group'>
			<label for="title">Title</label>
			<input value="{{old('title', $series->title)}}" type="text" name="title" id="title" class="form-control">
		</div>
		<div class='form-group'>
			<label for="url">Url</label>
			<input value="{{old('url', $series->url)}}" type="text" name="url" id="url" class="form-control">
		</div>
		<div class='form-group'>
			<button type="submit" class="btn btn-info">Update</button>
		</div>
	</form>
</div>



@endsection