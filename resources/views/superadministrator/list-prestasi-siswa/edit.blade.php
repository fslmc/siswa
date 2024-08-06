<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="pagetitle">
        <h1>Edit Prestasi Siswa</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Edit Prestasi Siswa</a></li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-12">
                <div class="card exception">
                    <div class="card-body">
                        <form action="{{ route('listprestasisiswa.update', Crypt::encrypt($data->id)) }}" class="row g-3" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="mb-3 col-12">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" value="{{ $data->nama }}" name="nama" class="form-control" id="nama" placeholder="Nama" disabled>
                            </div>
                            <div class="mb-3 col-12">
                                <label for="nama_prestasi" class="form-label">Nama Prestasi</label>
                                <input type="text" value="{{ $data->nama_prestasi }}" name="nama_prestasi" class="form-control" id="nama_prestasi" placeholder="Nama Prestasi      ex:'Juara Futsal Peringkat 1'  ">
                            </div>
                            <div class="mb-3 col-12">
                                <button type="submit" class="btn btn-primary">Simpan <i class="bi bi-check"></i></button>
                                <a href="{{ route('listprestasisiswa.index', Crypt::encrypt($data->siswa_id)) }}" class="btn btn-secondary">Kembali</a>
                            </div>        
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>