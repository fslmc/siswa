<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use RealRashid\SweetAlert;

class StatusSiswaController extends Controller
{
    public function index(){
        $data = DB::table('status_siswa')
        ->join('siswa', 'status_siswa.siswa', '=', 'siswa.id')
        ->select('status_siswa.id', 'siswa.nama', 'status_siswa.status')
        ->get();

        return view('superadministrator.status-siswa.index', compact('data'));
    }

    public function create(){
        $data = DB::table('siswa')
        ->select('id','nama', 'kelas')
        ->get();
        return view('superadministrator.status-siswa.create', compact('data'));
    }

    public function post(Request $request){
        // $validator = Validator::make($request->all(), [
        //     'nama' => 'required|min:3',
        //     'status' => 'required|min:3',
        // ],[
        //     'nama.required' => 'Nama Siswa harus diisi',
        //     'nama.min' => 'Nama Siswa minimal 3 karakter',
        //     'status.required' => 'Status Siswa harus diisi',
        // ]);

        // if($validator->fails()){
        //     $errors = $validator->errors();
        //     $errorMsg="
        //     ";
        //     foreach($errors->all() as $message){
        //         $errorMsg .= $message;
        //     }
        //         Alert::error('Error', $errorMsg);
        //         return redirect()->back()->withInput();
        // } 
        try{
            $id = DB::table('status_siswa')->insert([
                'siswa' => $request->siswa_id,
                'status' => $request->status,
                'created_at' => Carbon::now('Asia/Jakarta')
            ]);
        } catch (QueryException $e){
            $error = $e->getMessage();
            Alert::error('Error',$error);
        }

        Alert::success('Success','Data berhasil disimpan!');
        return redirect()->route('statussiswa.index');

    }
}
