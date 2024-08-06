<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="pagetitle">
        <h1>List Prestasi Siswa</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">List Prestasi Siswa</a></li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('listprestasisiswa.create', Crypt::encrypt($prestasi->id)) }}" class="btn btn-info">Tambah Data<i class="bi bi-plus-lg"></i></a>
                        <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Kembali</a>
                        <hr>
                        <table id="myTable" class="table datatable mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Nama Prestasi</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($data as $d)
                                    <tr>
                                        <td scope="row">{{ $no++ }}</td>
                                        <td scope="row">{{ $d->siswa_nama }}</td>
                                        <td scope="row">{{ $d->nama_prestasi }}</td>
                                        <td>
                                            <a href="{{ route('listprestasisiswa.edit',Crypt::encrypt($d->id)) }}" 
                                                class="btn btn-primary btn-sm" data-bs-toggle="tooltip" 
                                                data-bs-placement="top" title="Edit Siswa">
                                                <i class="fas fa-edit"></i></a>
                                            <a href="#"
                                                class="btn btn-danger btn-sm" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Hapus Siswa"
                                                onclick="event.preventDefault();
                                                Swal.fire({
                                                    title: 'Apa Anda Yakin?',
                                                    text: 'Data yang telah dihapus tidak dapat dikembalikan',
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonText: 'Ya',
                                                    cancelButtonText: 'Tidak',
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                    console.log('Form submission triggered');
                                                        document.getElementById('delete-form-{{ $d->id }}').submit();
                                                    }
                                                });"><i class="fas fa-trash"></i></a>
                                            <form id="delete-form-{{ $d->id }}" action="#"
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @push('scripts')
                            <script>
                                $(document).ready(function() {
                                    $('#myTable').DataTable();
                                });
                            </script>
                        @endpush
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>