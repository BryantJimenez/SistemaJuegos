@extends('layouts.admin')

@section('title', 'Registro de Usuario')
@section('page-title', 'Registro de Usuario')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
<li class="breadcrumb-item active">Registro</li>
@endsection

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">

				@include('admin.partials.errors')

				<h6 class="card-subtitle">Campos obligatorios (<b class="text-danger">*</b>)</h6>
				<form action="{{ route('usuarios.store') }}" method="POST" class="form" id="formUser">
					@csrf
					<div class="row">
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Nombre<b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="name" required placeholder="Introduzca un nombre">
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Correo Electrónico<b class="text-danger">*</b></label>
							<input class="form-control" type="email" name="email" required placeholder="Introduzca un correo electrónico">
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Contraseña<b class="text-danger">*</b></label>
							<input class="form-control" type="password" name="password" required placeholder="********" id="password">
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Confirmar Contraseña<b class="text-danger">*</b></label>
							<input class="form-control" type="password" name="password_confirmation" required placeholder="********">
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Permisos<b class="text-danger">*</b></label>
							<select class="custom-select col-12" name="rol" required>
								<option value="">Seleccione</option>
								<option value="Admin">Administrador</option>
								<option value="Usuario">Usuario</option>
							</select>
						</div>
						<div class="form-group col-12">
							<div class="btn-group" role="group">
								<button type="submit" class="btn btn-primary" action="user">Guardar</button>
								<a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Volver</a>
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
<script src="{{ asset('/admins/vendors/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
@endsection