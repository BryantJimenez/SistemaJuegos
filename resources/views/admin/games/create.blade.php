@extends('layouts.admin')

@section('title', 'Registro de Juego')
@section('page-title', 'Registro de Juego')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/dropify/css/dropify.min.css') }}">
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
								<option value="2">Torneo</option>
							</select>
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Jugadores (Seleccione 4)<b class="text-danger">*</b></label>
							<select class="form-control multiselect" name="gamers" required multiple>
								
							</select>
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Estado<b class="text-danger">*</b></label>
							<select class="form-control" name="state" required>
								<option value="">Seleccione</option>
								<option value="1">Pendiente</option>
								<option value="2">En Progreso</option>
								<option value="2">Finalizada</option>
							</select>
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Apellido<b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="lastname" required placeholder="Introduzca un apellido" value="{{ old('lastname') }}">
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Correo Electrónico<b class="text-danger">*</b></label>
							<input class="form-control" type="email" name="email" required placeholder="Introduzca un correo electrónico" value="{{ old('email') }}">
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Contraseña<b class="text-danger">*</b></label>
							<input class="form-control" type="password" name="password" required placeholder="********" id="password">
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Confirmar Contraseña<b class="text-danger">*</b></label>
							<input class="form-control" type="password" name="password_confirmation" required placeholder="********">
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
<script src="{{ asset('/admins/vendors/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
@endsection