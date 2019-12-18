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
					<div class="col-12 text-center">
						<button class="btn btn-primary">Jugar</button>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>

@endsection

@section('script')
<script src="{{ asset('/admins/vendors/lobibox/Lobibox.js') }}"></script>
@endsection