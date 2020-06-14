@extends('frontend/layouts/master')

@section('title', $listing->title)

@section('content')




<div class="container">


	<ol class="breadcrumb">
	    <li><a href="{{ URL::to('') }}">Buscando Colegio</a></li>
	    <li class="active">{{ $listing->title }}</li>
	</ol>

	<div id="listing" style="">

		<div class="row">



			<div class="col-md-8 col-md-push-4">

				<div class="widget">
					<div class="pull-right">

						@if($listing->verified == true)
							<div class="verified">Colegio Verificado <img class="verified" src="{{URL::to('img/verified.png')}}" title="Colegio Verificado" /></div>
						@endif


					</div>

					<h1>{{ $listing->title }}</h1>

					<hr/>

					<p class="description">{!! nl2br($listing->description) !!}</p>

					@if($listing->user_id == NULL)
					<a href="{{url('listing/claim/'.$listing->id)}}"><div class="pull-right btn btn-xs btn-default">Reclamar propiedad del colegio</div></a>
					@endif

					<div class="clearfix"></div>
				</div>

				@if($listing->address && $listing->longitude && $listing->latitude)
				<div class="widget">
					<div id="googlemap" style="height:350px; width:100%;"></div>
				</div>
				@endif

				@if($listing->service_area)
				<div class="widget">
					<h2>¿Qué hace diferente o especial al Colegio?</h2>
					<p>{{$listing->service_area}}</p>

				</div>
				@endif


			</div>

			<div class="col-md-4 col-md-pull-8">

				@if($listing->logo != null)
				<div class="widget" style="text-align: center;">
					<img class="logo" alt="{{ $listing->title }} Logo" title="{{ $listing->title }}" src="{{ URL::to('img/listing/logo/'.$listing->logo) }}" />
				</div>
				@endif



				<div class="widget">
					<h2>Datos de contacto</h2>

					<table class="table-contact">

						@if($listing->phone)
						<tr>
							<td><i class="fa fa-phone fa-fw"></i></td><td><span class="phone-content">{{ substr($listing->phone, 0, -5)."*****"}}</span> <span class="show-phone-link show-link" onclick="showPhone()"> Ver</span></td>
						</tr>
						@endif

						@if($listing->phone_afterhours)
						<tr>
							<td><i class="fa fa-phone fa-fw"></i></td><td><span class="phone-after-content">{{ substr($listing->phone_afterhours, 0, -5)."*****"}}</span> <span class="small">(Fuera de horario)</span> <span class="show-phone-after-link show-link" onclick="showPhoneAfter()">Ver</span></td>
						</tr>
						@endif

						@if($listing->address)
						<tr>
							<td><i class="fa fa-map-marker fa-fw"></i></td><td>{{ $listing->address }}</td>
						</tr>
						@endif

						@if($listing->email)
						<tr>
							<td><i class="fa fa-envelope-o fa-fw"></i></td><td><span class="email-content">{{ substr($listing->email, 0, -7)."*******"}}</span> <span class="show-email-link show-link" onclick="showEmail()">Ver</span></td>
						</tr>
						@endif

						@if($listing->website)
						<tr>
							<td><i class="fa fa-globe fa-fw"></i></td>
							<td><a href="{{ (!preg_match("~^(?:f|ht)tps?://~i", $listing->website)) ? "http://" . $listing->website : $listing->website }}" rel="nofollow">{{ (!preg_match("~^(?:f|ht)tps?://~i", $listing->website)) ? "http://" . $listing->website : $listing->website }}</a></td>
						</tr>
						@endif

						@if( count($listing->levels) > 0 )
						<tr>
							<td>Niveles:</td>
							<td>
							@foreach ($listing->levels as $level)
							<span class="badge">{{$level->name}}</span>
							@endforeach
							</td>
						</tr>
						@endif

					</table>

					<div class="social-icons pull-right">
						@if($listing->facebook)
						<a href="{{ $listing->facebook }}" rel="nofollow"><img src="{{URL::to('img/icons/32-facebook.png')}}" alt="facebook"></a>
						@endif
						@if($listing->twitter)
						<a href="{{ $listing->twitter }}" rel="nofollow"><img src="{{URL::to('img/icons/32-instagram.png')}}" alt="twitter"></a>
						@endif
					</div>

					<div class="clearfix"></div>

				</div>	
		

			</div>

			
		</div>

	</div>

</div>

@stop


@section('scripts')


{!! HTML::script('js/moment.min.js') !!}

<script>

@if($listing->phone)
var phone_encoded = "{{$phone_encoded}}";
function showPhone()
{
	$(".phone-content").html(hex2a(phone_encoded));
	$(".show-phone-link").hide();
}
@endif

@if($listing->phone_afterhours)
var phone_after_encoded = "{{$phone_after_encoded}}";
function showPhoneAfter()
{
	$(".phone-after-content").html(hex2a(phone_after_encoded));
	$(".show-phone-after-link").hide();
}
@endif

@if($listing->email)
var email_encoded = "{{$email_encoded}}";
function showEmail()
{
	var html = '<a href="mailto:'+hex2a(email_encoded)+'">'+hex2a(email_encoded)+'</a>';
	$(".email-content").html(html);
	$(".show-email-link").hide();
}
@endif

function hex2a(hexx) {
    var hex = hexx.toString();//force conversion
    var str = '';
    for (var i = 0; i < hex.length; i += 2)
        str += String.fromCharCode(parseInt(hex.substr(i, 2), 16));
    return str;
}



var openingtimes = {!! json_encode($openingtimes) !!};

setOpenClosed(openingtimes);

@if($listing->address && $listing->longitude && $listing->latitude)
function initViewMap() {
  	var listingLatlng = new google.maps.LatLng({{$listing->latitude}},{{$listing->longitude}});
  	var mapOptions = {
    	zoom: 11,
    	center: listingLatlng,
    	scrollwheel: false,
  	}
  	var map = new google.maps.Map(document.getElementById('googlemap'), mapOptions);

  	var marker = new google.maps.Marker({
      	position: listingLatlng,
      	map: map,
      	title: '{{ $listing->title }}',
       	icon: "{{URL::to('img/marker-blue-small.png')}}",
  	});
}
@endif

function setOpenClosed(openingtimes) {
	var open = false;
	var wd = getWeekday();

	if(openingtimes[wd]){
		var now = moment();
		var start = moment(openingtimes[wd].start, "HH:mm:ss");
		var end = moment(openingtimes[wd].end, "HH:mm:ss");

		if(now > start && now < end){
			open = true;
		}
	
		if(open){
			$(".currentstate").html('We are currently: <span style="color:purple;font-weight:bold;">Open</span>');
		}else{
			$(".currentstate").html('We are currently: <span style="color:red;font-weight:bold;">Closed</span>');
		}	
		
	}



}

function getWeekday() {
	var d = new Date();
	var weekday = new Array(7);
	weekday[0]=  "Sunday";
	weekday[1] = "Monday";
	weekday[2] = "Tuesday";
	weekday[3] = "Wednesday";
	weekday[4] = "Thursday";
	weekday[5] = "Friday";
	weekday[6] = "Saturday";

	var n = weekday[d.getDay()];	
	return n;
}

function getTime() {

}





</script>

@stop