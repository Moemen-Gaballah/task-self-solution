<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\Post;
use App\SubCategory;
class CategoryController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['except' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required|unique:categories|max:255',
            'description' => 'required',
        ));

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->status = $request->status; // Status == default 1 == Active
        $category->user_id = Auth::user()->id;
        $category->save();

        // Set Flash data with success message
        Session::flash('success', 'New Category has been created');
        return redirect('/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        $subcategories = SubCategory::where('category_id', $category->id)->get();
        foreach ($subcategories as $subcategory) {
//            dd($subcategory->id);
            $posts = Post::where('subcategory_id', $subcategory->id)->where('status', 1)->get();
        }
        return view('categories.show', compact('category','posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        dd($request->all());
        $category = Category::find($id);
        if ($request->input('name') == $category->name){
            $this->validate($request, array(
                'description' => 'required',
            ));
        }else{
            $this->validate($request, array(
                'name' => 'required|unique:categories|max:255',
                'description' => 'required',
            ));
        }

        $category->name = $request->name;
        $category->description = $request->description;
        $category->status = $request->status;
        $category->user_id = Auth::user()->id;
        $category->save();

        // Set Flash data with success message
        Session::flash('success', 'this Category was successfully saved.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        Session::flash('success', 'The Category was successfully deleted');
        return redirect()->route('category.index');
    }
}
