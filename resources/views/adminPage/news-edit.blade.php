@extends('adminComponent.default')

@section('title', 'GreenBite Artikel')

@section('page-style')
    <script src="https://cdn.tiny.cloud/1/5hsj31ihf6r2vn03lry4wvwjpjlk8t4hinqfxft0kebk9v14/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Artikel</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ubah Artikel</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('adminNewsEditMethod', $news->id) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" class="form-control" name="title" value="{{ $news->title }}" placeholder="Judul ..." required>
                    @error('title')<p class="text-danger mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Isi</label>
                    <textarea name="content" id="content_tinymce" class="form-control" rows="10" placeholder="Isi ..." required>{{ $news->content }}</textarea>
                    @error('content')<p class="text-danger mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="mb-3">
                    <img src="{{ asset('assets/user/images/news/'.$news->image) }}" alt="Article" class="w-25 d-block mb-2">
                    <label class="form-label">Foto <b>(File tidak perlu diisi jika foto tidak ingin diubah)</b></label>
                    <input type="file" class="form-control" name="picture" id="picture" accept=".png,.jpg,.jpeg">
                    @error('picture')<p class="text-danger mt-1">{{ $message }}</p>@enderror
                </div>
                <button type="submit" id="submit" class="btn btn-primary float-right">Ubah</button>
                <a href="{{ route('adminNews') }}" class="btn btn-info float-right mr-3">Kembali</a>
            </form>
        </div>
    </div>
@endsection

@section('page-script')
    <script>
        tinymce.init({
            selector: '#content_tinymce',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
    </script>
@endsection
