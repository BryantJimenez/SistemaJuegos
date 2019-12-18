@extends('layouts.admin')

@section('title', $phase->name." - ".$groups->name)
@section('page-title', $phase->name." - ".$groups->name)

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('torneos.index') }}">Torneos</a></li>
<li class="breadcrumb-item"><a href="{{ route('torneos.show', ['slug' => $tournament->slug]) }}">{{ $tournament->name }}</a></li>
@if($phase->slug=='fase-de-grupos')
<li class="breadcrumb-item"><a href="{{ route('torneos.phase.groups', ['slug' => $tournament->slug]) }}">{{ $phase->name }}</a></li>
@elseif($phase->slug=='semifinal')
<li class="breadcrumb-item"><a href="{{ route('torneos.phase.semifinal', ['slug' => $tournament->slug]) }}">{{ $phase->name }}</a></li>
@else
<li class="breadcrumb-item"><a href="{{ route('torneos.phase.final', ['slug' => $tournament->slug]) }}">{{ $phase->name }}</a></li>
@endif
<li class="breadcrumb-item active">{{ $groups->name }}</li>
@endsection

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/lobibox/Lobibox.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendors/touchspin/jquery.bootstrap-touchspin.min.css') }}">
@endsection

@section('content')

<div class="row">
	<div class="col-12">
		@foreach($games as $game)
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-12 text-center">
						<p class="h3">Juego {{ $num++ }}</p>
					</div>
					<div class="col-12">
						<div class="row d-flex-wrap-center">
							<div class="col-4 text-center">
								<p class="h4">Pareja 1</p>
								<p><b>{!! coupleNames($game->couple_group1_id) !!}</b></p>
							</div>
							<div class="col-1 text-center">
								<p class="h1">{{ $game->points1 }}</p>
							</div>
							<div class="col-1 text-center">
								<p class="h1">-</p>
							</div>
							<div class="col-1 text-center">
								<p class="h1">{{ $game->points2 }}</p>
							</div>
							<div class="col-4 text-center">
								<p class="h4">Pareja 2</p>
								<p><b>{!! coupleNames($game->couple_group2_id) !!}</b></p>
							</div>
						</div>
					</div>
					@if(2>$game->points1 && 2>$game->points2)
					<div class="col-12 text-center">
						<button class="btn btn-primary" onclick="addGame('{{ $game->slug }}')">Jugar</button>
					</div>
					@endif
				</div>
			</div>
		</div>
		@endforeach
	</div>
	<div class="col-12">
		<div class="btn-group" role="group">
			<a class="btn btn-primary" href="#">Siguiente Vuelta</a>
			<a href="{{ route('torneos.index') }}" class="btn btn-secondary">Volver</a>
		</div>
	</div>
</div>

<div class="modal fade" id="addGame" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Introduzca el resultado del juego</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="#" method="POST" id="formAddGame">
					@csrf
					<div class="col-12">
						<div class="row d-flex-wrap-center">
							<div class="col-6 text-center">
								<p class="h4">Pareja 1</p>
								<p><b id="couple1Game"></b></p>
							</div>
							<div class="col-6 text-center">
								<p class="h4">Pareja 2</p>
								<p><b id="couple2Game"></b></p>
							</div>
							<div class="col-6 text-center">
								<input type="text" class="form-control numberPoint" required name="points1" id="points1Game">
							</div>
							<div class="col-6 text-center">
								<input type="text" class="form-control numberPoint" required name="points2" id="points2Game">
							</div>
						</div>
					</div>
					<div class="form-group col-12 text-right m-t-5">
						<button type="submit" class="btn btn-primary">Guardar</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection

@section('script')
<script src="{{ asset('/admins/vendors/lobibox/Lobibox.js') }}"></script>
<script src="{{ asset('/admins/vendors/touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
@endsection