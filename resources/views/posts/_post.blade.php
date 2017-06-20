<div class="panel panel-default">
    <div class="panel-heading">
        <a href="{{ route('posts.show', $post) }}">
            {{ $post->title }}
        </a>

        <span class="pull-right">Author: {{ $post->user->name }}</span>
    </div>

    <div class="panel-body">
        {{ $post->body }}
    </div>
</div>