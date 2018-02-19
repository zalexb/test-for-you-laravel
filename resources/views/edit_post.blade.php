@extends('./layouts/layout')
@section('content')
    <form id="edit_post" method="POST" action="{{route('edit_post',['id'=>$post->id])}}">
        @if(session('error'))
            <div class="alert alert-danger">
                {{session('error')}}
            </div>
        @endif
        <div class="form-group">
            <label>Title:</label>
            <input value="{{$post->title}}"
                   required name="title" style="width: 200px" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="content">Description:</label>
            <textarea required  name="description" style="height: 200px;width:800px;" class="form-control" id="pwd">
                {{$post->description}}
            </textarea>
        </div>
        @method('PUT')
        @csrf
        <button type="submit" class="btn btn-default">Save</button>
    </form>
@endsection