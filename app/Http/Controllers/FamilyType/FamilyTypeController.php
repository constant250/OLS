<?php

namespace App\Http\Controllers\FamilyType;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FamilyType;
use DB;

class FamilyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('family-types.index');
        //
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
        try {
            DB::beginTransaction();

            if(isset($request->inputs['id'])){
                $familytype = FamilyType::where('id', $request->inputs['id'])->first();
                $familytype->name = $request->inputs['name'];
                $familytype->update();
                
            }else{

                $familytype = new FamilyType;
                $familytype->name = $request->inputs['name'];
                $familytype->user()->associate(\Auth::user());
                $familytype->save();
            }

            

            DB::commit();

            return ['status' => 'success'];

        } catch (\Exception $e) {

            DB::rollBack();

            return json_encode(['message' => $e->getMessage(), 'status' => 'error']);
        }

        //
    }

    public function lists()
    {
        $familytype = FamilyType::all();

        return json_encode($familytype);
    //

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

        $data = FamilyType::where('id', $id)->first();

        \JavaScript::put([
            'familytype' => $data
        ]);

        return view('family-types.show');
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

        try {

            DB::beginTransaction();

            $familytype = FamilyType::where('id', $id)->first();
            $familytype->delete();

            DB::commit();
            return ['status' => 'success'];
            } catch (\Exception $e) 
                {

                DB::rollBack();

                return json_encode(['message' => $e->getMessage(), 'status' => 'error']);
                }
            }


        //
    }

