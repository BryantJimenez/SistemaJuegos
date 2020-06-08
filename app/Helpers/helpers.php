<?php

use App\Couple;

function userState($state) {
	if ($state==1) {
		return '<span class="badge badge-success">Activo</span>';
	} elseif ($state==2) {
		return '<span class="badge badge-danger">Inactivo</span>';
	} else {
		return '<span class="badge badge-primary">Desconocido</span>';
	}
}

function tournamentState($state) {
	if ($state==1) {
		return '<span class="badge badge-success">Pendiente</span>';
	} elseif ($state==2) {
		return '<span class="badge badge-warning">En Progreso</span>';
	} elseif ($state==3) {
		return '<span class="badge badge-danger">Finalizado</span>';
	} else {
		return '<span class="badge badge-primary">Desconocido</span>';
	}
}

function gameState($state) {
	if ($state==1) {
		return '<span class="badge badge-success">Pendiente</span>';
	} elseif ($state==2) {
		return '<span class="badge badge-warning">En Progreso</span>';
	} elseif ($state==3) {
		return '<span class="badge badge-danger">Finalizado</span>';
	} else {
		return '<span class="badge badge-primary">Desconocido</span>';
	}
}

function tournamentType($type) {
	if ($type==1) {
		return 'Normal';
	} elseif ($type==2) {
		return 'Interclubes';
	} else {
		return 'Desconocido';
	}
}

function gameType($type) {
	if ($type==1) {
		return 'Slam';
	} else {
		return 'Torneo';
	} 
}

function couplesNames($coupleArray, $coupleSelected, $simple=null) {
	if ($coupleSelected==1) {
		$couple=Couple::where('id', $coupleArray[0]->id)->firstOrFail();
		if ($simple==1) {
			$coupleNames=substr($couple->gamers[0]->name, 0, 1).". ".$couple->gamers[0]->lastname."<br>".substr($couple->gamers[1]->name, 0, 1).". ".$couple->gamers[1]->lastname;
		} else {
			$coupleNames=$couple->gamers[0]->name." ".$couple->gamers[0]->lastname."<br>".$couple->gamers[1]->name." ".$couple->gamers[1]->lastname;
		}
		return $coupleNames;
	} elseif ($coupleSelected==2) {
		$couple=Couple::where('id', $coupleArray[1]->id)->firstOrFail();
		if ($simple==1) {
			$coupleNames=substr($couple->gamers[0]->name, 0, 1).". ".$couple->gamers[0]->lastname."<br>".substr($couple->gamers[1]->name, 0, 1).". ".$couple->gamers[1]->lastname;
		} else {
			$coupleNames=$couple->gamers[0]->name." ".$couple->gamers[0]->lastname."<br>".$couple->gamers[1]->name." ".$couple->gamers[1]->lastname;
		}
		return $coupleNames;
	} else {
		$couple=Couple::where('id', $coupleArray->id)->firstOrFail();
		$coupleNames=$couple->gamers[0]->name." ".$couple->gamers[0]->lastname."<br>".$couple->gamers[1]->name." ".$couple->gamers[1]->lastname;
		return $coupleNames;
	}
}