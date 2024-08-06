<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="pagetitle">
        <h1>Create Blog</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Create Data Siswa</a></li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="">
                        <form action="{{ route('blog.update', Crypt::encrypt($data->id)) }}" class="row g-3 exception" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="mb-3 col-12">
                                <label for="title" class="form-label">Judul</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="titlw" value="{{ $data->title }}">
                            </div>
                            <div class="mb-3 col-12">
                                <label for="thumbnail" class="form-label">Thumbnail</label>
                                @if ($data->thumbnail)
                                    <img src="{{ asset($data->thumbnail) }}" class="img-fluid w-25"
                                    alt="{{ $data->title }}">
                                @else
                                    <p class="my-3 fw-bold">Belum Ada Thumbnail</p>
                                @endif
                            </div>
                            <div class="mb-3 col-12">
                                <label for="thumbnail" class="form-label">Ubah Thumbnail<span class="text-danger">*</span></label>
                                <input type="file" name="thumbnail" id="thumbnail" accept=".jpg, .jpeg, .png" max-size="2048">
                                <p class="small mb-0 mt-1 text-muted">
                                    Upload file dengan format JPEG JPG PNG. Maksimal ukuran file 2MB
                                </p>
                            </div>
                            <div class="mb-3 col-12">
                                <label for="content">Artikel</label>
                                <textarea id="summernote" name="content">{{ $data->content }}</textarea>
                            </div>
                            <div class="mb-3 col-12">
                                <button type="submit" class="btn btn-primary">Simpan <i class="bi bi-check"></i></button>
                                <a href="{{ route('blog.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>        
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        @push('scripts')
        <script>
            $(document).ready(function() {
                $('#summernote').summernote({
                    height: 300,
                });
            });
        </script>
        @endpush
    </section>
</x-app-layout>