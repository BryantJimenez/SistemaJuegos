<?php

namespace App\Http\Controllers;

use App\Tournament;
use App\Gamer;
use App\Club;
use App\Group;
use App\Phase;
use App\Couple;
use App\CoupleGroup;
use App\GamerTournament;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\TourtamentStoreRequest;

class TournamentController extends Controller
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
    public function store(Request $request)
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
        $participants=GamerTournament::where('tournament_id', $tournament->id)->count();
        return view('admin.tournaments.show', compact("tournament", "clubs", "participants"));
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
    public function update(Request $request, $slug)
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

        // Agregar jugadores al arreglo
        $gamers=Gamer::get();
        $num=0;
        foreach ($gamers as $gamer) {
            // Se busca si el jugador ya ha sido agregado al torneo
            $count=Gamer::leftJoin('gamer_tournament', 'gamers.id', '=', 'gamer_tournament.gamer_id')->where('gamer_tournament.gamer_id', '=', $gamer->id)->where('gamer_tournament.tournament_id', '=', $tournament->id)->count();

            // Si no ha sido agregado es ingresado en el arreglo
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

    public function listGamers($slug)
    {
        //

    }

    public function listCouples($slug)
    {
        //
    }

    public function start($slug)
    {
        $tournament=Tournament::where('slug', $slug)->firstOrFail();
        $gamersTournament=GamerTournament::where('tournament_id', $tournament->id)->inRandomOrder()->get();

        dd($gamersTournament[0]->gamer_id);

        $num=0;
        // Ciclo para crear los grupos
        for ($i=0; $i < $tournament->groups-1; $i++) {

            $group=$this->tournamentGroups($tournament->id, $tournament->groups);

            if ($tournament->type=="Normal") {
                $this->tournamentNormalStart($num, $gamersTournament, $group);
            } else {

            }

        }

    }

    public function tournamentGroups($id, $groups)
    {
        $count=Group::where('tournament_id', $id)->count();
        $name="Grupo ".($count+1);
        $slug=Str::slug($name, '-');
        if ($groups>2) {
            $data=array('name' => $name, 'slug' => $slug, 'tournament_id' => $id, 'phase_id' => 1);
        } elseif ($groups==2) {
            $data=array('name' => $name, 'slug' => $slug, 'tournament_id' => $id, 'phase_id' => 2);
        } else {
            $data=array('name' => $name, 'slug' => $slug, 'tournament_id' => $id, 'phase_id' => 3);
        }
        $group=Group::create($data);

        return $group->id;
    }

    public function tournamentNormalStart($num, $gamersTournament, $group)
    {
        // Ciclo para crear las parejas y agregarlas al grupo
        for ($j=0; $j < 5; $j++) {
            $data=array('player1_id' => $gamersTournament[$num]->gamer_id, 'player2_id' => $gamersTournament[$num+1]->gamer_id);
            $couple=Couple::create($data);

            $coupleGroup=CoupleGroup::create(['couple_id' => $couple->id, 'group_id' => $group]);
            $num+=2;
        }
    }

    public function tournamentClubStart()
    {
        // Ciclo para seleccionar las parejas y agregarlas al grupo
        for ($j=0; $j < 5; $j++) {
            
            $coupleGroup=CoupleGroup::create(['couple_id' => $couple->id, 'group_id' => $group]);
            $num+=2;
        }
    }
}
