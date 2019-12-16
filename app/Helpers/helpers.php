<?php

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