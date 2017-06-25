@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h3>Popular posts</h3>
                <ul class="list-group">
                    @foreach($popular as $post)
                        <li class="list-group-item">
                            <a href="{{ $post->path() }}">
                                {{ $post->title }} ({{ $post->comments_count }} comments)
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-9">
                @foreach ($posts as $post)
                    <div class="col-md-12">
                        @include('posts._post')
                    </div>
                @endforeach
            </div>
            {{ $posts->links() }}
        </div>
    </div>
@endsection
