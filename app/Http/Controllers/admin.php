<?php

namespace App\Http\Controllers;

use App\Models\author;
use App\Models\prodi;
use Illuminate\Http\Request;
use App\Models\repository;
use App\Models\type;
use App\Models\BackgroundImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\type;

class admin extends Controller
{
    //dashboard
    public function dashboard()
    {
        
        $author = DB::table('repository')->select('*')->groupBy('author_id')->get()->count();
        $prodi = DB::table('prodi')->count();
        $repo = DB::table('repository')->count();
        $background_image = BackgroundImage::latest()->first();
        return view('admin.dashboard', compact('author', 'prodi', 'repo','background_image'));
    }
    //authors_list
    public function authoradmin()
    {
        $repo = \DB::table('repository')->select('*')->groupBy('author_id')->get();
        return view('admin.authors_list', compact('repo'));
    }
    //prodi list
    public function prodiadmin()
    {
        $prodi = prodi::get();
        return view('admin.prodi_list', compact('prodi'));
    }
    //type list
    public function typeadmin()
    {
        $type = type::get();
        return view('admin.type_list', compact('type'));
    }
    //repo
    public function repoadmin()
    {
        $author = author::get();
        $prodi = prodi::get();
        $type = type::get();
        $repo = repository::with('type', 'prodi')->get();
        return view('admin.repository_list', compact('repo', 'author', 'type', 'prodi'));
    }
    //create repo
    public function tambahrepo()
    {
        $author = author::get();
        $prodi = prodi::get();
        $type = type::get();
        $repo = repository::with('type', 'prodi')->get();
        return view('admin.repository_form', compact('repo', 'author', 'type', 'prodi'));
    }

    public function store(Request $request)
    {
        Request()->validate([
            'year' => 'required',
            'title' => 'required',
            'descs' => 'required',
            'file' => 'required',
            'thumbnail' => 'required',
        ], [
            'year.required' => 'Wajib diisi!!!',
            'title.required' => 'Wajib diisi!!!',
            'descs.required' => 'Wajib diisi!!!',
            'file.required' => 'Wajib diisi!!!',
            'thumbnail.required' => 'Wajib diisi!!!',

        ]);
        // $file = Request()->file('file');
        // $fileName = Request()->title . '.' . $file->extension();
        // $file->move(public_path('file'), $fileName);

        // $file2 = Request()->file('thumbnail');
        // $fileName2 =  Request()->title . '.' . $file->extension();
        // $file2->move(public_path('thumbnail'), $fileName2);

        $file_name = $request->file->getClientOriginalName();
        $file_repo =  $request->file->storeAs('file', $file_name);

        $image_name = $request->thumbnail->getClientOriginalName();
        $image =  $request->thumbnail->storeAs('thumbnail', $image_name);
        $data = [
            'year' => Request()->year,
            'author_id' => Request()->author_id,
            'type_id' => Request()->type_id,
            'prodi_id' => Request()->prodi_id,
            'title' => Request()->title,
            'descs' => Request()->descs,
            'file' => $file_repo,
            'thumbnail' => $image,
        ];

        repository::create($data);
        return redirect('/admin/repository')->with('sukses', 'Data repository Berhasil Ditambahkan!');
    }
    public function deleterepo($id)
    {

        repository::find($id)->delete();
        return redirect('/admin/repository')->with('sukses', 'Data repository Berhasil Dihapus!');
    }

    public function editrepo($id)
    {
        $author = \DB::table('repository')->select('*')->groupBy('author_id')->get();
        // dd($author[0]->author_id);
        $prodi = prodi::get();
        $type = type::get();
        $repo = repository::with('type', 'prodi')->findorfail($id);
        return view('admin.repository_update', compact('repo', 'author', 'type', 'prodi'));
    }

    public function updaterepo(Request $request, $id)
    {
        Request()->validate([
            'year' => 'required',
            'title' => 'required',
            'descs' => 'required',

        ], [
            'year.required' => 'Wajib diisi!!!',
            'title.required' => 'Wajib diisi!!!',
            'descs.required' => 'Wajib diisi!!!',


        ]);

        if (Request()->hasFile('file')) {
            $repos = repository::find($id);
            if (Storage::exists($repos->file)) {
                Storage::delete($repos->file);
            }

            $file_name = $request->file->getClientOriginalName();
            $file_repo =  $request->file->storeAs('file', $file_name);
            $repos->update([
                'year' => Request()->year,
                'author_id' => Request()->author_id,
                'type_id' => Request()->type_id,
                'prodi_id' => Request()->prodi_id,
                'title' => Request()->title,
                'descs' => Request()->descs,
                'file' => $file_repo,
            ]);
        } else {
            $repos = repository::find($id);
            $repos->update([
                'year' => Request()->year,
                'author_id' => Request()->author_id,
                'type_id' => Request()->type_id,
                'prodi_id' => Request()->prodi_id,
                'title' => Request()->title,
                'descs' => Request()->descs,
            ]);
        }

        if (Request()->hasFile('thumbnail')) {
            $repos = repository::find($id);
            if (Storage::exists($repos->thumbnail)) {
                Storage::delete($repos->thumbnail);
            }

            $image_name = $request->thumbnail->getClientOriginalName();
            $image =  $request->thumbnail->storeAs('thumbnail', $image_name);
            $repos->update([
                'year' => Request()->year,
                'author_id' => Request()->author_id,
                'type_id' => Request()->type_id,
                'prodi_id' => Request()->prodi_id,
                'title' => Request()->title,
                'descs' => Request()->descs,
                'thumbnail' => $image,
            ]);
        } else {
            $repos->update([
                'year' => Request()->year,
                'author_id' => Request()->author_id,
                'type_id' => Request()->type_id,
                'prodi_id' => Request()->prodi_id,
                'title' => Request()->title,
                'descs' => Request()->descs,
            ]);
        }

        return redirect('/admin/repository');
    }
    //author
    public function formauthor()
    {
        return view('admin.authors_form');
    }

