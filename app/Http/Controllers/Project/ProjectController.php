<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectType;
use Illuminate\Http\Request;
use Auth;
use DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $project_types = ProjectType::all();
        // dd($project_types);
        \JavaScript::put([
            'project_types' => $project_types
        ]);

        return view('projects.index');
    }

    public function lists()
    {
        $project = Project::with('project_type', 'user.party')->orderBy('id', 'desc')->get();
        // dd($project);
        return json_encode($project);
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
        // dd($request->inputs['is_active'] == true ? 1 : 0);
        //
        try {
            // start db transaction
            DB::beginTransaction();

            if(!isset($request->inputs['id'])){
                $project = new Project;
                $project->name = $request->project['name'];
                $project->project_type_id = $request->project['project_type_id'];
                $project->user()->associate(Auth::user());
                $project->is_active = true;
                $project->save();
            }else{
                $project = Project::find($request->inputs['id']);
                $project->is_active = $request->inputs['is_active'] == true ? 1 : 0;
                $project->name = $request->inputs['name'];
                $project->project_type_id = $request->inputs['project_type_id'];
                $project->update();
            }

            DB::commit();

            return ['status' => 'success'];

        } catch (\Exception $e) {
            // rollback db transactions
            DB::rollBack();

            // return to previous page with errors
            return json_encode(['message' => $e->getMessage(), 'status' => 'error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $project = Project::with('project_type', 'user')->where('id', $id)->first();
        $project_types = ProjectType::all()->pluck('name', 'id');

        \JavaScript::put([
            'project' => $project,
            'project_types' => $project_types
        ]);

        return view('projects.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $project = Project::find($id);
            // start db transaction 
            DB::beginTransaction();
            $project->delete();
            DB::commit();

            // dd($agent);

            return ['status' => 'success'];
        } catch (\Exception $e) {
            // rollback db transactions
            DB::rollBack();

            // return to previous page with errors
            return json_encode(['message' => $e->getMessage(), 'status' => 'error']);
        }
    }
}
