<div class="row">
	@foreach($topRated  as $k => $v) 
	<div class="col s6 m4 l3 xl2 tv-section">
	  <div class="card hoverable">
		<div class="card-image">
		@if($v['poster_path']===null) <img class="pop-img" src="http://placehold.it/342x513?text=NO+POSTER">
		@else <img class="pop-img" src="{{'https://image.tmdb.org/t/p/w342'.$v['poster_path']}}">
		@endif
		</div>
		<div class="card-content pop-body">
		<span class="card-title"> <a href="/tv/{{$v['id']}}"> {{$v['name']}} </a> </span>
		</div>
	  </div>
	</div> 
	@endforeach  
</div> 