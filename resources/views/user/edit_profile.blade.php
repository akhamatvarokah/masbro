@extends('layout.app')
@section('title', 'Login Page Masbro')
@section('content')
	<style type="text/css">
		.section-full:last-child{
			margin-bottom: 0;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/googlemap.css')}}">
	<!-- contact area -->
        <div class="content-block">
			<!-- Submit Resume -->
			<div class="section-full submit-resume content-inner-2" style="padding-top: 35px; padding-bottom: 20px;">
				<div class="container">
					<div class="row">
						<div class="col-md-7 col-lg-9" style="box-shadow: 0 0 10px 0 rgba(0,24,128,0.1); background: #ffff">
							 @if(Session::has('message-succes'))
		                        <div class="alert alert-success" style="margin :10px">
		                             <ul>                                
		                                 <li>{{ Session::get('message-succes') }}</li>
		                             </ul>
		                         </div>
		                     @endif
							<form method="POST" style="margin-top: 10px" enctype="multipart/form-data">
								@csrf
								<div class="form-group">
									<label>First Name</label>
									<input type="text" name="first_name" value="{{ $user->first_name }}" class="form-control" placeholder="Your First Name">
								</div>
								<div class="form-group">
									<label>Last Name</label>
									<input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}" placeholder="Your Last Name">
								</div>
								<div class="form-group">
									<label>User Id</label>
									<input type="text" name="user_id" class="form-control" value="{{ $user->user_id }}" placeholder="">
								</div>

								<div class="form-group">
									<label>No Telepon</label>
									<input type="text" name="phone" value="{{ $user->phone }}" class="form-control" placeholder="0821">
								</div>	

								<div class="form-group">
									<label>Professional title</label>
									<input type="text" name="profession" value="{{ $user->profession }}" class="form-control" placeholder="Koki">
								</div>								
								<div class="form-group">
									<label>Biodata</label>
									<textarea name="bio" class="form-control" placeholder="Biodata">{{ $user->bio }}</textarea>
								</div>

								<div class="form-group">
									<label>profile image</label>									
									<img src="{{ asset('images/profile-picture-user/'.$user->profile_image) }}" width="100px" height="100px" />
									<div class="custom-file">
										<input type="file" name="profile_image" class="site-button" id="customFile">
									</div>
								</div>

								<div class="form-group">
									<label for="province_id">Provinsi alamat</label>
									<select name="province_id" id="province_id">
										<option value="0">Silahkan Pilih</option>
										@foreach($provinces as $province)
											@php $select=""; @endphp
											@if($province->id == $user->province_id)
												@php $select='selected="selected"'; @endphp
											@endIf
											<option {{ $select}} value="{{ $province->id }}">{{ $province->name }}</option>
										@endForeach
									</select>
								</div>								

								<div class="form-group">
									<label for="regency_id">Kota / Kabupaten alamat</label>
									<select name="regency_id" id="regency_id">
										<option value="0">Silahkan Pilih</option>
										@foreach($regencys as $regency)
											@php $select=""; @endphp
											@if($regency->id == $user->regency_id)
												@php $select='selected="selected"'; @endphp
											@endIf
											<option {{ $select}} value="{{ $regency->id }}">
												@php $type="Kota "; @endphp
												@if($regency->type == 1)
													@php $type="Kabupaten "; @endphp
												@endIf
												{{ $type.$regency->name }}
											</option>
										@endForeach
									</select>
								</div>

								<div class="form-group">
									<label for="district_id">Kecamatan</label>
									<select name="district_id" id="district_id">
										<option value="0">Silahkan Pilih</option>
										@foreach($districts as $district)
											@php $select=""; @endphp
											@if($district->id == $user->district_id)
												@php $select='selected="selected"'; @endphp
											@endIf
											<option {{ $select}} value="{{ $district->id }}">{{ $district->name }}</option>
										@endForeach
									</select>
								</div>

								<div class="form-group">
									<label>Detail Alamat</label>
									<textarea name="addreess" id="addreess" class="form-control" placeholder="Alamat">{{ $user->addreess }}</textarea>
								</div>

								<div class="form-group">
									<label>Maps</label><br/><br/>
									<input id="pac-input" class="controls" type="text" placeholder="Search Box" style="left : 0; width: 70%; margin-top: 7px;">
                      				<div id="mapGoogle" style="osition: relative; overflow: hidden; height: 300px; margin-top: -30px; z-index: 0;"></div>
                      				<input type="hidden" name="long" id="long" value="{{ $user->longitude }}">
                      				<input type="hidden" name="lat" id="lat" value="{{ $user->latitude }}">
								</div>

								<button type="submit" class="site-button" style="margin-bottom: 10px;">Submit</button>
							</form>
						</div>
						<div class="col-md-5 col-lg-3">
							<div class="sticky-top">
								<div class="candidates-are-sys m-b30">
									<div class="candidates-bx">
										<div class="testimonial-pic radius"><img src="{{ asset('images/profile-picture-user/default.png') }}" alt="" width="100" height="100"></div>
										<div class="testimonial-text">
											<p>I just got a job that I applied for via careerfy! I used the site all the time during my job hunt.</p>
										</div>
										<div class="testimonial-detail"> <strong class="testimonial-name">Richard Anderson</strong> <span class="testimonial-position">Nevada, USA</span> </div>
									</div>
								</div>
								<div class="quote-bx">
									<div class="quote-info">
										<h4>Make a Difference with Your Online Resume!</h4>
										<p>Your resume in minutes with JobBoard resume assistant is ready!</p>
										<a href="#" class="site-button">Create an Account</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
            <!-- Submit Resume END -->
		</div>
    </div>
    <!-- Content END-->


