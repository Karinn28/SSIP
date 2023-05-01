<?php

namespace App\Http\Controllers;

use App\Models\music;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Response;

class musicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 4;
        if(strlen($katakunci)){
            $data = music::where('title', 'like', "%$katakunci%")
                ->orWhere('album', 'like', "%$katakunci%")
                ->orWhere('name', 'like', "%$katakunci%")
                ->paginate($jumlahbaris);
            }else{
                $data = music::orderBy('title','asc')->paginate($jumlahbaris);
            }
        return view('music.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('music.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('title', $request->title);
        Session::flash('album', $request->album);
        Session::flash('name', $request->name);
        
        $request->validate([
            'title'=>'required|unique:music,title',
            'album'=>'required',
            'name'=>'required',
        ],[
            'title.required'=>'You have to fill this section',
            'title.unique'=>'The song is already in our database',
            'album.required'=>'You have to fill this section',
            'name.required'=>'You have to fill this section',
        

        ]);
        $data = [
            'title'=>$request->title,
            'album'=>$request->album,
            'name'=>$request->name,
        ];
        music::create($data);
        return redirect()->to('music')->with('Success', 'You successfuly add the song');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = music::where('title', $id)->first();
        return view('music.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'album'=>'required',
            'name'=>'required',
        ],[
            'album.required'=>'You have to fill this Album',
            'name.required'=>'You have to fill this Artist',
        ]);
        $data = [
            'album'=>$request->album,
            'name'=>$request->name,
        ];
        music::where('title', $id)->update($data);
        return redirect()->to('music')->with('Success', 'You successfuly update the song');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        music::where('title', $id)->delete();
        return redirect()->to('music')->with('success', 'You successfuly delete the song');
    }
}
