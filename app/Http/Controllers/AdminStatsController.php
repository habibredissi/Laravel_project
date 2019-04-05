<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teams;
use App\Matchs;
use App\Placements;
use App\Stats;
use DB;

class AdminStatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function statByMatch($id)
    {
      $match = DB::table('matchs')
      ->join('teams as t1', 'matchs.team1_id', '=', 't1.id')
      ->join('teams as t2', 'matchs.team2_id', '=', 't2.id')
      ->join('placements as p', 'matchs.placement_id', '=', 'p.id')
      ->leftJoin('stats as s', 'matchs.id','=', 's.match_id')
      ->select('matchs.matchDate', 't1.name as name1','t2.name as name2', 'p.stadium', 'p.country','s.*')
      ->where('matchs.id', $id)
      ->get();

      //var_dump($match[0]->id);
        return view('admin.stats.statByMatch')->with('match', $match);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    public function createStatsForMatch($id)
    {
      $match = DB::table('matchs')
      ->join('teams as t1', 'matchs.team1_id', '=', 't1.id')
      ->join('teams as t2', 'matchs.team2_id', '=', 't2.id')
      ->join('placements as p', 'matchs.placement_id', '=', 'p.id')
      ->select('matchs.*', 't1.name as name1','t2.name as name2', 'p.stadium', 'p.country')
      ->where('matchs.id', $id)
      ->get();

      //var_dump($match[0]->id);
        return view('admin.stats.addStats')->with('match', $match);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $stats = new Stats;
      //var_dump($request->input('yellowcards'));
      $stats->match_id = $request->input('match_id');
      $stats->yellowCards = $request->input('yellowcards');
      $stats->redCards = $request->input('redcards');
      $stats->penalties = $request->input('penalties');
      $stats->faults = $request->input('faults');
      $stats->corners = $request->input('corners');
      $stats->freekicks = $request->input('freekicks');
      $stats->shots = $request->input('shots');
      $stats->offsides = $request->input('offsides');
      $stats->passes = $request->input('passes');
      $stats->save();

     return redirect('/admin/matchs');
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
