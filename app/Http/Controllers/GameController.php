<?php

namespace App\Http\Controllers;

use App\Game;
use App\Gamer;
use App\Couple;
use App\CoupleGroup;
use App\CoupleGame;
use Illuminate\Http\Request;
<<<<<<< HEAD
use Illuminate\Http\Requests\GameStoreRequest;
use Illuminate\Http\Requests\GameUpdateRequest;
=======
use App\Http\Requests\GameStoreRequest;
use App\Http\Requests\GameUpdateRequest;
>>>>>>> 73819eaace1725a56f54796063036388980c38c2
 
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
    public function store(GameStoreRequest $request)
    {
        $couple1=request('couple1');
        $gamer1=Gamer::where('slug', $couple1[0])->firstOrFail();
        $gamer2=Gamer::where('slug', $couple1[1])->firstOrFail();

        $couple2=request('couple2');
        $gamer3=Gamer::where('slug', $couple2[0])->firstOrFail();
        $gamer4=Gamer::where('slug', $couple2[1])->firstOrFail();

        $coupleArray1=array('player1_id' => $gamer1->id, 'player2_id' => $gamer2->id);
        $couples1=Couple::create($coupleArray1);
        $coupleArray2=array('player1_id' => $gamer3->id, 'player2_id' => $gamer4->id);
        $couples2=Couple::create($coupleArray2);

        $coupleGroup1=CoupleGroup::create(['couple_id' => $couples1->id]);
        $coupleGroup2=CoupleGroup::create(['couple_id' => $couples2->id]);

        $count=Game::all()->count();
        if (request('points1')==2 || request('points2')==2) {
            $state=3;
        } else {
            $state=2;
        }

        $data=array('slug' => 'juego-'.$count, 'type' => 1, 'state' => $state, 'points1' => request('points1'), 'points2' => request('points2'));
        $game=Game::create($data);

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
        $game=Game::where('slug', $slug)->firstOrFail();
        echo json_encode([
            'type' => $game->type,
            'state' => gameType($game->state),
            'points1' => $game->points1,
            'points2' => $game->points2
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $game=Game::where('slug', $slug)->firstOrFail();
        return view('admin.games.edit', compact("game"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(GameUpdateRequest $request, $slug)
    {
        $game=Game::where('slug', $slug)->firstOrFail();
        $game->fill($request->all())->save();

        if ($game) {
            return redirect()->route('juegos.edit', ['slug' => $slug])->with(['type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El Juego ha sido editado exitosamente.']);
        } else {
            return redirect()->route('juegos.edit', ['slug' => $slug])->with(['type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $game=Game::where('slug', $slug)->firstOrFail();
        $game->delete();

        if ($game) {
            return redirect()->route('juegos.index')->with(['type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El juego ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('juegos.index')->with(['type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
