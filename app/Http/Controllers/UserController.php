<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;
use App\User;
use App\Role;
use App\Helpers;
use App\LogActivity;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index($firebase)
    {
        //Administrator = 2
        if ($this->check($firebase)) {
            $users = User::with('repositories', 'role')->get();
            $user = User::with('photo')->where('firebase_uid', $firebase)->first();
            $roles = Role::where('id', '!=', 1)->get();
            return response()->json(['roles' => $roles  , 'users' => $users, 'user' => $user, 'activity' => LogActivity::orderBy('updated_at', 'desc')->paginate(7)]);
        } else {
            return response()->json([]);
        }

    }

    public function userRepositories()
    {
        if ($this->check($firebase)) {
            $repositories = \App\Repository::with('photos', 'color', 'repository')
                ->orderBy('updated_at', 'desc')
                ->get();
            return response()->json($repositories);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'lastName' => 'required|string',
            'firstName' => 'required|string',
            'role_id' => 'required',
        ]);
        if ($this->check($request->uid)) {
            $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/repositories-d0a35-firebase-adminsdk-0w9yb-282a9b97b1.json');
            $firebase = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->create();
            $db = $firebase->getDatabase();
            $auth = $firebase->getAuth();
            $createUser = $auth->createUserWithEmailAndPassword($request['email'], $request['password']);
            $userRegister = [
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
                'country' => $request['country'],
                'school' => $request['school'],
                'field' => $request['field'],
                'role_id' => $request['role_id'],
                'lastName' => $request['lastName' ],
                'firstName' => $request['firstName' ],
                'firebase_uid' => $createUser->getIdToken()->getClaims()['user_id']->getValue()
            ];

            $user = \App\User::create($userRegister);
            $userRef = $db->getReference('users')->push(['display' => $userRegister['name'], 'name' => $user->id]);
            $userKey = $userRef->getKey();
            //dd(gettype($createUser), $createUser->getIdToken()->getClaims()['user_id']->getValue() );
            $userMessage = null;
            if($user->role_id === 2) {
                $userMessage = 'Add ' . $request->name . ' as Administrator' ;
            }else{
                $userMessage = 'Add ' . $request->name . ' as User';
            }


            Helpers\LogActivity::addToLog( $userMessage, $request->uid, 'fa-user  w3-text-blue');
            return response()->json([
                'message' => 'User ' . $request->name . ' has create',
                'created' => \App\User::with('role')->where('id', $user->id)->first(),
                'activity' =>  LogActivity::orderBy('updated_at', 'desc')->paginate(7)
            ]);
            //return response($user, 200);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, $firebase)
    {
        return response()->json(User::where('firebase_uid', $firebase)->first(), 200);
    }


    public function adminChat()
    {
        return response()->json(User::where('role_id', 2)->first(), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        \App\User::where('id', $user->id)->first()->update(['firebase_uid' => $request->firebase_uid]);




        return response('Update Successfully', 200);

    }

    public function updateUser(Request $request, $user, $firebase)
    {
            if ($this->check($firebase)) {

                $usr = \App\User::where('id', (int)$user)->first();

                $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/repositories-d0a35-firebase-adminsdk-0w9yb-282a9b97b1.json');
                $fb = (new Factory)
                    ->withServiceAccount($serviceAccount)
                    ->create();
                $db = $fb->getDatabase();
                $auth = $fb->getAuth();
                $uid = $request->firebase_uid;
                if ($usr->email !== $request->email) {
                    $auth->changeUserEmail($uid, $request->email);
                    $usr->update(['email' => $request->email]);
                }

                if ($request->password) {
                    $auth->changeUserPassword($uid, $request->password);
                    $usr->password = $request->password;
                    $usr->save();
                }

            }
        $update = [];
//                user original school not equal to school then change the school name
        if ($usr->name !== $request->name) {
            $update['name'] = $request->name;
        }
        if ($usr->school !== $request->school) {
            $update['school'] = $request->school;
        }
        if ($usr->country !== $request->country) {
            $update['country'] = $request->country;
        }
        if ($usr->field !== $request->field) {
            $update['field'] = $request->field;
        }
        if ($update) {
            $usr->update($update);
        }

        Helpers\LogActivity::addToLog( 'Account '. $request->name . ' has been Successfully updated', $firebase, 'fa-user  w3-text-green');
       //return response('Update Successfully', 200);
        return response()->json([
            'message' => 'User ' . $request->name . ' has updated',
            'updated' => $request->all(),
            'activity' =>  LogActivity::orderBy('updated_at', 'desc')->paginate(7)
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, $uid, $firebase)
    {
        if ($firebase) {
            $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/repositories-d0a35-firebase-adminsdk-0w9yb-282a9b97b1.json');
            $fb = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->create();
            $db = $fb->getDatabase();
            $auth = $fb->getAuth();
            $uid = $uid;
            $updatedUser = $auth->deleteUser($uid);
            $userId = User::where('id', $user->id)->where('firebase_uid', $uid);
            if (!(empty($user->photo->file))) {
                unlink(public_path() . $user->photo->file);
            }
            $userId->delete();
            Helpers\LogActivity::addToLog( 'Account '. $user->name . ' has been Successfully deleted', $firebase, 'fa-user  w3-text-red');
            //return response('Remove Successfully!');
            return response()->json([
                'message' => 'User ' . $user->name . ' has been removed!!',
                'activity' =>  LogActivity::orderBy('updated_at', 'desc')->paginate(7)
            ], 200);
        }

    }

    /**
     * @param $firebase
     * @return bool
     */
    public function check($firebase)
    {
        return 2 === User::where('firebase_uid', $firebase)->first()->role_id;
    }
}
