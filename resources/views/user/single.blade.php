@extends('layout.v_userpanel')
@section('content')
    <h3>{{ $repo->title }}</h3>


    <div class="row">
        <div class="col-md-4">
            <center><img class="img-thumbnail" src="{{ asset('storage/' . $repo->thumbnail) }}"></center>
            <br>
        </div>
        <div class="col-md-8">
            <p><b>Description: </b><br>{{ $repo->descs }}</p>
            <p><b>Type: </b><br>{{ $repo->type->type }} </p>
            <p><b>Document: </b><br> {{ $repo->prodi->prodi }} </p>
            <p><b>Year: </b><br> {{ $repo->year }} </p>
            @php
                $author = explode('|', $repo->author_id);
            @endphp
            <p><b>Author: </b><br> {{ $author['1'] }}</p>
            <a href="{{ asset('storage/' . $repo->file) }}" class="btn btn-success">download</a>
            </h3>
        </div>
    </div>
@endsection
