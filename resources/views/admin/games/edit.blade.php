@extends('layouts.admin')

@section('title', 'Editar Juego')
@section('page-title', 'Editar Juegi')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/lobibox/Lobibox.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('juegos.index') }}">Juegos</a></li>
<li class="breadcrumb-item active">Editar</li>
@endsection

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">

				@include('admin.partials.errors')

				<h6 class="card-subtitle">Campos obligatorios (<b class="text-danger">*</b>)</h6>
				<form action="{{ route('juegos.update', ['slug' => $game->slug]) }}" method="POST" class="form" id="formGame">
					@method('PUT')
					@csrf
					<div class="row">
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Puntaje de la Pareja 1<b class="text-danger">*</b></label>
							<input class="form-control numberPoint" type="text" name="points1" required placeholder="Introduzca el puntaje" value="{{ $game->points1 }}">
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Puntaje de la Pareja 2<b class="text-danger">*</b></label>
							<input class="form-control numberPoint" type="text" name="points2" required placeholder="Introduzca el puntaje" value="{{ $game->points2 }}">
						</div>
						<div class="form-group col-12">
							<div class="btn-group" role="group">
								<button type="submit" class="btn btn-primary" action="user">Actualizar</button>
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
<script src="{{ asset('/admins/vendors/lobibox/Lobibox.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
@endsection