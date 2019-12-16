<?php

namespace App\Http\Controllers;

use App\Tournament;
use App\Club;
use App\Gamer;
use App\GamerTournament;
use App\Couple;
use Illuminate\Http\Request;

class CouplesController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function addCouples($slug)
    {
        $tournament=Tournament::where('slug', $slug)->firstOrFail();
        $gamers_tournament=GamerTournament::where('tournament_id', $tournament->id)->count();
        $quotas=($tournament->groups*12)-$gamers_tournament;

        $gamers=Gamer::get();
        $num=0;
        foreach ($gamers as $gamer) {
            $count=Gamer::leftJoin('gamer_tournament', 'gamers.id', '=', 'gamer_tournament.gamer_id')->where('gamer_tournament.gamer_id', '=', $gamer->id)->where('gamer_tournament.tournament_id', '=', $tournament->id)->count();
            if ($count==0) {
                $data[$num]=['cupos' => $quotas, 'slug' => $gamer->slug, 'nombre_completo' => $gamer->name." ".$gamer->lastname];
                $num++;
            }
        }
        return response()->json($data);
    }

    public function addCouplesStore($slug, Request $request)
    {
        $tournament=Tournament::where('slug', $slug)->firstOrFail();
        $club=Club::where('slug', request('club'))->firstOrFail();
        $gamers=request('gamers');
        $gamer1=Gamer::where('slug', $gamers[0])->firstOrFail();
        $gamer2=Gamer::where('slug', $gamers[1])->firstOrFail();

        GamerTournament::create(['gamer_id' => $gamer1->id, 'tournament_id' => $tournament->id])->save();
        GamerTournament::create(['gamer_id' => $gamer2->id, 'tournament_id' => $tournament->id])->save();

        $couple=array('player1_id' => $gamer1->id, 'player2_id' => $gamer2->id, 'club_id' => $club->id);
        $couple=Couple::create($couple)->save();

        if ($couple) {
            return redirect()->back()->with(['type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'La pareja ha sido agregada al torneo exitosamente.']);
        } else {
            return redirect()->back()->with(['type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
