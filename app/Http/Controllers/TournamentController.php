<?php

namespace App\Http\Controllers;

use App\Tournament;
use App\Gamer;
use App\Club;
use App\GamerTournament;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\TournamentStoreRequest;
use App\Http\Requests\TournamentUpdateRequest;

class TournamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tournaments=Tournament::orderBy('id', 'DESC')->get();
        $clubs=Club::orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.tournaments.index', compact('tournaments', 'clubs', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tournaments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TournamentStoreRequest $request)
    {
        $count=Tournament::where('name', request('name'))->count();
        $slug=Str::slug(request('name'), '-');
        if ($count>0) {
            $slug=$slug.$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=Tournament::where('slug', $slug)->count();
            if ($count2>0) {
                $slug=$slug.$num;
                $num++;
            } else {
                $start=date('Y-m-d', strtotime(request('start')));
                $data=array('name' => request('name'), 'slug' => $slug, 'groups' => request('groups'), 'type' => request('type'), 'state' => request('state'), 'start' => $start );
                break;
            }
        }

        $tournament=Tournament::create($data)->save();
        if ($tournament) {
            return redirect()->route('torneos.index')->with(['type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El torneo ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('torneos.index')->with(['type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $tournament=Tournament::where('slug', $slug)->firstOrFail();
        $clubs=Club::orderBy('id', 'DESC')->get();
        return view('admin.tournaments.show', compact("tournament", "clubs"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $tournament=Tournament::where('slug', $slug)->firstOrFail();
        return view('admin.tournaments.edit', compact("tournament"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function update(TournamentUpdateRequest $request, $slug)
    {
        $tournament=Tournament::where('slug', $slug)->firstOrFail();
        $tournament->fill($request->all())->save();

        if ($tournament) {
            return redirect()->route('torneos.edit', ['slug' => $slug])->with(['type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El torneo ha sido editado exitosamente.']);
        } else {
            return redirect()->route('torneos.edit', ['slug' => $slug])->with(['type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $tournament=Tournament::where('slug', $slug)->firstOrFail();
        $tournament->delete();

        if ($tournament) {
            return redirect()->route('torneos.index')->with(['type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El torneo ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('torneos.index')->with(['type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function addGamers($slug)
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

    public function addGamersStore($slug, Request $request)
    {
        $tournament=Tournament::where('slug', $slug)->firstOrFail();
        $gamers=request('gamers');
        foreach ($gamers as $gamer) {
            $player=Gamer::where('slug', $gamer)->firstOrFail();
            $data=array('gamer_id' => $player->id, 'tournament_id' => $tournament->id);
            GamerTournament::create($data)->save();
        }

        return redirect()->back()->with(['type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'Los jugadores han sido agregados al torneo exitosamente.']);
    }
}
