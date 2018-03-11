<?php

namespace App\Http\Controllers;

use App\Category;
use App\LogActivity;
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
        if(Helpers\check($request->firebase)){
            $Category = Category::updateOrCreate(
                ['name' => $request->name]
            );
            Helpers\LogActivity::addToLog('Category ' . $request->name . ' has created', $request->firebase, 'fa-tags  w3-text-blue');
            return response()->json([
                'message' => 'Category ' . $request->name . ' has created',
                'created' => $Category,
                'activity' =>  LogActivity::orderBy('updated_at', 'desc')->paginate(7)
            ]);
        }
        return response()->json([
            'message' => 'not authorize',
            'updated' => ''
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
        if(Helpers\check($request->firebase)){
            $query = Category::where('id', $category->id);
            $query->update(
                ['name' => $request->name]
            );
            Helpers\LogActivity::addToLog('Category ' . $request->name . ' has updated', $request->firebase, 'fa-tags  w3-text-green');
            return response()->json([
                'message' => 'Category ' . $request->name . ' has updated',
                'updated' => $query->first(),
                'activity' =>  LogActivity::orderBy('updated_at', 'desc')->paginate(7)
            ]);
        }
        return response()->json([
            'message' => 'not authorize',
            'updated' => ''
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

    }
    public function deleteData($category, $firebase)
    {
        $data = Category::where('id', $category)->first();
        if(Helpers\check($firebase)){
            $data->delete();
            Helpers\LogActivity::addToLog( $data->name . ' deleted successfully', $firebase, 'fa-tags  w3-text-red');
            return response()->json([
                'message' => $data->name . ' deleted successfully',
                'activity' =>  LogActivity::orderBy('updated_at', 'desc')->paginate(7)
            ]);
        }
        return response()->json([
            'message' => 'not authorize',
            'updated' => ''
        ]);
    }
}
