<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard');
    }

    public function dynamic_form()
    {
        return view('dynamic-form');
    }

    public function todo_example()
    {
        // return all data
        $todos = Todo::all();

        // return all trash data
        $todos = Todo::onlyTrashed()->get();

        // restore trash data
        // $todos = Todo::onlyTrashed()->where('id', 3)->first();
        // $todos->restore();

        // retrun specific data from priority_id column
        $todos = Todo::where('priority_id', 1)->get();

        // return specific data based on like
        $todos = Todo::where('task', '=', 'task')->get();

        // retrun based on time
        $todos = Todo::where('created_at', '>', '2020-02-10')->where('created_at', '<', date('Y-m-d H:i:s'))->get();
        // <, >, <>, =,d

        // retrun user table relationship BelongsTo
        $todos = Todo::with('user')->get();

        // retrun user table relationship hasMany
        $user = User::with('todos')->get();

        // store data to todos table
        $todos = new Todo;
        $todos->fill(
            [
                'task' => 'task 6',
                'user_id' => 1,
                'priority_id' => 3
            ]
        );
        // $todos->save();

        // update data to todos table
        // $todos = Todo::find(5);
        // $todos = Todo::where('id', 5)->first();
        $todos->fill(
            [
                'task' => 'task 24',
                'user_id' => 1,
                'priority_id' => 3
            ]
        );
        // $todos->update();

        // delete data from todos table
        // $todos = Todo::where('id', 3)->first();
        // $todos->delete();

        dd($todos);

        
    }
}
