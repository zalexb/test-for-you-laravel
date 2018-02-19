@extends('./layouts/layout')
@section('content')
    <form id="create_post" method="POST" action="{{route('create_post')}}">
        @if(session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
        @endif
        <div class="form-group">
            <label>Title:</label>
            <input required name="title" style="width: 200px" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="content">Description:</label>
            <textarea required name="description" style="height: 200px;width:800px;" class="form-control" id="pwd"></textarea>
        </div>
        @csrf
        <button type="submit" class="btn btn-default">Create</button>
    </form>
@endsection