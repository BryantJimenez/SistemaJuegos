@extends('layouts.admin')

@section('title', $phase->name)
@section('page-title', $phase->name)

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('torneos.index') }}">Torneos</a></li>
<li class="breadcrumb-item"><a href="{{ route('torneos.show', ['slug' => $tournament->slug]) }}">{{ $tournament->name }}</a></li>
<li class="breadcrumb-item active">{{ $phase->name }}</li>
@endsection

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="row">
	@foreach($groups as $group)
	<div class="col-6">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-12 text-center">
						<p class="h3">{{ $group->name }}</p>
						<a class="btn btn-primary" href="{{ route('torneos.group', ['slug' => $tournament->slug, 'phase' => $phase->slug, 'group' => $group->slug]) }}">Ver Más</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endforeach
</div>

@endsection

@section('script')
<script src="{{ asset('/admins/vendors/lobibox/Lobibox.js') }}"></script>
@endsection