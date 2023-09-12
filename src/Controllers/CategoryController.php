<?php

namespace Uiaciel\Adminblog\Controllers;

use App\Http\Controllers\Controller;
use Uiaciel\Adminblog\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::All();

        return view('admincp::category', [
            'category' => $category
        ]);
    }

    public function store(Request $request)
    {

        Category::create([
            'name'     => $request->name,
            'slug'   => Str::slug($request->name),

        ]);

        return redirect()->route('category.index')
            ->with('success', 'Category created successfully.');
    }

    public function show($slug)
    {
        $cat = Category::where('slug', $slug)->first();


        return view('frontend.category', [
            'cat' => $cat,
        ]);
    }

    public function update(Request $request, $id)
    {

        $post = Category::find($id);
        $post->name = $request->name;
        $post->slug = Str::slug($request->name);
        $post->update();

        return redirect()->route('category.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        //delete post
        $category->delete();

        //redirect to index
        return redirect()->route('category.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
