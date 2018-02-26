<?php

namespace App\Http\Controllers;

use App\Distribution;
use App\Helpers;
use App\User;
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
        $distribution = Distribution::updateOrCreate(
            ['name' => $request->name]
        );

        return response()->json([
            'message' => 'Distribution ' . $request->name . ' has created',
            'created' => $distribution
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
        $query = Distribution::where('id', $distribution->id);
        $query->update(
            ['name' => $request->name]
        );
        return response()->json([
            'message' => 'Distribution ' . $request->name . ' has updated',
            'updated' => $query->first()
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
        Distribution::find($distribution->id)->delete();
        return response()->json([
            'message' => $distribution->name . ' deleted successfully'
        ]);
    }
}
