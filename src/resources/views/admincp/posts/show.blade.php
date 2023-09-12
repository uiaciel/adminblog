@extends('layouts.admin')
@section('content')
    <div class="container-fluid p-0">
        <div class="row mb-2 mb-xl-3">
            <div class="col-xl-8">
                <div class="card">
                    {{-- <img src="/storage/{{ $post->image->path }}" class="card-img-top" alt="..."> --}}
                    <div class="card-body">
                        <h3>{{ $post->title }}</h3>
                        <p class="card-text"> {!! $post->content !!}</p>

                    </div>
                </div>

            </div>
            <div class="col-xl-4">
                <div class="card" style="width: 18rem;">
                    <img src="/storage/{{ $post->image->path }}" class="card-img-top" alt="...">
                    <div class="card-body">


                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Edit</a>
                    </div>
                    <ul class="list-group mb-3">
                        <li class="list-group-item active" aria-current="true">An active item</li>
                        <li class="list-group-item">Language : {{ $post->lang }}</li>
                        <li class="list-group-item">A third item</li>
                        <li class="list-group-item">A fourth item</li>
                        <li class="list-group-item disabled" aria-disabled="true">And a fifth one</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
