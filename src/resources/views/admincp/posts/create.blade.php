@extends('layouts.admin')
@section('content')
    <div class="container-fluid p-0">
        @auth
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-2 mb-xl-3">
                    <div class="col-auto d-none d-sm-block">
                        <h3><strong>Add New {{ __('admincp.posts') }}</strong> </h3>
                    </div>
                    <div class="col-auto ms-auto text-end mt-n1">
                        <button type="submit" class="btn btn-md btn-primary">PUBLISH</button>
                        <button type="reset" class="btn btn-md btn-warning">RESET</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">

                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="" class="form-label fw-bold">Judul</label>
                                    <input type="text" name="title"
                                        class="form-control @error('title') is-invalid @enderror">
                                    {{-- <small id="helpId" class="text-muted">Help text</small> --}}
                                    @error('title')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label fw-bold">Konten</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" name="content" rows="10" id="tinymce"></textarea>
                                </div>
                                @error('content')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror

                                {{-- <div class="mb-3">
                                    <label for="" class="form-label fw-bold">Excerpt</label>
                                    <textarea class="tinymce form-control @error('excerpt') is-invalid @enderror" name="excerpt" rows="3"></textarea>
                                </div>
                                @error('excerpt')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror --}}
                                @error('layout')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label for="" class="form-label fw-bold">Layout Option</label>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="custom-control custom-radio image-checkbox">
                                            <input type="radio" class="custom-control-input" value="Full" id="ck2a"
                                                name="layout">
                                            <label class="custom-control-label" for="ck2a">
                                                <img src="/img/full-side.gif" alt="#" class="img-fluid">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="custom-control custom-radio image-checkbox">
                                            <input type="radio" class="custom-control-input" value="Sidebar" id="ck2b"
                                                name="layout">
                                            <label class="custom-control-label" for="ck2b">
                                                <img src="/img/page-side.gif" alt="#" class="img-fluid">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="custom-control custom-radio image-checkbox">
                                            <input type="radio" class="custom-control-input" value="Article" id="ck2c"
                                                name="layout">
                                            <label class="custom-control-label" for="ck2c">
                                                <img src="/img/article-side.gif" alt="#" class="img-fluid">
                                            </label>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header bg-dark text-white">
                                SETTING
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="" class="form-label fw-bold">KATEGORI</label>
                                        <select class="form-control  @error('id_category') is-invalid @enderror"
                                            name="id_category">
                                            @foreach ($category as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="form-label fw-bold">BAHASA</label>
                                        <select class="form-control @error('lang') is-invalid @enderror" name="lang">
                                            <option value="en">English</option>
                                            <option value="id">Indonesia</option>
                                        </select>
                                    </div>

                                </div>
                                @error('id_category')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="mb-3">
                                    <label for="" class="form-label fw-bold">TANGGAL</label>
                                    <input type="date" id="date"
                                        class="form-control @error('gmt_date') is-invalid @enderror" name="date"
                                        aria-describedby="helpId" placeholder="">
                                    {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
                                </div>
                                @error('date')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <select class="form-control @error('status') is-invalid @enderror" name="status" hidden>

                                    <option value="publish">Publish</option>
                                    {{-- <option value="draf">Draf</option> --}}
                                </select>
                                @error('status')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <div class="form-group mb-3">
                                    <label class="form-label fw-bold">Images Feature</label>
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
                                    <img id="imgPreview"
                                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png"
                                        alt="preview image" class="img-fluid">
                                </div>



                                <div class="mb-3" hidden>
                                    <label for="" class="form-label fw-bold">Tipe</label>
                                    <select class="form-control @error('type') is-invalid @enderror" name="type">
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
                </div>
            </form>
        @endauth
    </div>
    </div>
@endsection
