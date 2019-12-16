<?php

namespace App\Http\Controllers;

use App\Game;
use App\Gamer;
use App\Couple;
use App\CoupleGroup;
use App\CoupleGame;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games=Game::orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.games.index', compact('games', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gamers=Gamer::all();
        return view('admin.games.create', compact('gamers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $couple1=request('couple1');
        $gamer1=Gamer::where('slug', $couple1[0])->firstOrFail();
        $gamer2=Gamer::where('slug', $couple1[1])->firstOrFail();

        $couple2=request('couple2');
        $gamer3=Gamer::where('slug', $couple2[0])->firstOrFail();
        $gamer4=Gamer::where('slug', $couple2[1])->firstOrFail();

        $coupleArray1=array('player1_id' => $gamer1->id, 'player2_id' => $gamer2->id);
        Couple::create($coupleArray1)->save();
        $couples1=Couple::orderBy('id', 'DESC')->first();
        $coupleArray2=array('player1_id' => $gamer3->id, 'player2_id' => $gamer4->id);
        Couple::create($coupleArray2)->save();
        $couples2=Couple::orderBy('id', 'DESC')->first();

        CoupleGroup::create(['couple_id' => $couples1->id])->save();
        $coupleGroup1=CoupleGroup::orderBy('id', 'DESC')->first();
        CoupleGroup::create(['couple_id' => $couples2->id])->save();
        $coupleGroup2=CoupleGroup::orderBy('id', 'DESC')->first();

        $count=Game::all()->count();
        if (request('points1')==2 || request('points2')==2) {
            $state=3;
        } else {
            $state=2;
        }

        $data=array('slug' => 'juego-'.$count, 'type' => 1, 'state' => $state, 'points1' => request('points1'), 'points2' => request('points2'));
        Game::create($data)->save();
        $game=Game::orderBy('id', 'DESC')->first();

        $coupleGame=CoupleGame::create(['couple_group1_id' => $coupleGroup1->id, 'couple_group2_id' => $coupleGroup2->id, 'game_id' => $game->id])->save();

        if ($coupleGame) {
            return redirect()->route('juegos.index')->with(['type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El juego ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('juegos.index')->with(['type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        //
    }
}
