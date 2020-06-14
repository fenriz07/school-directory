@extends('frontend/layouts/master')

@section('title', ($listing->id)?'Edit Listing':'Sube un colegio')

@section('styles')



@stop

@section('content')


<div class="container">

<h1 class="page-headline">{{ ($listing->id)?'Edición del colegio':'Sugiere un Colegio' }}</h1>

<div class="bg-white" style="">


	<form action="{{ ($listing->id) ? URL::to('listing/edit/'.$listing->id) : URL::to('listing/edit') }}" method="post" enctype="multipart/form-data">

	{!! csrf_field() !!}

	<div class="row">
		<div class="col-md-8">

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

			<input type="hidden" class="form-control" id="id" name="id" value="{{ $listing->id }}">

		    <div class="clearfix"></div>


		    <div class="row">

		    	<div class="col-sm-3">
		        	<label for="title" class="control-label">Nombre del colegio</label>
		        </div>
		        <div class="col-sm-9 form-group">
		            <input type="text" class="form-control" id="title" name="title" value="{{ (Request::old('title')) ? Request::old('title') : $listing->title }}">
		        </div>
		    </div>

			<div class="row data-block">

		    	<div class="col-sm-3">
		        	<label for="categories" class="control-label">Servicios con los que cuenta el colegio</label>
		        </div>
		        <div class="col-sm-9 form-group">

			    <select class="form-control selectpicker" name="categories[]" multiple>
			        @foreach($main_categories as $cat)
			        <optgroup label="{{$cat->name}}">
			          @foreach($cat->children as $child)
			            @if( (isset($selected_categories) && in_array($child->id, $selected_categories)) || is_array(Request::old('categories')) && in_array($child->id, Request::old('categories')) )
			              <option value="{{$child->id}}" selected>{{$child->name}}</option>
			            @else
			              <option value="{{$child->id}}">{{$child->name}}</option>
			            @endif
			          @endforeach
			        </optgroup>
			        @endforeach
			    </select>

		        </div>


			</div>
			
			<div class="row data-block">

		    	<div class="col-sm-3">
		        	<label for="categories" class="control-label">Niveles</label>
		        </div>
		        <div class="col-sm-9 form-group">

			    <select class="form-control selectpicker" name="levels[]" multiple>
					@foreach($levels as $level)
					
						@if( (isset($selected_levels) && in_array($level->id, $selected_levels)) )
							<option value="{{$level->id}}" selected>{{$level->name}}</option>
						@else
							<option value="{{$level->id}}">{{$level->name}}</option>
						@endif
					
			        @endforeach
			    </select>

		        </div>


		    </div>

		    <div class="row">

		    	<div class="col-sm-3">
		        	<label for="description" class="control-label">Describe el colegio</label>
		        </div>
		        <div class="col-sm-9 form-group">
		        	<textarea id="description" name="description" class="form-control" rows="10" placeholder="Describe el colegio">{{ (Request::old('description')) ? Request::old('description') : $listing->description }}</textarea>
		        </div>

		    </div>

		    <div class="row data-block">

		    	<div class="col-sm-3">
		        	<label for="logo" class="control-label">Logo</label>
		        </div>
		        <div class="col-sm-9 form-group">
		        	<input type="file" class="form-control" name="logo" id="logoupload" accept='image/*'>
		        	<img id="logopreview" class="img-responsive" alt="" src="{{ ($listing->logo != null)?URL::to('img/listing/logo/'.$listing->logo):'' }}" />

		        </div>

		    </div>


		    <div class="row data-block">

		    	<div class="col-sm-3">
		        	<label for="location" class="control-label">Dirección</label>
		        </div>
                <div class="col-md-9">

                	<div id="geocomplete-fields">



	                	<input name="lng" type="hidden" class="form-control" value="{{ (Request::old('lng')) ? Request::old('lng') : $listing->longitude }}">
	                	<input name="lat" type="hidden" class="form-control" value="{{ (Request::old('lat')) ? Request::old('lat') : $listing->latitude }}">
	                	<input name="formatted_address" type="hidden" value="{{ (Request::old('formatted_address')) ? Request::old('formatted_address') : $listing->address }}">

	                	<div class="form-group">
		                    <div class="input-group">

		                        
		                        
		                        <input name="address" type="text" class="form-control" placeholder="Search ..." id="map-search" value="{{ (Request::old('address')) ? Request::old('address') : $listing->address }}">



		                        <div class="input-group-btn">
		                            <button type="button" id="map-search-button" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
		                        </div>
		                    </div>
		                </div>

	                    <div class="form-group">
	                        <div id="googlemap" style="height:250px; width:100%;"></div>
	                    </div>

	                </div>

                </div>


		    </div>

		    <div class="row data-block">

		    	<div class="col-sm-3">
		        	<label for="description" class="control-label">¿Qué hace diferente o especial al Colegio?</label>
		        </div>
		        <div class="col-sm-9 form-group">
		        	<textarea id="service_area" name="service_area" class="form-control" rows="10" placeholder="¿Qué hace diferente o especial al Colegio?">{{ (Request::old('service_area')) ? Request::old('service_area') : $listing->service_area }}</textarea>
		        </div>

		    </div>



		    <div class="row data-block">

		    	<div class="col-sm-3">
		        	<label for="phone" class="control-label">Teléfono</label>
		        </div>
		        <div class="col-sm-9 form-group">
		        	<input type="text" class="form-control" id="phone" name="phone" value="{{ (Request::old('phone')) ? Request::old('phone') : $listing->phone }}" placeholder="Ejemplo: 012345678">
		        </div>

		    	<div class="col-sm-3">
		        	<label for="phoneafterhours" class="control-label">Whatsapp</label>
		        </div>
		        <div class="col-sm-9 form-group">
		        	<input type="text" class="form-control" id="phone_afterhours" name="phone_afterhours" value="{{ (Request::old('phone_afterhours')) ? Request::old('phone_afterhours') : $listing->phone_afterhours }}" placeholder="Ejemplo: 012345678">
		        </div>

		    	<div class="col-sm-3">
		        	<label for="website" class="control-label">Sitio Web</label>
		        </div>
		        <div class="col-sm-9 form-group">
		        	<input type="text" class="form-control" id="website" name="website" value="{{ (Request::old('website')) ? Request::old('website') : $listing->website }}" placeholder="Ejemplo: http://www.ejemplo.com">
		        </div>

		    	<div class="col-sm-3">
		        	<label for="email" class="control-label">Correo Electrónico</label>
		        </div>
		        <div class="col-sm-9 form-group">
		        	<input type="text" class="form-control" id="email" name="email" value="{{ (Request::old('email')) ? Request::old('email') : $listing->email }}" placeholder="Ejemplo: info@gmail.com">
		        </div>

		    </div>

		    <div class="row data-block">
		    	<div class="col-sm-3">
		        	<label for="twitter" class="control-label">Instagram</label>
		        </div>
		        <div class="col-sm-9 form-group">
		        	<input type="text" class="form-control" id="twitter" name="twitter" value="{{ (Request::old('twitter')) ? Request::old('twitter') : $listing->twitter }}" placeholder="@ejemplo">
		        </div>

		    	<div class="col-sm-3">
		        	<label for="facebook" class="control-label">Facebook</label>
		        </div>
		        <div class="col-sm-9 form-group">
		        	<input type="text" class="form-control" id="facebook" name="facebook" value="{{ (Request::old('facebook')) ? Request::old('facebook') : $listing->facebook }}" placeholder="http://www.facebook.com/tu-colegio-ideal">
		        </div>

		    </div>


		    <div class="data-block">
		        <div class="pull-right">

		          	<button type="submit" class="btn btn-lg btn-success">{!! ($listing->id)?'<i class="fa fa-check"></i> Guardar':'Enviar' !!}</button>

			    </div>
			    <div class="clearfix"></div>

		    </div>

		</div>



	</div>




	</form>

</div>

</div>

@stop


@section('scripts')


{!! HTML::script('js/jquery.geocomplete.min.js') !!}

<script>

	function initSubmitMap() {
		var options = {
		  details: "#geocomplete-fields",
		  map: "#geocomplete-fields #googlemap",
		  location: "{{ (Request::old('address')) ? Request::old('address') : $listing->address }}",
		  mapOptions: {
		    zoom: 10
		  },
		  markerOptions: {
		    draggable: true
		  },
		};

		$( "#geocomplete-fields #map-search-button" ).click(function() {
		  	$("#map-search").geocomplete("find", $("input[name=address]").val());
		});
		        
		$("#geocomplete-fields #map-search").geocomplete(options).bind("geocode:dragged", function(event, result){
			$("#geocomplete-fields input[name=lat]").val(result.lat());
			$("#geocomplete-fields input[name=lng]").val(result.lng()); 
			$("#geocomplete-fields #map-search").geocomplete("find", result.toString());
		});
	}

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();            
            reader.onload = function (e) {
                $('#logopreview').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#logoupload").change(function(){
        readURL(this);
    });



</script>

@stop