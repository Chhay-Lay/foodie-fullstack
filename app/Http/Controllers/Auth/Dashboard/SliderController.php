<?php

namespace App\Http\Controllers\Auth\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function index()
    {
        $slides = Slider::paginate(5);
        return view('dashboard.slider.index', [
            'slides' => $slides,
        ]);
    }

    public function create()
    {
        return view('dashboard.slider.create');
    }

    public function edit(Slider $slide)
    {
        return view('dashboard.slider.edit', [
            'slide' => $slide
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'image' => 'required|image',
            'status' => 'required'
        ]);

        $slide = new Slider;
        $slide->title = $request->title;
        if($request->file('image')){
            $file= $request->file('image');
            $filename = time() . '-' . $file->getClientOriginalName();
            $request->image->storeAs('slides', $filename, 'public');
            $slide->image = $filename;
        }
        $slide->status = $request->status === 'active' ? 1 : 0;
        $slide->save();

        return redirect()->route('dashboard.slider')->with('message', 'Slide has been added successfully!');
    }

    public function update(Request $request, Slider $slide)
    {
        // dd($request);
        $this->validate($request, [
            'title' => 'required|max:255',
            'status' => 'required'
        ]);

        if($request->file('image')){
            $file= $request->file('image');
            $filename = time() . '-' . $file->getClientOriginalName();
            $request->image->storeAs('slides', $filename, 'public');

            if (File::exists(public_path('Images/'.$slide->image))) {
                File::delete(public_path('Images/'.$slide->image));
            }

            $slide->image = $filename;
        }

        $slide->title = $request->title;
        $slide->status = $request->status;
        $slide->save();
        return redirect()->route('dashboard.slider')->with('message', 'Slide has been updated successfully!');
    }

    public function destroy(Slider $slider)
    {
        if (File::exists(public_path('Images/'.$slider->image))) {
            File::delete(public_path('Images/'.$slider->image));
        }
        $slider->delete();
        return back();
    }
}
