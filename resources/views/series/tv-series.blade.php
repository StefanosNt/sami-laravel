
@extends('layouts.app') 
@section('content')
	<div class="container-fluid">
   	  <div class="series-poster-wrapper">
	  	<div class="banner series-banner z-depth-1" style="background: url('https://image.tmdb.org/t/p/w1280/{{$series['backdrop_path']}}');"></div> 
		<div class="series-poster-block">
			<div><img class="series-poster-img z-depth-2" src="https://image.tmdb.org/t/p/w500/{{$series['poster_path']}}"></div>
			<button class="favorite-btn btn">Add to favorites</button>
			<button class="watch-later-btn btn">Watch later <i id='watch-later-icon' class='material-icons right invisible'>check</i></button> 
		</div>
		   
      </div>
      <p class="invisible">{{$n=$series['vote_average']}}</p>
     
	@php 

 
	$int = $n%10; 
	$dec = ($n*100)%100;

	if($dec>50) $int++;

	 $int = $int*10; 
	@endphp 
     
      <div class="title-block"><span class="title"><h2>{{$series['name']}}</h2></span> <span class="stars-container stars-{{$int}}">★★★★★</span><span class="rating">{{$series['vote_average']}}</span></div> 

      <p class="series-overview">{{$series['overview']}}</p>
      <div class="row" class="series-details">
        <div class="col s12 m2">
        	<ul class="collection seasons">
        		@foreach($series['seasons'] as $k => $v)
        	  		@if($v['season_number']==0) @continue @endif
						<li><a id="{{$v['season_number']}}" class="collection-item @if($v['season_number']==$seasonNumber) active @endif">Season {{$v['season_number']}}</a></li>
		  		@endforeach 
		  	</ul>  
        </div>
        
        <div class="col s12 m10">
        
			 <ul id="episode-list" class="collection with-header collapsible" data-collapsible="accordion">
				<li>
				  <div class="row collection-header episode-list-header">
					  <div class="col s3"><h5>Episode</h5></div>
					  <div class="col s5"><h5>Titlte</h5></div>
					  <div class="col s4"><h5>Air Date</h5></div>
				  </div>
				</li>
				@foreach($season['episodes'] as $k => $v)
					<li class="episode"> 
					  <div class="collapsible-header row episode-header">
						  <div class="col s3">{{$v['episode_number']}}</div>
						  <div class="col s5">{{$v['name']}}</div>
						  <div class="col s4">{{$v['air_date']}}</div>
					  </div>
					  <div class="collapsible-body episode-body"><span>{{$v['overview']}}</span></div>
					</li> 
				@endforeach 
			  </ul>
        
        
        
        
        
        
<!--
			<table class="episodes">
			<thead>
			  <tr class="collection">
				  <th class="collection-item">Episode</th>
				  <th class="collection-item">Title</th>
				  <th class="collection-item">Air Date</th>
				  <th class="collection-item"></th>
			  </tr>
			</thead>
			
			<tbody>
				@foreach($season['episodes'] as $k => $v)
				  <tr class="collection">
					<td class="collection-item">{{$v['episode_number']}}</td>
					<td class="collection-item">{{$v['name']}}</td>
					<td class="collection-item">{{$v['air_date']}}</td>
					<td class="collection-item">
						<input type="checkbox" class="filled-in ss" id="s{{$v['season_number']}}e{{$v['episode_number']}}"/><label for="s{{$v['season_number']}}e{{$v['episode_number']}}"></label>
					</td>
				  </tr> 
				@endforeach 
			</tbody>
			</table> 
-->
        </div>
      </div> 
@endsection 
@section('js')

	<script>		
		$(document).ready(function(){
			var i=0,j=0;
			$(".favorite-btn").click(function(){
				if(i===0){
					$(".favorite-btn").addClass("favorite-btn-true");
					$(".favorite-btn").text("favorite");
					i=1;
				}else{
					$(".favorite-btn").removeClass("favorite-btn-true");
					$(".favorite-btn").text("Add to favorites");
					i=0;
				}
			})
			$(".watch-later-btn").click(function(){
				if(j===0){
					$(".watch-later-btn").addClass("watch-later-btn-true"); 
					$("#watch-later-icon").removeClass("invisible"); 
					j=1;
				}else{
					$(".watch-later-btn").removeClass("watch-later-btn-true");
					$("#watch-later-icon").addClass("invisible"); 
					j=0;
				}
			})
			var seasons = 
			$.ajax({
				async:false, 
				method:'GET',
				url:'/tv/{{$series['id']}}/all',
				success: function(s){ 
					 seasons = s;
				}
			}).responseJSON;
			
			console.log(seasons);
			
			$(".seasons").click(function(e){
				$(".seasons .active").removeClass("active");
				$("#"+e.target.id).addClass("active");
				
				$("#episode-list .episode").remove()
				$.each(seasons['season/'+e.target.id]['episodes'],function(i,v){
					$("#episode-list").append(
						'<li class="episode">'+
						  '<div class="collapsible-header row episode-header">'+
							  '<div class="col s3">'+v.episode_number+'</div>'+
							  '<div class="col s5">'+v.name+'</div>'+
							  '<div class="col s4">'+v.air_date+'</div>'+
						  '</div>'+
						  '<div class="collapsible-body episode-body"><span>{{$v['overview']}}</span></div>'+
						'</li>'
//						'<tr class="collection">'+
//							'<td class="collection-item">'+v.episode_number+'</td>'+
//							'<td class="collection-item">'+v.name+'</td>'+
//							'<td class="collection-item">'+v.air_date+'</td>'+
////							'<td class="collection-item"><input type="checkbox" class="filled-in ss" id=s'+e.target.id+'e'+v.episode_number+'><label for=s'+e.target.id+'e'+v.episode_number+'></label></td>'+ 
//						'</tr>'
					);	
				})
					
			})

		})
	</script> 
@endsection