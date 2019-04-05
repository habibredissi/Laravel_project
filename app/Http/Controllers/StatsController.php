<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Teams;
use App\Players;
use App\Roles;
use App\Placements;
use App\Matchs;
use DB;

class StatsController extends Controller
{

    public function butsEncaisses($id)
    {
        $score = DB::table('matchs')->select('matchs.*')->where('team1_id', $id)->sum('score2');
        $score += DB::table('matchs')->select('matchs.*')->where('team2_id', $id)->sum('score1');
        return $score;
    }

    public function butMarques($id)
    {
        $score = DB::table('matchs')->select('matchs.*')->where('team1_id', $id)->sum('score1');
        $score += DB::table('matchs')->select('matchs.*')->where('team2_id', $id)->sum('score2');
        return $score;
    }

    public function nombreJoueurs($id)
    {
        $players = DB::table('players')->select('players.*')->where('team_id', $id)->count();
        return $players;
    }

    public function nbMatchsJoues($id)
    {
        $matchs = DB::table('matchs')->select('matchs.*')->where('team1_id', $id)->count();
        $matchs += DB::table('matchs')->select('matchs.*')->where('team2_id', $id)->count();
        return $matchs;
    }

    public function nbMatchsGagnes($id)
    {
        $nbMatchsGagnes = DB::table('matchs')->select('matchs.*')->whereRaw('score1 > score2')->where('team1_id', $id)->count();
        $nbMatchsGagnes += DB::table('matchs')->select('matchs.*')->whereRaw('score1 < score2')->where('team2_id', $id)->count();
        return $nbMatchsGagnes;
    }

    public function nbMatchsNuls($id)
    {
        $nbMatchsNuls = DB::table('matchs')->select('matchs.*')->whereRaw('score1 = score2')->where('team1_id', $id)->count();
        $nbMatchsNuls += DB::table('matchs')->select('matchs.*')->whereRaw('score1 = score2')->where('team2_id', $id)->count();
        return $nbMatchsNuls;
    }

    public function nbMatchsPerdus($id)
    {
        $nbMatchsPerdus = DB::table('matchs')->select('matchs.*')->whereRaw('score1 < score2')->where('team1_id', $id)->count();
        $nbMatchsPerdus += DB::table('matchs')->select('matchs.*')->whereRaw('score1 > score2')->where('team2_id', $id)->count();
        return $nbMatchsPerdus;
    }

    public function classement()
    {
        $classement = [];
        $teams = DB::table('teams')->select('teams.*')->where('id', '!=', '0')->get();
        foreach ($teams as $key => $team) {
            $id = $team->id;
            $points = $this->nbMatchsNuls($team->id) + (3 * $this->nbMatchsGagnes($team->id));
            $classement[] = array(
            'id' => $team->id, 
            'name' => $team->name,
            'flag' => $team->flag,
            'matchs' => $this->nbMatchsJoues($id),
            'goals' => $this->butMarques($id),
            'goalsConceaded' => $this->butsEncaisses($id),
            'won' => $this->nbMatchsGagnes($id),
            'lost' => $this->nbMatchsPerdus($id),
            'draw' => $this->nbMatchsNuls($id),
            'players' => $this->nombreJoueurs($id),
            'points' => $points);
        }

        usort($classement, function ($a, $b) {
            return $b['points'] - $a['points'];
        });

        return $classement;
    }

    public function index()
    {
        
        // dd($this->classement());
        return view('stats.statsByTeam')->with('datas', $this->classement());
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
        return view('stats.statByMatch')->with('match', $match);
    }

    public function playersByTeam($id)
    {
        $players = DB::table('players')
        ->join('teams', 'players.team_id', '=', 'teams.id')
        ->join('roles', 'players.role_id', '=', 'roles.id')
        ->select('players.*', 'teams.name', 'teams.id as team_id', 'teams.country', 'roles.role')
        ->where('teams.id', $id)
        ->orderBy('players.lastName')
        ->get();
        foreach ($players as $key => $value) {
            $value->age = Controller::getAge($value->birthdate);
          }
        return view('stats.playersByTeam')->with('players', $players);
    }
}