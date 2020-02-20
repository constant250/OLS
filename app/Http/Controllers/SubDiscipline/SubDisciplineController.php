<?php

namespace App\Http\Controllers\SubDiscipline;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubDiscipline;
use DB;

class SubDisciplineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('sub-disciplines.index');
    }

    public function lists()
    {
        $subdiscipline = SubDiscipline::all();

        return json_encode($subdiscipline);
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
        try{
            // start db transaction
            DB::beginTransaction();

            $subdiscipline = new SubDiscipline;
            $subdiscipline->name = $request->inputs['name'];
            $subdiscipline->user()->associate(\Auth::user());
            $subdiscipline->save();

            DB::commit();

            return ['status' => 'success'];

        } catch (\Exception $e) {
            // rollback db transaction
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
        
        $data = SubDiscipline::where('id', $id)->first();

        \JavaScript::put([
            'subdiscipline' => $data
        ]);

        return view ('sub-disciplines.show');
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
    }
}
