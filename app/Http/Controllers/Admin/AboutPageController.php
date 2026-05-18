<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use App\Models\Translation;
use Illuminate\Http\Request;

class AboutPageController extends Controller
{
    public function edit()
    {
        $about = AboutPage::first();

        $locales = Translation::where('status', 1)->get();

        return view('admin.about-page.edit', compact('about', 'locales'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|array',
            'sub_title' => 'nullable|array',
            'text' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'nullable|in:0,1',
        ]);

        $about = AboutPage::first();

        if (!$about) {
            $about = new AboutPage();
        }

        $about->title = $request->title;
        $about->sub_title = $request->sub_title;
        $about->text = $request->text;
        $about->status = $request->status ?? 1;

        if ($request->hasFile('image')) {
            if (!empty($about->image) && file_exists(public_path('uploads/about/'.$about->image))) {
                unlink(public_path('uploads/about/'.$about->image));
            }

            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/about'), $imageName);

            $about->image = $imageName;
        }

        $about->save();

        return redirect()->back()->with('success', 'About məlumatları yeniləndi');
    }
}
