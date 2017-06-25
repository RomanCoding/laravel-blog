@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form action="/posts" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <input name="title" id="title" placeholder="Title" class="form-control">
                </div>
                <div class="form-group">
                    <textarea name="body" id="body" placeholder="Wanna discuss?" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
@stop