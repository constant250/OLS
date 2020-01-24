<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
// use App\r;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
// use App\Models\Email;
// use App\Models\Departments;
use App\Models\Party;
use App\Models\Person;
use App\Http\Resources\UserResource;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use \DB;
use Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('users.index');
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
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'errors', 'errors' => $validator->messages()]);
        }
        
        try {
            DB::beginTransaction();
            // new instance of Party Model
            $party = new Party;
            // new instance of Person Model
            $person = new Person;
            // new instance of User Model
            $user = new User;

            $party->fill([
                'party_type_id'    => 1,
                'name'          => preg_replace('/\s+/', ' ', $request->firstname . ' ' . $request->lastname)
            ]);
            $party->save();

            $person->fill([
                // 'person_type_id' =>  1,
                'firstname'   => $request->firstname,
                'lastname'    => $request->lastname
            ]);
            $person->party()->associate($party);
            $person->save();

            $password = Hash::make($request->password);
            $user->fill([
                'username' => $request->username,
                'email' => $request->email,
                'password' => $password,
                'is_active' => 1
            ]);
            $user->party()->associate($party);

            // dd($user);
            $user->save();

            DB::commit();

            
            return ['status' => 'success'];
        } catch (\Exception $e) {
            DB::rollBack();

            // dd($e->getMessage());

            // return to previous page with errors
            return ['status' => 'error', 'message' => $e->getMessage()];
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with(['party.person', 'roles'])->where('id', $id)->first();
        // dd($user);
        // $departments = Departments::all();
        $roles = Role::all();
        // dd($roles);
        //
        \JavaScript::put([
            'user_id' => $id,
            'user' => $user,
            'roles' => $roles
            // 'departments' => $departments
        ]);

        return view('users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user != null) {
            $user->delete();
            return json_encode(['id'=>$id, 'status' => 'success']);
        } 
    }


    public function user_list(){
        $userList = User::with(['party', 'party.person'])->has('party')->orderBy('id', 'desc')->get();

        // return UserResource::collection($userList);
        return $userList;
    }

    public function user_search(Request $request)
    {
        if ($request->search == null) {
            return $this->user_list();
        }
        $r_search = $request->search;
        $userList = User::with(['party', 'party.person'])->orWhereHas('party.person', function ($q) use ($r_search) {
                $q->where('firstname', 'like', '%'.$r_search.'%');
            })->orWhereHas('party',function($q) use ($r_search) {
                 $q->where('name', 'LIKE', '%'. $r_search . '%');
            })->orderBy('id', 'desc')->paginate(10);

        return UserResource::collection($userList);
    }

    public function user_info($id)
    {
        $user = User::with(['party', 'party.person'])->where('id', $id)->first();
        $avtr_path = '/storage/user/avatars/' . $user->profile_image;
        
        // $department = Departments::all();
        $role = Role::all();

        $data = [
            'user' => $user,
            'avtr_path' => $avtr_path,
            // 'department' => $department,
            'role' => $role
        ];

        return $data;
    }

    public function user_info_update(Request $request, $id)
    {

        // dd($request->all());

        try {
            DB::beginTransaction();

            $user = User::with(['party', 'party.person'])->where('id', $request->user['id'])->first();

            // update party
            $user->party->update([
                'name'      => preg_replace('/\s+/', ' ', $request->user['party']['person']['firstname'] . ' ' . $request->user['party']['person']['lastname'])
            ]);

            // update a person & associate person with a party
            $user->party->person->update([
                'firstname'   => $request->user['party']['person']['firstname'],
                'lastname'    => $request->user['party']['person']['lastname'],
                'gender'      => $request->user['party']['person']['gender'],
                'date_of_birth'      => !in_array($request->user['party']['person']['date_of_birth'], ['',null]) ? Carbon::parse($request->user['party']['person']['date_of_birth'])->format('Y-m-d') : null,
            ]);

            if(isset($request->user['change_password'])){
                $user->password = $request->user['change_password'] != null ? Hash::make($request->user['change_password']) : $user->password;
            }

            // remove roles
            foreach($user->roles as $v){
                $user->removeRole($v);
            }
            // update roles
            foreach($request->user['roles'] as $v){
                // dd($v['name']);
                $user->assignRole($v['name']);
            }

            $user->update([
                'username'          => $request->user['username'],
                'is_active'         => in_array($request->user['is_active'], [1,true]) ? 1 : 0,
                'email'             => $request->user['email'],
            ]);

            DB::commit();

            // return to users index page
            return json_encode(['data' => $request->all(), 'status' => 'updated']);
        } catch (\Exception $e) {
            DB::rollBack();

            echo $e->getMessage();
            exit();

            // return to previous page with errors
            return json_encode(['message' => $e->getMessage(), 'status' => 'error']);
        }
    }

    public function avatar(Request $request)
    {
        $image = $request->file('file');
        // $image_name = $request->name.'_'.mt_rand(0,10).'.'.$image->guessClientExtension();
        $image_name = $request->name . '.' . $image->guessClientExtension();
        $image->storeAs('public/user/avatars', $image_name);

        $img_exist = User::where('id', $request->user_id)->first();
        if ($img_exist) {
            $img_exist->profile_image = $image_name;
            $img_exist->update();
        }

        return json_encode(['data'=>$request->all(), 'status' => 'success']);
    }
}