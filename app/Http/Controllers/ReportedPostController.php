<?php

namespace App\Http\Controllers;

use App\Models\ReportedPost;
use App\Models\Post;
use Illuminate\Http\Request;

class ReportedPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        return view('post.report', [
            'post' => $post
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post)
    {
        $request->validate([
            'body' => 'required|string'
        ]);

        if(auth()->check()){
            $reported_post = ReportedPost::where('user_id', '=', auth()->user()->id)->where('post_id', $post)->get();
            if ($reported_post->isEmpty()) {
                ReportedPost::create([
                    'user_id' => auth()->user()->id,
                    'post_id' => $post,
                    'body' => $request->body,
                ]);
                return redirect()->route('post')->with('alert', 'Reported Successfully');
            }
        }
        return redirect()->back()->with('alert', 'Reported failed, You have already reported this post');
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
        //
    }
}
