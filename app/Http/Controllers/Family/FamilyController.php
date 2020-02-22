<?php

namespace App\Http\Controllers\Family;

use App\Http\Controllers\Controller;
use App\Models\Family;
use Illuminate\Http\Request;
use DB;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('family.index');
    }

    public function lists()
    {
        $families = Family::all();
        // dd($families);
        return json_encode($families);
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
            // start db transaction
            DB::beginTransaction();

            if(isset($request->inputs['id'])){
                // for edit/update
                $family = Family::where('id', $request->inputs['id'])->first();
                $family->name = $request->inputs['name'];
                $family->update();
            }else{
                // for create/saving
                $family = new Family;
                $family->name = $request->inputs['name'];
                $family->user()->associate(\Auth::user());
                $family->save();
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

        $data = Family::where('id', $id)->first();
        // dd($data);
        \JavaScript::put([
            'family' => $data
        ]);

        return view('family.show');
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

            $family = Family::where('id', $id)->first();
            $family->delete();

            DB::commit();

            return ['status' => 'success'];
            
        } catch (\Exception $e) {
            // rollback db transactions
            DB::rollBack();

            // return to previous page with errors
            return json_encode(['message' => $e->getMessage(), 'status' => 'error']);
        }
    }
}
