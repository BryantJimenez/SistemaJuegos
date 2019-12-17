@extends('layouts.admin')

@section('title', 'Ver Jugador')
@section('page-title', 'Ver Jugador')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/dropify/css/dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendors/lobibox/Lobibox.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('jugadores.index') }}">Jugadores</a></li>
<li class="breadcrumb-item active">Editar</li>
@endsection

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">

				@include('admin.partials.errors')

				<div class="form" id="formGmaer" enctype="multipart/form-data">
					<div class="row">
						<div class="form-group col-lg-6 col-md-6 col-12">
							<div class="row">
								<div class="form-group col-lg-12 col-md-12 col-12">
									<label class="col-form-label">Nombres<b class="text-danger">*</b></label>
									<input class="form-control" type="text" name="name" required placeholder="Introduzca un nombre" disabled value="{{ $gamer->name }}">
								</div>
								<div class="form-group col-lg-12 col-md-12 col-12">
									<label class="col-form-label">Apellidos<b class="text-danger">*</b></label>
									<input class="form-control" type="text" name="lastname" required placeholder="Introduzca un apellido" disabled value="{{ $gamer->lastname }}">
								</div>
							</div>
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Foto</label>
							{{-- No se como te gustaria mas, con el redondito o sin el redondito xd. Ahi esta la clasesita si deseas cambiarla :P --}}
							<img src="{{ '/admins/img/users/'.$gamer->photo }}" {{-- class="card-img-top rounded-circle" --}} style="width: 100%; height: 40%";> 
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<div class="btn-group" role="group">
								<a href="{{ route('jugadores.index') }}" class="btn btn-secondary">Volver</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('script')
<script src="{{ asset('/admins/vendors/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('/admins/vendors/lobibox/Lobibox.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
@endsection