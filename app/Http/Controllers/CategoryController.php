<?php

namespace App\Http\Controllers;

use App\Category;
use App\Helpers;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($firebase)
    {
        
        if(Helpers\check($firebase)){
            $categories = Category::orderBy('updated_at', 'desc')->get();
            return response()->json($categories);
        }else{
            return response()->json([]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Category = Category::updateOrCreate(
            ['name' => $request->name]
        );

        return response()->json([
            'message' => 'Category ' . $request->name . ' has created',
            'created' => $Category
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $query = Category::where('id', $category->id);
        $query->update(
            ['name' => $request->name]
        );
        return response()->json([
            'message' => 'Category ' . $request->name . ' has updated',
            'updated' => $query->first()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Category::find($category->id)->delete();
        return response()->json([
            'message' => $category-> name . ' deleted successfully'
        ]);
    }
}
