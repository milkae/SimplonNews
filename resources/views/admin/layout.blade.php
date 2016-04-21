@extends('layouts.app')
@section('content')
	<div class="ui secondary pointing menu">
	  <a class="active item">Users </a>
	  <a class="item">Gestion 2 </a>
	  <a class="item">Gestion 3 </a>
	</div>
	<div class="ui segment">
	@yield('panel')
	</div>
@endsection