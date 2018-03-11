<?php

namespace App\Http\Controllers;

use App\Distribution;
use App\Helpers;
use App\User;
use App\LogActivity;
use Illuminate\Http\Request;

class DistributionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($firebase)
    {

        if(Helpers\check($firebase)){
            $distribution = Distribution::orderBy('updated_at', 'desc')->get();
            return response()->json($distribution);
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
            $distribution = Distribution::updateOrCreate(
                ['name' => $request->name]
            );
            Helpers\LogActivity::addToLog('Distribution ' . $request->name . ' has created', $request->firebase, 'fa-tree  w3-text-blue');
            return response()->json([
                'message' => 'Distribution ' . $request->name . ' has created',
                'created' => $distribution,
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
     * @param  \App\Distribution  $distribution
     * @return \Illuminate\Http\Response
     */
    public function show(Distribution $distribution)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Distribution  $distribution
     * @return \Illuminate\Http\Response
     */
    public function edit(Distribution $distribution)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Distribution  $distribution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Distribution $distribution)
    {
        if(Helpers\check($request->firebase)){

            $query = Distribution::where('id', $distribution->id);
            $query->update(
                ['name' => $request->name]
            );
            Helpers\LogActivity::addToLog('Distribution ' . $request->name . ' has updated', $request->firebase, 'fa-tree  w3-text-green');
            return response()->json([
                'message' => 'Distribution ' . $request->name . ' has updated',
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
     * @param  \App\Distribution  $distribution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Distribution $distribution)
    {
        /*Distribution::find($distribution->id)->delete();
        return response()->json([
            'message' => $distribution->name . ' deleted successfully'
        ]);*/
    }
    public function deleteData($distribution, $firebase)
    {
        $data = Distribution::where('id', $distribution)->first();
        if(Helpers\check($firebase)){
            $data->delete();
            Helpers\LogActivity::addToLog( $data->name . ' deleted successfully', $firebase, 'fa-tree  w3-text-red');
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
