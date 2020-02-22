<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //
        return view('category.index');
    }

    public function lists()
    {
        $category = Category::all();

        return json_encode($category);
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
    // start of db transaction
    DB::beginTransaction();

    if(isset($request->inputs['id'])){

    
    // for edit/update
        $category = Category::where('id', $request->inputs['id'])->first();
        $category->name = $request->inputs['name'];
        $category->update();
    }else{

    // for create/saving


    $category = new category;
    $category->name = $request->inputs['name'];
    $category->user()->associate(\Auth::user());
    $category->save();
    }


    DB::commit();

    return ['status' => 'success'];

} catch (\Exception $e) {
    //  rollback db transactions
    DB::rollback();

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

            $data = Category::where('id', $id)->first();

            \JavaScript::put([
                'category' => $data
            ]);

            return view('category.show');
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
            // start of db transaction
            DB::beginTransaction();

            $category = Category::where('id', $id)->first();
            $category->delete();
            
            DB::commit();
            return ['status' => 'success'];
        }catch (\Exception $e) {
            // rollback db transactiobs
            DB::rollBack();

            // return to previous page with errors
            return json_encode(['message' => $e->getMessage(), 'status' => 'error']);
        }
    }
}


