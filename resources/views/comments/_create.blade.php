<form action="{{ $endpoint }}" method="post">
    {{ csrf_field() }}
    <div class="form-group">
        <textarea name="body" id="body" placeholder="Wanna discuss?" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">Comment</button>
    </div>
</form>