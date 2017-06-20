@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-md-12">
                    @include('posts._post')
                </div>
            @endforeach
            {{ $posts->links() }}
        </div>
    </div>
@endsection
