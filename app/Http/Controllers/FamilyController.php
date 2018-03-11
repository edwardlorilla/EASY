<?php

namespace App\Http\Controllers;
use App\LogActivity;
use App\Family;
use App\Helpers;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($firebase)
    {
        if(Helpers\check($firebase)){
            $family = Family::orderBy('updated_at', 'desc')->get();
            return response()->json($family);
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
            $Family = Family::updateOrCreate(
                ['name' => $request->name]
            );
            Helpers\LogActivity::addToLog('Distribution ' . $request->name . ' has created', $request->firebase, 'w3-text-blue fa-pagelines');
            return response()->json([
                'message' => 'Family ' . $request->name . ' has created',
                'created' => $Family,
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
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function edit(Family $family)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Family $family)
    {
        if(Helpers\check($request->firebase)){

            $query = Family::where('id', $family->id);
            $query->update(
                ['name' => $request->name]
            );
            Helpers\LogActivity::addToLog( 'Distribution ' . $request->name . ' has updated', $request->firebase, ' w3-text-green fa-pagelines');
            return response()->json([
                'message' => 'Family ' . $request->name . ' has updated',
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
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family)
    {

            Family::find($family->id)->delete();
            return response()->json([
                'message' => $family-> name . ' deleted successfully'
            ]);
    }
    public function deleteData($family, $firebase)
    {
        $data = Family::where('id', $family)->first();
        if(Helpers\check($firebase)){
            $data->delete();
            Helpers\LogActivity::addToLog( $data->name . ' deleted successfully', $firebase, 'fa-pagelines  w3-text-red');
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
