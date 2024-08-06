<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="pagetitle">
        <h1>Create Siswa</h1>
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
                <div class="card exception">
                    <div class="card-body">
                        <form action="{{ route('statussiswa.post') }}" class="row g-3" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="mb-3 col-12">
                                <label for="nama" class="form-label">Nama</label>
                                <select class="form-control" name="siswa_id" id="siswa_id" required>
                                    @foreach ($data as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }} || {{ $item->kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-12">
                                <label for="Status" class="form-label">Status</label>
                                <select class="form-select" aria-label="Default select example" name="status" id="status">
                                    <option selected disabled>-Pilih Status-</option>
                                    <option value="Sudah Lulus">Sudah Lulus</option>
                                    <option value="Belum Lulus">Belum Lulus</option>
                                </select>
                            </div>
                            <div class="mb-3 col-12">
                                <button type="submit" class="btn btn-primary">Simpan <i class="bi bi-check"></i></button>
                                <a href="{{ route('statussiswa.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>        
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>