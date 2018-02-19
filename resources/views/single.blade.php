@extends('./layouts/layout')
@section('content')
    <div id="main">
        <div id="post">
            <ul class="posts_list">
                    <li class="main_post">
                        <div class="post_author">
                            <h3>{{$post->title}}</h3>
                            <h4>{{$post->user->username}}</h4>
                            <span class="status">{{$post->created_at}}</span>
                            <p class="task_content">
                                {{$post->description}}
                            </p>
                            @if(unserialize(request()->cookie('user'))['auth'])
                            <p><a class="edit_button" href="{{route('edit_post',['id'=>$post->id])}}">EDIT</a></p>
                            @endif
                            @if(unserialize(request()->cookie('user'))['id']==$post->id)
                                <form action="{{route('delete_post',['id'=>$post->id])}}" METHOD="POST">
                                    <button class="btn btn-danger">DELETE</button>
                                    @method('DELETE')
                                    @csrf
                                </form>
                            @endif
                        </div>
                    </li>
            </ul>
        </div>
    </div>
@endsection