@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('posts._post')
            </div>
        </div>
        @if($post->comments)
            <div class="row">
                @foreach($post->comments as $comment)
                    <div class="col-md-10 col-md-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                {{ $comment->body }}
                                <span class="pull-right">Author: {{ $comment->user->name }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @if (Auth::check())
            <div class="col-md-10 col-md-offset-1">
                @component('comments._create')
                    @slot('endpoint')
                        {{ $post->path() }}
                    @endslot
                @endcomponent
            </div>
        @endif
    </div>
@endsection
