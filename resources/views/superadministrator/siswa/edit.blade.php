<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="pagetitle">
        <h1>Edit Siswa</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Edit Data Siswa</a></li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('siswa.update', Crypt::encrypt($data->id)) }}" class="row g-3" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="mb-3 col-12">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" value="{{ $data->nama }}">
                            </div>
                            <div class="mb-3 col-12">
                                <label for="foto" class="form-label">Foto</label>
                                @if ($data->foto)
                                    <img src="{{ asset($data->foto) }}" class="img-fluid w-25"
                                    alt="{{ $data->nama }}">
                                @else
                                    <p class="my-3 fw-bold">Belum Ada Foto</p>
                                @endif
                            </div>
                            <div>
                                <label for="foto" class="form-label">Ubah Foto<span class="text-danger">*</span></label>
                                <input type="file" name="foto" id="foto" accept=".jpg, .jpeg, .png" max-size="2048">
                                <p class="small mb-0 mt-1 text-muted">
                                    Upload file dengan format JPEG JPG PNG. Maksimal ukuran file 2MB
                                </p>
                            </div>
                            <div class="mb-3 col-12">
                                <label for="Jenis Kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" aria-label="Default select example" name="jenis_kelamin" id="jenis_kelamin">
                                    <option selected disabled>-Pilih Jenis Kelamin-</option>
                                    <option value="Laki-laki" @if($data->jenis_kelamin == 'Laki-laki ') selected @endif>L</option>
                                    <option value="Perempuan" @if($data->jenis_kelamin == 'Perempuan') selected @endif>P</option>
                                </select>
                            </div>
                            <div class="mb-3 col-12">
                                <label for="No. HP" class="form-label">No. HP</label>
                                <input type="text" name="no_hp" class="form-control" id="no_hp" placeholder="Nomor HP" value="{{ $data->no_hp }}">
                            </div>
                            <div class="mb-3 col-12">
                                <label for="Kelas" class="form-label">Kelas</label>
                                <input type="text" name="kelas" class="form-control" id="kelas" placeholder="Kelas" value="{{ $data->kelas }}">
                            </div>
                            <div class="mb-3 col-12">
                                <button type="submit" class="btn btn-primary">Simpan <i class="bi bi-check"></i></button>
                                <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>        
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>