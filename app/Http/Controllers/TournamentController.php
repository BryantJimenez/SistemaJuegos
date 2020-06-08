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
use App\Game;
use App\CoupleGame;
use App\CoupleGamer;
use App\Winner;
use App\GameWinner;
use App\TournamentWinner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Http\Requests\TournamentStoreRequest;
use App\Http\Requests\TournamentUpdateRequest;

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
                $data=$request->all();
                $data['start']=date('Y-m-d', strtotime(request('start')));
                $data['slug']=$slug;
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
        $groups=Group::where('tournament_id', $tournament->id)->where('phase_id', 1)->get();
        $semifinal=Group::where('tournament_id', $tournament->id)->where('phase_id', 2)->get();
        $final=Group::where('tournament_id', $tournament->id)->where('phase_id', 3)->get();

        $currentPhase=Group::select('phase_id')->where('tournament_id', $tournament->id)->orderBy('id', 'DESC')->first();
        $phase=Phase::where('id', 1)->first();

        if ($currentPhase!=NULL) {
            $couplesTotal=$tournament->couples;
            $gamesFinish=Group::join('games', 'games.group_id', '=', 'groups.id')->where('groups.phase_id', $currentPhase->phase_id)->where('groups.tournament_id', $tournament->id)->where('games.state', '=', 3)->count();
            $totalGames=$couplesTotal-1;
            for ($i=$totalGames-1; $i > 0; $i--) {
                $totalGames+=$i;
            }
            $totalGames=$totalGames*$tournament->groups;
        }

        if ($tournament->state==3) {
            $winners=TournamentWinner::where('tournament_id', $tournament->id)->get();
        }

        return view('admin.tournaments.show', compact("tournament", "clubs", "participants", "groups", "semifinal", "final", "totalGames", "gamesFinish", "currentPhase", "phase", "winners"));
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
        $gamers_tournament=$tournament->gamers->count();
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

    public function addGamersStore($slug, Request $request)
    {
        $tournament=Tournament::where('slug', $slug)->firstOrFail();
        $gamers=request('gamers');
        foreach ($gamers as $gamer) {
            $player=Gamer::where('slug', $gamer);
            if ($player->count()>0) {
                $player=$player->firstOrFail();
                $data=array('gamer_id' => $player->id, 'tournament_id' => $tournament->id);
                GamerTournament::create($data)->save();
            }
        }

        return redirect()->back()->with(['type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'Los jugadores han sido agregados al torneo exitosamente.']);
    }

    public function listGamers($slug)
    {
        $tournament=Tournament::where('slug', $slug)->firstOrFail(); 
        $num=1;
        return view('admin.tournaments.list-gamers', compact('tournament', 'num'));
    }

    public function start($slug)
    {
        $tournament=Tournament::where('slug', $slug)->firstOrFail();
        $gamersTournament=GamerTournament::select('gamer_id')->where('tournament_id', $tournament->id)->inRandomOrder()->get();

        $num=0;
        // Ciclo para crear los grupos
        for ($i=0; $i < $tournament->groups; $i++) {

            $group=$this->tournamentGroups($tournament->id, $tournament->groups);

            if ($tournament->type==1) {
                $loops=$this->tournamentNormalStart($num, $gamersTournament, $group, $tournament->couples);
                $num=$loops;
            } else {
                $loops=$this->tournamentClubStart($num, $tournament->id, $group, $tournament->couples);
                $num=$loops;
            }

            // Se crean los juegos de la primera vuelta
            $couples=CoupleGroup::where('group_id', $group)->get();

            // Se cuenta cuantas parejas hay en el grupo para saber cuantos juegos seran en la primera ronda
            if ($tournament->couples==3) {
                $countGame=Game::all()->count();
                $game=Game::create(['slug' => 'juego-'.$countGame, 'type' => 2, 'state' => 1, 'group_id' => $group, 'rond' => 1]);
                CoupleGame::create(['couple_id' => $couples[0]->id, 'game_id' => $game->id])->save();
                CoupleGame::create(['couple_id' => $couples[1]->id, 'game_id' => $game->id])->save();

                $countGame=Game::all()->count();
                $game=Game::create(['slug' => 'juego-'.$countGame, 'type' => 2, 'state' => 1, 'group_id' => $group, 'rond' => 1]);
                CoupleGame::create(['couple_id' => $couples[1]->id, 'game_id' => $game->id])->save();
                CoupleGame::create(['couple_id' => $couples[2]->id, 'game_id' => $game->id])->save();

                $countGame=Game::all()->count();
                $game=Game::create(['slug' => 'juego-'.$countGame, 'type' => 2, 'state' => 1, 'group_id' => $group, 'rond' => 1]);
                CoupleGame::create(['couple_id' => $couples[2]->id, 'game_id' => $game->id])->save();
                CoupleGame::create(['couple_id' => $couples[0]->id, 'game_id' => $game->id])->save();
            } else {
                if ($tournament->couples==6) {
                    $max=5;
                } elseif ($tournament->couples==5 || $tournament->couples==4) {
                    $max=3;
                } else {
                    $max=1;
                }
                for ($j=0; $j < $max; $j+=2) {
                    $countGame=Game::all()->count();
                    $game=Game::create(['slug' => 'juego-'.$countGame, 'type' => 2, 'state' => 1, 'group_id' => $group, 'rond' => 1]);
                    CoupleGame::create(['couple_id' => $couples[$j]->id, 'game_id' => $game->id])->save();
                    CoupleGame::create(['couple_id' => $couples[$j+1]->id, 'game_id' => $game->id])->save();
                }
            }
            
        }

        $tournament->fill(['state' => 2])->save();

        return redirect()->back()->with(['type' => 'success', 'title' => 'Torneo iniciado', 'msg' => 'El torneo ha sido iniciado exitosamente.']);
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

    public function tournamentNormalStart($num, $gamersTournament, $group, $couples)
    {
        // Ciclo para crear las parejas y agregarlas al grupo
        for ($j=0; $j < $couples; $j++) {
            $couple=Couple::create();

            for ($k=0; $k < 2; $k++) {
                $coupleGroup=CoupleGamer::create(['couple_id' => $couple->id, 'gamer_id' => $gamersTournament[$num+$k]->gamer_id]);
            }

            $coupleGroup=CoupleGroup::create(['couple_id' => $couple->id, 'group_id' => $group]);
            $num+=2;
        }

        return $num;
    }

    public function tournamentClubStart($num, $tournament, $group, $couples)
    {
        // Ciclo para crear las parejas y agregarlas al grupo
        $couplesTournament=GamerTournament::where('tournament_id', $tournament)->groupBy('couple_id')->get();
        for ($j=0; $j < $couples; $j++) {
            $couple=$couplesTournament[$num]->couple_id;
            $coupleGroup=CoupleGroup::create(['couple_id' => $couple, 'group_id' => $group]);
            $num++;
        }

        return $num;
    }

    public function phaseGroups($slug)
    {
        $tournament=Tournament::where('slug', $slug)->firstOrFail();
        $groups=Group::where('tournament_id', $tournament->id)->where('phase_id', 1)->get();
        $phase=Phase::where('id', 1)->first();

        $groupsCount=Group::where('tournament_id', $tournament->id)->where('phase_id', 1)->count();
        $groupsPhase=Group::where('tournament_id', $tournament->id)->groupBy('phase_id')->count();

        $couplesTotal=$tournament->couples;
        $gamesFinish=Game::join('groups', 'games.group_id', '=', 'groups.id')->where('groups.phase_id', 1)->where('games.state', 3)->count();
        $totalGames=$couplesTotal-1;
        for ($i=$totalGames-1; $i > 0; $i--) {
            $totalGames+=$i;
        }
        $totalGames=$totalGames*$tournament->groups;

        return view('admin.tournaments.groups', compact("tournament", "groups", "phase", "gamesFinish", "totalGames", "groupsCount", "groupsPhase"));
    }

    public function semifinal($slug)
    {
        $tournament=Tournament::where('slug', $slug)->firstOrFail();
        $groups=Group::where('tournament_id', $tournament->id)->where('phase_id', 2)->get();
        $phase=Phase::where('id', 2)->first();

        $groupsCount=Group::where('tournament_id', $tournament->id)->where('phase_id', 2)->count();
        $groupsPhase=Group::where('tournament_id', $tournament->id)->groupBy('phase_id')->count();

        $groupsPhases=Group::groupBy('phase_id')->count();
        if ($groupsPhases==1) {
            $couplesTotal=$tournament->couples;
        } else {
            $group=Group::where('tournament_id', $tournament->id)->where('phase_id', 2)->firstOrFail();
            $couplesTotal=$group->couples->count();
        }
        $gamesFinish=Game::join('groups', 'games.group_id', '=', 'groups.id')->where('groups.phase_id', 2)->where('games.state', 3)->count();
        $totalGames=$couplesTotal-1;
        for ($i=$totalGames-1; $i > 0; $i--) {
            $totalGames+=$i;
        }
        $totalGames=$totalGames*2;
        
        return view('admin.tournaments.groups', compact("tournament", "groups", "phase", "gamesFinish", "totalGames", "groupsCount", "groupsPhase"));
    }

    public function finale($slug)
    {
        $tournament=Tournament::where('slug', $slug)->firstOrFail();
        $groups=Group::where('tournament_id', $tournament->id)->where('phase_id', 3)->get();
        $phase=Phase::where('id', 3)->first();

        $groupsCount=Group::where('tournament_id', $tournament->id)->where('phase_id', 3)->count();
        $groupsPhase=Group::where('tournament_id', $tournament->id)->groupBy('phase_id')->count();

        $couplesTotal=$groups[0]->couples->count();
        $gamesFinish=Game::where('group_id', $groups[0]->id)->where('state', 3)->count();
        $totalGames=$couplesTotal-1;
        for ($i=$totalGames-1; $i > 0; $i--) {
            $totalGames+=$i;
        }

        return view('admin.tournaments.groups', compact("tournament", "groups", "phase", "gamesFinish", "totalGames", "groupsCount", "groupsPhase"));
    }

    public function group($slug, $phase, $group)
    {
        $tournament=Tournament::where('slug', $slug)->firstOrFail();
        $phase=Phase::where('slug', $phase)->firstOrFail();
        $groups=Group::where('slug', $group)->where('tournament_id', $tournament->id)->firstOrFail();

        $data=Group::join('games', 'games.group_id', '=', 'groups.id')->where('groups.tournament_id', $tournament->id)->where('groups.phase_id', $phase->id)->where('groups.slug', $group)->get();

        $count=0;
        $games=[];
        foreach ($data as $game) {
            $game=Game::where('id', $game->id)->get();
            $games[$count]=$game[0];
            $count++;
        }
        $num=1;

        $couplesTotal=$groups->couples->count();
        $gamesFinish=Game::where('group_id', $groups->id)->where('state', 3)->count();
        $totalGames=$couplesTotal-1;
        for ($i=$totalGames-1; $i > 0; $i--) {
            $totalGames+=$i;
        }
        $ronds=Game::where('group_id', $groups->id)->groupBy('rond')->get();
        $ronds=count($ronds);
        $gamesRonds=$couplesTotal/2*$ronds;

        return view('admin.tournaments.group', compact("tournament", "groups", "phase", "games", "num", "couplesTotal", "gamesFinish", "totalGames", "gamesRonds"));
    }

    public function game($slug)
    {
        $game=Game::where('slug', $slug)->firstOrFail();
        $couple1=$game->couples[0]->gamers[0]->name." ".$game->couples[0]->gamers[0]->lastname."<br>".$game->couples[0]->gamers[1]->name." ".$game->couples[0]->gamers[1]->lastname;
        $couple2=$game->couples[1]->gamers[0]->name." ".$game->couples[1]->gamers[0]->lastname."<br>".$game->couples[1]->gamers[1]->name." ".$game->couples[1]->gamers[1]->lastname;
        echo json_encode([
            'couple1' => $couple1,
            'couple2' => $couple2,
            'points1' => $game->couple_game[0]->points,
            'points2' => $game->couple_game[1]->points
        ]);
    }

    public function gameStore($slug, Request $request)
    {
        $game=Game::where('slug', $slug)->firstOrFail();
        $coupleGame1=CoupleGame::where('id', $game->couple_game[0]->id)->first();
        $coupleGame2=CoupleGame::where('id', $game->couple_game[1]->id)->first();
        $coupleGame1->fill(['points' => request('points1')])->save();
        $coupleGame2->fill(['points' => request('points2')])->save();

        if (request('points1')==2 || request('points2')==2) {
            $winner=Winner::create(['type' => 2]);
            if (request('points1')==2) {
                GameWinner::create(['game_id' => $game->id, 'couple_id' => $game->couple_game[0]->couple_id, 'winner_id' => $winner->id]);
            } else {
                GameWinner::create(['game_id' => $game->id, 'couple_id' => $game->couple_game[1]->couple_id, 'winner_id' => $winner->id]);
            }
            $game->fill(['state' => 3])->save();
        } else {
            $game->fill(['state' => 2])->save();
        }

        if ($coupleGame1 && $coupleGame2) {
            return redirect()->back()->with(['type' => 'success', 'title' => 'Juego registrado', 'msg' => 'El juego del torneo ha sido registrado exitosamente.']);
        } else {
            return redirect()->back()->with(['type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function nextRond($slug, Request $request)
    {
        $tournament=Tournament::where('slug', $slug)->firstOrFail();
        $phase=Phase::where('slug', request('phase'))->firstOrFail();
        $groups=Group::where('slug', request('group'))->where('tournament_id', $tournament->id)->where('phase_id', $phase->id)->firstOrFail();

        // Obtengo a las parejas del grupo
        $couples=Couple::join('couple_group', 'couples.id', '=', 'couple_group.couple_id')->where('couple_group.group_id', $groups->id);
        $couplesCount=$couples->count();
        $couples=$couples->get();

        $couplesArray=array();
        for ($i=0; $i < $couplesCount; $i++) { 
            $couplesArray=Arr::add($couplesArray, $i, $couples[$i]->couple_id);
        }

        // Obtengo a la ronda del grupo
        $rond=Game::where('group_id', $groups->id)->groupBy('rond')->get();
        $rond=count($rond)+1;

        // Empieza el emparejamiento
        for ($i=0; $i < $couplesCount; $i+=2) {

            // Parejas
            $couplesArrayVs=$couplesArray;

            $coupleCount=count($couplesArrayVs);
            for ($j=0; $j < $coupleCount; $j++) { 
                // Obtengo a la cantidad de juegos de la pareja
                $coupleGamesTotalCount=CoupleGame::join('games', 'couple_game.game_id', '=', 'games.id')->where('games.group_id', $groups->id)->where('couple_game.couple_id', $couplesArrayVs[$j])->count();

                if ($coupleGamesTotalCount>=$coupleCount-1) {
                    // Quito a las parejas que ya jugaron todos sus juegos del arreglo de parejas para el emparejamiento
                    $key=array_search($couplesArrayVs[$j], $couplesArrayVs);
                    unset($couplesArrayVs[$key]);
                }
            }
            
            // Obtengo a las parejas del grupo que ya tienen juegos en esta ronda
            $coupleGames=CoupleGame::join('games', 'couple_game.game_id', '=', 'games.id')->where('games.group_id', $groups->id)->where('games.rond', $rond)->get();
            $coupleGamesCount=$coupleGames->count();

            $coupleGame=array();
            for ($j=0; $j < $coupleGamesCount; $j++) { 
                $coupleGame=Arr::add($coupleGame, $j, $coupleGames[$j]->couple_id);
            }

            // Quito a las parejas con juegos del arreglo de parejas para el emparejamiento
            foreach ($coupleGame as $coupleGam) {
                $key=array_search($coupleGam, $couplesArrayVs);
                unset($couplesArrayVs[$key]);
            }

            // Selecciono a la primera pareja de juego
            $coupleSelected=current($couplesArrayVs);
            $coupleSelectedKey=array_search($coupleSelected, $couplesArrayVs);
            unset($couplesArrayVs[$coupleSelectedKey]);

            // Obtengo a las parejas del grupo que ya han jugado contra la primera pareja seleccionada
            $coupleSelectedGames=Game::join('couple_game', 'couple_game.game_id', '=', 'games.id')->where('games.group_id', $groups->id)->where('couple_game.couple_id', $coupleSelected)->get();
            $coupleSelectedGamesCount=$coupleSelectedGames->count();

            for ($j=0; $j < $coupleSelectedGamesCount; $j++) {
                $gameCouples=CoupleGame::where('game_id', $coupleSelectedGames[$j]->game_id);
                $gameCouplesCount=$gameCouples->count();
                $gameCouples=$gameCouples->get();

                // Quito a las parejas con quienes ha jugado del arreglo de parejas para el emparejamiento
                for ($k=0; $k < $gameCouplesCount; $k++) { 
                    if ($gameCouples[$k]->couple_id!=$coupleSelected) {
                        $key=array_search($gameCouples[$k]->couple_id, $couplesArrayVs);
                        unset($couplesArrayVs[$key]);
                    }
                }  
            }

            if (count($couplesArrayVs)>0) {
                // Selecciono a la segunda pareja de juego
                $CoupleVs=Arr::first($couplesArrayVs, function ($value, $key) {
                    return $value > 0;
                });

                // Registro el juego
                $countGame=Game::all()->count();
                $game=Game::create(['slug' => 'juego-'.$countGame, 'type' => 2, 'state' => 1, 'group_id' => $groups->id, 'rond' => $rond]);
                CoupleGame::create(['couple_id' => $coupleSelected, 'game_id' => $game->id])->save();
                CoupleGame::create(['couple_id' => $CoupleVs, 'game_id' => $game->id])->save();
            } else {
                // Parejas
                $newCouplesArrayVs=$couplesArray;

                $coupleSelectedKey=array_search($coupleSelected, $newCouplesArrayVs);
                unset($newCouplesArrayVs[$coupleSelectedKey]);

                for ($j=0; $j < $coupleSelectedGamesCount; $j++) {
                    $gameCouples=CoupleGame::where('game_id', $coupleSelectedGames[$j]->game_id);
                    $gameCouplesCount=$gameCouples->count();
                    $gameCouples=$gameCouples->get();

                    // Quito a las parejas con quienes ha jugado del arreglo de parejas para el emparejamiento
                    for ($k=0; $k < $gameCouplesCount; $k++) { 
                        if ($gameCouples[$k]->couple_id!=$coupleSelected) {
                            $key=array_search($gameCouples[$k]->couple_id, $newCouplesArrayVs);
                            unset($newCouplesArrayVs[$key]);
                        }
                    }
                }

                // Selecciono a la segunda pareja de juego
                $CoupleVs=Arr::first($newCouplesArrayVs, function ($value, $key) {
                    return $value >= 0;
                });

                // Registro el juego
                $countGame=Game::all()->count();
                $game=Game::create(['slug' => 'juego-'.$countGame, 'type' => 2, 'state' => 1, 'group_id' => $groups->id, 'rond' => $rond]);
                CoupleGame::create(['couple_id' => $coupleSelected, 'game_id' => $game->id])->save();
                CoupleGame::create(['couple_id' => $CoupleVs, 'game_id' => $game->id])->save();
            }
        }

        return redirect()->back()->with(['type' => 'success', 'title' => 'Nueva ronda', 'msg' => 'La nueva ronda del grupo a sido iniciada exitosamente.']);
    }

    public function nextPhase($slug, Request $request)
    {
        $tournament=Tournament::where('slug', $slug)->firstOrFail();
        $phase=Phase::where('slug', request('phase'))->firstOrFail();
        $groups=Group::where('phase_id', $phase->id)->where('tournament_id', $tournament->id)->inRandomOrder()->get();

        $count=0;
        // Obteniendo las parejas por grupos
        foreach ($groups as $group) {
            $groupCouples=$group->couples;

            $count2=0;
            // Obteniendo las puntuaciones de cada parejas
            foreach ($groupCouples as $groupCouple) {
                $points=CoupleGame::join('games', 'couple_game.game_id', '=', 'games.id')->where('couple_game.couple_id', $groupCouple->id)->groupBy('couple_game.couple_id')->sum('couple_game.points');
                $couplesPoints[$count2]=array('couple_id' => $groupCouple->id, 'points' => $points);
                $count2++;
            }

            usort($couplesPoints, function($a, $b) {
                return $a['points'] - $b['points'];
            });
            $couplesPointsOrder=array_reverse($couplesPoints);

            $couplesWinners[$count]=$couplesPointsOrder[0];
            $couplesWinners[$count+1]=$couplesPointsOrder[1];
            
            $count+=2;
        }

        $num=0;
        if (count($couplesWinners)>6) {
            $groupsNewPhase=2;
        } else {
            $groupsNewPhase=1;
        }
        // Ciclo para crear los grupos
        for ($i=0; $i < $groupsNewPhase; $i++) {

            $group=$this->tournamentGroups($tournament->id, $groupsNewPhase);

            // Se crean los juegos de la primera vuelta
            $couples=$couplesWinners;

            // Ciclo para crear las parejas y agregarlas al grupo
            for ($j=0; $j < count($couplesWinners)/$groupsNewPhase; $j++) {
                CoupleGroup::create(['couple_id' => $couples[$num]['couple_id'], 'group_id' => $group]);
                $num++;
            }

            // Se cuenta cuantas parejas hay en el grupo para saber cuantos juegos seran en la primera ronda
            if (count($couples)==3) {
                $countGame=Game::all()->count();
                $game=Game::create(['slug' => 'juego-'.$countGame, 'type' => 2, 'state' => 1, 'group_id' => $group, 'rond' => 1]);
                CoupleGame::create(['couple_id' => $couples[0]['couple_id'], 'game_id' => $game->id])->save();
                CoupleGame::create(['couple_id' => $couples[1]['couple_id'], 'game_id' => $game->id])->save();

                $countGame=Game::all()->count();
                $game=Game::create(['slug' => 'juego-'.$countGame, 'type' => 2, 'state' => 1, 'group_id' => $group, 'rond' => 1]);
                CoupleGame::create(['couple_id' => $couples[1]['couple_id'], 'game_id' => $game->id])->save();
                CoupleGame::create(['couple_id' => $couples[2]['couple_id'], 'game_id' => $game->id])->save();

                $countGame=Game::all()->count();
                $game=Game::create(['slug' => 'juego-'.$countGame, 'type' => 2, 'state' => 1, 'group_id' => $group, 'rond' => 1]);
                CoupleGame::create(['couple_id' => $couples[2]['couple_id'], 'game_id' => $game->id])->save();
                CoupleGame::create(['couple_id' => $couples[0]['couple_id'], 'game_id' => $game->id])->save();
            } else {
                if (count($couples)==6) {
                    $max=5;
                } elseif (count($couples)==5 || count($couples)==4) {
                    $max=3;
                } else {
                    $max=1;
                }
                for ($j=0; $j < $max; $j+=2) {
                    $countGame=Game::all()->count();
                    $game=Game::create(['slug' => 'juego-'.$countGame, 'type' => 2, 'state' => 1, 'group_id' => $group, 'rond' => 1]);
                    CoupleGame::create(['couple_id' => $couples[$j]['couple_id'], 'game_id' => $game->id])->save();
                    CoupleGame::create(['couple_id' => $couples[$j+1]['couple_id'], 'game_id' => $game->id])->save();
                }
            }

        }

        return redirect()->back()->with(['type' => 'success', 'title' => 'Nueva fase', 'msg' => 'La nueva fase del torneo a sido iniciada exitosamente.']);
    }

    public function finalTournament($slug)
    {
        $tournament=Tournament::where('slug', $slug)->firstOrFail();
        $group=Group::where('phase_id', 3)->where('tournament_id', $tournament->id)->firstOrFail();

        $groupCouples=$group->couples;

        $count=0;
        foreach ($groupCouples as $groupCouple) {
            $points=CoupleGame::join('games', 'couple_game.game_id', '=', 'games.id')->where('couple_game.couple_id', $groupCouple->id)->where('games.group_id', $group->id)->groupBy('couple_game.couple_id')->sum('couple_game.points');
            $couplesPoints[$count]=array('couple_id' => $groupCouple->id, 'points' => $points);
            $count++;
        }

        usort($couplesPoints, function($a, $b) {
            return $a['points'] - $b['points'];
        });
        $couplesPointsOrder=array_reverse($couplesPoints);

        $couplesWinners[0]=$couplesPointsOrder[0];
        $couplesWinners[1]=$couplesPointsOrder[1];

        $firstPlaseWinner=Winner::create(['type' => 2, 'position' => 1]);
        $secondPlaseWinner=Winner::create(['type' => 2, 'position' => 2]);

        TournamentWinner::create(['couple_id' => $couplesWinners[0]['couple_id'], 'tournament_id' => $tournament->id, 'winner_id' => $firstPlaseWinner->id]);
        TournamentWinner::create(['couple_id' => $couplesWinners[1]['couple_id'], 'tournament_id' => $tournament->id, 'winner_id' => $secondPlaseWinner->id]);

        $tournament->fill(['state' => 3, 'end' => now()])->save();

        return redirect()->route('torneos.show', ['slug' => $slug])->with(['type' => 'success', 'title' => 'Torneo finalizado', 'msg' => 'El torneo ha finalizado exitosamente.']);
    }
}