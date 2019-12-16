@extends('layouts.admin')

@section('title', 'Lista de Juegos')
@section('page-title', 'Lista de Juegos')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/lobibox/Lobibox.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">Juegos</li>
<li class="breadcrumb-item active">Lista</li>
@endsection

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="tabla" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>#</th>
								<th>Tipo</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($games as $game)
							<tr>
								<td>{{ $num++ }}</td>
								<td>{{ $game->type }}</td>
								<td class="d-flex">
									<button class="btn btn-primary btn-circle btn-sm" onclick="showGame('{{ $game->slug }}')"><i class="mdi mdi-account-card-details"></i></button>&nbsp;&nbsp;
									<a class="btn btn-info btn-circle btn-sm" href="{{ route('juegos.edit', ['slug' => $game->slug]) }}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
									<button class="btn btn-danger btn-circle btn-sm" onclick="deleteGame('{{ $game->slug }}')"><i class="fa fa-trash"></i></button>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="showUser" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Información del Usuario</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-6">
						<img src="{{ asset('/admins/img/users/usuario.png') }}" id="photoUser" class="rounded img-fluid" alt="Foto del usuario">
					</div>
					<div class="col-6">
						<label class="col-form-label">Nombre</label>
						<p id="nameUser"></p>
						<label class="col-form-label">Correo</label>
						<p id="emailUser"></p>
						<label class="col-form-label">Estado</label>
						<p id="stateUser"></p>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">¿Estás seguro de que quieres eliminar este usuario?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<form action="#" method="POST" id="formDeleteUser">
					@csrf
					@method('DELETE')
					<button type="submit" class="btn btn-primary">Eliminar</button>
				</form>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>

@endsection

@section('script')
<script src="{{ asset('/admins/vendors/lobibox/Lobibox.js') }}"></script>
<script src="{{ asset('/admins/vendors/datatables/jquery.dataTables.min.js') }}"></script>
@endsection