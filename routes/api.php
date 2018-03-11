<?php

use Illuminate\Http\Request;
use App\Helpers;
use App\Notifications\SendToResearcher;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('login', 'LoginController@login');
//updateRepository
Route::get('researcher/{firebase}/{id}', function ($firebase, $id){

//    return

    if(Helpers\check($firebase)){
        $repository = \App\Repository::where('id', $id)->first();
        \App\User::where('role_id', 3)->chunk(100, function ($users) use($repository) {
            foreach ($users as $user) {
                $user->notify(new SendToResearcher($repository));
            }
        });
    }
    return response()->json();
});
Route::get('repository/admin/delete/{repository}/{firebase}', 'RepositoryController@adminDestroy');
Route::put('repository/admin/update/{firebase}', 'RepositoryController@updateRepository');
Route::post('repository/create/{firebase}', 'RepositoryController@createRepository');
Route::get('repository/signout', 'RepositoryController@logout');
Route::get('repository/{firebase}', 'RepositoryController@index');
Route::post('repository/{repository}/{firebase}', 'RepositoryController@destroy');


Route::post('user/check', function (Request $request) {
    $user = \App\User::where('name', $request->name)->first();
    return response()->json($user['email']);
});

Route::get('user/admin/chat', 'UserController@adminChat');
Route::get('user/{firebase}', 'UserController@index');
Route::get('user/firebase/{firebase}', 'UserController@show');
Route::get('user/{user}/{uid}/{firebase}', 'UserController@destroy');
Route::put('user/{user}/update/{firebase}', 'UserController@updateUser');



Route::delete('vegetation/{vegetation}/{firebase}', 'VegetationController@deleteData');
Route::delete('family/{family}/{firebase}', 'FamilyController@deleteData');
Route::delete('distribution/{distribution}/{firebase}', 'DistributionController@deleteData');
Route::delete('category/{category}/{firebase}', 'CategoryController@deleteData');


Route::get('vegetation/{firebase}', 'VegetationController@index');
Route::get('family/{firebase}', 'FamilyController@index');
Route::get('distribution/{firebase}', 'DistributionController@index');
Route::get('category/{firebase}', 'CategoryController@index');

Route::apiResource('feedback', 'FeedbackController');
Route::apiResource('vegetation', 'VegetationController');
Route::apiResource('family', 'FamilyController');
Route::apiResource('distribution', 'DistributionController');
Route::apiResource('category', 'CategoryController');

Route::apiResource('repository', 'RepositoryController');

Route::apiResource('user', 'UserController');
