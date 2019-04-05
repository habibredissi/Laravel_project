<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Teams;
use App\Matchs;
use App\Placements;
use App\Bets;
use DB;

class BetController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $bets = DB::table('bets')
      ->join('teams as t1', 'bets.team1', '=', 't1.id')
      ->join('teams as t2', 'bets.team2', '=', 't2.id')
      ->join('matchs as m', 'bets.match_id', '=', 'm.id')
      ->select('t1.name as team1', 't2.name as team2', 'user_id', 'bet', 'betAmount','matchDate', 'bets.id')
      ->get();
      return view('admin/bets/allBets')->with('bets',$bets);
    }

    public function seeBetsOfUser($id)
    {
      if (Auth::user()->id == $id) {
        $bets = DB::table('bets')
        ->join('teams as t1', 'bets.team1', '=', 't1.id')
        ->join('teams as t2', 'bets.team2', '=', 't2.id')
        ->join('matchs as m', 'bets.match_id', '=', 'm.id')
        ->select('t1.name as team1', 't2.name as team2', 'user_id', 'bet', 'betAmount','matchDate', 'bets.id')
        ->where('user_id',$id)
        ->get();
        return view('user/allBets')->with('bets',$bets);
      } else {
        return redirect('');
      }
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

    public function createBetForMatch($id)
    {
      $match = DB::table('matchs')
      ->join('teams as t1', 'matchs.team1_id', '=', 't1.id')
      ->join('teams as t2', 'matchs.team2_id', '=', 't2.id')
      ->join('placements as p', 'matchs.placement_id', '=', 'p.id')
      ->select('matchs.id as match_id','matchs.matchDate', 't1.name as name1','t2.name as name2','t1.id as team1_id','t2.id as team2_id', 'p.stadium', 'p.country')
      ->where('matchs.id', $id)
      ->get();

      return view('user/bet')->with('match', $match);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $bet = new Bets;
      $bet->user_id = $request->input('user_id');
      $bet->match_id = $request->input('match_id');
      $bet->team1 = $request->input('team1_id');
      $bet->team2 = $request->input('team2_id');
      $bet->bet = $request->input('bet');
      $bet->betAmount = $request->input('bet_amount');
      $bet->save();

      return redirect('');
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
      $bet = Bets::find($id);
      $bet->delete();
      return redirect('/admin/bets/allBets');
    }
}