    public function tambahauthor(Request $request)
    {
        Request()->validate([

            'author' => 'required',

        ], [

            'author.required' => 'Wajib diisi!!!',


        ]);

        $data = [

            'author' => Request()->author,

        ];

        author::create($data);
        return redirect('/admin/author')->with('sukses', 'Data author Berhasil Ditambahkan!');
    }
    public function deleteauthor($id)
    {

        author::find($id)->delete();
        return redirect('/admin/author')->with('sukses', 'Data author Berhasil Dihapus!');
    }
    public function editauthor($id)
    {


        $author = author::findOrFail($id);
        return view('admin.authors_edit', compact('author'));
    }
    public function updateauthor(Request $request, $id)
    {
        Request()->validate([

            'author' => 'required',

        ], [

            'author.required' => 'Wajib diisi!!!',


        ]);

        $data = [

            'author' => Request()->author,

        ];

        author::find($id)->update($data);
        return redirect('/admin/author')->with('sukses', 'Data author Berhasil Diedit!');
    }


    //prodi
    public function formprodi()
    {
        return view('admin.prodi_form');
    }

    public function tambahprodi(Request $request)
    {
        Request()->validate([

            'prodi' => 'required',

        ], [

            'prodi.required' => 'Wajib diisi!!!',


        ]);

        $data = [

            'prodi' => Request()->prodi,

        ];

        prodi::create($data);
        return redirect('/admin/prodi')->with('sukses', 'Data prodi Berhasil Ditambahkan!');
    }
    public function deleteprodi($id)
    {

        prodi::find($id)->delete();
        return redirect('/admin/prodi')->with('sukses', 'Data prodi Berhasil Dihapus!');
    }
    public function editprodi($id)
    {


        $prodi = prodi::findOrFail($id);
        return view('admin.prodi_edit', compact('prodi'));
    }
    public function updateprodi(Request $request, $id)
    {
        Request()->validate([

            'prodi' => 'required',

        ], [

            'prodi.required' => 'Wajib diisi!!!',


        ]);

        $data = [

            'prodi' => Request()->prodi,

        ];

        prodi::find($id)->update($data);
        return redirect('/admin/prodi')->with('sukses', 'Data Prodi Berhasil Diedit!');
    }
    //type
    public function formtype()
    {
        return view('admin.type_form');
    }

    public function tambahtype(Request $request)
    {
        Request()->validate([

            'type' => 'required',

        ], [

            'type.required' => 'Wajib diisi!!!',


        ]);

        $data = [

            'type' => Request()->type,

        ];

        type::create($data);
        return redirect('/admin/type')->with('sukses', 'Data type Berhasil Ditambahkan!');
    }
    public function deletetype($id)
    {

        type::find($id)->delete();
        return redirect('/admin/type')->with('sukses', 'Data type Berhasil Dihapus!');
    }
    public function edittype($id)
    {


        $type = type::findOrFail($id);
        return view('admin.type_edit', compact('type'));
    }
    public function updatetype(Request $request, $id)
    {
        Request()->validate([

            'type' => 'required',

        ], [

            'type.required' => 'Wajib diisi!!!',


        ]);

        $data = [

            'type' => Request()->type,

        ];

        type::find($id)->update($data);
        return redirect('/admin/type')->with('sukses', 'Data Prodi Berhasil Diedit!');
    }
    //Background Image
    public function background_create()
    {
        return view('admin.background_img_form');
    }

    //Background Image Store
    public function background_store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'file' => 'file|mimes:pdf,png,jpg',
        ]);
        // File
        $filename = $request->file('file')->getClientOriginalName();
        $request->file('file')->storeAs('background-image',$filename);

        $validatedData = BackgroundImage::create([
            'file' => $filename,
        ]);
        
        return redirect('/admin/dashboard');
    }

    //Background Image Delete
    public function background_destroy(Request $request,$id)
    {
        $data = BackgroundImage::where('id',$id)->first();
        Storage::delete('background-image/'.$data->file);
        $data->delete();
       
        return redirect("/admin/dashboard");
        
    }

    //Background Image Update
    public function background_update(Request $request,$id)
    {
        $data = BackgroundImage::where('id',$id)->first();
    
        $validatedData = $request->validate([
            'file' => 'file|mimes:pdf,png,jpg',
        ]);
        // File
        $filename = $request->file('file')->getClientOriginalName();
        $request->file('file')->storeAs('background-image',$filename);
        Storage::delete('background-image/'.$data->file);
        $data->file = $filename;
        $data->save();
       
        return redirect("/admin/dashboard");
        
    }
}
