<?php

namespace App\Http\Controllers;
use App\LogActivity;
use App\Vegetation;
use App\Helpers;
use Illuminate\Http\Request;

class VegetationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($firebase)
    {
        if(Helpers\check($firebase)){
            $vegetations = Vegetation::orderBy('updated_at', 'desc')->get();
            return response()->json($vegetations);
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
            $vegetation = Vegetation::updateOrCreate(
                ['name' => $request->name]
            );
            Helpers\LogActivity::addToLog('Vegetation ' . $request->name . ' has created', $request->firebase, 'fa-sun-o  w3-text-blue');
            return response()->json([
                'message' => 'Vegetation ' . $request->name . ' has created',
                'created' => $vegetation,
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
     * @param  \App\Vegetation  $vegetation
     * @return \Illuminate\Http\Response
     */
    public function show(Vegetation $vegetation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vegetation  $vegetation
     * @return \Illuminate\Http\Response
     */
    public function edit(Vegetation $vegetation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vegetation  $vegetation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vegetation $vegetation)
    {
        if(Helpers\check($request->firebase)) {
            $query = Vegetation::where('id', $vegetation->id);
            $query->update(
                ['name' => $request->name]
            );
            Helpers\LogActivity::addToLog('Vegetation ' . $request->name . ' has updated', $request->firebase, 'fa-sun-o  w3-text-green');
            return response()->json([
                'message' => 'Vegetation ' . $request->name . ' has updated',
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
     * @param  \App\Vegetation  $vegetation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vegetation $vegetation)
    {
        Vegetation::find($vegetation->id)->delete();
        return response()->json([
            'message' => $vegetation->name . ' deleted successfully'
        ]);
    }

    public function deleteData($vegetation, $firebase)
    {
        $data = Vegetation::where('id', $vegetation)->first();
        if(Helpers\check($firebase)){
            $data->delete();
            Helpers\LogActivity::addToLog( $data->name . ' deleted successfully', $firebase, 'fa-sun-o  w3-text-red');
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
