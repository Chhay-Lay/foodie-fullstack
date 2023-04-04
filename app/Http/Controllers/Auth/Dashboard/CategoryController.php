<?php

namespace App\Http\Controllers\Auth\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::get();
        return view('dashboard.category.index', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return view('dashboard.category.create');
    }

    public function edit(Category $category)
    {
        return view('dashboard.category.edit', [
            'category' => $category
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'section' => 'required|unique:categories,section|max:100',
        ]);

        Category::create([
            'section' => $request->section
        ]);

        return redirect()->route('dashboard.category')->with('message', 'Category has been added successfully!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $section = $this->validate($request, [
            'section' => 'required|unique:categories,section|max:100'
        ]);

        $category->update($section);

        return redirect()->route('dashboard.category')->with('message', 'Category has been updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $post = DB::table('posts')->whereJsonContains('category_id', $id)->first();
        
        if($post){
            return back()->withErrors('Cannot delete category when post exist!');
        } 

        Category::destroy($id);
        return back();
    }
}
