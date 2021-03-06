<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMatch;
use App\Http\Requests\PlayerNames;
use App\Match;
use App\Team;
use App\Player;
use App\Events\MatchUpdated;
use App\Library\ScoreBoardCalculator;

class MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth', ['only' => ['create', 'store']]);
    }

    public function index()
    {


        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('match.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMatch $request)
    {
        $match = Match::create([
            'user_id' => Auth::user()->user_id,
            'over' => $request->total_over,
            'location' => $request->location,
            'start_time' => $request->match_time,
            'player_total' => $request->total_player
        ]);
        $teams = [
            new Team(['team_name' => $request->team1]),
            new Team(['team_name' => $request->team2])
        ];
        $match_add = Match::find($match->match_id);
        $teams = $match_add->teams()->saveMany($teams);
        return redirect('/match/' . $match->match_id . '/addplayer');
    }

    public function storePlayers(PlayerNames $request)
    {
        $match_id = $request->route('id');
        $teams = Match::where('match_id', '=', $match_id)->with('teams')->first();
        $team1 = Team::find($teams->teams[0]->team_id);
        $team2 = Team::find($teams->teams[1]->team_id);

        $count_players = 0;
        for ($j = 1; $j<=2; $j++) {
            for ($i = 1; $i <= $teams->player_total * 2; $i++) {
                $var_player = 'p_t' . $j . '_' . $i;
                if ($request->$var_player != "" || $request->$var_player != null) {
                    $count_players++;
                }
            }
        }

        if ($count_players != $teams->player_total * 2) {
            abort('404');
        }

        for ($i = 1; $i <= $teams->player_total; $i++) {
            $player_number = 'p_t1_' . $i;
            $jersey = 'jersey_t1_' . $i;
            $player = new Player(['player_name' => $request->$player_number, 'jersey' => $request->$jersey]);
            $team1->players()->save($player);
        }
        for ($i = 1; $i <= $teams->player_total; $i++) {
            $player_number = 'p_t2_' . $i;
            $jersey = 'jersey_t2_' . $i;
            $player = new Player(['player_name' => $request->$player_number, 'jersey' => $request->$jersey]);
            $team2->players()->save($player);
        }

        return redirect('/view/' . $match_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('match.details');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function addPlayers($id)
    {

        $match = Match::where('match_id', '=', $id)->with('teams')->first();
        return view('match.add_players', compact('match', $match));

    }

    public function matchDetails()
    {
        return view('match.details');
    }

    public function viewMatch($id)
    {
        $match_data = Match::where('match_id', '=', $id)->with('teams')->get();
        $team1_players = Player::where('team_id', '=', $match_data[0]->teams[0]->team_id)->get();
        $team2_players = Player::where('team_id', '=', $match_data[0]->teams[1]->team_id)->get();
        $players = [
            'team1' => $team1_players,
            'team2' => $team2_players
        ];
        $match = [
            'data' => $match_data,
            'players' => $players
        ];
        return view('match.admin.details')->with('match', $match);
    }

    public function showScoreBoard($id)
    {
        $scores_ob = new ScoreBoardCalculator($id);
        $scores_ob->getInnings();
        $scores_ob->inningsData();
        return view('scoreboard')->with('scores', $scores_ob->scores)->with('match_data', $scores_ob->match_data);
        //return $scores_ob->scores;
    }

}
