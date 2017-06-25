@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h3>Tags: </h3>
                <tags :data="{{ $tags }}">
                </tags>
            </div>
            <div class="col-md-9">
                <h3>Posts: </h3>
                <posts :data="{{ $posts }}" :tags="{{ $tags }}">
                </posts>
            </div>
        </div>
    </div>
@stop