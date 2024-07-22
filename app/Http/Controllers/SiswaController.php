<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use RealRashid\SweetAlert;

class SiswaController extends Controller
{
    public function index(){
        $data = DB::table('siswa')
        ->orderBy('id','desc')
        ->get();
        return view('superadministrator.siswa.index', compact('data'));
    }

    public function create(){
        return view('superadministrator.siswa.create');
    }

    public function post(Request $request){
        $validator = Validator::make($request->all(), [
            'nama' => 'required|min:3',
            'foto' => 'image|max:2048',
            'jenis_kelamin' => 'required|min:3',
            'no_hp' => 'required|min:3',
            'kelas' => 'required|min:3',
        ],[
            'nama.required' => 'Nama Siswa harus diisi',
            'nama.min' => 'Nama Siswa minimal 3 karakter',
            'foto.image' => 'Foto harus berupa gambar',
            'foto.max' => 'Foto maksimal 2 MB',
            'jenis_kelamin.required' => 'Jenis Kelamin harus diisi',
            'no_hp.required' => 'No HP harus diisi',
            'no_hp.min' => 'No HP minimal 3 karakter',
            'kelas.required' => 'Kelas harus diisi',
        ]);

        if($validator->fails()){
            $errors = $validator->errors();
            $errorMsg="
            ";
            foreach($errors->all() as $message){
                $errorMsg .= $message;
            }
                Alert::error('Error', $errorMsg);
                return redirect()->back()->withInput();
        } 
        try{
            if ($request->hasFile('foto')) {
                    $fileName = time() . '.' . $request->foto->extension();
                    $request->foto->move(public_path('assets/img/siswa'), $fileName);
                    $filePath = '/assets/img/siswa/' . $fileName;
            } else {
                $filePath = 'assets/img/card.jpg';
            }
            $id = DB::table('siswa')->insert([
                'nama' => $request->nama,
                'foto' => $filePath,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_hp' => $request->no_hp,
                'kelas' => $request->kelas,
                'created_at' => Carbon::now('Asia/Jakarta')
            ]);
        } catch (QueryException $e){
            $error = $e->getMessage();
            Alert::error('Error',$error);
        }

        Alert::success('Success','Data berhasil disimpan!');
        return redirect()->route('siswa.index');

    }

    public function edit($id){
        $ids = \Crypt::decrypt($id);
        $data = DB::table('siswa')->where('id',$ids)->first();
        return view('superadministrator.siswa.edit', compact('data'));
    }

    public function update(Request $request, $id){

        
        $ids = \Crypt::decrypt($id);
        $validator = Validator::make($request->all(), [
            'nama' => 'required|min:3',
            'foto' => 'image|max:2048',
            'jenis_kelamin' => 'required|min:3',
            'no_hp' => 'required|min:3',
            'kelas' => 'required|min:3',
        ],[
            'nama.required' => 'Nama Siswa harus diisi',
            'nama.min' => 'Nama Siswa minimal 3 karakter',
            'foto.image' => 'Foto harus berupa gambar',
            'foto.max' => 'Foto maksimal 2 MB',
            'jenis_kelamin.required' => 'Jenis Kelamin harus diisi',
            'no_hp.required' => 'No HP harus diisi',
            'no_hp.min' => 'No HP minimal 3 karakter',
            'kelas.required' => 'Kelas harus diisi',
        ]);

        if($validator->fails()){
            $errors = $validator->errors();
            $errorMsg="";
            foreach($errors->all() as $message){
                $errorMsg .= $message;
            }
                Alert::error('Error', $errorMsg);
                return redirect()->back()->withInput();
        }
        try{
            // Kelola Foto
            if($request->hasFile('foto')){
                $fileName = time(). '.' .$request->foto->extension();
                $request->foto->move(public_path('assets/img/siswa'), $fileName);
                $filePath = '/assets/img/siswa/' . $fileName;
            }else {
                $avatarPath = DB::table('siswa')->where('id', $ids)->first();
                $filePath = $avatarPath->foto;
            }
             DB::table('siswa')->where('id',$ids)->update([
                'nama' => $request->nama,
                'foto' => $filePath,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_hp' => $request->no_hp,
                'kelas' => $request->kelas,
                'updated_at' => Carbon::now('Asia/Jakarta')
            ]);
            } catch (QueryException $e){
            $error = $e->getMessage();
            Alert::error('Error',$error);
            }

        Alert::success('Success','Data berhasil disimpan!');
        return redirect()->route('siswa.index');
    }

    public function delete($id){
        $ids = \Crypt::decrypt($id);

        DB::table('siswa')->where('id',$ids)->delete();
        Alert::success('Success','Data Berhasil Dihapus');
        return redirect()->back();
    }
}
