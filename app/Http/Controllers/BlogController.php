<?php
namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use RealRashid\SweetAlert;
use Illuminate\Support\Str;
use HTMLPurifier_HTMLDefinition;
use HTMLPurifier_Config;
use HTMLPurifier;


class BlogController extends Controller
{
    public function index(){
        $data = DB::table('blog')
        ->orderBy('id','desc')
        ->get();
        return view('superadministrator.blog.index', compact('data'));
    }

    public function create(){
        return view('superadministrator.blog.create');
    }

    public function edit($id){
        $ids = \Crypt::decrypt($id);
        $data = DB::table('blog')->where('id',$ids)->first();
        return view('superadministrator.blog.edit', compact('data'));
    }

    public function post(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3',
            'thumbnail' => 'image|max:2048',
            'content' => 'required|min:10',
        ],[
            'title.required' => 'Title is required',
            'title.min' => 'Title must be at least 3 characters',
            'thumbnail.image' => 'Thumbnail must be an image',
            'thumbnail.max' => 'Thumbnail must be less than 2MB',
            'content.required' => 'Content is required',
            'content.min' => 'Content must be at least 10 characters',
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
            if ($request->hasFile('thumbnail')) {
                    $fileName = time() . '.' . $request->thumbnail->extension();
                    $request->thumbnail->move(public_path('assets/img/blog'), $fileName);
                    $filePath = '/assets/img/blog/' . $fileName;
            } else {
                $filePath = 'assets/img/default.jpg';
            }
            $slug = Str::slug($request->title, '-');
            $content = $request->input('content');
            $purifier = new \HTMLPurifier();
            $cleanContent = $purifier->purify($content);
            $id = DB::table('blog')->insert([
                'title' => $request->title,
                'slug' => $slug,
                'thumbnail' => $filePath,
                'content' => $cleanContent,
                'created_at' => Carbon::now('Asia/Jakarta')
            ]);
        } catch (QueryException $e){
            $error = $e->getMessage();
            Alert::error('Error',$error);
        }

        Alert::success('Success','Data berhasil disimpan!');
        return redirect()->route('blog.index');
    }

    public function update(Request $request, $id){

        $ids = \Crypt::decrypt($id);
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3',
            'thumbnail' => 'image|max:2048',
            'content' => 'required|min:10',
        ],[
            'title.required' => 'Title is required',
            'title.min' => 'Title must be at least 3 characters',
            'thumbnail.image' => 'Thumbnail must be an image',
            'thumbnail.max' => 'Thumbnail must be less than 2MB',
            'content.required' => 'Content is required',
            'content.min' => 'Content must be at least 10 characters',
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
            $blog = DB::table('blog')->find($ids);
            if (!$blog) {
                Alert::error('Error', 'Blog tidak ditemukan!');
                return redirect()->route('blog.index');
            }
    
            if ($request->hasFile('thumbnail')) {
                $fileName = time() . '.' . $request->thumbnail->extension();
                $request->thumbnail->move(public_path('assets/img/blog'), $fileName);
                $filePath = '/assets/img/blog/' . $fileName;
                // if ($blog->thumbnail != 'assets/img/default.jpg') {
                //     unlink(public_path($blog->thumbnail));
                // }
            } else {
                $avatarPath = DB::table('blog')->where('id', $ids)->first();
                $filePath = $blog->thumbnail;
            }
    
            $slug = Str::slug($request->title, '-');
            $content = $request->input('content');
            $purifier = new \HTMLPurifier();
            $cleanContent = $purifier->purify($content);
    
            DB::table('blog')->where('id', $ids)->update([
                'title' => $request->title,
                'slug' => $slug,
                'thumbnail' => $filePath,
                'content' => $cleanContent,
                'updated_at' => Carbon::now('Asia/Jakarta')
            ]);
        } catch (QueryException $e){
            $error = $e->getMessage();
            Alert::error('Error',$error);
        }
    
        Alert::success('Success','Data berhasil diupdate!');
        return redirect()->route('blog.index');
    }

    public function delete($id){

            $ids = \Crypt::decrypt($id);
            DB::table('blog')->where('id',$ids)->delete();
            Alert::success('Success','Data Berhasil Dihapus');
            return redirect()->back();
    }
}
