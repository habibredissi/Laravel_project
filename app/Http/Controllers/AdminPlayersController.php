<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teams;
use App\Players;
use App\Roles;
use App\Users;
use DB;

class AdminPLayersController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

      $players = DB::table('players')
      ->join('teams', 'players.team_id', '=', 'teams.id')
      ->join('roles', 'players.role_id', '=', 'roles.id')
      ->select('players.*', 'teams.name', 'teams.country', 'roles.role')
      ->orderBy('teams.name')
      ->get();
      foreach ($players as $key => $value) {
        $value->age = Controller::getAge($value->birthdate);
      }
      return view('admin.players.index')->with('players', $players);
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
      //var_dump($players);
      return view('admin.players.playersByTeam')->with('players', $players);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teams = Teams::all();
        $roles = Roles::all();
        //var_dump($teams);
        $list = [];
        foreach ($teams as $team) {
          if($team->id != 0)
          {
            $list[$team['id']] = $team['name'];
          }
        }
        $listroles = [];
        foreach ($roles as $role) {
          $listroles[$role['id']] = $role['role'];
        }
        $data = [
          'teams'=> $list,
          'roles' => $listroles
        ];
        return view('admin.players.create')->with('data', $data);
        //return view('admin.players.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $player = new Players;
        $player->firstName = $request->input('firstname');
        $player->lastName = $request->input('lastname');
        $player->birthdate = $request->input('birthdate');
        $player->height = $request->input('height');
        $player->urlPicture = $request->input('urlpicture');
        $player->role_id = $request->input('role');
        $player->team_id = $request->input('team');
        $player->save();

        return redirect('/admin/players');
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
      $player = Players::find($id);
      $player_team = $player->team_id;
      $player_role = $player->role_id;
      //var_dump($player);
      $teams = Teams::all();
      $roles = Roles::all();
      //var_dump($teams);
      $list = [];
      foreach ($teams as $team) {
        if($team->id != 0)
          {
            $list[$team['id']] = $team['name'];
          }
      }
      $listroles = [];
      foreach ($roles as $role) {
        $listroles[$role['id']] = $role['role'];
      }
      $data = [
        'player' => $player,
        'player_team' => $player_team,
        'player_role' => $player_role,
        'teams'=> $list,
        'roles' => $listroles
      ];
      return view('admin.players.edit')->with('data', $data);
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
      $player = Players::find($id);
      $player->firstName = $request->input('firstname');
      $player->lastName = $request->input('lastname');
      $player->birthdate = $request->input('birthdate');
      $player->height = $request->input('height');
      $player->urlPicture = $request->input('urlpicture');
      $player->role_id = $request->input('role');
      $player->team_id = $request->input('team');
      $player->save();

      return redirect('/admin/players');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $player = Players::find($id);
        $player->delete();
        return redirect('/admin/players')->with('success', 'Player deleted');
    }

    public function listplayers()
    {

    }

    public function infoAnimal(Animal $id)
    {
      $message = $id->name . ' is a '. $id->gender .' '. $id->type . ' of ' . $id->age . ' years. ' . $id->name . ' is ' . $id->height . ' cm high.';
      return view('Animal', ['message' => $message]);
    }
}
