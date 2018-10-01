<?php

namespace App\Http\Controllers;

use App\Post;
use App\SubCategory;
use App\Category;
use Illuminate\Http\Request;
use Auth;
use Session;

class SubCategoryController extends Controller
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
        $categories = SubCategory::all();

        return view('subcategories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status',1)->get();
        return view('subcategories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//                dd($request->all());
        $this->validate($request, array(
            'name' => 'required|unique:sub_categories|max:255',
            'description' => 'required',
            'status' => 'required',
            'category' => 'required',

        ));

        $category = new SubCategory();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->category_id = $request->category;
        $category->status = $request->status; // Status == default 1 == Active
        $category->user_id = Auth::user()->id;
        $category->save();

        // Set Flash data with success message
        Session::flash('success', 'New SubCategory has been created');
        return redirect('/subcategory');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subcategory = SubCategory::findOrFail($id);

        $posts = Post::where('subcategory_id', $subcategory->id)->where('status', 1)->get();
        $subcategory = SubCategory::findOrFail($id);
        return view('subcategories.show', compact('subcategory', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $categories = Category::all();
        $subcategory = SubCategory::find($id);
        return view('subcategories.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        dd($request->all());
        $category = SubCategory::find($id);
        if ($request->input('name') == $category->name){
            $this->validate($request, array(
                'description' => 'required',
                'status' => 'required',
                'category' => 'required',
            ));
        }else{
            $this->validate($request, array(
                'name' => 'required|unique:categories|max:255',
                'description' => 'required',
                'status' => 'required',
                'category' => 'required',
            ));
        }

        $category->name = $request->name;
        $category->description = $request->description;
        $category->status = $request->status;
        $category->user_id = Auth::user()->id;
        $category->save();

        // Set Flash data with success message
        Session::flash('success', 'this SubCategory was successfully saved.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = SubCategory::find($id);
        $category->delete();

        Session::flash('success', 'The SubCategory was successfully deleted');
        return redirect()->route('subcategory.index');
    }
}
