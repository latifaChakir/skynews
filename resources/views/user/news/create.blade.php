@extends('layouts.layout')

@section('title', 'news-letters')

@section('content')
<form action="{{ route('newsletters.store') }}" method="post" class="px-4 mx-2 mt-4">
  @csrf
  <div class="form-group mb-4">
    <label for="name">Name:</label>
    <input type="text" name="name" class="form-control border px-2" id="name" placeholder="Enter newsletter name">
  </div>
  <div class="form-group mb-4">
    <label for="description">Description:</label>
    <input type="text" name="description" class="form-control border px-2" id="description" placeholder="Enter newsletter description">
  </div>
  <div class="form-group mb-4">
    <label for="category">Category:</label>
    <select name="category_id" id="category" class="form-control border px-2">
      <option value="">Select category</option>
      @foreach ($categories as $category)
      <option value="{{ $category->id }}">{{ $category->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group mb-4">
    <label for="content">Content</label>
    <textarea name="content" id="content"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>


@endsection