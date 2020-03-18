<?php

namespace App\Http\Controllers\Family;

use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Models\FamilyType;
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
        
        // $family_type = FamilyType::all()->pluck('name', 'id');

        // \JavaScript::put([
        //     'family_type' => $family_type
        // ]);

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
                $family->update();
            }else{
                // for create/saving
                $family = new Family;
                // $family->name = $request->inputs['name'];
                // $family->material_code = $request->inputs['material_code'];
                $family->fill($request->inputs);
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

    public function familytype_family($id){

        \JavaScript::put([
            'id'=> $id
        ]);
        return view('family.index');

    }

    public function familytype_family_list($id)
    {
        // $familyType = Family::where('family_type_id', null)->orWhere('family_type_id', $id)->orderBy('id', 'desc')->get();
        $familyType = Family::where('family_type_id', $id)->orderBy('id', 'desc')->get();
        // dd('test');
        return json_encode($familyType);
    }

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
    public function search_family(Request $request)
    {
       
        // return all data
        $family = Family::all();

        // return all trash data
        // $family = Family::onlyTrashed()->get();

        // restore trash data
        // $family = Family::onlyTrashed()->where('id', 3)->first();
        // $family->restore();

        // retrun specific data from priority_id column
        // $family = Family::where('priority_id', 1)->get();

        // // return specific data based on like
        $family = Family::where('name', 'like', '%'.$request->get.'%')->orWhere('material_code', '=', $request->get) ->get();

        // // retrun based on time
        // $family = Family::->get();
        // // <, >, <>, =,d

        // // retrun user table relationship BelongsTo
        // $family = Family::with('user')->get();

        // // retrun user table relationship hasMany
        // $user = User::with('todos')->get();

        // store data to todos table
        // $family = new Family;
        // $family->fill(
        //     [
        //         'task' => 'task 6',
        //         'user_id' => 1,
        //         'priority_id' => 3
        //     ]
        // );
        // $family->save();

        // update data to todos table
        // $family = Family::find(5);
        // $family = Family::where('id', 5)->first();
        // $family->fill(
        //     [
        //         'task' => 'task 24',
        //         'user_id' => 1,
        //         'priority_id' => 3
        // //     ]
        // );
        // $family->update();

        // delete data from todos table
        // $family = Family::where('id', 3)->first();
        // $family->delete();

        dd($family);

        
    }

}
