<?php

namespace App\Http\Controllers;

use App\Tournament;
use App\Club;
use App\Gamer;
use App\GamerTournament;
use App\Couple;
use App\CoupleGamer;
use Illuminate\Http\Request;

class CouplesController extends Controller
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
        $quotas=($tournament->groups*$tournament->couples*2)-$gamers_tournament; 

        // Agregar jugadores al arreglo
        $gamers=Gamer::get();
        $num=0;
        foreach ($gamers as $gamer) {
            // Se busca si el jugador ya ha sido agregado al torneo
            $count=GamerTournament::where('gamer_id', '=', $gamer->id)->where('tournament_id', '=', $tournament->id)->count();

            // Si no ha sido agregado es ingresado en el arreglo
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

        $couple=Couple::create(['club_id' => $club->id]);
        $couple1=CoupleGamer::create(['couple_id' => $couple->id, 'gamer_id' => $gamer1->id])->save();
        $couple2=CoupleGamer::create(['couple_id' => $couple->id, 'gamer_id' => $gamer2->id])->save();

        GamerTournament::create(['gamer_id' => $gamer1->id, 'tournament_id' => $tournament->id, 'couple_id' => $couple->id])->save();
        GamerTournament::create(['gamer_id' => $gamer2->id, 'tournament_id' => $tournament->id, 'couple_id' => $couple->id])->save();

        if ($couple1 && $couple2) {
            return redirect()->back()->with(['type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'La pareja ha sido agregada al torneo exitosamente.']);
        } else {
            return redirect()->back()->with(['type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
