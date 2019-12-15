@extends('layouts.admin')

@section('title', 'Crear Torneo ')
@section('page-title', 'Crear Torneo ')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="">Asignar Parejas</a></li>
<li class="breadcrumb-item active">Registro</li>
@endsection

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">

				@include('admin.partials.errors')

				<h6 class="card-subtitle">Campos obligatorios (<b class="text-danger">*</b>)</h6>
				<form action="" method="POST" class="form">
					@csrf
					<div class="row">
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Nombre Torneo<b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="name" required placeholder="Introduzca un nombre">
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="card card-body">
								<h3 class="box-title m-b-0">Grupo 1</h3>
								<div class="row">
									<form>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 1 </p>
											<div class="form-group">
												<label for="exampleInputEmail1">Nombre Grupo</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 1 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>            

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 2 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 3 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 4 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 5 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 6 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>

									

								</div>
							</div>
						</div>
						
						<div class="row">
						<div class="col-md-6">
							<div class="card card-body">
								<h3 class="box-title m-b-0">Grupo 2</h3>
								<div class="row">
									<form>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 1 </p>
											<div class="form-group">
												<label for="exampleInputEmail1">Nombre Grupo</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 1 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>            

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 2 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 3 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 4 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 5 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 6 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>

									

								</div>
							</div>
						</div>

						<div class="row">
						<div class="col-md-6">
							<div class="card card-body">
								<h3 class="box-title m-b-0">Grupo 3</h3>
								<div class="row">
									<form>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 1 </p>
											<div class="form-group">
												<label for="exampleInputEmail1">Nombre Grupo</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 1 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>            

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 2 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 3 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 4 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 5 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 6 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>

									

								</div>
							</div>
						</div>

						<div class="row">
						<div class="col-md-6">
							<div class="card card-body">
								<h3 class="box-title m-b-0">Grupo 4</h3>
								<div class="row">
									<form>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 1 </p>
											<div class="form-group">
												<label for="exampleInputEmail1">Nombre Grupo</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 1 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>            

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 2 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 3 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 4 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 5 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 6 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>

									

								</div>
							</div>
						</div>

						<div class="row">
						<div class="col-md-6">
							<div class="card card-body">
								<h3 class="box-title m-b-0">Grupo 5</h3>
								<div class="row">
									<form>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 1 </p>
											<div class="form-group">
												<label for="exampleInputEmail1">Nombre Grupo</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 1 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>            

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 2 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 3 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 4 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 5 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 6 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>

									

								</div>
							</div>
						</div>

						<div class="row">
						<div class="col-md-6">
							<div class="card card-body">
								<h3 class="box-title m-b-0">Grupo 6</h3>
								<div class="row">
									<form>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 1 </p>
											<div class="form-group">
												<label for="exampleInputEmail1">Nombre Grupo</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 1 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>            

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 2 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 3 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 4 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 5 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="text-muted m-b-30 font-13"> Pareja 6 </p>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Juagador 1</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label for="exampleInputEmail1">Jugador 2</label>
												<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											</div>
										</div>

									</form>

								</div>
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