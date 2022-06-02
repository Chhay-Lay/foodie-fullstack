<?php

namespace App\Http\Controllers;

use App\Models\RatingAndComment;
use Illuminate\Http\Request;

class RatingAndCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|integer',
            'body' => 'required|string',
            'rating_star' => 'required|integer',
        ]);
        RatingAndComment::create([
            // 'user_id' => auth()->user()->id,
            // 'post_id' => $request->post->id,
            // 'body' => $request->body,
            // 'rating_star' => $request->rating_star,

            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
            'body' => $request->body,
            'rating_star' => $request->rating_star,
        ]);

        // return $request;
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
        RatingAndComment::destroy($id);
    }
}
