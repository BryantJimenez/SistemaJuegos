@extends('layouts.admin')

@section('title', 'Ver Torneo')
@section('page-title', 'Ver Torneo')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('torneos.index') }}">Torneos</a></li>
<li class="breadcrumb-item active">{{ $tournament->name }}</li>
@endsection

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/multiselect/bootstrap.multiselect.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendors/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="row">
	<div class="col-6">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-12">
						<p class="h3">Datos del Torneo</p>
						<p>Nombre: {{ $tournament->name }}</p>
						<p>Tipo: {{ $tournament->type }}</p>
						<p>
							Participantes: {{ $participants }} 
							@if($tournament->type=="Normal")
							<button type="button" class="btn btn-success btn-sm btn-circle" onclick="addGamers('{{ $tournament->slug }}')"><i class="fa fa-user"></i></button>
							@else
							<button type="button" class="btn btn-success btn-sm btn-circle" onclick="addCouples('{{ $tournament->slug }}')"><i class="mdi mdi-account-multiple"></i></button>
							@endif
						</p>
						<p>Grupos: {{ $tournament->groups }}</p>
						<p>Fecha de inicio: {{ date('d-m-Y', strtotime($tournament->start)) }}</p>
						<p>Estado: {{ $tournament->state }}</p>
					</div>
					<div class="col-12">
						<div class="btn-group" role="group">
							<a class="btn btn-info" href="{{ route('torneos.edit', ['slug' => $tournament->slug]) }}">Editar</a>
							<a href="{{ route('torneos.index') }}" class="btn btn-secondary">Volver</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-6">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-12">

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="addGamers" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Seleccione a los jugadores que participaran en el torneo</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="#" method="POST" id="formAddGamers">
					@csrf
					<div class="form-group col-lg-12 col-md-12 col-12">
						<label class="col-form-label">Jugadores<b class="text-danger">*</b></label>
						<select class="form-control multiselectGamers" name="gamers[]" required multiple>
						</select>
					</div>
					<div class="form-group col-12 text-right">
						<button type="submit" class="btn btn-primary">Guardar</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					</div>
				</form>
				<p class="h3 text-danger text-center" id="formAddGamersFull">Este torneo esta lleno</p>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="addCouples" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Seleccione a los jugadores que conformaran la pareja</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="#" method="POST" id="formAddCouples">
					@csrf
					<div class="form-group col-lg-12 col-md-12 col-12">
						<label class="col-form-label">Jugadores (2 máximo)<b class="text-danger">*</b></label>
						<select class="form-control multiselectCouples" name="gamers[]" required multiple>
						</select>
					</div>
					<div class="form-group col-lg-12 col-md-12 col-12">
						<label class="col-form-label">Club<b class="text-danger">*</b></label>
						<select class="form-control" name="club" required>
							<option value="">Seleccione</option>
							@foreach ($clubs as $club)
							<option value="{{ $club->slug }}">{{ $club->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group col-12 text-right">
						<button type="submit" class="btn btn-primary">Guardar</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					</div>
				</form>
				<p class="h3 text-danger text-center" id="formAddCouplesFull">Este torneo esta lleno</p>
			</div>
		</div>
	</div>
</div>

@endsection

@section('script')
<script src="{{ asset('/admins/vendors/multiselect/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('/admins/vendors/lobibox/Lobibox.js') }}"></script>
@endsection