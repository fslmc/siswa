<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use RealRashid\SweetAlert;
use Illuminate\Support\Facades\Crypt;

class ListPrestasiSiswaController extends Controller
{
//     public function index($id){
//         $ids = \Crypt::decrypt($id);
//         $data = DB::table('list_prestasi_siswa')
//         ->join('siswa', 'list_prestasi_siswa.siswa', '=', 'siswa.id')
//         ->select('list_prestasi_siswa.*', 'siswa.nama as siswa_nama', 'list_prestasi_siswa.nama_prestasi')
//         ->where('list_prestasi_siswa.siswa', $ids)
//         ->orderBy('list_prestasi_siswa.id', 'desc')
//         ->get();
// $prestasi = DB::table('siswa')
//         ->where('id', $ids)
//         ->select('siswa.nama','siswa.jenis_kelamin','siswa.id')
//         ->first();

//     return view('superadministrator.list-prestasi-siswa.index', compact('prestasi','data'));
//     }

public function index($id){
    $ids = \Crypt::decrypt($id);
    $data = DB::table('list_prestasi_siswa')
        ->join('siswa', 'list_prestasi_siswa.siswa', '=', 'siswa.id')
        ->where('list_prestasi_siswa.siswa', $ids)
        ->select('list_prestasi_siswa.*', 'siswa.nama as siswa_nama')
        ->get();

    $prestasi = DB::table('siswa')
        ->where('id', $ids)
        ->select('siswa.nama', 'siswa.id')
        ->first();

    return view('superadministrator.list-prestasi-siswa.index', compact('prestasi','data'));
}

    public function create($id){
        $ids = \Crypt::decrypt($id);
        $prestasi = DB::table('siswa')
                    ->where('id', $ids)
                    ->select('siswa.nama', 'siswa.id')
                    ->first();

        return view('superadministrator.list-prestasi-siswa.create', compact('prestasi'));
    }

    public function post(Request $request, $id){
        $ids = \Crypt::decrypt($id);
        try{
            $id = DB::table('list_prestasi_siswa')->insert([
                'siswa' => $ids,
                'nama_prestasi' => $request->nama_prestasi,
                'created_at' => Carbon::now('Asia/Jakarta')
            ]);
        } catch (QueryException $e){
            $error = $e->getMessage();
            Alert::error('Error',$error);
        }

        Alert::success('Success','Data berhasil disimpan!');
        return redirect()->route('listprestasisiswa.index', ['id' => Crypt::encrypt($ids)]);
    }

    public function edit($id){
        $ids = \Crypt::decrypt($id);
        $prestasi = DB::table('siswa')
            ->where('id', $ids)
            ->select('siswa.nama', 'siswa.id')
            ->first();

            $data = DB::table('list_prestasi_siswa')
            ->join('siswa', 'list_prestasi_siswa.siswa', '=', 'siswa.id')
            ->where('list_prestasi_siswa.id', $ids)
            ->select('list_prestasi_siswa.*', 'siswa.nama as nama', 'siswa.id as siswa_id')
            ->first();

        return view('superadministrator.list-prestasi-siswa.edit', compact('prestasi', 'data'));
    }

    public function update(Request $request, $id){
        $ids = \Crypt::decrypt($id);
        try {
            DB::table('list_prestasi_siswa')
                ->where('id', $ids)
                ->update([
                    'nama_prestasi' => $request->nama_prestasi,
                    'updated_at' => Carbon::now('Asia/Jakarta')
                ]);
        } catch (QueryException $e) {
            $error = $e->getMessage();
            Alert::error('Error', $error);
        }

        Alert::success('Success', 'Data berhasil diupdate!');
        $siswaId = DB::table('list_prestasi_siswa')->where('id', $ids)->first()->siswa;
        return redirect()->route('listprestasisiswa.index', ['id' => Crypt::encrypt($siswaId)]);
    }

    public function delete($id){
        $ids = \Crypt::decrypt($id);
        DB::table('list_prestasi_siswa')->where('id', $ids)->delete();
        Alert::success('Success','Data Berhasil Dihapus');
        return redirect()->back();
    }
}
