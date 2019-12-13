@extends('layouts.admin')

@section('title', 'Inicio')
@section('page-title', 'Panel de Inicio')

@section('content')

<div class="row">
	@if (session('login'))
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h1 class="text-center">Bienvenid@ {{ Auth::user()->name }} a ActivosCP</h1>
			</div>
		</div>
	</div>
	@endif
	<div class="col-lg-3 col-xlg-3 col-md-6 col-12">
		<div class="card">
			<div class="card-body">
				<p class="badge badge-primary badge-lg">En uso</p>
				<h1>{{ $uso }}</h1>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-xlg-3 col-md-6 col-12">
		<div class="card">
			<div class="card-body">
				<p class="badge badge-primary badge-lg">Dañados en uso</p>
				<h1>{{ $danadoUso }}</h1>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-xlg-3 col-md-6 col-12">
		<div class="card">
			<div class="card-body">
				<p class="badge badge-primary badge-lg">Dañados en desuso</p>
				<h1>{{ $danadoDesuso }}</h1>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-xlg-3 col-md-6 col-12">
		<div class="card">
			<div class="card-body">
				<p class="badge badge-primary badge-lg">Abandonados</p>
				<h1>{{ $abandonado }}</h1>
			</div>
		</div>
	</div>
</div>

@endsection