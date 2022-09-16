<?php

namespace App\Http\Controllers;

use App\Models\author;
use App\Models\prodi;
use Illuminate\Http\Request;
use App\Models\repository;
use App\Models\type;
use Illuminate\Support\Facades\Storage;

class user extends Controller
{
    public function dashboarduser()
    {
        $author = author::get();
        $prodi = prodi::get();
        $type = type::get();
        $repo = repository::with('type', 'prodi')->latest()->get();
        return view('user.dashboard', compact('repo', 'author', 'type', 'prodi'));
    }
    //single
    public function single($id)
    {
        $author = author::get();
        $prodi = prodi::get();
        $type = type::get();
        $repo = repository::with('type', 'prodi')->findorfail($id);
        return view('user.single', compact('repo', 'author', 'type', 'prodi'));
    }

    public function singleAuthor($id)
    {
        $repo = repository::with('type', 'prodi')->where('author_id', $id)->get();
        return view('user.single_authors', compact('repo', 'id'));
    }

    public function singleProdi($id)
    {
        $prodi = prodi::findOrFail($id);
        $repo = repository::with('type', 'prodi')->where('prodi_id', $id)->get();
        return view('user.single_prodis', compact('repo', 'prodi'));
    }

    public function singleType($id)
    {
        $type = type::findOrFail($id);
        $repo = repository::with('type', 'prodi')->where('type_id', $id)->get();
        return view('user.single_types', compact('repo', 'type'));
    }

    //authors_list
    public function authoruser()
    {
        $repo = \DB::table('repository')->select('*')->groupBy('author_id')->get();
        return view('user.authors_list', compact('repo'));
    }
    public function formauthor()
    {
        return view('user.authors_form');
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
        return redirect('/user/author')->with('sukses', 'Data author Berhasil Ditambahkan!');
    }
    //prodi list
    public function prodiuser()
    {
        $prodi = prodi::get();
        return view('user.prodi_list', compact('prodi'));
    }
    public function formprodi()
    {
        return view('user.prodi_form');
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
        return redirect('/user/prodi')->with('sukses', 'Data prodi Berhasil Ditambahkan!');
    }
    //type list
    public function typeuser()
    {
        $type = type::get();
        return view('user.type_list', compact('type'));
    }
    public function formtype()
    {
        return view('user.type_form');
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
        return redirect('/user/type')->with('sukses', 'Data type Berhasil Ditambahkan!');
    }


    //title
    public function title()
    {
        $repo = repository::get();

        return view('user.title', compact('repo'));
    }
    //repo
    public function repouser()
    {
        $author = author::get();
        $prodi = prodi::get();
        $type = type::get();
        $repo = repository::with('type', 'prodi')->get();
        // dd($repo[0]);
        return view('user.repository_list', compact('repo', 'author', 'type', 'prodi'));
    }

    //repositori
    public function tambahrepo()
    {
        // dd(request()->session()->get('name'));
        $me = request()->session();
        // dd($me);
        $author = author::get();
        $prodi = prodi::get();
        $type = type::get();
        $repo = repository::with('type', 'prodi')->get();
        return view('user.repository_form', compact('repo', 'author', 'type', 'prodi', 'me'));
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
        return redirect('/user/repository')->with('sukses', 'Data repository Berhasil Ditambahkan!');
    }
}
