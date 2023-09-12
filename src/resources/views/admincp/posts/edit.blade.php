@extends('layouts.admin')
@section('content')
    <div class="container-fluid p-0">
        @auth
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row mb-2 mb-xl-3">
                    <div class="col-auto d-none d-sm-block">
                        <h3><strong>Edit {{ __('admincp.posts') }}</strong> </h3>
                    </div>
                    <div class="col-auto ms-auto text-end mt-n1">
                        <button type="submit" class="btn btn-md btn-primary">UPDATE</button>

                        {{-- <a href="{{ route('showpost', [$post->lang, $post->slug]) }}" class="btn btn-md btn-warning">View
                            Posts</a> --}}

                    </div>
                </div>
                <div class="row mb-2 mb-xl-3">
                    <div class="col-xl-8">
                        <div class="card border-0 shadow rounded">

                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="" class="form-label fw-bold">Judul</label>

                                    <input type="text" name="title"
                                        class="form-control @error('title') is-invalid @enderror" placeholder=""
                                        aria-describedby="helpId" value="{{ $post->title }}">
                                    <small id="helpId" class="text-muted">URL :
                                        https://sumberglobalenergy.co.id/{{ $post->lang }}/{{ $post->slug }}</small>
                                </div>
                                @error('title')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror


                                <div class="mb-3">
                                    <label for="" class="form-label fw-bold">Konten</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" name="content" rows="10" id="tinymce">{{ $post->content }}</textarea>
                                </div>
                                @error('content')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <div class="mb-3">
                                    <label for="" class="form-label fw-bold">Excerpt</label>
                                    <textarea class="form-control @error('excerpt') is-invalid @enderror tinymce" name="excerpt" rows="4">{{ Str::of(strip_tags($post->content))->words(30, ' ....') }}</textarea>
                                </div>
                                @error('excerpt')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <label for="" class="form-label fw-bold">Layout Option</label>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="custom-control custom-radio image-checkbox">
                                            <input type="radio" class="custom-control-input" id="ck2a" value="Full"
                                                name="layout" {{ $post->layout == 'Full' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="ck2a">
                                                <img src="/img/full-side.gif" alt="#" class="img-fluid">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="custom-control custom-radio image-checkbox">
                                            <input type="radio" class="custom-control-input" id="ck2b" value="Sidebar"
                                                name="layout" {{ $post->layout == 'Sidebar' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="ck2b">
                                                <img src="/img/page-side.gif" alt="#" class="img-fluid">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="custom-control custom-radio image-checkbox">
                                            <input type="radio" class="custom-control-input" value="Article" id="ck2c"
                                                name="layout" {{ $post->layout == 'Article' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="ck2c">
                                                <img src="/img/article-side.gif" alt="#" class="img-fluid">
                                            </label>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card border-0 shadow rounded">
                            <div class="card-header bg-dark text-white">
                                SETTING
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="" class="form-label fw-bold">STATUS</label>
                                    <select class="form-control @error('status') is-invalid @enderror" name="status">
                                        <option value="{{ $post->status }}">{{ $post->status }}</option>
                                        <option value="draf">Draf</option>
                                        <option value="publish">Publish</option>
                                    </select>
                                </div>
                                @error('status')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="mb-3">
                                    <label for="" class="form-label fw-bold">Date</label>
                                    <input type="date" class="form-control @error('gmt_date') is-invalid @enderror"
                                        value="{{ $post->date }}" name="date" aria-describedby="helpId" placeholder="">

                                </div>
                                @error('date')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-group mb-3">
                                    <label class="form-label fw-2 fw-bold">Image Features</label>
                                    <input type="file" class="form-control @error('images') is-invalid @enderror"
                                        name="images" id="images">
                                    <!-- error message untuk title -->
                                    @error('images')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    @if ($post->image)
                                        <a href="" type="button" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                            <img id="imgPreview" src="/storage/{{ $post->image->path ?? '' }}"
                                                class="img-fluid">
                                        </a>
                                    @else
                                        <img id="imgPreview"
                                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png"
                                            class="img-fluid">
                                    @endif
                                </div>




                                <div class="mb-3">
                                    <label for="" class="form-label fw-bold">Language
                                    </label>
                                    <select class="form-control @error('lang') is-invalid @enderror" name="lang">
                                        <option value="{{ $post->lang }}">
                                            @if ($post->lang == 'en')
                                                English
                                            @else
                                                Indonesia
                                            @endif
                                        </option>
                                        <option value="en">English</option>
                                        <option value="id">Indonesia</option>
                                    </select>
                                </div>
                                @error('lang')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror

                                @if (empty($post->category))
                                @else
                                    <div class="mb-3">
                                        <label for="" class="form-label fw-bold">Category</label>
                                        <select class="form-control  @error('id_category') is-invalid @enderror"
                                            name="id_category">
                                            @if (empty($post->id_category))
                                                <option value=""></option>
                                            @else
                                                <option value="{{ $post->category->id }}">{{ $post->category->name }}
                                                </option>
                                            @endif
                                            @foreach ($category as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif


                                @error('id_category')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <div class="mb-3" hidden>
                                    <label for="" class="form-label fw-bold">TYPE</label>
                                    <select class="form-control @error('type') is-invalid @enderror" name="type">
                                        <option value="{{ $post->type }}">{{ $post->type }}</option>
                                        <option value="Blog">Blog</option>

                                    </select>
                                </div>

                                @error('type')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror



                            </div>
                        </div>
                    </div>
            </form>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Image View</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <img src="/storage/{{ $post->image->path ?? '' }}" class="img-fluid">
                                <div class="d-grid gap-2">

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            @if ($post->image)
                                <form onsubmit="return confirm('{{ __('admincp.areyousure') }}');"
                                    action="{{ route('images.destroy', $post->image->id) }}" method="POST">

                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>

                                </form>
                            @endif


                        </div>
                    </div>
                </div>
            </div>
        @endauth
    </div>
    </div>
@endsection
