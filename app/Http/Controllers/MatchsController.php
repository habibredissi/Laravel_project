<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teams;
use App\Players;
use App\Roles;
use App\Placements;
use App\Matchs;
use App\Bets;
use DB;

class MatchsController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    
    $matchs = Matchs::join('teams as a', 'team1_id', '=', 'a.id')
    ->join('teams as b', 'team2_id', '=', 'b.id')
    ->join('teams as c', 'winner_id', '=', 'c.id')
    ->join('placements as p', 'placement_id', '=', 'p.id')
    ->leftJoin('stats as s', 's.match_id', '=', 'matchs.id')
    ->leftJoin('bets as d', 'd.match_id', '=', 'matchs.id')
    ->select('matchs.*', 'a.id as team1_id', 'b.id as team2_id', 'a.name as team1', 'b.name as team2', 'b.flag as flag2', 'a.flag as flag1', 'c.name as winner', 'p.stadium as placement', 's.id as stat_id', 'd.user_id as user_id')
    ->orderBy('matchs.matchDate', 'DESC')
    ->get();

    return view('matchs.index')->with('matchs', $matchs);
  }

  
}
