<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::all();
        return view('admin.categories.categories', ['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.categories.create-category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $request->validate(
            [
                "name"=>"required"
            ],
            ["name.requried"=>"Enter Category name"]
            );
            Category::create($request->except('_token'));
            return redirect()->route('categories.index')->with('success','Category is successfully added');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //

        return view('admin.categories.edit-category',['category'=>$category]);



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

        $request->validate(
            [
                "name"=>"required"
            ],
            ["name.requried"=>"Enter Category name"]
            );
            
            $category=Category::find($id);
            $category->name=$request->input('name');
            $category->save();

            return redirect()->route('categories.index')->with('success','Category is successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        //
        $category = Category::find($id);

        try{
            $category->delete();
        }
        catch(QueryException $e){

            return redirect()->route('categories.index')->with(["success"=>"Category can't be deleted ."]);

        }
       
        return redirect()->route('categories.index')->with(["success"=>"Category is successfully deleted."]);

    }
}
