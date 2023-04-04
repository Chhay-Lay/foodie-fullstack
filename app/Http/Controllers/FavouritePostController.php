<?php

namespace App\Http\Controllers;

use App\Models\FavouritePost;
use App\Models\Post;
use Illuminate\Http\Request;

class FavouritePostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post_ids = FavouritePost::where('user_id', auth()->user()->id)->get(['post_id']);
        $posts = Post::whereIn('id', $post_ids)->get();
        return view('auth.profile.saved_post', [
            'posts' => $posts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id)
    {
        if (auth()->check()) {
            FavouritePost::create([
                'user_id' => auth()->user()->id,
                'post_id' => $post_id,
            ]);
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FavouritePost::destroy($id);
        return redirect()->back()->with('alert', 'deleted');
    }
}
