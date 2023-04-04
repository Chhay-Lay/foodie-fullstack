<?php

namespace App\Http\Controllers;
use DOMDocument;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\RepliedReview;
use App\Models\RatingAndComment;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('is_published', 1)->orderBy('created_at', 'desc')->paginate(5);
        return view('post.index', [
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        $categories = Category::get();
        return view('post.create', [
            'categories' => $categories,
        ]);
    }

    public function draft()
    {
        $categories = Category::get();
        $draft = Post::where('user_id', auth()->user()->id)->where('is_published', 0)->first();
        $ingredients = (json_decode($draft->ingredients));
        return view('post.draft', [
            'categories' => $categories,
            'draft' => $draft,
            'ingredients' => $ingredients
        ]);
    }

    public function edit(Post $post)
    {
        $categories = Category::get();
        $ingredients = (json_decode($post->ingredients));
        return view('post.edit', [
            'categories' => $categories,
            'ingredients' => $ingredients,
            'post' => $post
        ]);
    }

    public function store(Request $request)
    {
        if ($request->input('action') == 'Post') {
            $this->validate($request, [
                'title'=>'required|string',
                'description'=>'required',
                'image'=>'required|image',
                'categories'=>'required',
                'flavours'=>'required|array',
                'ingredients'=>'required|array',
                'ingredients.*.name' => 'required|max:255',
                'ingredients.*.amount' => 'required|max:255',
                'directions'=>'required|string',
            ]);
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() . '-' . $file->getClientOriginalName();
            $imagePath = 'public/images/' . $name;
            Storage::disk('local')->put($imagePath, file_get_contents($file));
            // dd(Storage::disk('local')->url($imagePath));
        }

        $ingredients = $request->ingredients;
        for ($i=0; $i < sizeof($request->ingredients); $i++) { 
            $ingredients[$i] = json_encode($ingredients[$i]);
        }

        $request->user()->posts()->create([
            'title' => $request->title,
            'description' => $request->description,
            'image_url' => isset($imagePath) ? $imagePath : $request->image,
            'video_url' => $request->video_url,
            'category_id' => ($request->input('action') == 'Post') ? array_values((array) $request->categories) : $request->category_id,
            'flavours' => ($request->input('action') == 'Post') ? array_values($request->flavours) : $request->flavours,
            'ingredients' => json_encode($ingredients),
            'directions' => $request->directions,
            'preparation_time' => $request->preparation_time,
            'cooking_time' => $request->cooking_time,
            'is_published' => (($request->input('action') == 'Post') ? 1 : 0),
        ]);

        return redirect()->route('post');
    }

    public function updateDraft(Request $request, Post $draft)
    {
        if ($request->input('action') == 'Post') {
            $this->validate($request, [
                'title'=>'required|string',
                'description'=>'required|string',
                'image'=>'required|image',
                'categories'=>'required|array',
                'flavours'=>'required|array',
                'ingredients'=>'required|array',
                'ingredients.*.name' => 'required|max:255',
                'ingredients.*.amount' => 'required|max:255',
                'directions'=>'required|string',
            ]);
        }
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() . '-' . $file->getClientOriginalName();
            $imagePath = 'public/images/' . $name;
            Storage::disk('local')->put($imagePath, file_get_contents($file));
        } else {
            $imagePath = $draft->image_url;
        }

        $ingredients = $request->ingredients;
        for ($i=0; $i < sizeof($request->ingredients); $i++) { 
            $ingredients[$i] = json_encode($ingredients[$i]);
        }

        $request->user()->posts()->update([
            'title' => $request->title,
            'description' => $request->description,
            'image_url' => $imagePath,
            'video_url' => $request->video_url,
            'category_id' => $request->categories == null ? null : array_values($request->categories),
            'flavours' => $request->flavours == null ? null : array_values($request->flavours),
            'ingredients' => json_encode($ingredients),
            'directions' => $request->directions,
            'preparation_time' => $request->preparation_time,
            'cooking_time' => $request->cooking_time,
            'is_published' => ($request->input('action') == 'Update Draft') ? 0 : 1,
        ]);
        return redirect()->route('post');
    }
        
    public function show(Post $post)
    {
        $ingredients = (json_decode($post->ingredients));

        if ($post->directions) {
            $dom = new DOMDocument;
            $dom->loadHTML($post->directions);
            $nodes = ($dom->getElementsByTagName('p')->length != 0) ?
                    $dom->getElementsByTagName('p') :
                    $dom->getElementsByTagName('li');

            foreach($nodes as $node)
            {
                $directions[] = $dom->saveHTML($node);
            }
        }else{
            $directions = [];
        }
        
        
        $comments = RatingAndComment::where('post_id', $post->id)->orderBy('created_at', 'DESC')->get();
        $replied_comments = RepliedReview::where('post_id', $post->id)->get();


        return view('post.show', [
            'post' => $post,
            'ingredients' => $ingredients,
            'directions' => $directions,
            'comments' => $comments,
            'replied_comments' => $replied_comments,
        ]);
    }

    public function update(Request $request, Post $post)
    {
        if ($request->input('action') == 'Post') {
            $this->validate($request, [
                'title'=>'required|string',
                'description'=>'required|string',
                'categories'=>'required|array',
                'flavours'=>'required|array',
                'ingredients'=>'required|array',
                'ingredients.*.name' => 'required|max:255',
                'ingredients.*.amount' => 'required|max:255',
                'directions'=>'required|string',
            ]);
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() . '-' . $file->getClientOriginalName();
            $imagePath = 'public/images/' . $name;
            Storage::disk('local')->put($imagePath, file_get_contents($file));

            // Remove old image
            if (Storage::disk('local')->exists(public_path($post->image_url))) {
                Storage::disk('local')->delete($post->image_url);
            }
        } else {
            $imagePath = $post->image_url;
        }

        $ingredients = $request->ingredients;
        for ($i=0; $i < sizeof($request->ingredients); $i++) { 
            $ingredients[$i] = json_encode($ingredients[$i]);
        }

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'image_url' => $imagePath,
            'video_url' => $request->video_url,
            'category_id' => ($request->input('action') == 'Post') ? array_values($request->categories) : $request->category_id,
            'flavours' => ($request->input('action') == 'Post') ? array_values($request->flavours) : $request->flavours,
            'ingredients' => json_encode($ingredients),
            'directions' => $request->directions,
            'preparation_time' => $request->preparation_time,
            'cooking_time' => $request->cooking_time,
            'is_published' => ($request->input('action') == 'Post') ? 1 : 0,
        ]);

        return redirect()->route('post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Storage::disk('local')->delete($post->image_url); 
        $post->delete();
        return redirect('/');
    }

    public function showReport(Post $post)
    {
        return view('post.report', [
            'post' => $post
        ]);
    }
}
