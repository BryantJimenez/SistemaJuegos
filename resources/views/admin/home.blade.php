@extends('layouts.admin')

@section('title', 'Inicio')
@section('page-title', 'Panel de Inicio')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body little-profile text-center">
				<h3 class="m-b-3">Bienvenid@ {{ Auth::user()->name." ".Auth::user()->lastname }}</h3>
			</div>
			<div class="text-center bg-light">
				<div class="row">
					<div class="col-6  p-20 b-r">
						<h4 class="m-b-0 font-medium">1</h4><small>Jugadores Activos</small></div>
						<div class="col-6  p-20">
							<h4 class="m-b-0 font-medium">1</h4><small>Jugadores Inactivos</small></div>
						</div>
					</div>
					<div class="card-body text-center">
						<a href="javascript:void(0)" class="m-t-10 m-b-20 waves-effect waves-dark btn btn-success btn-md btn-rounded">Ver Listado Juegos</a>
					</div>
				</div>
			</div>



			<div class="col-lg-4">
				<div class="card bg-info text-white">
					<div class="card-body">
						<div class="d-flex">
							<div class="stats">
								<h1 class="text-white">1</h1>
								<h6 class="text-white">Usuarios</h6>
								<button class="btn btn-rounded btn-outline btn-light m-t-10 font-14">Ver Listado</button>
							</div>
							<div class="stats-icon text-right ml-auto"><i class="fa fa-users display-5 op-3 text-dark"></i></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="card bg-primary text-white">
					<div class="card-body">
						<div class="d-flex">
							<div class="stats">
								<h1 class="text-white">1</h1>
								<h6 class="text-white">Torneos</h6>
								<button class="btn btn-rounded btn-outline btn-light m-t-10 font-14">Ver Listado</button>
							</div>
							<div class="stats-icon text-right ml-auto"><i class="fa fa-trophy display-5 op-3 text-dark"></i></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="card bg-success text-white">
					<div class="card-body">
						<div class="d-flex">
							<div class="stats">
								<h1 class="text-white">1</h1>
								<h6 class="text-white">Clubes</h6>
								<button class="btn btn-rounded btn-outline btn-light m-t-10 font-14">Ver Listado</button>
							</div>
							<div class="stats-icon text-right ml-auto"><i class="fa fa-building display-5 op-3 text-dark"></i></div>
						</div>
					</div>
				</div>
			</div>

		</div>

		@endsection