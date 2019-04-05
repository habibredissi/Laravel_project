<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teams;
use App\Players;
use App\Roles;
use App\Placements;
use App\Matchs;
use App\Stats;
use App\Bets;
use DB;

class AdminMatchsController extends Controller
{
    
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */

  public function __contruct()
  {
    $this->middleware('IsAdmin');
  }
  
  public function index()
  {
    $matchs = Matchs::join('teams as a', 'team1_id', '=', 'a.id')
    ->join('teams as b', 'team2_id', '=', 'b.id')
    ->join('teams as c', 'winner_id', '=', 'c.id')
    ->join('placements as p', 'placement_id', '=', 'p.id')
    ->leftJoin('stats as s', 's.match_id', '=', 'matchs.id')
    ->select('matchs.*', 'a.id as team1_id', 'b.id as team2_id', 'a.name as team1', 'b.name as team2', 'b.flag as flag2', 'a.flag as flag1', 'c.name as winner', 'p.stadium as placement', 's.id as stat_id')
    ->orderBy('matchs.matchDate', 'DESC')
    ->get();

    return view('admin.matchs.index')->with('matchs', $matchs);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $teams = Teams::all();
    $listTeams = [];
    foreach ($teams as $team) {
      if($team->id != 0)
      {
        $listTeams[$team['id']] = $team['name'];
      }
    }

    $placements = Placements::all();
    $listPlacements = [];
    foreach ($placements as $placement) {
      $listPlacements[$placement['id']] = $placement['stadium'];
    }
    $data = [
      'teams'=> $listTeams,
      'placements' => $listPlacements
    ];
    return view('admin.matchs.create')->with('data', $data);
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    $match = new Matchs;
    $match->team1_id = $request->input('team1');
    $match->team2_id = $request->input('team2');
    $match->score1 = $request->input('score1');
    $match->score2 = $request->input('score2');
    $match->winner_id = '0';
    $match->placement_id = $request->input('placement');
    $match->matchDate = $request->input('matchDate');
    $match->save();

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
    $matchs = Matchs::join('teams as a', 'team1_id', '=', 'a.id')
    ->join('teams as b', 'team2_id', '=', 'b.id')
    ->join('teams as c', 'winner_id', '=', 'c.id')
    ->join('placements as p', 'placement_id', '=', 'p.id')
    ->select('matchs.*', 'a.name as team1', 'b.name as team2', 'c.name as winner', 'p.stadium as placement')
    ->where('matchs.id', $id)
    ->get();

    $teams = Teams::all();
    $placements = Placements::all();
    //var_dump($teams);
    $listTeams = [];
    foreach ($teams as $team) {
      if($team->id != 0)
      {
       $listTeams[$team['id']] = $team['name'];
      }
    }

    $listPlacements = [];
    foreach ($placements as $placement) {
      $listPlacements[$placement['id']] = $placement['stadium'];
    }
    $data = [
      'matchs' => $matchs,
      'listTeams' => $listTeams,
      'listPlacements' => $listPlacements
    ];

    // var_dump($data['listPlacements']);
    return view('admin.matchs.edit')->with('data', $data);
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
    $match = Matchs::find($id);
    $match->team1_id = $request->input('team1');
    $match->team2_id = $request->input('team2');
    $match->score1 = $request->input('score1');
    $match->score2 = $request->input('score2');
    $match->winner_id = '0';
    $match->placement_id = $request->input('placement');
    $match->matchDate = $request->input('matchDate');
    $match->save();

    return redirect()->action('AdminMatchsController@index');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $matchs = Matchs::find($id);
    $matchs->delete();

    //SUPRIMER LES STATS
    $stats = Stats::where('match_id', '=', $id);
    $stats->delete();

    //SUPPRIMER LES BETS
    $bets = Bets::where('match_id', '=', $id);
    $bets->delete();

    return redirect()->action('AdminMatchsController@index');
  }
}
