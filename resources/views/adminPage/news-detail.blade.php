@extends('adminComponent.default')

@section('title', 'GreenBite Artikel')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Artikel</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Artikel</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-5">
                    <img src="{{ asset('assets/user/images/news/'.$news->image) }}" alt="Artikel" class="w-100">
                </div>
                <div class="col-lg-7">
                    <h1 class="mb-3 mt-2 text-dark">{{ $news->title }}</h1>
                    <p style="text-align: justify">
                        {!! $news->content !!}
                    </p>
                </div>
            </div>
            <a href="{{ route('adminNews') }}" class="btn btn-info float-right mr-3 mt-2">Kembali</a>
        </div>
    </div>
@endsection

@section('page-script')
@endsection
