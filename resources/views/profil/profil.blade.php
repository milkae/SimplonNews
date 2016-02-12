	@extends('layouts.app')
	@section('content')
	<!-- employeur travail github photo -->
	<div class="mid-content" style="position: relative; top: 15%;">
		<div class="ui center aligned container stackable grid">
			<div class="nine wide column">
				<div class="ui container stackable segments">
					<div class="ui horizontal container stackable segments">
						<div class="ui left aligned attached padded segment">
							<div class="header dividing"><a href="">Jean-Michel</a></div>
						</div>
						<div class="ui right aligned attached segment">
							<button class="ui compact labeled icon pink inverted button"><i class="setting icon"></i> Edit </button>
						</div>
					</div>
					<div class="ui segment">
						<div class="ui container stackable grid">
							<div class="eight wide column">
								<img src="http://lorempicsum.com/futurama/255/200/2" alt="Image de Profile" class="ui large rounded image">
							</div>
							<div class="eight wide left aligned verry padded column">
								<div class="ui list">
									<div class="item"><div class="header"><i class="travel icon"></i>Profession</div>...</div>
									<div class="ui divider"></div>
									<div class="item"><div class="header">Employeur</div>Phillipe</div>
									<div class="ui divider"></div>

									<div class="item">
										<!-- <div class="header">Github</div> -->
										<button class="ui circular github icon button">
											<i class="github icon"></i>
										</button>
										<a href="#">Jean-Michel</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
