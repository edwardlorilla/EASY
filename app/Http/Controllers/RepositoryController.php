<?php

namespace App\Http\Controllers;

use App\Repository;
use App\User;
use App\Mail\IdentifiedPlant;
use App\Helpers;
use Notification;
use App\Notifications\SharedIdentity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Image;

class RepositoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //createRepository -> repository/create/{firebase}


    public function index($firebase)
    {

        /*$values = [["Anis", "001", "+88017300112233"]];
        $result = $service->spreadsheets_values->append(SHEET_ID, 'A1:C1', $body, $options);*/
//dd(\App\User::with('repositories.photos', 'repositories.color', 'repositories.distribution', 'repositories.category', 'repositories.family', 'repositories.repository', 'repositories.vegetations')->where('firebase_uid', $firebase)->first());


        $user= Cache::rememberForever('user_repository:all', function () use ($firebase) {
            return \App\User::with('repositories.photos', 'repositories.color', 'repositories.distribution', 'repositories.category', 'repositories.family', 'repositories.repository', 'repositories.vegetations')->where('firebase_uid', $firebase)->first()['repositories'];

        });
        $repositories = \App\Repository::with(['photos' => function ($query) {
            $query->orderBy('updated_at', 'desc');
        }, 'distribution', 'color', 'repository', 'category', 'family', 'vegetations', 'user', 'repositories']);
        $merge = [];
        if ($this->check($firebase)) {
            $repositories
                ->chunk(100, function($repositories) use ($merge){
                    foreach((array)$repositories as $chunk)
                    {
                        $merge[] =  $chunk;
                    }
                });
        } else {
            $repositories
                ->where('published', 1)
                ->chunk(100, function($repositories) use ($merge){
                    foreach((array)$repositories as $chunk)
                    {
                        $merge[] =  $chunk;
                    }
                });
        }

        $repository_user = $user->merge($merge);
//        return response()->json($repositories);


        return response()->json($repository_user);
    }

    /**
     * Show the form for creating a new \resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function check($firebase)
    {
        return 2 === \App\User::where('firebase_uid', $firebase)->first()->role_id;
    }

    public function createRepository(Request $request, $firebase)
    {
        if ($this->check($firebase)) {
            $location = $request->location;
            $repositoryInfo = $request->repositoryInfo;
            $selected = $request->selected;
            $user = \App\User::where('firebase_uid', $firebase)->first();

            //photo
            $imageData = $request->image;
            $color = $request->colors ? \App\Color::create([
                'colors' => $request->colors
            ]) : null;
            $repository = new Repository([
                'family_id' => $selected['family'],
                'distribution_id' => $selected['distribution'],
                'category_id' => $selected['category'],
                'color_id' => $color ? $color->id : null,
                'commonName' => $repositoryInfo['commonName'],
                'description' => $repositoryInfo['description'],
                'scientificName' => $repositoryInfo['scientificName'],
                'specie' => $repositoryInfo['species'],
                'title' => $repositoryInfo['title'],
                'economicImportance' => $repositoryInfo['economicImportance'],
                'estimatedDensity' => $selected['density'],
                'latitude' => $location['latitude'],
                'altitude' => $location['altitude'],
                'longitude' => $location['longitude'],
                'published' => $repositoryInfo['published']
            ]);
            $repositories = $user->repositories()->save($repository);
            $repositories->vegetations()->attach($selected['vegetation']);
            if ($imageData) {
                $fileName = uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                $img = Image::make($request->image);

                $img->save(public_path('images/') . $fileName);
                $img->resize(60, 60, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('images/thumb_') . $fileName);
                $photo = \App\Photo::create(['file' => $fileName]);
                $repositories->photos()->attach($photo->id);
            }


            /*
             * */


        }
        $repository_ = \App\Repository::with(['distribution', 'photos', 'color', 'repository', 'category', 'family', 'vegetations', 'user'])
            ->where('id', $repository->id)->first();
        Cache::forget('user_repository:all');


        $client = new \Google_Client();
        $client->setApplicationName('My PHP App');
        $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
        $client->setAccessType('offline');
        ///$jsonAuth = __DIR__ . '/client_secret_258477361482-t8iual52kk2p6qqjvm98cibonn9as7gj.apps.googleusercontent.com.json';
        $client->setAuthConfig(json_decode('{
                                              "type": "service_account",
                                              "project_id": "repositories-d0a35",
                                              "private_key_id": "4375f2708d4ccb04ff545ac9b96f5562db4934de",
                                              "private_key": "-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQDawzqfipM+3Ucf\nLTzPp66EfJmkfakM6i+hg2cK3yj8hr22PlUFIkPib4O4//IkVl+1aNq/X/c6AcBu\nEdIKiXKYxEF52n9RA30icRTS1aEHPjhVTK/ycF1mhYwb+2DbEWahew9pWyPh1Zfw\nefmWW2IOVX8HKZO9ms3Y6cYvGNjTV1o+wft1WR7Fu83TjTezQpHWjA9YaPYfqQ5A\nzRInTAiOVq4km+7aKH0Abt6c3T4KA0SwJc0DZ8f/XkektsCnQavphbSRIRPxkkAs\nyUxX2q8xVBK77SEdnino5TkmMBB2D+bdTMZQ8bGYsgnSFDDgNbLu0uoN/mO5OfeJ\nUjfc3wU9AgMBAAECggEADgsARWOQ5jUwLpkp0S6zbj/NYRjL9E9INXcI81K1/9fq\nb7t6m7TCZNPBwet0MM72n9+WQzi21xtrreUo9ZIzMAlRJrBXAe1WaBKYQpyCFMPy\nu88LcGW0KTOjddxiME3ip7UNnTbDi+i5My+xTOya0867M8uAd2hrlGQVW8qdiJtx\nhOBPVAinH77ZzejalN7epiCF3gA5F5IjwTMnmBoTNlo4MhwzQEZWxQYs2R5Q0zA9\nUFqV22ys215QP1GDBMhoVusDOGA+SjM9uqF37qrfXNgNJja2dhYZCxNXGisXjF36\n/DC/JOU0SpuL4sVrewIBpHKiXBRJ/fJdD/EtDqzgwQKBgQDxqu7z7BVkmLLQjklu\nWNSsvp3OoNxTl/ZOQbRFMFg0ukr2g4cEdsXxI6K2QzODLPtRTOznbLLLs1GEN4C2\nAnesyH8JSCy4mnVEpUjCBaJbyhYNPuoeYabZzMepK7PtusXkHuWgSj2svIAqWXOW\nf1NN1CsNro2KC/jFvmwRcdx9DQKBgQDnvItGEe/dcfsU9Mee5WKqrT+cYzRVoILm\nvOWEDLJFl/Wn6NybQMkja46lI0CVOhF5SNGuRkpbhrMnPp0p16Jvn2RfA9xHuCNg\nTmlxi+sqOXUH95LxZ2j5giOi/m2rnkq4MOFBjXeFkkVQsg1UEc8v9B7Ge+EtRYsB\nlHvX7ed88QKBgQDmRfkgpbEQxMuGHD5uDejAnXUjAXZPlPoWQVczokg6HdT2JgfO\nQhqElm8hetEnygHCyyjlr1aC8N/Yu0ZCqAE+u2EJCCPM1yise03jypiVG+99OZi9\n0FC7MfyB/umYuaJ8ptAotvUjlg4NzGRuX+6Rt3w6sjud8aBfU/4HdVYiNQKBgB6t\nkzJ/hWWnhTnM/fBHJby6msU1TORZD3tEXo4QsDkOWPMVnL7g4L/TqVqrRA19Vnrb\n7QZJP+bF+kmjvGKhrVthmoQJmsvT0LsbJlJl14gLezbGy6kxq2/8joMxc4tYtUOV\nFPz8oWoJZyu7ppAOm4MZqklUdQbtQe2/nnWDhTXBAoGBAJCvqGMDZZiD1wValrKe\ncOh4AzuNY2hmle7fhceMQJdMaVK8dX+VxyX5oPiRMtl+91dyTiu7qZD+od/j39pl\ni4ezAVlODz4Xe/RDDI0L3gEI3fsZfUSpGYcN7SV/4EFwA3s6c0+BMi/2GRy0tDk3\nwF/zoi91fsO8JPigkxf3oqR8\n-----END PRIVATE KEY-----\n",
                                              "client_email": "hagorepositories@repositories-d0a35.iam.gserviceaccount.com",
                                              "client_id": "109398237544146505145",
                                              "auth_uri": "https://accounts.google.com/o/oauth2/auth",
                                              "token_uri": "https://accounts.google.com/o/oauth2/token",
                                              "auth_provider_x509_cert_url": "https://www.googleapis.com/oauth2/v1/certs",
                                              "client_x509_cert_url": "https://www.googleapis.com/robot/v1/metadata/x509/hagorepositories%40repositories-d0a35.iam.gserviceaccount.com"
                                            }', true));
        $sheets = new \Google_Service_Sheets($client);
        //1KhAmeXNOaNOCVA80L2IyNwZ5bbV_GGVI3FrPArReej4 <-sheet_id
        $spreadsheetId = '1KhAmeXNOaNOCVA80L2IyNwZ5bbV_GGVI3FrPArReej4';
        //$range = 'A2:H';
        try {
            /*$options = array('valueInputOption' => 'RAW');
            $values = [
                [
                    $repositoryInfo['title'],
                    $repositoryInfo['description'],
                    $repositoryInfo['species'],
                    $repositoryInfo['scientificName'],
                    $repositoryInfo['commonName'],
                    $repositoryInfo['economicImportance'],
                    $location['latitude'],
                    $location['longitude'],
                    $location['altitude'],
                    date("F j, Y, g:i a")

                ]
            ];
            $body = new \Google_Service_Sheets_ValueRange(['values' => $values]);

            $result = $sheets->spreadsheets_values->append($spreadsheetId, 'A1:A20', $body, $options);*/
        } catch (Exception $e) {

        }


        return response()->json($repository_);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return response()->json($request->all());
        $user = \App\User::where('firebase_uid', $request->firebase)->first();


        $imageData = $request->photos;
        $fileName = uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
        $img = Image::make($request->photos);

        $img->save(public_path('images/') . $fileName);
        $img->resize(60, 60, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('images/thumb_') . $fileName);
        $photo = \App\Photo::create(['file' => $fileName]);

        $color = $request->colors ? \App\Color::create([
            'colors' => $request->colors
        ]) : null;
        $repositoryID = '';
        $repository_id = '';
        if (!is_string((int)$request->repository_id)) {
            $repositoryID = $request->repository_id;
            $repository_id = \App\Repository::find($repositoryID);
        }
        $repository = new \App\Repository([
            'title' => $request->title,
            'shared' => $request->shared,
            'description' => $request->description,
            'latitude' => $request->latitude,
            'altitude' => $request->altitude,
            'longitude' => $request->longitude,
            'color_id' => $color->id,
            'repository_id' => $repositoryID === 'null' ? null : $repositoryID
        ]);
        $user->repositories()->save($repository)->photos()->attach($photo->id);
        Cache::forget('user_repository:all');
        //change response to
        /*$repository_ = \App\Repository::with('distribution','photos', 'color', 'repository', 'category', 'family', 'vegetations')
            ->where('id',  $repository->id)->first();*/
        $repository_ = \App\Repository::with(['distribution', 'photos' => function ($query) {
            $query->orderBy('updated_at', 'desc');
        }, 'color', 'repository', 'category', 'family', 'vegetations', 'user'])
            ->where('id', $repository->id)->first();
        try {
            Helpers\LogActivity::addToLog('Repository has successfully share ', $request->firebase, 'fa-leaf  w3-text-blue');
        } catch (Exception $e) {

        }
        return response()->json($repository_);


        /*


        if ($files =$request->file('photos')) {
            $destinationPath = public_path('thumbnail/');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 666, true);
            }
            $name = time() . $files->getClientOriginalName();
            $img = Image::make($files->getRealPath())->resize(60, 60, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.$name);
            $files->move('images', $name);

            $photo = \App\Photo::create(['file' => $name]);
        }
        $color = \App\Color::create([
            'colors' => $request->colors
        ]);
        $repositoryID = '';
        if(!is_string((int)$request->repository_id)) {
            $repositoryID = $request->repository_id;
        }
        $repository = new \App\Repository([
            'title' => $request->title,
            'description' => $request->description,
            'latitude' => $request->latitude,
            'altitude' => $request->altitude,
            'longitude' => $request->longitude,
            'color_id' => $color->id,
            'repository_id' => $repositoryID === 'null' ? null : $repositoryID
        ]);

        $user->repositories()->save($repository)->photos()->attach($photo->id);
        Cache::forget('repositories:all');*/
//        die(var_dump($request->name));

        /* $this->validate($request, [
             'title' => 'required|max:100',
             'body' => 'required'
         ]);
         $article = new Article;
         $article->title = $request->title;
         $article->body = $request->body;
         $article->save();
         Cache::forget('article:all');
         return response()->json($repository);*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Repository $repository
     * @return \Illuminate\Http\Response
     */
    public function show(Repository $repository)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Repository $repository
     * @return \Illuminate\Http\Response
     */
    public function edit(Repository $repository)
    {
        return $repository;
        /*$repository_ = \App\Repository::with(['distribution', 'photos' => function ($query) {
            $query->orderBy('updated_at', 'desc');
        }, 'color', 'repository', 'category', 'family', 'vegetations'])
            ->where('id', $repository->id)->first();
        Helpers\LogActivity::addToLog($request->title, $firebase, 'fa-leaf  w3-text-blue');
        return response()->json($repository_);*/
    }

    public function updateRepository(Request $request, $firebase)
    {
        if ($this->check($firebase)) {
            $user = \App\User::where('id', $request->user_id)->first();
            $updateRepository = [
                'title' => $request->title,
                'economicImportance' => $request->economicImportance,
                'description' => $request->description,
                'specie' => $request->species,
                'commonName' => $request->commonName,
                'scientificName' => $request->scientificName,
                'latitude' => $request->latitude,
                'repository_id' => $request->repository_id,
                'longitude' => $request->longitude,
                'altitude' => $request->altitude,
                'estimatedDensity' => $request->estimatedDensity,
                'family_id' => $request->family,
                'category_id' => $request->category,
                'distribution_id' => $request->distribution,
                'identified' => $request->identified
            ];
            $repository = $user->repositories()->where('id', $request->id)->first();
            $repository->update($updateRepository);
            $repository->vegetations()->sync($request->vegetation);
            if (!empty($imageData = $request->images)) {
                $fileName = uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                $img = Image::make($request->images);

                $img->save(public_path('images/') . $fileName);
                $img->resize(60, 60, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('images/thumb_') . $fileName);
                $photo = \App\Photo::create(['file' => $fileName]);
                $repository->photos()->attach($photo->id);
            }
            $repository_json = \App\Repository::with(['distribution', 'photos' => function ($query) {
                $query->orderBy('updated_at', 'desc');
            }, 'color', 'repository', 'category', 'family', 'vegetations', 'user'])
                ->where('id', $repository->id)->first();
            try {

                Helpers\LogActivity::addToLog('Repository has successfully updated ', $firebase, 'fa-leaf  w3-text-green');
            } catch (Exception $e) {

            }
        }
        try {
            if($repository->shared === 1){
                $user->notify(new SharedIdentity($repository_json));
            }
            //\App\Notification::route('mail', )
            //\Mail::to($user)->send(new IdentifiedPlant);
        } catch (Exception $e) {

        }

        Cache::forget('user_repository:all');
        return response()->json($repository_json);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Repository $repository
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Repository $repository)
    {
        $repository->title = $request->title;
        $repository->description = $request->description;
        $repository->save();
        Cache::forget('user_repository:' . $repository->id);
        Cache::forget('user_repository:all');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Repository $repository
     * @return \Illuminate\Http\Response
     */
    public function destroy(Repository $repository, $firebase)
    {
        $user_repository = \App\User::with(['repositories' => function ($query) use ($repository) {
            $query->where('id', $repository->id)->first()->delete();
            Cache::forget('user_repository:' . $repository->id);
            Cache::forget('user_repository:all');
        }])->where('firebase_uid', $firebase)->first();

        return response()->json('Deleted Sucessfully!');
    }

    public function adminDestroy($repositories, $firebase)
    {
        if ($this->check($firebase)) {
            $repository = \App\Repository::with('photos')->where('id', $repositories)->first();
            $repository->delete();
            if (!(empty($repository->photos))) {
                for ($x = 0; $x < count($repository); $x++) {
                    unlink(public_path() . "/images/" . $repository->photos[$x]->file);
                    unlink(public_path() . "/images/thumb_" . $repository->photos[$x]->file);
                }
            }


            Cache::forget('user_repository:' . $repositories);
            Cache::forget('user_repository:all');
        }

        return $repository;
    }

    public function getPhoto(Request $user_repository)
    {
        $photo = new \App\Photo();
        if ($file = $request->photos) {
            list($type, $imageData) = explode(';', $request->photos);
            list(, $extension) = explode('/', $type);
            list(, $imageData) = explode(',', $imageData);
            $fileName = uniqid() . '.' . $extension;
            $source = fopen($request->photos, 'r');
            $destination = fopen('images/' . $fileName, 'w');
            stream_copy_to_stream($source, $destination);
            fclose($source);
            fclose($destination);
            $photo = \App\Photo::create(['file' => $fileName]);
            return $photo;
        }
        return $photo;
    }

    public function logout()
    {
        Cache::forget('user_repository:all');
        return response()->json('Sign out!');
    }

}
