@extends('layouts.admin')

@section('title', 'Registro de Juego')
@section('page-title', 'Registro de Juego')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/multiselect/bootstrap.multiselect.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('juegos.index') }}">Juegos</a></li>
<li class="breadcrumb-item active">Registro</li>
@endsection

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">

				@include('admin.partials.errors')

				<h6 class="card-subtitle">Campos obligatorios (<b class="text-danger">*</b>)</h6>
				<form action="{{ route('juegos.store') }}" method="POST" class="form" id="formGame" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Tipo<b class="text-danger">*</b></label>
							<select class="form-control" name="type" required>
								<option value="">Seleccione</option>
								<option value="1">Slam</option>
								{{-- <option value="2">Torneo</option> --}}
							</select>
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Jugadores (Seleccione 4)<b class="text-danger">*</b></label>
							<select class="form-control multiselectGamers" name="gamers" required multiple>
								@foreach($gamers as $gamer)
								<option value="{{ $gamer->slug }}">{{ $gamer->name." ".$gamer->lastname }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Estado<b class="text-danger">*</b></label>
							<select class="form-control" name="state" required>
								<option value="">Seleccione</option>
								<option value="1">Pendiente</option>
								<option value="2">En Progreso</option>
								<option value="3">Finalizada</option>
							</select>
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Fecha<b class="text-danger">*</b></label>
							
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Estado<b class="text-danger">*</b></label>
							<select class="form-control" name="state" required>
								<option value="">Seleccione</option>
								<option value="1">Pendiente</option>
								<option value="2">En Progreso</option>
								<option value="3">Finalizada</option>
							</select>
						</div>
						<div class="form-group col-12">
							<div class="btn-group" role="group">
								<button type="submit" class="btn btn-primary" action="game">Guardar</button>
								<a href="{{ route('juegos.index') }}" class="btn btn-secondary">Volver</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection

@section('script')
<script src="{{ asset('/admins/vendors/multiselect/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
@endsection