@endsection

@section('js')

<script type="text/javascript">
        var marker;
        var map;
        var longitude = "{{ $user->longitude ? $user->longitude : 106.7883531}}";
        var latitude = "{{ $user->latitude ? $user->latitude :  -6.2440165}} ";
        
        longitude = parseFloat(longitude);
        latitude = parseFloat(latitude);
        function initMap() {
          map = new google.maps.Map(document.getElementById('mapGoogle'), {
            zoom: 17,
            center: {lat: latitude, lng: longitude}
          });

          marker = new google.maps.Marker({
            map: map,
            draggable: true,
            animation: google.maps.Animation.DROP,
            position: {lat: latitude, lng: longitude}
          });

          marker.addListener('click', toggleBounce);
  
            // Create the search box and link it to the UI element.
          var input = document.getElementById('pac-input');
          var searchBox = new google.maps.places.SearchBox(input);
          map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            
        // Bias the SearchBox results towards current map's viewport.
          map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
          });


          searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();

            if (places.length == 0)
              return;

            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
              
              if (!place.geometry)
                return;

              if (place.geometry.viewport)
                bounds.union(place.geometry.viewport);
              else
                bounds.extend(place.geometry.location);

            });

              map.fitBounds(bounds);
              placeMarker(map.center);

          });

            google.maps.event.addListener(map, 'click', function(event) {
              placeMarker(event.latLng);
              setLongLat();
          });

          function placeMarker(location) {
              marker.setPosition(location);
              //map.setCenter(location);
              map.setZoom(17);
              setLongLat();
          }

          setLongLat();
        }

        function setLongLat()
        {
            document.getElementById('long').value= map.getCenter().lng();
            document.getElementById('lat').value= map.getCenter().lat();
        }
  
        function toggleBounce() {
          if (marker.getAnimation() !== null) {
            marker.setAnimation(null);
          } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
          }
        }    
</script>
<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDR7DFQIBGumoziD6B6a0n2EZgrKhQOWS4&callback=initMap&libraries=places"></script>


<script type="text/javascript">
	$(function() {
    	$("#province_id").change(function(){
			$.ajax({
				type: "GET",
				url: '{{ URL::to("place/regencyAjax") }}/'+$(this).val(),
				dataType: 'json',
				success: function(data){
					$("#regency_id").html("");
					$("#district_id").html("");
					$.each( data.data, function( key, value ) {
						var type = "Kota";
						if(value.type == 1)
							var type = "Kabupaten";

							$('#regency_id').append($('<option>', {
        						value: value.id,
        						text: type+" "+value.name
      						}));
					});
					 $('#regency_id').selectpicker('refresh');
				}
			});
		});

		$("#regency_id").change(function(){
			$.ajax({
				type: "GET",
				url: '{{ URL::to("place/districtAjax") }}/'+$(this).val(),
				dataType: 'json',
				success: function(data){
					$("#district_id").html("");
					$.each( data.data, function( key, value ) {
							$('#district_id').append($('<option>', {
        						value: value.id,
        						text: value.name
      						}));
					});
					
					$('#district_id').selectpicker('refresh');
				}
			});
		});
	});
</script>

@endsection