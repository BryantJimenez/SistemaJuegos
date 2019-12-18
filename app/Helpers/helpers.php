<?php

use App\CoupleGroup;

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

function gameType($state) {
	if ($state==1) {
		return 'Slam';
	} else {
		return 'Torneo';
	} 
}

function coupleNames($id) {
	$gamer1=CoupleGroup::join('couples', 'couples.id', '=', 'couple_group.couple_id')->join('gamers', 'gamers.id', '=', 'couples.player1_id')->where('couple_group.id', $id)->first();
	$gamer2=CoupleGroup::join('couples', 'couples.id', '=', 'couple_group.couple_id')->join('gamers', 'gamers.id', '=', 'couples.player2_id')->where('couple_group.id', $id)->first();
	if ($gamer1->count()>0) {
		$gamer1=$gamer1->name." ".$gamer1->lastname;
	} else {
		$gamer1="Desconocido";
	}

	if ($gamer2->count()>0) {
		$gamer2=$gamer2->name." ".$gamer2->lastname;
	} else {
		$gamer2="Desconocido";
	}

	return $gamer1."<br>".$gamer2;
}