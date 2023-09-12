<?php

namespace Uiaciel\Adminblog\Controllers;

use Uiaciel\Adminblog\Models\Image;
use Uiaciel\Adminblog\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('type', 'blog')->orderBy('created_at', 'desc')->get();

        return view('admincp::posts.index', [
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        return view('admincp::posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required',
            'lang' => 'required',
            'status' => 'required',
            'type' => 'required',
            // 'images' => 'required|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $post = new Post;
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->content = $request->content;

        $post->excerpt = Str::of(strip_tags($request->content))->words(30, ' ....');


        $post->lang = $request->lang;
        $post->layout = $request->layout;
        $post->id_category = $request->id_category;
        $post->date = $request->date;
        $post->status = $request->status;
        $post->type = $request->type;
        $post->save();

        if ($request->hasFile('images')) {
            $image = new Image;
            $originName = $request->file('images')->getClientOriginalName();
            $slugName = str_replace(' ', '_', $originName);
            $fileName = time() . '_' . $slugName;

            $path = $request->file('images')->storeAs('uploads', $fileName, ['disk' => 'public']);
            $image->path = $path;
            $image->post_id = $post->id;
            $image->save();
        }

        // if ($request->hasFile('files')) {
        //     foreach ($request->file('files') as $docfile) {

        //         $originName = $docfile->getClientOriginalName();
        //         $slugName = str_replace(' ', '_', $originName);

        //         $size = $docfile->getSize();

        //         $fileName = time() . '_' . $slugName;
        //         $docfile->move(public_path() . '/storage/files/', $fileName);

        //         $url = 'public/files/' . $fileName;



        //         $doc = new Doc;
        //         $doc->path = $url;
        //         $doc->name = $originName;
        //         $doc->filesize = $size;
        //         $doc->post_id = $post->id;
        //         $doc->save();
        //     }
        // }

        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully.');
    }

    public function show(Post $post)
    {
        return view('admincp::posts.show', compact('post'));
    }

    public function edit(Post $post)
    {

        return view('admincp::posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'layout' => 'required'

        ]);



        $post = Post::find($id);
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->content = $request->content;
        $post->excerpt = $request->excerpt;
        $post->lang = $request->lang;
        $post->id_category = $request->id_category;
        $post->date = $request->date;
        $post->status = $request->status;
        $post->type = $request->type;
        $post->layout = $request->layout;
        $post->update();

        if ($request->hasFile('images')) {

            $originName = $request->file('images')->getClientOriginalName();
            $slugName = str_replace(' ', '_', $originName);
            $fileName = time() . '_' . $slugName;

            $path = $request->file('images')->storeAs('uploads', $fileName, ['disk' => 'public']);

            $image = new Image;
            $image->path = $path;
            $image->post_id = $id;
            $image->save();
        }

        // if ($request->hasFile('files')) {
        //     foreach ($request->file('files') as $docfile) {


        //         $nama = time() . '-' . $docfile->getClientOriginalName();

        //         // $ext = $docfile->getClientOriginalExtension();
        //         $size = $docfile->getSize();
        //         // $mime = $docfile->getMimeType();

        //         $doc = new Doc;
        //         $docpath = Storage::putFileAs('files', $docfile, $nama, ['disk' => 'public']);
        //         $doc->path = $docpath;
        //         $doc->name = $nama;
        //         $doc->filesize = $size;
        //         $doc->post_id = $id;
        //         $doc->save();
        //     }
        // }

        return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        //delete post
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Data Berhasil Dihapus!');
    }

    // public function showpost($slug)
    // {
    //     $post = Post::with('category')->where('slug', $slug)->where('type', 'Blog')->first();
    //     $other = Post::with('category')->where('type', 'Blog')->inRandomOrder()->limit(4)->get();


    //     return view('frontend.artikel', [
    //         'post' => $post,
    //         'others' => $other,
    //     ]);
    // }
}
