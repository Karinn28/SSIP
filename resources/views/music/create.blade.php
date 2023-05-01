@extends('layout.template')
<!-- START FORM -->
@section('conten')

<form action='{{ url('music') }}' method='post'>
@csrf 
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <a href="{{ url('music') }}" class="btn btn-secondary mb-3"> << Previous</a>
        <div class="mb-3 row">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
                <input type="varchar" class="form-control" name='title' value="{{ Session::get('title') }}" id="title">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="album" class="col-sm-2 col-form-label">Album</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='album' value="{{ Session::get('album') }}" id="album">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Artist</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='name' value="{{ Session::get('name') }}" id="name">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SAVE</button></div>
        </div>
    </div>
</form>
<!-- AKHIR FORM -->
@endsection