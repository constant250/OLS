<?php

namespace App\Http\Controllers\Discipline;

use App\Http\Controllers\Controller;
use App\Model\Discipline as ModelDiscipline;
use Illuminate\Http\Request;
use App\Models\Discipline;
use DB;

class DisciplineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("disciplines.index");
        //
    }

    public function lists()
    {
        $Discipline = Discipline::all();

        return json_encode($Discipline);

    }

    public function proj_disc($id){

        \JavaScript::put([
            'id'=> $id
        ]);

        return view("disciplines.index");

    }

    public function proj_disc_list($id)
    {
        $discipline = Discipline::where('project_id', null)->orWhere('project_id', $id)->orderBy('id', 'desc')->get();

        return json_encode($discipline);
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

            
        //
        try {
            DB::beginTransaction();

            if(isset($request->inputs['id'])){

                 // for edit/update
                 $Discipline = Discipline::where('id', $request->inputs['id'])->first();
                 $Discipline->name=$request->inputs['name'];
                 $Discipline->project_id=$request->id;
                 $Discipline->update();
                 

            }else{

                // for create/saving
            $Discipline = new Discipline;
            $Discipline->name=$request->inputs['name'];
            $Discipline->project_id=$request->id;
            $Discipline->user()->associate(\Auth::user());
            $Discipline->save();
                
            }
          
            DB::commit();

            return ['status' => 'success'];

        }catch (\Exception $e){

            DB::rollback();

            return json_encode(['message'=> $e->getMessage(), 'status' => 'error']);
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
        $data = Discipline::where('id', $id)->first();

        \JavaScript::put([
            'discipline'=> $data
        ]);

        return view('disciplines.show');
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
            // start db transaction
            DB::beginTransaction();

            $discipline = Discipline::where('id', $id)->first();
            $discipline->delete();

            DB:: commit();
            return['status'=>'success'];
        } catch(\Exception $e){

            // rollback db transactions
            DB::rollBack();

            // return to previous page with errors
            return  json_encode(['message' => $e->getMessage(), 'status' => 'error']);
        }

        
    
}
}