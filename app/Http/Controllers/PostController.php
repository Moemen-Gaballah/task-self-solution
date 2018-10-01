<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Auth;
use Session;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['except' => ['except']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $categories = Category::all();
        return view('posts.index', compact(['posts', 'categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', '1')->get();
        return view('posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//         dd($request->all());
        $this->validate($request, array(
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
            'category' => 'required|integer',
            'subcategory' => 'required|integer',
            'status' => 'required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
        ));

        // Store in the database
        $post = new Post;

        $post->title = $request->title;
        $post->body = $request->body;
        $post->subcategory_id = $request->subcategory;
        $post->user_id = Auth::user()->id;
        $post->status = $request->status;

        // Save Our Image
        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('/img');
            $post->image = $filename;
            $image->move($location, $filename);
        }

        $post->save();

        Session::flash('success', 'The post was successfully Save!');
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::where('status', 1)->get();
        $post = Post::find($id);
        return view('posts.edit', compact('post','categories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if ($request->input('title') == $post->title) {
            $this->validate($request, array(
                'body' => 'required',
                'category_id' => 'required|integer',
                'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            ));
        }else {
            $this->validate($request, array(
                'title' => 'required|max:255|unique:posts',
                'body' => 'required',
                'category_id' => 'required|integer',
                'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            ));
        }
        // Save the data to the database
        $post->title = $request->title;
        $post->body = $request->body;
        $post->subcategory_id = $request->subcategory;
        $post->status = $request->status;

        if ($request->hasFile('image')) {
            // Add the new Photo
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('/img');

            $image->move($location, $filename);

            // Delete Old Photo
            $oldPhotoName = $post->image;

            // Update The database
            $post->image = $filename;

            //Delete the old Photo
            File::delete('img/'.$oldPhotoName);
        }
        $post->save();

        // Set Flash data with success message
        Session::flash('success', 'This Post was successfully Saved.');

        // redirect with flash data to posts.show
        return redirect()->route('post.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        unlink(public_path() . '/img/' . $post->image);
        $post->delete();

        Session::flash('success', 'The Post was successfully deleted');
        return redirect('/');
    }
}
