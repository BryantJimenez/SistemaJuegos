@extends('layouts.admin')

@if($phase=='Fase de grupos')
@section('title', 'Fase de grupos')
@section('page-title', 'Fase de grupos')
@elseif($phase=='Semifinal')
@section('title', 'Semifinal')
@section('page-title', 'Semifinal')
@else
@section('title', 'Final')
@section('page-title', 'Final')
@endif

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('torneos.index') }}">Torneos</a></li>
<li class="breadcrumb-item"><a href="{{ route('torneos.show', ['slug' => $tournament->slug]) }}">{{ $tournament->name }}</a></li>
<li class="breadcrumb-item active">Fase de grupos</li>
@endsection

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/multiselect/bootstrap.multiselect.css') }}">
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
					</div>
				</div>
			</div>
		</div>
	</div>
	@endforeach
</div>

@endsection

@section('script')
<script src="{{ asset('/admins/vendors/multiselect/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('/admins/vendors/lobibox/Lobibox.js') }}"></script>
@endsection