<?php

namespace App\Http\Controllers;

use App\Placements;
use Illuminate\Http\Request;

class AdminPlacementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $placements = Placements::all();
        return view('admin.placements.index')->with('placements', $placements);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.placements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $placement = new Placements;
        $placement->stadium = $request->input('stadium');
        $placement->country = $request->input('country');
        $placement->save();

        return redirect('/admin/placements');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $placement = Placements::find($id);
        return view('admin.placements.edit')->with('placement', $placement);
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
        $placement = Placements::find($id);
        $placement->stadium = $request->input('stadium');
        $placement->country = $request->input('country');
        $placement->save();

        return redirect('/admin/placements');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $placement = Placements::find($id);
        $placement->delete();
        $placements = Placements::all();
        return redirect()->action('AdminPlacementsController@index');
    }
}
