<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('keyword') ? $request->get('keyword') : '';

        if ($keyword) {
            $posting = Post::where('name', 'LIKE', "%$keyword%")->paginate(8);
        } else {
            $posting = Post::paginate(8);
        }

        return view('pages.post_list', compact('posting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Posting';
        $action = route('posting.store');
        return view('pages.post_form', compact('title', 'action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:posts|min:5',
            'category' => 'required',
            'description' => 'required',
        ]);

        $data = $request->all();
        $new_post = Post::create($data);

        toast()->success('Tambah data berhasil.');
        return redirect()->route('posting');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Edit Posting';
        $posting = Post::where('id', $id)->first();
        $action = route('posting.update', $posting->id);
        
        return view('pages.post_form', compact('posting', 'action', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|unique:posts|min:5',
            'category' => 'required',
            'description' => 'required',
        ]);
        
        $data = $request->all();

        $change_posting = Post::find($id);
        $change_posting->update($data);

        toast()->success('Update data berhasil.');
        return redirect()->route('posting');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posting = Post::where('id', $id)->first();
        if($posting) {
            $posting->delete();

            toast()->success('Hapus data berhasil.');
            return redirect()->route('posting');
        } else {
            toast()->error('Hapus data gagal.');
            return redirect()->route('posting');
        }
    }
}
